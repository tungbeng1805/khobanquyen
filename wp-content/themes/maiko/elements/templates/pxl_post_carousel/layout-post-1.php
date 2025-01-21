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
$show_date = $widget->get_setting('show_date');
$num_words = $widget->get_setting('num_words');
$show_button = $widget->get_setting('show_button');
$button_text = $widget->get_setting('button_text');
$show_category = $widget->get_setting('show_category');
$show_author = $widget->get_setting('show_author');
$show_comment = $widget->get_setting('show_comment');

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
    <div class="pxl-swiper-slider pxl-post-carousel pxl-post-carousel1 pxl-post-style1 " <?php if($drap !== false): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php
                    $image_size = !empty($img_size) ? $img_size : 'full';
                    foreach ($posts as $post):
                        $img_id       = get_post_thumbnail_id( $post->ID );
                        $author = get_user_by('id', $post->post_author); ?>
                        <div class="pxl-swiper-slide">
                            <div class="wrap-inner-content">
                                <div class="pxl-item--holder">
                                    <div class="pxl-item-top">
                                        <?php if ($show_date == 'true'): ?>
                                            <span class="pxl-item--date">
                                                <span class="icon-post"><i class="fas fa-calendar"></i> </span>
                                                <?php echo get_the_date('d M y'); ?>
                                            </span> 
                                        <?php endif ?>

                                        <?php if ($show_author == 'true'): ?>
                                            <span class="post-author align-items-center">
                                                <span class="author-avatar">
                                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' ); ?>
                                                </span>
                                                <span><?php echo esc_html__('By', 'maiko'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
                                            </span>
                                        <?php endif ?>

                                        <?php if ($show_category == 'true'): ?>
                                            <span class="post-category  align-items-center">
                                                <span class="icon-post"><i class="flaticon-tag"></i></span>
                                                <?php the_terms( $post->ID, 'category', '', ' , ' ); ?>
                                            </span> 
                                        <?php endif ?>

                                        <?php if ($show_comment == 'true'): ?>
                                            <span class="post-comments  align-items-center">
                                                <span class="icon-post"><i class="caseicon-comment-solid"></i></span>
                                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                                    <span><?php comments_number(esc_html__('No Comment', 'maiko'), esc_html__(' 1 Comment', 'maiko'), esc_html__('%'.' Comments', 'maiko'),$post->ID); ?></span>
                                                </a>
                                            </span>
                                        <?php endif ?>
                                    </div>
                                    <h5 class="pxl-item--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h5>
                                    <?php if ($show_excerpt == 'true'): ?>
                                        <div class="item--content">
                                            <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($show_button == 'true'): ?>
                                        <div class="btn-readmore">
                                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                                <span class="btn--text">
                                                    <?php if(!empty($button_text)) {
                                                        echo pxl_print_html($button_text);
                                                    } else {
                                                        echo esc_html__('find out more', 'maiko');
                                                    } ?>
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" x="0" y="0" viewBox="0 0 1560 1560" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(1,0,0,1,4.999999999999545,4.547473508864641e-13)"><path d="M1524 811.8H36c-17.7 0-32-14.3-32-32s14.3-32 32-32h1410.7l-194.2-194.2c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l248.9 248.9c9.2 9.2 11.9 22.9 6.9 34.9-5 11.9-16.7 19.7-29.6 19.7z" fill="#ffffff" opacity="1" data-original="#000000"></path><path d="M1274.8 1061c-8.2 0-16.4-3.1-22.6-9.4-12.5-12.5-12.5-32.8 0-45.3l249.2-249.2c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-249.2 249.2c-6.3 6.3-14.5 9.4-22.7 9.4z" fill="#ffffff" opacity="1" data-original="#000000"></path></g></svg>
                                            </a>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                                $img          = pxl_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $image_size
                                ) );
                                $thumbnail    = $img['thumbnail'];
                                $thumbnail_url    = $img['url'];
                                ?>
                                <div class="pxl-item--featured" style="background-image: url(<?php echo esc_attr($thumbnail_url); ?>);">
                                    <?php if (!empty($settings['note_post'])) { ?>
                                        <span class="note-post">
                                            <?php echo pxl_print_html($settings['note_post']); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>
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
        <div class="pxl-swiper-arrow-wrap style-2">
            <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
              <svg width="33" height="35" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
          </div>
          <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
              <svg width="33" height="35" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
      </div>
  </div>
<?php endif; ?>
</div>
<?php endif; ?>