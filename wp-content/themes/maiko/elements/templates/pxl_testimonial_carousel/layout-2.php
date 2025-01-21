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
$opts_thumb = [
    'slide_direction'               => 'horizontal',
    'slides_to_show'                => '2', 
    'slide_mode'                    => 'slide',
    'loop'                          => true,
];

$widget->add_render_attribute( 'thumb', [
    'class'         => 'pxl-swiper-thumbs',
    'data-settings' => wp_json_encode($opts_thumb)
]);

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel2" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('drag', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'thumb' )); ?>>
                <div class="swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value_top):
                        $title = isset($value_top['title']) ? $value_top['title'] : '';
                        $position = isset($value_top['position']) ? $value_top['position'] : '';
                        $image = isset($value_top['image']) ? $value_top['image'] : '';
                        $star = isset($value_top['star']) ? $value_top['star'] : '';
                        ?>
                        <div class="swiper-slide">
                            <div class="pxl-item--inner">
                                <?php if(!empty($image['id'])) { 
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $image['id'],
                                        'thumb_size' => 'full',
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail'];?>
                                    <div class="pxl-item--image">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (!empty($settings['link']['url'])): ?>
                        <div class="swiper-slide swiper-slide-visible link-more">
                            <?php if ( ! empty( $settings['link']['url'] ) ) {
                                $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );

                                if ( $settings['link']['is_external'] ) {
                                    $widget->add_render_attribute( 'link', 'target', '_blank' );
                                }

                                if ( $settings['link']['nofollow'] ) {
                                    $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
                                } ?>

                            <?php } ?>
                            <a <?php pxl_print_html($widget->get_render_attribute_string( 'link' )); ?>>
                                <span></span>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <div class="pxl-item--desc el-empty"><?php echo pxl_print_html($desc); ?></div>
                                <div class="pxl-item--meta meta-top">
                                    <h3 class="pxl-item--title el-empty"><?php echo pxl_print_html($title); ?></h3>
                                    <?php if (!empty($star)) { ?>
                                        <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                            <svg  width="800px" version="1.1" id="capa_1" viewbox="0 0 53.867 53.867">
                                                <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                            </svg>
                                            <svg  width="800px" version="1.1" id="capa_1" viewbox="0 0 53.867 53.867">
                                                <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                            </svg>
                                            <svg  width="800px" version="1.1" id="capa_1" viewbox="0 0 53.867 53.867">
                                                <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                            </svg>
                                            <svg  width="800px" version="1.1" id="capa_1" viewbox="0 0 53.867 53.867">
                                                <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                            </svg>
                                            <svg  width="800px" version="1.1" id="capa_1" viewbox="0 0 53.867 53.867">
                                                <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                            </svg>
                                        </div>
                                    <?php } ?>
                                    <div class="pxl-item--position el-empty"><?php echo pxl_print_html($position); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>
        <?php if($arrows !== false): ?>
            <div class="pxl-wrap-arrow pxl-flex-middle">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="33px" height="35px" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
                </div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="33px" height="35px" data-name="Layer 1" viewBox="0 0 57.7 60.45"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polyline class="cls-1" points="26.8 0.71 56.28 30.23 26.8 59.74"/><line class="cls-1" x1="56.28" y1="30.23" y2="30.23"/></svg>
                </div>
            </div>
        <?php endif; ?>
        <?php if($pagination !== false ): ?>
            <div class="pxl-swiper-bottom pxl-flex-middle">
                <?php if($pagination !== false): ?>
                    <div class="pxl-swiper-dots style-1"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>
