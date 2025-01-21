<?php
$templates = medicross_get_templates_option('tab', []) ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_tabs_slip',
        'title' => esc_html__( 'BR Tabs Slip', 'medicross' ),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'medicross-tabs'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'medicross' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'medicross' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'medicross' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_tabs_slip/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Tabs', 'medicross' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Content', 'medicross' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'content_template',
                                    'label' => esc_html__('Select Templates', 'medicross'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df',
                                    'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>"',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),medicross_get_class_widget_path()
);