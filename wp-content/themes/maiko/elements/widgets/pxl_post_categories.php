<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_categories',
        'title' => esc_html__('BR Portfolio Categories', 'maiko' ),
        'icon' => 'eicon-taxonomy-filter',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_source',
                    'label' => esc_html__('Source', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'categories_color',
                            'label' => esc_html__('Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-portfolio-categories li' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'categories_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-portfolio-categories li',
                        ),
                    ),
                ),
                maiko_widget_animation_settings()
            ),
        ),
    ),
    maiko_get_class_widget_path()
);