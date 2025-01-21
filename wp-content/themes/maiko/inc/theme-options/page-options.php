<?php

add_action( 'pxl_post_metabox_register', 'maiko_page_options_register' );
function maiko_page_options_register( $metabox ) {

	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'maiko' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Settings', 'maiko' ),
					'icon'   => 'el el-refresh',
					'fields' => array_merge(
						maiko_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']),
						maiko_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'           => 'custom_main_title',
								'type'         => 'text',
								'title'        => esc_html__( 'Custom Main Title', 'maiko' ),
								'subtitle'     => esc_html__( 'Custom heading text title', 'maiko' ),
								'required' => array( 'pt_mode', '!=', 'none' )
							),
							array(
								'id'           => 'custom_sub_title',
								'type'         => 'text',
								'title'        => esc_html__( 'Custom Sub title', 'maiko' ),
								'subtitle'     => esc_html__( 'Add short description for page title', 'maiko' ),
								'required' => array( 'pt_mode', '!=', 'none' )
							)
						),
						array(
							array(
								'id'          => 'featured-video-url',
								'type'        => 'text',
								'title'       => esc_html__( 'Video URL', 'maiko' ),
								'description' => esc_html__( 'Video will show when set post format is video', 'maiko' ),
								'validate'    => 'url',
								'msg'         => 'Url error!',
							),
							array(
								'id'          => 'featured-audio-url',
								'type'        => 'text',
								'title'       => esc_html__( 'Audio URL', 'maiko' ),
								'description' => esc_html__( 'Audio that will show when set post format is audio', 'maiko' ),
								'validate'    => 'url',
								'msg'         => 'Url error!',
							),
							array(
								'id'=>'featured-quote-text',
								'type' => 'textarea',
								'title' => esc_html__('Quote Text', 'maiko'),
								'default' => '',
							),
							array(
								'id'          => 'featured-quote-cite',
								'type'        => 'text',
								'title'       => esc_html__( 'Quote Cite', 'maiko' ),
								'description' => esc_html__( 'Quote will show when set post format is quote', 'maiko' ),
							),
							array(
								'id'       => 'featured-link-url',
								'type'     => 'text',
								'title'    => esc_html__( 'Format Link URL', 'maiko' ),
								'description' => esc_html__( 'Link will show when set post format is link', 'maiko' ),
							),
							array(
								'id'          => 'featured-link-text',
								'type'        => 'text',
								'title'       => esc_html__( 'Format Link Text', 'maiko' ),
							),
						)
					)
				]
			]
		],
		'page' => [
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Options', 'maiko' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						maiko_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						maiko_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'logo_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'maiko'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'maiko' ),
								'options'  => maiko_get_nav_menu_slug(),
								'default' => '',
							),
						),
						array(
							array(
								'id'       => 'sticky_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Scroll', 'maiko'),
								'options'  => array(
									'-1' => esc_html__('Inherit', 'maiko'),
									'pxl-sticky-stt' => esc_html__('Scroll To Top', 'maiko'),
									'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'maiko'),
								),
								'default'  => '-1',
							),
							array(
								'id'       => 'header_margin',
								'type'     => 'spacing',
								'mode'     => 'margin',
								'title'    => esc_html__('Margin', 'maiko'),
								'width'    => false,
								'unit'     => 'px',
								'output'    => array('#pxl-header-elementor .pxl-header-elementor-main'),
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'maiko' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						maiko_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'sg_post_title',
								'type'     => 'button_set',
								'title'    => esc_html__('Page Title Type', 'maiko'),
								'options'  => array(
									'default' => esc_html__('Default', 'maiko'),
									'custom_text' => esc_html__('Custom Text', 'maiko'),
								),
								'default'  => 'default',
							),
							array(
								'id'      => 'sg_post_title_text',
								'type'    => 'text',
								'title'   => esc_html__('Page Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
							array(
								'id'      => 'sg_post_sub_title_text',
								'type'    => 'text',
								'title'   => esc_html__('Page Sub Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
							array(
								'id'      => 'sg_post_des_text',
								'type'    => 'textarea',
								'title'   => esc_html__('Description Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
						),
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'maiko' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						maiko_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'maiko' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
						)
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						maiko_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'footer_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'p_footer_fixed',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Fixed', 'maiko'),
								'options'  => array(
									'inherit' => esc_html__('Inherit', 'maiko'),
									'on' => esc_html__('On', 'maiko'),
									'off' => esc_html__('Off', 'maiko'),
								),
								'default'  => 'inherit',
							),
							array(
								'id'       => 'back_top_top_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Back to Top Style', 'maiko'),
								'options'  => array(
									'style-default' => esc_html__('Default', 'maiko'),
									'style-round' => esc_html__('Round', 'maiko'),
								),
								'default'  => 'style-default',
							),
						)
					)
				],
				'colors' => [
					'title'  => esc_html__( 'Colors', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						array(
							array(
								'id'       => 'content_bgp_color',
								'type'     => 'color_rgba',
								'title'    => esc_html__('Body Background Color', 'maiko'),
								'subtitle' => esc_html__('Body Background color.', 'maiko'),
								'output'   => array('background-color' => 'body')
							),
							array(
								'id'          => 'primary_color',
								'type'        => 'color',
								'title'       => esc_html__('Primary Color', 'maiko'),
								'transparent' => false,
								'default'     => ''
							),
						)
					)
				],
				'extra' => [
					'title'  => esc_html__( 'Extra', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						array(
							array(
								'id' => 'body_custom_class',
								'type' => 'text',
								'title' => esc_html__('Body Custom Class', 'maiko'),
							),
						)
					)
				]
			]
		],
		'portfolio' => [
			'opt_name'            => 'pxl_portfolio_options',
			'display_name'        => esc_html__( 'Portfolio Options', 'maiko' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'General', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
								'id'          => 'area',
								'type'        => 'text',
								'title'       => esc_html__( 'Area', 'maiko' ),
							),
							array(
								'id'          => 'year',
								'type'        => 'text',
								'title'       => esc_html__( 'Year', 'maiko' ),
							),
						)
					)
				],
				'header1' => [
					'title'  => esc_html__( 'Header', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						maiko_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						maiko_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'logo_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'maiko'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'maiko' ),
								'options'  => maiko_get_nav_menu_slug(),
								'default' => '',
							),
						),
						array(
							array(
								'id'       => 'sticky_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Scroll', 'maiko'),
								'options'  => array(
									'-1' => esc_html__('Inherit', 'maiko'),
									'pxl-sticky-stt' => esc_html__('Scroll To Top', 'maiko'),
									'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'maiko'),
								),
								'default'  => '-1',
							),
							array(
								'id'       => 'header_margin',
								'type'     => 'spacing',
								'mode'     => 'margin',
								'title'    => esc_html__('Margin', 'maiko'),
								'width'    => false,
								'unit'     => 'px',
								'output'    => array('#pxl-header-elementor .pxl-header-elementor-main'),
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'maiko' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						maiko_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'sg_post_title',
								'type'     => 'button_set',
								'title'    => esc_html__('Page Title Type', 'maiko'),
								'options'  => array(
									'default' => esc_html__('Default', 'maiko'),
									'custom_text' => esc_html__('Custom Text', 'maiko'),
								),
								'default'  => 'default',
							),
							array(
								'id'      => 'sg_post_title_text',
								'type'    => 'text',
								'title'   => esc_html__('Page Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
							array(
								'id'      => 'sg_post_sub_title_text',
								'type'    => 'text',
								'title'   => esc_html__('Page Sub Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
							array(
								'id'      => 'sg_post_des_text',
								'type'    => 'textarea',
								'title'   => esc_html__('Description Title Text', 'maiko'),								
								'required' => array( 0 => 'sg_post_title', 1 => 'equals', 2 => 'custom_text' ),
							),
						),
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'maiko' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						maiko_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'maiko' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
						),
						array(
							array(
								'id'=>'multi_text_country',
								'type' => 'multi_text',
								'title' => ('Multi Text Option'),
								'title'    => esc_html('Mutil Text', 'maiko'),
							),
							array(
								'id'=>'multi_text_country_link',
								'type' => 'multi_text',
								'title' => ('Multi Text Option'),
								'title'    => esc_html('Mutil Text Link', 'maiko'),
							),
							array(
								'id'       => 'icon_multi_text',
								'type'     => 'pxl_iconpicker',
								'title'    => esc_html__('Icon Multi Text', 'maiko'),
								'force_output' => true
							),
						),
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						maiko_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'footer_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'p_footer_fixed',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Fixed', 'maiko'),
								'options'  => array(
									'inherit' => esc_html__('Inherit', 'maiko'),
									'on' => esc_html__('On', 'maiko'),
									'off' => esc_html__('Off', 'maiko'),
								),
								'default'  => 'inherit',
							),
							array(
								'id'       => 'back_top_top_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Back to Top Style', 'maiko'),
								'options'  => array(
									'style-default' => esc_html__('Default', 'maiko'),
									'style-round' => esc_html__('Round', 'maiko'),
								),
								'default'  => 'style-default',
							),
						)
					)
				],
			]
		],
		'product' => [
			'opt_name'            => 'pxl_product_options',
			'display_name'        => esc_html__( 'Product Options', 'maiko' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header1' => [
					'title'  => esc_html__( 'Header', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						maiko_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						maiko_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'logo_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'maiko'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'maiko' ),
								'options'  => maiko_get_nav_menu_slug(),
								'default' => '',
							),
						),
						array(
							array(
								'id'       => 'sticky_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Scroll', 'maiko'),
								'options'  => array(
									'-1' => esc_html__('Inherit', 'maiko'),
									'pxl-sticky-stt' => esc_html__('Scroll To Top', 'maiko'),
									'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'maiko'),
								),
								'default'  => '-1',
							),
							array(
								'id'       => 'header_margin',
								'type'     => 'spacing',
								'mode'     => 'margin',
								'title'    => esc_html__('Margin', 'maiko'),
								'width'    => false,
								'unit'     => 'px',
								'output'    => array('#pxl-header-elementor .pxl-header-elementor-main'),
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'maiko' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						maiko_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'maiko' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						maiko_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'maiko' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
						)
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						maiko_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
					)
				],
			]
		],
		'service' => [
			'opt_name'            => 'pxl_service_options',
			'display_name'        => esc_html__( 'Service Options', 'maiko' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'General', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
								'id'=> 'service_external_link',
								'type' => 'text',
								'title' => esc_html__('External Link', 'maiko'),
								'validate' => 'url',
								'default' => '',
							),
							array(
								'id'       => 'service_icon_type',
								'type'     => 'button_set',
								'title'    => esc_html__('Icon Type', 'maiko'),
								'options'  => array(
									'icon'  => esc_html__('Icon', 'maiko'),
									'image'  => esc_html__('Image', 'maiko'),
								),
								'default'  => 'icon'
							),
							array(
								'id'       => 'service_icon_font',
								'type'     => 'pxl_iconpicker',
								'title'    => esc_html__('Icon', 'maiko'),
								'required' => array( 0 => 'service_icon_type', 1 => 'equals', 2 => 'icon' ),
								'force_output' => true
							),
							array(
								'id'       => 'service_icon_img',
								'type'     => 'media',
								'title'    => esc_html__('Icon Image', 'maiko'),
								'default' => '',
								'required' => array( 0 => 'service_icon_type', 1 => 'equals', 2 => 'image' ),
								'force_output' => true
							),
						)
					)
				],
				'header1' => [
					'title'  => esc_html__( 'Header', 'maiko' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						maiko_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						maiko_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'logo_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'maiko'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'maiko' ),
								'options'  => maiko_get_nav_menu_slug(),
								'default' => '',
							),
						),
						array(
							array(
								'id'       => 'sticky_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Scroll', 'maiko'),
								'options'  => array(
									'-1' => esc_html__('Inherit', 'maiko'),
									'pxl-sticky-stt' => esc_html__('Scroll To Top', 'maiko'),
									'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'maiko'),
								),
								'default'  => '-1',
							),
							array(
								'id'       => 'header_margin',
								'type'     => 'spacing',
								'mode'     => 'margin',
								'title'    => esc_html__('Margin', 'maiko'),
								'width'    => false,
								'unit'     => 'px',
								'output'    => array('#pxl-header-elementor .pxl-header-elementor-main'),
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'maiko' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						maiko_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'maiko' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						maiko_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'maiko' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
						),
						array(
							array(
								'id'=>'multi_text_country',
								'type' => 'multi_text',
								'title' => ('Multi Text Option'),
								'title'    => esc_html('Mutil Text', 'maiko'),
							),
							array(
								'id'=>'multi_text_country_link',
								'type' => 'multi_text',
								'title' => ('Multi Text Option'),
								'title'    => esc_html('Mutil Text Link', 'maiko'),
							),
							array(
								'id'       => 'icon_multi_text',
								'type'     => 'pxl_iconpicker',
								'title'    => esc_html__('Icon Multi Text', 'maiko'),
								'force_output' => true
							),
						),
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'maiko' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						maiko_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'footer_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Display', 'maiko'),
								'options'  => array(
									'show' => esc_html__('Show', 'maiko'),
									'hide'  => esc_html__('Hide', 'maiko'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'p_footer_fixed',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Fixed', 'maiko'),
								'options'  => array(
									'inherit' => esc_html__('Inherit', 'maiko'),
									'on' => esc_html__('On', 'maiko'),
									'off' => esc_html__('Off', 'maiko'),
								),
								'default'  => 'inherit',
							),
							array(
								'id'       => 'back_top_top_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Back to Top Style', 'maiko'),
								'options'  => array(
									'style-default' => esc_html__('Default', 'maiko'),
									'style-round' => esc_html__('Round', 'maiko'),
								),
								'default'  => 'style-default',
							),
						)
					)
				],
			]
		],

		'pxl-template' => [ //post_type
		'opt_name'            => 'pxl_hidden_template_options',
		'display_name'        => esc_html__( 'Template Options', 'maiko' ),
		'show_options_object' => false,
		'context'  => 'advanced',
		'priority' => 'default',
		'sections'  => [
			'header' => [
				'title'  => esc_html__( 'General', 'maiko' ),
				'icon'   => 'el-icon-website',
				'fields' => array(
					array(
						'id'    => 'template_type',
						'type'  => 'select',
						'title' => esc_html__('Type', 'maiko'),
						'options' => [
							'df'       	   => esc_html__('Select Type', 'maiko'), 
							'header'       => esc_html__('Header Desktop', 'maiko'),
							'header-mobile'       => esc_html__('Header Mobile', 'maiko'),
							'footer'       => esc_html__('Footer', 'maiko'), 
							'mega-menu'    => esc_html__('Mega Menu', 'maiko'), 
							'page-title'   => esc_html__('Page Title', 'maiko'), 
							'tab' => esc_html__('Tab', 'maiko'),
							'hidden-panel' => esc_html__('Hidden Panel', 'maiko'),
							'popup' => esc_html__('Popup', 'maiko'),
							'widget' => esc_html__('Widget Sidebar', 'maiko'),
							'page' => esc_html__('Page', 'maiko'),
							'slider' => esc_html__('Slider', 'maiko'),
						],
						'default' => 'df',
					),
					array(
						'id'    => 'header_type',
						'type'  => 'select',
						'title' => esc_html__('Header Type', 'maiko'),
						'options' => [
							'px-header--default'       	   => esc_html__('Default', 'maiko'), 
							'px-header--transparent'       => esc_html__('Transparent', 'maiko'),
							'px-header--left_sidebar'       => esc_html__('Left Sidebar', 'maiko'),
						],
						'default' => 'px-header--default',
						'indent' => true,
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header' ),
					),

					array(
						'id'    => 'header_mobile_type',
						'type'  => 'select',
						'title' => esc_html__('Header Type', 'maiko'),
						'options' => [
							'px-header--default'       	   => esc_html__('Default', 'maiko'), 
							'px-header--transparent'       => esc_html__('Transparent', 'maiko'),
						],
						'default' => 'px-header--default',
						'indent' => true,
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header-mobile' ),
					),

					array(
						'id'    => 'hidden_panel_position',
						'type'  => 'select',
						'title' => esc_html__('Hidden Panel Position', 'maiko'),
						'options' => [
							'top'       	   => esc_html__('Top', 'maiko'),
							'right'       	   => esc_html__('Right', 'maiko'),
						],
						'default' => 'right',
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'hidden-panel' ),
					),
					array(
						'id'          => 'hidden_panel_height',
						'type'        => 'text',
						'title'       => esc_html__('Hidden Panel Height', 'maiko'),
						'subtitle'       => esc_html__('Enter number.', 'maiko'),
						'transparent' => false,
						'default'     => '',
						'force_output' => true,
						'required' => array( 0 => 'hidden_panel_position', 1 => 'equals', 2 => 'top' ),
					),
					array(
						'id'          => 'hidden_panel_boxcolor',
						'type'        => 'color',
						'title'       => esc_html__('Box Color', 'maiko'),
						'transparent' => false,
						'default'     => '',
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'hidden-panel' ),
					),

					array(
						'id'          => 'header_sidebar_width',
						'type'        => 'slider',
						'title'       => esc_html__('Header Sidebar Width', 'maiko'),
						"default"   => 300,
						"min"       => 50,
						"step"      => 1,
						"max"       => 900,
						'force_output' => true,
						'required' => array( 0 => 'header_type', 1 => 'equals', 2 => 'px-header--left_sidebar' ),
					),

					array(
						'id'          => 'header_sidebar_border',
						'type'        => 'border',
						'title'       => esc_html__('Header Sidebar Border', 'maiko'),
						'force_output' => true,
						'required' => array( 0 => 'header_type', 1 => 'equals', 2 => 'px-header--left_sidebar' ),
						'default' => '',
					),
				),

			],
		]
	],
];

$metabox->add_meta_data( $panels );
}
