<?php
$uri = get_template_directory_uri() . '/inc/admin/demo-data/demo-imgs/';
$pxl_server_info = apply_filters( 'pxl_server_info', ['demo_url' => 'https://api.tnexthemes.com/'] ) ; 
// Demos
$demos = array(
	// Elementor Demos
	'icoland' => array(
		'title'       => 'Icoland',	
		'description' => '',
		'screenshot'  => $uri . 'icoland.jpg',
		'preview'     => $pxl_server_info['demo_url'],
	),	 
); 