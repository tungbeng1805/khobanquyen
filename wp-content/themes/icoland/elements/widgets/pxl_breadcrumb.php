<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_breadcrumb',
        'title' => esc_html__('TN Breadcrumb', 'icoland' ),
        'icon' => 'eicon-yoast',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Text Typography', 'icoland' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-breadcrumb',
                        ),
                        array(
                            'name' => 'arrow_color',
                            'label' => esc_html__('Arrow Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb li::after' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                            ],
                        ),
                        array(
                            'name' => 'active_text_color',
                            'label' => esc_html__('Active Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb li:last-child' => 'color: {{VALUE}}  !important;',
                            ],
                        ),
                    ),
                ),
                icoland_widget_animation_settings(),
            ),
        ),
    ),
    icoland_get_class_widget_path()
);