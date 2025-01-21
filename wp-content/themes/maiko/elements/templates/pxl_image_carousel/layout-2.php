 <?php
 $col_xs = $widget->get_setting('col_xs', '');
 $col_sm = $widget->get_setting('col_sm', '');
 $col_md = $widget->get_setting('col_md', '');
 $col_lg = $widget->get_setting('col_lg', '');
 $col_xl = $widget->get_setting('col_xl', '');
 $col_xxl = $widget->get_setting('col_xxl', '');
 if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$arrows = $widget->get_setting('arrows', false);  
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);  
$speed = $widget->get_setting('speed', '500');
$drap = $widget->get_setting('drap', false);  
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => (int)$col_xl,
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$pxl_g_id = uniqid();
$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
if(isset($settings['image_2']) && !empty($settings['image_2']) && count($settings['image_2'])): ?>
    <div id="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>" class="pxl-swiper-slider pxl-image-carousel pxl-image-carousel2 <?php echo esc_attr($settings['style']); ?>" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['image_2'] as $key => $value):
                        $image_2 = isset($value['image_2']) ? $value['image_2'] : '';
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        $url_video = isset($value['url_video']) ? $value['url_video'] : '';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <?php if(!empty($image_2['id'])) { 
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $image_2['id'],
                                        'thumb_size' => $image_size,
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail'];
                                    $thumbnail_url = $img['url'];
                                    ?>
                                    <div class="pxl-item--image ">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                        <?php if (!empty($url_video)): ?>
                                            <a class="pxl-btn-video pxl-action-popup " href="<?php echo esc_url($url_video); ?>">
                                                <i class="caseicon-play1"></i>
                                            </a>
                                        <?php endif ?>

                                    </div>
                                    <div class="wrap-content">
                                        <div class="top-content">
                                            <h3 class="pxl-item--title">    
                                                <?php echo pxl_print_html($title); ?>
                                            </h3>
                                            <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 245">
                                                    <path d="m56,237 74-228 74,228L10,96h240"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 245">
                                                    <path d="m56,237 74-228 74,228L10,96h240"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 245">
                                                    <path d="m56,237 74-228 74,228L10,96h240"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 245">
                                                    <path d="m56,237 74-228 74,228L10,96h240"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 245">
                                                    <path d="m56,237 74-228 74,228L10,96h240"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <?php if($pagination !== false || $arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-2">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev" tabindex="0" role="button" aria-label="previous slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
                    <svg width="20" height="38" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path stroke="#000" id="svg_3" d="m20.21811,38.88319l-19.7456,-20.72803" opacity="undefined" stroke-linecap="undefined" stroke-linejoin="undefined" fill="none"></path>
                            <path stroke="#000" id="svg_5" d="m20.00751,-0.49215l-19.55631,19.26847" opacity="undefined" stroke-linecap="undefined" stroke-linejoin="undefined" fill="none"></path>
                        </g>
                    </svg>
                </div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next" tabindex="0" role="button" aria-label="next slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
                    <svg width="20" height="38" xmlns="http://www.w3.org/2000/svg">
                     <g>
                        <path stroke="#000" id="svg_3" d="m20.21811,38.88319l-19.7456,-20.72803" opacity="undefined" stroke-linecap="undefined" stroke-linejoin="undefined" fill="none"></path>
                        <path stroke="#000" id="svg_5" d="m20.00751,-0.49215l-19.55631,19.26847" opacity="undefined" stroke-linecap="undefined" stroke-linejoin="undefined" fill="none"></path>
                    </g>
                </svg>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
