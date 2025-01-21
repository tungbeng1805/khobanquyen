<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class Icoland_Admin_Templates extends Icoland_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'pxlart',
		    esc_html__( 'Templates', 'icoland' ),
		    esc_html__( 'Templates', 'icoland' ),
		    'manage_options',
		    'edit.php?post_type=pxl-template',
		    false
		);
	}
}
new Icoland_Admin_Templates;
