<?php 
use Elementor\Embed;
if(!function_exists('maiko_get_post_grid')){
    function maiko_get_post_grid($posts = [], $settings = []){ 
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['layout']) {
            case 'post-1':
            maiko_get_post_grid_layout1($posts, $settings);
            break;

            case 'post-2':
            maiko_get_post_grid_layout2($posts, $settings);
            break;

            case 'portfolio-1':
            maiko_get_portfolio_grid_layout1($posts, $settings);
            break;

            case 'portfolio-2':
            maiko_get_portfolio_grid_layout2($posts, $settings);
            break;

            case 'portfolio-3':
            maiko_get_portfolio_grid_layout3($posts, $settings);
            break;

            case 'portfolio-4':
            maiko_get_portfolio_grid_layout4($posts, $settings);
            break;

            case 'portfolio-5':
            maiko_get_portfolio_grid_layout5($posts, $settings);
            break;

            case 'portfolio-6':
            maiko_get_portfolio_grid_layout6($posts, $settings);
            break;

            case 'service-1':
            maiko_get_service_grid_layout1($posts, $settings);
            break;

            default:
            return false;
            break;
        }
    }
}

// Start Post Grid
//--------------------------------------------------
function maiko_get_post_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '370x418';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = ''; ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                    $img_id = get_post_thumbnail_id($post->ID);
                    $img          = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size
                    ) );
                    $thumbnail    = $img['thumbnail']; 
                    ?>
                    <div class="pxl-post--meta pxl-flex-middle">
                        <?php if($show_author == 'true'): ?>
                            <div class="pxl-item--author"><span>
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' ); ?>
                                <?php echo esc_html__('by','maiko') ?> <?php the_author_posts_link(); ?>
                            </div>
                        <?php endif; ?>

                        <?php if($show_date == 'true'): ?>
                            <div class="post-date">
                                <?php echo get_the_date('d F Y', $post->ID)  ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="pxl-post--featured hover-imge-effect2">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                        <?php if($show_category == 'true'): ?>
                            <div class="pxl-post--category">
                                <?php the_terms( $post->ID, 'category', '', ' ' ); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>


                <h3 class="pxl-post--title title-hover-line"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                <?php if($show_excerpt == 'true'): ?>
                    <div class="pxl-post--content">
                        <?php if($show_excerpt == 'true'): ?>
                            <?php
                            echo wp_trim_words( $post->post_excerpt, $num_words, null );
                            ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if($show_button == 'true') : ?>
                    <div class="pxl-post--button">
                        <a class="btn--readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <span class="btn--text">
                                <?php if(!empty($button_text)) {
                                    echo esc_attr($button_text);
                                } else {
                                    echo esc_html__('Continue Reading', 'maiko');
                                } ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" x="0" y="0" viewBox="0 0 1560 1560" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(1,0,0,1,4.999999999999545,4.547473508864641e-13)"><path d="M1524 811.8H36c-17.7 0-32-14.3-32-32s14.3-32 32-32h1410.7l-194.2-194.2c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l248.9 248.9c9.2 9.2 11.9 22.9 6.9 34.9-5 11.9-16.7 19.7-29.6 19.7z" fill="#0a1119" opacity="1" data-original="#000000"></path><path d="M1274.8 1061c-8.2 0-16.4-3.1-22.6-9.4-12.5-12.5-12.5-32.8 0-45.3l249.2-249.2c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-249.2 249.2c-6.3 6.3-14.5 9.4-22.7 9.4z" fill="#0a1119" opacity="1" data-original="#000000"></path></g></svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    endforeach;
endif;
}

function maiko_get_post_grid_layout2($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '800x408';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = ''; 

            $post_color = get_post_meta($post->ID, 'post_main_color', true);
            $primary_color = maiko()->get_opt('primary_color', '#121c27'); ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                <?php
                if (has_post_format('quote', $post->ID)){
                    $quote_text = get_post_meta( $post->ID , 'featured-quote-text', true );
                    $quote_cite = get_post_meta( $post->ID , 'featured-quote-cite', true );
                    ?>
                    <div class="pxl-post--inner format-quote <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="format-wrap">
                            <div class="pxl-ruller-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ruler.png'); ?>" /><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ruler.png'); ?>" /></div>
                            <div class="quote-inner">
                                <div class="quote-icon">
                                    <i class="flaticon flaticon-quote-01"></i>
                                </div>
                                <div class="quote-text">
                                    <a href="<?php echo esc_url( get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text);?></a>
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
                    </div>


                <?php }else if (has_post_format('link', $post->ID)){
                    $link_url = get_post_meta( $post->ID , 'featured-link-url', true );
                    $link_text = get_post_meta( $post->ID , 'featured-link-text', true );
                    ?>
                    <div class="pxl-post--inner format-link <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="post-featured">
                            <div class="link-inner">
                                <div class="pxl-ruller-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ruler.png'); ?>" /><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ruler.png'); ?>" /></div>
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
                            <h2 class="post-title">
                                <a href="<?php echo esc_url( get_permalink($post->ID)); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if(is_sticky()) { ?>
                                        <i class="caseicon-check"></i>
                                    <?php } ?>
                                    <?php echo esc_attr(get_the_title($post->ID)); ?>
                                </a>
                            </h2>
                            <div class="link-text">
                                <a class="link-text" target="_blank" href="<?php echo esc_url( $link_url); ?>"><?php echo esc_html($link_text);?></a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } else{ ?>
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                    $img_id = get_post_thumbnail_id($post->ID);
                    $img          = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size
                    ) );
                    $thumbnail    = $img['thumbnail'];
                    $thumbnail_url    = $img['url'];
                    ?>
                    <div class="pxl-post--featured hover-imge-effect2" style="background-image:url(<?php echo esc_url($thumbnail_url); ?>)">

                        <?php if (has_post_format('audio', $post->ID)) {  
                            $audio = get_post_meta( $post->ID, 'featured-audio-url', true );
                            ?>  
                            <a class="btn-volumn" href="<?php echo esc_url($audio); ?>" target="_blank">
                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" id="fi_12184419"><g fill="#000"><path d="m12.836 3.35702c-.3471-.16252-.734-.22068-1.1135-.16742-.3796.05326-.7355.21565-1.0245.46742l-5.068 4.343h-1.63c-.53043 0-1.03914.21071-1.41421.58578-.37508.37508-.58579.88378-.58579 1.4142v4c0 .5304.21071 1.0392.58579 1.4142.37507.3751.88378.5858 1.41421.5858h1.63l5.07 4.344c.3609.3128.8224.485 1.3.485.2908-.0006.578-.064.842-.186.3478-.1587.6423-.4147.8478-.7372.2055-.3224.3132-.6974.3102-1.0798v-13.65198c.0025-.383-.1061-.7585-.3127-1.081-.2066-.32251-.5023-.57817-.8513-.736z"></path><path d="m15.564 8.05202c-.11.07184-.2048.16468-.279.27319-.0741.10851-.1261.23057-.1531.3592-.0269.12863-.0282.2613-.0038.39044.0243.12914.0739.25221.1459.36217.4747.77058.726 1.65788.726 2.56298s-.2513 1.7924-.726 2.563c-.0719.1099-.1214.2329-.1458.362s-.0231.2617.0038.3902c.0269.1286.0788.2506.1529.3591.074.1085.1687.2013.2786.2732s.2329.1215.362.1458c.129.0244.2616.0231.3902-.0038s.2506-.0788.3591-.1529c.1085-.074.2013-.1687.2732-.2786.6999-1.0907 1.0655-2.3622 1.052-3.658.0132-1.2958-.3524-2.56719-1.052-3.65798-.1451-.22197-.3724-.37721-.6319-.43159-.2596-.05439-.5301-.00346-.7521.14159z"></path><path d="m20.005 5.14802c-.0729-.10926-.1666-.2031-.2757-.27615-.1092-.07305-.2316-.12389-.3604-.14961s-.2614-.02582-.3903-.0003c-.1288.02552-.2513.07617-.3606.14906-.1093.07288-.2031.16657-.2761.27572-.0731.10915-.1239.23161-.1497.36041-.0257.12879-.0258.26139-.0003.39023.0256.12883.0762.25138.1491.36064 1.1014 1.71115 1.678 3.70713 1.659 5.74198.0174 2.0073-.5428 3.9773-1.614 5.675-.1452.222-.1963.4926-.142.7522.0543.2597.2095.4871.4315.6323s.4926.1963.7522.142c.2597-.0543.4871-.2095.6323-.4315 1.2914-2.0199 1.9655-4.3727 1.94-6.77.0175-2.42967-.676-4.81142-1.995-6.85198z"></path></g></svg>
                            </a>
                        <?php } ?>

                        <?php if (has_post_format('video', $post->ID)) {  
                            $video = get_post_meta( $post->ID, 'featured-video-url', true );
                            ?>  
                            <a class="video-play-button pxl-action-popup" href="<?php echo esc_url($video); ?>">
                                <i class="caseicon-play1"></i>
                            </a>

                        <?php } ?>
                        <?php if($show_date == 'true'): ?>
                            <div class="post-date">
                                <div class="date-day"><?php echo get_the_date('d', $post->ID)  ?></div>
                                <div class="year-month">
                                    <span class="date-month"><?php echo get_the_date('M', $post->ID)  ?></span>
                                    <span class="date-year"><?php echo get_the_date('y', $post->ID)  ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="pxl-post--holder">
                    <div class="pxl-post--meta-top ">
                        <div class="pxl-post--meta-left ">
                            <h3 class="pxl-post--title "><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                            <?php if($show_excerpt == 'true'): ?>
                                <div class="pxl-post--content">
                                    <?php if($show_excerpt == 'true'): ?>
                                        <?php
                                        echo wp_trim_words( $post->post_excerpt, 20, null );
                                        ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="pxl-post--meta-right">
                            <div class="wrap-content">
                                <div class="pxl-ruller-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/ruler.png'); ?>" /></div>
                                <?php if($show_author == 'true'): ?>
                                    <span class="author-avatar">
                                        <?php echo get_avatar( get_the_author_meta( 'ID', $post->post_author ), 'thumbnail' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if($show_author == 'true'): ?>
                                    <div class="pxl-item--author d-flex">
                                        <div class="label"><i class="fas fa-user"></i> <?php echo esc_html__('Post:','maiko') ?></div>
                                        <span><?php the_author_posts_link(); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($show_comment == 'true') : ?>
                                    <div class="post-comments d-flex">
                                        <div class="label"><i class="flaticon flaticon-speech-bubble"></i><?php echo esc_html__('Comments:','maiko') ?></div>
                                        <a href="<?php echo get_comments_link($post->ID); ?>">
                                            <span><?php comments_number(esc_html__('0 Comments', 'maiko'), esc_html__(' 1 Comment', 'maiko'), esc_html__('%', 'maiko'), $post->ID); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if($show_tags == 'true'): ?>
                                    <div class="pxl-post--tag  d-flex">
                                        <div class="label"><i class="fas fa-tag"></i> <?php echo esc_html__('Tags:','maiko') ?></div>
                                        <div class="tag"><?php echo get_the_tag_list('', ',&nbsp', '', $post->ID); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pxl-post--meta-bottom">
                        <div class="left-bottom">
                            <?php if($show_button == 'true') : ?>
                                <div class="pxl-post--button">
                                    <a class="btn--readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <span class="btn--text">
                                            <?php if(!empty($button_text)) {
                                                echo esc_attr($button_text);
                                            } else {
                                                echo esc_html__('continue reading', 'maiko');
                                            } ?>
                                        </span>
                                        <span class="icon">
                                            <i class="far fa-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="right-bottom">
                            <div class="post-shares align-items-center">
                                <span class="label"><?php echo esc_html__('Share Post:', 'maiko'); ?></span>
                                <div class="social-share">
                                    <div class="social">
                                        <a class="pxl-icon " title="<?php echo esc_attr__('Facebook', 'maiko'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink($post->ID)); ?>">
                                            <i class="caseicon-facebook"></i>
                                        </a>
                                        <a class="pxl-icon " title="<?php echo esc_attr__('Twitter', 'maiko'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_the_permalink($post->ID)); ?>&text=<?php the_title();?>%20">
                                            <i class="caseicon-twitter"></i>
                                        </a>
                                        <a class="pxl-icon " title="<?php echo esc_attr__('Linkedin', 'maiko'); ?>" target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo urlencode(get_the_permalink($post->ID));?>">
                                            <i class="caseicon-pinterest"></i>
                                        </a>
                                        <a class="pxl-icon " title="<?php echo esc_attr__('Pinterest', 'maiko'); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_post_thumbnail_url($post->ID, 'full')); ?>&media=&description=<?php echo urlencode(the_title_attribute(array('echo' => false, 'post' => $post))); ?>">
                                            <i class="caseicon-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="pxl-el-divider visible"></div>
    </div>
    <?php
endforeach;
endif;
}
// End Post Grid
//--------------------------------------------------

// Start Portfolio Grid
//--------------------------------------------------
function maiko_get_portfolio_grid_layout1($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '840x988';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured ">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                            <div class="pxl-post-content-hide">
                                <?php if ($post_style_l1 == 'pxl-portfolio-2') { ?>
                                    <?php if($show_category == 'true'): ?>
                                        <div class="pxl-post--category">
                                            <?php the_terms( $post->ID, 'portfolio-category', '', '/ ' ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h5 class="pxl-post--title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                            <?php echo esc_attr(get_the_title($post->ID)); ?>
                                        </a>    
                                    </h5>
                                <?php } ?>
                                <?php if($show_excerpt == 'true'): ?>
                                    <div class="pxl-post--content">
                                        <?php if($show_excerpt == 'true'): ?>
                                            <?php
                                            echo wp_trim_words( $post->post_excerpt, $num_words, null );
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($show_button == 'true'): ?>
                                    <a class="btn-readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 20 20" height="17" viewBox="0 0 20 20" width="21"><path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="#fff"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <a class="pxl-item--overlay" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                            </a>  
                        </div>
                        <?php if ($post_style_l1 != 'pxl-portfolio-2') { ?>
                            <div class="pxl-post--holder">
                                <?php if($show_category == 'true'): ?>
                                    <div class="pxl-post--category">
                                        <?php the_terms( $post->ID, 'portfolio-category', '', ', ' ); ?>
                                    </div>
                                <?php endif; ?>
                                <h5 class="pxl-post--title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                        <?php echo esc_attr(get_the_title($post->ID)); ?>
                                    </a>    
                                </h5>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;
    endif;
}

function maiko_get_portfolio_grid_layout2  ($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : 'full';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured ">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                            <a class="pxl-item--overlay" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                            </a>  
                        </div>
                        <div class="pxl-post--holder">
                            <?php if($show_button == 'true'): ?>
                                <a class="btn-readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="24" viewBox="0 0 24 24" width="24"><path d="m16.0039 9.414-8.60699 8.607-1.414-1.414 8.60599-8.607h-7.58499v-2h10.99999v11h-2z" fill="rgb(0,0,0)"/></svg>
                                </a>
                            <?php endif; ?>
                            <h5 class="pxl-post--title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                    <?php echo esc_attr(get_the_title($post->ID)); ?>
                                </a>    
                            </h5>
                            <?php if($show_category == 'true'): ?>
                                <div class="pxl-post--category">
                                    <?php the_terms( $post->ID, 'portfolio-category', '', ', ' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;
    endif;
}

function maiko_get_portfolio_grid_layout3($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : 'full';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xxl-{$col_xxl} col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            $client = get_post_meta($post->ID, 'client', true);
            $date_finish = get_post_meta($post->ID, 'date_finish', true);

            if (isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if ($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if ($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xxl-{$col_xxl} col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if (!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if (!empty($tax)) {
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            } else {
                $filter_class = '';
            }

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if ($img_id) {
                    $img = pxl_get_image_by_size([
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload img-hv-ac img-cover-center w-100 h-100',
                    ]);
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?> fade-in-up" data-target=".item-img-<?php echo esc_attr($key)?>">
                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--holder">
                            <?php if ($show_category == 'true'): ?>
                                <div class="pxl-post--category">
                                    <?php the_terms($post->ID, 'portfolio-category', '', ','); ?>
                                </div>
                            <?php endif; ?>
                            <h5 class="pxl-post--title">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">   
                                    <?php echo esc_attr(get_the_title($post->ID)); ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="pxl-imgs-hover absolute">
            <?php foreach ($posts as $key => $post): ?>
                <?php $img_id = get_post_thumbnail_id($post->ID); ?>
                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                <?php if ($img_id) {
                    $img = pxl_get_image_by_size([
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload img-hv-ac img-cover-center w-100 h-100',
                    ]);
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                } ?>
                <div class="img-item pxl-absoluted overflow-hidden item-img-<?php echo esc_attr($key); ?>">
                    <div class="img-inner pxl-absoluted overflow-hidden">
                        <?php echo wp_kses_post($thumbnail); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif;
}

function maiko_get_portfolio_grid_layout4($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '860x539';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured ">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                            <div class="pxl-post-content-hide">
                                <h5 class="pxl-post--title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                        <?php echo esc_attr(get_the_title($post->ID)); ?>
                                    </a>    
                                </h5>
                                <?php if($show_category == 'true'): ?>
                                    <div class="pxl-post--category">
                                        <?php the_terms( $post->ID, 'portfolio-category', '', ', ' ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="pxl-divider"></div>
                                <?php if($show_excerpt == 'true'): ?>
                                    <div class="pxl-post--content">
                                        <?php if($show_excerpt == 'true'): ?>
                                            <?php
                                            echo wp_trim_words( $post->post_excerpt, $num_words, null );
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($show_button == 'true'): ?>
                                    <a class="btn--readmore btn btn-default" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <span class="pxl--btn-text">
                                            <?php if(!empty($button_text)) {
                                                echo esc_attr($button_text);
                                            } else {
                                                echo esc_html__('Read More', 'maiko');
                                            } ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" x="0" y="0" viewBox="0 0 1560 1560" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(1,0,0,1,4.999999999999545,4.547473508864641e-13)"><path d="M1524 811.8H36c-17.7 0-32-14.3-32-32s14.3-32 32-32h1410.7l-194.2-194.2c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l248.9 248.9c9.2 9.2 11.9 22.9 6.9 34.9-5 11.9-16.7 19.7-29.6 19.7z" fill="#fff" opacity="1" data-original="#000000"></path><path d="M1274.8 1061c-8.2 0-16.4-3.1-22.6-9.4-12.5-12.5-12.5-32.8 0-45.3l249.2-249.2c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-249.2 249.2c-6.3 6.3-14.5 9.4-22.7 9.4z" fill="#fff" opacity="1" data-original="#000000"></path></g></svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;
    endif;
}

function maiko_get_portfolio_grid_layout5($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '1820x595';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured ">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                            <div class="pxl-post-content-hide">
                                <div class="pxl-content-top">
                                    <h5 class="pxl-post--title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                            <?php echo esc_attr(get_the_title($post->ID)); ?>
                                        </a>    
                                    </h5>
                                    <?php if($show_category == 'true'): ?>
                                        <div class="pxl-post--category">
                                            <?php 
                                            $terms = get_the_terms( $post->ID, 'portfolio-category' );
                                            if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                                                $terms_list = array();
                                                foreach ( $terms as $term ) {
                                                    $term_link = get_term_link( $term );
                                                    if ( !is_wp_error( $term_link ) ) {
                                                        $terms_list[] = '<a class="btn btn-default" href="' . esc_url( $term_link ) . '"><span class="pxl--btn-text">' . esc_html( $term->name ) . '</span></a>';
                                                    }
                                                }
                                                echo implode( ' ', $terms_list );
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pxl-content-bottom">
                                    <?php if($show_excerpt == 'true'): ?>
                                        <div class="pxl-post--content">
                                            <?php if($show_excerpt == 'true'): ?>
                                                <?php
                                                echo wp_trim_words( $post->post_excerpt, $num_words, null );
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($show_button == 'true'): ?>
                                        <a class="btn--readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="512" viewBox="0 0 24 24" width="512"><path d="m16.0039 9.414-8.60699 8.607-1.414-1.414 8.60599-8.607h-7.58499v-2h10.99999v11h-2z" fill="rgb(0,0,0)"/></svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;
    endif;
}

function maiko_get_portfolio_grid_layout6($posts = [], $settings = []){ 
    extract($settings);
    $images_size = !empty($img_size) ? $img_size : '785x850';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xxl-{$col_xxl} col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            $area = get_post_meta($post->ID, 'area', true);
            $year = get_post_meta($post->ID, 'year', true);

            if (isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if ($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if ($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xxl-{$col_xxl} col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if (!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if (!empty($tax)) {
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            } else {
                $filter_class = '';
            }

            $img_id = get_post_thumbnail_id($post->ID);
            ?>
            <div class="pxl-grid-item <?php echo esc_attr($filter_class); ?> fade-in-up" data-target=".item-img-<?php echo esc_attr($key)?>">
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <div class="pxl-post--holder">
                        <div class="pxl-post--project">
                            <h5 class="pxl-post--title">
                                <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 20 20" height="15" viewBox="0 0 20 20" width="13"><path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/></svg><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h5>
                        </div>
                        <?php if($show_area == 'true'): ?>
                            <div class="pxl-post--area">
                                <?php echo esc_html($area); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($show_year == 'true'): ?>
                            <div class="pxl-post--year">
                                <?php echo esc_html($year); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif;
}

// End Portfolio Grid
//--------------------------------------------------

// Start Service Grid
//--------------------------------------------------
function maiko_get_service_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    $images_size = !empty($img_size) ? $img_size : 'full';
    if (is_array($posts)):
        $count_pos = 1;
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';
            $img_id = get_post_thumbnail_id($post->ID);
            $service_excerpt = get_post_meta($post->ID, 'service_excerpt', true);
            $service_external_link = get_post_meta($post->ID, 'service_external_link', true);
            $service_icon_type = get_post_meta($post->ID, 'service_icon_type', true);
            $service_icon_font = get_post_meta($post->ID, 'service_icon_font', true);
            $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true); 
            ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <div class="pxl-post--featured">
                        <?php if($show_number == 'true'): ?>
                            <span class="count-pos">
                                <?php
                                if ($count_pos < 10) {
                                    echo esc_html__('0'. $count_pos++ .'.');
                                }else{
                                    echo esc_html__($count_pos++);  
                                }?>
                            </span>
                        <?php endif; ?>
                        <?php if($service_icon_type == 'icon' && !empty($service_icon_font)) : ?>
                            <div class="pxl-post--icon">
                                <i class="<?php echo esc_attr($service_icon_font); ?>"></i>
                            </div>
                        <?php endif; ?>
                        <?php if($service_icon_type == 'image' && !empty($service_icon_img)) : 
                            $icon_img = pxl_get_image_by_size( array(
                                'attach_id'  => $service_icon_img['id'],
                                'thumb_size' => 'full',
                            ));
                            $icon_thumbnail = $icon_img['thumbnail'];
                            ?>
                            <div class="pxl-post--icon">
                                <?php echo wp_kses_post($icon_thumbnail); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pxl-holder-content">
                        <h3 class="pxl-post--title">
                            <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                        </h3>

                        <?php if($show_excerpt == 'true'): ?>
                            <div class="pxl-post--content">
                                <?php if($show_excerpt == 'true'): ?>
                                    <?php
                                    echo wp_trim_words( $post->post_excerpt, 20, null );
                                    ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if($show_button == 'true') : ?>
                            <div class="pxl-post--readmore">
                                <a class="btn-readmore" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                    <span><?php if(!empty($button_text)) {
                                        echo esc_attr($button_text);
                                    } else {
                                        echo esc_html__('Read More', 'maiko');
                                    } ?></span>
                                    <i class="flaticon flaticon-right-arrow"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach;
    endif;
}
// End Service Grid
//-------------------------------------------------

// Start Product Grid
//--------------------------------------------------
function maiko_get_product_grid_layout1($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '557x600';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $product = wc_get_product( $post->ID ); ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <div class="woocommerce-product-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                        $img_id = get_post_thumbnail_id($post->ID);
                        $img = maiko_get_image_by_size( array(
                            'attach_id'  => $img_id,
                            'thumb_size' => $images_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                        ?>
                        <div class="woocommerce-product-header">
                            <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="woocommerce-product-content">
                        <div class="woocommerce-product-meta">
                            <h5 class="woocommerce-product-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h5>
                            <div class="woocommerce-product--price">
                                <?php echo wp_kses_post($product->get_price_html()); ?>
                            </div>
                        </div>
                        <div class="woocommerce-product--buttons">
                            <div class="woocommerce-add-to-cart pxl-mr-10">
                                <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->get_type() ),
                                        esc_html( $product->add_to_cart_text() )
                                    ),
                                    $product );
                                    ?>
                                </div>
                                <?php if (class_exists('WPCleverWoosw')) { ?>
                                    <div class="woocommerce-wishlist pxl-mr-10">
                                        <?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                    </div>
                                <?php } ?>
                                <?php if (class_exists('WPCleverWoosc')) { ?>
                                    <div class="woocommerce-compare">
                                        <?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
    endif;
}

// End Product Grid
//--------------------------------------------------

/*add_action( 'wp_ajax_maiko_get_pagination_html', 'maiko_get_pagination_html' );
add_action( 'wp_ajax_nopriv_maiko_get_pagination_html', 'maiko_get_pagination_html' );
function maiko_get_pagination_html(){
    try{
        if(!isset($_POST['query_vars'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'maiko'));
        }
        $query = new WP_Query($_POST['query_vars']);
        ob_start();
        maiko()->page->get_pagination( $query,  true );
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'maiko'),
                'data' => array(
                    'html' => $html,
                    'query_vars' => $_POST['query_vars'],
                    'post' => $query->have_posts()
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}


add_action( 'wp_ajax_maiko_load_more_post_grid', 'maiko_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_maiko_load_more_post_grid', 'maiko_load_more_post_grid' );
function maiko_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'maiko'));
        }
        $settings = $_POST['settings'];
        set_query_var('paged', $settings['paged']);
        extract(pxl_get_posts_of_grid($settings['post_type'], [
            'source' => isset($settings['source'])?$settings['source']:'',
            'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
            'order' => isset($settings['order'])?$settings['order']:'desc',
            'limit' => isset($settings['limit'])?$settings['limit']:'6',
            'post_ids' => isset($settings['post_ids'])?$settings['post_ids']:[],
        ]));
        ob_start();
         
        maiko_get_post_grid($posts, $settings);
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'maiko'),
                'data' => array(
                    'html' => $html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}
*/

add_action( 'wp_ajax_maiko_load_more_post_grid', 'maiko_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_maiko_load_more_post_grid', 'maiko_load_more_post_grid' );
function maiko_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'maiko'));
        }

        $settings = isset($_POST['settings']) ? $_POST['settings'] : null;

        $source = isset($settings['source']) ? $settings['source'] : '';
        $term_slug = isset($settings['term_slug']) ? $settings['term_slug'] : '';
        if( !empty($term_slug) && $term_slug !='*'){
            $term_slug = str_replace('.', '', $term_slug);
            $source = [$term_slug.'|'.$settings['tax'][0]]; 
        }
        if( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'filter'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }elseif( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'select_orderby'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }else{
            set_query_var('paged', (int)$settings['paged']);
        }

        extract(pxl_get_posts_of_grid($settings['post_type'], [
            'source'      => $source,
            'orderby'     => isset($settings['orderby'])?$settings['orderby']:'date',
            'order'       => isset($settings['order']) ? ($settings['orderby'] == 'title' ? 'asc' : sanitize_text_field($settings['order']) ) : 'desc',
            'limit'       => isset($settings['limit'])?$settings['limit']:'6',
            'post_ids'    => isset($settings['post_ids'])?$settings['post_ids']: [],
            'post_not_in' => isset($settings['post_not_in'])?$settings['post_not_in']: [],
        ],
        $settings['tax']
    ));

        ob_start();
        if( isset($settings['wg_type']) && $settings['wg_type'] == 'post-list'){
            maiko_get_post_list($posts, $settings);
        }else{
            maiko_get_post_grid($posts, $settings);
        }
        $html = ob_get_clean();

        $pagin_html = '';
        if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'pagination' ){ 
            ob_start();
            maiko()->page->get_pagination( $query,  true );
            $pagin_html = ob_get_clean();
        }

        $result_count = '';
        if( isset($settings['show_toolbar']) && $settings['show_toolbar'] == 'show' ){ 
            ob_start();
            if( (int)$settings['paged'] == 0){
                $limit_start = 1;
                $limit_end = ( (int)$settings['limit'] >= $total ) ? $total : (int)$settings['limit'];
            }else{
                $limit_start = (((int)$settings['paged'] - 1 ) * (int)$settings['limit']) + 1;
                $limit_end = (int)$settings['paged'] * (int)$settings['limit'];
                $limit_end = ( $limit_end >= $total ) ? $total : $limit_end;
            }
            if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'loadmore' ){ 
                printf(
                    '<span class="result-count">%1$s %2$s %3$s %4$s %5$s</span>',
                    esc_html__('Showing','maiko'),
                    '1-'.$limit_end,
                    esc_html__('of','maiko'),
                    $total,
                    esc_html__('results','maiko')
                );
            }else{
                printf(
                    '<span class="result-count">%1$s %2$s %3$s %4$s %5$s</span>',
                    esc_html__('Showing','maiko'),
                    $limit_start.'-'.$limit_end,
                    esc_html__('of','maiko'),
                    $total,
                    esc_html__('results','maiko')
                );
            }

            $result_count = ob_get_clean();
        }

        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'maiko'),
                'data' => array(
                    'html' => $html,
                    'pagin_html' => $pagin_html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                    'result_count' => $result_count,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}

function maiko_get_post_list($posts = [], $settings = []){ 
    if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
        return;
    }
    extract($settings);

    switch ($settings['layout']) {
        case 'post-list-1':
        maiko_get_post_list_layout1($posts, $settings);
        break;

        case 'post-list-2':
        maiko_get_post_list_layout2($posts, $settings);
        break;

        case 'service-list-1':
        maiko_get_service_list_layout1($posts, $settings);
        break;

        case 'service-list-2':
        maiko_get_service_list_layout2($posts, $settings);
        break;

        case 'portfolio-list-1':
        maiko_get_portfolio_list_layout1($posts, $settings);
        break;

        default:
        return false;
        break;
    }
}
function maiko_get_post_list_layout1($posts = [], $settings = []){
    extract($settings); 
    foreach ($posts as $key => $post):

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $author = get_user_by('id', $post->post_author);
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Read More', 'maiko');
        $date_format = get_option('date_format');

        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }

        
        $flag = false;
        $post_format = get_post_format($post->ID) == false ? 'format-standard' : 'format-'.get_post_format($post->ID);
        ?>
        <div class="<?php echo esc_attr('list-item w-100 '. $post_format); ?> <?php echo esc_attr($animate_cls) ?>" <?php pxl_print_html($data_settings); ?>>
            <div class="grid-item-inner item-inner-wrap row  <?php echo esc_attr($post_format) ?>">
                <?php
                if (has_post_format('quote', $post->ID)){
                    $quote_text = get_post_meta( $post->ID, 'featured-quote-text', true );
                    $quote_cite = get_post_meta( $post->ID, 'featured-quote-cite', true );
                    ?>
                    <div class="col-12">
                        <div class="quote-wrap">
                            <div class="quote-inner-wrap">
                                <div class="link-inner ">
                                    <div class="link-icon">
                                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fm-qt.png'); ?>" />
                                    </div>
                                    <div class="content-right">
                                        <div class="item-post-metas ">
                                            <div class="meta-inner  align-items-center">
                                                <?php if($show_date == 'true') : ?>
                                                    <span class="post-date">
                                                        <?php echo get_the_date('d M', $post->ID); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if( $show_category == 'true' ) : ?>
                                                    <span class="meta-item post-category  d-flex">
                                                        <?php the_terms( $post->ID, 'category', '', ', ', '' ); ?>
                                                    </span>   
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <a class="quote-text" href="<?php echo esc_url( get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text);?></a>
                                    </div>
                                </div>
                                <div class="quote-footer ">
                                    <div class="quote-cite "><?php echo esc_html($quote_cite);?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('link', $post->ID)){
                    $link_url = get_post_meta( $post->ID , 'featured-link-url', true );
                    $link_text = get_post_meta( $post->ID , 'featured-link-text', true );
                    ?>
                    <div class="col-12">
                        <div class="link-wrap">
                            <div class="link-inner-wrap">
                                <div class="link-inner ">
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
                                    <div class="item-post-metas ">
                                        <div class="meta-inner  align-items-center">
                                            <?php if($show_date == 'true') : ?>
                                                <span class="post-date">
                                                    <?php echo get_the_date('d M', $post->ID); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if( $show_category == 'true' ) : ?>
                                                <span class="meta-item post-category  d-flex">
                                                    <?php the_terms( $post->ID, 'category', '', ', ', '' ); ?>
                                                </span>   
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <h3 class="link-title"><a href="<?php echo esc_url( $link_url); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                </div>
                            </div>
                            <div class="link-footer">
                                <a class="link-text" target="_blank" href="<?php echo esc_url( $link_url); ?>"><?php echo esc_html($link_text);?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  
            }else{
                if ( !empty( $thumbnail )){
                    $flag = true;
                    $featured_video = get_post_meta( $post->ID, 'featured-video-url', true );
                    $audio_url = get_post_meta( $post->ID, 'featured-audio-url', true ); 
                    ?>
                    <div class="item-featured col-lg-6">
                        <div class="post-image <?php echo esc_attr('scale-hover') ?>">
                            <a href="<?php echo esc_url( get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>       
                                <?php if (has_post_format('audio', $post->ID)) {  
                                    $audio = get_post_meta( $post->ID, 'featured-audio-url', true );
                                    ?>  
                                    <a class="btn-volumn" href="<?php echo esc_url($audio); ?>" target="_blank">
                                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" id="fi_12184419"><g fill="#000"><path d="m12.836 3.35702c-.3471-.16252-.734-.22068-1.1135-.16742-.3796.05326-.7355.21565-1.0245.46742l-5.068 4.343h-1.63c-.53043 0-1.03914.21071-1.41421.58578-.37508.37508-.58579.88378-.58579 1.4142v4c0 .5304.21071 1.0392.58579 1.4142.37507.3751.88378.5858 1.41421.5858h1.63l5.07 4.344c.3609.3128.8224.485 1.3.485.2908-.0006.578-.064.842-.186.3478-.1587.6423-.4147.8478-.7372.2055-.3224.3132-.6974.3102-1.0798v-13.65198c.0025-.383-.1061-.7585-.3127-1.081-.2066-.32251-.5023-.57817-.8513-.736z"></path><path d="m15.564 8.05202c-.11.07184-.2048.16468-.279.27319-.0741.10851-.1261.23057-.1531.3592-.0269.12863-.0282.2613-.0038.39044.0243.12914.0739.25221.1459.36217.4747.77058.726 1.65788.726 2.56298s-.2513 1.7924-.726 2.563c-.0719.1099-.1214.2329-.1458.362s-.0231.2617.0038.3902c.0269.1286.0788.2506.1529.3591.074.1085.1687.2013.2786.2732s.2329.1215.362.1458c.129.0244.2616.0231.3902-.0038s.2506-.0788.3591-.1529c.1085-.074.2013-.1687.2732-.2786.6999-1.0907 1.0655-2.3622 1.052-3.658.0132-1.2958-.3524-2.56719-1.052-3.65798-.1451-.22197-.3724-.37721-.6319-.43159-.2596-.05439-.5301-.00346-.7521.14159z"></path><path d="m20.005 5.14802c-.0729-.10926-.1666-.2031-.2757-.27615-.1092-.07305-.2316-.12389-.3604-.14961s-.2614-.02582-.3903-.0003c-.1288.02552-.2513.07617-.3606.14906-.1093.07288-.2031.16657-.2761.27572-.0731.10915-.1239.23161-.1497.36041-.0257.12879-.0258.26139-.0003.39023.0256.12883.0762.25138.1491.36064 1.1014 1.71115 1.678 3.70713 1.659 5.74198.0174 2.0073-.5428 3.9773-1.614 5.675-.1452.222-.1963.4926-.142.7522.0543.2597.2095.4871.4315.6323s.4926.1963.7522.142c.2597-.0543.4871-.2095.6323-.4315 1.2914-2.0199 1.9655-4.3727 1.94-6.77.0175-2.42967-.676-4.81142-1.995-6.85198z"></path></g></svg>
                                    </a>
                                <?php } ?>

                                <?php if (has_post_format('video', $post->ID)) {  
                                    $video = get_post_meta( $post->ID, 'featured-video-url', true );
                                    ?>  
                                    <a class="video-play-button pxl-action-popup" href="<?php echo esc_url($video); ?>">
                                        <i class="caseicon-play1"></i>
                                    </a>

                                <?php } ?>
                                <?php
                                if($show_date == 'true') : ?>
                                    <div class="post-date">
                                        <span class="day"><?php echo get_the_date('d', $post->ID); ?></span>
                                        <span class="month"><?php echo get_the_date('M', $post->ID); ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div> 
                    </div>
                    <?php
                }else{
                    if (has_post_format('video', $post->ID)){
                        $flag = true;
                        global $wp_embed;
                        $featured_video = get_post_meta( $post->ID, 'featured-video-url', true );
                        if (!empty($featured_video)) {
                            echo '<div class="item-featured col-lg-5">';
                            echo '<div class="feature-video">';
                            echo do_shortcode($wp_embed->autoembed($featured_video));
                            echo '</div>';
                            echo '</div>';
                        }
                    }elseif(has_post_format('audio', $post->ID)){

                        $flag = true;
                        global $wp_embed;
                        $audio_url = get_post_meta( $post->ID, 'featured-audio-url', true );
                        if (!empty($audio_url)) {
                            echo '<div class="item-featured col-lg-5">';
                            echo '<div class="feature-audio">';
                            echo do_shortcode($wp_embed->autoembed($audio_url));
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
                ?>
                <?php $col_cls = ($flag = true) ? 'col-lg-6' : 'col'; ?>
                <div class="wrap-item-content <?php echo esc_attr($col_cls) ?>">
                    <div class="item-content">
                        <?php
                        if ($show_author == 'true' || $show_category == 'true' || $show_comment == 'true' ){
                            ?>
                            <div class="item-post-metas">
                                <div class="meta-inner d-flex-wrap align-items-center">
                                    <?php if( $show_author == 'true' ) : ?>
                                        <span class="meta-item post-author d-flex">
                                            <span class="icon-post"><i class="flaticon-user"></i></span>
                                            <span>
                                                <?php esc_html_e('By','maiko')?> <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                            </span>
                                        </span>
                                    <?php endif; ?>
                                    <?php if( $show_category == 'true' ) : ?>
                                        <span class="meta-item post-category  d-flex">
                                            <span class="icon-post"><i class="flaticon-tag"></i></span>
                                            <span><?php the_terms( $post->ID, 'category', '', ', ', '' ); ?></span>
                                        </span>   
                                    </span>
                                <?php endif; ?>
                                <?php if($show_comment == 'true') : ?>
                                    <span class="post-comments">
                                        <a class="meta-item post-comment-count" href="<?php echo get_comments_link($post->ID); ?>#comments">
                                            <span class="icon-post"><i class="flaticon-speech-bubble"></i></span>
                                            <?php
                                            echo comments_number(
                                                '<span class="cmt-count">0</span> '.esc_html__('Comments', 'maiko'),
                                                '<span class="cmt-count">1</span> '.esc_html__('Comment', 'maiko'),
                                                '<span class="cmt-count">%</span> '.esc_html__('Comments', 'maiko'),
                                                $post->ID
                                            ); 
                                        ?></a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <h3 class="item-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                    <?php if($show_excerpt == 'true'): ?>
                        <div class="item-excerpt">
                            <?php
                            if(!empty($post->post_excerpt)){
                                echo wp_trim_words( $post->post_excerpt, $num_words, null );
                            } else{
                                $content = strip_shortcodes( $post->post_content );
                                $content = apply_filters( 'the_content', $content );
                                $content = str_replace(']]>', ']]&gt;', $content);
                                echo wp_trim_words( $content, $num_words, null );
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php 
                    if($show_readmore == 'true' || $post_share == 'true') : ?>
                        <div class="blog-post-footer  align-items-center justify-content-between">
                            <?php if( $show_readmore == 'true'): ?>
                                <div class="post-readmore">
                                    <a class="btn btn-default" href="<?php echo esc_url( get_permalink($post->ID)); ?>">
                                        <span class="pxl--btn-text"><?php echo maiko_html($readmore_text); ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 1230.3 556.2" style="enable-background:new 0 0 1230.3 556.2;" xml:space="preserve"><style type="text/css"> .st0{fill:none;stroke:#fff;stroke-width:36;stroke-miterlimit:10;}</style><g> <polyline class="st0" points="983.5,91.5 1165.3,279.2 983.5,464.7  "></polyline>    <line class="st0" x1="1165.3" y1="279.2" x2="22.7" y2="279.2"></line></g></svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php 
                            if(($settings['post_share'] == 'true') ):
                                ?>
                                <div class="post-shares">
                                    <span class="label">
                                        <i class="fas fa-share-alt"></i>
                                        <?php echo esc_html__('Share','maiko') ?>
                                    </span>
                                    <div class="social-share">
                                        <div class="social ">
                                            <a class="pxl-icon icon-facebook fab fa-facebook" title="<?php echo esc_attr__('Facebook', 'maiko'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>"></a>
                                            <a class="pxl-icon icon-twitter fab fa-twitter" title="<?php echo esc_attr__('Twitter', 'maiko'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_permalink($post->ID)); ?>&text=<?php echo get_the_title($post->ID);?>%20"></a>
                                            <a class="pxl-icon icon-linkedin fab fa-linkedin-in" title="<?php echo esc_attr__('Linkedin', 'maiko'); ?>" target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo urlencode(get_permalink($post->ID));?>"></a>
                                            <a href="javascript:void(0);" class="skype-share pxl-icon fab fa-skype" data-href="<?php echo urlencode(get_permalink($post->ID)); ?>" data-lang="en-US" data-text="<?php echo get_the_title($post->ID); ?>"></a> 
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
endforeach; 
}
function maiko_get_post_list_layout2($posts = [], $settings = []){
    $images_size = !empty($img_size) ? $img_size : '942x689';
    extract($settings); 
    foreach ($posts as $key => $post):

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $author_id = $post->post_author;
        $author = get_user_by('id', $author_id);
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Read More', 'maiko');
        $date_format = get_option('date_format');

        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }
        $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
        
        $flag = false;
        $post_format = get_post_format($post->ID) == false ? 'format-standard' : 'format-'.get_post_format($post->ID);
        ?>
        <div class="<?php echo esc_attr('list-item '. $item_class); ?> <?php echo esc_attr($animate_cls) ?>" <?php pxl_print_html($data_settings); ?>>
            <div class="pxl-post--inner grid-item-inner">
                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                $img_id = get_post_thumbnail_id($post->ID);
                $img          = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size
                ) );
                $thumbnail    = $img['thumbnail']; 
                ?>
                <div class="pxl-post--meta pxl-flex-middle">
                    <?php if($show_author == 'true'): ?>
                        <div class="pxl-item--author"><span>
                            <?php echo get_avatar($author_id, 'thumbnail'); ?>
                            <?php echo esc_html($author->display_name);?>
                        </div>
                    <?php endif; ?>

                    <?php if($show_date == 'true'): ?>
                        <div class="post-date">
                            <?php echo get_the_date('d F Y', $post->ID)  ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="pxl-post--featured hover-imge-effect2">
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <?php echo wp_kses_post($thumbnail); ?>
                    </a>
                    <?php if($show_category == 'true'): ?>
                        <div class="pxl-post--category">
                            <?php the_terms( $post->ID, 'category', '', ' ' ); ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>


            <h3 class="pxl-post--title title-hover-line"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
            <?php if($show_excerpt == 'true'): ?>
                <div class="pxl-post--content">
                    <?php if($show_excerpt == 'true'): ?>
                        <?php
                        echo wp_trim_words( $post->post_excerpt, $num_words, null );
                        ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
endforeach; 
}
function maiko_get_service_list_layout1($posts = [], $settings = []){
    extract($settings); 
    $images_size = !empty($img_size) ? $img_size : '675x554';
    $count_pos = 1;

    foreach ($posts as $key => $post):
        $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $author = get_user_by('id', $post->post_author);
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Read More', 'maiko');
        $date_format = get_option('date_format');

        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }

        if(!empty($tax))
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
        else 
            $filter_class = '';
        
        $flag = false;
        $img_id = get_post_thumbnail_id($post->ID);
        $service_excerpt = get_post_meta($post->ID, 'service_excerpt', true);
        $service_external_link = get_post_meta($post->ID, 'service_external_link', true);
        $service_icon_type = get_post_meta($post->ID, 'service_icon_type', true);
        $service_icon_font = get_post_meta($post->ID, 'service_icon_font', true);
        $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true); 
        $multi_text_country = get_post_meta($post->ID, 'multi_text_country', true);  
        $multi_text_country_link = get_post_meta($post->ID, 'multi_text_country_link', true);  
        $icon_multi_text = get_post_meta($post->ID, 'icon_multi_text', true);
        ?>
        <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
            <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                <div class="pxl-holder-content">
                    <?php if($show_number == 'true'): ?>
                        <span class="count-pos">
                            <?php
                            if ($count_pos < 10) {
                                echo esc_html__('0'. $count_pos++ .'.');
                            }else{
                                echo esc_html__($count_pos++);  
                            }?>
                        </span>
                    <?php endif; ?>
                    <div class="pxl-container">
                        <div class="pxl-container-left">
                          <h3 class="pxl-post--title">
                            <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                        </h3>

                        <?php if($show_excerpt == 'true'): ?>
                            <div class="pxl-post--content">
                                <?php if($show_excerpt == 'true'): ?>
                                    <?php
                                    echo wp_trim_words( $post->post_excerpt, 40, null );
                                    ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if($show_readmore == 'true') : ?>
                            <div class="pxl-post--readmore">
                                <a class="btn-readmore btn btn-default" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                    <span class="pxl--btn-text"><?php if(!empty($button_text)) {
                                        echo esc_attr($button_text);
                                    } else {
                                        echo esc_html__('Read More', 'maiko');
                                    } ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 753.2 476.2" style="enable-background:new 0 0 753.2 476.2;" xml:space="preserve">
                                        <polygon points="622.6,107.5 601.4,128.7 695.8,223.1 277,223.1 277,253.1 695.8,253.1 601.4,347.5 622.6,368.7 753.2,238.1 "/>
                                        <rect y="223.1" width="283.9" height="30"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($multi_text_country)): ?>
                        <ul class="multi-text">
                            <?php foreach ($multi_text_country as $index => $text): ?>
                                <li class="box-multi">
                                    <p>
                                        <a href="<?php echo !empty($multi_text_country_link[$index]) ? esc_url($multi_text_country_link[$index]) : '#'; ?>">
                                            <?php echo pxl_print_html($text); ?>
                                        </a>
                                    </p>
                                    <?php if (!empty($icon_multi_text)) { ?>
                                        <div class="multi-icon"><i class="<?php echo esc_attr($icon_multi_text); ?>"></i></div>
                                    <?php } else { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 20 20" width="20">
                                            <path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/>
                                        </svg>
                                    <?php } ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pxl-post--featured">
                <?php echo wp_kses_post($thumbnail); ?>  
                <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"></a>
                <?php if($service_icon_type == 'icon' && !empty($service_icon_font)) : ?>
                    <div class="pxl-post--icon">
                        <i class="<?php echo esc_attr($service_icon_font); ?>"></i>
                    </div>
                <?php endif; ?>
                <?php if($service_icon_type == 'image' && !empty($service_icon_img)) : 
                    $icon_img = pxl_get_image_by_size( array(
                        'attach_id'  => $service_icon_img['id'],
                        'thumb_size' => 'full',
                    ));
                    $icon_thumbnail = $icon_img['thumbnail'];
                    ?>
                    <div class="pxl-post--icon">
                        <?php echo wp_kses_post($icon_thumbnail); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
endforeach; 
}
function maiko_get_service_list_layout2($posts = [], $settings = []){
    extract($settings); 
    $images_size = !empty($img_size) ? $img_size : '549x407';
    $count_pos = 1;

    foreach ($posts as $key => $post):
        $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $author = get_user_by('id', $post->post_author);
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Read More', 'maiko');
        $date_format = get_option('date_format');

        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }

        if(!empty($tax))
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
        else 
            $filter_class = '';
        
        $flag = false;
        $is_active = ($key + 1) == $active;
        $img_id = get_post_thumbnail_id($post->ID);
        $service_excerpt = get_post_meta($post->ID, 'service_excerpt', true);
        $service_external_link = get_post_meta($post->ID, 'service_external_link', true);
        $service_icon_type = get_post_meta($post->ID, 'service_icon_type', true);
        $service_icon_font = get_post_meta($post->ID, 'service_icon_font', true);
        $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true); 
        $multi_text_country = get_post_meta($post->ID, 'multi_text_country', true);  
        $multi_text_country_link = get_post_meta($post->ID, 'multi_text_country_link', true);  
        $icon_multi_text = get_post_meta($post->ID, 'icon_multi_text', true);
        ?>
        <div class="<?php echo esc_attr($item_class); ?> pxl--item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
            <div class="pxl-accordion--title" data-target="<?php echo esc_attr('#pxl-'.$post->ID); ?>">
                <h3 class="pxl-title-text"><?php echo esc_attr(get_the_title($post->ID)); ?></h3>
                <div class="pxl-post--featured">
                    <?php echo wp_kses_post($thumbnail); ?>  
                </div>
                <div class="pxl-taget">
                    <i class="pxl-icon--plus"></i>
                </div>
            </div>
            <div id="<?php echo esc_attr('pxl-'.$post->ID); ?>" class="pxl-post--inner pxl-accordion--content <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s" <?php if($is_active){ ?>style="display: block;"<?php } ?>>
                <i class="pxl-icon--plus"></i>
                <div class="pxl-post--container">
                    <div class="pxl-holder-content">
                      <h3 class="pxl-post--title">
                        <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                    </h3>

                    <?php if($show_excerpt == 'true'): ?>
                        <div class="pxl-post--content">
                            <?php if($show_excerpt == 'true'): ?>
                                <?php
                                echo wp_trim_words( $post->post_excerpt, 40, null );
                                ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($show_readmore == 'true') : ?>
                        <div class="pxl-post--readmore">
                            <a class="btn-readmore btn btn-default" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                <span class="pxl--btn-text"><?php if(!empty($button_text)) {
                                    echo esc_attr($button_text);
                                } else {
                                    echo esc_html__('Read More', 'maiko');
                                } ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 753.2 476.2" style="enable-background:new 0 0 753.2 476.2;" xml:space="preserve">
                                    <polygon points="622.6,107.5 601.4,128.7 695.8,223.1 277,223.1 277,253.1 695.8,253.1 601.4,347.5 622.6,368.7 753.2,238.1 "/>
                                    <rect y="223.1" width="283.9" height="30"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="pxl-post--featured">
                    <?php echo wp_kses_post($thumbnail); ?>  
                    <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"></a>
                </div>
                <?php if (!empty($multi_text_country)): ?>
                    <ul class="multi-text">
                        <?php foreach ($multi_text_country as $index => $text): ?>
                            <li class="box-multi">
                                <p>
                                    <a href="<?php echo !empty($multi_text_country_link[$index]) ? esc_url($multi_text_country_link[$index]) : '#'; ?>">
                                        <?php echo pxl_print_html($text); ?>
                                    </a>
                                </p>
                                <?php if (!empty($icon_multi_text)) { ?>
                                    <div class="multi-icon"><i class="<?php echo esc_attr($icon_multi_text); ?>"></i></div>
                                <?php } else { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 20 20" width="20">
                                        <path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/>
                                    </svg>
                                <?php } ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
endforeach; 
}
function maiko_get_portfolio_list_layout1($posts = [], $settings = []){
    extract($settings); 
    $images_size = !empty($img_size) ? $img_size : '630x630';
    $count_pos = 1;

    foreach ($posts as $key => $post):
        $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $author = get_user_by('id', $post->post_author);
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Read More', 'maiko');
        $date_format = get_option('date_format');

        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }

        if(!empty($tax))
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
        else 
            $filter_class = '';
        
        $flag = false;
        $img_id = get_post_thumbnail_id($post->ID);
        $portfolio_excerpt = get_post_meta($post->ID, 'portfolio_excerpt', true);
        $portfolio_external_link = get_post_meta($post->ID, 'portfolio_external_link', true);
        $portfolio_icon_type = get_post_meta($post->ID, 'portfolio_icon_type', true);
        $portfolio_icon_font = get_post_meta($post->ID, 'portfolio_icon_font', true);
        $portfolio_icon_img = get_post_meta($post->ID, 'portfolio_icon_img', true); 
        $multi_text_country = get_post_meta($post->ID, 'multi_text_country', true);  
        $multi_text_country_link = get_post_meta($post->ID, 'multi_text_country_link', true);  
        $icon_multi_text = get_post_meta($post->ID, 'icon_multi_text', true);
        ?>
        <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
            <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                <div class="pxl-post--featured">
                    <?php echo wp_kses_post($thumbnail); ?>  
                    <a href="<?php if(!empty($portfolio_external_link)) { echo esc_url($portfolio_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"></a>
                    <?php if($portfolio_icon_type == 'icon' && !empty($portfolio_icon_font)) : ?>
                        <div class="pxl-post--icon">
                            <i class="<?php echo esc_attr($portfolio_icon_font); ?>"></i>
                        </div>
                    <?php endif; ?>
                    <?php if($portfolio_icon_type == 'image' && !empty($portfolio_icon_img)) : 
                        $icon_img = pxl_get_image_by_size( array(
                            'attach_id'  => $portfolio_icon_img['id'],
                            'thumb_size' => 'full',
                        ));
                        $icon_thumbnail = $icon_img['thumbnail'];
                        ?>
                        <div class="pxl-post--icon">
                            <?php echo wp_kses_post($icon_thumbnail); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="pxl-holder-content">
                    <div class="pxl-container">
                        <?php if($show_category == 'true'): ?>
                            <div class="pxl-post--category">
                                <div class="pxl-post--category-list">
                                    <?php the_terms( $post->ID, 'portfolio-category', '', '' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <h3 class="pxl-post--title">
                            <a href="<?php if(!empty($portfolio_external_link)) { echo esc_url($portfolio_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                        </h3>

                        <?php if (!empty($multi_text_country)): ?>
                            <ul class="multi-text">
                                <?php foreach ($multi_text_country as $index => $text): ?>
                                    <li class="box-multi">
                                        <p>
                                            <a href="<?php echo !empty($multi_text_country_link[$index]) ? esc_url($multi_text_country_link[$index]) : '#'; ?>">
                                                <?php echo pxl_print_html($text); ?>
                                            </a>
                                        </p>
                                        <?php if (!empty($icon_multi_text)) { ?>
                                            <div class="multi-icon"><i class="<?php echo esc_attr($icon_multi_text); ?>"></i></div>
                                        <?php } else { ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 20 20" width="20">
                                                <path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/>
                                            </svg>
                                        <?php } ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if($show_excerpt == 'true'): ?>
                            <div class="pxl-post--content">
                                <?php if($show_excerpt == 'true'): ?>
                                    <?php
                                    echo wp_trim_words( $post->post_excerpt, 20, null );
                                    ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if($show_readmore == 'true') : ?>
                            <div class="pxl-post--readmore">
                                <a class="btn-readmore btn btn-default" href="<?php if(!empty($portfolio_external_link)) { echo esc_url($portfolio_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                    <span class="pxl--btn-text"><?php if(!empty($button_text)) {
                                        echo esc_attr($button_text);
                                    } else {
                                        echo esc_html__('Read More', 'maiko');
                                    } ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 753.2 476.2" style="enable-background:new 0 0 753.2 476.2;" xml:space="preserve">
                                        <polygon points="622.6,107.5 601.4,128.7 695.8,223.1 277,223.1 277,253.1 695.8,253.1 601.4,347.5 622.6,368.7 753.2,238.1 "/>
                                        <rect y="223.1" width="283.9" height="30"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach; 
}
/*add_action( 'wp_ajax_maiko_get_filter_html', 'maiko_get_filter_html' );
add_action( 'wp_ajax_nopriv_maiko_get_filter_html', 'maiko_get_filter_html' );
function maiko_get_filter_html(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'maiko'));
        }
        $settings = $_POST['settings'];
        $loadmore_filter = $_POST['loadmore_filter'];
        if($loadmore_filter == '1'){
            set_query_var('paged', 1);
            $limit = isset($settings['limit'])?$settings['limit']:'6';
            $limitx = (int)$limit * (int)$settings['paged'];
        }else{
            set_query_var('paged', $settings['paged']);
            $limitx = isset($settings['limit'])?$settings['limit']:'6';
        }
        extract(pxl_get_posts_of_grid($settings['post_type'], [
                'source' => isset($settings['source'])?$settings['source']:'',
                'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
                'order' => isset($settings['order'])?$settings['order']:'desc',
                'limit' => $limitx,
                'post_ids' => isset($settings['post_ids'])?$settings['post_ids']: [],
            ],
            $settings['tax']
        ));
        ob_start(); ?>
        
        <span class="filter-item active" data-filter="*">
            <?php echo esc_html($settings['filter_default_title']); ?>
            <?php if($settings['show_cat_count'] == '1'): ?>
                <span class="filter-item-count"><?php echo count($posts); ?></span> 
            <?php endif; ?>
        </span>
        <?php foreach ($categories as $category):
            $category_arr = explode('|', $category);
            $term = get_term_by('slug',$category_arr[0], $category_arr[1]);
            $tax_count = 0;
            foreach ($posts as $key => $post){
                $this_terms = get_the_terms( $post->ID,  $settings['tax'][0] );
                $term_list = [];
                foreach ($this_terms as $t) {
                    $term_list[] = $t->slug;
                } 
                if(in_array($term->slug,$term_list))
                    $tax_count++;
            } 
            if($tax_count > 0): ?>
                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                    <?php if($settings['show_cat_count'] == '1'): ?>
                        <span class="filter-item-count"><?php echo esc_attr($tax_count); ?></span> 
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'maiko'),
                'data' => array(
                    'html' => $html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}
*/
