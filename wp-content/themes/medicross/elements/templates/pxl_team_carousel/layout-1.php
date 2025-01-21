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
?>
<?php if(isset($settings['team']) && !empty($settings['team']) && count($settings['team'])): 
$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full'; ?>
<div class="pxl-swiper-slider pxl-team pxl-team-carousel1 " <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'medicross'); ?>"<?php endif; ?>>
    <div class="pxl-carousel-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper">
                <?php foreach ($settings['team'] as $key => $value):
                    $title = isset($value['title']) ? $value['title'] : '';
                    $position = isset($value['position']) ? $value['position'] : '';
                    $desc = isset($value['desc']) ? $value['desc'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    $link_key = $widget->get_repeater_setting_key( 'item_link', 'value', $key );
                    if ( ! empty( $value['item_link']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $value['item_link']['url'] );

                        if ( $value['item_link']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $value['item_link']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                    $social = isset($value['social']) ? $value['social'] : '';
                    if(!empty($image['id'])) { ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <?php if(!empty($image['id'])) { 
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $image['id'],
                                        'thumb_size' => $image_size,
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail'];
                                    $thumbnail_url = $img['url'];
                                    ?>
                                    <div class="pxl-item--image" style="background-image:url(<?php echo esc_url($thumbnail_url); ?>);">
                                        <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                        </a>
                                        <?php if(!empty($social)): ?>
                                            <div class="pxl-social--wrap">
                                                <div class="pxl-social">
                                                    <?php  $team_social = json_decode($social, true); ?>
                                                    <?php foreach ($team_social as $value): ?>
                                                        <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                                    <?php endforeach; ?>
                                                    <a ><i class="fas fa-share-alt"></i></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                <div class="pxl-item--holder ">
                                    <div class="pxl-item--meta pxl-flex-grow ">
                                        <h3 class="pxl-item--title">    
                                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php echo pxl_print_html($title); ?></a>
                                        </h3>
                                        <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                                        <div class="pxl-item--desc"><?php echo pxl_print_html($desc); ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if($pagination !== false): ?>
            <div class="pxl-swiper-dots style-1"></div>
        <?php endif; ?>

        <?php if($arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-1">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev" tabindex="0" role="button" aria-label="previous slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
                    <i class="flaticon flaticon-next"></i>
                </div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next" tabindex="0" role="button" aria-label="next slide" aria-controls="swiper-wrapper-5f10c24cfcd53105d">
                    <i class="flaticon flaticon-next" style="transform:scaleX(-1);"></i>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
