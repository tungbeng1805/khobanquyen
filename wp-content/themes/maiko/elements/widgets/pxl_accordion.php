<?php
$templates_df = ['0' => esc_html__('None', 'maiko')];
$templates = $templates_df + maiko_get_templates_option('tab') ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_accordion',
        'title' => esc_html__('BR Accordion', 'maiko' ),
        'icon' => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'maiko-accordion'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                                'style4' => 'Style 4',
                                'style5' => 'Style 5',
                                'style6' => 'Style 6',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'active',
                            'label' => esc_html__('Active', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                            'default' => '1',
                        ),
                        array(
                            'name' => 'accordion',
                            'label' => esc_html__('Accordion', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'style!' => ['style2'],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXT, 
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Content', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                ),
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description' => 'Apply For Style 5',
                                ),
                                array(
                                    'name' => 'pxl_icon',
                                    'label' => esc_html__('Icon', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                ),
                                array(
                                    'name' => 'social',
                                    'label' => esc_html__( 'Feature', 'kimono' ),
                                    'type' => 'pxl_links',
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'accordion2',
                            'label' => esc_html__('Accordion', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'style' => ['style2'],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'title2',
                                    'label' => esc_html__('Title', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXT, 
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'popup_template',
                                    'label' => esc_html__('Select Popup Template', 'maiko'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df',
                                    'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>"',
                                ),
                            ),
                            'title_field' => '{{{ title2 }}}',
                            'separator' => 'after',
                        ),
                    ),
),
array(
    'name' => 'section_style_general',
    'label' => esc_html__('General', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'item_space',
            'label' => esc_html__('Item Space Bottom', 'maiko' ),
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
                '{{WRAPPER}} .pxl-accordion1 .pxl--item' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'item_space_top',
            'label' => esc_html__('Item Space Top', 'maiko' ),
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
                '{{WRAPPER}} .pxl-accordion1 .pxl--item + .pxl--item' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'color_i',
            'label' => esc_html__('Color Icon', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}  .pxl-icon--plus:before,{{WRAPPER}}  .pxl-icon--plus:after' => 'background-color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'color_i_bg',
            'label' => esc_html__('Background icon', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}  .pxl-icon--plus' => 'background-color: {{value}} !important;',
            ],
        ),
        array(
            'name' => 'color_bd',
            'label' => esc_html__('Color Border', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl--item, {{WRAPPER}} .pxl--item .pxl-accordion--content' => 'border-color: {{VALUE}} !important;',
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
            'name' => 'title_color',
            'label' => esc_html__('Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-accordion .pxl-accordion--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'maiko' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-accordion .pxl-accordion--title',
        ),
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
            'default' => 'h5',
        ),
    ),
),
array(
    'name' => 'section_style_content',
    'label' => esc_html__('Content', 'maiko' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'content_color',
            'label' => esc_html__('Color', 'maiko' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-accordion .pxl-accordion--content' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'desc_typography',
            'label' => esc_html__('Typography', 'maiko' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-accordion .pxl-accordion--content',
        ),
        array(
            'name' => 'ct_space_top',
            'label' => esc_html__('Space Top', 'maiko' ),
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
                '{{WRAPPER}} .pxl-accordion .pxl-accordion--content' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'ct_space_bottom',
            'label' => esc_html__('Space Bottom', 'maiko' ),
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
                '{{WRAPPER}} .pxl-accordion .pxl-accordion--content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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