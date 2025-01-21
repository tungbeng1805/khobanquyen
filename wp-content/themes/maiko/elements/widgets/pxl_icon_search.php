<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_search',
        'title' => esc_html__('BR Search', 'maiko' ),
        'icon' => 'eicon-search',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'search_type',
                            'label' => esc_html__('Search Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'popup' => 'Popup',
                                'form' => 'Form',
                            ],
                            'default' => 'popup',
                        ),
                        array(
                            'name' => 'email_placefolder',
                            'label' => esc_html__('Email Placefolder', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'search_type' => ['form'],
                            ],
                        ),
                        array(
                            'name' => 'icon_image_type',
                            'label' => esc_html__('Icon Image Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'img' => 'Image',
                                'ic' => 'Icon',
                            ],
                            'default' => 'img',
                        ),
                        array(
                            'name' => 'pxl_icon',
                            'label' => esc_html__('Icon', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'search_type' => ['popup'],
                                'icon_image_type' => ['ic'],
                            ],
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__( 'Icon Image', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'search_type' => ['popup'],
                                'icon_image_type' => ['img'],
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button i' => 'color: {{VALUE}} !important;',
                                '{{WRAPPER}} .pxl-search-popup-button svg' => 'fill: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'bd_icon_color',
                            'label' => esc_html__('Border Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button ' => 'border-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Icon Color Hover', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button:hover i' => 'color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-search-popup-button' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-default' => 'Default',
                                'style-box' => 'Box',
                                'style-box-bd' => 'Box Border',
                            ],
                            'default' => 'style-default',
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'box_color',
                            'label' => esc_html__('Box Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style' => ['style-box','style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'box_color_hv',
                            'label' => esc_html__('Box Color Hover', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button.style-box:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['style-box','style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'box_height',
                            'label' => esc_html__('Box Height', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box','style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'box_width',
                            'label' => esc_html__('Box Width', 'maiko' ),
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
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box','style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box','style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    maiko_get_class_widget_path()
);