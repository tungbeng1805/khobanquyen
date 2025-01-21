<?php
// Register User Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_user',
        'title' => esc_html__('TN User', 'icoland' ),
        'icon' => 'eicon-user',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'icoland' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'box_color',
                            'label' => esc_html__('Background Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon--users' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title Box', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon--users .pxl-user-heading' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Background Button Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon--users  button' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon--users  .btn' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Input Border Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon--users .fields-content .field-group input' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_to_color',
                            'label' => esc_html__('Link Color', 'icoland' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .btn-sign-up  span' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                                'name' => 'link_typography',
                                'label' => esc_html__('Link Typography', 'icoland' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .btn-sign-up  span:nth-child(1)',
                            ),
                    ),
                ),
            ),
        ),
    ),
    icoland_get_class_widget_path()
);