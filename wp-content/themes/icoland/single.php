<?php
/**
 * @package Tnex-Themes
 */
get_header();
$icoland_sidebar = icoland()->get_sidebar_args(['type' => 'post', 'content_col'=> '9']);
?>
<div class="pxl-item--image" <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>style="background-image: url(<?php echo esc_url($thumbnail_url[0]); ?>);"<?php } ?>>
</div>

<div class="container ">
    <div class="row <?php echo esc_attr($icoland_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($icoland_sidebar['content_class']) ?>">
            <main id="pxl-content-main">
                <?php while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/content/content-single', get_post_format() );
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                } ?>
            </main>
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
<?php  icoland()->blog->icoland_related_post();  ?>
<?php get_footer();
