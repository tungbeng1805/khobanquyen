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
extract(pxl_get_posts_of_grid('service', [
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
    'center_slide'                  => (bool)$center, 
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
    <div class="pxl-swiper-slider pxl-service-carousel pxl-service-carousel1 pxl-service-style1 <?php echo esc_attr($settings['service_style_l1']); ?>" <?php if($drap !== false): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner ">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php
                    $count_pos = 1;
                    foreach ($posts as $post):
                        $service_main_color = get_post_meta($post->ID, 'service_main_color', true);
                        $service_excerpt = get_post_meta($post->ID, 'service_excerpt', true);
                        $service_external_link = get_post_meta($post->ID, 'service_external_link', true);
                        $service_icon_type = get_post_meta($post->ID, 'service_icon_type', true);
                        $service_icon_font = get_post_meta($post->ID, 'service_icon_font', true);
                        $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true);
                        $multi_text_country = get_post_meta($post->ID, 'multi_text_country', true);  
                        $multi_text_country_link = get_post_meta($post->ID, 'multi_text_country_link', true);  
                        $icon_multi_text = get_post_meta($post->ID, 'icon_multi_text', true);
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-post--inner  <?php echo esc_attr($pxl_animate); ?>">
                                <div class="pxl-post--holder">
                                    <h3 class="pxl-post--title">
                                        <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                    </h3>
                                    <div class="pxl-divider"></div>
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
                                    <div class="pxl-divider"></div>
                                    <?php if($show_excerpt == 'true'): ?>
                                        <div class="pxl-post--content">
                                            <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($show_button == 'true') : ?>
                                        <div class="pxl-post--readmore">
                                            <a class="btn-readmore" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                                <span><?php if(!empty($button_text)) {
                                                    echo pxl_print_html($button_text);
                                                } else {
                                                    echo esc_html__('find out more', 'maiko');
                                                } ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pxl-post--overlay">
                                    <h3 class="pxl-post--title">
                                        <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                    </h3>
                                    <div class="pxl-divider"></div>
                                    <?php if (!empty($multi_text_country)): ?>
                                        <ul class="multi-text">
                                            <?php foreach ($multi_text_country as $index => $text): ?>
                                                <li class="box-multi">
                                                    <a href="<?php echo !empty($multi_text_country_link[$index]) ? esc_url($multi_text_country_link[$index]) : '#'; ?>">
                                                        <?php echo pxl_print_html($text); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php if($show_button == 'true') : ?>
                                        <div class="pxl-post--readmore">
                                            <a class="btn-readmore" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                                                <span><?php if(!empty($button_text)) {
                                                    echo pxl_print_html($button_text);
                                                } else {
                                                    echo esc_html__('find out more', 'maiko');
                                                } ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="whipe overlay_bg"></div>
                                </div>
                            </div>
                        </div>    
                    <?php endforeach; ?>
                </div> 
            </div>
            <?php if($pagination !== false): ?>
                <div class="pxl-swiper-dots style-1"></div>
            <?php endif; ?>

            <?php if($arrows !== false): ?>
                <div class="pxl-swiper-arrow-wrap style-2">
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 57.7 60.45"><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
                    </div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 57.7 60.45"><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>