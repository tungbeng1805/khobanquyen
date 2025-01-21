<?php
/**
 * Field Mapping Control for Elementor in AffiliateWP
 *
 * @package    AffiliateWP
 * @subpackage Integrations
 * @copyright  Copyright (c) 2023, Sandhills Development, LLC
 * @since      2.19.0
 */

use Elementor\Control_Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Field Mapping Control Class for Elementor in AffiliateWP
 *
 * @since 2.19.0
 */
class Field_Mapping extends Control_Repeater {

	const CONTROL_TYPE = 'affiliatewp_fields_map';

	/**
	 * Get the type of the control.
	 *
	 * Overrides the parent method to return a custom control type for the field mapping.
	 *
	 * @since 2.19.0
	 * @return string The control type.
	 */
	public function get_type(): string {
		return self::CONTROL_TYPE;
	}

	/**
	 * Get the default settings for the control.
	 *
	 * Overrides the parent method to provide default settings specific to the field mapping control.
	 *
	 * @since 2.19.0
	 * @return array The default settings array.
	 */
	protected function get_default_settings(): array {
		return array_merge( parent::get_default_settings(), array(
			'render_type' => 'none',
			'fields'      => array(
				array(
					'name' => 'remote_id',
					'type' => Controls_Manager::HIDDEN,
				),
				array(
					'name' => 'local_id',
					'type' => Controls_Manager::SELECT,
				),
			),
		 ) );
	}

	/**
	 * Retrieve mappable fields for the control.
	 *
	 * @since 2.19.0
	 * @return array An array of mappable fields.
	 */
	private static function get_mappable_fields(): array {
		return array(
			'name'             => esc_html__( 'Name', 'affiliate-wp' ),
			'user_login'       => esc_html__( 'Username', 'affiliate-wp' ),
			'user_email'       => esc_html__( 'Account Email', 'affiliate-wp' ),
			'payment_email'    => esc_html__( 'Payment Email', 'affiliate-wp' ),
			'user_url'         => esc_html__( 'Website URL', 'affiliate-wp' ),
			'promotion_method' => esc_html__( 'Promotion Method', 'affiliate-wp' ),
			'user_pass'        => esc_html__( 'Password', 'affiliate-wp' ),
		);
	}

	/**
	 * Enqueue necessary scripts for the control.
	 *
	 * @since 2.19.0
	 */
	public function enqueue(): void {
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_script( 'affwp-elementor', AFFILIATEWP_PLUGIN_URL . "assets/js/admin-integration-elementor{$suffix}.js", array(), AFFILIATEWP_VERSION, true );

		$fields = array();
		foreach ( $this->get_mappable_fields() as $field_id => $field_label ) {

			$fields[] = array(
				'remote_id'       => $field_id,
				'remote_label'    => $field_label,
				'remote_type'     => $field_id === 'user_email' || $field_id === 'payment_email' ? 'email' : 'text',
				'remote_required' => $field_id === 'user_email',
			);
		}

		wp_localize_script(
			'affwp-elementor',
			'AffiliateWPElementor',
			array(
				'fields' => $fields
			)
		);

	}
}
