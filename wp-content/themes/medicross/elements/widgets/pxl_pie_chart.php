<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_pie_chart',
        'title' => esc_html__('Case Pie Chart', 'medicross'),
        'icon' => 'far fa-chart-pie-alt',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-pie-chart',
            'medicross-pie-chart',
            'elementor-waypoints',
            'jquery-numerator',
            'pxl-counter',
            'medicross-counter',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_layout',
                    'label' => esc_html__('Layout', 'medicross' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'medicross' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'medicross' ),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_pie_chart/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'medicross' ),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_pie_chart/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Content', 'medicross'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'medicross'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'medicross'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'percentage_value',
                            'label' => esc_html__('Percentage Value', 'medicross'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'min' => 1,
                            'max' => 100,
                            'step' => 1,
                            'default' => 50,
                        ),
                        array(
                            'name' => 'chart_size',
                            'label' => esc_html__('Chart Size', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 178,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1170,
                                ],
                            ],
                        ),
                        array(
                            'name' => 'counter_number',
                            'label' => esc_html__('Counter Number', 'medicross'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 100,
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                        array(
                            'name' => 'counter_suffix',
                            'label' => esc_html__('Counter Suffix', 'medicross'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_title',
                    'label' => esc_html__('Title', 'medicross'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Color', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pie-chart .pxl-item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-pie-chart .pxl-item-title span' => 'text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Typography', 'medicross' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-pie-chart .pxl-item-title',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_percentage',
                    'label' => esc_html__('Percentage', 'medicross'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'bar_color',
                            'label' => esc_html__('Bar Color From', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                        ),
                        array(
                            'name' => 'bar_color_to',
                            'label' => esc_html__('Bar Color To', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                        ),
                        array(
                            'name' => 'track_color',
                            'label' => esc_html__('Track Color', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pie-chart .pxl-item--divider' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'chart_line_width',
                            'label' => esc_html__('Chart Line Width', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 10,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                        ),
                        array(
                            'name' => 'chart_line_cap',
                            'label' => esc_html__('Chart Line Cap', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'square' => 'Square',
                                'round' => 'Round',
                            ],
                            'default' => 'square',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_counter',
                    'label' => esc_html__('Counter', 'medicross'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'counter_color',
                            'label' => esc_html__('Color', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pie-chart .pxl--counter-number' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'counter_typography',
                            'label' => esc_html__('Typography', 'medicross' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-pie-chart .pxl--counter-number',
                        ),
                    ),
                ),
                medicross_widget_animation_settings(),
            ),
        ),
    ),
    medicross_get_class_widget_path()
);