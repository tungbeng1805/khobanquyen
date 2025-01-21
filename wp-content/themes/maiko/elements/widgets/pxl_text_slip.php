<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_slip',
        'title' => esc_html__( 'BR Text Slip', 'maiko' ),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'maiko-tabs'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'text_content',
                    'label' => esc_html__( 'Text', 'maiko' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'texts',
                            'label' => esc_html__('List', 'maiko'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            
                            'controls' => array(
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'maiko' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),maiko_get_class_widget_path()
);