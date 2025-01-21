<?php
add_action( 'pxl_post_metabox_register', 'icoland_page_options_register' );
function icoland_page_options_register( $metabox ) {

	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Options', 'icoland' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Options', 'icoland' ),
					'icon'   => 'el el-refresh',
					'fields' => array_merge(
						icoland_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']) 
					)
				],
				'header' => [
					'title'  => esc_html__( 'Header', 'icoland' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						icoland_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'icoland' ),
								'options'  => icoland_get_nav_menu_slug(),
								'default' => '',
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'icoland' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						icoland_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)

				],
				'content' => [
					'title'  => esc_html__( 'Content', 'icoland' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						icoland_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
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
								'title'          => esc_html__( 'Spacing Top/Bottom', 'icoland' ),
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
					'title'  => esc_html__( 'Footer', 'icoland' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						icoland_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
			]
		],
		'page' => [
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Options', 'icoland' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'icoland' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						icoland_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'logo_dark_m',
								'type'     => 'media',
								'title'    => esc_html__('Select Logo Mobile', 'icoland'),
								'default' => array(
									'url'=>get_template_directory_uri().'/assets/img/logo.png'
								),
								'url'      => false
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'icoland' ),
								'options'  => icoland_get_nav_menu_slug(),
								'default' => '',
							),
						)
					)
				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'icoland' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						icoland_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'icoland' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						icoland_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'       => 'page_bg_light',
								'type'     => 'background',
								'output'   => array( '.pxl-wapper' ),
								'title'    => esc_html__( 'Background Image', 'icoland' ),
								'default'  => array(
									'background-image' => '',
								),
								'force_output'   => true
							),
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'icoland' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
							array(
								'id'       => 'content_bg_color',
								'type'     => 'color_rgba',
								'title'    => esc_html__('Background Color', 'icoland'),
								'subtitle' => esc_html__('Content background color.', 'icoland'),
								'output'   => array('background-color' => 'footer','background-color' => '#pxl-main')
							),
						)
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'icoland' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						icoland_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
			]
		],
		'product' => [ //post_type
		'opt_name'            => 'pxl_product_options',
		'display_name'        => esc_html__( 'Product Settings', 'icoland' ),
		'show_options_object' => false,
		'context'  => 'advanced',
		'priority' => 'default',
		'sections'  => [
			'header' => [
				'title'  => esc_html__( 'Header', 'icoland' ),
				'icon'   => 'el-icon-website',
				'fields' => array_merge(
					icoland_header_opts([
						'default'         => true,
						'default_value'   => '-1'
					]),
					array(
						array(
							'id'       => 'p_menu',
							'type'     => 'select',
							'title'    => esc_html__( 'Menu', 'icoland' ),
							'options'  => icoland_get_nav_menu_slug(),
							'default' => '',
						),
					)
				)

			],
			'page_title' => [
				'title'  => esc_html__( 'Page Title', 'icoland' ),
				'icon'   => 'el el-indent-left',
				'fields' => array_merge(
					icoland_page_title_opts([
						'default'         => true,
						'default_value'   => '-1'
					])
				)

			],
			'content' => [
				'title'  => esc_html__( 'Content', 'icoland' ),
				'icon'   => 'el-icon-pencil',
				'fields' => array_merge(
					icoland_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
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
							'title'          => esc_html__( 'Spacing Top/Bottom', 'icoland' ),
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
				'title'  => esc_html__( 'Footer', 'icoland' ),
				'icon'   => 'el el-website',
				'fields' => array_merge(
					icoland_footer_opts([
						'default'         => true,
						'default_value'   => '-1'
					])
				)
			],
		]
	],
		'pxl-template' => [ //post_type
		'opt_name'            => 'pxl_hidden_template_options',
		'display_name'        => esc_html__( 'Template Options', 'icoland' ),
		'show_options_object' => false,
		'context'  => 'advanced',
		'priority' => 'default',
		'sections'  => [
			'header' => [
				'title'  => esc_html__( 'General', 'icoland' ),
				'icon'   => 'el-icon-website',
				'fields' => array(
					array(
						'id'    => 'template_type',
						'type'  => 'select',
						'title' => esc_html__('Type', 'icoland'),
						'options' => [
							'df'       	   => esc_html__('Select Type', 'icoland'), 
							'header'       => esc_html__('Header', 'icoland'), 
							'footer'       => esc_html__('Footer', 'icoland'), 
							'mega-menu'    => esc_html__('Mega Menu', 'icoland'), 
							'page-title'   => esc_html__('Page Title', 'icoland'), 
							'slider' => esc_html__('Slider', 'icoland'),
							'tab' => esc_html__('Tab', 'icoland'),
							'hidden-panel' => esc_html__('Hidden Panel', 'icoland'),
							'widget' => esc_html__('Widget Sidebar', 'icoland'),
						],
						'default' => 'df',
					),
					array(
						'id'    => 'header_type',
						'type'  => 'button_set',
						'title' => esc_html__('Header Type', 'icoland'),
						'options' => [
							'px-header--default'       	   => esc_html__('Default', 'icoland'), 
							'px-header--transparent'       => esc_html__('Transparent', 'icoland'),
						],
						'default' => 'px-header--default',
						'indent' => true,
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header' ),
					),
					array(
						'id'       => 'header_position',
						'type'     => 'select',
						'title'    => esc_html__('Header Position', 'icoland'),
						'options'  => [
							'df'   => esc_html__('Default', 'icoland'),
							'fixed-left'    => esc_html__('Fixed Left', 'icoland'),
							'fixed-right' => esc_html__('Fixed Right', 'icoland')
						],
						'default'  => 'df',
						'required' => [ 'template_type', '=', 'header']
					),
				),

			],
		]
	],
];

$metabox->add_meta_data( $panels );
}
