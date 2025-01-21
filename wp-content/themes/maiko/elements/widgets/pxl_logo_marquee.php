<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_logo_marquee',
        'title' => esc_html__('BR Text Marquee', 'maiko'),
        'icon' => 'eicon-person',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsap',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'marquee',
                            'label' => esc_html__('Logo Marquee', 'maiko'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'maiko'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),                         
                        ),
                    ),
                ),
                array(
                    'name' => 'section_settings_carousel',
                    'label' => esc_html__('Settings', 'maiko'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-1' => 'Default',
                                'style-2' => 'Style 2',
                            ],
                            'default' => 'style-1',
                        ),
                        array(
                            'name' => 'show_line',
                            'label' => esc_html__('Show Line', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'line_color',
                            'label' => esc_html__('Line Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active:after,{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_line' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'line_top',
                            'label' => esc_html__('Line Top', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active:before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_line' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'line_bottom',
                            'label' => esc_html__('Line Bottom', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_line' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'slip_type',
                            'label' => esc_html__('Slip Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => 'Right To Left',
                                'right' => 'Left To Right',
                            ],
                        ),
                        array(
                            'name' => 'slip_duration',
                            'label' => esc_html__('Slip Duration', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '20',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_sm',
                            'label' => esc_html__('Columns SM Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '2',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_md',
                            'label' => esc_html__('Columns MD Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_lg',
                            'label' => esc_html__('Columns LG Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns XL Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                    ),
),

array(
    'name' => 'section_style',
    'label' => esc_html__('Style', 'maiko'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'logo_margin',
            'label' => esc_html__('Title Margin', 'maiko' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
        array(
            'name' => 'logo_padding',
            'label' => esc_html__('Title Padding', 'maiko' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
        array(
            'name' => 'logo_width',
            'label' => esc_html__('Title Box Width', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'description' => esc_html__('Enter number.', 'maiko' ),
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => ['col_xl!' => 'auto']
        ),
        array(
            'name' => 'logo_width_auto',
            'label' => esc_html__('Title Box Width', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'description' => esc_html__('Enter number.', 'maiko' ),
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--marquee' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => ['col_xl' => 'auto']
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Title Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'maiko' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo',
        ),
        array(
            'name' => 'dot_color',
            'label' => esc_html__('Dot Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo:after' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'dot_size',
            'label' => esc_html__('Dot Width/Height', 'maiko' ),
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
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo:after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'dot_top',
            'label' => esc_html__('Dot Top', 'maiko' ),
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
                '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--logo:after' => 'top: {{SIZE}}{{UNIT}};',
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