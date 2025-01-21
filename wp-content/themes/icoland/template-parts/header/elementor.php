<?php 
$logo_m = icoland()->get_theme_opt( 'logo_m', ['url' => get_template_directory_uri().'/assets/img/logo.png', 'id' => '' ] );
$logo_dark_m = icoland()->get_page_opt( 'logo_dark_m');
$p_menu = icoland()->get_page_opt('p_menu');
$sticky_scroll = icoland()->get_theme_opt('sticky_scroll');
if(class_exists('\Elementor\Plugin')){
    $id = get_the_ID();
    if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( $id ) ) {
        $portfolio = 'pxl-header-content';
    } else {
        $portfolio = 'container';
    }
} else {
    $portfolio = 'container';
}

$header_layout = icoland()->get_opt('header_layout');
$post_header = get_post($header_layout);
$header_type = get_post_meta( $post_header->ID, 'header_type', true );
?>
<header id="pxl-header-elementor" class="is-sticky ">
    <?php if(isset($args['header_layout']) && $args['header_layout'] > 0) : ?>
        <div class="pxl-header-elementor-main <?php echo esc_attr($header_type); ?>">
          <div class="pxl-header-content">
              <div class="row">
                 <div class="col-12">
                     <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $args['header_layout']); ?>
                 </div>
             </div>
         </div>
     </div>
 <?php endif; ?>
 <?php if(isset($args['header_layout_sticky']) && $args['header_layout_sticky'] > 0) : ?>
  <div class="pxl-header-elementor-sticky <?php echo esc_attr($sticky_scroll); ?>">
      <div class="container">
          <div class="row">
            <div class="col-12">
              <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $args['header_layout_sticky']); ?>
          </div>
      </div>
  </div>
</div>
<?php endif; ?>
<div id="pxl-header-mobile">
    <div id="pxl-header-main" class="pxl-header-main">
        <div class="container">
            <div class="row">
                <div class="pxl-header-branding">
                    <?php
                    if ($logo_m['url']) {
                        if ($logo_dark_m['url']) {
                            printf(
                                '<a class="logo-mobile-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                esc_url( home_url( '/' ) ),
                                esc_attr( get_bloginfo( 'name' ) ),
                                esc_url( $logo_dark_m['url'] )
                            );
                        }else{
                            printf(
                                '<a href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                esc_url( home_url( '/' ) ),
                                esc_attr( get_bloginfo( 'name' ) ),
                                esc_url( $logo_m['url'] )
                            );
                        }
                    }
                    ?>
                </div>
                <div class="pxl-header-menu">
                    <div class="pxl-header-menu-scroll">
                        <div class="pxl-menu-close pxl-hide-xl pxl-close"></div>
                        <div class="pxl-logo-mobile pxl-hide-xl">
                            <?php
                            if ($logo_dark_m['url']) {
                                printf(
                                    '<a href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_dark_m['url'] )
                                );
                            }else{
                                printf(
                                    '<a href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_m['url'] )
                                );
                            }
                            ?>
                        </div>
                        <?php icoland_header_mobile_search_form(); ?>
                        <nav class="pxl-header-nav">
                            <?php 
                            if ( has_nav_menu( 'primary' ) )
                            {
                                $attr_menu = array(
                                    'theme_location' => 'primary',
                                    'container'  => '',
                                    'menu_id'    => '',
                                    'menu_class' => 'pxl-menu-primary clearfix',
                                    'link_before'     => '<span>',
                                    'link_after'      => '</span>',
                                    'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                                );
                                if(isset($p_menu) && !empty($p_menu)) {
                                    $attr_menu['menu'] = $p_menu;
                                }
                                wp_nav_menu( $attr_menu );
                            } else { ?>
                                <ul class="pxl-menu-primary">
                                    <?php wp_list_pages( array(
                                        'depth'        => 0,
                                        'show_date'    => '',
                                        'date_format'  => get_option( 'date_format' ),
                                        'child_of'     => 0,
                                        'exclude'      => '',
                                        'title_li'     => '',
                                        'echo'         => 1,
                                        'authors'      => '',
                                        'sort_column'  => 'menu_order, post_title',
                                        'link_before'  => '',
                                        'link_after'   => '',
                                        'item_spacing' => 'preserve',
                                        'walker'       => '',
                                    ) ); ?>
                                </ul>
                            <?php }
                            ?>
                        </nav>
                    </div>
                </div>
                <div class="pxl-header-menu-backdrop"></div>
            </div>
        </div>

        <div id="pxl-nav-mobile">
            <div class="pxl-nav-mobile-button"><span></span></div>
        </div>
    </div>
</div>
</header>