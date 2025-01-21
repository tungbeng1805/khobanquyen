<?php
$pt_supports = ['post'];
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_carousel',
        'title' => esc_html__('TN Post Carousel', 'icoland' ),
        'icon' => 'eicon-posts-carousel',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'icoland' ),
                    'tab'      => 'layout',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'icoland' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => icoland_get_post_type_options($pt_supports),
                                'default'  => 'post'
                            ) 
                        ),
                        icoland_get_post_carousel_layout($pt_supports)
                    ),
                ),
                array(
                    'name' => 'section_source',
                    'label' => esc_html__('Source', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'select_post_by',
                                'label'    => esc_html__( 'Select posts by', 'icoland' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => [
                                    'term_selected' => esc_html__( 'Terms selected', 'icoland' ),
                                    'post_selected' => esc_html__( 'Posts selected ', 'icoland' ),
                                ],
                                'default'  => 'term_selected'
                            ) 
                        ),
                        icoland_get_grid_term_by_posttype($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        icoland_get_grid_ids_by_posttype($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                        array(
                            array(
                                'name' => 'orderby',
                                'label' => esc_html__('Order By', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'date',
                                'options' => [
                                    'date' => esc_html__('Date', 'icoland' ),
                                    'ID' => esc_html__('ID', 'icoland' ),
                                    'author' => esc_html__('Author', 'icoland' ),
                                    'title' => esc_html__('Title', 'icoland' ),
                                    'rand' => esc_html__('Random', 'icoland' ),
                                ],
                            ),
                            array(
                                'name' => 'order',
                                'label' => esc_html__('Sort Order', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'desc',
                                'options' => [
                                    'desc' => esc_html__('Descending', 'icoland' ),
                                    'asc' => esc_html__('Ascending', 'icoland' ),
                                ],
                            ),
                            array(
                                'name' => 'limit',
                                'label' => esc_html__('Total items', 'icoland' ),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => '6',
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'section_carousel',
                    'label' => esc_html__('Carousel', 'icoland'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'pxl_animate',
                            'label' => esc_html__('Ukilo Animate', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => icoland_widget_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'icoland' ),
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
                            'label' => esc_html__('Columns SM Devices', 'icoland' ),
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
                            'label' => esc_html__('Columns MD Devices', 'icoland' ),
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
                            'label' => esc_html__('Columns LG Devices', 'icoland' ),
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
                            'label' => esc_html__('Columns XL Devices', 'icoland' ),
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
                            'name' => 'col_xxl',
                            'label' => esc_html__('Columns XXL Devices', 'icoland' ),
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
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to scroll', 'icoland' ),
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
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Show Pagination', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'pagination_type',
                            'label' => esc_html__('Pagination Type', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'bullets',
                            'options' => [
                                'bullets' => 'Bullets',
                                'fraction' => 'Fraction',
                                'progressbar' => 'Progressbar',
                            ],
                            'condition' => [
                                'pagination' => 'true'
                            ]
                        ),

                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Delay', 'icoland'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'false'
                            ]
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'icoland'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name' => 'drap',
                            'label' => esc_html__('Show Scroll Drap', 'icoland'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                    ),
),
array(
    'name' => 'section_display',
    'label' => esc_html__('Display', 'icoland' ),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name' => 'style1',
            'label' => esc_html__('Style', 'icoland' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style-1',
            'options' => [
                'style-1' => esc_html__('Style 1', 'icoland' ),
                'style-2' => esc_html__('Style 2', 'icoland' ),
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-4']
                        ]
                    ]
                ],
            ]
        ]
    ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'icoland' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-post-carousel .pxl-item--title a',
        ),
        array(
            'name' => 'img_size',
            'label' => esc_html__('Image Size', 'icoland' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
        ),

        array(
            'name' => 'img_sizes',
            'label' => esc_html__('Image Sizes', 'icoland'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'controls' => array(
                array(
                    'name' => 'img_size_item',
                    'label' => esc_html__('Size', 'icoland' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'description' => 'Image sizes for each item. Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                ),
            ),
            'title_field' => '{{{ img_size_item }}}',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'portfolio'],
                            ['name' => 'layout_portfolio', 'operator' => 'in', 'value' => ['portfolio-1','portfolio-2']]
                        ]
                    ]
                ],
            ]
        ),
                        // array(
                        //     'name' => 'show_date',
                        //     'label' => esc_html__('Show Date', 'icoland' ),
                        //     'type' => \Elementor\Controls_Manager::SWITCHER,
                        //     'default' => 'true',
                        //     'conditions' => [
                        //         'relation' => 'or',
                        //         'terms' => [
                        //             [
                        //                 'terms' => [
                        //                     ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                        //                     ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1','post-2']]
                        //                 ]
                        //             ]
                        //         ],
                        //     ]
                        // ),
                        // // array(
                        // //     'name' => 'show_author',
                        // //     'label' => esc_html__('Show Author', 'icoland' ),
                        // //     'type' => \Elementor\Controls_Manager::SWITCHER,
                        // //     'default' => 'true',
                        // //     'conditions' => [
                        // //         'relation' => 'or',
                        // //         'terms' => [
                        // //             [
                        // //                 'terms' => [
                        // //                     ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                        // //                     ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1','post-2']]
                        // //                 ]
                        // //             ]
                        // //         ],
                        // //     ]
                        // // ),
        array(
            'name' => 'show_category',
            'label' => esc_html__('Show Category', 'icoland' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'portfolio'],
                            ['name' => 'layout_portfolio', 'operator' => 'in', 'value' => ['portfolio-2']]
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_excerpt',
            'label' => esc_html__('Show Excerpt', 'icoland' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'num_words',
            'label' => esc_html__('Number of Words', 'icoland' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 25,
            'separator' => 'after',
        ),
        array(
            'name' => 'show_button',
            'label' => esc_html__('Show Button Readmore', 'icoland' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-3']]
                        ]
                    ],

                ],
            ]
        ),
        array(
            'name' => 'button_text',
            'label' => esc_html__('Button Readmore Text', 'icoland' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-3']],
                            ['name' => 'show_button', 'operator' => '==', 'value' => 'true'],
                        ]
                    ],
                ],
            ]
        ),
                        // array(
                        //     'name'     => 'title_line_break',
                        //     'label'    => esc_html__( 'Title Line Break', 'icoland' ),
                        //     'type' => \Elementor\Controls_Manager::SWITCHER,
                        //     'default'  => 'false',
                        //     'conditions' => [
                        //         'relation' => 'or',
                        //         'terms' => [
                        //             [
                        //                 'terms' => [
                        //                     ['name' => 'post_type', 'operator' => '==', 'value' => 'service'],
                        //                     ['name' => 'layout_service', 'operator' => 'in', 'value' => ['service-3']]
                        //                 ]
                        //             ]
                        //         ],
                        //     ]
                        // ),
                        // array(
                        //     'name' => 'offset_left',
                        //     'label' => esc_html__('Offset Left', 'icoland' ),
                        //     'type' => \Elementor\Controls_Manager::SLIDER,
                        //     'control_type' => 'responsive',
                        //     'size_units' => [ 'px' ],
                        //     'range' => [
                        //         'px' => [
                        //             'min' => 0,
                        //             'max' => 3000,
                        //         ],
                        //     ],
                        //     'selectors' => [
                        //         '{{WRAPPER}} .pxl-swiper-sliders .pxl-swiper-container' => 'margin-left: -{{SIZE}}{{UNIT}};',
                        //     ],
                        // ),
                        // array(
                        //     'name' => 'offset_right',
                        //     'label' => esc_html__('Offset Right', 'icoland' ),
                        //     'type' => \Elementor\Controls_Manager::SLIDER,
                        //     'control_type' => 'responsive',
                        //     'size_units' => [ 'px' ],
                        //     'range' => [
                        //         'px' => [
                        //             'min' => 0,
                        //             'max' => 3000,
                        //         ],
                        //     ],
                        //     'selectors' => [
                        //         '{{WRAPPER}} .pxl-swiper-sliders .pxl-swiper-container' => 'margin-right: -{{SIZE}}{{UNIT}};',
                        //     ],
                        // ),
    ),
),
),
),
),
icoland_get_class_widget_path()
);