<?php
/**
 * Template Name: Blog Classic
 * @package Tnex-Themes
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-item--post pxl-item--archive'); ?>>
    <div class="wrap-image">
        <?php if (has_post_thumbnail()) { 
            echo '<div class="pxl-item--image">'; ?>
            <a href="<?php echo esc_url( get_permalink()); ?>"><?php the_post_thumbnail('full'); ?></a>
            
            <?php echo '</div>';
        }  ?>
        <?php icoland()->blog->get_archive_categorie(); ?>
    </div>
    <div class="pxl-item--holder">
        <h2 class="pxl-item--title">
            <i class="caseicon-check" style="display: none;"></i>
            <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <?php icoland()->blog->get_archive_meta(); ?>
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
        <div class="pxl-item-readmore">
            <a class="btn-more" href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                Read More
            </a>
        </div>
    </div>
</article>