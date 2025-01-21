<?php
/**
 * @package Tnex-Themes
 */
get_header();
$icoland_sidebar = icoland()->get_sidebar_args(['type' => 'page', 'content_col'=> '9']);
if(class_exists('\Elementor\Plugin')){
    $id = get_the_ID();
    if ( is_singular() && \Elementor\Plugin::$instance->db->is_built_with_elementor( $id ) && !empty($icoland_sidebar['sidebar_class'])) {
        $portfolio = 'container';
    }elseif ( is_singular() && \Elementor\Plugin::$instance->db->is_built_with_elementor( $id ) ) {
         $portfolio = 'elementor-container';
    } else {
        $portfolio = 'container';
    }
} else {
    $portfolio = 'container';
}
?>
<div class="<?php echo esc_attr($portfolio); ?>">
    <div class="row <?php echo esc_attr($icoland_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($icoland_sidebar['content_class']) ?>">
            <main id="pxl-content-main">
                <?php while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/content/content', 'page' );
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                } ?>
            </main>
        </div>
        <?php if ($icoland_sidebar['sidebar_class']) : ?>
            <div id="pxl-sidebar-area" class="<?php echo esc_attr($icoland_sidebar['sidebar_class']) ?>">
                <div class="pxl-sidebar-sticky">
                    <?php dynamic_sidebar( 'sidebar-page' ); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();