<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_accordion',
        'title' => esc_html__('TN Accordion', 'icoland' ),
        'icon' => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'icoland-accordion',
            'pxl-accordion',
        ),
        'params' => array(
            'sections' => array(
                
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                                'style4' => 'Style 4',
                                'style5' => 'Style 5',
                            ],
                            'default' => 'style1',
                        ),
                        array( 
                            'name' => 'active',
                            'label' => esc_html__('Active', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                            'default' => '1',
                        ),
                        array(
                            'name' => 'accordion',
                            'label' => esc_html__('Accordion', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Content', 'icoland' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                            'separator' => 'after',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style_arr',
                            'label' => esc_html__('Style Arrow', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'arr' => 'Arrow',
                                'plus' => 'Plus',
                            ],
                            'default' => 'arr',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl-item-accordion' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_color_at',
                            'label' => esc_html__('Color Active', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .active .pxl-item-accordion' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-accordion .pxl--item.active i:before' => 'color: {{VALUE}};',
                            ],
                        ),
                         array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl-item-accordion i:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-accordion .pxl-item-accordion i:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['style' => 'style3'] 
                        ),
                        array(
                            'name' => 'bg_icon_color',
                            'label' => esc_html__('Background Icon Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl-item-accordion i' => 'background-color: {{VALUE}};',
                            ],
                        ),
                         array(
                            'name' => 'ic_bg_color1',
                            'label' => esc_html__('Background Icon Gradient Color', 'icoland' ),
                            'type'         => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'gradient' ],
                            'selector'     => '{{WRAPPER}} .pxl-accordion .pxl-item-accordion i',
                        ),

                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Typography', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-accordion .pxl-item-accordion',
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('HTML Tag', 'icoland' ),
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
                    ),
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__('Content', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'border_type',
                            'label' => esc_html__( 'Border Type', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => esc_html__( 'None', 'icoland' ),
                                'solid' => esc_html__( 'Solid', 'icoland' ),
                                'double' => esc_html__( 'Double', 'icoland' ),
                                'dotted' => esc_html__( 'Dotted', 'icoland' ),
                                'dashed' => esc_html__( 'Dashed', 'icoland' ),
                                'groove' => esc_html__( 'Groove', 'icoland' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'border-style: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'border_type!' => '',
                            ],
                            'responsive' => true,
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'border-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'border_type!' => '',
                            ],
                        ),
                        array(
                            'name' => 'btn_border_radius',
                            'label' => esc_html__('Border Radius', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item, {{WRAPPER}} .pxl-accordion .pxl--item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                       array(
                            'name' => 'space',
                            'label' => esc_html__('Space', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'bd_color',
                            'label' => esc_html__('Border Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'bd_color_at',
                            'label' => esc_html__('Border Color Active', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item.active' => 'border-color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'ar_color',
                            'label' => esc_html__('Arrow Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion i' => 'color: {{VALUE}}; opacity: 1;',
                                '{{WRAPPER}} .pxl-accordion i:before' => 'opacity: 1;',
                            ],
                        ),
                        array(
                            'name' => 'ar_color_at',
                            'label' => esc_html__('Arrow Color Active', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .active i:before' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_color_at',
                            'label' => esc_html__('Background Color Active', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl--item.active' => 'background-color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content-acc' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Typography', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-accordion .pxl-item--content-acc',
                        ),
                    ),
                ),
                icoland_widget_animation_settings(),
            ),
),
),
icoland_get_class_widget_path()
);