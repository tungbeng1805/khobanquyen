<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_pricing',
        'title' => esc_html__('TN Pricing', 'icoland'),
        'icon' => 'eicon-settings',
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_pricing/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_pricing/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_pricing/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_pricing/layout-image/layout4.jpg'
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
                            'name' => 'image',
                            'label' => esc_html__('Image', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => ['3'],
                            ],
                        ),
                        array(
                            'name' => 'title_note',
                            'label' => esc_html__('Note', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Sub Title', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'title_ft1',
                            'label' => esc_html__('Title Feature 1', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'feature',
                            'label' => esc_html__('Feature 1', 'icoland'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'feature_text',
                                    'label' => esc_html__('Text', 'icoland'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'active',
                                    'label' => esc_html__('Active', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'non-active' => 'No',
                                        'is-active' => 'Yes',
                                    ],
                                    'default' => 'is-active',
                                ),
                            ),
                            'title_field' => '{{{ feature_text }}}',
                        ),
                        array(
                            'name' => 'title_ft2',
                            'label' => esc_html__('Title Feature 2', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'feature_2',
                            'label' => esc_html__('Feature 2', 'icoland'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'feature_text_2',
                                    'label' => esc_html__('Text', 'icoland'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'active_2',
                                    'label' => esc_html__('Active', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'non-active' => 'No',
                                        'is-active' => 'Yes',
                                    ],
                                    'default' => 'is-active',
                                ),
                            ),
                            'title_field' => '{{{ feature_text_2 }}}',
                        ),
                        array(
                            'name' => 'price',
                            'label' => esc_html__('Price', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'sub_price',
                            'label' => esc_html__('Sub Price', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'sub_btn',
                            'label' => esc_html__('Sub Button', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                        ),
                        array(
                            'name' => 'button_link',
                            'label' => esc_html__('Button Link', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                    ),
                ),
                array(
                'name' => 'section_style',
                'label' => esc_html__('Style', 'icoland' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'box_note_color',
                        'label' => esc_html__('Box Note Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--title--note' => 'background-color: {{VALUE}} !important;',
                        ],
                    ),
                    array(
                        'name' => 'box_color',
                        'label' => esc_html__('Box Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing' => 'background-color: {{VALUE}} !important;',
                        ],
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--title,{{WRAPPER}} .pxl-pricing .pxl-item--title--pr, {{WRAPPER}} .pxl-pricing .pxl-item--title span' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                        ],
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--title',
                    ),
                    array(
                        'name' => 'sub_pr_btn_color',
                        'label' => esc_html__('Text Sub Button Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .sub-btn' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'sub_pr_color',
                        'label' => esc_html__('Sub Button Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--sub--price' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'sub_title_color',
                        'label' => esc_html__('Sub Title Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--subtitle' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'sub_title_typography',
                        'label' => esc_html__('Sub Title Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--subtitle',
                    ),
                    array(
                        'name' => 'feature_title_color',
                        'label' => esc_html__('Title Feature Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .wrap-feature span' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_color',
                        'label' => esc_html__('Feature Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--feature li' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_color-icon',
                        'label' => esc_html__('Icon Feature Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--feature li i' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_color_st',
                        'label' => esc_html__('Feature Color Strong', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--feature li strong' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2'],
                        ],
                    ),
                    array(
                        'name' => 'feature_line_color',
                        'label' => esc_html__('Feature Divider Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--feature li' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2'],
                        ],
                    ),
                    array(
                        'name' => 'feature_typography',
                        'label' => esc_html__('Feature Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--feature li',
                    ),
                    array(
                        'name' => 'box_price_color',
                        'label' => esc_html__('Box Price Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--price' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2'],
                        ],
                    ),
                    array(
                        'name' => 'price_color',
                        'label' => esc_html__('Price Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--price' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'price_typography',
                        'label' => esc_html__('Price Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--price',
                    ),
                    array(
                        'name' => 'popular_color',
                        'label' => esc_html__('Popular Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing .pxl-item--popular span' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'box_bg_color',
                        'label' => esc_html__('Background Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing:before' => 'background-color: {{VALUE}} !important;',
                            '{{WRAPPER}} .pxl-pricing:after' => 'background-color: {{VALUE}} !important;',
                            '{{WRAPPER}} .pxl-pricing .item--star' => 'box-shadow: {{VALUE}} -8px 31px 50px;',
                        ],
                    ),
                    array(
                        'name' => 'bg_btn_color',
                        'label' => esc_html__('Background Button Color', 'icoland' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-item--button a' => 'background-color: {{VALUE}} !important;',
                            '{{WRAPPER}} .pxl-pricing .btn-readmore' => 'background-color: {{VALUE}} !important;',
                        ],
                    ),
                    array(
                        'name' => 'popular_typography',
                        'label' => esc_html__('Popular Typography', 'icoland' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--popular span',
                        'condition' => [
                            'layout' => ['1'],
                        ],
                    ),

                ),
                ),icoland_widget_animation_settings(),
            ),
        ),
    ),
icoland_get_class_widget_path()
);