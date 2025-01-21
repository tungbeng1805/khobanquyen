<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Tnex-Themes
 */
$post_navigation = icoland()->get_theme_opt( 'post_navigation', true );
$post_tag = icoland()->get_theme_opt( 'post_tag', true );
$post_social_share = icoland()->get_theme_opt( 'post_social_share', true );
?>
<article id="pxl-post-<?php the_ID(); ?>" <?php post_class('pxl-item--post'); ?>>
    
    <div class="pxl-item--holder">
        <?php  icoland()->blog->get_post_categorie();  ?>
        <h2 class="pxl-item--title">
                <?php the_title(); ?>
        </h2>
        <?php  icoland()->blog->get_post_metas();  ?>
        <div class="pxl-item--excerpt clearfix">
            <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>
        </div>
    </div>

    <?php if($post_tag || $post_social_share ) :  ?>
        <div class="pxl--post-footer">
            <?php if($post_tag) { icoland()->blog->get_tagged_in(); } ?>
            <?php if($post_social_share) { icoland()->blog->get_socials_share(); } ?>
        </div>
    <?php endif; ?>
    <?php if($post_navigation) { icoland()->blog->get_post_nav(); } ?>
</article><!-- #post -->