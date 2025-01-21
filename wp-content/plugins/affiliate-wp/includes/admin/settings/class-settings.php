<?php
/**
 * Admin: Settings Bootstrap
 *
 * @package     AffiliateWP
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2014, Sandhills Development, LLC
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// phpcs:disable PEAR.Functions.FunctionCallSignature.EmptyLine -- Formatting for better commenting preferred.
// phpcs:disable PEAR.Functions.FunctionCallSignature.FirstArgumentPosition -- Formatting for better commenting preferred.

use AffWP\Core\License;

/**
 * Sets up the Settings component.
 *
 * @since 1.0
 */
class Affiliate_WP_Settings {

	/**
	 * Saved settings.
	 *
	 * @since 1.0
	 * @var   array
	 */
	private $options;

	/**
	 * Store sections of settings.
	 *
	 * @since 2.18.0
	 *
	 * @var array
	 */
	private array $sections = array();

	/**
	 * Available tabs.
	 *
	 * @since 2.18.0
	 *
	 * @var array
	 */
	private array $tabs = array();

	/**
	 * Get things started
	 *
	 * @since 1.0
	 *
	 * @return void
	*/
	public function __construct() {

		$this->options = get_option( 'affwp_settings', array() );

		if ( ! is_array( $this->options ) ) {
			$this->options = array();
		}

		// Set up.
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_init', array( $this, 'deactivate_license' ) );

		// Global settings.
		add_action( 'affwp_pre_get_registered_settings', array( $this, 'handle_global_license_setting' ) );
		add_action( 'affwp_pre_get_registered_settings', array( $this, 'handle_global_debug_mode_setting' ) );

		// Sanitization.
		add_filter( 'affwp_settings_sanitize',             array( $this, 'sanitize_referral_variable'  ), 10, 2 );
		add_filter( 'affwp_settings_sanitize',             array( $this, 'sanitize_coupon_template'    ), 10, 2 );
		add_filter( 'affwp_settings_sanitize',             array( $this, 'sanitize_coupon_custom_text' ), 10, 2 );
		add_filter( 'affwp_settings_sanitize_text',        array( $this, 'sanitize_text_fields'        ), 10, 2 );
		add_filter( 'affwp_settings_sanitize_url',         array( $this, 'sanitize_url_fields'         ), 10, 2 );
		add_filter( 'affwp_settings_sanitize_checkbox',    array( $this, 'sanitize_cb_fields'          ), 10, 2 );
		add_filter( 'affwp_settings_sanitize_number',      array( $this, 'sanitize_number_fields'      ), 10, 2 );
		add_filter( 'affwp_settings_sanitize_rich_editor', array( $this, 'sanitize_rich_editor_fields' ), 10, 2 );

		// Capabilities
		add_filter( 'option_page_capability_affwp_settings', array( $this, 'option_page_capability' ) );

		// Filter the general settings
		add_filter( 'affwp_settings_advanced', array( $this, 'required_registration_fields' ) );

		// Filter the email settings
		add_filter( 'affwp_settings_emails', array( $this, 'email_approval_settings' ) );

		// Add starting Affiliate ID setting. Originally provided by Starting Affiliate ID addon.
		add_filter( 'affwp_settings_affiliates', array( '\AffiliateWP\Admin\Starting_Affiliate_ID', 'add_starting_affiliate_id_setting' ) );

		// Set the affiliate ID when the minimum ID is updated.
		add_action( 'pre_update_option_affwp_settings', array( '\AffiliateWP\Admin\Starting_Affiliate_ID', 'sync_affiliate_id' ), 10, 3 );

		// Ensure the Starting Affiliate ID value is always bigger than the last Affiliate ID.
		add_action( 'affiliatewp_number_callback_starting_affiliate_id', array( '\AffiliateWP\Admin\Starting_Affiliate_ID', 'setting_value' ) );

		// Register tabs to be displayed in the admin Settings screen.
		add_action( 'admin_init', array( $this, 'register_admin_tabs' ) );

		// Check if coupons tab needs to be loaded.
		add_filter( 'affwp_settings_tabs', array( $this, 'coupons_tab' ) );

		// Register the sections of settings for each tab.
		add_action( 'admin_init', array( $this, 'register_admin_sections' ) );

		// Register the Signup Widget fields.
		add_filter( 'affwp_settings_affiliates', array( $this, 'register_signup_widget_fields' ) );

		// Make compatible with non-mapped addons.
		add_action( 'affiliatewp_after_register_admin_sections', array( $this, 'register_section_for_non_compatible_tabs' ) );
	}

	/**
	 * Check if it has support for the Affiliate Signup Widget.
	 *
	 * @since 2.18.0
	 *
	 * @return bool True if it has support, false otherwise.
	 */
	private function supports_affiliate_signup_widgets() : bool {

		$supported_integrations = affiliate_wp()->integrations->query(
			array(
				'supports' => 'affiliate_signup_widget',
				'status'   => 'enabled',
				'fields'   => array(
					'ids',
					'name',
				),
			)
		);

		return ! empty( $supported_integrations );
	}

	/**
	 * Register the signup widget fields.
	 *
	 * @since 2.18.0
	 *
	 * @param array $settings The current array of settings.
	 *
	 * @return array The update array of settings.
	 */
	public function register_signup_widget_fields( array $settings ) : array {

		if ( false === $this->supports_affiliate_signup_widgets() ) {
			add_filter( 'affiliatewp_register_section_affiliate_signup_widget', '__return_empty_array' );
			return $settings;
		}

		return array_merge(
			$settings,
			$this->get_settings(
				array(
					'additional_registration_modes',
					'affiliate_signup_widget_brand_color',
					'affiliate_signup_widget_image',
					'affiliate_signup_widget_heading_text',
					'affiliate_signup_widget_text',
					'affiliate_signup_widget_button_text',
					'affiliate_signup_widget_confirmation_heading_text',
					'affiliate_signup_widget_confirmation_text',
				)
			)
		);
	}

	/**
	 * Retrieve the active tab key name.
	 *
	 * @since 2.18.0
	 *
	 * @return string The tab key.
	 */
	public function get_active_tab() : string {

		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- No need to check nonce for this.
		return isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], affwp_get_settings_tabs() )
			? sanitize_text_field( $_GET['tab'] )
			: 'general';
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Register a section for non-mapped settings, usually addons.
	 *
	 * @since 2.18.0
	 */
	public function register_section_for_non_compatible_tabs() {

		// Add the tab key to the list below if you have added the section manually or wants to ignore.
		$tabs_to_ignore = array(
			'general',
			'affiliates',
			'commissions',
			'emails',
			'advanced',
		);

		$tab_key = $this->get_active_tab();

		if ( in_array( $tab_key, $tabs_to_ignore, true ) ) {
			return; // These tabs were manually registered.
		}

		// Get all available tabs.
		$tabs = $this->get_tabs();

		// Get all registered settings. If the settings is not here, the problem can be the hook priority.
		$settings = $this->get_registered_settings();

		// Register a single section for all the addon settings.
		$this->register_section(
			$tab_key,
			$tab_key,
			isset( $tabs[ $tab_key ] ) ? "{$tabs[ $tab_key ]}" : 'Options',
			/**
			 * Filter the section array of settings keys.
			 *
			 * @since 2.18.0
			 *
			 * @param array $settings Array of settings keys.
			 */
			apply_filters(
				"affiliatewp_register_section_{$tab_key}",
				isset( $settings[ $tab_key ] )
					? array_keys( $settings[ $tab_key ] )
					: array()
			),
		);
	}

	/**
	 * Register all admin tabs.
	 *
	 * @since 2.18.0
	 */
	public function register_admin_tabs() {

		$this->tabs = array_filter(
			array(
				'general'      => __( 'General', 'affiliate-wp' ),
				'affiliates'   => __( 'Affiliates', 'affiliate-wp' ),
				'commissions'  => __( 'Commissions', 'affiliate-wp' ),
				'integrations' => __( 'Integrations', 'affiliate-wp' ),
				'opt_in_forms' => __( 'Opt-In Form', 'affiliate-wp' ),
				'emails'       => __( 'Emails', 'affiliate-wp' ),
				'advanced'     => __( 'Advanced', 'affiliate-wp' ),
			)
		);
	}

	/**
	 * Register all admin sections.
	 *
	 * @since 2.18.0
	 */
	public function register_admin_sections() {

		// General tab.
		$this->register_section(
			'general',
			'license',
			__( 'License', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_license',
				array(
					'license_key',
				)
			)
		);

		$this->register_section(
			'advanced',
			'currency',
			__( 'Currency Settings', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_currency',
				array(
					'currency',
					'currency_position',
					'thousands_separator',
					'decimal_separator',
				)
			)
		);

		$this->register_section(
			'general',
			'wizard',
			__( 'Setup Wizard', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_wizard',
				array(
					'wizard_button',
				)
			)
		);

		// Affiliates tab.
		$this->register_section(
			'affiliates',
			'registration_management',
			__( 'Registration & Management', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_registration_management',
				array(
					'affiliates_page',
					'terms_of_use',
					'allow_affiliate_registration',
					'require_approval',
					'starting_affiliate_id',
					'recaptcha_type',
					'recaptcha_site_key',
					'recaptcha_secret_key',
					'recaptcha_score_threshold',
					'additional_registration_modes'
				)
			)
		);

		affiliate_wp()->settings->register_section(
			'affiliates',
			'affiliate_signup_widget',
			__( 'Affiliate Signup Widget', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_affiliate_signup_widget',
				array(
					array(
						'affiliate_signup_widget_brand_color',
						'affiliate_signup_widget_image',
						'affiliate_signup_widget_heading_text',
						'affiliate_signup_widget_text',
						'affiliate_signup_widget_button_text',
						'affiliate_signup_widget_confirmation_heading_text',
						'affiliate_signup_widget_confirmation_text',
					),
				),
			),
			sprintf( __( 'Turn customers into affiliates with one click. <a href="%s" target="_blank" rel="noopener noreferrer">Read our documentation</a> to learn more.', 'affiliate-wp' ), esc_url( 'https://affiliatewp.com/docs/affiliate-signup-widget' ) ),
			array(
				'required_field' => 'additional_registration_modes',
				'value'          => 'affiliate_signup_widget',
			),
			'affiliate_signup_widget',
			true
		);

		$this->register_section(
			'affiliates',
			'affiliate_links',
			__( 'Affiliate Links', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_affiliate_links',
				array(
					'referral_var',
					'referral_format',
					'referral_pretty_urls',
				)
			)
		);

		$this->register_section(
			'affiliates',
			'affiliate_ui',
			__( 'Affiliate UI', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_affiliate_ui',
				array(
					'logout_link',
				)
			)
		);

		affiliate_wp()->settings->register_section(
			'affiliates',
			'addon_landing_pages',
			__( 'Affiliate Landing Pages', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_addon_landing_pages',
				array(
					'affiliate-landing-pages',
				)
			),
			sprintf(
				wp_kses( /* translators: %s - AffiliateWP.com Affiliate Landing Pages URL. */
					__( 'Assign pages or posts to specific affiliates. <a href="%s" target="_blank" rel="noopener noreferrer">Read our documentation</a> to learn more.', 'affiliate-wp' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				affwp_utm_link( 'https://affiliatewp.com/docs/affiliate-landing-pages-installation-and-usage/', 'settings-affiliates', 'Affiliate Landing Pages Documentation' )
			),
			array(),
			'table',
			true
		);

		// Commissions tab.
		$this->register_section(
			'commissions',
			'default_commission_settings',
			__( 'Default Commission Settings', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_default_commission_settings',
				array(
					'referral_rate_type',
					'flat_rate_basis',
					'referral_rate',
					'cookie_exp',
					'referral_credit_last',
					'exclude_shipping',
					'exclude_tax',
					'revoke_on_refund',
					'ignore_zero_referrals',
				)
			)
		);

		$this->register_section(
			'commissions',
			'payment_methods',
			__( 'Payout Methods', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_payment_methods',
				array(
					'enable_payouts_service',
					'paypal_payouts',
					'manual_payouts',
				)
			)
		);

		$this->register_section(
			'commissions',
			'payouts_service',
			__( 'Payouts Service Payment Method', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_payouts_service',
				array(
					'payouts_service_about',
					'payouts_service_button',
					'payouts_service_description',
					'payouts_service_notice',
				)
			),
			'',
			array(
				'required_field' => 'enable_payouts_service',
				'value'          => true,
			)
		);

		// Emails.
		affiliate_wp()->settings->register_section(
			'emails',
			'email_options',
			__( 'Email Options', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_email_options',
				array(
					'email_logo',
					'email_template',
					'from_name',
					'from_email',
					'email_notifications',
					'affiliate_email_summaries',
					'affiliate_manager_email',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'emails',
			'registration_email_options',
			__( 'Registration Email Options For Affiliate Manager', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_registration_email_options',
				array(
					'registration_subject',
					'registration_email',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'emails',
			'new_referral_email_options_for_affiliate_manager',
			__( 'New Referral Email Options for Affiliate Manager', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_new_referral_email_options_for_affiliate_manager',
				array(
					'new_admin_referral_subject',
					'new_admin_referral_email',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'emails',
			'new_referral_email_options_for_affiliate',
			__( 'New Referral Email Options For Affiliate', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_new_referral_email_options_for_affiliate',
				array(
					'referral_subject',
					'referral_email',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'emails',
			'application_accepted_email_options',
			__( 'Application Accepted Email Options For Affiliate', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_application_accepted_email_options',
				array(
					'accepted_subject',
					'accepted_email',
				)
			),
		);

		// Conditionally display the extra email settings.
		if ( affiliate_wp()->settings->get( 'require_approval' ) ) {

			affiliate_wp()->settings->register_section(
				'emails',
				'application_pending_email_options',
				__( 'Application Pending Email Options For Affiliate', 'affiliate-wp' ),
				apply_filters(
					'affiliatewp_register_section_application_pending_email_options',
					array(
						'pending_subject',
						'pending_email',
					)
				),
			);

			affiliate_wp()->settings->register_section(
				'emails',
				'application_rejection_email_options',
				__( 'Application Rejection Email Options For Affiliate', 'affiliate-wp' ),
				apply_filters(
					'affiliatewp_register_section_application_rejection_email_options',
					array(
						'rejection_subject',
						'rejection_email',
					)
				),
			);
		}

		// Advanced.
		affiliate_wp()->settings->register_section(
			'advanced',
			'tracking',
			__( 'Tracking', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_tracking',
				array(
					'cookie_sharing',
					'default_referral_url',
					'referral_url_blacklist',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'advanced',
			'template_file_shortcode_settings',
			__( 'Template File / Shortcode Settings', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_template_file_shortcode_settings',
				array(
					'terms_of_use_label',
					'affiliate_area_forms',
					'required_registration_fields',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'advanced',
			'email_summaries',
			__( 'Email Summaries', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_email_summaries',
				array(
					'disable_monthly_email_summaries',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'advanced',
			'privacy_logging',
			__( 'Privacy & Logging', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_privacy_logging',
				array(
					'disable_ip_logging',
					'debug_mode',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'advanced',
			'data_management',
			__( 'Data Management', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_data_management',
				array(
					'uninstall_on_delete',
				)
			),
		);

		affiliate_wp()->settings->register_section(
			'advanced',
			'troubleshooting',
			__( 'Troubleshooting', 'affiliate-wp' ),
			apply_filters(
				'affiliatewp_register_section_troubleshooting',
				array(
					'tracking_fallback',
				)
			),
		);

		do_action( 'affiliatewp_after_register_admin_sections' );
	}

	/**
	 * Get the value of a specific setting
	 *
	 * Note: By default, zero values are not allowed. If you have a custom
	 * setting that needs to allow 0 as a valid value, but sure to add its
	 * key to the filtered array seen in this method.
	 *
	 * @since  1.0
	 * @param  string  $key
	 * @param  mixed   $default (optional)
	 * @return mixed
	 */
	public function get( $key, $default = false ) {

		// Only allow non-empty values, otherwise fallback to the default
		$value = ! empty( $this->options[ $key ] ) ? $this->options[ $key ] : $default;

		$zero_values_allowed = array( 'referral_rate', 'payouts_service_vendor_id' );

		/**
		 * Filters settings allowed to accept 0 as a valid value without
		 * falling back to the default.
		 *
		 * @since 1.7
		 * @since 2.4 Added support for the 'payouts_service_vendor_id' setting
		 *
		 * @param array $zero_values_allowed Array of setting IDs.
		 */
		$zero_values_allowed = (array) apply_filters( 'affwp_settings_zero_values_allowed', $zero_values_allowed );

		// Allow 0 values for specified keys only
		if ( in_array( $key, $zero_values_allowed ) ) {

			$value = isset( $this->options[ $key ] ) ? $this->options[ $key ] : null;
			$value = ( ! is_null( $value ) && '' !== $value ) ? $value : $default;

		}

		// Handle network-wide debug mode constant.
		if ( 'debug_mode' === $key ) {
			if ( defined( 'AFFILIATE_WP_DEBUG' ) && AFFILIATE_WP_DEBUG ) {
				$value = true;
			}
		}

		return $value;

	}

	/**
	 * Sets an option (in memory).
	 *
	 * @since 1.8
	 * @access public
	 *
	 * @param array $settings An array of `key => value` setting pairs to set.
	 * @param bool  $save     Optional. Whether to trigger saving the option or options. Default false.
	 * @return bool If `$save` is not false, whether the options were saved successfully. True otherwise.
	 */
	public function set( $settings, $save = false ) {

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		if ( ! is_array( $this->options ) ) {
			$this->options = array();
		}

		foreach ( $settings as $option => $value ) {
			$this->options[ $option ] = $value;
		}

		if ( false !== $save ) {
			return $this->save();
		}

		return true;
	}

	/**
	 * Saves option values queued in memory.
	 *
	 * Note: If posting separately from the main settings submission process, this method should
	 * be called directly for direct saving to prevent memory pollution. Otherwise, this method
	 * is only accessible via the optional `$save` parameter in the set() method.
	 *
	 * @since 1.8
	 * @since 1.8.3 Added the `$options` parameter to facilitate direct saving.
	 * @access protected
	 *
	 * @see Affiliate_WP_Settings::set()
	 *
	 * @param array $options Optional. Options to save/overwrite directly. Default empty array.
	 * @return bool False if the options were not updated (saved) successfully, true otherwise.
	 */
	protected function save( $options = array() ) {
		$all_options = $this->get_all();

		if ( empty( $all_options ) ) {
			$all_options = array();
		}

		if ( ! empty( $options ) && is_array( $all_options ) ) {
			$all_options = array_merge( $all_options, $options );
		}

		$updated = update_option( 'affwp_settings', $all_options );

		// Refresh the options array available in memory (prevents unexpected race conditions).
		$this->options = get_option( 'affwp_settings', array() );

		return $updated;
	}

	/**
	 * Get all settings
	 *
	 * @since 1.0
	 * @return array
	*/
	public function get_all() {
		return $this->options;
	}

	/**
	 * Add all settings sections and fields
	 *
	 * @since 1.0
	 * @return void
	*/
	function register_settings() {

		if ( false == get_option( 'affwp_settings' ) ) {
			add_option( 'affwp_settings' );
		}

		foreach( $this->get_registered_settings() as $tab => $settings ) {

			add_settings_section(
				'affwp_settings_' . $tab,
				__return_null(),
				'__return_false',
				'affwp_settings_' . $tab
			);

			foreach ( $settings as $key => $option ) {

				if ( isset( $option['enabled'] ) && empty( $option['enabled'] ) ) {
					continue; // Fields are enabled by default, skip this field if enabled is set and is false/empty.
				}

				if( $option['type'] == 'checkbox' || $option['type'] == 'multicheck' || $option['type'] == 'radio' ) {
					$name = isset( $option['name'] ) ? $option['name'] : '';
				} else {
					$name = isset( $option['name'] ) ? '<label for="affwp_settings[' . $key . ']">' . $option['name'] . '</label>' : '';
				}

				$callback = ! empty( $option['callback'] ) ? $option['callback'] : array( $this, $option['type'] . '_callback' );

				$visibility_rules = isset( $option['visibility'] )
					? array(
						'rule'  => $option['visibility'],
						'field' => $key,
					)
					: '';

				add_settings_field(
					'affwp_settings[' . $key . ']',
					$name,
					is_callable( $callback ) ? $callback : array( $this, 'missing_callback' ),
					'affwp_settings_' . $tab,
					'affwp_settings_' . $tab,
					array(
						'id'               => $key,
						'desc'             => ! empty( $option['desc'] ) ? $option['desc'] : '',
						'name'             => $option['name'] ?? null,
						'section'          => $tab,
						'size'             => isset( $option['size'] ) ? $option['size'] : null,
						'rows'             => isset( $option['rows'] ) ? $option['rows'] : null,
						'max'              => isset( $option['max'] ) ? $option['max'] : null,
						'min'              => isset( $option['min'] ) ? $option['min'] : null,
						'step'             => isset( $option['step'] ) ? $option['step'] : null,
						'options'          => isset( $option['options'] ) ? $option['options'] : '',
						'std'              => isset( $option['std'] ) ? $option['std'] : '',
						'disabled'         => isset( $option['disabled'] ) ? $option['disabled'] : '',
						'class'            => isset( $option['class'] ) ? $option['class'] : '',
						'education_modal'  => $option['education_modal'] ?? array(),
						'options_callback' => isset( $option['options_callback'] ) ? $option['options_callback'] : '',
						'visibility'       => $visibility_rules,
					)
				);
			}

		}

		// Creates our settings in the options table
		register_setting( 'affwp_settings', 'affwp_settings', array( $this, 'sanitize_settings' ) );

	}

	/**
	 * Retrieve the array of plugin settings
	 *
	 * @since 1.0
	 * @return array
	*/
	function sanitize_settings( $input = array() ) {

		if ( empty( $_POST['_wp_http_referer'] ) ) {
			return $input;
		}

		parse_str( $_POST['_wp_http_referer'], $referrer );

		$saved    = get_option( 'affwp_settings', array() );
		if( ! is_array( $saved ) ) {
			$saved = array();
		}
		$settings = $this->get_registered_settings();
		$tab      = isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';

		$input = $input ? $input : array();

		/**
		 * Filters the input value for the AffiliateWP settings tab.
		 *
		 * This filter is appended with the tab name, followed by the string `_sanitize`, for example:
		 *
		 *     `affwp_settings_misc_sanitize`
		 *     `affwp_settings_integrations_sanitize`
		 *
		 * @since 1.0
		 *
		 * @param mixed $input The settings tab content to sanitize.
		 */
		$input = apply_filters( 'affwp_settings_' . $tab . '_sanitize', $input );

		// Ensure a value is always passed for every checkbox
		if( ! empty( $settings[ $tab ] ) ) {
			foreach ( $settings[ $tab ] as $key => $setting ) {

				// Single checkbox
				if ( isset( $settings[ $tab ][ $key ][ 'type' ] ) && 'checkbox' == $settings[ $tab ][ $key ][ 'type' ] ) {
					$input[ $key ] = ! empty( $input[ $key ] );
				}

				// Multicheck list
				if ( isset( $settings[ $tab ][ $key ][ 'type' ] ) && 'multicheck' == $settings[ $tab ][ $key ][ 'type' ] ) {
					if( empty( $input[ $key ] ) ) {
						$input[ $key ] = array();
					}
				}
			}
		}

		// Loop through each setting being saved and pass it through a sanitization filter
		foreach ( $input as $key => $value ) {

			// Don't overwrite the global license key.
			if ( 'license_key' === $key ) {
				$value = self::get_license_key( $value, true );
			}

			// Get the setting type (checkbox, select, etc)
			$type              = isset( $settings[ $tab ][ $key ][ 'type' ] ) ? $settings[ $tab ][ $key ][ 'type' ] : false;
			$sanitize_callback = isset( $settings[ $tab ][ $key ][ 'sanitize_callback' ] ) ? $settings[ $tab ][ $key ][ 'sanitize_callback' ] : false;
			$input[ $key ]     = $value;

			if ( $type ) {

				if( $sanitize_callback && is_callable( $sanitize_callback ) ) {

					add_filter( 'affwp_settings_sanitize_' . $type, $sanitize_callback, 10, 2 );

				}

				/**
				 * Filters the sanitized value for a setting of a given type.
				 *
				 * This filter is appended with the setting type (checkbox, select, etc), for example:
				 *
				 *     `affwp_settings_sanitize_checkbox`
				 *     `affwp_settings_sanitize_select`
				 *
				 * @since 1.0
				 *
				 * @param array  $value The input array and settings key defined within.
				 * @param string $key   The settings key.
				 */
				$input[ $key ] = apply_filters( 'affwp_settings_sanitize_' . $type, $input[ $key ], $key );
			}

			/**
			 * General setting sanitization filter
			 *
			 * @since 1.0
			 *
			 * @param array  $input[ $key ] The input array and settings key defined within.
			 * @param string $key           The settings key.
			 */
			$input[ $key ] = apply_filters( 'affwp_settings_sanitize', $input[ $key ], $key );

			// Now remove the filter
			if( $sanitize_callback && is_callable( $sanitize_callback ) ) {

				remove_filter( 'affwp_settings_sanitize_' . $type, $sanitize_callback, 10 );

			}
		}

		add_settings_error( 'affwp-notices', '', __( 'Settings updated.', 'affiliate-wp' ), 'updated' );

		return array_merge( $saved, $input );

	}

	/**
	 * Sanitize the referral variable on save
	 *
	 * @since 1.7
	 * @return string
	*/
	public function sanitize_referral_variable( $value = '', $key = '' ) {

		if( 'referral_var' === $key ) {

			if( empty( $value ) ) {

				$value = 'ref';

			} else {

				$value = sanitize_key( $value );

			}

			update_option( 'affwp_flush_rewrites', '1' );

		}

		return $value;
	}

	/**
	 * Sanitizes the coupon template setting.
	 *
	 * @since 2.6
	 *
	 * @param mixed  $value Template setting value.
	 * @param string $key   Setting key.
	 * @return mixed Sanitized template value.
	 */
	public function sanitize_coupon_template( $value = '', $key = '' ) {

		if ( 'coupon_template_woocommerce' === $key ) {
			$value = intval( $value );
		}

		return $value;
	}

	/**
	 * Sanitizes the coupon custom text setting.
	 * Only alphanumeric characters allowed. Max length default is 50.
	 *
	 * @since 2.8
	 *
	 * @param mixed  $value Setting value.
	 * @param string $key   Setting key.
	 * @return mixed Sanitized coupon custom text value.
	 */
	public function sanitize_coupon_custom_text( $value, $key ) {
		if ( 'coupon_custom_text' === $key ) {
			$value = affwp_sanitize_coupon_custom_text( $value );
		}

		return $value;
	}

	/**
	 * Sanitize text fields
	 *
	 * @since 1.7
	 * @return string
	*/
	public function sanitize_text_fields( $value = '', $key = '' ) {
		return sanitize_text_field( $value );
	}

	/**
	 * Sanitize URL fields
	 *
	 * @since 1.7.15
	 * @return string
	*/
	public function sanitize_url_fields( $value = '', $key = '' ) {
		return sanitize_text_field( $value );
	}

	/**
	 * Sanitize checkbox fields
	 *
	 * @since 1.7
	 * @return int
	*/
	public function sanitize_cb_fields( $value = '', $key = '' ) {
		return absint( $value );
	}

	/**
	 * Sanitize number fields
	 *
	 * @since 1.7
	 * @return int
	*/
	public function sanitize_number_fields( $value = '', $key = '' ) {
		return floatval( $value );
	}

	/**
	 * Sanitize rich editor fields
	 *
	 * @since 1.7
	 * @return int
	*/
	public function sanitize_rich_editor_fields( $value = '', $key = '' ) {
		return wp_kses_post( $value );
	}

	/**
	 * Set the capability needed to save affiliate settings
	 *
	 * @since 1.9
	 * @return string
	*/
	public function option_page_capability( $capability ) {
		return 'manage_affiliate_options';
	}

	/**
	 * Return the list of tabs.
	 *
	 * @since 2.18.0
	 *
	 * @return array The array of tabs.
	 */
	public function get_tabs() : array {
		/**
		 * Filters the list of settings tabs.
		 *
		 * @since 2.18.0
		 *
		 * @param array $tabs Settings tabs.
		 */
		return apply_filters( 'affwp_settings_tabs', $this->tabs );
	}

	/**
	 * Check if coupons tab should be appended.
	 *
	 * @since 2.18.0
	 *
	 * @param array $tabs The tabs to show.
	 * @return array The new list of tabs
	 */
	public function coupons_tab( array $tabs ) : array {

		return array_merge(
			$tabs,
			array_filter(
				array(
					'coupons' => affwp_get_dynamic_coupons_integrations()
						? __( 'Coupons', 'affiliate-wp' )
						: ''
				)
			)
		);
	}

	/**
	 * Return the sections registered.
	 *
	 * @since 2.18.0
	 *
	 * @param string $tab_name The sections for the given tab.
	 * @return array The array of sections.
	 */
	public function get_sections( string $tab_name ) : array {

		if ( '' !== $tab_name && ! in_array( $tab_name, array_keys( $this->get_tabs() ), true ) ) {
			return array(); // We do not want to return fields from a non-existent section.
		}

		if ( ! isset( $this->sections[ $tab_name ] ) ) {
			return array(); // No sections for this block.
		}

		/**
		 * Filter section data from a specific tab.
		 *
		 * @since 2.18.0
		 *
		 * @param array $tab_data The array with the section data for the specific tab.
		 */
		return apply_filters(
			"affiliatewp_settings_section_{$tab_name}",
			$this->sections[ $tab_name ]
		);
	}

	/**
	 * Register a new block of settings.
	 *
	 * @since 2.18.0
	 *
	 * @param string $tab The tab you want to insert the new section.
	 * @param string $handle Section unique name.
	 * @param string $title Section title.
	 * @param array  $settings The list of settings to render. Must be registered before at get_registered_settings()
	 * @param string $help_text Optional help text to display underneath the title.
	 * @param array  $visibility Set of rules to control the visibility of the field.
	 * @param string $template How the section must be rendered. Default to table.
	 * @param bool   $pro If true, the section will display the Pro badge if the current user doesn't have a Pro license.
	 */
	public function register_section(
		string $tab,
		string $handle,
		string $title,
		array $settings,
		string $help_text = '',
		array $visibility = array(),
		string $template = 'table',
		bool $pro = false
	) {

		if (
			! empty( $visibility ) &&
			(
				! isset( $visibility['required_field'] ) ||
				! isset( $visibility['value'] )
			)
		) {
			throw new \InvalidArgumentException( '$rules expects an array with a required_field and a value' );
		}

		// Add the class to indicate a Pro-only section.
		$classes = $pro && ! affwp_can_access_pro_features() ? 'affwp-section-pro-access-only' : '';

		if ( ! empty( $visibility ) ) {

			if ( ! isset( $visibility['compare'] ) ) {
				$visibility['compare'] = '===';
			}

			$field_val = affiliate_wp()->settings->get( $visibility['required_field'] );

			// We don't save booleans, so we need to convert the visibility value to a integer.
			$visibility['value'] = in_array( $field_val, array( 0, '0', 1, '1' ), true )
				? (int) $visibility['value']
				: $visibility['value'];

			if (
				in_array( $visibility['compare'], array( '==', '===' ), true ) &&
				$field_val !== $visibility['value']
			) {
				$classes .= ' affwp-hidden';
			}

			if (
				in_array( $visibility['compare'], array( '!=', '<>' ), true ) &&
				// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison -- International simple comparison.
				$field_val == $visibility['value']
			) {
				$classes .= ' affwp-hidden';
			}
		}

		$this->sections[ $tab ][ sanitize_title( $handle ) ] = array(
			'title'      => $title,
			'fields'     => $settings,
			'help_text'  => $help_text,
			'visibility' => $visibility,
			'class'      => $classes,
			'is_pro'     => $pro,
			'template'   => in_array( $template, array( 'table', 'affiliate_signup_widget' ), true )
				? $template
				: 'table'
		);
	}

	/**
	 * Retrieve the array of plugin settings
	 *
	 * @since 1.0
	 * @since 2.18.0 Changed settings array to use the get_settings() method.
	 *
	 * @return array
	 */
	public function get_registered_settings() : array {

		/**
		 * Filters the entire default settings array.
		 *
		 * @since 1.0
		 *
		 * @param array $settings Array of default settings.
		 */
		return apply_filters(
			'affwp_settings',
			array(
				'general' =>
					apply_filters(
						'affwp_settings_general',
						$this->get_settings(
							array(
								'license_key',
							)
						)
					),
				'affiliates' =>
					apply_filters(
						'affwp_settings_affiliates',
						$this->get_settings(
							array(
								'affiliates_page',
								'terms_of_use',
								'allow_affiliate_registration',
								'require_approval',
								'additional_registration_modes',
								'recaptcha_type',
								'recaptcha_site_key',
								'recaptcha_secret_key',
								'recaptcha_score_threshold',
								'referral_var',
								'referral_format',
								'referral_pretty_urls',
								'logout_link',
								'affiliate-landing-pages',
							)
						)
					),
				'commissions' =>
					apply_filters(
						'affwp_settings_commissions',
						$this->get_settings(
							array(
								'referral_rate_type',
								'flat_rate_basis',
								'referral_rate',
								'cookie_exp',
								'referral_credit_last',
								'exclude_shipping',
								'exclude_tax',
								'revoke_on_refund',
								'ignore_zero_referrals',
								'paypal_payouts',
								'manual_payouts',
								'payouts_service_about',
								'payouts_service_button',
								'enable_payouts_service',
								'payouts_service_description',
								'payouts_service_notice',
							)
						)
					),
				'integrations' =>
					apply_filters(
						'affwp_settings_integrations',
						$this->get_settings(
							array(
								'integrations',
							)
						)
					),
				'emails' => apply_filters(
					'affwp_settings_emails',
					$this->get_settings(
						array(
							'email_logo',
							'email_template',
							'from_name',
							'from_email',
							'email_notifications',
							'affiliate_email_summaries',
							'affiliate_manager_email',
							'registration_subject',
							'registration_email',
							'new_admin_referral_subject',
							'new_admin_referral_email',
							'referral_subject',
							'referral_email',
							'accepted_subject',
							'accepted_email',
						)
					)
				),
				'opt_in_forms' => apply_filters(
					'affwp_settings_opt_in_forms',
					$this->get_settings(
						array(
							'opt_in_referral_amount',
							'opt_in_referral_status',
							'opt_in_success_message',
							'opt_in_platform',
						)
					)
				),
				'advanced' => apply_filters(
					'affwp_settings_advanced',
					$this->get_settings(
						array(
							'currency',
							'currency_position',
							'thousands_separator',
							'decimal_separator',
							'default_referral_url',
							'cookie_sharing',
							'referral_url_blacklist',
							'terms_of_use_label',
							'disable_monthly_email_summaries',
							'disable_ip_logging',
							'debug_mode',
							'affiliate_area_forms',
							'required_registration_fields',
							'tracking_fallback',
							'uninstall_on_delete',
						)
					)
				),
				'coupons' => apply_filters(
					'affwp_settings_coupons',
					$this->get_settings(
						array(
							'dynamic_coupons_header',
							'coupon_template_woocommerce',
							'dynamic_coupons',
							'dynamic_coupon_customization',
							'coupon_format',
							'coupon_custom_text',
							'coupon_hyphen_delimiter',
						)
					)
				),
			)
		);
	}

	/**
	 * Return the registration modes.
	 *
	 * The array_filter remove empty array items by default, so if we don't have support for the Signup Widget,
	 * we return just the first two options.
	 *
	 * @since 2.18.0
	 *
	 * @return array The registration mode options.
	 */
	private function get_registration_modes() : array {

		return array_filter(
			array(
				'none'                    => __( 'None', 'affiliate-wp' ),
				'auto_register_new_users' => __( 'Automatically register new user accounts as affiliates', 'affiliate-wp' ),
				'affiliate_signup_widget' => $this->supports_affiliate_signup_widgets()
					? __( 'Convert customers into affiliates using the affiliate signup widget', 'affiliate-wp' )
					: '',
			)
		);
	}

	/**
	 * Return all settings.
	 *
	 * @since 2.18.0
	 *
	 * @param array $filter_by If supplied, will return only the specified settings.
	 * @return array An array of settings.
	 */
	public function get_settings( array $filter_by = array() ) : array {

		// get currently logged in username
		$user_info = get_userdata( get_current_user_id() );
		$username  = $user_info ? esc_html( $user_info->user_login ) : '';

		/**
		 * Fires before attempting to retrieve registered settings.
		 *
		 * @since 1.9
		 *
		 * @param Affiliate_WP_Settings $this Settings instance.
		 */
		do_action( 'affwp_pre_get_registered_settings', $this );

		$emails_tags_list = affwp_get_emails_tags_list();

		/* translators: 1: Referral variable example affiliate URL, 2: Username example affiliate URL */
		$referral_pretty_urls_desc = sprintf( __( 'Show pretty affiliate referral URLs to affiliates. For example: <strong>%1$s or %2$s</strong>', 'affiliate-wp' ),
			home_url( '/' ) . affiliate_wp()->tracking->get_referral_var() . '/1',
			home_url( '/' ) . trailingslashit( affiliate_wp()->tracking->get_referral_var() ) . $username
		);

		/*
		 * If both WooCommerce and Polylang are active, show a modified
		 * description for the pretty affiliate URLs setting.
		 */
		if ( function_exists( 'WC' ) && class_exists( 'Polylang' ) ) {
			$referral_pretty_urls_desc .= '<p>' . __( 'Note: Pretty affiliate URLs may not always work as expected when using AffiliateWP in combination with WooCommerce and Polylang.', 'affiliate-wp' ) . '</p>';
		}

		// phpcs:disable WordPress.Arrays.MultipleStatementAlignment.DoubleArrowNotAligned -- Ignore complex array alignment.
		// phpcs:disable WordPress.Arrays.CommaAfterArrayItem.NoComma -- Ignore old code base.
		$settings = array(
			'license_key' => array(
				'name' => __( 'License Key', 'affiliate-wp' ),
				/* translators: Support page URL */
				'desc' => sprintf( __( 'Please enter your license key. An active license key is needed for automatic plugin updates and <a href="%s" target="_blank">support</a>.', 'affiliate-wp' ), 'https://affiliatewp.com/contact/' ),
				'type' => 'license',
				'sanitize_callback' => 'sanitize_text_field'
			),
			'affiliates_page' => array(
				'name' => __( 'Affiliate Account Page', 'affiliate-wp' ),
				'desc' => __( 'This is the page where affiliates will manage their affiliate account.', 'affiliate-wp' ),
				'type' => 'select',
				'options' => affwp_get_pages(),
				'sanitize_callback' => 'absint'
			),
			'terms_of_use' => array(
				'name' => __( 'Terms of Use Page', 'affiliate-wp' ),
				'desc' => sprintf( __( 'Select a Terms of Use page or <a href="%s">create one using a template</a>. This only affects the [affiliate_area] and [affiliate_registration] shortcodes.', 'affiliate-wp' ), esc_url( affwp_admin_url( 'tools', array( 'tab' => 'terms_of_use_generator' ) ) ) ),
				'type' => 'select',
				'options' => affwp_get_pages(),
				'sanitize_callback' => 'absint'
			),
			'terms_of_use_label' => array(
				'name' => __( 'Terms of Use Label', 'affiliate-wp' ),
				'desc' => __( 'The text shown for the Terms of Use checkbox when using the [affiliate_area] or [affiliate_registration] shortcodes. When connected to the Payouts Service, it\'s also shown on the "Payout Settings" form, located within the Settings tab of the Affliate Area.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Agree to our Terms of Use and Privacy Policy', 'affiliate-wp' )
			),
			'referral_var' => array(
				'name' => __( 'Referral Variable', 'affiliate-wp' ),
				/* translators: Affiliate URL example text */
				'desc' => sprintf( __( 'The URL variable for referral URLs. For example: <strong>%s</strong>.', 'affiliate-wp' ), esc_url( add_query_arg( affiliate_wp()->tracking->get_referral_var(), '1', home_url( '/' ) ) ) ),
				'type' => 'text',
				'std' => 'ref'
			),
			'referral_format' => array(
				'name' => __( 'Default Referral Format', 'affiliate-wp' ),
				/* translators: 1: Affiliate URL example with referral variable, 2: Affiliate URL example with username */
				'desc' => sprintf( __( 'Show referral URLs to affiliates with either their affiliate ID or Username appended.<br/> For example: <strong>%1$s or %2$s</strong>.', 'affiliate-wp' ), esc_url( add_query_arg( affiliate_wp()->tracking->get_referral_var(), '1', home_url( '/' ) ) ), esc_url( add_query_arg( affiliate_wp()->tracking->get_referral_var(), $username, home_url( '/' ) ) ) ),
				'type' => 'select',

				/**
				 * The referral format (such as ID or Username)
				 *
				 * @since 1.0
				 *
				 * @param array The available referring formats.
				 */
				'options' => apply_filters(
					'affwp_settings_referral_format',
					array(
						'id'       => __( 'ID', 'affiliate-wp' ),
						'username' => __( 'Username', 'affiliate-wp' ),
					)
				),
				'std' => 'id'
			),
			'referral_pretty_urls' => array(
				'name' => __( 'Pretty Affiliate URLs', 'affiliate-wp' ),
				'desc' => $referral_pretty_urls_desc,
				'type' => 'checkbox',
				'std'  => '1',
			),
			'referral_credit_last' => array(
				'name' => __( 'Credit Last Referrer', 'affiliate-wp' ),
				'desc' => __( 'Credit the last affiliate who referred the customer.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'referral_rate_type' => array(
				'name'    => __( 'Referral Rate Type', 'affiliate-wp' ),
				'desc'    => __( 'Choose a referral rate type. Referrals can be based on either a percentage or a flat rate amount.', 'affiliate-wp' ),
				'type'    => 'radio',
				'options' => affwp_get_affiliate_rate_types(),
				'std'     => 'percentage'
			),
			'flat_rate_basis' => array(
				'name'    => __( 'Flat Rate Referral Basis', 'affiliate-wp' ),
				'desc'    => __( 'Flat rate referrals can be calculated on either a per product or per order basis.', 'affiliate-wp' ),
				'type'    => 'radio',
				'options' => affwp_get_affiliate_flat_rate_basis_types(),
				'class'   => affwp_get_affiliate_rate_type() !== 'flat' ? 'affwp-referral-rate-type-field affwp-hidden' : 'affwp-referral-rate-type-field',
				'std'     => 'per_product'
			),
			'referral_rate' => array(
				'name' => __( 'Referral Rate', 'affiliate-wp' ),
				'desc' => __( 'The default referral rate. A percentage if the Referral Rate Type is set to Percentage, a flat amount otherwise. Referral rates can also be set for each individual affiliate.', 'affiliate-wp' ),
				'type' => 'number',
				'size' => 'small',
				'step' => '0.01',
				'std'  => '20'
			),
			'exclude_shipping' => array(
				'name' => __( 'Exclude Shipping', 'affiliate-wp' ),
				'desc' => __( 'Exclude shipping costs from referral calculations.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'exclude_tax' => array(
				'name' => __( 'Exclude Tax', 'affiliate-wp' ),
				'desc' => __( 'Exclude taxes from referral calculations.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'cookie_exp' => array(
				'name' => __( 'Cookie Expiration', 'affiliate-wp' ),
				'desc' => __( 'Enter how many days the referral tracking cookie should be valid for.', 'affiliate-wp' ),
				'type' => 'number',
				'size' => 'small',
				'std'  => '30',
			),
			'cookie_sharing' => array(
				'name' => __( 'Cookie Sharing', 'affiliate-wp' ),
				'desc' => __( 'Share tracking cookies with sub-domains in a multisite install. When enabled, tracking cookies created on domain.com will also be available on sub.domain.com. Note: this only applies to WordPress Multisite installs.', 'affiliate-wp' ),
				'type' => 'checkbox',
			),
			'currency' => array(
				'name'    => __( 'Currency', 'affiliate-wp' ),
				'desc'    => __( 'Choose your currency. Note that some payment gateways have currency restrictions.', 'affiliate-wp' ),
				'type'    => 'select',
				'options' => affwp_get_currencies(),
			),
			'currency_position' => array(
				'name' => __( 'Currency Symbol Position', 'affiliate-wp' ),
				'desc' => __( 'Choose the location of the currency symbol.', 'affiliate-wp' ),
				'type' => 'select',
				'options' => array(
					'before' => __( 'Before - $10', 'affiliate-wp' ),
					'after' => __( 'After - 10$', 'affiliate-wp' )
				),
			),
			'thousands_separator' => array(
				'name' => __( 'Thousands Separator', 'affiliate-wp' ),
				'desc' => __( 'The symbol (usually , or .) to separate thousands', 'affiliate-wp' ),
				'type' => 'text',
				'size' => 'small',
				'std' => ','
			),
			'decimal_separator' => array(
				'name' => __( 'Decimal Separator', 'affiliate-wp' ),
				'desc' => __( 'The symbol (usually , or .) to separate decimal points', 'affiliate-wp' ),
				'type' => 'text',
				'size' => 'small',
				'std' => '.'
			),
			'form_settings' => array(
				'name' => '<strong>' . __( 'Affiliate Form Shortcode Settings', 'affiliate-wp' ) . '</strong>',
				'type' => 'header'
			),
			'affiliate_area_forms' => array(
				'name' => __( 'Affiliate Area Forms', 'affiliate-wp' ),
				/* translators: Miscellaneous settings screen URL */
				'desc' => sprintf( __( 'Select which form(s) to show on the Affiliate Area page when using the [affiliate_area] shortcode. <a href="%s">Allow Affiliate Registration</a> must be enabled.', 'affiliate-wp' ), admin_url( 'admin.php?page=affiliate-wp-settings&tab=affiliates#allow_affiliate_registration' ) ),
				'type' => 'select',
				'options' => array(
					'both'         => __( 'Affiliate Registration Form and Affiliate Login Form', 'affiliate-wp' ),
					'registration' => __( 'Affiliate Registration Form Only', 'affiliate-wp' ),
					'login'        => __( 'Affiliate Login Form Only', 'affiliate-wp' ),
					'none'         => __( 'None', 'affiliate-wp' )

				)
			),
			'integrations' => array(
				'name' => __( 'Integrations', 'affiliate-wp' ),
				'desc' => __( 'Choose the integrations to enable.', 'affiliate-wp' ),
				'type' => 'multicheck',
				'options' => affiliate_wp()->integrations->get_integrations()
			),
			'opt_in_referral_amount' => array(
				'name' => __( 'Opt-In Referral Amount', 'affiliate-wp' ),
				'type' => 'number',
				'size' => 'small',
				'step' => '0.01',
				'std'  => '0.00',
				'desc' => __( 'Enter the amount affiliates should receive for each opt-in referral. Default is 0.00.', 'affiliate-wp' ),
			),
			'opt_in_referral_status' => array(
				'name' => __( 'Opt-In Referral Status', 'affiliate-wp' ),
				'type' => 'radio',
				'options'  => array(
					'pending' => __( 'Pending', 'affiliate-wp' ),
					'unpaid'  => __( 'Unpaid', 'affiliate-wp' ),
				),
				'std' => 'pending',
				'desc' => __( 'Select the status that should be assigned to opt-in referrals by default.', 'affiliate-wp' ),
			),
			'opt_in_success_message' => array(
				'name' => __( 'Message shown upon opt-in success', 'affiliate-wp' ),
				'type' => 'rich_editor',
				'std'  => 'You have subscribed successfully.',
				'desc' => __( 'Enter the message you would like to show subscribers after they have opted-in successfully.', 'affiliate-wp' ),
			),
			'opt_in_platform' => array(
				'name' => __( 'Platform', 'affiliate-wp' ),
				'desc' => __( 'Select the opt-in platform provider you wish to use then click Save Changes to configure the settings. The opt-in form can be displayed on any page using the [opt_in] shortcode. <a href="https://affiliatewp.com/docs/opt-in-form-settings/" target="_blank" rel="noopener noreferrer">Learn more</a>.', 'affiliate-wp' ),
				'type' => 'select',
				'options' => array_merge( array( '' => __( '(select one)', 'affiliate-wp' ) ), affiliate_wp()->integrations->opt_in->platforms )
			),
			'email_options_header' => array(
				'name' => '<strong>' . __( 'Email Options', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'email_logo' => array(
				'name' => __( 'Logo', 'affiliate-wp' ),
				'desc' => __( 'Upload or choose a logo to be displayed at the top of emails.', 'affiliate-wp' ),
				'type' => 'upload'
			),
			'email_template' => array(
				'name' => __( 'Email Template', 'affiliate-wp' ),
				'desc' => __( 'Choose a template to use for email notifications.', 'affiliate-wp' ),
				'type' => 'select',
				'options' => affwp_get_email_templates()
			),
			'from_name' => array(
				'name' => __( 'From Name', 'affiliate-wp' ),
				'desc' => __( 'The name that emails come from. This is usually your site name.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => get_bloginfo( 'name' )
			),
			'from_email' => array(
				'name' => __( 'From Email', 'affiliate-wp' ),
				'desc' => __( 'The email address to send emails from. This will act as the "from" and "reply-to" address.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => get_bloginfo( 'admin_email' )
			),
			'email_notifications' => array(
				'name' => __( 'Email Notifications', 'affiliate-wp' ),
				'desc' => __( 'The email notifications sent to the affiliate manager and affiliate.', 'affiliate-wp' ),
				'type' => 'multicheck',
				'options' => $this->email_notifications(),
			),
			'affiliate_email_summaries' => array(
				'name' => __( 'Affiliate Email Summaries', 'affiliate-wp' ),
				'desc' => sprintf(

				// Translators: %1$s is going say Learn More with a link and %2$s is a link to view a  sample.
					__( 'Send your affiliates a monthly email summary. %1$s %2$s', 'affiliate-wp' ),

					// %1$s.
					sprintf(
						'%1$s <a href="https://affiliatewp.com/docs/affiliate-email-summaries" target="_blank" rel="noopener noreferrer">%2$s</a>',
						__( 'Learn More', 'affiliate-wp' ),
						__( 'in our documentation.', 'affiliate-wp' )
					),

					// %2$s
					sprintf(
						'<br><em><a href="%1$s" target="_blank" style="margin-left: 25px;">%2$s</a></em>',
						sprintf(
							'?affwp_notify_monthly_affiliate_email_summary=1&preview=1&_wpnonce=%1$s',
							wp_create_nonce( 'preview_email_summary' )
						),
						__( 'View Example', 'affiliate-wp' )
					)
				),
				'type'     => 'checkbox',
				'disabled' => is_multisite(),
			),
			'affiliate_manager_email' => array(
				'name' => __( 'Affiliate Manager Email', 'affiliate-wp' ),
				'desc' => __( 'The email address(es) to receive affiliate manager notifications. Separate multiple email addresses with a comma (,). The admin email address will be used unless overridden.', 'affiliate-wp' ),
				'type' => 'text',
				'std'  => get_bloginfo( 'admin_email' ),
			),
			'registration_options_header' => array(
				'name' => '<strong>' . __( 'Registration Email Options For Affiliate Manager', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'registration_subject' => array(
				'name' => __( 'Registration Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for the registration email sent to affiliate managers when new affiliates register. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'New Affiliate Registration', 'affiliate-wp' )
			),
			'registration_email' => array(
				'name' => __( 'Registration Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send when a new affiliate registers. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				/* translators: Registration email content */
				'std' => sprintf( __( 'A new affiliate has registered on your site, %s', 'affiliate-wp' ), home_url() ) . "\n\n" . __( 'Name: ', 'affiliate-wp' ) . "{name}\n\n{website}\n\n{promo_method}"
			),
			'new_admin_referral_options_header' => array(
				'name' => '<strong>' . __( 'New Referral Email Options for Affiliate Manager', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'new_admin_referral_subject' => array(
				'name' => __( 'New Referral Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for the email sent to site the site affiliate manager when affiliates earn referrals. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Referral Earned!', 'affiliate-wp' )
			),
			'new_admin_referral_email' => array(
				'name' => __( 'New Referral Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send to site affiliate managers when new referrals are earned. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				'std' => __( '{name} has been awarded a new referral of {amount} on {site_name}.', 'affiliate-wp' )
			),
			'new_referral_options_header' => array(
				'name' => '<strong>' . __( 'New Referral Email Options For Affiliate', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'referral_subject' => array(
				'name' => __( 'New Referral Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for new referral emails sent when affiliates earn referrals. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Referral Awarded!', 'affiliate-wp' )
			),
			'referral_email' => array(
				'name' => __( 'New Referral Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send on new referrals. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				/* translators: Home URL */
				'std' => __( 'Congratulations {name}!', 'affiliate-wp' ) . "\n\n" . __( 'You have been awarded a new referral of', 'affiliate-wp' ) . ' {amount} ' . sprintf( __( 'on %s!', 'affiliate-wp' ), home_url() ) . "\n\n" . __( 'Log into your affiliate area to view your earnings or disable these notifications:', 'affiliate-wp' ) . ' {login_url}'
			),
			'accepted_options_header' => array(
				'name' => '<strong>' . __( 'Application Accepted Email Options For Affiliate', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'accepted_subject' => array(
				'name' => __( 'Application Accepted Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for accepted application emails sent to affiliates when their account is approved. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Affiliate Application Accepted', 'affiliate-wp' )
			),
			'accepted_email' => array(
				'name' => __( 'Application Accepted Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send when an application is accepted. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				/* translators: Website URL */
				'std' => __( 'Congratulations {name}!', 'affiliate-wp' ) . "\n\n" . sprintf( __( 'Your affiliate application on %s has been accepted!', 'affiliate-wp' ), home_url() ) . "\n\n" . __( 'Log into your affiliate area at', 'affiliate-wp' ) . ' {login_url}'
			),
			'allow_affiliate_registration' => array(
				'name' => __( 'Allow Affiliate Registration', 'affiliate-wp' ),
				'desc' => __( 'Allow users to register affiliate accounts for themselves.', 'affiliate-wp' ),
				'type' => 'checkbox',
				'std'  => '1',
			),
			'require_approval' => array(
				'name'  => __( 'Require Approval', 'affiliate-wp' ),
				'desc'  => __( 'Require that Pending affiliate accounts must be approved before they can begin earning referrals.', 'affiliate-wp' ),
				'type'  => 'checkbox',
				'std'   => '1',
				'class' => affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ? '' : 'affwp-hidden',
				'visibility' => array(
					'required_field' => 'allow_affiliate_registration',
					'value'          => true,
				),
			),
			'logout_link' => array(
				'name' => __( 'Logout Link', 'affiliate-wp' ),
				'desc' => __( 'Enabling this will show the logout link in both the Affiliate Area and the Affiliate Portal.', 'affiliate-wp' ),
				'type' => 'checkbox',
			),
			'default_referral_url' => array(
				'name' => __( 'Default Referral URL', 'affiliate-wp' ),
				'desc' => __( 'The default referral URL shown in the Affiliate Area.', 'affiliate-wp' ),
				'type' => 'url'
			),
			'recaptcha_type' => array(
				'name' => __( 'reCAPTCHA Type', 'affiliate-wp' ),
				'type' => 'radio',
				'options'  => array(
					'none' => __( 'None', 'affiliate-wp' ),
					'v2'   => __( 'reCAPTCHA v2 ("I\'m not a robot" Checkbox)', 'affiliate-wp' ),
					'v3'   => __( 'reCAPTCHA v3', 'affiliate-wp' ),
				),
				'std' => 'none',
				'desc' => sprintf(
					__( 'Select the reCAPTCHA type. <a href="%s" target="_blank" rel="noopener noreferrer">View our reCAPTCHA documentation</a> to learn more and for step-by-step instructions.', 'affiliate-wp' ),
					'https://affiliatewp.com/docs/how-to-set-up-and-use-recaptcha-in-affiliatewp/'
				),

			),
			'recaptcha_site_key' => array(
				'name' => __( 'reCAPTCHA Site Key', 'affiliate-wp' ),
				'desc' => __( 'This is used to identify your site to Google reCAPTCHA.', 'affiliate-wp' ),
				'type' => 'text',
				'class'   => in_array( affwp_recaptcha_type(), array( 'v2', 'v3' ), true ) ? '' : 'affwp-hidden',
				'visibility' => array(
					'required_field' => 'recaptcha_type',
					'value'          => 'none',
					'compare'        => '!=',
				),
			),
			'recaptcha_secret_key' => array(
				'name' => __( 'reCAPTCHA Secret Key', 'affiliate-wp' ),
				'desc' => __( 'This is used for communication between your site and Google reCAPTCHA. Be sure to keep it a secret.', 'affiliate-wp' ),
				'type' => 'text',
				'class'   => in_array( affwp_recaptcha_type(), array( 'v2', 'v3' ), true ) ? '' : 'affwp-hidden',
				'visibility' => array(
					'required_field' => 'recaptcha_type',
					'value'          => 'none',
					'compare'        => '!=',
				),
			),
			'recaptcha_score_threshold' => array(
				'name' => __( 'reCAPTCHA Score Threshold', 'affiliate-wp' ),
				'type' => 'number',
				'size' => 'small',
				'step' => '0.1',
				'std'  => '0.4',
				'min'  => '0.0',
				'max'  => '1.0',
				'class'   => affwp_recaptcha_type() === 'v3' ? '' : 'affwp-hidden',
				'visibility' => array(
					'required_field' => 'recaptcha_type',
					'value'          => 'v3',
				),
				'desc' => __( 'reCAPTCHA v3 returns a score (1.0 is very likely a good interaction, 0.0 is very likely a bot). If the score less than or equal to this threshold, the affiliate registration will be blocked.', 'affiliate-wp' ),
			),
			'revoke_on_refund' => array(
				'name' => __( 'Reject Unpaid Referrals on Refund', 'affiliate-wp' ),
				'desc' => __( 'Automatically reject Unpaid referrals when the originating purchase is refunded or revoked.', 'affiliate-wp' ),
				'type' => 'checkbox',
				'std'  => '1'
			),
			'tracking_fallback' => array(
				'name' => __( 'Use Fallback Referral Tracking Method', 'affiliate-wp' ),
				'desc' => __( 'The method used to track referral links can fail on sites that have jQuery errors. Enable Fallback Tracking if referrals are not being tracked properly.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'ignore_zero_referrals' => array(
				'name' => __( 'Ignore Referrals with Zero Amount', 'affiliate-wp' ),
				'desc' => __( 'Ignore referrals with a zero amount. This can be useful for multi-price products that start at zero, or if a discount was used which resulted in a zero amount. NOTE: If this setting is enabled and a visit results in a zero referral, the visit will be considered not converted.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'disable_ip_logging' => array(
				'name' => __( 'Disable IP Address Logging', 'affiliate-wp' ),
				'desc' => __( 'Disable logging of the customer IP address.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'debug_mode' => array(
				'name' => __( 'Enable Debug Mode', 'affiliate-wp' ),
				/* translators: Tools screen URL */
				'desc' => sprintf( __( 'Enable debug mode. This will turn on error logging for the referral process to help identify issues. Logs are kept in <a href="%s">Affiliates &rarr; Tools</a>.', 'affiliate-wp' ), esc_url( affwp_admin_url( 'tools', array( 'tab' => 'debug' ) ) ) ),
				'type' => 'checkbox'
			),
			'referral_url_blacklist' => array(
				'name' => __( 'Referral URL Blacklist', 'affiliate-wp' ),
				'desc' => __( 'URLs placed here will be blocked from generating referrals. Enter one URL per line. NOTE: This will only apply to new visits after the URL has been saved.', 'affiliate-wp' ),
				'type' => 'textarea'
			),
			'betas' => array(
				'name' => __( 'Opt into development versions', 'affiliate-wp' ),
				'desc' => __( 'Receive update notifications for development releases. When development versions are available, an update notification will be shown on your Plugins page.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'uninstall_on_delete' => array(
				'name' => __( 'Remove Data on Uninstall', 'affiliate-wp' ),
				'desc' => __( 'Remove all saved data for AffiliateWP when the plugin is deleted.', 'affiliate-wp' ),
				'type' => 'checkbox'
			),
			'disable_monthly_email_summaries' => array( // Also see affwp_email_summary() on naming of this setting.
				'name' => __( 'Disable Email Summaries', 'affiliate-wp' ),
				'desc' => sprintf(
				// Translators: %1$s is a link to preview the email.
					__( 'Disable Email Summaries monthly delivery. %1$s', 'affiliate-wp' ),
					sprintf(
						'<br><span style="margin-left: 25px;"><em><a href="?affwp_notify_monthly_email_summary=1&preview=1&no_dyk=1&_wpnonce=%1$s" target="_blank">%2$s</a></em></span>',
						wp_create_nonce( 'preview_email_summary' ),
						__( 'View Email Summary Example', 'affiliate-wp' )
					)
				),
				'type' => 'checkbox',
			),
			'manual_payouts' => array(
				'name' => __( 'Manual Payouts', 'affiliate-wp' ),
				'desc' => __( 'Pay your affiliates manually. Affiliates can be paid via PayPal, Skrill, a bank transfer, and other options', 'affiliate-wp' ),
				'type' => 'checkbox',
				'std'  => '0',
			),
			'payouts_service_about' => array(
				'name' => '<strong>' . __( 'Payouts Service', 'affiliate-wp' ) . '</strong>',
				'desc' => $this->payouts_service_about(),
				'type' => 'descriptive_text',
			),
			'payouts_service_button' => array(
				'name' => __( 'Connection Status', 'affiliate-wp' ),
				'desc' => $this->payouts_service_connection_status(),
				'type' => 'descriptive_text',
			),
			'enable_payouts_service' => array(
				'name' => __( 'Payouts Service', 'affiliate-wp' ),
				/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
				'desc' => sprintf( __( 'Enable the %s.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ),
				'type' => 'checkbox',
				'std'  => '1',
			),
			'payouts_service_description' => array(
				'name' => __( 'Registration Form Description', 'affiliate-wp' ),
				'desc' => __( 'This will be displayed above the Payouts Service registration form fields. Here you can explain to your affiliates how/why to register for the Payouts Service.', 'affiliate-wp' ),
				'type' => 'textarea',
			),
			'payouts_service_notice' => array(
				'name' => __( 'Payouts Service Notice', 'affiliate-wp' ),
				'desc' => __( 'This will be displayed at the top of each tab of the Affiliate Area for affiliates that have not registered their payout account.', 'affiliate-wp' ),
				'type' => 'textarea',
			),
			'coupon_template_woocommerce'  => array(
				'name'             => __( 'Coupon Template', 'affiliate-wp' ),
				'desc'             => __( 'All dynamic coupons will use the settings from the selected coupon template.', 'affiliate-wp' ),
				'type'             => 'select',
				'options_callback' => $this->get_integration_callback( 'woocommerce', 'coupon_templates', 'options' ),
			),
			'dynamic_coupons'              => array(
				'name' => __( 'Automatically Generate Coupons', 'affiliate-wp' ),
				/* translators: Tools screen URL */
				'desc' => sprintf( __( 'Automatically generate a coupon code for each registered affiliate.<p class="description">To bulk generate coupons for existing affiliates visit the <a href="%s">Tools</a> screen.</p>', 'affiliate-wp' ), esc_url( affwp_admin_url( 'tools', array( 'tab' => 'coupons' ) ) ) ),
				'type' => 'checkbox',
			),
			'dynamic_coupon_customization' => array(
				'name' => __( 'Dynamic Coupon Customization', 'affiliate-wp' ),
				'type' => 'header',
			),
			'coupon_format'                => array(
				'name'    => __( 'Coupon Format', 'affiliate-wp' ),
				'desc'    => __( 'Select a coupon format for dynamically generated coupons.', 'affiliate-wp' ),
				'type'    => 'select',
				'options' => $this->list_coupon_format_options(),
			),
			'coupon_custom_text'           => array(
				'name' => __( 'Custom Text', 'affiliate-wp' ),
				'desc' => __( 'Text to use within the {custom_text} merge tag of the Coupon Format option.', 'affiliate-wp' ),
				'type' => 'text',
			),
			'coupon_hyphen_delimiter'      => array(
				'name' => __( 'Hyphen Delimiter', 'affiliate-wp' ),
				'desc' => __( 'Add a hyphen between each merge tag.', 'affiliate-wp' ),
				'type' => 'checkbox',
			),
			'additional_registration_modes' => array(
				'name' => __( 'Additional Registration Modes', 'affiliate-wp' ),
				'desc' => __( 'Additional Registration Modes can be used alongside the standard affiliate registration form(s).', 'affiliate-wp' ),
				'type' => 'radio',
				'options'  => $this->get_registration_modes(),
				'std' => 'none',
				'education_modal' => array(
					'options' => array(
						'affiliate_signup_widget' => array(
							'enabled'     => ! affwp_can_access_pro_features(),
							'name'        => __( 'Affiliate Signup Widget', 'affiliate-wp' ),
							'utm_content' => __( 'affiliate-signup-widget', 'affiliate-wp' ),
						)
					),
				),
			),
			'affiliate_signup_widget_image' => array(
				'name' => __( 'Image', 'affiliate-wp' ),
				'desc' => __( 'Upload or choose an image to be displayed within the widget.', 'affiliate-wp' ),
				'type' => 'upload',
			),
			'affiliate_signup_widget_brand_color' => array(
				'name' => __( 'Brand Color', 'affiliate-wp' ),
				'desc' => __( 'Select your brand color for the widget.', 'affiliate-wp' ),
				'type' => 'color',
				'std'  => '#4b64e2',
			),
			'affiliate_signup_widget_heading_text' => array(
				'name' => __( 'Heading', 'affiliate-wp' ),
				'desc' => __( 'The widget\'s heading.', 'affiliate-wp' ),
				'type' => 'text',
				'std'  => __( 'Earn with every referral!', 'affiliate-wp' ),
			),
			'affiliate_signup_widget_text' => array(
				'name' => __( 'Text', 'affiliate-wp' ),
				'desc' => __( 'Concise, clear text enhances conversions. We recommend a maximum of 150 characters for effective engagement.', 'affiliate-wp' ),
				'type' => 'textarea',
				'size' => 'large',
				'rows' => 3,
				'std'  => __( 'Join our affiliate program and earn commission on every sale you refer', 'affiliate-wp' ),
			),
			'affiliate_signup_widget_button_text' => array(
				'name' => __( 'Button Text', 'affiliate-wp' ),
				'desc' => __( 'The widget\'s button text.', 'affiliate-wp' ),
				'type' => 'text',
				'std'  => __( 'Start Earning Today', 'affiliate-wp' ),
			),
			'affiliate_signup_widget_confirmation_heading_text' => array(
				'name' => __( 'Confirmation Heading', 'affiliate-wp' ),
				'desc' => __( 'The widget\'s confirmation heading.', 'affiliate-wp' ),
				'type' => 'text',
				'std'  => __( 'Congrats, you\'re in! Start earning now', 'affiliate-wp' ),
			),
			'affiliate_signup_widget_confirmation_text' => array(
				'name' => __( 'Confirmation Text', 'affiliate-wp' ),
				'desc' => __( 'The widget\'s confirmation text.', 'affiliate-wp' ),
				'type' => 'textarea',
				'size' => 'large',
				'rows' => 3,
				'std'  => __( 'Share your affiliate link below with friends. When they buy, you earn!', 'affiliate-wp' ),
			),
		);
		// phpcs:enable WordPress.Arrays.MultipleStatementAlignment.DoubleArrowNotAligned
		// phpcs:enable WordPress.Arrays.CommaAfterArrayItem.NoComma

		$addons = array(
			'landing_pages'  => array(
				'id'   => 167098,
				'name' => 'affiliate-landing-pages',
				'path' => 'affiliatewp-affiliate-landing-pages/affiliatewp-affiliate-landing-pages.php',
			),
			'paypal_payouts' => array(
				'id'   => 345,
				'name' => 'paypal-payouts',
				'path' => 'affiliate-wp-paypal-payouts/affiliate-wp-paypal-payouts.php',
			),
		);

		$addons = array_map(
			function ( $addon ) {
				$addon['status'] = affwp_get_addon_status( $addon['path'] );
				return $addon;
			},
			$addons
		);

		$settings['affiliate-landing-pages'] = array(
			'name'            => __( 'Landing Pages', 'affiliate-wp' ),
			'desc'            => __( 'Check this option to enable Affiliate Landing Pages.', 'affiliate-wp' ),
			'type'            => 'checkbox',
			'education_modal' => array(
				'enabled'        => ! affwp_can_access_pro_features(),
				'name'           => __( 'Affiliate Landing Pages', 'affiliate-wp' ),
				'utm_content'    => __( 'affiliate-landing-pages', 'affiliate-wp' ),
				'require_addon'  => $addons['landing_pages'],
				'show_pro_badge' => false,
				'is_checked'     => affiliate_wp()->settings->get( 'affiliate-landing-pages' ) === 1,
			),
		);

		$settings['paypal_payouts'] = array(
			'name'            => __( 'PayPal Payouts', 'affiliate-wp' ),
			'desc'            => __( 'Enable the PayPal Payouts payment method', 'affiliate-wp' ),
			'type'            => 'checkbox',
			'std'             => '0',
			 'education_modal' => array(
			 	'enabled'       => false,
				'show_pro_badge' => false,
			 	'name'          => __( 'PayPal Payouts', 'affiliate-wp' ),
			 	'utm_content'   => __( 'PayPal Payouts', 'affiliate-wp' ),
			 	'require_addon' => $addons['paypal_payouts'],
			 	'is_checked'    => affiliate_wp()->settings->get( 'paypal_payouts' ) === 1,
			 ),
		);

		if ( empty( $filter_by ) ) {
			return $settings; // No filters, return all settings.
		}

		// Return only specific settings.
		return array_intersect_key( $settings, array_flip( $filter_by ) );
	}

	/**
	 * Required Registration Fields
	 *
	 * @since 2.0
	 * @param array $general_settings
	 * @return array
	 */
	function required_registration_fields( $general_settings ) {

		if ( ! affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) {
			return $general_settings;
		}

		$new_general_settings = array(
			'required_registration_fields' => array(
				'name' => __( 'Required Registration Fields', 'affiliate-wp' ),
				'desc' => __( 'Select which fields should be required for affiliate registration when using the [affiliate_area] or [affiliate_registration] shortcodes. The <strong>Username</strong> and <strong>Account Email</strong> form fields are always required. The <strong>Password</strong> form field will be removed if not required.', 'affiliate-wp' ),
				'type' => 'multicheck',
				'options' => array(
					'password'         => __( 'Password', 'affiliate-wp' ),
					'your_name'        => __( 'Your Name', 'affiliate-wp' ),
					'website_url'      => __( 'Website URL', 'affiliate-wp' ),
					'payment_email'    => __( 'Payment Email', 'affiliate-wp' ),
					'promotion_method' => __( 'How will you promote us?', 'affiliate-wp' ),
				)
			)

		);

		return array_merge( $general_settings, $new_general_settings );

	}

	/**
	 * Email notifications
	 *
	 * @since 2.2
	 * @param boolean $install Whether or not the install script has been run.
	 *
	 * @return array $emails
	 */
	public function email_notifications( $install = false ) {

		$emails = array(
			'admin_affiliate_registration_email'       => __( 'Notify affiliate manager when a new affiliate has registered', 'affiliate-wp' ),
			'admin_new_referral_email'                 => __( 'Notify affiliate manager when a new referral has been created', 'affiliate-wp' ),
			'affiliate_new_referral_email'             => __( 'Notify affiliate when they earn a new referral', 'affiliate-wp' ),
			'affiliate_application_accepted_email'     => __( 'Notify affiliate when their affiliate application is accepted', 'affiliate-wp' ),
			'affiliate_application_accepted_email'     => __( 'Notify affiliate when their affiliate application is accepted', 'affiliate-wp' ),
		);

		if ( $this->get( 'require_approval' ) || true === $install ) {
			$emails['affiliate_application_pending_email']  = __( 'Notify affiliate when their affiliate application is pending', 'affiliate-wp' );
			$emails['affiliate_application_rejected_email'] = __( 'Notify affiliate when their affiliate application is rejected', 'affiliate-wp' );
		}

		return $emails;

	}

	/**
	 * Affiliate application approval settings
	 *
	 * @since 1.6.1
	 * @param array $email_settings
	 * @return array
	 */
	function email_approval_settings( $email_settings ) {

		if ( ! affiliate_wp()->settings->get( 'require_approval' ) ) {
			return $email_settings;
		}

		$emails_tags_list = affwp_get_emails_tags_list();

		$new_email_settings = array(
			'pending_options_header' => array(
				'name' => '<strong>' . __( 'Application Pending Email Options For Affiliate', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'pending_subject' => array(
				'name' => __( 'Application Pending Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for pending affiliate application emails. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Your Affiliate Application Is Being Reviewed', 'affiliate-wp' )
			),
			'pending_email' => array(
				'name' => __( 'Application Pending Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send when an application is pending. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				'std' => __( 'Hi {name}!', 'affiliate-wp' ) . "\n\n" . __( 'Thanks for your recent affiliate registration on {site_name}.', 'affiliate-wp' ) . "\n\n" . __( 'We&#8217;re currently reviewing your affiliate application and will be in touch soon!', 'affiliate-wp' ) . "\n\n"
			),
			'rejection_options_header' => array(
				'name' => '<strong>' . __( 'Application Rejection Email Options For Affiliate', 'affiliate-wp' ) . '</strong>',
				'desc' => '',
				'type' => 'header'
			),
			'rejection_subject' => array(
				'name' => __( 'Application Rejection Email Subject', 'affiliate-wp' ),
				'desc' => __( 'Enter the subject line for rejected affiliate application emails. Supports template tags.', 'affiliate-wp' ),
				'type' => 'text',
				'std' => __( 'Your Affiliate Application Has Been Rejected', 'affiliate-wp' )
			),
			'rejection_email' => array(
				'name' => __( 'Application Rejection Email Content', 'affiliate-wp' ),
				'desc' => __( 'Enter the email to send when an application is rejected. HTML is accepted. Available template tags:', 'affiliate-wp' ) . '<br />' . $emails_tags_list,
				'type' => 'rich_editor',
				'std' => __( 'Hi {name},', 'affiliate-wp' ) . "\n\n" . __( 'We regret to inform you that your recent affiliate registration on {site_name} was rejected.', 'affiliate-wp' ) . "\n\n"
			)

		);

		return array_merge( $email_settings, $new_email_settings );
	}

	/**
	 * Header Callback
	 *
	 * Renders the header.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting
	 * @return void
	 */
	function header_callback( $args ) {
		return;
	}

	/**
	 * Checkbox Callback
	 *
	 * Renders checkboxes.
	 *
	 * @since 1.0
	 * @since 2.18.0 Support product education modal.
	 *
	 * @param array $args Arguments passed by the setting
	 *
	 * @global $this->options Array of all the AffiliateWP Options
	 */
	function checkbox_callback( array $args ) {

		$checked = '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$checked = checked( 1, $this->options[ $args['id'] ], false );
		} elseif ( ! empty( $args['std'] ) ) {
			$checked = checked( true, true, false );
		}

		$disabled = $this->is_setting_disabled( $args ) ? disabled( $args['disabled'], true, false ) : '';

		// Check if you must show any education modal.
		$show_education = isset( $args['education_modal']['enabled'] ) && true === $args['education_modal']['enabled'];

		// Check if it requires any addon to activate this option.
		$addon_status = ! $show_education && isset( $args['education_modal']['require_addon']['path'] )
			? affwp_get_addon_status( $args['education_modal']['require_addon']['path'] )
			: '';

		$has_addon_notice =
			'active' !== $addon_status &&
			isset( $args['education_modal']['is_checked'] ) &&
			$args['education_modal']['is_checked'];
		$disabled         = $has_addon_notice ? disabled( true, true, false ) : $disabled;

		// Translate the addon status to the right action.
		if ( 'missing' === $addon_status ) {
			$addon_action = 'install';
		} elseif ( 'installed' === $addon_status ) {
			$addon_action = 'activate';
		} else {
			$addon_action = '';
		}

		// Check if any action has to be taken and then set the id.
		$addon_id = ! empty( $addon_action ) && isset( $args['education_modal']['require_addon']['id'] )
			? $args['education_modal']['require_addon']['id']
			: '';

		// Check if any action has to be taken and then set the path.
		$addon_path = ! empty( $addon_action ) && isset( $args['education_modal']['require_addon']['path'] )
			? $args['education_modal']['require_addon']['path']
			: '';

		$addon_nonce = ! empty( $addon_action ) ? wp_create_nonce( 'affiliate-wp-addons-nonce' ) : '';

		// Education name and UTM.
		$education_name = $show_education || ! empty( $addon_action ) && isset( $args['education_modal']['name'] ) ? $args['education_modal']['name'] : '';
		$education_utm  = $show_education || ! empty( $addon_action ) && isset( $args['education_modal']['utm_content'] ) ? $args['education_modal']['utm_content'] : '';

		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- affiliatewp_tag_attr() already escape content.

		?>

		<label for="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>">
			<input
				type="checkbox"
				id="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>"
				name="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>"
				value="1"
				<?php echo affiliatewp_tag_attr( 'class', $show_education || ! empty( $addon_action ) ? 'affwp-education-modal' : '' ); ?>
				<?php echo affiliatewp_tag_attr( 'data-name', $education_name ); ?>
				<?php echo affiliatewp_tag_attr( 'data-utm-content', $education_utm ); ?>
				<?php echo affiliatewp_tag_attr( 'data-action', $addon_action ); ?>
				<?php echo affiliatewp_tag_attr( 'data-id', $addon_id ); ?>
				<?php echo affiliatewp_tag_attr( 'data-plugin', $addon_path ); ?>
				<?php echo affiliatewp_tag_attr( 'data-nonce', $addon_nonce ); ?>
				<?php echo $disabled; ?>
				<?php echo $checked; ?>
			>&nbsp;<?php echo wp_kses( $args['desc'], affwp_kses() ); ?>
		</label>

		<?php if ( $has_addon_notice ) : ?>
			<br>
			<p class="affwp-missing-addon-for-active-setting">

				<?php ob_start(); ?>

				<span
					class="affwp-education-modal"
					<?php echo affiliatewp_tag_attr( 'data-name', $education_name ); ?>
					<?php echo affiliatewp_tag_attr( 'data-utm-content', $education_utm ); ?>
					<?php echo affiliatewp_tag_attr( 'data-action', $addon_action ); ?>
					<?php echo affiliatewp_tag_attr( 'data-id', $addon_id ); ?>
					<?php echo affiliatewp_tag_attr( 'data-plugin', $addon_path ); ?>
					<?php echo affiliatewp_tag_attr( 'data-nonce', $addon_nonce ); ?>
				>
					<?php echo esc_html( $education_name ); ?>
				</span>

				<?php $addon_clickable_el = ob_get_clean(); ?>

				<?php

				echo sprintf(
					// Translators: %1$s is the addon name.
					__( 'The required addon for this feature is currently deactivated. Please activate the %1$s addon to use this feature.', 'affiliate-wp' ),
					// %1$s: Addon name.
					$addon_clickable_el
				);

				?>
			</p>
		<?php endif; ?>

		<?php

		// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Multicheck Callback
	 *
	 * Renders multiple checkboxes.
	 *
	 * @since 1.0
	 * @since 2.18.0 Support for product education modals.
	 *
	 * @param array $args Arguments passed by the setting.
	 *
	 * @global $this->options Array of all the AffiliateWP Options.
	 */
	function multicheck_callback( array $args ) {

		if ( ! empty( $args['options'] ) ) {

			foreach ( $args['options'] as $key => $option ) {

				$enabled    = isset( $this->options[ $args['id'] ][ $key ] ) ? $option : null;
				$field_name = "affwp_settings[{$args['id']}][{$key}]";

				$show_education = isset( $args['education_modal']['options'][ $key ]['enabled'] ) && true === $args['education_modal']['options'][ $key ]['enabled'];
				$education_name = $show_education && isset( $args['education_modal']['options'][ $key ]['name'] )
					? $args['education_modal']['options'][ $key ]['name']
					: '';
				$education_utm  = $show_education && isset( $args['education_modal']['options'][ $key ]['utm_content'] )
					? $args['education_modal']['options'][ $key ]['utm_content']
					: '';

				$show_pro_badge =
					$show_education &&
					! affwp_can_access_pro_features() &&
					! empty( $args['education_modal'] ) &&
					(
						(
							isset( $args['education_modal']['show_pro_badge'] ) &&
							true === $args['education_modal']['show_pro_badge']
						) ||
						! isset( $args['education_modal']['show_pro_badge'] )
					);

				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- affiliatewp_tag_attr() already escape content.

				?>
					<label for="<?php echo esc_attr( $field_name ); ?>">
						<input
							type="checkbox"
							name="<?php echo esc_attr( $field_name ); ?>"
							id="<?php echo esc_attr( $field_name ); ?>"
							value="<?php echo esc_attr( $option ); ?>"
							<?php echo affiliatewp_tag_attr( 'class', $show_education ? 'affwp-education-modal addProBadge' : '' ); ?>
							<?php echo affiliatewp_tag_attr( 'data-name', $education_name ); ?>
							<?php echo affiliatewp_tag_attr( 'data-utm-content', $education_utm ); ?>
							<?php echo checked( $option, $enabled, false ); ?>
						> <?php echo $option ?>
					</label>
					<?php if ( $show_pro_badge ) : ?>
						<span class="affwp-settings-label-pro">Pro</span>
					<?php endif; ?>
					<br>
				<?php
			}

			?>

			<p class="description"><?php echo wp_kses( $args['desc'], affwp_kses() ); ?></p>

			<?php

			// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Radio Callback
	 *
	 * Renders radio boxes.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting.
	 * @global $this->options Array of all the AffiliateWP Options.
	 * @return void
	 */
	function radio_callback( array $args ) {

		?>

		<fieldset id="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>">
		<legend class="screen-reader-text"><?php echo esc_attr( $args['name'] ); ?></legend>

		<?php

		foreach ( $args['options'] as $key => $option ) {

			$checked  = false;
			$disabled = false;

			$field_name = "affwp_settings[{$args['id']}][{$key}]";

			if ( isset( $this->options[ $args['id'] ] ) && $this->options[ $args['id'] ] == $key ) {
				$checked = true;
			} elseif ( isset( $args['std'] ) && $args['std'] == $key && ! isset( $this->options[ $args['id'] ] ) ) {
				$checked = true;
			}

			if ( isset( $args['disabled'] ) && $args['disabled'] ) {
				$disabled = true;
			}

			$show_education = isset( $args['education_modal']['options'][ $key ]['enabled'] ) && true === $args['education_modal']['options'][ $key ]['enabled'];
			$education_name = $show_education && isset( $args['education_modal']['options'][ $key ]['name'] )
				? $args['education_modal']['options'][ $key ]['name']
				: '';
			$education_utm  = $show_education && isset( $args['education_modal']['options'][ $key ]['utm_content'] )
				? $args['education_modal']['options'][ $key ]['utm_content']
				: '';

			$show_pro_badge =
				$show_education &&
				! affwp_can_access_pro_features() &&
				! empty( $args['education_modal'] ) &&
				(
					(
						isset( $args['education_modal']['show_pro_badge'] ) &&
						true === $args['education_modal']['show_pro_badge']
					) ||
					! isset( $args['education_modal']['show_pro_badge'] )
				);

				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- affiliatewp_tag_attr() already escape content.

			?>

				<label for="<?php echo esc_attr( $field_name ); ?>">
					<input
						type="radio"
						name="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>"
						id="<?php echo esc_attr( $field_name ); ?>"
						value="<?php echo esc_attr( $key ); ?>"
						<?php echo checked( true, $checked, false ); ?>
						<?php echo disabled( true, $disabled, false ); ?>
						<?php echo affiliatewp_tag_attr( 'class', $show_education ? 'affwp-education-modal addProBadge' : '' ); ?>
						<?php echo affiliatewp_tag_attr( 'data-name', $education_name ); ?>
						<?php echo affiliatewp_tag_attr( 'data-utm-content', $education_utm ); ?>
					> <?php echo $option ?>
				</label>
				<?php if ( $show_pro_badge ) : ?>
					<span class="affwp-settings-label-pro">Pro</span>
				<?php endif; ?>
				<br>

			<?php

			// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		?>
		</fieldset><p class="description"><?php echo wp_kses( $args['desc'], affwp_kses() ); ?></p>
		<?php
	}

	/**
	 * Color Callback
	 *
	 * Renders a color field.
	 *
	 * @since 2.18.0
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function color_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) && ! empty( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		// Must use a 'readonly' attribute over disabled to ensure the value is passed in $_POST.
		$readonly = $this->is_setting_disabled( $args ) ? __checked_selected_helper( $args['disabled'], true, false, 'readonly' ) : '';

		$html = '<div style="display: flex; align-items: center; gap: 0.5rem;">';
		$html .= '<input type="color" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '" ' . $readonly . '/>';
		$html .= '<a href="#" class="affwp-reset-color-link">Reset</a>';
		$html .= '</div>';
		$html .= '<p class="description">'  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Text Callback
	 *
	 * Renders text fields.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function text_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) && ! empty( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		// Must use a 'readonly' attribute over disabled to ensure the value is passed in $_POST.
		$readonly = $this->is_setting_disabled( $args ) ? __checked_selected_helper( $args['disabled'], true, false, 'readonly' ) : '';

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="text" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '" ' . $readonly . '/>';
		$html .= '<p class="description">'  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * URL Callback
	 *
	 * Renders URL fields.
	 *
	 * @since 1.7.15
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function url_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="url" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$html .= '<p class="description">'  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * License Callback
	 *
	 * Renders license key fields.
	 *
	 * @since 1.0
	 *
	 * @global $this->options Array of all the AffiliateWP Options
	 *
	 * @param array $args Arguments passed by the setting.
	 *
	 * @return void
	 */
	function license_callback( $args ) {
	//	$status = $this->get( 'license_status' );
		$status ='valid';


		if (
			is_object( $status ) &&
			isset( $status->license )
		) {
			$status = $status->license;
		}

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		} else {
			$value = '';
		}

		$license_key = self::get_license_key( $value );

		// If the license is active and valid, set the field to disabled (readonly).
		if ( 'valid' === $status && ! empty( $license_key ) ) {
			$args['disabled'] = true;

			if ( self::global_license_set() ) {
				$args['desc'] = __( 'Your license key is globally defined via <code>AFFILIATEWP_LICENSE_KEY</code> set in <code>wp-config.php</code>.<br />It cannot be modified from this screen.', 'affiliate-wp' );
			} else {
				$args['desc'] = __( 'Deactivate your license key to make changes to this setting.', 'affiliate-wp' );
			}
		}

		// Must use a 'readonly' attribute over disabled to ensure the value is passed in $_POST.
		$readonly = $this->is_setting_disabled( $args ) ? __checked_selected_helper( $args['disabled'], true, false, 'readonly' ) : '';

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="password" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $license_key ) ) . '" ' . $readonly . '/>';

		if( 'valid' === $status && ! empty( $license_key ) ) {
			$html .= get_submit_button( __( 'Deactivate License', 'affiliate-wp' ), 'secondary', 'affwp_deactivate_license', false );
			$html .= '<span style="color:green;">&nbsp;' . __( 'Your license is valid!', 'affiliate-wp' ) . '</span>';
		} elseif( 'expired' === $status && ! empty( $license_key ) ) {
			$renewal_url = esc_url( add_query_arg( array( 'edd_license_key' => $license_key, 'download_id' => 17 ), 'https://affiliatewp.com/checkout' ) );
			$html .= '<a href="' . esc_url( $renewal_url ) . '" class="button-primary">' . __( 'Renew Your License', 'affiliate-wp' ) . '</a>';
			$html .= '<br/><span style="color:red;">&nbsp;' . __( 'Your license has expired, renew today to continue getting updates and support!', 'affiliate-wp' ) . '</span>';
		} else {
			$html .= get_submit_button( __( 'Activate License', 'affiliate-wp' ), 'secondary', 'affwp_activate_license', false );
		}

		$license_info_markup = $this->get_current_license_markup();

		// Show the current active license, if any.
		$html .= empty( trim( $license_info_markup ) )
			? "<p class='description'>{$args['desc']}</p>"
			: "<p class='description'>{$license_info_markup}<br>{$args['desc']}</p>";

		echo $html;
	}

	/**
	 * Get markup for License.
	 *
	 * @since 2.9.6
	 *
	 * @return string Markup (HTML).
	 */
	private function get_current_license_markup() {

		$license_data = new \AffWP\Core\License\License_Data();

		$license_id = $license_data->get_license_id();

		$license_type = $license_data->get_license_type( $license_id );

		if ( ! is_string( $license_type ) || empty( $license_type ) ) {
			return '';
		}

		// Show what License the user is using.
		return sprintf(

			// Translators: %1$s is the license name.
			__( 'Your license level is <strong>%1$s</strong>.', 'affiliate-wp' ),

			// %$1s: License name.
			$license_type
		);
	}

	/**
	 * Number Callback
	 *
	 * Renders number fields.
	 *
	 * @since 1.9
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function number_callback( $args ) {

		// Get value, with special consideration for 0 values, and never allowing negative values
		$value = isset( $this->options[ $args['id'] ] ) ? $this->options[ $args['id'] ] : null;
		$value = ( ! is_null( $value ) && '' !== $value && floatval( $value ) >= 0 ) ? floatval( $value ) : null;

		// Saving the field empty will revert to std value, if it exists
		$std   = ( isset( $args['std'] ) && ! is_null( $args['std'] ) && '' !== $args['std'] && floatval( $args['std'] ) >= 0 ) ? $args['std'] : null;
		$value = ! is_null( $value ) ? $value : ( ! is_null( $std ) ? $std : null );
		$value = affwp_abs_number_round( $value );

		// Other attributes and their defaults
		$max  = isset( $args['max'] )  ? $args['max']  : 999999999;
		$min  = isset( $args['min'] )  ? $args['min']  : 0;
		$step = isset( $args['step'] ) ? $args['step'] : 1;
		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';

		/**
		 * Apply filters to modify the value for the "affiliatewp_number_callback_{ID}" filter hook.
		 *
		 * This filter hook allows you to modify the value before it's returned.
		 *
		 * @since 2.18.0
		 *
		 * @param mixed $value The original value to be modified.
		 *
		 * @return mixed The modified value after applying filters.
		 */
		$value = apply_filters( "affiliatewp_number_callback_{$args['id']}", $value );

		$html  = '<input type="number" step="' . esc_attr( $step ) . '" max="' . esc_attr( $max ) . '" min="' . esc_attr( $min ) . '" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" placeholder="' . esc_attr( $std ) . '" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$html .= '<p class="description"> '  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Textarea Callback
	 *
	 * Renders textarea fields.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function textarea_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		$rows = ( isset( $args['rows'] ) && ! is_null( $args['rows'] ) ) ? $args['rows'] : 5;
		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'large';
		$html = '<textarea class="' . $size . '-text" cols="50" rows="' . $rows . '" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']">' . esc_textarea( stripslashes( $value ) ) . '</textarea>';
		$html .= '<p class="description"> '  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Password Callback
	 *
	 * Renders password fields.
	 *
	 * @since 1.3
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @return void
	 */
	function password_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="password" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
		$html .= '<p class="description"> '  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Missing Callback
	 *
	 * If a function is missing for settings callbacks alert the user.
	 *
	 * @since 1.3.1
	 * @param array $args Arguments passed by the setting
	 * @return void
	 */
	function missing_callback($args) {
		/* translators: Setting ID */
		printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'affiliate-wp' ), $args['id'] );
	}

	/**
	 * Select Callback
	 *
	 * Renders select fields.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting.
	 * @global $this->options Array of all the AffiliateWP Options.
	 * @return void
	 */
	function select_callback( array $args ) {

		$value = $this->options[ $args['id'] ] ?? ( $args['std'] ?? '' );

		if ( ! empty( $args['options_callback'] ) && is_callable( $args['options_callback'] ) ) {
			$args['options'] = call_user_func( $args['options_callback'] );
		}

		?>

		<select
			id="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>"
			name="<?php echo esc_attr( "affwp_settings[{$args['id']}]" ); ?>"
		>

		<?php foreach ( $args['options'] as $option => $name ) : ?>

			<?php

			$show_education = isset( $args['education_modal']['options'][ $option ]['enabled'] ) && true === $args['education_modal']['options'][ $option ]['enabled'];
			$education_name = $show_education && isset( $args['education_modal']['options'][ $option ]['name'] )
				? $args['education_modal']['options'][ $option ]['name']
				: '';
			$education_utm  = $show_education && isset( $args['education_modal']['options'][ $option ]['utm_content'] )
				? $args['education_modal']['options'][ $option ]['utm_content']
				: '';

			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- affiliatewp_tag_attr() already escape content.

			?>

			<option
				value="<?php echo esc_attr( $option ); ?>"
				<?php echo selected( $option, $value, false ); ?>
				<?php echo affiliatewp_tag_attr( 'class', $show_education ? 'affwp-education-modal addProBadge' : '' ); ?>
				<?php echo affiliatewp_tag_attr( 'data-name', $education_name ); ?>
				<?php echo affiliatewp_tag_attr( 'data-utm-content', $education_utm ); ?>
			>
				<?php echo esc_html( $name ); ?>
			</option>

		<?php endforeach; ?>

		</select>
		<p class="description"> <?php echo wp_kses( $args['desc'], affwp_kses() ); ?></p>

		<?php

		// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Rich Editor Callback
	 *
	 * Renders rich editor fields.
	 *
	 * @since 1.0
	 * @param array $args Arguments passed by the setting
	 * @global $this->options Array of all the AffiliateWP Options
	 * @global $wp_version WordPress Version
	 */
	function rich_editor_callback( $args ) {

		if ( isset( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		ob_start();
		wp_editor( stripslashes( $value ), 'affwp_settings_' . $args['id'], array( 'textarea_name' => 'affwp_settings[' . $args['id'] . ']' ) );
		$html = ob_get_clean();

		$html .= '<br/><p class="description"> '  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Upload Callback
	 *
	 * Renders file upload fields.
	 *
	 * @since 1.6
	 * @param array $args Arguements passed by the setting
	 */
	function upload_callback( $args ) {
		if( isset( $this->options[ $args['id'] ] ) )
			$value = $this->options[ $args['id'] ];
		else
			$value = isset( $args['std'] ) ? $args['std'] : '';

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';

		$html = '<div style="display: flex; gap: 0.5rem;">';
		$html .= '<input type="text" class="' . $size . '-text" id="affwp_settings[' . $args['id'] . ']" name="affwp_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$html .= '<input type="button" class="affwp_settings_upload_button button-secondary" value="' . __( 'Upload File', 'affiliate-wp' ) . '"/>';
		$html .= '</div>';
		$html .= '<p class="description"> '  . $args['desc'] . '</p>';

		echo $html;
	}

	/**
	 * Descriptive text callback.
	 *
	 * Renders descriptive text onto the settings field.
	 *
	 * @since 2.4
	 * @param array $args Arguments passed by the setting
	 * @return void
	 */
	function descriptive_text_callback( $args ) {
		$html = wp_kses_post( $args['desc'] );

		echo $html;
	}

	/**
	 * Retrieves the given type of callback for the given integration.
	 *
	 * @since 2.6
	 *
	 * @param string $integration Integration slug.
	 * @param string $context     Context for the callback, e.g. 'coupon_templates'.
	 * @param string $type        Callback type, e.g. 'options'.
	 * @return callable|false Callback or false if none could be found.
	 */
	public function get_integration_callback( $integration, $context, $type ) {
		$integration = affiliate_wp()->integrations->get( $integration );

		$callback = '__return_empty_array';

		if ( is_wp_error( $integration ) || ! $integration->is_active() ) {
			return $callback;
		}

		switch ( $type ) {
			case 'options':
				if ( 'coupon_templates' === $context ) {
					$callback = array( $integration, 'get_coupon_templates_options' );
				}
				break;

			default: break;
		}

		return $callback;
	}

	/**
	 * Retrieves the payouts service about text.
	 *
	 * @since 2.4
	 *
	 * @return string Text about the service.
	 */
	function payouts_service_about() {

		/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
		$payouts_service_about = '<p>' . sprintf( __( '%s allows you, as the site owner, to pay your affiliates directly from a credit or debit card and the funds for each recipient will be automatically deposited into their bank accounts. To use this service, connect your site to the service below. You will log into the service using your username and password from AffiliateWP.com.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ) . '</p>';
		/* translators: 1: Payouts Service URL */
		$payouts_service_about .= '<p>' . sprintf( __( '<a href="%s" target="_blank">Learn more and view pricing.</a>', 'affiliate-wp' ), PAYOUTS_SERVICE_URL ) . '</p>';


		return $payouts_service_about;
	}

	/**
	 * Retrieves the payouts service connection status and connection link.
	 *
	 * @since 2.4
	 *
	 * @return string Payouts service connection status markup.
	 */
	function payouts_service_connection_status() {

		$connection_status = affiliate_wp()->settings->get( 'payouts_service_connection_status', '' );

		if ( 'active' === $connection_status ) {

			$payouts_service_disconnect_url = wp_nonce_url( add_query_arg( array( 'affwp_action' => 'payouts_service_disconnect' ) ), 'payouts_service_disconnect', 'payouts_service_disconnect_nonce' );

			/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
			$payouts_service_connection_status = '<p>' . sprintf( __( 'Your website is connected to the %s.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ) . '</p>';
			/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
			$payouts_service_connection_status .= '<a href="'. esc_url( $payouts_service_disconnect_url ) .'" class="affwp-payouts-service-disconnect"><span>' . sprintf( __( 'Disconnect from the %s.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ) . '</span></a>';

		} elseif ( 'inactive' === $connection_status ) {

			$payouts_service_reconnect_url = wp_nonce_url( add_query_arg( array( 'affwp_action' => 'payouts_service_reconnect' ) ), 'payouts_service_reconnect', 'payouts_service_reconnect_nonce' );

			/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
			$payouts_service_connection_status = '<a href="'. esc_url( $payouts_service_reconnect_url ) .'" class="affwp-payouts-service-disconnect"><span>' . sprintf( __( 'Reconnect to the %s.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ) . '</span></a>';
			/* translators: 1: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant, 2: Payouts service documentation URL */
			$payouts_service_connection_status .= '<p>' . sprintf( __( 'Have questions about connecting with the %1$s? See the <a href="%2$s" target="_blank" rel="noopener noreferrer">documentation</a>.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME, esc_url( PAYOUTS_SERVICE_DOCS_URL ) ) . '</p>';

		} else {

			$payouts_service_connect_url = add_query_arg( array(
				'affwp_version' => AFFILIATEWP_VERSION,
				'site_url'      => home_url(),
				'redirect_url'  => urlencode( affwp_admin_url( 'settings', array( 'tab' => 'payouts_service' ) ) ),
				'token'         => str_pad( wp_rand( wp_rand(), PHP_INT_MAX ), 100, wp_rand(), STR_PAD_BOTH ),
			), PAYOUTS_SERVICE_URL . '/connect-site' );

			/* translators: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant */
			$payouts_service_connection_status = '<a href="' . esc_url( $payouts_service_connect_url ) . '" class="affwp-payouts-service-connect"><span>' . sprintf( __( 'Connect to the %s.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME ) . '</span></a>';
			/* translators: 1: Payouts Service name retrieved from the PAYOUTS_SERVICE_NAME constant, 2: Payouts service documentation URL */
			$payouts_service_connection_status .= '<p>' . sprintf( __( 'Have questions about connecting with the %1$s? See the <a href="%2$s" target="_blank" rel="noopener noreferrer">documentation</a>.', 'affiliate-wp' ), PAYOUTS_SERVICE_NAME, esc_url( PAYOUTS_SERVICE_DOCS_URL ) ) . '</p>';

		}

		return $payouts_service_connection_status;
	}

	/**
	 * Handles overriding and disabling the license key setting if a global key is defined.
	 *
	 * @since 1.9
	 * @access public
	 */
	public function handle_global_license_setting() {

		if ( ! is_array( $this->options ) ) {
			$this->options = array();
		}

		if ( self::global_license_set() ) {
		//	$this->options['license_key'] = self::get_license_key();
			$this->options['license_key'] = 'B5E0B5F8DD8689E6ACA49DD6E6E1A930';


			add_filter( 'affwp_settings_general', function ( $general_settings ) {
				$general_settings['license_key']['disabled'] = true;
				/* translators: Support URL */
				$general_settings['license_key']['desc']     = sprintf( __( 'Your license key is globally defined via <code>AFFILIATEWP_LICENSE_KEY</code> set in <code>wp-config.php</code>.<br />It cannot be modified from this screen.<br />An active license key is needed for automatic plugin updates and <a href="%s" target="_blank">support</a>.', 'affiliate-wp' ), 'https://affiliatewp.com/support/' );

				return $general_settings;
			} );
		}
	}

	/**
	 * Handles overriding and disabling the debug mode setting if globally enabled.
	 *
	 * @since 1.9
	 * @access public
	 */
	public function handle_global_debug_mode_setting() {
		if ( defined( 'AFFILIATE_WP_DEBUG' ) && true === AFFILIATE_WP_DEBUG ) {
			$this->options['debug_mode'] = 1;

			// Globally enabled.
			add_filter( 'affwp_settings_advanced', function( $misc_settings ) {
				$misc_settings['debug_mode']['disabled'] = true;
				/* translators: System Info screen URL */
				$misc_settings['debug_mode']['desc']     = sprintf( __( 'Debug mode is globally enabled via <code>AFFILIATE_WP_DEBUG</code> set in <code>wp-config.php</code>. This setting cannot be modified from this screen. Logs are kept in <a href="%s">Affiliates > Tools</a>.', 'affiliate-wp' ), affwp_admin_url( 'tools', array( 'tab' => 'system_info' ) ) );

				return $misc_settings;
			} );
		}
	}

	/**
	 * Determines whether a setting is disabled.
	 *
	 * @since 1.8.3
	 *
	 * @access public
	 *
	 * @param array $args Setting arguments.
	 * @return bool True or false if the setting is disabled, otherwise false.
	 */
	public function is_setting_disabled( $args ) {
		if ( isset( $args['disabled'] ) ) {
			return $args['disabled'];
		}
		return false;
	}

	/**
	 * Handles the license key activation redirects from settings page.
	 *
	 * @since unknown
	 * @since 2.9.6 Moved license data functionality to license data class.
	 * @return void
	 */
	public function activate_license() {
		$status = 'valid';

		if ( ! isset( $_POST['affwp_settings'] ) ) {
			return;
		}

		if ( ! isset( $_POST['affwp_activate_license'] ) ) {
			return;
		}

		if ( ! isset( $_POST['affwp_settings']['license_key'] ) ) {
			return;
		}

		// Get license key from settings and check it's activation status.
		$license_key        = sanitize_text_field( $_POST['affwp_settings']['license_key'] );
		$license            = new License\License_Data();
		$license_activation = $license->activation_status( $license_key );

		// Bail if empty because license is already activated and valid.
		if ( empty( $license_activation ) ) {
			return;
		}

		// If license activation attempt fails, redirect with notice.
		if ( isset( $license_activation['license_status'] ) && $license_activation['license_status'] === false ){
			wp_safe_redirect( affwp_admin_url( 'settings', array(
				'affwp_notice'  => $license_activation['affwp_notice'],
				'affwp_message' => $license_activation['affwp_message'],
				'affwp_success' => 'no',
			) ) );
			exit;
		}

		// If the attempt is successful, check license data for status.
		$license_data = $license_activation['license_data'];

		// Update addons cache.
		affwp_add_ons_get_feed( true );

		// If the license is valid, redirect.
		if ( isset( $license_data->license ) && 'valid' === $license_data->license ) {
			wp_safe_redirect( affwp_admin_url( 'settings' ) );
			exit;
		}

		// Otherwise, redirect with an error notice.
		$error = isset( $license_data->error ) ? $license_data->error : 'missing';

		wp_safe_redirect( affwp_admin_url( 'settings', array(
			'affwp_notice'  => 'license-' . $error,
			'affwp_success' => 'no',
		) ) );
		exit;

	}

	/**
	 * Handles the license key deactivation redirects from settings page.
	 *
	 * @since unknown
	 * @since 2.9.6 Moved license data functionality to license data class.
	 * @return void
	 */
	public function deactivate_license() {

		if( ! isset( $_POST['affwp_settings'] ) ) {
			return;
		}

		if( ! isset( $_POST['affwp_deactivate_license'] ) ) {
			return;
		}

		if( ! isset( $_POST['affwp_settings']['license_key'] ) ) {
			return;
		}

		$license_key = $_POST['affwp_settings']['license_key'];

		// Get license deactivation status.
		$license              = new License\License_Data();
		$license_deactivation = $license->deactivation_status();

		// Bail if empty because license is already deactivated.
		if ( empty( $license_deactivation ) ) {
			return;
		}

		// If deactivation is successful, update addons cache.
		if ( true === $license_deactivation ) {
			affwp_add_ons_get_feed( true );
			return;
		}

		// Otherwise, redirect with an error notice.
		if ( false === $license_deactivation['license_status'] ) {
			wp_safe_redirect( affwp_admin_url( 'settings', array(
				'message' => $license_deactivation['message'],
				'success' => false,
			) ) );
			exit;
		}

	}

	/**
	 * Checks validity of the license key.
	 *
	 * @since 1.0
	 * @since 2.9.6 Use new license class method.
	 *
	 * @param bool $force Optional. Whether to force checking the license (bypass caching).
	 * @return bool|mixed|void
	 */
	public function check_license( $force = false ) {
		$status = 'valid';


		if( ! empty( $_POST['affwp_settings'] ) ) {
			return; // Don't fire when saving settings
		}

		// Get license status.
		$license = new License\License_Data();
		$status  = $license->check_status();

		return $status;
	}

	public function is_license_valid() {
		return $this->check_license() == 'valid';
	}

	/**
	 * Retrieves the license key.
	 *
	 * If the `AFFILIATEWP_LICENSE_KEY` constant is defined, it will override values
	 * stored in the database.
	 *
	 * @since 1.9
	 * @access public
	 * @static
	 *
	 * @param string $key    Optional. License key to check. Default empty.
	 * @param bool   $saving Optional. Whether a saving operation is being performed. If true,
	 *                       the already-saved key value will be ignored. Default false.
	 * @return string License key.
	 */
	public static function get_license_key( $key = '', $saving = false ) {
		if ( self::global_license_set() ) {
			$license = AFFILIATEWP_LICENSE_KEY;
		} elseif ( ! empty( $key ) || true === $saving ) {
			$license = $key;
		} else {
			$license = affiliate_wp()->settings->get( 'license_key' );
		}

		return trim( $license );
	}

	/**
	 * Determines whether the global license key has been defined.
	 *
	 * @since 1.9
	 * @access public
	 * @static
	 *
	 * @return bool True if the global license has been defined, otherwise false.
	 */
	public static function global_license_set() {
		if ( defined( 'AFFILIATEWP_LICENSE_KEY' ) && AFFILIATEWP_LICENSE_KEY ) {
			return true;
		}
		return false;
	}

	/**
	 * Lists coupon format options.
	 *
	 * @since 2.8
	 *
	 * @return array Coupon format options.
	 */
	public function list_coupon_format_options() {
		$coupon_formats = array(
			'{coupon_code}'                             => '{coupon_code}',
			'{user_name}'                               => '{user_name}',
			'{coupon_code}-{coupon_amount}'             => '{coupon_code}-{coupon_amount}',
			'{coupon_amount}-{coupon_code}'             => '{coupon_amount}-{coupon_code}',
			'{coupon_amount}-{user_name}'               => '{coupon_amount}-{user_name}',
			'{user_name}-{coupon_amount}'               => '{user_name}-{coupon_amount}',
			'{custom_text}-{user_name}'                 => '{custom_text}-{user_name}',
			'{user_name}-{custom_text}'                 => '{user_name}-{custom_text}',
			'{custom_text}-{user_name}-{coupon_amount}' => '{custom_text}-{user_name}-{coupon_amount}',
			'{custom_text}-{coupon_amount}-{user_name}' => '{custom_text}-{coupon_amount}-{user_name}',
			'{user_name}-{custom_text}-{coupon_amount}' => '{user_name}-{custom_text}-{coupon_amount}',
			'{user_name}-{coupon_amount}-{custom_text}' => '{user_name}-{coupon_amount}-{custom_text}',
			'{coupon_amount}-{user_name}-{custom_text}' => '{coupon_amount}-{user_name}-{custom_text}',
			'{coupon_amount}-{custom_text}-{user_name}' => '{coupon_amount}-{custom_text}-{user_name}',
			'{first_name}-{user_name}'                  => '{first_name}-{user_name}',
			'{user_name}-{first_name}'                  => '{user_name}-{first_name}',
		);

		return $coupon_formats;
	}
}
