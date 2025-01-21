<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_navigation',
        'title' => esc_html__('BR Post Navigation', 'maiko' ),
        'icon' => 'eicon-navigation-horizontal',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array (
                            'name' => 'type',
                            'label' => esc_html__('Type', 'maiko'),
                            'type' => Elementor\Controls_Manager::SELECT,
                            'default' => 'pagination',
                            'options' => [
                                'navigation' => esc_html__('Navigation', 'maiko'),
                            ]
                        ),
                        array(
                            'name' => 'show_share',
                            'label' => esc_html__('Show Share', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_grid',
                            'label' => esc_html__('Show Grid', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'link_grid_page',
                            'label' => esc_html__('Link Gird Page', 'graviton' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('#', 'graviton'),
                            'condition' => [
                                'show_grid' => 'true',
                            ]
                        ),
                    ),
                ),
            ),
        ),
    ),
    maiko_get_class_widget_path()
)
?>