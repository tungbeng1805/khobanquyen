<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_images_slip',
        'title' => esc_html__( 'BR Images Slip', 'maiko' ),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'maiko-tabs'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'image_content',
                    'label' => esc_html__( 'Images', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'images',
                            'label' => esc_html__('List', 'maiko'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                            ),
                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                        ),
                        array(
                            'name' => 'gap_height',
                            'label' => esc_html__('Space Image', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                             '{{WRAPPER}} .pxl-images-slip .pxl-images--content' => 'gap: {{SIZE}}{{UNIT}};',
                         ],
                     ),
                        array(
                            'name' => 'img_height',
                            'label' => esc_html__('Max Height Imgage', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                             '{{WRAPPER}} .pxl-images-slip .pxl-item--image' => 'max-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                         ],
                     ),
                    ),
                ),
            ),
        ),
    ),maiko_get_class_widget_path()
);