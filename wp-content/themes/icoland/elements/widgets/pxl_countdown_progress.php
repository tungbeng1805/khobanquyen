<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_countdown_progress',
        'title' => esc_html__('TN Countdown And Progress Bar', 'icoland' ),
        'icon' => 'eicon-countdown',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-countdown',
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_countdown/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'countdown_section',
                    'label' => esc_html__('Content', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_box',
                            'label' => esc_html__('Title', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'typography_title',
                            'label' => esc_html__('Typography Title', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .wrap-countdown .title',
                        ),
                        array(
                            'name' => 'align_title',
                            'label' => esc_html__( 'Alignment Title', 'icoland' ),
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
                            'selector' => '{{WRAPPER}} .wrap-countdown .title => text-align: {{VALUE}};',
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography Unit', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-countdown .countdown-period',
                        ),
                        array(
                            'name' => 'typography_nb',
                            'label' => esc_html__('Typography Number', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-countdown .countdown-amount span,{{WRAPPER}} .pxl-countdown .countdown-item:before',
                        ),
                        array(
                            'name' => 'date',
                            'label' => esc_html__('Date', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => esc_html__('Set date count down (Date format: yy/mm/dd)', 'icoland'),
                        ),
                        array(
                            'name' => 'pxl_day',
                            'label' => esc_html__('Day', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'show-day' => 'True',
                                'hide' => 'False',
                            ],
                            'default' => 'show-day',
                        ),
                        array(
                            'name' => 'pxl_hour',
                            'label' => esc_html__('Hour', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'show-hour' => 'True',
                                'hide' => 'False',
                            ],
                            'default' => 'show-hour',
                        ),
                        array(
                            'name' => 'pxl_minute',
                            'label' => esc_html__('Minute', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'show-minute' => 'True',
                                'hide' => 'False',
                            ],
                            'default' => 'show-minute',
                        ),
                        array(
                            'name' => 'pxl_second',
                            'label' => esc_html__('Second', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'show-second' => 'True',
                                'hide' => 'False',
                            ],
                            'default' => 'show-second',
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                            ],
                            'default' => 'style1',
                        ), 
                        array(
                            'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'flex-start' => [
                                    'title' => esc_html__( 'Left', 'icoland' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'icoland' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__( 'Right', 'icoland' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown-layout1' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                    ),
),
array(
    'name' => 'tab_content1',
    'label' => esc_html__( 'Content Progress Bar', 'icoland' ),
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
array(
    'name' => 'section_content_icon',
    'label' => esc_html__('Content Icon', 'icoland'),
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    'controls' => array(
        array(
            'name' => 'icons',
            'label' => esc_html__('Icons', 'icoland'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'controls' => array(
                array(
                    'name' => 'icon_type',
                    'label' => esc_html__('Type', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'icon' => 'Icon',
                        'image' => 'Image',
                    ],
                    'default' => 'icon',
                ),
                array(
                    'name' => 'icon_image',
                    'label' => esc_html__( 'Image', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'condition' => [
                        'icon_type' => 'image',
                    ],
                ),
                array(
                    'name' => 'pxl_icon',
                    'label' => esc_html__('Icon', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'condition' => [
                        'icon_type' => 'icon',
                    ],
                ),
                array(
                    'name' => 'icon_link',
                    'label' => esc_html__('Link', 'icoland'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'label_block' => true,
                ),
                array(
                    'name' => 'color_item',
                    'label' => esc_html__( 'Color', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                    ],
                ),
                array(
                    'name' => 'icon_space_top',
                    'label' => esc_html__('Spacer Top', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}} i' => 'transform:translatey({{SIZE}}{{UNIT}});',
                    ],
                ),
                array(
                    'name' => 'bgr-color_item',
                    'label' => esc_html__( 'Background Color', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                    ],
                ),
            ),
        ),
    ),
),
icoland_widget_animation_settings(),
),
),
),
icoland_get_class_widget_path()
);