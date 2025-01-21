<?php 
/**
 * Actions Hook for the theme
 *
 * @package Tnex-Themes
 */
add_action('after_setup_theme', 'icoland_setup');
function icoland_setup(){

    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'icoland_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'icoland', get_template_directory() . '/languages' );

    // Custom Header
    add_theme_support( 'custom-header' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 1170, 710 );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'icoland' ),
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'post-formats', array (
        'quote',
        'status'
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_image_size( 'icoland-thumb-small', 100, 100, true );
    add_image_size( 'icoland-thumb-xs', 120, 104, true );
    add_image_size( 'icoland-thumb-post', 740, 740, true );
    add_image_size( 'icoland-medium', 800, 289, true );
    add_image_size( 'icoland-large', 870, 315, true );
    add_image_size( 'icoland-full', 1920, 800, true );
    add_image_size( 'pxl-blog-small', 326, 422, true );

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');

}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'icoland_widgets_position' );
function icoland_widgets_position() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Single Sidebar', 'icoland' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

    if (class_exists('ReduxFramework')) {
      register_sidebar( array(
       'name'          => esc_html__( 'Page Sidebar', 'icoland' ),
       'id'            => 'sidebar-page',
       'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
       'after_widget'  => '</div></section>',
       'before_title'  => '<h2 class="widget-title"><span>',
       'after_title'   => '</span></h2>',
   ) );
  }

  if ( class_exists( 'Woocommerce' ) ) {
      register_sidebar( array(
       'name'          => esc_html__( 'Shop Sidebar', 'icoland' ),
       'id'            => 'sidebar-shop',
       'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
       'after_widget'  => '</div></section>',
       'before_title'  => '<h2 class="widget-title"><span>',
       'after_title'   => '</span></h2>',
   ) );
  }
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action( 'wp_enqueue_scripts', 'icoland_scripts' );
function icoland_scripts() {  

    /* Popup Libs */
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/libs/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_script('icoland-jarallax', get_template_directory_uri() . '/assets/js/libs/jarallax.min.js', [ 'jquery' ], '1.1.0');
    wp_enqueue_script('chart', get_template_directory_uri() . '/assets/js/libs/chart.js', [ 'jquery' ], '1.1.0');
    wp_enqueue_script('pxl-chart', get_template_directory_uri() . '/assets/js/libs/pxl-chart.js', [ 'jquery' ], '1.1.0');
    wp_enqueue_script('icoland-elementor-edit', get_template_directory_uri() . '/assets/js/libs/pxl-elementor-edit.js', [ 'jquery' ], '1.1.0');
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/bodymovin.min.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'easy-pie-chart-lib-js', get_template_directory_uri() . '/assets/js/libs/easy-pie-chart.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_style('wow-animate', get_template_directory_uri() . '/assets/css/libs/animate.min.css', array(), '1.1.0');
    wp_enqueue_script( 'wow-animate', get_template_directory_uri() . '/assets/js/libs/wow.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'favorite', get_template_directory_uri() . '/assets/js/libs/post_favorite.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'particles', get_template_directory_uri() . '/assets/js/libs/particles.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'slick-min', get_template_directory_uri() . '/assets/js/libs/slick.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'loader', get_template_directory_uri() . '/assets/js/libs/jprelaoder.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'slider', get_template_directory_uri() . '/assets/js/libs/slider.js', array( 'jquery' ), '1.0.0', true );

    /* Parallax Image */
    wp_register_script( 'tilt', get_template_directory_uri() . '/assets/js/libs/tilt.min.js', array( 'jquery' ), '1.0.0', true );

    /* Parallax Libs */
    wp_register_script( 'stellar-parallax', get_template_directory_uri() . '/assets/js/libs/stellar-parallax.min.js', array( 'jquery' ), '0.6.2', true );

    /* Icons Lib - CSS */
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css');
    wp_enqueue_style('icomoon', get_template_directory_uri() . '/assets/fonts/icomoon/css/icomoon.css');
    wp_enqueue_style('font-theme', get_template_directory_uri() . '/assets/fonts/font-theme/css/font-theme.css');
    wp_enqueue_style('elegant', get_template_directory_uri() . '/assets/fonts/elegant/css/elegant.css');
    wp_enqueue_style('et-line', get_template_directory_uri() . '/assets/fonts/et-line/css/et-line.css');

    $icoland_version = wp_get_theme( get_template() );
    wp_enqueue_style( 'pxl-caseicon', get_template_directory_uri() . '/assets/css/caseicon.css', array(), $icoland_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), $icoland_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-style', get_template_directory_uri() . '/assets/css/style.css', array(), $icoland_version->get( 'Version' ) );
    wp_add_inline_style( 'pxl-style', icoland_inline_styles() );
    wp_enqueue_style( 'pxl-base', get_template_directory_uri() . '/style.css', array(), $icoland_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-google-fonts', icoland_fonts_url(), array(), null );
    wp_enqueue_script( 'pxl-main', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), $icoland_version->get( 'Version' ), true );
    wp_localize_script( 'pxl-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    do_action( 'icoland_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'icoland_admin_style');
function icoland_admin_style() {
    $theme = wp_get_theme( get_template() );
    wp_enqueue_style( 'icoland-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), $theme->get( 'Version' ) );
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css');
    wp_enqueue_style('icomoon', get_template_directory_uri() . '/assets/fonts/icomoon/css/icomoon.css');
    wp_enqueue_style('font-theme', get_template_directory_uri() . '/assets/fonts/font-theme/css/font-theme.css');
    wp_enqueue_style('elegant', get_template_directory_uri() . '/assets/fonts/elegant/css/elegant.css');
    wp_enqueue_style('et-line', get_template_directory_uri() . '/assets/fonts/et-line/css/et-line.css');
    wp_enqueue_script( 'admin-widget', get_template_directory_uri() . '/inc/admin/assets/js/widget.js', array( 'jquery' ), array( 'jquery' ), '1.0.0', true );
}

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'admin-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css');
    wp_enqueue_style( 'font-theme', get_template_directory_uri() . '/assets/fonts/font-theme/css/font-theme.css');
    wp_enqueue_style('admin-elegant', get_template_directory_uri() . '/assets/fonts/elegant/css/elegant.css');
    wp_enqueue_style('admin-et-line', get_template_directory_uri() . '/assets/fonts/et-line/css/et-line.css');
    wp_enqueue_style( 'icoland-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
} );

/* Favicon */
add_action('wp_head', 'icoland_site_favicon');
function icoland_site_favicon(){
    $favicon = icoland()->get_theme_opt( 'favicon' );
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'icoland_pingback_header' );
function icoland_pingback_header(){
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}