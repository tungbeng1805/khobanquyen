<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_history',
        'title' => esc_html__('TN History', 'icoland'),
        'icon' => 'eicon-editor-link',
        'categories' => array('pxltheme-core'),
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
                                'image' => get_template_directory_uri() . '/elements/templates/pxl_history/layout-image/layout1.jpg'
                            ],
                            '2' => [
                                'label' => esc_html__('Layout 2', 'icoland' ),
                                'image' => get_template_directory_uri() . '/elements/templates/pxl_history/layout-image/layout2.jpg'
                            ],
                            '3' => [
                                'label' => esc_html__('Layout 3', 'icoland' ),
                                'image' => get_template_directory_uri() . '/elements/templates/pxl_history/layout-image/layout3.jpg'
                            ],
                            '4' => [
                                'label' => esc_html__('Layout 4', 'icoland' ),
                                'image' => get_template_directory_uri() . '/elements/templates/pxl_history/layout-image/layout4.jpg'
                            ],
                        ],
                    ),
                ),
            ),
             array(
                'name' => 'section_content',
                'label' => esc_html__('Content', 'icoland'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => ['1','2','3'],
                ],
                'controls' => array(
                    array(
                        'name' => 'history',
                        'label' => esc_html__('History', 'icoland'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'date',
                                'label' => esc_html__('Date(Does not work on layout 1.)', 'icoland'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'text',
                                'label' => esc_html__('Title', 'icoland'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'decs',
                                'label' => esc_html__('Description', 'icoland'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'it_active',
                                'label' => esc_html__('Active', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '',
                                'options' => [
                                    '' => esc_html__('Default', 'icoland' ),
                                    'active' => esc_html__('Active', 'icoland' ),
                                    'pre' => esc_html__('Present', 'icoland' ),
                                ],
                            ),
                            array(
                                'name' => 'space_bottom',
                                'label' => esc_html__('Space Top', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} {{CURRENT_ITEM}} ' => 'margin-top: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} {{CURRENT_ITEM}}.active .line2' => 'height: calc(100% + {{SIZE}}{{UNIT}}) !important;top: -{{SIZE}}{{UNIT}} !important;',
                                    '{{WRAPPER}} {{CURRENT_ITEM}}.pre .line2' => 'height: calc(50% + {{SIZE}}{{UNIT}}) !important;top: -{{SIZE}}{{UNIT}} !important;',
                                ],
                            ),
                        ),
                        'title_field' => '{{{ text }}}',
                    ),
                ),
            ),
             array(
                'name' => 'section_content_2',
                'label' => esc_html__('Content', 'icoland'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => ['4'],
                ],
                'controls' => array(
                    array(
                        'name' => 'history_2',
                        'label' => esc_html__('History', 'icoland'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'date_2',
                                'label' => esc_html__('Date(Does not work on layout 1.)', 'icoland'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'text_2',
                                'label' => esc_html__('Title', 'icoland'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'social',
                                'label' => esc_html__( 'List Content', 'icoland' ),
                                'type' => 'pxl_lists',
                            ),
                            array(
                                'name' => 'space_left',
                                'label' => esc_html__('Space Left', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => -300,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} {{CURRENT_ITEM}} ' => 'margin-left: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                        'title_field' => '{{{ text_2 }}}',
                    ),
                ),
            ),
             array(
                'name' => 'section_style_link',
                'label' => esc_html__('Style', 'icoland'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'height_line',
                        'label' => esc_html__('Height Procces', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-history:after ' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                      'name' => 'align',
                      'label' => esc_html__( 'Alignment', 'icoland' ),
                      'type' => \Elementor\Controls_Manager::CHOOSE,
                      'control_type' => 'responsive',
                      'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'icoland' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'icoland' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'icoland' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'icoland' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pxl-history' => 'text-align: {{VALUE}};',
                    ],
                ),
                    array(
                        'name' => 'link_color',
                        'label' => esc_html__('Title Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-history .title' => 'color: {{VALUE}};',
                        ],
                    ),

                    array(
                        'name' => 'desc_color',
                        'label' => esc_html__('Description Color ', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-history .desc' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'link_typography',
                        'label' => esc_html__('Title Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-history .title',
                    ),
                    array(
                        'name' => 'desc_typography',
                        'label' => esc_html__('Description Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-history .desc',
                    ),
                    array(
                        'name' => 'bottom_spacer',
                        'label' => esc_html__('Bottom Spacer', 'icoland' ),
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
                            '{{WRAPPER}} .pxl-history li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                ),
),
icoland_widget_animation_settings(),
),
),
),
icoland_get_class_widget_path()
);