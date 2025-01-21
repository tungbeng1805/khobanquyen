<?php
// Register Icon Box Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_team_single',
        'title' => esc_html__('tn team single', 'icoland' ),
        'icon' => 'eicon-icon-box',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
                    'label' => esc_html__('layout', 'icoland' ),
                    'tab' => \elementor\controls_manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('templates', 'icoland' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('layout 1', 'icoland' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_team_single/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('content', 'icoland' ),
                    'tab' => \elementor\controls_manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Position', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'name',
                            'label' => esc_html__('Name', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'position',
                            'label' => esc_html__('Position', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'icoland'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                        ),
                        array(
                            'name' => 'item_link',
                            'label' => esc_html__('Link', 'icoland' ),
                            'type' => \elementor\controls_manager::URL,
                        ),
                        array(
                            'name' => 'social',
                            'label' => esc_html__( 'Social', 'icoland' ),
                            'type' => 'pxl_icons',
                        ),
                    ),
                ),
            icoland_widget_animation_settings(),
            ),
        ),
    ),
icoland_get_class_widget_path()
);
