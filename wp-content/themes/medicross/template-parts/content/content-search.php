<?php
/**
 * @package Medicross
 */

$archive_readmore_text = medicross()->get_theme_opt('archive_readmore_text', esc_html__('Read more', 'medicross'));
$post_social_share = medicross()->get_theme_opt( 'post_social_share', false );
$featured_video = get_post_meta( get_the_ID(), 'featured-video-url', true );
$audio_url = get_post_meta( get_the_ID(), 'featured-audio-url', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-archive-post'); ?>>
    <div class="content-inner-post">
        <?php if (has_post_thumbnail()) {
            $archive_date = medicross()->get_theme_opt( 'archive_date', true );
            ?>
            <div class="post-featured">
                <?php
                if (has_post_format('quote')){
                    $quote_text = get_post_meta( get_the_ID(), 'featured-quote-text', true );
                    $quote_cite = get_post_meta( get_the_ID(), 'featured-quote-cite', true );
                    ?>
                    <div class="format-wrap">
                        <div class="pxl-hl-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fm-qt.png'); ?>" /></div>
                        <div class="quote-inner">
                            <div class="content-top">
                                <div class="link-icon">
                                    <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                                       <span>“</span>
                                   </a>
                               </div>
                               <div class="content-right">
                                <?php medicross()->blog->get_archive_meta_2(); ?>
                                <div class="quote-text">
                                    <a href="<?php echo esc_url( get_permalink()); ?>"><?php echo esc_html($quote_text);?></a>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (!empty($quote_cite)){
                            ?>
                            <p class="quote-cite">
                                <?php echo esc_html($quote_cite);?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }elseif (has_post_format('link')){
                $link_url = get_post_meta( get_the_ID(), 'featured-link-url', true );
                $link_text = get_post_meta( get_the_ID(), 'featured-link-text', true );
                ?>
                <div class="format-wrap">
                    <div class="link-inner">
                        <div class="pxl-hl-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fm-qt.png'); ?>" /></div>
                        <div class="content-top">
                            <div class="link-icon">
                                <a href="<?php echo esc_url( $link_url); ?>">
                                    <svg version="1.1" id="Glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <path d="M192.5,240.5c20.7-21,56-23,79,0h0.2c6.4,6.4,11,14.2,13.8,22.6c6.7-1.1,12.6-4,17.1-8.5l22.1-21.9
                                    c-5-9.6-11.4-18.4-19-26.2c-42-41.1-106.9-40-147.2,0l-80,80c-40.6,40.9-40.6,106.3,0,147.2c40.9,40.6,106.3,40.6,147.2,0l75.4-75.4
                                    c-22,3.6-43.1,1.6-62.7-5.3l-46.7,46.6c-21.1,21.3-57.9,21.3-79.2,0c-21.8-21.8-21.8-57.3,0-79C113.9,318.9,197.8,235.1,192.5,240.5
                                    L192.5,240.5z"/>
                                    <path d="M319.5,271.5c-21,21.3-56.3,22.7-79,0c-0.2,0-0.2,0-0.2,0c-6.4-6.4-11-14.2-13.8-22.6c-6.7,1.1-12.6,4-17.1,8.5l-22.1,21.9
                                    c5,9.6,11.4,18.4,19,26.2c42,41.1,106.9,40,147.2,0l80-80c40.6-40.9,40.6-106.3,0-147.2c-40.9-40.6-106.3-40.6-147.2,0L211,153.8
                                    c22-3.6,43.1-1.6,62.7,5.3l46.7-46.6c21.1-21.3,57.9-21.3,79.2,0c21.8,21.8,21.8,57.3,0,79C398.1,193.1,314.2,276.9,319.5,271.5
                                    L319.5,271.5z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="content-right">
                            <?php medicross()->blog->get_archive_meta_2(); ?>
                            <h2 class="post-title">
                                <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if(is_sticky()) { ?>
                                        <i class="caseicon-check"></i>
                                    <?php } ?>
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    </div>

                    <div class="link-text">
                        <a class="link-text" target="_blank" href="<?php echo esc_url( $link_url); ?>"><?php echo esc_html($link_text);?></a>
                    </div>
                </div>
            </div>
            <?php
        }elseif (has_post_format('video')){
            if (has_post_thumbnail()) {
                ?>
                <div class="format-wrap">
                    <div class="pxl-item--image">
                        <a href="<?php echo esc_url( get_permalink()); ?>"><?php the_post_thumbnail('medicross-large'); ?></a>
                        <?php
                        if (!empty($featured_video)){
                            ?>
                            <div class="pxl-video-popup">
                                <div class="content-inner">
                                    <a class="video-play-button pxl-action-popup" href="<?php echo esc_url($featured_video); ?>">
                                        <i class="caseicon-play1"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }?>
                    </div>
                </div>
                <?php
            }
        }elseif ( !empty($audio_url) && has_post_format('audio')) {
            global $wp_embed;
            pxl_print_html($wp_embed->run_shortcode('[embed]' . $audio_url . '[/embed]'));
        }else{
            ?>
            <div class="pxl-item--image">
                <a href="<?php echo esc_url( get_permalink()); ?>"><?php the_post_thumbnail('medicross-large'); ?></a>
            </div>
            <?php if($archive_date) : ?>
                <div class="post-date">
                    <div class="date-day"><?php echo get_the_date('d', $post->ID)  ?></div>
                    <div class="date-month"><?php echo get_the_date('M', $post->ID)  ?></div>
                </div>
            <?php endif; ?>
            <?php
        }
        ?>
    </div>
<?php } ?>
<?php
if (!has_post_format('link') && !has_post_format('quote')){
    ?>
    <div class="post-content">
        <?php medicross()->blog->get_archive_meta(); ?>
        <h2 class="post-title">
            <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php if(is_sticky()) { ?>
                    <i class="caseicon-check"></i>
                <?php } ?>
                <?php the_title(); ?>
            </a>
        </h2>
        <div class="pxl-divider"></div>
        <div class="post-excerpt">
            <?php
            medicross()->blog->get_excerpt(34);
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>
        </div>
        <?php
        if (!empty($archive_readmore_text)){
            ?>
            <div class="post-btn-wrap">
                <a class="btn-more" href="<?php echo esc_url( get_permalink()); ?>">
                    <span><?php echo esc_html($archive_readmore_text); ?></span>
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 743.03 261.28"><line class="cls-1" x1="723.09" y1="130.59" y2="130.59"/><line class="cls-1" x1="723.09" y1="130.59" y2="130.59"/><path class="cls-2" d="M612.2,117.9" transform="translate(-21.64 -107.51)"/><path class="cls-3" d="M612.2,117.9" transform="translate(-21.64 -107.51)"/><path class="cls-1" d="M511.18,175.42" transform="translate(-21.64 -107.51)"/><path class="cls-1" d="M383.19,308.63" transform="translate(-21.64 -107.51)"/><polyline class="cls-1" points="600.63 9.92 723.09 131.89 600.63 251.25"/></svg>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>
</article>