<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}

$opt_name = icoland()->get_option_name();
$version = icoland()->get_version();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => '', //$theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $version,
    // Version that appears at the top of your panel
    'menu_type'            => 'submenu', //class_exists('Pxltheme_Core') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'icoland'),
    'page_title'           => esc_html__('Theme Options', 'icoland'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => 80,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'pxlart', //class_exists('icoland_Admin_Page') ? 'case' : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'pxlart-theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'icoland'),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'icoland'),
            'default'  => '',
            'url'      => false
        ),
        array(
            'id'       => 'mouse_move_animation',
            'type'     => 'switch',
            'title'    => esc_html__('Mouse Move Animation', 'icoland'),
            'default'  => false
        ),
        array(
            'id'       => 'site_loader',
            'type'     => 'switch',
            'title'    => esc_html__('Loader', 'icoland'),
            'default'  => false
        ),
        array(
            'id'    => 'loader_style',
            'type'  => 'select',
            'title' => esc_html__('Loader Style', 'icoland'),
            'options' => [
                'loader-1'           => esc_html__('Style 1', 'icoland'),
                'loader-2'           => esc_html__('Style 2', 'icoland'),
                'loader-3'           => esc_html__('Style 3', 'icoland'),
                'loader-4'           => esc_html__('Style 4', 'icoland'),
                'loader-5'           => esc_html__('Style 5', 'icoland'),
                'default'           => esc_html__('Style 6', 'icoland'),
            ],
            'default' => 'loader-1',
            'indent' => true,
            'required' => array( 0 => 'site_loader', 1 => 'equals', 2 => true ),
        ),
    )
));

/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'icoland'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'       => 'content_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color', 'icoland'),
            'subtitle' => esc_html__('Content background color.', 'icoland'),
            'output'   => array('background-color' => 'footer','background-color' => '#pxl-main')
        ),
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'icoland'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'secondary_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'icoland'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'regular_color',
            'type'        => 'color',
            'title'       => esc_html__('Regular Color', 'icoland'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'fourth_color',
            'type'        => 'color',
            'title'       => esc_html__('Fourth Color', 'icoland'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'fifth_color',
            'type'        => 'color',
            'title'       => esc_html__('Fifrth Color', 'icoland'),
            'transparent' => false,
            'default'     => ''
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'icoland'),
    'icon'   => 'el el-indent-left',
    'fields' => array_merge(
        icoland_header_opts(),
        array(
            array(
                'id'       => 'sticky_scroll',
                'type'     => 'button_set',
                'title'    => esc_html__('Sticky Scroll', 'icoland'),
                'options'  => array(
                    'pxl-sticky-stt' => esc_html__('Scroll To Top', 'icoland'),
                    'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'icoland'),
                ),
                'default'  => 'pxl-sticky-stb',
            ),
        )
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Mobile', 'icoland'),
    'icon'       => 'el el-picture',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'logo_m',
            'type'     => 'media',
            'title'    => esc_html__('Select Logo', 'icoland'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/img/logo.png'
            ),
            'url'      => false
        ),
        array(
            'id'       => 'logo_height',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Height', 'icoland'),
            'width'    => false,
            'unit'     => 'px',
            'output'    => array('#pxl-header-default .pxl-header-branding img, .pxl-logo-mobile img'),
        ),
        array(
            'id'       => 'search_mobile',
            'type'     => 'switch',
            'title'    => esc_html__('Search Form', 'icoland'),
            'default'  => true
        )
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'icoland'),
    'icon'   => 'el-icon-map-marker',
    'fields' => array_merge(
        icoland_page_title_opts() 
    )
));


/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Footer', 'icoland'),
    'icon'   => 'el el-website',
    'fields' => array_merge(
        icoland_footer_opts(),
        array(
            array(
                'id'       => 'back_totop_on',
                'type'     => 'switch',
                'title'    => esc_html__('Button Back to Top', 'icoland'),
                'default'  => false,
            ),
            array(
                'id'       => 'footer_fixed',
                'type'     => 'switch',
                'title'    => esc_html__('Footer Fixed', 'icoland'),
                'default'  => false,
            )
        ) 
    )
    
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog Archive', 'icoland'),
    'icon'  => 'el-icon-pencil',
    'fields'     => array_merge(
        icoland_sidebar_pos_opts([ 'prefix' => 'blog_']),
        array(
            array(
                'id'      => 'archive_excerpt_length',
                'type'    => 'text',
                'title'   => esc_html__('Excerpt Length', 'icoland'),
                'default' => '',
                'subtitle' => esc_html__('Default: 50', 'icoland'),
            ),
        )
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'icoland'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array_merge(
        icoland_sidebar_pos_opts([ 'prefix' => 'post_']),
        array(
            array(
                'id'       => 'post_date',
                'title'    => esc_html__('Date', 'icoland'),
                'subtitle' => esc_html__('Display the Date for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'post_author',
                'title'    => esc_html__('Author', 'icoland'),
                'subtitle' => esc_html__('Display the Author for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'post_category',
                'title'    => esc_html__('Categories', 'icoland'),
                'subtitle' => esc_html__('Display the Category for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'post_tag',
                'title'    => esc_html__('Tags', 'icoland'),
                'subtitle' => esc_html__('Display the Tag for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'post_navigation',
                'title'    => esc_html__('Navigation', 'icoland'),
                'subtitle' => esc_html__('Display the Navigation for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'post_related',
                'title'    => esc_html__('Related Post', 'icoland'),
                'subtitle' => esc_html__('Display the Navigation for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'title' => esc_html__('Social', 'icoland'),
                'type'  => 'section',
                'id' => 'social_section',
                'indent' => false,
            ),
            array(
                'id'       => 'post_social_share',
                'title'    => esc_html__('Social', 'icoland'),
                'subtitle' => esc_html__('Display the Social Share for blog post.', 'icoland'),
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id'       => 'social_facebook',
                'title'    => esc_html__('Facebook', 'icoland'),
                'type'     => 'switch',
                'default'  => true,
                'indent' => true,
                'required' => array( 0 => 'post_social_share', 1 => 'equals', 2 => '1' ),
            ),
            array(
                'id'       => 'social_twitter',
                'title'    => esc_html__('Twitter', 'icoland'),
                'type'     => 'switch',
                'default'  => true,
                'indent' => true,
                'required' => array( 0 => 'post_social_share', 1 => 'equals', 2 => '1' ),
            ),
            array(
                'id'       => 'social_pinterest',
                'title'    => esc_html__('Pinterest', 'icoland'),
                'type'     => 'switch',
                'default'  => true,
                'indent' => true,
                'required' => array( 0 => 'post_social_share', 1 => 'equals', 2 => '1' ),
            ),
            array(
                'id'       => 'social_linkedin',
                'title'    => esc_html__('LinkedIn', 'icoland'),
                'type'     => 'switch',
                'default'  => true,
                'indent' => true,
                'required' => array( 0 => 'post_social_share', 1 => 'equals', 2 => '1' ),
            ),
        )
    )
));

/*--------------------------------------------------------------
# Woocommerce
--------------------------------------------------------------*/
// if(class_exists('Woocommerce')) {
//     Redux::setSection($opt_name, array(
//         'title'      => esc_html__('Single Product', 'icoland'),
//         'icon'       => 'el el-shopping-cart',
//         'subsection' => true,
//         'fields'     => array_merge(
//             icoland_sidebar_pos_opts([ 'prefix' => 'product_']),
//             array(
//                 array(
//                     'id'       => 'product_related',
//                     'title'    => esc_html__('Product Related', 'icoland'),
//                     'subtitle' => esc_html__('Show/Hide related product', 'icoland'),
//                     'type'     => 'switch',
//                     'default'  => '1',
//                 ),    
//             )
//         )
//     ));
// }
/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'icoland'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'          => 'font_body',
            'type'        => 'typography',
            'title'       => esc_html__('Body', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'line-height'  => true,
            'font-size'  => true,
            'text-align'  => false,
           // 'output'      => array('body'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 1', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            //'output'      => array('h1'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 2', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            //'output'      => array('h2'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 3', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            //'output'      => array('h3'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 4', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            //'output'      => array('h4'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 5', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
           // 'output'      => array('h5'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('Heading 6', 'icoland'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
           // 'output'      => array('h6'),
            'units'       => 'px',
        ),
        array(
            'id'          => 'theme_default',
            'type'        => 'typography',
            'title'       => esc_html__('Theme Default', 'icoland'),
            'google'      => true,
            'font-backup' => false,
            'all_styles'  => false,
            'line-height'  => false,
            'font-size'  => false,
            'color'  => false,
            'font-style'  => false,
            'font-weight'  => false,
            'text-align'  => false,
            'units'       => 'px',
        ),
    )
));