<?php
/**
 * Integrations: WooCommerce
 *
 * @package     AffiliateWP
 * @subpackage  Integrations
 * @copyright   Copyright (c) 2014, Sandhills Development, LLC
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// phpcs:disable PEAR.Functions.FunctionCallSignature.FirstArgumentPosition -- Spaces before comments OK.
// phpcs:disable PEAR.Functions.FunctionCallSignature.EmptyLine -- Space above comments ok.

use Automattic\WooCommerce\Utilities\OrderUtil;

/**
 * Implements an integration for WooCommerce.
 *
 * @since 1.0
 *
 * @see Affiliate_WP_Base
 */
class Affiliate_WP_WooCommerce extends Affiliate_WP_Base {

	/**
	 * The order object
	 *
	 * @access  private
	 * @since   1.1
	 * @var WC_Order
	*/
	private $order = false;

	/**
	 * The context for referrals. This refers to the integration that is being used.
	 *
	 * @access  public
	 * @since   1.2
	 */
	public $context = 'woocommerce';

	/**
	 * Setup actions and filters
	 *
	 * @access  public
	 * @since   1.0
	*/
	public function init() {

		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'add_pending_referral' ), 10 );

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '6.4.0', '>=' ) ) {
			add_action( 'woocommerce_store_api_checkout_order_processed', array( $this, 'add_pending_referral_checkout_block' ) );
		} else {
			add_action( 'woocommerce_blocks_checkout_order_processed', array( $this, 'add_pending_referral_checkout_block' ) );
		}

		// Add an order note if a contained referral is updated.
		add_action( 'affwp_updated_referral', array( $this, 'updated_referral_note' ), 10, 3 );

		// There should be an option to choose which of these is used.
		add_action( 'woocommerce_order_status_completed',  array( $this, 'mark_referral_complete' ), 10 );
		add_action( 'woocommerce_order_status_processing', array( $this, 'mark_referral_complete' ), 10 );

		// Refunded.
		add_action( 'woocommerce_order_status_completed_to_refunded',  array( $this, 'revoke_referral_on_refund' ), 10 );
		add_action( 'woocommerce_order_status_processing_to_refunded', array( $this, 'revoke_referral_on_refund' ), 10 );
		add_action( 'woocommerce_order_status_pending_to_refunded',    array( $this, 'revoke_referral_on_refund' ), 10 );
		add_action( 'woocommerce_order_status_on-hold_to_refunded',    array( $this, 'revoke_referral_on_refund' ), 10 );

		// Cancelled.
		add_action( 'woocommerce_order_status_completed_to_cancelled',  array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_processing_to_cancelled', array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_pending_to_cancelled',    array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_on-hold_to_cancelled',    array( $this, 'revoke_referral' ), 10 );

		// Failed.
		add_action( 'woocommerce_order_status_completed_to_failed',  array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_processing_to_failed', array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_pending_to_failed',    array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_order_status_on-hold_to_failed',    array( $this, 'revoke_referral' ), 10 );

		// Trashed.
		add_action( 'wc-completed_to_trash',  array( $this, 'revoke_referral' ), 10 );
		add_action( 'wc-pending_to_trash',    array( $this, 'revoke_referral' ), 10 );
		add_action( 'wc-processing_to_trash', array( $this, 'revoke_referral' ), 10 );
		add_action( 'wc-on-hold_to_trash',    array( $this, 'revoke_referral' ), 10 );
		add_action( 'woocommerce_trash_order', array( $this, 'revoke_referral' ), 10 );

		add_filter( 'affwp_referral_reference_column', array( $this, 'reference_link' ), 10, 2 );

		add_action( 'woocommerce_coupon_options', array( $this, 'coupon_option' ) );
		add_action( 'woocommerce_coupon_options_save', array( $this, 'store_discount_affiliate' ) );

		// Per product referral rates.
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'product_tab' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'product_settings' ) );
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_settings' ), 100, 3 );
		add_action( 'save_post', array( $this, 'save_meta' ) );
		add_action( 'woocommerce_ajax_save_product_variations', array( $this, 'save_variation_data' ) );

		add_action( 'affwp_pre_flush_rewrites', array( $this, 'skip_generate_rewrites' ) );

		// Shop page.
		add_action( 'pre_get_posts', array( $this, 'force_shop_page_for_referrals' ), 5 );
		add_action( 'init', array( $this, 'wc_300__product_base_rewrites' ) );

		// Affiliate Area link in My Account menu.
		add_filter( 'woocommerce_account_menu_items', array( $this, 'my_account_affiliate_area_link' ), 100 );
		add_filter( 'woocommerce_get_endpoint_url',   array( $this, 'my_account_endpoint_url' ), 100, 2 );
		add_filter( 'woocommerce_get_settings_account', array( $this, 'account_settings' ) );

		// Per-category referral rates.
		add_action( 'product_cat_add_form_fields', array( $this, 'add_product_category_rate' ), 10, 2 );
		add_action( 'product_cat_edit_form_fields', array( $this, 'edit_product_category_rate' ), 10 );
		add_action( 'edited_product_cat', array( $this, 'save_product_category_rate' ) );
		add_action( 'create_product_cat', array( $this, 'save_product_category_rate' ) );

		if ( true === $this->is_hpos_enabled() ) {

			// HPOS usage is enabled.
			add_filter( 'woocommerce_shop_order_list_table_columns', array( $this, 'add_orders_column' ) );
			add_action( 'woocommerce_shop_order_list_table_custom_column', array( $this, 'render_orders_referral_column' ), 10, 2 );

		} else { // Traditional CPT-based orders are in use.

			// Filter Orders list table to add a referral column.
			add_filter( 'manage_edit-shop_order_columns', array( $this, 'add_orders_column' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'render_orders_referral_column' ), 10, 2 );

		}

		// Per product referral rate types
		add_filter( 'affwp_calc_referral_amount', array( $this, 'calculate_referral_amount_type' ), 10, 5 );

		// Filter Order preview to display referral
		add_filter( 'woocommerce_admin_order_preview_get_order_details', array( $this, 'order_preview_get_referral' ), 10, 2 );
		add_action( 'woocommerce_admin_order_preview_end', array( $this, 'render_order_preview_referral' ) );

		// Integrate AffiliateWP affiliate coupons.
		add_filter( 'woocommerce_get_shop_coupon_data', array( $this, 'maybe_inject_dynamic_coupon' ), 10, 2 );
		add_filter( 'woocommerce_coupon_is_valid', array( $this, 'validate_affiliate_coupon' ), 10, 3 );
	}

	/**
	 * Runs the check necessary to confirm this plugin is active.
	 *
	 * @since 2.5
	 *
	 * @return bool True if the plugin is active, false otherwise.
	 */
	public function plugin_is_active() {
		return class_exists( 'WooCommerce' );
	}

	/**
	 * Determines whether HPOS is in use.
	 *
	 * @since 2.20.0
	 *
	 * @return bool
	 */
	private function is_hpos_enabled() : bool {

		return class_exists( \Automattic\WooCommerce\Utilities\OrderUtil::class )
			&& \Automattic\WooCommerce\Utilities\OrderUtil::custom_orders_table_usage_is_enabled();
	}

	/**
	 * Sets the WooCommerce order.
	 *
	 * @since 2.5
	 *
	 * @param int $order_id The WooCommerce order ID
	 * @return \WC_Order A filtered WooCommerce order object.
	 */
	private function set_order( $order_id ) {
		if ( false === $this->order ) {

			/**
			 * Filters the woocommerce order object.
			 *
			 * @since 2.4.2
			 *
			 * @param \WC_Order $order The WC order object.
			 */
			$this->order = apply_filters( 'affwp_get_woocommerce_order', wc_get_order( $order_id ) );

			if ( ! $this->order instanceof \WC_Order ) {
				$this->order = false;
			}
		}

		return $this->order;
	}

	/**
	 * Store a pending referral when a new order is created
	 *
	 * @access  public
	 * @since   1.0
	 * @since   2.3   Added support for per-order rates
	 * @param int $order_id The order ID to work from.
	 *
	 * @return bool
	 */
	public function add_pending_referral( $order_id = 0 ) {

		$this->set_order( $order_id );

		// Check if an affiliate coupon was used.
		$is_coupon_referral  = false;
		$coupon_affiliate_id = $this->get_coupon_affiliate_id();

		// get affiliate ID.
		$affiliate_id = $this->get_affiliate_id( $order_id );

		if ( false !== $coupon_affiliate_id ) {
			$is_coupon_referral = true;
			$affiliate_id       = intval( $coupon_affiliate_id );
		}

		// Check if it was either referred or a coupon.
		if ( ! $this->was_referred() && ! $coupon_affiliate_id ) {
			return false;
		}

		// Get description.
		$description = $this->get_referral_description();

		// Check for an existing referral.
		$existing = affwp_get_referral_by( 'reference', $order_id, $this->context );

		// Get order email.
		if ( true === version_compare( WC()->version, '3.0.0', '>=' ) ) {
			$this->email = $this->order->get_billing_email();
		} else {
			$this->email = $this->order->billing_email;
		}

		// create draft referral.
		$referral_id = $this->insert_draft_referral(
			$affiliate_id,
			array(
				'reference'          => $order_id,
				'description'        => $description,
				'is_coupon_referral' => $is_coupon_referral,
			)
		);
		if ( ! $referral_id ) {
			$this->log( 'Draft referral creation failed.' );
			return false;
		}

		// Customers cannot refer themselves.
		if ( $this->is_affiliate_email( $this->email, $affiliate_id ) ) {
			$this->log( 'Draft referral rejected because affiliate\'s own account was used.' );
			$this->mark_referral_failed( $referral_id );

			return false;
		}

		// If an existing referral exists and it is paid or unpaid exit.
		if ( ! is_wp_error( $existing ) && ( 'paid' === $existing->status || 'unpaid' === $existing->status ) ) {
			$this->log( 'Draft referral rejected because Completed Referral was already created for this reference.' );
			$this->mark_referral_failed( $referral_id );
			return false; // Completed Referral already created for this reference.
		}

		$cart_discount = true === version_compare( WC()->version, '3.0.0', '>=' ) 
			? $this->order->get_shipping_total() 
			: $this->order->get_total_shipping();


		if ( ! affiliate_wp()->settings->get( 'exclude_tax' ) ) {
			$cart_shipping += $this->order->get_shipping_tax();
		}

		if ( affwp_is_per_order_rate( $affiliate_id ) ) {

			$amount = $this->calculate_referral_amount();

		} else {

			$items = $this->order->get_items();

			// Calculate the referral amount based on product prices.
			$amount = 0.00;

			foreach ( $items as $product ) {

				if ( get_post_meta( $product['product_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
					continue; // Referrals are disabled on this product.
				}

				if ( ! empty( $product['variation_id'] ) && get_post_meta( $product['variation_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
					continue; // Referrals are disabled on this variation.
				}

				// Get the categories associated with the download.
				$categories = get_the_terms( $product['product_id'], 'product_cat' );

				// Get the first category ID for the product.
				$category_id = $categories && ! is_wp_error( $categories ) ? $categories[0]->term_id : 0;

				// The order discount has to be divided across the items.
				$product_total = $product['line_total'];
				$shipping      = 0;

				if ( $cart_shipping > 0 && ! affiliate_wp()->settings->get( 'exclude_shipping' ) ) {
					$shipping       = $cart_shipping / count( $items );
					$product_total += $shipping;
				}

				if ( ! affiliate_wp()->settings->get( 'exclude_tax' ) ) {
					$product_total += $product['line_tax'];
				}

				if ( $product_total <= 0 && 'flat' !== affwp_get_affiliate_rate_type( $affiliate_id ) ) {
					continue;
				}

				$product_id_for_rate = $product['product_id'];

				if ( ! empty( $product['variation_id'] ) && $this->get_product_rate( $product['variation_id'] ) ) {
					$product_id_for_rate = $product['variation_id'];
				}

				$amount += $this->calculate_referral_amount( $product_total, $order_id, $product_id_for_rate, $affiliate_id, $category_id );
			}
		}

		/**
		 * Filters the referral amount immediately after WooCommerce calculations have completed.
		 *
		 * @since 2.4.4
		 *
		 * @param float                     $amount       Calculated referral amount.
		 * @param int                       $order_id     Order ID (reference)
		 * @param int                       $affiliate_id Affiliate ID.
		 * @param \Affiliate_WP_WooCommerce $this         WooCommerce integration class instance.
		 */
		$amount = apply_filters( 'affwp_woocommerce_add_pending_referral_amount', $amount, $order_id, $affiliate_id, $this );

		if ( 0 == $amount && affiliate_wp()->settings->get( 'ignore_zero_referrals' ) ) {
			$this->log( 'Draft referral failed due to 0.00 amount and ignore_zero_referrals setting.' );
			$this->mark_referral_failed( $referral_id );

			return false; // Ignore a zero amount referral.
		}

		if ( empty( $description ) ) {
			$this->log( 'Draft referral failed due to empty description.' );
			$this->mark_referral_failed( $referral_id );

			return;
		}

		$visit_id = affiliate_wp()->tracking->get_visit_id();

		// Hydrates the previously created referral.
		$this->hydrate_referral(
			$referral_id,
			array(
				'status'      => 'pending',
				'amount'      => $amount,
				'visit_id'    => $visit_id,
				'order_total' => $this->get_order_total(),
				'products'    => $this->get_products( $order_id ),
			)
		);

		$this->log( sprintf( 'WooCommerce referral #%d updated successfully.', $referral_id ) );
	}

	/**
	 * Store a pending referral when a new order is created via WooCommerce checkout block.
	 *
	 * @since 2.9.4
	 *
	 * @param \WC_Order $order WooCommerce order object.
	 * @return void
	 */
	public function add_pending_referral_checkout_block( $order ) {

		if ( 'checkout-draft' !== $order->get_status() ) {
			return;
		}

		if ( 'store-api' !== $order->get_created_via() ) {
			return;
		}

		$this->add_pending_referral( $order->get_id() );
	}

	/**
	 * Adds a note to an order if an associated referral's amount is updated.
	 *
	 * @since 2.1.9
	 *
	 * @param \AffWP\Referral $updated_referral Updated referral object.
	 * @param \AffWP\Referral $referral         Old referral object.
	 * @param bool            $update           Whether the referral was successfully updated.
	 */
	public function updated_referral_note( $updated_referral, $referral, $updated ) {

		if ( $updated && 'woocommerce' === $updated_referral->context && ! empty( $updated_referral->reference ) ) {

			$order = wc_get_order( $updated_referral->reference );

			if ( false !== $order && $updated_referral->amount != $referral->amount ) {

				$amount        = affwp_currency_filter( affwp_format_amount( $updated_referral->amount ) );
				$name          = affiliate_wp()->affiliates->get_affiliate_name( $updated_referral->affiliate_id );
				$referral_link = affwp_admin_link( 'referrals', esc_html( '#' . $updated_referral->ID ), array( 'action' => 'edit_referral', 'referral_id' => $updated_referral->ID ) );

				/* translators: 1: Referral link, 2: Amount, 3: Affiliate Name */
				$order->add_order_note( sprintf( __( 'Referral %1$s updated. Amount %2$s recorded for %3$s', 'affiliate-wp' ),
					$referral_link,
					$amount,
					$name
				) );

			}

		}

	}

	/**
	 * Retrieves the order total from the order.
	 *
	 * @access public
	 * @since  2.5
	 *
	 * @param int $order the order number. If this isn't specified, it will use the order object that's already set.
	 * @return float The order total for the current integration.
	 */
	public function get_order_total( $order = 0 ) {
		if ( $order > 0 ) {
			$this->set_order( $order );
		}

		if ( $this->order instanceof \WC_Order ) {
			$order_total = $this->order->get_total();
		} else {
			$order_total = 0;
		}

		return $order_total;
	}

	/**
	 * Retrieves the product details array for the referral
	 *
	 * @access  public
	 * @since   1.6
	 * @return  array
	*/
	public function get_products( $order_id = 0 ) {

		$products  = array();
		$items     = $this->order->get_items();
		foreach( $items as $key => $product ) {

			if( get_post_meta( $product['product_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
				continue; // Referrals are disabled on this product
			}


			if( ! empty( $product['variation_id'] ) && get_post_meta( $product['variation_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
				continue; // Referrals are disabled on this variation
			}

			if( ! affiliate_wp()->settings->get( 'exclude_tax' ) ) {
				$amount = $product['line_total'] + $product['line_tax'];
			} else {
				$amount = $product['line_total'];
			}

			if( ! empty( $product['variation_id'] ) ) {
				/* translators: Variation ID */
				$product['name'] .= ' ' . sprintf( __( '(Variation ID %d)', 'affiliate-wp' ), $product['variation_id'] );
			}

			// Get the categories associated with the download.
			$categories = get_the_terms( $product['product_id'], 'product_cat' );

			// Get the first category ID for the product.
			$category_id = $categories && ! is_wp_error( $categories ) ? $categories[0]->term_id : 0;

			/**
			 * Filters an individual WooCommerce products line as stored in the referral record.
			 *
			 * @since 1.9.5
			 *
			 * @param array $line {
			 *     A WooCommerce product data line.
			 *
			 *     @type string $name            Product name.
			 *     @type int    $id              Product ID.
			 *     @type float  $amount          Product amount.
			 *     @type float  $referral_amount Referral amount.
			 * }
			 * @param array $product  Product data.
			 * @param int   $order_id Order ID.
			 */
			$products[] = apply_filters( 'affwp_woocommerce_get_products_line', array(
				'name'            => $product['name'],
				'id'              => $product['product_id'],
				'price'           => $amount,
				'referral_amount' => $this->calculate_referral_amount( $amount, $order_id, empty( $product['variation_id'] ) ? $product['product_id'] : $product['variation_id'], 0, $category_id )
			), $product, $order_id );

		}

		return $products;

	}

	/**
	 * Retrieves the customer details for an order.
	 *
	 * @since 2.2
	 *
	 * @param int $order_id The ID of the order to retrieve customer details for.
	 * @return array An array of the customer details
	 */
	public function get_customer( $order_id = 0 ) {

		$customer = array();

		if ( function_exists( 'wc_get_order' ) ) {

			$order = wc_get_order( $order_id );

			if ( $order ) {

				if ( true === version_compare( WC()->version, '3.0.0', '>=' ) ) {
					$email      = $order->get_billing_email();
					$first_name = $order->get_billing_first_name();
					$last_name  = $order->get_billing_last_name();
					$ip         = $order->get_customer_ip_address();
				} else {
					$email      = $order->billing_email;
					$first_name = $order->billing_first_name;
					$last_name  = $order->billing_last_name;
					$ip         = $order->customer_ip_address;
				}

				$customer['user_id']    = $order->get_user_id();
				$customer['email']      = $email;
				$customer['first_name'] = $first_name;
				$customer['last_name']  = $last_name;
				$customer['ip']         = $ip;

			}
		}

		return $customer;
	}

	/**
	 * Marks a referral as complete when payment is completed.
	 *
	 * @since 1.0
	 * @since 2.0 Orders that are COD and transitioning from `wc-processing` to `wc-complete` stati are now able to be completed.
	 * @access public
	 */
	public function mark_referral_complete( $order_id = 0 ) {

		$this->set_order( $order_id );

		if ( true === version_compare( WC()->version, '3.0.0', '>=' ) ) {
			$payment_method = $this->order->get_payment_method();
		} else {
			$payment_method = get_post_meta( $order_id, '_payment_method', true );
		}

		// If the WC status is 'wc-processing' and a COD order, leave as 'pending'.
		if ( 'wc-processing' == $this->order->get_status() && 'cod' === $payment_method ) {
			return;
		}

		$this->complete_referral( $order_id );
	}

	/**
	 * Revoke the referral associated with the given order ID
	 *
	 * @since 2.1
	 * @since 2.20.0 Added support for HPOS.
	*/
	public function revoke_referral( $order_id = 0 ) {

		// Bail if not a shop order.
		if ( true === $this->is_hpos_enabled() ) {

			$order_id = is_object( $order_id ) ? $order_id->get_id() : $order_id;

			if ( 'shop_order' !== OrderUtil::get_order_type( $order_id ) ) {
				return;
			}

		} else {

			$order_id = is_a( $order_id, 'WP_Post' ) ? $order_id->ID : $order_id;

			// Without HPOS, get the post type.
			if ( 'shop_order' !== get_post_type( $order_id ) ) {
				return;
			}

		}

		$this->reject_referral( $order_id, true );

	}

	/**
	 * Revoke the referral when the order is refunded
	 *
	 * @access  public
	 * @since   1.0
	*/
	public function revoke_referral_on_refund( $order_id = 0 ) {

		if( ! affiliate_wp()->settings->get( 'revoke_on_refund' ) ) {
			return;
		}

		$this->revoke_referral( $order_id );

	}

	/**
	 * Sets up the reference link.
	 *
	 * @since 1.0
	 * @since 2.20.0 Added support for HPOS.
	 *
	 * @param int             $reference Referral reference (order number).
	 * @param \AffWP\Referral $referral  Current referral object.
	 * @return int|string Unchanged reference value if there's nothing to link, otherwise link
	 *                    markup pointing to the edit screen for the order.
	*/
	public function reference_link( $reference, $referral ) {

		if( empty( $referral->context ) || 'woocommerce' != $referral->context ) {

			return $reference;

		}

		$url = ( true === $this->is_hpos_enabled() )
			? admin_url( sprintf( 'admin.php?page=wc-orders&action=edit&id=%s', $reference ) )
			: get_edit_post_link( $reference );

		$reference = $this->parse_reference( $reference );

		return sprintf( '<a href="%1$s">%2$s</a>', esc_url( $url ), $reference );
	}

	/**
	 * Parses the WooCommerce referral reference, as derived from get_order_number().
	 *
	 * @since 2.3
	 *
	 * @param int $reference Reference.
	 * @return int Derived reference or 0.
	 */
	public function parse_reference( $reference ) {

		if ( function_exists( 'wc_get_order' ) ) {
			$order = wc_get_order( $reference );

			$reference = is_a( $order, 'WC_Order' ) ? $order->get_order_number() : $reference;

		}

		return $reference;
	}

	/**
	 * Shows the affiliate drop down on the discount edit / add screens
	 *
	 * @access  public
	 * @since   1.1
	*/
	public function coupon_option() {

		global $post;

		add_filter( 'affwp_is_admin_page', '__return_true' );
		affwp_admin_scripts();

		$user_name    = '';
		$user_id      = '';
		$affiliate_id = get_post_meta( $post->ID, 'affwp_discount_affiliate', true );
		if( $affiliate_id ) {
			$user_id      = affwp_get_affiliate_user_id( $affiliate_id );
			$user         = get_userdata( $user_id );
			$user_name    = $user ? $user->user_login : '';
		}
		$template_id = affiliate_wp()->settings->get( 'coupon_template_woocommerce', 0 );
?>
		<p class="form-field affwp-woo-coupon-field">
			<label for="user_name"><?php _e( 'Affiliate discount?', 'affiliate-wp' ); ?></label>
			<span class="affwp-ajax-search-wrap">
				<span class="affwp-woo-coupon-input-wrap">
					<?php
						echo wc_help_tip( __( 'If you would like to connect this discount to an affiliate, enter the name of the affiliate it belongs to.', 'affiliate-wp' ) );
					?>
					<input type="text" name="user_name" id="user_name" <?php disabled( (int) $post->ID, (int) $template_id ); ?> value="<?php echo esc_attr( $user_name ); ?>" class="affwp-user-search" data-affwp-status="active" autocomplete="off" />
				</span>
			</span>
			<?php if ( (int) $post->ID === (int) $template_id ) : ?>
				<br />
				<span class="howto">
				<?php
					/* translators: Coupons settings URL */
					printf( __( 'This setting is disabled because this coupon is designated as a dynamic coupon template. Visit <a href="%s" target="_blank">Settings &rarr; Coupons</a> to configure dynamic coupons.', 'affiliate-wp' ), esc_url( affwp_admin_url( 'settings', array( 'tab' => 'coupons' ) ) ) );
				?>
				</span>
			<?php endif; ?>
		</p>
<?php
	}

	/**
	 * Stores the affiliate ID in the discounts meta if it is an affiliate's discount
	 *
	 * @access  public
	 * @since   1.1
	*/
	public function store_discount_affiliate( $coupon_id = 0 ) {

		if( empty( $_POST['user_name'] ) ) {

			delete_post_meta( $coupon_id, 'affwp_discount_affiliate' );
			return;

		}

		if( empty( $_POST['user_id'] ) && empty( $_POST['user_name'] ) ) {
			return;
		}

		$data = affiliate_wp()->utils->process_request_data( $_POST, 'user_name' );

		$affiliate_id = affwp_get_affiliate_id( $data['user_id'] );

		update_post_meta( $coupon_id, 'affwp_discount_affiliate', $affiliate_id );
	}

	/**
	 * Retrieve the affiliate ID for the coupon used, if any
	 *
	 * @access  public
	 * @since   1.1
	*/
	private function get_coupon_affiliate_id() {

		if ( version_compare( WC()->version, '3.7.0', '>=' ) ) {
			$coupons = $this->order->get_coupon_codes();
		} else {
			$coupons = $this->order->get_used_coupons();
		}

		$affiliate_id = false;

		if ( empty( $coupons ) ) {
			return $affiliate_id;
		}

		foreach ( $coupons as $code ) {
			$coupon = new WC_Coupon( $code );

			if ( true === version_compare( WC()->version, '3.0.0', '>=' ) ) {
				$coupon_id = $coupon->get_id();
			} else {
				$coupon_id = $coupon->id;
			}

			$coupon_affiliate_id = get_post_meta( $coupon_id, 'affwp_discount_affiliate', true );

			// Check for global affiliate coupon.
			if ( empty( $coupon_affiliate_id ) ) {
				$coupon = affwp_get_coupon_by( 'coupon_code', $code );

				if ( isset( $coupon->affiliate_id ) ) {
					$affiliate_id = $coupon->affiliate_id;
				}
			} else {
				$affiliate_id = $coupon_affiliate_id;
			}

			if ( ! affiliate_wp()->tracking->is_valid_affiliate( $affiliate_id ) ) {
				continue;
			}

		}

		return $affiliate_id;
	}

	/**
	 * Retrieves the referral description
	 *
	 * @access  public
	 * @since   1.1
	*/
	public function get_referral_description() {

		$items       = $this->order->get_items();
		$description = array();

		foreach ( $items as $key => $item ) {

			if ( get_post_meta( $item['product_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
				continue; // Referrals are disabled on this product
			}

			if( ! empty( $item['variation_id'] ) && get_post_meta( $item['variation_id'], '_affwp_' . $this->context . '_referrals_disabled', true ) ) {
				continue; // Referrals are disabled on this variation
			}

			if( ! empty( $item['variation_id'] ) ) {
				/* translators: Variation ID */
				$item['name'] .= ' ' . sprintf( __( '(Variation ID %d)', 'affiliate-wp' ), $item['variation_id'] );
			}

			$description[] = $item['name'];

		}

		$description = implode( ', ', $description );

		return $description;

	}

	/**
	 * Register the product settings tab
	 *
	 * @access  public
	 * @since   1.8.6
	*/
	public function product_tab( $tabs ) {

		$tabs['affiliate_wp'] = array(
			'label'  => __( 'AffiliateWP', 'affiliate-wp' ),
			'target' => 'affwp_product_settings',
			'class'  => array( ),
		);

		return $tabs;

	}

	/**
	 * Adds per-product referral rate settings input fields
	 *
	 * @access  public
	 * @since   1.2
	*/
	public function product_settings() {

		global $post;

?>
		<div id="affwp_product_settings" class="panel woocommerce_options_panel">

			<div class="options_group">
				<?php if ( ! affwp_is_per_order_rate() ): ?>
					<p><?php _e( 'Configure affiliate rates for this product. These settings will be used to calculate affiliate earnings per-sale.', 'affiliate-wp' ); ?></p>
					<?php
					woocommerce_wp_select( array(
							'id'          => '_affwp_woocommerce_product_rate_type',
							'label'       => __( 'Affiliate Rate Type', 'affiliate-wp' ),
							'options'     => array_merge( array( '' => __( 'Site Default', 'affiliate-wp' ) ), affwp_get_affiliate_rate_types() ),
							'desc_tip'    => true,
							'description' => __( 'Earnings can be based on either a percentage or a flat rate amount.', 'affiliate-wp' ),
					) );
					woocommerce_wp_text_input( array(
							'id'          => '_affwp_woocommerce_product_rate',
							'label'       => __( 'Affiliate Rate', 'affiliate-wp' ),
							'desc_tip'    => true,
							'description' => __( 'Leave blank to use default affiliate rates.', 'affiliate-wp' ),
					) );
				else: ?>
					<p>
						<em>
							<?php _e( sprintf( 'Per-product rates are disabled because the flat rate referral basis is set to per order. You can change that in <a href="%s">Affiliates > Settings</a>.', affwp_admin_url( 'settings' ) ), 'affiliate-wp' ); ?>
						</em>
					</p>
				<?php
				endif;
				woocommerce_wp_checkbox( array(
					'id'          => '_affwp_woocommerce_referrals_disabled',
					'label'       => __( 'Disable referrals', 'affiliate-wp' ),
					'description' => __( 'This will prevent this product from generating referral commissions for affiliates.', 'affiliate-wp' ),
					'cbvalue'     => 1
				) );

				wp_nonce_field( 'affwp_woo_product_nonce', 'affwp_woo_product_nonce' );
?>
			</div>

			<?php

				/**
				 * Fires at the bottom of the AffiliateWP product tab in WooCommerce.
				 *
				 * Use this hook to register extra product based settings to AffiliateWP product tab in WooCommerce.
				 *
				 * @since 2.2.9
				 */
				do_action( 'affwp_' . $this->context . '_product_settings' );

			?>

		</div>
<?php

	}

	/**
	 * Adds per-product variation referral rate settings input fields
	 *
	 * @access  public
	 * @since   1.9
	*/
	public function variation_settings( $loop, $variation_data, $variation ) {

		$rate      = $this->get_product_rate( $variation->ID );
		$rate_type = get_post_meta( $variation->ID, '_affwp_' . $this->context . '_product_rate_type', true );
		$disabled  = get_post_meta( $variation->ID, '_affwp_woocommerce_referrals_disabled', true );
?>

		<div id="affwp_product_variation_settings">

			<p class="form-row form-row-full">
				<?php _e( 'Configure affiliate rates for this product variation', 'affiliate-wp' ); ?>
			</p>

			<p class="form-row form-row-full">
				<label for="_affwp_woocommerce_variation_rate_types[<?php echo $variation->ID; ?>]"><?php echo __( 'Referral Rate Type', 'affiliate-wp' ); ?></label>
				<select name="_affwp_woocommerce_variation_rate_types[<?php echo $variation->ID; ?>]" id="_affwp_woocommerce_variation_rate_types[<?php echo $variation->ID; ?>]">
					<option value=""><?php _e( 'Site Default', 'affiliate-wp' ); ?></option>
					<?php foreach( affwp_get_affiliate_rate_types() as $key => $type ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $rate_type, $key ); ?>><?php echo esc_html( $type ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p class="form-row form-row-full">
				<label for="_affwp_woocommerce_variation_rates[<?php echo $variation->ID; ?>]"><?php echo __( 'Referral Rate', 'affiliate-wp' ); ?></label>
				<input type="text" size="5" name="_affwp_woocommerce_variation_rates[<?php echo $variation->ID; ?>]" value="<?php echo esc_attr( $rate ); ?>" class="wc_input_price" id="_affwp_woocommerce_variation_rates[<?php echo $variation->ID; ?>]" placeholder="<?php esc_attr_e( 'Referral rate (optional)', 'affiliate-wp' ); ?>" />
			</p>

			<p class="form-row form-row-full options">
				<label for="_affwp_woocommerce_variation_referrals_disabled[<?php echo $variation->ID; ?>]">
					<input type="checkbox" class="checkbox" name="_affwp_woocommerce_variation_referrals_disabled[<?php echo $variation->ID; ?>]" id="_affwp_woocommerce_variation_referrals_disabled[<?php echo $variation->ID; ?>]" <?php checked( $disabled, true ); ?> /> <?php _e( 'Disable referrals for this product variation', 'affiliate-wp' ); ?>
				</label>
			</p>

		</div>

		<?php

			/**
			 * Fires after the affiliate rates section in a WooCommerce product variation.
			 *
			 * Use this hook to register extra variation product based settings in WooCommerce.
			 *
			 * @since 2.2.9
			 *
			 * @param int     $loop
			 * @param array   $variation_data
			 * @param WP_Post $variation
			 */
			do_action( 'affwp_' . $this->context . '_variation_settings', $loop, $variation_data, $variation );

		?>

<?php

	}

	/**
	 * Saves per-product referral rate settings input fields
	 *
	 * @access  public
	 * @since   1.2
	*/
	public function save_meta( $post_id = 0 ) {

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Don't save revisions and autosaves
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return $post_id;
		}

		if( empty( $_POST['affwp_woo_product_nonce'] ) || ! wp_verify_nonce( $_POST['affwp_woo_product_nonce'], 'affwp_woo_product_nonce' ) ) {
			return $post_id;
		}

		$post = get_post( $post_id );

		if( ! $post ) {
			return $post_id;
		}

		// Check post type is product
		if ( 'product' != $post->post_type ) {
			return $post_id;
		}

		// Check user permission
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if( ! empty( $_POST['_affwp_' . $this->context . '_product_rate'] ) ) {

			$rate = sanitize_text_field( $_POST['_affwp_' . $this->context . '_product_rate'] );
			update_post_meta( $post_id, '_affwp_' . $this->context . '_product_rate', $rate );

		} else {

			delete_post_meta( $post_id, '_affwp_' . $this->context . '_product_rate' );

		}

		if( ! empty( $_POST['_affwp_' . $this->context . '_product_rate_type'] ) ) {

			$rate_type = sanitize_text_field( $_POST['_affwp_' . $this->context . '_product_rate_type'] );
			update_post_meta( $post_id, '_affwp_' . $this->context . '_product_rate_type', $rate_type );

		} else {

			delete_post_meta( $post_id, '_affwp_' . $this->context . '_product_rate_type' );

		}

		$this->save_variation_data( $post_id );

		if( isset( $_POST['_affwp_' . $this->context . '_referrals_disabled'] ) ) {

			update_post_meta( $post_id, '_affwp_' . $this->context . '_referrals_disabled', 1 );

		} else {

			delete_post_meta( $post_id, '_affwp_' . $this->context . '_referrals_disabled' );

		}

	}

	/**
	 * Saves variation data
	 *
	 * @access  public
	 * @since   1.9
	*/
	public function save_variation_data( $product_id = 0 ) {

		if( ! empty( $_POST['variable_post_id'] ) && is_array( $_POST['variable_post_id'] ) ) {

			foreach( $_POST['variable_post_id'] as $variation_id ) {

				$variation_id = absint( $variation_id );

				if( ! empty( $_POST['_affwp_woocommerce_variation_rates'] ) && ! empty( $_POST['_affwp_woocommerce_variation_rates'][ $variation_id ] ) ) {

					$rate = sanitize_text_field( $_POST['_affwp_woocommerce_variation_rates'][ $variation_id ] );
					update_post_meta( $variation_id, '_affwp_' . $this->context . '_product_rate', $rate );

				} else {

					delete_post_meta( $variation_id, '_affwp_' . $this->context . '_product_rate' );

				}

				if( ! empty( $_POST['_affwp_woocommerce_variation_rate_types'] ) && ! empty( $_POST['_affwp_woocommerce_variation_rate_types'][ $variation_id ] ) ) {

					$rate_type = sanitize_text_field( $_POST['_affwp_woocommerce_variation_rate_types'][ $variation_id ] );
					update_post_meta( $variation_id, '_affwp_' . $this->context . '_product_rate_type', $rate_type );

				} else {

					delete_post_meta( $variation_id, '_affwp_' . $this->context . '_product_rate_type' );

				}

				if( ! empty( $_POST['_affwp_woocommerce_variation_referrals_disabled'] ) && ! empty( $_POST['_affwp_woocommerce_variation_referrals_disabled'][ $variation_id ] ) ) {

					update_post_meta( $variation_id, '_affwp_' . $this->context . '_referrals_disabled', 1 );

				} else {

					delete_post_meta( $variation_id, '_affwp_' . $this->context . '_referrals_disabled' );

				}
			}
		}
	}

	/**
	 * Is a Product ID in a WooCommerce Order?
	 *
	 * @since 2.20.0
	 *
	 * @param int $product_id The variation ID.
	 * @param int $order      The Order ID (Reference).
	 *
	 * @return bool
	 */
	private function product_id_is_in_order( $product_id, $order ) : bool {

		return in_array(
			intval( $product_id ),
			array_filter(
				array_map(

					// Get all the ID's from each Product (object) into an array.
					function( $product ) {

						if ( ! is_a( $product, '\WC_Order_Item' ) ) {
							return 0;
						}

						return intval( $product->get_product_id() ?? 0 );
					},

					// The list of products in the order (objects).
					$order->get_items() ?? array()
				),

				// Filter out any invalid products with ID 0 from array_map().
				function ( $product_id ) {
					return is_numeric( $product_id ) && intval( $product_id ) > 0;
				}
			),
			true
		);
	}

	/**
	 * Is a Variation ID in a WooCommerce Order?
	 *
	 * @since 2.20.0
	 *
	 * @param int $variation_id The variation ID.
	 * @param int $order The Order ID (Reference).
	 *
	 * @return bool
	 */
	private function variation_id_is_in_order( $variation_id, $order ) : bool {

		return in_array(
			intval( $variation_id ),
			array_filter(
				array_map(

					function( $product ) {

						if ( ! is_a( $product, '\WC_Order_Item' ) ) {
							return 0;
						}

						return intval( $product->get_variation_id() ?? 0 );
					},

					// The list of products in the order (objects).
					$order->get_items() ?? array()
				),

				// Filter out any invalid products with ID 0 from array_map().
				function ( $variation_id ) {
					return is_numeric( $variation_id ) && intval( $variation_id ) > 0;
				}
			),
			true
		);
	}

	/**
	 * Is a Product (ID) & Order (Reference) from WooCommerce?
	 *
	 * @since 2.20.0
	 *
	 * @param int $product_id_or_variation_id The Product ID (that should be in the order).
	 * @param int $order_id                   The Order ID (Reference).
	 *
	 * @return bool True if the order and product are in WooCommerce (and the product is in the order).
	 */
	private function is_in_woo_order( $product_id_or_variation_id, $order_id ) : bool {

		if ( ! is_numeric( $order_id ) || ! is_numeric( $product_id_or_variation_id ) ) {
			return false; // The order and product ID's need to be numeric.
		}

		if ( ! function_exists( 'wc_get_order' ) ) {
			return false;
		}

		$order = wc_get_order( intval( $order_id ) ); // Can be an Order object or false.

		if ( ! is_a( $order, '\WC_Order' ) ) {
			return false;
		}

		return $this->product_id_is_in_order( $product_id_or_variation_id, $order ) ||
			$this->variation_id_is_in_order( $product_id_or_variation_id, $order );
	}

	/**
	 * Calculate new referral amount based on product rate type
	 *
	 * @access  public
	 * @since   2.1.15
	*/
	public function calculate_referral_amount_type( $referral_amount, $affiliate_id, $amount, $reference, $product_id ) {

		if ( ! $this->is_in_woo_order( $product_id, $reference ) ) {
			return $referral_amount; // The product is not in a WooCommerce order.
		}

		// Check if the current referral amount is from an affiliate rate.
		$affiliate_rate = affiliate_wp()->affiliates->get_column( 'rate', $affiliate_id );
		$affiliate_rate = affwp_abs_number_round( $affiliate_rate );
		if ( null !== $affiliate_rate ) {
			return $referral_amount;
		}

		$rate = '';

		if ( ! empty( $product_id ) ) {
			$rate = $this->get_product_rate( $product_id, $args = array( 'reference' => $reference, 'affiliate_id' => $affiliate_id ) );
		}

		if ( ! is_numeric( $rate ) ) {
			// Global referral rate setting, fallback to 20
			$default_rate = affiliate_wp()->settings->get( 'referral_rate', 20 );
			$rate = affwp_abs_number_round( $default_rate );
		}

		$type = get_post_meta( $product_id, '_affwp_' . $this->context . '_product_rate_type', true );

		if ( $type ) {

			$decimals = affwp_get_decimal_count();

			// Format percentage rates
			$rate = ( 'percentage' === $type ) ? $rate / 100 : $rate;

			$referral_amount = ( 'percentage' === $type ) ? round( $amount * $rate, $decimals ) : $rate;

		}

		return $referral_amount;
	}

	/**
	 * Prevent WooCommerce from fixing rewrite rules when AffiliateWP runs affiliate_wp()->rewrites->flush_rewrites()
	 *
	 * See https://github.com/affiliatewp/AffiliateWP/issues/919
	 *
	 * @access  public
	 * @since   1.7.8
	*/
	public function skip_generate_rewrites() {
		remove_filter( 'rewrite_rules_array', 'wc_fix_rewrite_rules', 10 );
	}

	/**
	 * Forces the WC shop page to recognize it as such, even when accessed via a referral URL.
	 *
	 * @since 1.8
	 * @access public
	 *
	 * @param WP_Query $query Current query.
	 */
	public function force_shop_page_for_referrals( $query ) {
		if ( ! $query->is_main_query() ) {
			return;
		}

		if ( function_exists( 'wc_get_page_id' ) ) {
			$ref = affiliate_wp()->tracking->get_referral_var();

			if ( ( isset( $query->queried_object_id ) && wc_get_page_id( 'shop' ) == $query->queried_object_id )
				&& ! empty( $query->query_vars[ $ref ] )
			) {
				// Force WC to recognize that this is the shop page.
				$GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
			}
		}
	}

	/**
	 * Sets up verbose rewrites for the product base in conjunction with pretty affiliate URLs.
	 *
	 * @access public
	 * @since  2.0.9
	 *
	 * @see wc_get_permalink_structure()
	 */
	public function wc_300__product_base_rewrites() {

		if ( $shop_page_id = wc_get_page_id( 'shop' ) ) {

			$uri = get_page_uri( $shop_page_id );
			$ref = affiliate_wp()->tracking->get_referral_var();

			add_rewrite_rule( $uri . '/' . $ref . '(/(.*))?/?$', 'index.php?post_type=product&' . $ref . '=$matches[2]', 'top' );
		}
	}

	/**
	 * Strips pretty referral bits from pagination links on the Shop page.
	 *
	 * @since 1.8
	 * @since 1.8.1 Skipped for product taxonomies and searches
	 * @deprecated 1.8.3
	 * @see Affiliate_WP_Tracking::strip_referral_from_paged_urls()
	 * @access public
	 *
	 * @param string $link Pagination link.
	 * @return string (Maybe) filtered pagination link.
	 */
	public function strip_referral_from_paged_urls( $link ) {
		return affiliate_wp()->tracking->strip_referral_from_paged_urls( $link );
	}

	/**
	 * Inserts a link to the Affiliate Area in the My Account menu.
	 *
	 * @access public
	 * @since  2.0.5
	 *
	 * @param array $items My Account menu items.
	 * @return array (Maybe) modified menu items.
	 */
	public function my_account_affiliate_area_link( $items ) {

		// Only add the link if enabled in WooCommerce > Settings > Accounts settings.
		if ( 'yes' !== get_option( 'affwp_woocommerce_affiliate_area_link' ) ) {
			return $items;
		}

		if ( affwp_is_affiliate() ) {

			$affiliate_area_page = affwp_get_affiliate_area_page_id();

			if ( $affiliate_area_page ) {

				/**
				 * Filters the title used for the Affiliate Area page in the WooCommerce My Account navigation.
				 *
				 * The page title is used by default.
				 *
				 * @since 2.1
				 *
				 * @param string $title               Affiliate Area page title.
				 * @param int    $affiliate_area_page Affiliate Area page ID.
				 */
				$title = apply_filters( 'affwp_woocommerce_affiliate_area_title', get_the_title( $affiliate_area_page ), $affiliate_area_page );

				/*
				 * Normally this would be $slug => $title, but we're going to intercept the 'affiliate-area'
				 * value directly when overriding the endpoint URL in the 'woocommerce_get_endpoint_url' hook.
				 */
				$affiliate_area = array( 'affiliate-area' => $title );

				$last_link = array();

				if ( array_key_exists( 'customer-logout', $items ) ) {

					// Grab the last link (probably the logout link).
					$last_link = array_slice( $items, count( $items ) - 1, 1, true );

					// Pop the last link off the end.
					array_pop( $items );

				}

				// Inject the Affiliate Area link 2nd to last, reinserting the last link.
				$items = array_merge( $items, $affiliate_area, $last_link );
			}

		}

		return $items;

	}

	/**
	 * Overrides the WooCommerce My Account endpoint URL for the affiliate area link.
	 *
	 * @access public
	 * @since  2.1.3
	 *
	 * @param string $url      My Account endpoint URL.
	 * @param string $endpoint Endpoint slug.
	 * @return string (Maybe) filtered endpoint URL.
	 */
	public function my_account_endpoint_url( $url, $endpoint ) {
		if ( 'affiliate-area' === $endpoint ) {
			$url = affwp_get_affiliate_area_page_url();
		}

		return $url;
	}

	/**
	 * Gets the total order count for this integration.
	 *
	 * @since 2.5
	 *
	 * @param string|array $date {
	 *     Optional. Date string or start/end range to retrieve orders for. Default empty.
	 *
	 *     @type string $start Start date to retrieve orders for.
	 *     @type string $end   End date to retrieve orders for.
	 * }
	 * @return int|false Total order count, otherwise false.
	 */
	public function get_total_order_count( $date = '' ) {

		if ( true === version_compare( WC()->version, '4.0.0', '>=' ) ) {

			require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-admin-report.php' );
			require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-report-sales-by-date.php' );

			$report             = new \WC_Report_Sales_By_Date();
			$date               = parent::prepare_date_range( $date );
			$report->start_date = strtotime( $date['start'] );
			$report->end_date   = strtotime( $date['end'] );

			$data = $report->get_order_report_data( array(
				'data'         => array(
					'ID' => array(
						'type'     => 'post_data',
						'function' => 'COUNT',
						'name'     => 'count',
						'distinct' => true,
					),
				),
				'filter_range' => true,
				'order_status' => array( 'completed' ),
			) );

			$order_count = $data->count;
		} else {
			$args = array(
				'limit'        => -1,
				'status'       => 'wc-completed',
				'fields'       => 'ids',
				'return'       => 'ids',
				'date_created' => $this->prepare_date_range( $date ),
			);

			$query = new \WC_Order_Query( $args );

			try {
				$order_count = count( $query->get_orders() );
			} catch( Exception $e ) {
				$this->log( 'An error occurred while getting the WooCommerce order count.' . $e->getMessage() );
				$order_count = false;
			}
		}

		return (int) $order_count;
	}

	/**
	 * Gets the total sales for this integration.
	 *
	 * @since 2.5
	 * @since 2.5.5 Refactored this query to leverage WooCommerce's reporting API if using WooCommerce 4.0 or higher.
	 *
	 * @param string|array $date  {
	 *     Optional. Date string or start/end range to retrieve orders for. Default empty.
	 *
	 *     @type string $start Start date to retrieve orders for.
	 *     @type string $end   End date to retrieve orders for.
	 * }
	 * @return float|int The total sales values for the specified date range.
	 */
	public function get_total_sales( $date = '' ) {
		// Leverage the faster option, if using Woo 4.0 or up.
		if ( true === version_compare( WC()->version, '4.0.0', '>=' ) ) {

			require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-admin-report.php' );
			require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-report-sales-by-date.php' );

			$report             = new \WC_Report_Sales_By_Date();
			$date               = parent::prepare_date_range( $date );
			$report->start_date = strtotime( $date['start'] );
			$report->end_date   = strtotime( $date['end'] );

			$data = $report->get_order_report_data( array(
				'data'         => array(
					'_order_total' => array(
						'type'     => 'meta',
						'function' => 'SUM',
						'name'     => 'total_sales',
					),
				),
				'filter_range' => true,
				'order_status' => array( 'completed' ),
			) );

			$total_sales = (float) $data->total_sales;
		} else {
			$total_sales = 0;

			$args = array(
				'limit'        => 300,
				'return'       => 'ids',
				'fields'       => 'ids',
				'status'       => 'wc-completed',
				'offset'       => 0,
				'date_created' => $this->prepare_date_range( $date ),
			);

			// Repeat until the previous query did not find any orders.
			do {

				$query = new \WC_Order_Query( $args );

				try {
					// Retrieve the array of order IDs.
					$orders = $query->get_orders();
					foreach ( $orders as $order_id ) {

						// Get the order. This allows us to get the total.
						$order = wc_get_order( $order_id );

						// If nothing went wrong, add the order total to the total sales.
						if ( false !== $order ) {
							$total_sales += $order->get_total();
						}
					}

					/*
					 * Increase our offset for the next time this query runs.
					 *
					 * Eventually, this number gets larger than the number of items in the database.
					 * This causes orders to be an empty array, which ends the while loop.
					 */
					$args['offset'] += count( $orders );
				} catch ( Exception $e ) {

					$this->log( 'An error occurred while getting the WooCommerce sales totals.' . $e->getMessage() );

					// Set total sales to false
					$total_sales = false;

					// Bail out of the loop
					break;
				}
			} while ( is_array( $orders ) && count( $orders ) !== 0 );
		}

		return $total_sales;
	}

	/**
	 * Prepares a date range to be accepted by the current integration.
	 *
	 * Most integrations accept a date range in a specific format. Often this format differs from AffiliateWP.
	 * This method provides a way to convert an AffiliateWP date range into the integration date range.
	 *
	 * @since 2.5
	 *
	 * @param array|string $date_range The AffiliateWP date range, or an empty value.
	 * @return string The date range, formatted for the current integration.
	 */
	public function prepare_date_range( $date_range ) {
		$date_range = parent::prepare_date_range( $date_range );
		$date_range = $date_range['start'] . '...' . $date_range['end'];

		return $date_range;
	}

	/**
	 * Adds AffiliateWP-specific settings to the WooCommerce > Settings > Accounts settings page.
	 *
	 * @access public
	 * @since  2.1
	 *
	 * @param array $settings Account settings.
	 * @return array Modified Account settings.
	 */
	public function account_settings( $settings ) {

		/**
		 * Filters the AffiliateWP-specific settings for the WooCommerce > Settings > Accounts settings screen.
		 *
		 * @since 2.1
		 *
		 * @param array $affwp_settings AffiliateWP settings.
		 */
		$affwp_settings = apply_filters( 'affwp_woocommerce_accounts_settings', array(
			array(
				'title' => __( 'AffiliateWP', 'affiliate-wp' ),
				'desc'  => __( 'AffiliateWP settings for the My Account page.', 'affiliate-wp' ),
				'id'    => 'affwp_account_settings',
				'type'  => 'title',
			),

			array(
				'title'         => __( 'Affiliate Area Link', 'affiliate-wp' ),
				'desc'          => __( 'Display a link to the Affiliate Area in the My Account navigation.', 'affiliate-wp' ),
				'id'            => 'affwp_woocommerce_affiliate_area_link',
				'default'       => 'no',
				'type'          => 'checkbox',
				'autoload'      => false,
			),

			array(
				'type' => 'sectionend',
				'id'   => 'affwp_account_settings'
			),

		) );

		$settings = array_merge( $settings, $affwp_settings );

		return $settings;
	}

	/**
	 * Add product category referral rate field.
	 *
	 * @access  public
	 * @since   2.2
	 */
	public function add_product_category_rate( $category ) {
		?>
		<div class="form-field">
			<label for="product-category-rate"><?php _e( 'Referral Rate', 'affiliate-wp' ); ?></label>
			<input type="text" class="small-text" name="_affwp_<?php echo $this->context; ?>_category_rate" id="product-category-rate">
			<p class="description"><?php _e( 'The referral rate for this category.', 'affiliate-wp' ); ?></p>
		</div>
	<?php
	}

	/**
	 * Edit product category referral rate field.
	 *
	 * @access  public
	 * @since   2.2
	 */
	public function edit_product_category_rate( $category ) {
		$category_id   = $category->term_id;
		$category_rate = get_term_meta( $category_id, '_affwp_' . $this->context . '_category_rate', true );
		?>
		<tr class="form-field">
			<th><label for="product-category-rate"><?php _e( 'Referral Rate', 'affiliate-wp' ); ?></label></th>

			<td>
				<input type="text" name="_affwp_<?php echo $this->context; ?>_category_rate" id="product-category-rate" value="<?php echo $category_rate ? esc_attr( $category_rate ) : ''; ?>">
				<p class="description"><?php _e( 'The referral rate for this category.', 'affiliate-wp' ); ?></p>
			</td>
		</tr>
	<?php
	}

	/**
	 * Save product category referral rate field.
	 *
	 * @access  public
	 * @since   2.2
	 */
	public function save_product_category_rate( $category_id ) {

		if ( isset( $_POST['_affwp_'. $this->context . '_category_rate'] ) ) {

			$rate     = $_POST['_affwp_' . $this->context . '_category_rate'];
			$meta_key = '_affwp_' . $this->context . '_category_rate';

			if ( $rate ) {
				update_term_meta( $category_id, $meta_key, $rate );
			} else {
				delete_term_meta( $category_id, $meta_key );
			}
		}
	}

	/**
	 * Register "Affiliate Referral" column in the Orders list table.
	 *
	 * @access public
	 * @since  2.1.11
	 *
	 * @param array  $columns Table columns.
	 * @return array $columns Modified columns.
	 */
	public function add_orders_column( $columns ) {
		$columns['referral'] = __( 'Affiliate Referral', 'affiliate-wp' );
		return $columns;
	}

	/**
	 * Render the "Affiliate Referral" column in the Orders list table for orders that have a referral associated with them.
	 *
	 * @access public
	 * @since  2.1.11
	 * @since 2.20.0 Added support for HPOS.
	 *
	 * @param string     $column_name Name of column being rendered.
	 * @param object|int $order_or_id Order object if HPOS is enabled or order ID.
	 * @return void.
	 */
	public function render_orders_referral_column( string $column_name, $order_or_id ) {

		// Bail if not the column we want.
		if ( 'referral' !== $column_name ) {
			return;
		}

		// Bail if not a shop order.
		if ( true === $this->is_hpos_enabled() ) {

			// HPOS usage is enabled, so we need to get the id.
			$order_or_id = $order_or_id->get_id();

			if ( 'shop_order' !== OrderUtil::get_order_type( $order_or_id ) ) {
				return;
			}

		} elseif ( 'shop_order' !== get_post_type( $order_or_id ) ) {
			return;
		}

		// Get the referral.
		$referral = affwp_get_referral_by( 'reference', $order_or_id, $this->context );

		// Render the referral ID with link to edit screen if it exists. Otherwise, return a dash.
		echo ( ! is_wp_error( $referral ) && 'failed' !== $referral->status )
			? sprintf( '<a href="%s">#%d</a>', affwp_admin_url( 'referrals', array( 'referral_id' => $referral->referral_id, 'action' => 'edit_referral' ) ), $referral->referral_id )
			: '<span aria-hidden="true">&mdash;</span>';
	}

	/**
	 * Add "Affiliate Referral" to the Order preview screen.
	 *
	 * @access public
	 * @since  2.1.16
	 *
	 * @param array $order_details Order details to send to the preview screen.
	 * @param WC_Order $order Order object.
	 * @return array $order_details Modified order details.
	 */
	public function order_preview_get_referral( $order_details, $order ) {

		$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

		$referral = affwp_get_referral_by( 'reference', $order_id, $this->context );

		if ( ! is_wp_error( $referral ) && 'failed' !== $referral->status ) {

			$referral_html = '<div class="wc-order-preview-affwp-referral">';
			$referral_html .= '<strong>'. __( 'Affiliate Referral', 'affiliate-wp' ) . '</strong>';
			$referral_html .= '<a href="' . affwp_admin_url( 'referrals', array( 'referral_id' => $referral->referral_id, 'action' => 'edit_referral' ) ) . '">#' . $referral->referral_id . '</a>';
			$referral_html .= '</div>';

			$order_details['referral'] = $referral_html;

		}

		return $order_details;
	}

	/**
	 * Render the "Affiliate Referral" section in the order preview screen.
	 *
	 * @access public
	 * @since  2.1.16
	 *
	 */
	public function render_order_preview_referral() {
		?>
		<# if ( data.referral ) { #>
			{{{ data.referral }}}
		<# } #>
		<?php

	}

	/**
	 * Gets the coupon templates for this integration.
	 *
	 * @since 2.6
	 *
	 * @return array Coupon templates array where the key is the coupon ID and value is the label.
	 */
	public function get_coupon_templates() {

		$templates = array();

		$coupon_templates = get_posts( array(
			'post_type'   => 'shop_coupon',
			'post_status' => array( 'draft', 'pending', 'publish' ),
			'numberposts' => 25,
			'meta_query'  => array(
				array(
					'key'     => 'affwp_discount_affiliate',
					'value'   => '',
					'compare' => 'NOT EXISTS',
				),
			),
		) );

		if ( ! empty( $coupon_templates ) ) {
			foreach ( $coupon_templates as $coupon_template ) {
				$templates[ $coupon_template->ID ] = $coupon_template->post_title;
			}
		}

		/**
		 * Filters the WooCommerce coupon templates.
		 *
		 * @since 2.6
		 *
		 * @param array                     $templates Coupon templates array where the key is the coupon ID
		 *                                             and value is the label.
		 * @param \Affiliate_WP_WooCommerce $this      WooCommerce integration instance.
		 */
		return apply_filters( "affwp_{$this->context}_get_coupon_templates", $templates, $this );
	}

	/**
	 * Builds an array of coupon template options for display in settings.
	 *
	 * @since 2.6
	 *
	 * @return array Options array.
	 */
	public function get_coupon_templates_options() {
		$options = array( '' => __( '(select one)', 'affiliate-wp' ) ) + $this->get_coupon_templates();

		return $options;
	}

	/**
	 * Retrieves coupons of a given type.
	 *
	 * @since 2.6
	 * @since 2.8 Added integration type to details array.
	 * @since 2.9 Added `$unlocked_only` parameter.
	 *
	 * @param string               $type          Coupon type.
	 * @param int|\AffWP\Affiliate $affiliate     Optional. Affiliate ID or object to retrieve coupons for.
	 *                                            Default null (ignored).
	 * @param bool                 $details_only  Optional. Whether to retrieve the coupon details only (for display).
	 *                                            Default true. If false, the full coupon objects will be retrieved.
	 * @param bool                 $unlocked_only Optional. Whether to retrieve only unlocked dynamic coupons if supported.
	 *                                            Default false (retrieve all dynamic coupons).
	 * @return array|\AffWP\Affiliate\Coupon[]|\WP_Post[] An array of arrays of coupon details if `$details_only` is
	 *                                                    true or an array of coupon or post objects if false, depending
	 *                                                    on whether dynamic or manual coupons, otherwise an empty array.
	 */
	public function get_coupons_of_type( $type, $affiliate = null, $details_only = true, $unlocked_only = false ) {
		if ( ! $this->is_active() ) {
			return array();
		}

		global $wpdb;

		$affiliate = affwp_get_affiliate( $affiliate );
		$coupons   = array();

		switch ( $type ) {

			case 'manual':
				$ids = $this->get_coupon_post_ids( 'shop_coupon', 'publish', $affiliate );

				if ( ! empty( $ids ) ) {
					foreach ( $ids as $id ) {
						if ( true === $details_only ) {
							$coupons[ $id ]['code'] = get_the_title( $id );

							$coupon_amount = get_post_meta( $id, 'coupon_amount', true );
							$coupon_type   = get_post_meta( $id, 'discount_type', true );

							if ( 'fixed_product' === $coupon_type || 'fixed_cart' === $coupon_type ) {
								$amount = wc_price( $coupon_amount );
							} elseif ( 'percent' === $coupon_type ) {
								$amount = affwp_format_percentage( $coupon_amount );
							} else {
								$coupon_info = ' (' . esc_html( wc_get_coupon_type( get_post_meta( $id, 'discount_type', true ) ) ) . ')';
								$amount      = $coupon_amount . $coupon_info;
							}

							$coupons[ $id ]['amount']      = $amount;
							$coupons[ $id ]['integration'] = $this->context;
						} else {
							$coupons[ $id ] = get_post( $id );
						}
					}
				}
				break;

			case 'dynamic':

				$args = array(
					'fields' => 'ids',
					'number' => -1,
					'type'   => 'dynamic',
				);

				if ( true === $unlocked_only ) {
					$args['lock_status'] = 'unlocked';
				}

				if ( $affiliate ) {
					$args['affiliate_id'] = $affiliate->ID;
				}

				$ids = affiliate_wp()->affiliates->coupons->get_coupons( $args );

				if ( ! empty( $ids ) ) {
					foreach ( $ids as $id ) {
						$coupon = affwp_get_coupon( $id );

						if ( ! is_wp_error( $coupon ) ) {

							$coupon_integration = $coupon->get_integration();

							/*
							 * If the coupon has an integration set, make sure to only pull the ones compatible
							 * with the current integration. If not set, the coupon is fully dynamic to any
							 * eligible integration.
							 */
							if ( ! empty( $coupon_integration ) && $this->context !== $coupon_integration ) {
								continue;
							}

							if ( true === $details_only ) {
								$coupon_details = $this->get_coupon_details( $coupon );

								if ( ! empty( $coupon_details ) ) {
									$coupons[ $id ]                = $coupon_details;
									$coupons[ $id ]['integration'] = $this->context;
								}
							} else {
								$coupons[ $id ] = $coupon;
							}
						}
					}
				}
				break;

			default:
				$coupons = array();
				break;
		}

		return $coupons;
	}

	/**
	 * Retrieves the details of a coupon.
	 *
	 * @since 2.6
	 *
	 * @param AffWP\Affiliate\Coupon $affiliate_coupon Coupon object.
	 * @return array Coupon details if all required conditions are met, otherwise an empty array.
	 */
	public function get_coupon_details( $affiliate_coupon ) {

		$coupon_details = array();

		$template_id = affiliate_wp()->settings->get( "coupon_template_{$affiliate_coupon->get_integration()}" );

		if ( $template_id && ( 'publish' === get_post_status( $template_id ) ) ) {

			$coupon_amount = get_post_meta( $template_id, 'coupon_amount', true );
			$coupon_type   = get_post_meta( $template_id, 'discount_type', true );

			if ( 'fixed_product' === $coupon_type || 'fixed_cart' === $coupon_type ) {
				$amount = wc_price( $coupon_amount );
			} elseif ( 'percent' === $coupon_type ) {
				$amount = affwp_format_percentage( $coupon_amount );
			} else {
				$coupon_info = ' (' . esc_html( wc_get_coupon_type( get_post_meta( $template_id, 'discount_type', true ) ) ) . ')';
				$amount      = $coupon_amount . $coupon_info;
			}

			$coupon_details = array(
				'code'   => $affiliate_coupon->coupon_code,
				'amount' => $amount,
			);

		}

		return $coupon_details;
	}

	/**
	 * (Maybe) injects the AffiliateWP global affiliate coupon into the mix when processing WooCommerce coupons.
	 *
	 * @since 2.6
	 *
	 * @param false|array $manual_coupon Coupon data. Default false.
	 * @param string      $code          Coupon code passed to WooCommerce.
	 * @return array|false Data WooCommerce will use to generate a manual coupon, otherwise false.
	 */
	public function maybe_inject_dynamic_coupon( $manual_coupon, $code ) {

		$coupon = affwp_get_coupon_by( 'coupon_code', $code );

		if ( ! is_wp_error( $coupon ) ) {

			$template_id = affiliate_wp()->settings->get( 'coupon_template_woocommerce', 0 );

			if ( 'publish' === get_post_status( $template_id ) ) {

				$manual_coupon = false;

				$template = $this->get_coupon_template( $template_id );

				$fields = array(
					'amount', 'discount_type', 'excluded_product_ids', 'excluded_product_categories',
					'product_ids', 'individual_use', 'free_shipping', 'exclude_sale_items', 'date_expires'
				);

				foreach ( $fields as $field ) {
					if ( method_exists( $template, "get_{$field}" ) ) {
						$manual_coupon[ $field ] = call_user_func( array( $template, "get_{$field}" ) );
					}
				}
			}
		}

		return $manual_coupon;
	}

	/**
	 * Check if the automatic affiliate coupon is valid and can be applied to the cart.
	 *
	 * @since 2.6
	 *
	 * @param bool         $is_valid   True if coupon is valid, false otherwise.
	 * @param \WC_Coupon    $coupon    WooCommerce Coupon object.
	 * @param \WC_Discounts $discounts WooCommerce Discounts object.
	 * @return bool True if the coupon can be applied to the cart, otherwise false.
	 */
	public function validate_affiliate_coupon( $is_valid, $coupon, $discounts ) {

		$coupon_code = $coupon->get_code();

		$affiliate_coupon = affwp_get_coupon_by( 'coupon_code', $coupon_code );

		if ( is_wp_error( $affiliate_coupon ) ) {
			return $is_valid;
		}

		$applied_coupons = WC()->cart->get_applied_coupons();

		foreach ( $applied_coupons as $coupon_code ) {

			$coupon = new \WC_Coupon( $coupon_code );

			if ( true === version_compare( WC()->version, '3.0.0', '>=' ) ) {
				$coupon_id = $coupon->get_id();
			} else {
				$coupon_id = $coupon->id;
			}

			$affiliate_id = get_post_meta( $coupon_id, 'affwp_discount_affiliate', true );

			if ( $affiliate_id && affiliate_wp()->tracking->is_valid_affiliate( $affiliate_id ) ) {

				add_filter( 'woocommerce_coupon_error', function() {
					return __( 'This coupon can&#8217;t be used at the moment', 'affiliate-wp' );
				} );

				return false;
			}
		}

		return $is_valid;
	}

	/**
	 * Retrieves the WC_Coupon instance for the coupon template.
	 *
	 * @since 2.6
	 *
	 * @param int $template_id Coupon ID for the "template" set for the current integration.
	 * @return \WC_Coupon Coupon instance.
	 */
	protected function get_coupon_template( $template_id ) {
		// Remove the filter to prevent recursion.
		remove_filter( 'woocommerce_get_shop_coupon_data', array( $this, 'maybe_inject_dynamic_coupon' ), 10, 2 );

		$coupon = new \WC_Coupon( $template_id );

		// Re-add it.
		add_filter( 'woocommerce_get_shop_coupon_data', array( $this, 'maybe_inject_dynamic_coupon' ), 10, 2 );

		return $coupon;
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	new Affiliate_WP_WooCommerce;
}
