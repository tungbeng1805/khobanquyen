<?php
$html_id = pxl_get_element_id($settings);
$select_post_by = $widget->get_setting('select_post_by', '');
$source = $post_ids = [];
if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
}
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$settings['layout']    = $settings['layout_'.$settings['post_type']];
extract(pxl_get_posts_of_grid('post', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

$pxl_animate = $widget->get_setting('pxl_animate', '');
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows', false);
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', '500');
$center = $widget->get_setting('center', false);
$drap = $widget->get_setting('drap', false);

$img_size = $widget->get_setting('img_size');
$show_excerpt = $widget->get_setting('show_excerpt');
$num_words = $widget->get_setting('num_words');
$show_date = $widget->get_setting('show_date');
$show_category = $widget->get_setting('show_category');
$show_date = $widget->get_setting('show_date');
$show_button = $widget->get_setting('show_button');
$button_text = $widget->get_setting('button_text');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_percolumnfill'           => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => (int)$col_xl, 
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs,  
    'slides_to_scroll'              => (int)$slides_to_scroll,  
    'slides_gutter'                 => 30, 
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed,
    'center'                        => (bool)$center,
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]); ?>

<?php if (is_array($posts)): ?>
    <div class="pxl-swiper-slider pxl-post-carousel pxl-post-carousel2 <?php echo pxl_print_html($settings['style_l11'])?>" <?php if($drap !== false): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php
                    $image_size = !empty($img_size) ? $img_size : '410x505';
                    foreach ($posts as $post):
                        $img_id       = get_post_thumbnail_id( $post->ID );
                        $author = get_user_by('id', $post->post_author); ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                                $img_id = get_post_thumbnail_id($post->ID);
                                $img          = pxl_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $image_size
                                ) );
                                $thumbnail    = $img['thumbnail'];
                                ?>
                                <div class="pxl-post--featured hover-imge-effect2">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>

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
                                    <?php if ($show_date == 'true'): ?>
                                        <div class="post-date">
                                            <div class="date-day"><?php echo get_the_date('d', $post->ID)  ?></div>
                                            <div class="year-month">
                                                <span class="date-month"><?php echo get_the_date('M', $post->ID)  ?></span>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($show_category == 'true'): ?>
                                        <div class="pxl-post--category">
                                            <?php the_terms( $post->ID, 'category', '', ', ' ); ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            <?php endif; ?>
                            <div class="pxl-inner-content">
                                <h3 class="pxl-post--title "><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                                <div class="pxl-post--content">
                                    <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> 
        </div>

    </div>
    <?php if($pagination !== false): ?>
        <div class="pxl-swiper-dots style-1"></div>
    <?php endif; ?>

    <?php if($arrows !== false): ?>
        <div class="pxl-swiper-arrow-wrap style-1">
            <div class="pxl-swiper-arrow pxl-swiper-arrow-prev" tabindex="0" role="button" aria-label="previous slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
             <svg xmlns="http://www.w3.org/2000/svg" width="33" height="35" id="Layer_1" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
         </div>
         <div class="pxl-swiper-arrow pxl-swiper-arrow-next" tabindex="0" role="button" aria-label="next slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="33" height="35" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
        </div>
    </div>
<?php endif; ?>
</div>
<?php endif; ?>