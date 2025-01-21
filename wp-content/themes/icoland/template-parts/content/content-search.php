<?php
/**
 * @package Tnex-Themes
 */
$archive_readmore_text = icoland()->get_theme_opt( 'archive_readmore_text', esc_html__('Read more', 'icoland') );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-item--post pxl-item--archive'); ?>>
    
    <?php if (has_post_thumbnail()) { 
        echo '<div class="pxl-item--image">'; ?>
        <a href="<?php echo esc_url( get_permalink()); ?>"><?php the_post_thumbnail('icoland-medium'); ?></a>
        <?php echo '</div>';
    } ?>
    <div class="pxl-item--holder">
        <div class="pxl-item--category">
            <?php the_terms( $post->ID, 'category', '', ' ' ); ?>
        </div>
        <h2 class="pxl-item--title">
            <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <div class="pxl-item--excerpt">
            <?php
            icoland()->blog->get_excerpt();
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?> 
        </div>
        <?php icoland()->blog->get_archive_meta(); ?>
    </div>
</article> 