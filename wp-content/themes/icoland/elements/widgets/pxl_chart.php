<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_chart',
        'title' => esc_html__('TN Chart', 'icoland' ),
        'icon' => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-chart',
            'chart',
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_chart/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_chart/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_chart/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name'     => 'chart_section',
                    'label'    => esc_html__( 'Chart Content', 'icoland' ),
                    'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'  => 'title_box',
                                'label' => esc_html__( 'Title Box', 'icoland' ),
                                'type'  => \Elementor\Controls_Manager::TEXT,
                                'condition' => [
                                    'layout' => ['2','3'],
                                ],
                            ),
                            array(
                                'name'    => 'pxl_chart',
                                'label'   => esc_html__( 'Chart Items', 'icoland' ),
                                'type'    => \Elementor\Controls_Manager::REPEATER,
                                'controls' => array(
                                    array(
                                        'name'  => 'chart_title',
                                        'label' => esc_html__( 'Title', 'icoland' ),
                                        'type'  => \Elementor\Controls_Manager::TEXT,
                                    ),
                                    array(
                                        'name'  => 'chart_value',
                                        'label' => esc_html__( 'Value', 'icoland' ),
                                        'type'  => \Elementor\Controls_Manager::NUMBER,
                                    ),
                                    array(
                                        'name'  => 'chart_color',
                                        'label' => esc_html__( 'Color', 'icoland' ),
                                        'type'  => \Elementor\Controls_Manager::COLOR,
                                    ),
                                    
                                ),
                                'default' => [
                                    [
                                        'chart_title'      => 'Retail',
                                        'chart_value'      => 40,
                                        'chart_color'      => '#9bcb3b',
                                    ],
                                    [
                                        'chart_title'      => 'Sciences',
                                        'chart_value'      => 20,
                                        'chart_color'      => '#5553ce',
                                    ],
                                    [
                                        'chart_title'      => 'Industrial',
                                        'chart_value'      => 15,
                                        'chart_color'      => '#f13a30',
                                    ],
                                    [
                                        'chart_title'      => 'Power',
                                        'chart_value'      => 15,
                                        'chart_color'      => '#f8a137',
                                    ],
                                    [
                                        'chart_title'      => 'Oil & Gas',
                                        'chart_value'      => 10,
                                        'chart_color'      => '#1875f0',
                                    ]
                                ],
                                'title_field' => '{{{ chart_title }}} ({{{ chart_value }}})',
                                'separator'   => 'after',
                            ),
                            
                        )
                    )
                ),
                array(
                    'name'     => 'style_section',
                    'label'    => esc_html__( 'Style Settings', 'icoland' ),
                    'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        array(
                            'name'    => 'pxl_chart_type',
                            'label'   => esc_html__( 'Chart Type', 'icoland' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                                'doughnut'  => __('Doughnut','icoland'),
                                'pie'       => __('Pie','icoland'),
                            ),
                            'default' => 'doughnut'
                        ),
                        array(
                            'name'         => 'pxl_chart_dimensions',
                            'label'        => esc_html__( 'Chart Dimensions', 'icoland' ),
                            'type'         => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ]
                            ],
                            'default' => [
                                'size' => 400
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-chart canvas' => 'height:{{SIZE}}px !important;',
                                '{{WRAPPER}} .pxl-chart .chart-bar' => 'width:{{SIZE}}px !important;',
                                '{{WRAPPER}} .pxl-chart-3 .title-box' => 'width:{{SIZE}}px !important;'
                            ],
                            'separator' => 'before'
                        ),
                        array(
                            'name' => 'boxcolor',
                            'label' => esc_html__('Box Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-chart' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'width_chart',
                            'label' => esc_html__( 'Cutout', 'icoland' ),
                            'type'  => \Elementor\Controls_Manager::NUMBER,
                        ),
                    ]
                ),
                icoland_widget_animation_settings(),
            ),
),
),icoland_get_class_widget_path()
);