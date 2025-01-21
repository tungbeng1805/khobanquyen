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
if(isset($settings['text3']) && !empty($settings['text3']) && count($settings['text3'])): ?>
    <div class="pxl-swiper-slider pxl-text-carousel pxl-text-carousel2" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['text3'] as $key => $value):
                        $title3 = isset($value['title3']) ? $value['title3'] : '';
                        $icon_type = isset($value['icon_type']) ? $value['icon_type'] : '';
                        $pxl_icon = isset($value['pxl_icon']) ? $value['pxl_icon'] : '';
                        $icon_image = isset($value['icon_image']) ? $value['icon_image'] : '';
                        $desc3 = isset($value['desc3']) ? $value['desc3'] : '';
                        $link_key = $widget->get_repeater_setting_key( 'icon_link', 'value', $key );
                        if ( ! empty( $value['icon_link']['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $value['icon_link']['url'] );

                            if ( $value['icon_link']['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $value['icon_link']['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <?php if ( $icon_type == 'icon' && !empty($pxl_icon['value']) ) : ?>
                                    <div class="pxl-item--icon">
                                        <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                            <?php \Elementor\Icons_Manager::render_icon( $pxl_icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $icon_type == 'image' && !empty($icon_image['id']) ) : ?>
                                    <div class="pxl-item--icon">
                                        <?php $img_icon  = pxl_get_image_by_size( array(
                                            'attach_id'  => $icon_image['id'],
                                            'thumb_size' => 'full',
                                        ) );
                                        $thumbnail_icon    = $img_icon['thumbnail'];
                                        echo pxl_print_html($thumbnail_icon); ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="pxl-item--title el-empty"><?php echo pxl_print_html($title3); ?></h3>
                                <span class="pxl-item--dot"><span class="divider"></span></span>
                                <div class="pxl-item--desc el-empty"><?php echo pxl_print_html($desc3); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <?php if($pagination !== false || $arrows !== false): ?>
            <div class="pxl-swiper-bottom pxl-flex-middle">
                <?php if($pagination !== false): ?>
                    <div class="pxl-swiper-dots style-1"></div>
                <?php endif; ?>
                <?php if($arrows !== false): ?>
                    <div class="pxl-wrap-arrow pxl-flex-middle">
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="flaticon flaticon-right-arrow11 rtl-icon" style="transform:scalex(-1);"></i></div>
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="flaticon flaticon-right-arrow11 rtl-icon"></i></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
