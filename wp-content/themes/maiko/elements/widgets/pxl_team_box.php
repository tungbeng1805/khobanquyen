<?php
// Register Team Box Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_team_box',
        'title' => esc_html__('BR Team Box', 'maiko' ),
        'icon' => 'eicon-user-preferences',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Name', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'pos',
                            'label' => esc_html__('Position', 'maiko'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'image_sig',
                            'label' => esc_html__('Image Signature', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                    ),
                ),
                maiko_widget_animation_settings(),
            ),
        ),
    ),
    maiko_get_class_widget_path()
);