<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/admin/libs/tgmpa/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'maiko_register_required_plugins' );
function maiko_register_required_plugins() {
    include( locate_template( 'inc/admin/demo-data/demo-config.php' ) );
    $pxl_server_info = apply_filters( 'pxl_server_info', ['plugin_url' => 'https://api.bravisthemes.com/plugins/'] ) ; 
    $default_path = $pxl_server_info['plugin_url'];  
    $images = get_template_directory_uri() . '/inc/admin/assets/img/plugins'; 
    $plugins = array(

        array(
            'name'               => esc_html__('Redux Framework', 'maiko'),
            'slug'               => 'redux-framework',
            'required'           => true,
            'logo'        => $images . '/redux.png',
            'description' => esc_html__( 'Build theme options and post, page options for WordPress Theme.', 'maiko' ),
        ),

        array(
            'name'               => esc_html__('Elementor', 'maiko'),
            'slug'               => 'elementor',
            'required'           => true,
            'logo'        => $images . '/elementor.png',
            'description' => esc_html__( 'Introducing a WordPress website builder, with no limits of design. A website builder that delivers high-end page designs and advanced capabilities', 'maiko' ),
        ),  

        array(
            'name'               => esc_html__('Bravis Addons', 'maiko'),
            'slug'               => 'bravis-addons',
            'source'             => 'bravis-addons.zip',
            'required'           => true,
            'logo'        => $images . '/bravis-logo.png',
            'description' => esc_html__( 'Main process and Powerful Elements Plugin, exclusively for Farmas WordPress Theme.', 'maiko' ),
        ),
        array(
            'name'               => esc_html__('Contact Form 7', 'maiko'),
            'slug'               => 'contact-form-7',
            'required'           => true,
            'logo'        => $images . '/contact-f7.png',
            'description' => esc_html__( 'Contact Form 7 can manage multiple contact forms, you can customize the form and the mail contents flexibly with simple markup', 'maiko' ),
        ),

        array(
            'name'               => esc_html__('Contact Form 7 Multi Step', 'maiko'),
            'slug'               => 'cf7-multi-step',
            'required'           => true,
            'logo'        => $images . '/contact-f7-mt.png',
            'description' => esc_html__( 'Addons Multi Step For CTF7', 'maiko' ),
        ),
        
        array(
            'name'               => esc_html__('Revolution Slider', 'maiko'),
            'slug'               => 'revslider',
            'source'             => 'revslider.zip',
            'required'           => false,
            'logo'        => $images . '/rev-slider.png',
            'description' => esc_html__( 'Revolution Slider helps beginner-and mid-level designers WOW their clients with pro-level visuals.', 'maiko' )
        ),
        // array(
        //     'name'               => esc_html__('Bravis Theme User', 'maiko'),
        //     'slug'               => 'bravis-theme-user',
        //     'source'             => 'bravis-theme-user.zip',
        //     'required'           => true,
        //     'logo'        => $images . '/wp-user.png',
        //     'description' => esc_html__( 'Bravis Theme User can help you login and log out of account management in the fastest and simplest way.', 'maiko' ),
        //  ),
        array(
            'name'               => esc_html__('Addons Contact Form 7', 'maiko'),
            'slug'               => 'ultimate-addons-for-contact-form-7',
            'source'             => 'ultimate-addons-for-contact-form-7.zip',
            'required'           => false,
            'logo'        => $images . '/addons-ctf7.png',
            'description' => esc_html__( 'Support CTF7', 'maiko' )
        ), 
        array(
            'name'               => esc_html__('WooCommerce', 'maiko'),
            'slug'               => "woocommerce",
            'required'           => true,
            'logo'        => $images . '/woo.png',
            'description' => esc_html__( 'WooCommerce is the world’s most popular open-source eCommerce solution.', 'maiko' ),
        ),

        array(
            'name'               => esc_html__('Compare', 'maiko'),
            'slug'               => "woo-smart-compare",
            'required'           => false, 
            'logo'        => $images . '/woo-smart-compare.png',
            'description' => esc_html__( 'WPC Smart Compare allows users to get a quick look of products without opening the product page.', 'maiko' ),
        ),
        array(
            'name'               => esc_html__('Wishlist', 'maiko'),
            'slug'               => "woo-smart-wishlist",
            'required'           => false,
            'logo'        => $images . '/woo-smart-wishlist.png',
            'description' => esc_html__( 'WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buying later.', 'maiko' ),
        ),
    );
    $config = array(
        'default_path' => $default_path,           // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'is_automatic' => true,
    );

    tgmpa( $plugins, $config );
}