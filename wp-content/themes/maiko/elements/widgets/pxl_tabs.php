<?php
$templates = maiko_get_templates_option('tab', []) ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_tabs',
        'title' => esc_html__( 'BR Tabs', 'maiko' ),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'maiko-tabs'
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'maiko' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs/layout-image/layout6.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Tabs', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'subtitle_box',
                            'label' => esc_html__(' Sub Title Box', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Text', 'maiko'),
                            'condition' => ['layout' => '5'], 
                        ),
                        array(
                            'name' => 'title_box',
                            'label' => esc_html__('Title Box', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => esc_html__('Text', 'maiko'),
                            'condition' => ['layout' => '5'], 
                        ),
                        array(
                            'name' => 'desc_box',
                            'label' => esc_html__('Description Box', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => esc_html__('Text', 'maiko'),
                            'condition' => ['layout' => '5'],
                        ),
                        array(
                            'name' => 'tab_active',
                            'label' => esc_html__( 'Active Tab', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'title_button_color',
                            'label' => esc_html__( 'Color Button Title', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_button_color_at',
                            'label' => esc_html__( 'Color Button Title Active', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title.active' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Content', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__( 'Title', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__('Content Type', 'maiko'),
                                    'type' => 'select',
                                    'options' => [
                                        'df' => esc_html__( 'Default', 'maiko' ),
                                        'template' => esc_html__( 'From Template Builder', 'maiko' )
                                    ],
                                    'default' => 'df' 
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__( 'Content', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'condition' => ['content_type' => 'df'] 
                                ),
                                array(
                                    'name' => 'content_template',
                                    'label' => esc_html__('Select Templates', 'maiko'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df',
                                    'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>"',
                                    'condition' => ['content_type' => 'template'] 
                                ),
                                array(
                                    'name' => 'pxl_icon',
                                    'label' => esc_html__('Icon', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'condition' => ['content_type' => 'template'] 
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
),
array(
    'name' => 'section_subtitle_b',
    'label' => esc_html__('SubTitle Box', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => ['layout' => '5'], 
    'controls' => array_merge(
        array(
            array(
                'name' => 'subtitle_color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .subtitle-box' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'subtitle_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .subtitle-box',
            ),
        )
    ),
),
array(
    'name' => 'section_title_b',
    'label' => esc_html__('Title Box', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => ['layout' => '5'], 
    'controls' => array_merge(
        array(
            array(
                'name' => 'title_b_color',
                'label' => esc_html__(' Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .title-box' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'titleb_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .title-box',
            ),
        )
    ),
),
array(
    'name' => 'section_style_desc_bpx',
    'label' => esc_html__('Description Box', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => ['layout' => '5'], 
    'controls' => array_merge(
        array(
            array(
                'name' => 'des_color',
                'label' => esc_html__('Color', 'maiko' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .desc-box' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'des_typography',
                'label' => esc_html__('Typography', 'maiko' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-tabs5 .wrap-content-title .desc-box',
            ),
        )
    ),
),
array(
    'name' => 'tab_style',
    'label' => esc_html__( 'Style', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'style',
            'label' => esc_html__('Style', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style-default' => 'Default',
                'style-2' => 'Style 2',
            ],
            'default' => 'style-default',
        ),
        array(
            'name' => 'right_space',
            'label' => esc_html__('Space Right Content', 'maiko' ),
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
                '{{WRAPPER}} .pxl-tabs--content ' => 'right: {{SIZE}}{{UNIT}} ;',
            ],
        ),
        array(
            'name' => 'top_space',
            'label' => esc_html__('Space Top Content', 'maiko' ),
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
                '{{WRAPPER}} .pxl-tabs--content ' => 'top: {{SIZE}}{{UNIT}} ;',
            ],
        ),
        array(
            'name' => 'tab_effect',
            'label' => esc_html__('Effect', 'maiko' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'tab-effect-slide' => 'Slide',
                'tab-effect-fade' => 'Fade',
            ],
            'default' => 'tab-effect-slide',
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Title Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_active_color',
            'label' => esc_html__('Title Active Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title.active' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_box_color_w',
            'label' => esc_html__('Title Box Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-tabs--title' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'btn_color',
            'label' => esc_html__('Background Button Color Active', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title.active' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'maiko' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-tabs .pxl-tabs--title > .pxl-item--title',
            'separator' => 'after',
        ),
        array(
            'name' => 'content_color',
            'label' => esc_html__('Content Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-item--content' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'content_typography',
            'label' => esc_html__('Content Typography', 'maiko' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-tabs .pxl-item--content',
        ),
    ),
),
maiko_widget_animation_settings(),
),
),
),
maiko_get_class_widget_path()
);