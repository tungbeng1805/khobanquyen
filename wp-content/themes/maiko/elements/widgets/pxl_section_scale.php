<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_section_scale',
        'title' => esc_html__('BR Section Scale', 'maiko' ),
        'icon' => 'eicon-animation',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'bg_type',
                            'label' => esc_html__('Background Type', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'img' => 'Image',
                                'video' => 'Video',
                                'video_button' => 'Video Button',
                                'f_img' => 'Featured Image',
                            ],
                            'default' => 'img',
                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                            'condition' => [
                                'bg_type' => ['f_img'],
                            ],
                        ),
                        array(
                            'name' => 'image_height',
                            'label' => esc_html__('Image Height', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'maiko' ),
                            'condition' => [
                                'bg_type' => ['f_img','video_button'],
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale' => 'height: {{SIZE}}{{UNIT}};min-height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_img',
                            'label' => esc_html__('Background Image', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'bg_type' => ['img','video_button'],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .pxl-sticky-parallax' => 'background-image: url( {{URL}} );',
                            ],  
                        ),
                        array(
                            'name' => 'bg_img_position',
                            'label' => esc_html__( 'Background Image Position', 'maiko' ),
                            'type'         => \Elementor\Controls_Manager::SELECT,
                            'options'      => array(
                                ''              => esc_html__( 'Default', 'maiko' ),
                                'center center' => esc_html__( 'Center Center', 'maiko' ),
                                'center left'   => esc_html__( 'Center Left', 'maiko' ),
                                'center right'  => esc_html__( 'Center Right', 'maiko' ),
                                'top center'    => esc_html__( 'Top Center', 'maiko' ),
                                'top left'      => esc_html__( 'Top Left', 'maiko' ),
                                'top right'     => esc_html__( 'Top Right', 'maiko' ),
                                'bottom center' => esc_html__( 'Bottom Center', 'maiko' ),
                                'bottom left'   => esc_html__( 'Bottom Left', 'maiko' ),
                                'bottom right'  => esc_html__( 'Bottom Right', 'maiko' ),
                                'initial'       =>  esc_html__( 'Custom', 'maiko' ),
                            ),
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .pxl-sticky-parallax' => 'background-position: {{VALUE}};',
                            ],
                            'condition' => [
                                'bg_type' => ['img','video_button'],
                                'bg_img[url]!' => '',
                            ]        
                        ),
                        array(
                            'name' => 'bg_img_size',
                            'label' => esc_html__( 'Background Image Size', 'maiko' ),
                            'type'         => \Elementor\Controls_Manager::SELECT,
                            'hide_in_inner' => true,
                            'options'      => array(
                                ''              => esc_html__( 'Default', 'maiko' ),
                                'auto' => esc_html__( 'Auto', 'maiko' ),
                                'cover'   => esc_html__( 'Cover', 'maiko' ),
                                'contain'  => esc_html__( 'Contain', 'maiko' ),
                            ),
                            'default'      => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .pxl-sticky-parallax' => 'background-size: {{VALUE}};',
                            ],
                            'condition' => [
                                'bg_type' => ['img','video_button'],
                                'bg_img[url]!' => '',
                            ]       
                        ),
                        array(
                            'name' => 'button_height',
                            'label' => esc_html__('Button Height', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'maiko' ),
                            'condition' => [
                                'bg_type' => ['f_img','video_button'],
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .btn-balloon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Button Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'bg_type' => ['f_img','video_button'],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .btn-balloon' => 'border-color: {{VALUE}};color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-section-scale .btn-balloon .span-balloon' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_color_hover',
                            'label' => esc_html__('Button Color Hover', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'bg_type' => ['f_img','video_button'],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .btn-balloon:hover' => 'color: {{VALUE}};color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_video',
                            'label' => esc_html__('Video Link', 'maiko'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'bg_type' => ['video','video_button'],
                            ],
                            'description' => 'Video file (mp4 is recommended).'
                        ),
                        array(
                            'name' => 'overlay_color',
                            'label' => esc_html__('Overlay Color', 'maiko' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-section-scale .pxl-section-overlay' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
),
),
),
),
maiko_get_class_widget_path()
);