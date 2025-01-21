<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class Maiko_Admin_Templates extends Maiko_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'pxlart',
		    esc_html__( 'Templates', 'maiko' ),
		    esc_html__( 'Templates', 'maiko' ),
		    'manage_options',
		    'edit.php?post_type=pxl-template',
		    false
		);
	}
}
new Maiko_Admin_Templates;
