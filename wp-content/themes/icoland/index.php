<?php
/**
 * @package Tnex-Themes
 */
get_header();
$icoland_sidebar = icoland()->get_sidebar_args(['type' => 'blog', 'content_col'=> '9']);
?>
<div class="container">
    <div class="row <?php echo esc_attr($icoland_sidebar['wrap_class']) ?>" >
        <div id="pxl-content-area" class="<?php echo esc_attr($icoland_sidebar['content_class']) ?>">
            <main id="pxl-content-main">
                <?php if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content/content' );
                    }
                } else {
                    get_template_part( 'template-parts/content/content', 'none' );
                } ?>
            </main>
                    
            <?php  icoland()->page->get_pagination();?>
        </div>
        <?php if ($icoland_sidebar['sidebar_class']) : ?>
            <div id="pxl-sidebar-area" class="<?php echo esc_attr($icoland_sidebar['sidebar_class']) ?>">
                <div class="pxl-sidebar-sticky">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();
