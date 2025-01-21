<?php
$templates_df = ['0' => esc_html__('None', 'maiko')];
$templates = $templates_df + maiko_get_templates_option('popup') ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_button',
        'title' => esc_html__('BR Button', 'maiko' ),
        'icon' => 'eicon-button',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'maiko' ),
                                'btn-drow-arrow' => esc_html__('Arrows', 'maiko' ),
                                'btn-icon-box' => esc_html__('Icon Box', 'maiko' ),
                                'btn-icon-box-hover' => esc_html__('Icon Box Hover', 'maiko' ),
                                'btn-blur' => esc_html__('Background Blur', 'maiko' ),
                                'btn-popup' => esc_html__('Popup', 'maiko' ),
                            ],
                        ),
                        array(
                            'name' => 'text',
                            'label' => esc_html__('Text', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click Here', 'maiko'),
                        ),
                        array(
                            'name' => 'btn_action',
                            'label' => esc_html__('Action', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'pxl-atc-link',
                            'options' => [
                                'pxl-atc-link' => esc_html__('Link', 'maiko' ),
                                'pxl-atc-popup' => esc_html__('Popup', 'maiko' ),
                            ],
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'default' => [
                                'url' => '#',
                            ],
                            'condition' => [
                                'btn_action' => ['pxl-atc-link'],
                            ],
                        ),

                        array(
                            'name' => 'popup_template',
                            'label' => esc_html__('Select Popup Template', 'maiko'),
                            'type' => 'select',
                            'options' => $templates,
                            'default' => 'df',
                            'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>"',
                            'condition' => [
                                'btn_action' => ['pxl-atc-popup'],
                            ],
                        ),

                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left'    => [
                                    'title' => esc_html__('Left', 'maiko' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'maiko' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'maiko' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__('Justified', 'maiko' ),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'prefix_class' => 'elementor-align-',
                            'default' => '',
                            'selectors'         => [
                                '{{WRAPPER}} .pxl-button' => 'text-align: {{VALUE}}',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'right',
                            'options' => [
                                'left' => esc_html__('Before', 'maiko' ),
                                'right' => esc_html__('After', 'maiko' ),
                            ],
                        ),
                    ),
),

array(
    'name' => 'section_style_button',
    'label' => esc_html__('Button Normal', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array_merge(
        array(
            array(
                'name' => 'btn_w',
                'label' => esc_html__('Width', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => esc_html__('Inline', 'maiko' ),
                    'full' => esc_html__('Full Width', 'maiko' ),
                ],
            ),
            array(
                'name' => 'button_width',
                'label' => esc_html__( 'Button Width/Height', 'maiko' ),
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
                    '{{WRAPPER}} .pxl-button .btn.btn-icon-box' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_style' => 'btn-icon-box',
                ],
            ),
            array(
                'name' => 'color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'btn_bg_color',
                'label' => esc_html__('Background Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'background-color: {{VALUE}};',
                ],
            ),

            array(
                'name' => 'btn_stroke_color',
                'label' => esc_html__('Stroke Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn.btn-stroke .pxl-svg-line path' => 'stroke: {{VALUE}};',
                ],
                'condition' => [
                    'btn_style' => ['btn-stroke'],
                ],
            ),

            array(
                'name' => 'border_color_ab',
                'label' => esc_html__( 'Border Color After/Before', 'sorrento' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn:not(.btn-stroke).btn-default:before,{{WRAPPER}} .btn:not(.btn-stroke).btn-default:after,{{WRAPPER}} .btn:not(.btn-stroke).btn-default .pxl--btn-text:before,{{WRAPPER}} .btn:not(.btn-stroke).btn-default .pxl--btn-text:after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_style!' => 'btn-stroke',
                ],
            ),

            array(
                'name' => 'btn_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-button .btn',
            ),
            array(
                'name'         => 'btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'maiko' ),
                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                'control_type' => 'group',
                'selector'     => '{{WRAPPER}} .pxl-button .btn',
            ),
            array(
                'name' => 'border_type',
                'label' => esc_html__( 'Border Type', 'maiko' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'maiko' ),
                    'solid' => esc_html__( 'Solid', 'maiko' ),
                    'double' => esc_html__( 'Double', 'maiko' ),
                    'dotted' => esc_html__( 'Dotted', 'maiko' ),
                    'dashed' => esc_html__( 'Dashed', 'maiko' ),
                    'groove' => esc_html__( 'Groove', 'maiko' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-style: {{VALUE}} !important;',
                ],
            ),
            array(
                'name' => 'border_width',
                'label' => esc_html__( 'Border Width', 'maiko' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'border_type!' => '',
                ],
                'responsive' => true,
            ),
            array(
                'name' => 'border_color',
                'label' => esc_html__( 'Border Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'border_type!' => '',
                ],
            ),

            array(
                'name' => 'border_width_outline_gradient',
                'label' => esc_html__('Broder Width Gradient', 'maiko' ),
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
                    '{{WRAPPER}} .pxl-button .btn.btn-outline-gradient:after' => 'top: {{SIZE}}{{UNIT}};right: {{SIZE}}{{UNIT}};bottom: {{SIZE}}{{UNIT}};left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_style' => ['btn-outline-gradient'],
                ],
            ),
        ),

array(
    array(
        'name' => 'btn_border_radius',
        'label' => esc_html__('Border Radius', 'maiko' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors' => [
            '{{WRAPPER}} .pxl-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ),
    array(
        'name' => 'btn_padding',
        'label' => esc_html__('Padding', 'maiko' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors' => [
            '{{WRAPPER}} .pxl-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'control_type' => 'responsive',
    ),
)
),
),

array(
    'name' => 'section_style_button_hover',
    'label' => esc_html__('Button Hover', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'btn_text_effect',
            'label' => esc_html__('Text Effect', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'maiko' ),
                'btn-text-nina' => esc_html__('Nina', 'maiko' ),
                'btn-text-nanuk' => esc_html__('Nanuk', 'maiko' ),
                'btn-text-smoke' => esc_html__('Smoke', 'maiko' ),
                'btn-text-reverse' => esc_html__('Reverse', 'maiko' ),
                'btn-text-parallax' => esc_html__('Text Parallax', 'maiko' ),
                'btn-hide-icon' => esc_html__('Hide Icon', 'maiko' ),
                'btn-glossy' => esc_html__('Glossy', 'maiko' ),
                'btn-underline' => esc_html__('Underline', 'maiko' ),
                'btn-text-applied' => esc_html__('Applied', 'maiko' ),
            ],
        ),
        array(
            'name' => 'transition_duration',
            'label' => esc_html__('Transition Duration', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .btn.btn-text-reverse .pxl-text--inner span' => 'transition-duration: {{SIZE}}ms;',
            ],
            'condition' => [
                'btn_text_effect' => ['btn-text-reverse'],
            ],
            'description' => 'Enter number, unit is ms.',
        ),
        array(
            'name' => 'color_hover',
            'label' => esc_html__('Color Hover', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn-hide-icon .pxl--btn-text:before' => 'background-color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'bd_color_hover',
            'label' => esc_html__('Border Color Hover', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => ' border-color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'btn_bg_color_hover',
            'label' => esc_html__('Background Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'btn_style!' => [''],
            ],
        ),

        array(
            'name'         => 'btn_box_shadow_hover',
            'label' => esc_html__( 'Box Shadow', 'maiko' ),
            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} .pxl-button .btn:hover',
        ),
    ),
),

array(
    'name' => 'section_style_icon',
    'label' => esc_html__('Icon', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'icon_color',
            'label' => esc_html__('Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn svg path' => 'fill: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn .st0' => 'stroke: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'icon_hv_color',
            'label' => esc_html__('Color Hover', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn:hover svg path' => 'fill: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'icon_font_size',
            'label' => esc_html__('Font Size', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'default' => [
                'size' => 32,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn.btn-default svg' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn-svg:hover svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'icon_space_left',
            'label' => esc_html__('Icon Spacer', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'default' => [
                'size' => 9,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn.pxl-icon--left:not(.btn-svg) i, {{WRAPPER}} .pxl-button .btn.pxl-icon--left:not(.btn-svg) svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn-svg.pxl-icon--left:hover  svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn-drow-arrow.pxl-icon--left .crossline-arrow' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_align' => ['left'],
                'btn_text_effect!' => ['btn-text-applied'],
            ],
        ),
        array(
            'name' => 'icon_space_left_applied',
            'label' => esc_html__('Icon Spacer Left', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'default' => [
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn .btn-icon-left' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'btn_text_effect' => ['btn-text-applied'],
            ],
        ),
        array(
            'name' => 'icon_space_right_applied',
            'label' => esc_html__('Icon Spacer Right', 'maiko' ),
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
                '{{WRAPPER}} .pxl-button .btn .btn-icon-right' => 'margin-inline-start: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn:hover .btn-icon-left' => 'margin-inline-end: {{SIZE}}{{UNIT}};margin-inline-start: 0;',
                '{{WRAPPER}} .pxl-button .btn:hover .btn-icon-right' => 'margin-inline-start: 0;',
            ],
            'condition' => [
                'btn_text_effect' => ['btn-text-applied'],
            ],
        ),
        array(
            'name' => 'icon_space_right',
            'label' => esc_html__('Icon Spacer', 'maiko' ),
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
                '{{WRAPPER}} .pxl-button .btn.pxl-icon--right:not(.btn-svg) i, {{WRAPPER}} .pxl-button .btn.pxl-icon--right:not(.btn-svg) svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn-svg.pxl-icon--right:hover svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn-drow-arrow.pxl-icon--right .crossline-arrow' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_align' => ['right'],
                'btn_text_effect!' => ['btn-text-applied'],
            ],
        ),
    ),
),
maiko_widget_animation_settings(),
),
),
),
maiko_get_class_widget_path()
);