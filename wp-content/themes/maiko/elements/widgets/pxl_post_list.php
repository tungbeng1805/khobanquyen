<?php
$pt_supports = ['post','service','portfolio'];
use Elementor\Controls_Manager;
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_post_list',
        'title'      => esc_html__('BR Post List', 'maiko' ),
        'icon'       => 'eicon-post-list',
        'categories' => array('pxltheme-core'),
        'scripts'    => [
            'pxl-post-grid',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'maiko' ),
                    'tab'      => 'layout',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'maiko' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => maiko_get_post_type_options($pt_supports),
                                'default'  => 'post'
                            )
                        ),
                        maiko_get_post_list_layout($pt_supports)
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'select_post_by',
                                'label'    => esc_html__( 'Select posts by', 'maiko' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => [
                                    'term_selected' => esc_html__( 'Terms selected', 'maiko' ),
                                    'post_selected' => esc_html__( 'Posts selected ', 'maiko' ),
                                ],
                                'default'  => 'term_selected'
                            ) 
                        ),
                        maiko_get_term_by_posttype($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        maiko_get_ids_by_posttype($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                        maiko_get_ids_unselected_by_posttype($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        array(
                            array(
                                'name'    => 'orderby',
                                'label'   => esc_html__('Order By', 'maiko' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'date',
                                'options' => [
                                    'date'   => esc_html__('Date', 'maiko' ),
                                    'ID'     => esc_html__('ID', 'maiko' ),
                                    'author' => esc_html__('Author', 'maiko' ),
                                    'title'  => esc_html__('Title', 'maiko' ),
                                    'rand'   => esc_html__('Random', 'maiko' ),
                                ],
                            ),
                            array(
                                'name'    => 'order',
                                'label'   => esc_html__('Sort Order', 'maiko' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'desc',
                                'options' => [
                                    'desc' => esc_html__('Descending', 'maiko' ),
                                    'asc'  => esc_html__('Ascending', 'maiko' ),
                                ],
                            ),
                            array(
                                'name'    => 'limit',
                                'label'   => esc_html__('Total items', 'maiko' ),
                                'type'    => \Elementor\Controls_Manager::NUMBER,
                                'default' => '6',
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'general_section',
                    'label' => esc_html__('General Settings', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'active',
                                'label' => esc_html__('Active', 'maiko' ),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'separator' => 'after',
                                'default' => '1',
                                'condition' => ['post_type' => 'service','layout_service' => 'service-list-2' ],
                            ),
                            array(
                                'name'    => 'show_toolbar',
                                'label'   => esc_html__('Show Toolbar', 'maiko' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'hide',
                                'options' => [
                                    'show' => esc_html__('Show', 'maiko' ),
                                    'hide'   => esc_html__('Hide', 'maiko' )
                                ],
                            ),
                            array(
                                'name' => 'scroll_effect',
                                'label' => esc_html__('Scroll Effects', 'maiko' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'none' => 'None',
                                    'blinds_staggered' => 'Blinds Staggered',
                                    'zoom_in' => 'Zoom In',
                                ],
                                'default' => 'none',
                            ),
                            array(
                                'name'        => 'img_size',
                                'label'       => esc_html__('Image Size', 'maiko' ),
                                'type'        => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: full).', 'maiko')
                            ),
                            array(
                                'name'    => 'pagination_type',
                                'label'   => esc_html__('Pagination Type', 'maiko' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'pagination' => esc_html__('Pagination', 'maiko' ),
                                    'loadmore'   => esc_html__('Loadmore', 'maiko' ),
                                    'false'      => esc_html__('Disable', 'maiko' ),
                                ],
                            ),
                            array(
                                'name'      => 'loadmore_text',
                                'label'     => esc_html__( 'Load More text', 'maiko' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('Load More','maiko'),
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name'         => 'pagination_alignment',
                                'label'        => esc_html__( 'Pagination Alignment', 'maiko' ),
                                'type'         => 'choose',
                                'control_type' => 'responsive',
                                'options' => [
                                    'start' => [
                                        'title' => esc_html__( 'Start', 'maiko' ),
                                        'icon'  => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'maiko' ),
                                        'icon'  => 'eicon-text-align-center',
                                    ],
                                    'end' => [
                                        'title' => esc_html__( 'End', 'maiko' ),
                                        'icon'  => 'eicon-text-align-right',
                                    ]
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-pagination, {{WRAPPER}} .pxl-load-more' => 'justify-content: {{VALUE}};'
                                ],
                                'default'      => 'start',
                                'condition' => [
                                    'pagination_type' => ['pagination', 'loadmore'],
                                ],
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
                                'name' => 'col_md',
                                'label' => esc_html__('Columns MD Devices', 'maiko' ),
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
                                'name' => 'col_lg',
                                'label' => esc_html__('Columns LG Devices', 'maiko' ),
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
                                'name' => 'col_xl',
                                'label' => esc_html__('Columns XL Devices', 'maiko' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '2',
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
                                'name' => 'item_spacer',
                                'label' => esc_html__('Item Spacer', 'maiko' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'description' => 'Default: 15',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid .pxl-grid-item' => 'padding:{{SIZE}}px;',
                                    '{{WRAPPER}} .pxl-grid .pxl-post--inner' => 'margin-bottom:0px;',
                                    '{{WRAPPER}} .pxl-grid .pxl-grid-masonry' => 'margin-left: -{{SIZE}}px;margin-right: -{{SIZE}}px;',
                                ],
                            ),
                        ),
)
),
array(
    'name' => 'display_post_section',
    'label' => esc_html__('Display Options', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    'controls' => array(
        array(
            'name'      => 'post_number',
            'label'     => esc_html__('Show Number', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
            'condition' => ['post_type' => 'service','layout_post' => 'service-list-1' ],
        ),
        array(
            'name'      => 'post_date',
            'label'     => esc_html__('Show Date', 'maiko' ),
            'condition' => ['post_type' => 'post','layout_post' => 'post-list-1' ],
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
        ),
        array(
            'name'      => 'post_author',
            'label'     => esc_html__('Show Author', 'maiko' ),
            'condition' => ['post_type' => 'post','layout_post' => 'post-list-1' ],
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
        ),
        array(
            'name'      => 'post_category',
            'label'     => esc_html__('Show Category', 'maiko' ),
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-list-1']]
                        ]
                    ],
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'portfolio'],
                            ['name' => 'layout_portfolio', 'operator' => 'in', 'value' => ['portfolio-list-1']]
                        ]
                    ]
                ],
            ],
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'false',
        ),
        array(
            'name'      => 'post_comment',
            'label'     => esc_html__('Show Comment', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
            'condition' => ['post_type' => 'post','layout_post' => 'post-list-1' ],
        ),
        array(
            'name'      => 'post_excerpt',
            'label'     => esc_html__('Show Excerpt', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
        ),
        array(
            'name'      => 'post_num_words',
            'label'     => esc_html__('Number of Words', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'condition' => [
                'post_excerpt' => 'true',
            ],
        ),
        array(
            'name'      => 'post_readmore',
            'label'     => esc_html__('Show Readmore', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
        ),
        array(
            'name'      => 'post_readmore_text',
            'label'     => esc_html__('Button Text', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'post_readmore' => 'true',
            ],
        ),
        array(
            'name'      => 'post_share',
            'label'     => esc_html__('Show Social Share', 'maiko' ),
            'type'      => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
            'condition' => ['post_type' => 'post','layout_post' => 'post-list-1' ],
        ),
    ),
),

),
),
),
maiko_get_class_widget_path()
);