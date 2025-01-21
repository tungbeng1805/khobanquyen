<?php 

add_action( 'elementor/element/section/section_structure/after_section_end', 'icoland_add_custom_section_controls' ); 
add_action( 'elementor/element/column/layout/after_section_end', 'icoland_add_custom_columns_controls' ); 
function icoland_add_custom_section_controls( \Elementor\Element_Base $element) {

	$element->start_controls_section(
		'section_pxl',
		[
			'label' => esc_html__( 'Icoland Settings', 'icoland' ),
			'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
		]
	);

	$element->add_control(
		'header_layout_type',
		[
			'label'   => esc_html__( 'Header Layout Type', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'None', 'icoland' ),
				'clip'   => esc_html__( 'Clip', 'icoland' ),
			),
			'prefix_class' => 'pxl-type-header-',
			'default'      => 'none',
		]
	);
	$element->add_control(
		'pxl_section_offset',
		[
			'label'   => esc_html__( 'Section Offset', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'prefix_class' => 'pxl_section_offset-',
			'hide_in_inner' =>true,
			'options' => array(
				'none'        => esc_html__( 'None', 'icoland' ),
				'left'   => esc_html__( 'Left', 'icoland' ),
				'right'   => esc_html__( 'Right', 'icoland' ),
			),
			'default'      => 'none',
			'condition' => [
				'layout' =>'full_width'
			]
		]
	);
	$element->add_control(
		'pxl_container_offset',
		[
			'label'   => esc_html__( 'Container Width', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'prefix_class' => 'pxl-container-width-',
			'hide_in_inner' =>true,
			'options' => array(
				'container-1200'        => esc_html__( '1200px', 'icoland' ),
			),
			'default'      => 'container-1200',
			'condition' => [
				'layout' =>'full_width',
				'pxl_section_offset!'=>'none'
			]
		]
	);


	$element->add_control(
		'pxl_color_offset',
		[
			'label'   => esc_html__( 'Background - Left Space', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'No', 'icoland' ),
				'left'   => esc_html__( 'Yes', 'icoland' ),
			),
			'prefix_class' => 'pxl-bg-color-',
			'default'      => 'none',
		]
	);
	$element->add_control(
		'pxl_partical',
		[
			'label'   => esc_html__( 'Canvas El', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'No', 'icoland' ),
				'yes'   => esc_html__( 'Style 1', 'icoland' ),
				'yes-2'   => esc_html__( 'Style 2', 'icoland' ),
			),
			'prefix_class' => 'pxl-canvas-',
			'default'      => 'none',
		]
	);
	$element->add_control(
		'pxl_parallax_bg',
		[
			'label'   => esc_html__( 'Background Parallax', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'No', 'icoland' ),
				'1'   => esc_html__( 'Yes', 'icoland' ),
			),
			'prefix_class' => 'parallax-',
			'default'      => 'none',
		]
	);

	$element->add_control(
		'offset_color',
		[
			'label' => esc_html__('Background Color', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}.pxl-bg-color-left:before' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'pxl_color_offset' => ['left'],
			],
		]
	);

	

	$element->add_control(
		'full_content_with_space',
		[
			'label' => esc_html__( 'Full Content with space from?', 'icoland' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'prefix_class' => 'pxl-full-content-with-space-',
			'options'      => array(
				'none'    => esc_html__( 'None', 'icoland' ),
				'start'   => esc_html__( 'Start', 'icoland' ),
				'end'     => esc_html__( 'End', 'icoland' ),
			),
			'default'      => 'none',
			'condition' => [
				'layout' => 'full_width'
			]
		]
	);

	$element->add_control(
		'pxl_container_width',
		[
			'label' => esc_html__('Container Width', 'icoland'),
			'type' => \Elementor\Controls_Manager::NUMBER,
			'default' => 1200,
			'condition' => [
				'layout' => 'full_width',
				'full_content_with_space!' => 'none'
			]           
		]
	);

	$element->add_control(
		'row_scroll_fixed',
		[
			'label'   => esc_html__( 'Row Scroll - Column Fixed', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'No', 'icoland' ),
				'fixed'   => esc_html__( 'Yes', 'icoland' ),
			),
			'prefix_class' => 'pxl-row-scroll-',
			'default'      => 'none',      
		]
	);

	$element->add_control(
        'pxl_parallax_bg_img',
        [
            'label' => esc_html__( 'Parallax Background Image', 'icoland' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'hide_in_inner' => true,
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-image: url( {{URL}} );',
            ],
        ]
    );
    $element->add_control(
        'ss_border_color',
		[
			'label' => esc_html__('Border Color Dark Mode', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'.dark-mode {{WRAPPER}}' => 'border-color: {{VALUE}} !important;',
			],
		]
    );
    $element->add_control(
        'ss_bg_darkmode_color',
		[
			'label' => esc_html__('Background Color Dark Mode', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'.dark-mode {{WRAPPER}}' => 'background-color: {{VALUE}} !important;',
			],
		]
    );

	$element->end_controls_section();
};

add_filter( 'pxl_section_start_render', 'icoland_custom_section_start_render', 10, 3 );
function icoland_custom_section_start_render($html, $settings, $el){

	if(!empty($settings['pxl_parallax_bg_img']['url'])){
        $html .= '<div class="pxl-section-bg-parallax"></div>';
    }
    return $html;
}

function icoland_add_custom_columns_controls( \Elementor\Element_Base $element) {
	$element->start_controls_section(
		'columns_pxl',
		[
			'label' => esc_html__( 'Icoland Settings', 'icoland' ),
			'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
		]
	);
	$element->add_control(
		'pxl_section_offset',
		[
			'label'   => esc_html__( 'Section Offset', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'prefix_class' => 'pxl_section_offset-',
			'hide_in_inner' =>true,
			'options' => array(
				'none'        => esc_html__( 'None', 'icoland' ),
				'left'   => esc_html__( 'Left', 'icoland' ),
				'right'   => esc_html__( 'Right', 'icoland' ),
			),
			'default'      => 'none',
			// 'condition' => [
			// 	'layout' =>'full_width'
			// ]
		]
	);
	$element->add_control(
		'pxl_parallax_bg_cl',
		[
			'label'   => esc_html__( 'Background Parallax', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'        => esc_html__( 'No', 'icoland' ),
				'1'   => esc_html__( 'Yes', 'icoland' ),
			),
			'prefix_class' => 'parallax-',
			'default'      => 'none',
		]
	);
	$element->add_control(
		'pxl_container_offset',
		[
			'label'   => esc_html__( 'Container Width', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'prefix_class' => 'pxl-container-width-',
			'hide_in_inner' =>true,
			'options' => array(
				'container-1200'        => esc_html__( '1200px', 'icoland' ),
			),
			'default'      => 'container-1200',
			// 'condition' => [
			// 	'layout' =>'full_width',
			// 	'pxl_section_offset!'=>'none'
			// ]
		]
	);
	$element->add_control(
		'col_divider',
		[
			'label'   => esc_html__( 'Divider', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				''        => esc_html__( 'None', 'icoland' ),
				'left'   => esc_html__( 'Left', 'icoland' ),
				'right'   => esc_html__( 'Right', 'icoland' ),
			),
			'prefix_class' => 'pxl-col-divider-',
			'default'      => '',
		]
	);

	$element->add_control(
		'col_divider_color',
		[
			'label' => esc_html__('Divider Color', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .pxl-col-divider-right:before' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .pxl-col-divider-left:before' => 'background-color: {{VALUE}};',
			],
		]
	);
	
	$element->add_control(
        'cl_bg_darkmode_color',
		[
			'label' => esc_html__('Background Color Dark Mode', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'.dark-mode {{WRAPPER}}' => 'background-color: {{VALUE}} !important;',
				'.dark-mode {{WRAPPER}} > .elementor-element-populated' => 'background-color: {{VALUE}} !important;',
			],
		]
    );
    $element->add_control(
        'cl_border_color',
		[
			'label' => esc_html__('Border Color Dark Mode', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'.dark-mode {{WRAPPER}}' => 'border-color: {{VALUE}} !important;',
				'.dark-mode {{WRAPPER}} > .elementor-element-populated' => 'border-color: {{VALUE}} !important;',
			],
		]
    );
	$element->add_control(
		'col_line',
		[
			'label'   => esc_html__( 'Column Line Style', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'           => esc_html__( 'None', 'icoland' ),
				'line1'           => esc_html__( 'Line 1', 'icoland' ),
				'line2'           => esc_html__( 'Line 2', 'icoland' ),
			),
			'default' => 'none',
			'prefix_class' => 'pxl-col-'
		]
	);

	$element->add_control(
		'col_line_color',
		[
			'label' => esc_html__('Column Line Color', 'icoland' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}.pxl-col-line2:before' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'col_line' => ['line2'],
			],
		]
	);

	$element->add_control(
		'col_line_height',
		[
			'label' => esc_html__('Column Line Height', 'icoland' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'control_type' => 'responsive',
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 3000,
				],
			],
			'selectors' => [
				'{{WRAPPER}}.pxl-col-line2:before' => 'height: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after',
			'condition' => [
				'col_line' => ['line2'],
			],
		]
	);

	$element->add_control(
		'col_content_align',
		[
			'label'   => esc_html__( 'Column Content Align', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				''           => esc_html__( 'Default', 'icoland' ),
				'start'           => esc_html__( 'Start', 'icoland' ),
				'center'           => esc_html__( 'Center', 'icoland' ),
				'end'           => esc_html__( 'End', 'icoland' ),
			),
			'default' => '',
			'prefix_class' => 'pxl-col-align-'
		]
	);
	$element->add_control(
		'col_sticky',
		[
			'label'   => esc_html__( 'Column Sticky', 'icoland' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'           => esc_html__( 'No', 'icoland' ),
				'sticky' => esc_html__( 'Yes', 'icoland' ),
			),
			'default' => 'none',
			'prefix_class' => 'pxl-column-'
		]
	);
	$element->end_controls_section();
}

add_action( 'elementor/element/after_add_attributes', 'icoland_custom_el_attributes', 10, 1 );
function icoland_custom_el_attributes($el){
	if( 'section' !== $el->get_name() ) {
		return;
	}
	$settings = $el->get_settings();

	$pxl_container_width = !empty($settings['pxl_container_width']) ? (int)$settings['pxl_container_width'] : 1200;

	if( isset( $settings['stretch_section']) && $settings['stretch_section'] == 'section-stretched') 
		$pxl_container_width = $pxl_container_width - 30;

	$pxl_container_width = $pxl_container_width.'px';

	if ( isset( $settings['full_content_with_space'] ) && $settings['full_content_with_space'] === 'start' ) {

		$el->add_render_attribute( '_wrapper', 'style', 'padding-left: calc( (100% - '.$pxl_container_width.')/2);');
	}
	if ( isset( $settings['full_content_with_space'] ) && $settings['full_content_with_space'] === 'end' ) {

		$el->add_render_attribute( '_wrapper >', 'style', 'padding-right: calc( (100% - '.$pxl_container_width.')/2);');
	}
}
