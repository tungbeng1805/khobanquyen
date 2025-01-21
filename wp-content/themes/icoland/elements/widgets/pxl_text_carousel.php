<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

pxl_add_custom_widget(
	array(
		'name' => 'pxl_text_carousel',
		'title' => esc_html__('TN Text Carousel', 'icoland'),
		'icon' => 'eicon-testimonial',
		'categories' => array('pxltheme-core'),
		'scripts' => array(
			'swiper',
			'pxl-swiper',
		),
		'params' => array(
			'sections' => array(
				array(
					'name' => 'section_layout',
					'label' => esc_html__('Layout', 'icoland' ),
					'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
					'controls' => array(
						array(
							'name' => 'layout',
							'label' => esc_html__('Templates', 'icoland' ),
							'type' => 'layoutcontrol',
							'default' => '1',
							'options' => [
								'1' => [
									'label' => esc_html__('Layout 1', 'icoland' ),
									'image' => get_template_directory_uri() . '/elements/templates/pxl_text_carousel/layout-image/layout1.jpg'
								],
							],
						),
					),
				),
				array(
					'name' => 'section_content',
					'label' => esc_html__('Content', 'icoland'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					'controls' => array(
						array(
							'name' => 'text',
							'label' => esc_html__('Text', 'icoland'),
							'type' => \Elementor\Controls_Manager::REPEATER,
							'controls' => array(
								array(
									'name' => 'title',
									'label' => esc_html__('Title', 'icoland'),
									'type' => \Elementor\Controls_Manager::TEXT,
									'label_block' => true,
								),
							),
							'title_field' => '{{{ title }}}',
						),

					),
				),
				array(
					'name' => 'section_style_title',
					'label' => esc_html__('Title', 'icoland' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'controls' => array(

						array(
							'name' => 'title_color',
							'label' => esc_html__('Color', 'icoland' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .pxl-text-carousel .pxl-item--title' => 'color: {{VALUE}};',
							],
						),
						array(
							'name' => 'title_typography',
							'label' => esc_html__('Typography', 'icoland' ),
							'type' => \Elementor\Group_Control_Typography::get_type(),
							'control_type' => 'group',
							'selector' => '{{WRAPPER}} .pxl-text-carousel .pxl-item--title',
						),
					),
				),
				array(
					'name' => 'section_settings_carousel',
					'label' => esc_html__('Settings', 'icoland'),
					'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
					'controls' => array(
						array(
							'name' => 'col_xs',
							'label' => esc_html__('Columns XS Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '1',
							'options' => [
								'auto' => 'Auto',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'6' => '6',
							],
						),
						array(
							'name' => 'col_sm',
							'label' => esc_html__('Columns SM Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '2',
							'options' => [
								'auto' => 'Auto',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'6' => '6',
							],
						),
						array(
							'name' => 'col_md',
							'label' => esc_html__('Columns MD Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '3',
							'options' => [
								'auto' => 'Auto',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'6' => '6',
							],
						),
						array(
							'name' => 'col_lg',
							'label' => esc_html__('Columns LG Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '3',
							'options' => [
								'auto' => 'Auto',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'6' => '6',
							],
						),
						array(
							'name' => 'col_xl',
							'label' => esc_html__('Columns XL Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '3',
							'options' => [
								'auto' => 'Auto',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'5' => '5',
								'6' => '6',
							],
						),
						array(
							'name' => 'col_xxl',
							'label' => esc_html__('Columns XXL Devices', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'inherit',
							'options' => [
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'5' => '5',
								'6' => '6',
								'inherit' => 'Inherit',
							],
						),

						array(
							'name' => 'slides_to_scroll',
							'label' => esc_html__('Slides to scroll', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '1',
							'options' => [
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'5' => '5',
								'6' => '6',
							],
						),
						array(
							'name' => 'arrows',
							'label' => esc_html__('Show Arrows', 'icoland'),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						),
						array(
							'name' => 'pagination',
							'label' => esc_html__('Show Pagination', 'icoland'),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'default' => 'false',
						),
						array(
							'name' => 'pagination_type',
							'label' => esc_html__('Pagination Type', 'icoland' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => 'bullets',
							'options' => [
								'bullets' => 'Bullets',
								'fraction' => 'Fraction',
							],
							'condition' => [
								'pagination' => 'true'
							]
						),
						array(
							'name' => 'pause_on_hover',
							'label' => esc_html__('Pause on Hover', 'icoland'),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						),
						array(
							'name' => 'autoplay',
							'label' => esc_html__('Autoplay', 'icoland'),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						),
						array(
							'name' => 'autoplay_speed',
							'label' => esc_html__('Autoplay Speed', 'icoland'),
							'type' => \Elementor\Controls_Manager::NUMBER,
							'default' => 5000,
							'condition' => [
								'autoplay' => 'true'
							]
						),
						array(
							'name' => 'infinite',
							'label' => esc_html__('Infinite Loop', 'icoland'),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						),
						array(
							'name' => 'speed',
							'label' => esc_html__('Animation Speed', 'icoland'),
							'type' => \Elementor\Controls_Manager::NUMBER,
							'default' => 500,
						),
					),
				),icoland_widget_animation_settings(),
			),
		),
	),
icoland_get_class_widget_path()
);