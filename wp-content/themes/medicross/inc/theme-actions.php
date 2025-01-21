<?php 
/**
 * Actions Hook for the theme
 *
 * @package Case-Themes
 */
add_action('after_setup_theme', 'medicross_setup');
function medicross_setup(){

    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'medicross_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'medicross', get_template_directory() . '/languages' );

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
        'primary' => esc_html__( 'Primary', 'medicross' ),
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
        'video',
        'audio',
        'quote',
        'link',
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_image_size( 'medicross-thumb-small', 80, 70, true );
    add_image_size( 'medicross-thumb-xs', 120, 104, true );
    add_image_size( 'medicross-large', 810, 385, true );
    add_image_size( 'medicross-portfolio', 600, 600, true );

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');

}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'medicross_widgets_position' );
function medicross_widgets_position() {
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'medicross' ),
        'id'            => 'sidebar-blog',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2><div class="widget-content">',
    ) );

    if (class_exists('ReduxFramework')) {
        register_sidebar( array(
            'name'          => esc_html__( 'Page Sidebar', 'medicross' ),
            'id'            => 'sidebar-page',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title"><span>',
            'after_title'   => '</span></h2><div class="widget-content">',
        ) );
    }

    if ( class_exists( 'Woocommerce' ) ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'medicross' ),
            'id'            => 'sidebar-shop',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title"><span>',
            'after_title'   => '</span></h2><div class="widget-content">',
        ) );
    }
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action( 'wp_enqueue_scripts', 'medicross_scripts' );
function medicross_scripts() {  
    $medicross_version = wp_get_theme( get_template() );
    /* Popup Libs */
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/libs/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'loader', get_template_directory_uri() . '/assets/js/libs/jprelaoder.min.js', array( 'jquery' ), '1.0.0', true );
    /* Wow Libs */
    wp_enqueue_style('wow-animate', get_template_directory_uri() . '/assets/css/libs/animate.min.css', array(), '1.1.0');
    wp_enqueue_script( 'wow-animate', get_template_directory_uri() . '/assets/js/libs/wow.min.js', array( 'jquery' ), '1.0.0', true );

    /* Particles Background Libs */
    wp_register_script( 'particles-background', get_template_directory_uri() . '/assets/js/libs/particles.min.js', array( 'jquery' ), '1.1.0', true );

    /* Parallax Image */
    wp_register_script( 'tilt', get_template_directory_uri() . '/assets/js/libs/tilt.min.js', array( 'jquery' ), '1.0.0', true );

    /* Parallax Libs */
    wp_register_script( 'stellar-parallax', get_template_directory_uri() . '/assets/js/libs/stellar-parallax.min.js', array( 'jquery' ), '0.6.2', true );

    /* Nice Select */
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/libs/nice-select.min.js', array( 'jquery' ), 'all', true );

    /* Divider Move on Menu */
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/libs/modernizr.min.js', array( 'jquery' ), 'all', true );

    /* Icons Lib - CSS */
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css' , array(), $medicross_version->get( 'Version' ));
    
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/walsheim/flaticon.css' , array(), $medicross_version->get( 'Version' ));

    /* Counter Effect */
    wp_register_script( 'pxl-counter-slide', get_template_directory_uri() . '/assets/js/libs/counter-slide.min.js', array( 'jquery' ), '1.0.0', true );

    /* Scroll Effect */
    wp_register_script( 'pxl-scroll', get_template_directory_uri() . '/assets/js/libs/scroll.min.js', array( 'jquery' ), '0.6.0', true );

    /* Parallax Scroll */
    wp_enqueue_script( 'pxl-parallax-background', get_template_directory_uri() . '/assets/js/libs/parallax-background.js', array( 'jquery' ), $medicross_version->get( 'Version' ), true );
    wp_enqueue_script( 'pxl-parallax-scroll', get_template_directory_uri() . '/assets/js/libs/parallax-scroll.js', array( 'jquery' ), $medicross_version->get( 'Version' ), true );
    wp_register_script( 'pxl-easing', get_template_directory_uri() . '/assets/js/libs/easing.js', array( 'jquery' ), '1.3.0', true );

    /* Tweenmax */
    wp_register_script( 'pxl-tweenmax', get_template_directory_uri() . '/assets/js/libs/tweenmax.min.js', array( 'jquery' ), '2.1.2', true );
    
    /* Parallax Move Mouse */
    wp_register_script( 'pxl-parallax-move-mouse', get_template_directory_uri() . '/assets/js/libs/parallax-move-mouse.js', array( 'jquery' ), '1.0.0', true );

    /* Woocommerce */
    wp_enqueue_script( 'pxl-woocommerce', get_template_directory_uri() . '/woocommerce/js/woocommerce.js', array( 'jquery' ), $medicross_version->get( 'Version' ), true );

    /* Icon */
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css');
    /* Cookie */
    wp_register_script( 'pxl-cookie', get_template_directory_uri() . '/assets/js/libs/cookie.js', array( 'jquery' ), '1.4.1', true );

    /* Smooth Scroll */
    $smooth_scroll = medicross()->get_theme_opt( 'smooth_scroll', 'off' );
    if($smooth_scroll == 'on') {
        wp_enqueue_script( 'gsap' );
        wp_enqueue_script( 'pxl-scroll-trigger' );
        wp_enqueue_script( 'pxl-bundled-lenis' );
    }
    wp_enqueue_script('pxl-jarallax', get_template_directory_uri() . '/assets/js/libs/jarallax.min.js', [ 'jquery' ], '1.1.0');
    wp_enqueue_style( 'pxl-caseicon', get_template_directory_uri() . '/assets/css/caseicon.css', array(), $medicross_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), $medicross_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-style', get_template_directory_uri() . '/assets/css/style.css', array(), $medicross_version->get( 'Version' ) );
    wp_add_inline_style( 'pxl-style', medicross_inline_styles() );
    wp_enqueue_style( 'pxl-base', get_template_directory_uri() . '/style.css', array(), $medicross_version->get( 'Version' ) );
    wp_enqueue_style( 'pxl-google-fonts', medicross_fonts_url(), array(), null );
    wp_enqueue_script( 'pxl-main', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), $medicross_version->get( 'Version' ), true );
    wp_localize_script( 'pxl-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    do_action( 'medicross_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'medicross_admin_style');
function medicross_admin_style() {
    $theme = wp_get_theme( get_template() );
    wp_enqueue_style( 'medicross-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), $theme->get( 'Version' ) );
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css');
}

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'elementor-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css');
    wp_enqueue_style( 'medicross-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
    wp_enqueue_style('admin-bootstrap-icons', get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css');
} );

/* Favicon */
add_action('wp_head', 'medicross_site_favicon');
function medicross_site_favicon(){
    $favicon = medicross()->get_theme_opt( 'favicon' );
    if(!empty($favicon['url'])) {
        $favicon_sm  = pxl_get_image_by_size( array(
            'attach_id'  => $favicon['id'],
            'thumb_size' => '32x32',
        ) );
        $favicon_sm_url    = $favicon_sm['url'];

        $favicon_xs  = pxl_get_image_by_size( array(
            'attach_id'  => $favicon['id'],
            'thumb_size' => '16x16',
        ) );
        $favicon_xs_url    = $favicon_xs['url'];

        echo '<link rel="icon" type="image/png" sizes="32x32" href="'.esc_url($favicon_sm_url).'"/>';
        echo '<link rel="icon" type="image/png" sizes="16x16" href="'.esc_url($favicon_xs_url).'"/>';
    }
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'medicross_pingback_header' );
function medicross_pingback_header(){
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}

/* Hidden Panel */
add_action( 'pxl_anchor_target', 'medicross_hook_anchor_templates_hidden_panel');
function medicross_hook_anchor_templates_hidden_panel(){

    $hidden_templates = medicross_get_templates_slug('hidden-panel');
    if(empty($hidden_templates)) return;

    foreach ($hidden_templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id']
        ];
        if( did_action('pxl_anchor_target_hidden_panel_'.$values['post_id']) <= 0){  
            do_action( 'pxl_anchor_target_hidden_panel_'.$values['post_id'], $args );  
        }
    } 
}
if(!function_exists('medicross_hook_anchor_hidden_panel')){
    function medicross_hook_anchor_hidden_panel($args){
        $hidden_panel_position = get_post_meta( $args['post_id'], 'hidden_panel_position', true );
        $hidden_panel_boxcolor = get_post_meta( $args['post_id'], 'hidden_panel_boxcolor', true );
        $hidden_panel_height = get_post_meta( $args['post_id'], 'hidden_panel_height', true ); ?>
        <div class="pxl-hidden-panel-popup pxl-hidden-template-<?php echo esc_attr($args['post_id'])?> pxl-pos-<?php echo esc_attr($hidden_panel_position); ?>">
            <div class="pxl-popup--overlay pxl-cursor--cta"></div>
            <div class="pxl-popup--conent" style="height:<?php echo esc_attr($hidden_panel_height).'px'; ?>; background-color:<?php echo esc_attr($hidden_panel_boxcolor); ?>;">
                <div class="pxl-conent-elementor">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
                </div>
            </div>
        </div>
    <?php }
}

/* Elementor Popup */
add_action( 'pxl_anchor_target', 'medicross_hook_anchor_templates_popup');
function medicross_hook_anchor_templates_popup(){

    $popup_templates = medicross_get_templates_slug('popup');
    if(empty($popup_templates)) return;

    foreach ($popup_templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id']
        ];
        if( did_action('pxl_anchor_target_popup_'.$values['post_id']) <= 0){  
            do_action( 'pxl_anchor_target_popup_'.$values['post_id'], $args );  
        }
    } 
}
/* Search Popup */
if(!function_exists('medicross_hook_anchor_search')){
    function medicross_hook_anchor_search(){
        $logo_s = medicross()->get_theme_opt( 'logo_s', ['url' => get_template_directory_uri().'/assets/img/logo.png', 'id' => '' ] ); 
        $logo_pg = medicross()->get_page_opt( 'logo_pg', ['url' => get_template_directory_uri().'/assets/img/logo.png', 'id' => '' ] ); 

        ?>
        <div id="pxl-search-popup">
            <div class="pxl-item--overlay"></div>
            <div class="pxl-item--logo">
                <?php
                if ($logo_pg['url']) {
                    printf(
                        '<a href="%1$s" title="%2$s" rel="home">
                        <img src="%3$s" alt="%2$s" class="logo-light"/>
                        </a>',
                        esc_url( home_url( '/' ) ),
                        esc_attr( get_bloginfo( 'name' ) ),
                        esc_url( $logo_pg['url'] )
                    );
                }else {
                    printf(
                        '<a href="%1$s" title="%2$s" rel="home">
                        <img src="%3$s" alt="%2$s" class="logo-light"/>
                        </a>',
                        esc_url( home_url( '/' ) ),
                        esc_attr( get_bloginfo( 'name' ) ),
                        esc_url( $logo_s['url'] )
                    );
                }
                ?>
            </div>
            <div class="pxl-item--conent">
                <div class="pxl-item--close pxl-close"></div>
                <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <input type="text" required placeholder="<?php esc_attr_e('Type Your Search Words...', 'medicross'); ?>" name="s" class="search-field" />
                    <button type="submit" class="search-submit rm-style-default"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <g clip-path="url(#clip0_243_485)">
                        <path d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.8047 15.8037L21.0012 21.0003" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_243_485">
                          <rect width="24" height="24" fill="white"/>
                      </clipPath>
                  </defs>
              </svg></button>
              <div class="pxl--search-divider"></div>
          </form>
      </div>
  </div>
<?php }
}
if(!function_exists('medicross_hook_anchor_popup')){
    function medicross_hook_anchor_popup($args){ ?>
        <div id="pxl-popup-elementor" class="pxl-popup-elementor-wrap">
            <div class="pxl-item--overlay pxl-cursor--cta">
                <div class="pxl-item--flip pxl-item--flip1"></div>
                <div class="pxl-item--flip pxl-item--flip2"></div>
                <div class="pxl-item--flip pxl-item--flip3"></div>
                <div class="pxl-item--flip pxl-item--flip4"></div>
                <div class="pxl-item--flip pxl-item--flip5"></div>
            </div>
            <div class="pxl-item--close pxl-close pxl-cursor--cta"></div>
            <div class="pxl-item--conent">
                <div class="pxl-conent-elementor">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
                </div>
            </div>
        </div>
    <?php }
}

/* Page Popup */
add_action( 'pxl_anchor_target', 'medicross_hook_anchor_templates_page_popup');
function medicross_hook_anchor_templates_page_popup(){

    $page_templates = medicross_get_templates_slug('popup');
    if(empty($page_templates)) return;

    foreach ($page_templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id']
        ];
        if( did_action('pxl_anchor_target_page_popup_'.$values['post_id']) <= 0){  
            do_action( 'pxl_anchor_target_page_popup_'.$values['post_id'], $args );  
        }
    } 
}
if(!function_exists('medicross_hook_anchor_page_popup')){
    function medicross_hook_anchor_page_popup($args){ ?>
        <div class="pxl-page-popup pxl-page-popup-template-<?php echo esc_attr($args['post_id'])?>">
            <div class="pxl-close-popup  pxl-cursor--cta ">x</div>
            <div class="pxl-popup--conent">
                <div class="pxl-conent-elementor">
                    <?php 
                    $content_page = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id'] );
                    pxl_print_html($content_page);
                    ?>
                </div>
            </div>
        </div>
    <?php }
}

/* Cart Sidebar */
if(!function_exists('medicross_hook_anchor_cart')){
    function medicross_hook_anchor_cart(){ 
        global $woocommerce; ?>
        <div id="pxl-cart-sidebar" class="pxl-popup-wrap">
            <div class="pxl-popup--overlay pxl-cursor--cta"></div>
            <div class="pxl-popup--conent pxl-widget-cart-sidebar">
                <div class="widget_shopping_cart">
                    <div class="widget_shopping_head">
                        <div class="pxl-item--close pxl-close pxl-cursor--cta"></div>
                        <div class="widget_shopping_title">
                            <?php echo esc_html__( 'Cart', 'medicross' ); ?> <span class="widget_cart_counter">(<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'medicross' ), WC()->cart->cart_contents_count ); ?>)</span>
                        </div>
                    </div>
                    <div class="widget_shopping_cart_content">
                        <?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
                        <ul class="cart_list product_list_widget">

                            <?php if ( ! WC()->cart->is_empty() ) : ?>

                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                    $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                    $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                    ?>
                                    <li>
                                        <?php if(!empty($thumbnail)) : ?>
                                            <div class="cart-product-image">
                                                <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
                                                    <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="cart-product-meta">
                                            <h3><a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html($product_name); ?></a></h3>
                                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                                            <?php
                                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                '<a href="%s" class="remove_from_cart_button pxl-close" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                esc_attr__( 'Remove this item', 'medicross' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $cart_item_key ),
                                                esc_attr( $_product->get_sku() )
                                            ), $cart_item_key );
                                            ?>
                                        </div>  
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                            <?php else : ?>

                                <li class="empty">
                                    <i class="caseicon-shopping-cart-alt"></i>
                                    <span><?php esc_html_e( 'Your cart is empty', 'medicross' ); ?></span>
                                    <a class="btn btn-shop" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Browse Shop', 'medicross'); ?></a>
                                </li>

                            <?php endif; ?>

                        </ul><!-- end product list -->
                    </div>
                    <?php if ( ! WC()->cart->is_empty() ) : ?>
                    <div class="widget_shopping_cart_footer">
                        <p class="total"><strong><?php esc_html_e( 'Subtotal', 'medicross' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

                        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

                        <p class="buttons">
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-shop wc-forward"><?php esc_html_e( 'View Cart', 'medicross' ); ?></a>
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn checkout wc-forward"><?php esc_html_e( 'Checkout', 'medicross' ); ?></a>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }
}