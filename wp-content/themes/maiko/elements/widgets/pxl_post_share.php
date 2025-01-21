<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_share',
        'title' => esc_html__('BR Post Share', 'maiko' ),
        'icon' => 'eicon-navigation-horizontal',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'show_share',
                            'label' => esc_html__('Show Share', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                    ),
                ),
            ),
        ),
    ),
    maiko_get_class_widget_path()
)
?>