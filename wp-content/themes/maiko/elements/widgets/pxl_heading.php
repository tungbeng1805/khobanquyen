<?php
// 'pxl-splitting',
// 'pxl-typography-animation',
pxl_add_custom_widget(
    array(
        'name' => 'pxl_heading',
        'title' => esc_html__('BR Heading', 'maiko' ),
        'icon' => 'eicon-heading',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsap',
            'pxl-scroll-trigger',
            'pxl-splitText',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'source_type',
                            'label' => esc_html__('Source Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'text' => 'Text',
                                'title' => 'Page Title',
                            ],
                            'default' => 'text',
                        ),
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Sub Title', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'condition' => [
                                'source_type' => ['text'],
                            ],
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"] and Highlight text with shortcode: [highlight text="Text"]',
                        ),
                        array(
                          'name' => 'align',
                          'label' => esc_html__( 'Alignment', 'maiko' ),
                          'type' => \Elementor\Controls_Manager::CHOOSE,
                          'control_type' => 'responsive',
                          'options' => [
                            'left' => [
                                'title' => esc_html__( 'Left', 'maiko' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'maiko' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => esc_html__( 'Right', 'maiko' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                            'justify' => [
                                'title' => esc_html__( 'Justified', 'maiko' ),
                                'icon' => 'eicon-text-align-justify',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading' => 'text-align: {{VALUE}};',
                        ],
                    ),
                        array(
                            'name' => 'h_width',
                            'label' => esc_html__('Max Width', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-heading .pxl-heading--inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('HTML Tag', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h3',
                        ),

                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title' => 'color: {{VALUE}};-webkit-text-stroke-color:{{VALUE}};',
                                '{{WRAPPER}} .pxl-heading .pxl-item--title.style-outline .pxl-text-line-backdrop svg' => 'stroke:{{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Typography', 'maiko' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-heading .pxl-item--title',
                        ),
                        array(
                            'name' => 'custom_font',
                            'label' => esc_html__('Custom Font Family', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => 'Default',
                                'ft-gt' => 'Founders Grotesk',
                            ],
                            'default' => '',
                        ),
                        array(
                            'name'         => 'title_box_shadow',
                            'label' => esc_html__( 'Title Shadow', 'maiko' ),
                            'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-heading .pxl-item--title'
                        ),
                        array(
                            'name' => 'title_space_bottom',
                            'label' => esc_html__('Bottom Spacer', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 0,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'h_title_style',
                            'label' => esc_html__('Style', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-default' => 'Default',
                                'style-outline' => 'Outline',
                                'style-divider' => 'Divider',
                                'style-scroll-bg'  => esc_html__( 'Bg Scroll', 'maiko' ),
                            ],
                            'default' => 'style-default',
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.style-divider-style:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'h_title_style' => ['style-divider'],
                            ],
                        ),
                        array(
                            'name' => 'h_bg_color',
                            'label' => esc_html__('Scroll Background Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title.style-scroll-bg' => 'background: linear-gradient(to right, {{VALUE}}, {{VALUE}}) no-repeat;background-clip: text;',
                            ],
                            'condition' => [
                                'h_title_style' => ['style-scroll-bg'],
                            ],
                        ),
                        array(
                            'name' => 'divider_space_height',
                            'label' => esc_html__('Divider Height', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.style-divider-style:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                            'condition' => [
                                'h_title_style' => ['style-divider'],
                            ],
                        ),
                        array(
                            'name' => 'divider_space_bottom',
                            'label' => esc_html__('Divider Bottom Spacer', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-heading.style-divider-style:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                            'condition' => [
                                'h_title_style' => ['style-divider'],
                            ],
                        ),
                        maiko_split_text_option('title_'),
                        array(
                            'name' => 'pxl_animate',
                            'label' => esc_html__('Bravis Animate', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => maiko_widget_animate_v2(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'pxl_animate_delay',
                            'label' => esc_html__('Animate Delay', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
),
array(
    'name' => 'section_style_title_sub',
    'label' => esc_html__('Sub Title', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array_merge(
        array(
            array(
                'name' => 'sub_title_style',
                'label' => esc_html__('Style', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'px-sub-title-default' => 'Default',
                    'px-sub-title-dot' => 'Dot 1',
                    'px-sub-title-dot-2' => 'Dot 2',
                    'px-sub-title-dot-3' => 'Dot 3',
                    'px-sub-title-dot-4' => 'Dot 4',
                ],
                'default' => 'px-sub-title-default',
            ),
            array(
                'name' => 'border_width_outline_gradient',
                'label' => esc_html__('Width/Heigh Dot', 'maiko' ),
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
                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle:after,{{WRAPPER}} .pxl-heading .pxl-item--subtitle:before' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_title_style!' => ['px-sub-title-default'],
                ],
            ),
            array(
                'name' => 'sub_title_box_color',
                'label' => esc_html__('Box Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-item--subtitle:before,{{WRAPPER}} .pxl-item--subtitle:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sub_title_style!' => 'px-sub-title-default',
                ],
            ),

            array(
                'name' => 'sub_title_padding',
                'label' => esc_html__('Padding', 'maiko' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle .pxl-item--subtext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'control_type' => 'responsive',
            ),
            array(
                'name' => 'sub_title_color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'sub_title_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-heading .pxl-item--subtitle, {{WRAPPER}} .pxl-heading .pxl-item--subtitle span',
            ),
            array(
                'name' => 'custom_font_sub',
                'label' => esc_html__('Custom Font Family', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => 'Default',
                    'ft-gt' => 'Founders Grotesk',
                ],
                'default' => '',
            ),
            array(
                'name' => 'sub_title_space_top',
                'label' => esc_html__('Top Spacer', 'maiko' ),
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
                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'sub_title_space_bottom',
                'label' => esc_html__('Bottom Spacer', 'maiko' ),
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
                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ),
            maiko_split_text_option('subtitle_'),
            array(
                'name' => 'pxl_animate_sub',
                'label' => esc_html__('Bravis Animate', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => maiko_widget_animate_v2(),
                'default' => '',
            ),
            array(
                'name' => 'pxl_animate_delay_sub',
                'label' => esc_html__('Animate Delay', 'maiko' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0',
                'description' => 'Enter number. Default 0ms',
            ),
        )
),
),
array(
    'name' => 'section_style_highlight',
    'label' => esc_html__('Highlight', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array_merge(
        array(
            array(
                'name' => 'highlight_style',
                'label' => esc_html__('Style', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'highlight-default' => 'Default',
                    'highlight-text-gradient' => 'Text Gradient',
                ],
                'default' => 'highlight-default',
            ),
            array(
                'name' => 'highlight_color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_style' => ['highlight-default'],
                ],
            ),
            array(
                'name' => 'highlight_color_from',
                'label' => esc_html__('Color From', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_style' => ['highlight-text-gradient'],
                ],
            ),
            array(
                'name' => 'highlight_color_to',
                'label' => esc_html__('Color To', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_style' => ['highlight-text-gradient'],
                ],
            ),
            array(
                'name' => 'highlight_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-heading .pxl-title--highlight',
            ),
            array(
                'name' => 'highlight_text_image',
                'label' => esc_html__( 'Text Image', 'maiko' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-image: url( {{URL}} );',
                ],  
            ),
            array(
                'name' => 'highlight_image_position',
                'label' => esc_html__( 'Text Image Position', 'maiko' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'options'      => array(
                    ''              => esc_html__( 'Default', 'maiko' ),
                    'center center' => esc_html__( 'Center Center', 'maiko' ),
                    'center left'   => esc_html__( 'Center Left', 'maiko' ),
                    'center right'  => esc_html__( 'Center Right', 'maiko' ),
                    'top center'    => esc_html__( 'Top Center', 'maiko' ),
                    'top left'      => esc_html__( 'Top Left', 'maiko' ),
                    'top right'     => esc_html__( 'Top Right', 'maiko' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'maiko' ),
                    'bottom left'   => esc_html__( 'Bottom Left', 'maiko' ),
                    'bottom right'  => esc_html__( 'Bottom Right', 'maiko' ),
                    'initial'       =>  esc_html__( 'Custom', 'maiko' ),
                ),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-position: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_text_image[url]!' => ''
                ]        
            ),
            array(
                'name' => 'highlight_image_size',
                'label' => esc_html__( 'Text Image Size', 'maiko' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''              => esc_html__( 'Default', 'maiko' ),
                    'auto' => esc_html__( 'Auto', 'maiko' ),
                    'cover'   => esc_html__( 'Cover', 'maiko' ),
                    'contain'  => esc_html__( 'Contain', 'maiko' ),
                    'initial'    => esc_html__( 'Custom', 'maiko' ),
                ),
                'default'      => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-size: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_text_image[url]!' => ''
                ]        
            ),
        )
),
),

array(
    'name' => 'section_style_typewriter',
    'label' => esc_html__('Typewriter', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array_merge(
        array(
            array(
                'name' => 'typewriter_color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-heading .pxl-title--typewriter' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'typewriter_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-heading .pxl-title--typewriter',
            ),
        )
    ),
),
),
),
),
maiko_get_class_widget_path()
);