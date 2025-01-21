<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_progressbar',
        'title' => esc_html__( 'TN Progress Bar', 'icoland' ),
        'icon' => 'eicon-skill-bar',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-progressbar',
            'icoland-progressbar',
            'pxl-countdown',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_layout',
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_progressbar/img-layout/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_progressbar/img-layout/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_progressbar/img-layout/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content_1',
                    'label' => esc_html__( 'Content', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'progressbar_1',
                            'label' => esc_html__( 'Progress Bar', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => '2',
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'title_1',
                                    'label' => esc_html__( 'Title', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                
                                array(
                                    'name' => 'percent_1',
                                    'label' => esc_html__( 'Percentage', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'default' => [
                                        'size' => 50,
                                        'unit' => '%',
                                    ],
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title_1 }}}',
                        ),
                        array(
                            'name' => 'item_space_2',
                            'label' => esc_html__('Item Spacer', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-progressbar .pxl--item + .pxl--item' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Content', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '1',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'progressbar',
                            'label' => esc_html__( 'Progress Bar', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title_rp',
                                    'label' => esc_html__('Text Instead Of Value ', 'icoland'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__( 'Title', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ), 

                                array(
                                    'name' => 'title_end',
                                    'label' => esc_html__( 'Title End', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ), 
                                array(
                                    'name' => 'vl1',
                                    'label' => esc_html__( 'Value 1', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ), 
                                array(
                                    'name' => 'vl2',
                                    'label' => esc_html__( 'Value 2', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),  
                                array(
                                    'name' => 'vl3',
                                    'label' => esc_html__( 'Value 3', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ), 
                                array(
                                    'name' => 'percent',
                                    'label' => esc_html__( 'Percentage', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'default' => [
                                        'size' => 50,
                                        'unit' => '%',
                                    ],
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Spacer', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-progressbar .pxl--item + .pxl--item' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                    ),
                ),
                array(
                        'name' => 'tab_style_title',
                        'label' => esc_html__( 'Title', 'icoland' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__( 'Title Color', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--title' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'title_typography',
                                'label' => esc_html__( 'Title Typography', 'icoland' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}}  .pxl-progressbar .pxl--title',
                            ),
                        ),
                ),
                array(
                        'name' => 'tab_style_percentage',
                        'label' => esc_html__( 'Percentage', 'icoland' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'vl1_l',
                                'label' => esc_html__('Value 1 Space Left', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'condition' => [
                                    'layout' => '1',
                                ],
                                'size_units' => [ 'px' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--value1' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'vl2_l',
                                'label' => esc_html__('Value 2 Space Left', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'condition' => [
                                    'layout' => '1',
                                ],
                                'size_units' => [ 'px' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--value2' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'vl1_3',
                                'label' => esc_html__('Value 3 Space Right', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'condition' => [
                                    'layout' => '1',
                                ],
                                'size_units' => [ 'px' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--value3' => 'right: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'percentage_color',
                                'label' => esc_html__( 'Percentage Color', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--percentage' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'percentage_typography',
                                'label' => esc_html__( 'Percentage Typography', 'icoland' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-progressbar .pxl--percentage',
                            ),
                        ),
                ),
                array(
                        'name' => 'tab_style_bar',
                        'label' => esc_html__( 'Bar', 'icoland' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'height_bar',
                                'label' => esc_html__('Height Bar', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'condition' => [
                                    'layout' => '1',
                                ],
                                'size_units' => [ 'px' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--progressbar' => 'height: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .pxl-progressbar .pxl--holder' => 'height: calc({{SIZE}}{{UNIT}} + 8px);', '{{WRAPPER}} .pxl-progressbar .pxl--percentage' => 'line-height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'btn_gradient',
                                'label' => esc_html__( 'Background Type', 'icoland' ),
                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'gradient' ],
                                'selector'     => '{{WRAPPER}} .pxl-progressbar .pxl--progressbar',
                            ),
                            array(
                                'name' => 'bar_color',
                                'label' => esc_html__( 'Bar Color', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--progressbar' => 'background: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'bar_bg_color',
                                'label' => esc_html__( 'Bar Background Color', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-progressbar .pxl--holder' => 'background: {{VALUE}};',
                                ],
                            ),
                        ),
                ),
                icoland_widget_animation_settings(),
            ),
        ),
    ),icoland_get_class_widget_path()
);