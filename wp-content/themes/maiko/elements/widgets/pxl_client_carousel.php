<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

pxl_add_custom_widget(
    array(
        'name' => 'pxl_client_carousel',
        'title' => esc_html__('BR Client Carousel', 'maiko'),
        'icon' => 'eicon-person',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'maiko' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_client_carousel/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'client',
                            'label' => esc_html__('Client', 'maiko'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'logo',
                                    'label' => esc_html__('Logo', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'logo2',
                                    'label' => esc_html__('Logo Hover', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'btn_link',
                                    'label' => esc_html__('Link', 'maiko'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'color_item',
                                    'label' => esc_html__( 'Boder Color', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'default' => '',
                                    'selectors' => [
                                        '{{WRAPPER}} {{CURRENT_ITEM}} .shape1' => 'background-color: {{VALUE}} !important;',
                                        '{{WRAPPER}} {{CURRENT_ITEM}} .shape2' => 'background-color: {{VALUE}} !important;',
                                        '{{WRAPPER}} {{CURRENT_ITEM}} .shape3' => 'background-color: {{VALUE}} !important;',
                                        '{{WRAPPER}} {{CURRENT_ITEM}} .shape4' => 'background-color: {{VALUE}} !important;',
                                    ],
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
                            'name'         => 'box_border',
                            'label' => esc_html__( 'Brder', 'maiko' ),
                            'type'         => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-client-carousel1.style-1 .pxl-swiper-slide .pxl-item--inner',
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
                                '6' => '6',
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
                            ],
                        ),

                        array(
                            'name' => 'col_xxl',
                            'label' => esc_html__('Columns XXL Devices', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'inherit',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                'inherit' => 'Inherit',
                            ],
                        ),

                        array(
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to scroll', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'style-1',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'maiko' ),
                                'style-2' => esc_html__('Style 2', 'maiko' ),
                                'style-3' => esc_html__('Style 3', 'maiko' ),
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'maiko'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Show Pagination', 'maiko'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'pagination_type',
                            'label' => esc_html__('Pagination Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'bullets',
                            'options' => [
                                'bullets' => 'Bullets',
                                'fraction' => 'Fraction',
                            ],
                            'condition' => [
                                'pagination' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'maiko'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'maiko'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Speed', 'maiko'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'maiko'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'maiko'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                    ),
),
maiko_widget_animation_settings(),
),
),
),
maiko_get_class_widget_path()
);