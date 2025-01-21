<?php
/**
 * @package Bravis-Themes
 */
get_header();
$post_title = maiko()->get_theme_opt( 'post_title', true );
$featured_video = get_post_meta( get_the_ID(), 'featured-video-url', true );
$link_url = get_post_meta( get_the_ID(), 'featured-link-url', true );
$audio_url = get_post_meta( get_the_ID(), 'featured-audio-url', true );
$maiko_sidebar = maiko()->get_sidebar_args(['type' => 'post', 'content_col'=> '8']); ?>
<div class="container">
    <div class="top-metas">
        <div class="metas-left">
            <?php if($post_title) { ?>
                <h2 class="pxl-item--title"><?php the_title(); ?></h2>
            <?php } ?>
            <?php maiko()->blog->get_post_metas(); ?>
        </div>
        <div class="pxl-icon-postformat">
            <?php if (has_post_format('quote')){ ?>
                <div class="format-wrap">
                    <div class="link-icon">
                        <a><span>“</span></a>
                    </div>
                </div>
                <?php
            }elseif (has_post_format('link')){ ?>
                <div class="format-wrap">
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
            </div>
        <?php }elseif (has_post_format('video')){ ?>
            <div class="format-wrap">
                <?php
                if (!empty($featured_video)){
                    ?>
                    <div class="link-icon">
                        <div class="pxl-video-popup">
                            <div class="content-inner">
                                <a class="video-play-button pxl-action-popup" href="<?php echo esc_url($featured_video); ?>">
                                    <i class="caseicon-play1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }?>
            </div>
            <?php
        }elseif ( !empty($audio_url) && has_post_format('audio')) { ?>

            <div class="format-wrap">
                <div class="link-icon">
                    <a href="<?php echo esc_url($audio_url) ?>" target='blank'>
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" id="fi_12184419"><g fill="#000"><path d="m12.836 3.35702c-.3471-.16252-.734-.22068-1.1135-.16742-.3796.05326-.7355.21565-1.0245.46742l-5.068 4.343h-1.63c-.53043 0-1.03914.21071-1.41421.58578-.37508.37508-.58579.88378-.58579 1.4142v4c0 .5304.21071 1.0392.58579 1.4142.37507.3751.88378.5858 1.41421.5858h1.63l5.07 4.344c.3609.3128.8224.485 1.3.485.2908-.0006.578-.064.842-.186.3478-.1587.6423-.4147.8478-.7372.2055-.3224.3132-.6974.3102-1.0798v-13.65198c.0025-.383-.1061-.7585-.3127-1.081-.2066-.32251-.5023-.57817-.8513-.736z"></path><path d="m15.564 8.05202c-.11.07184-.2048.16468-.279.27319-.0741.10851-.1261.23057-.1531.3592-.0269.12863-.0282.2613-.0038.39044.0243.12914.0739.25221.1459.36217.4747.77058.726 1.65788.726 2.56298s-.2513 1.7924-.726 2.563c-.0719.1099-.1214.2329-.1458.362s-.0231.2617.0038.3902c.0269.1286.0788.2506.1529.3591.074.1085.1687.2013.2786.2732s.2329.1215.362.1458c.129.0244.2616.0231.3902-.0038s.2506-.0788.3591-.1529c.1085-.074.2013-.1687.2732-.2786.6999-1.0907 1.0655-2.3622 1.052-3.658.0132-1.2958-.3524-2.56719-1.052-3.65798-.1451-.22197-.3724-.37721-.6319-.43159-.2596-.05439-.5301-.00346-.7521.14159z"></path><path d="m20.005 5.14802c-.0729-.10926-.1666-.2031-.2757-.27615-.1092-.07305-.2316-.12389-.3604-.14961s-.2614-.02582-.3903-.0003c-.1288.02552-.2513.07617-.3606.14906-.1093.07288-.2031.16657-.2761.27572-.0731.10915-.1239.23161-.1497.36041-.0257.12879-.0258.26139-.0003.39023.0256.12883.0762.25138.1491.36064 1.1014 1.71115 1.678 3.70713 1.659 5.74198.0174 2.0073-.5428 3.9773-1.614 5.675-.1452.222-.1963.4926-.142.7522.0543.2597.2095.4871.4315.6323s.4926.1963.7522.142c.2597-.0543.4871-.2095.6323-.4315 1.2914-2.0199 1.9655-4.3727 1.94-6.77.0175-2.42967-.676-4.81142-1.995-6.85198z"></path></g></svg>
                    </a>
                </div>
            </div>
        <?php }else { ?>
    <!-- <div class="format-wrap">
        <div class="link-icon">
            <a>
                <svg fill="none" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m16.0497 2.29289c-.3906-.39052-1.0237-.39052-1.4142 0-.3906.39053-.3906 1.02369 0 1.41422l.7071.70713-6.07257 4.58576h-4.44823c-.44545 0-.66853.60968-.35355.92466l9.60665 9.60664c.3149.3149.9251.0919.9251-.3536v-4.4477l4.5852-6.07311.7071.70707c.3905.39052 1.0237.39052 1.4142 0s.3905-1.02369 0-1.41421zm-8.07094 15.14221-1.41421-1.4142-3.97913 3.9791-.57548 1.74c-.04442.1517.09837.2945.25008.25l1.74007-.5762z" fill="rgb(0,0,0)" fill-rule="evenodd"/></svg>
            </a>
        </div>
    </div> -->
<?php } ?>
</div>
</div>
<div class="row <?php echo esc_attr($maiko_sidebar['wrap_class']) ?>">
    <div id="pxl-content-area" class="<?php echo esc_attr($maiko_sidebar['content_class']) ?>">
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
    <?php if ($maiko_sidebar['sidebar_class']) : ?>
        <div id="pxl-sidebar-area" class="<?php echo esc_attr($maiko_sidebar['sidebar_class']) ?>">
            <div class="pxl-sidebar-sticky">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
<?php get_footer();
