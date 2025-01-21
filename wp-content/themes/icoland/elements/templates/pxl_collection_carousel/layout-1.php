<?php
$html_id = pxl_get_element_id($settings);
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
$arrows = $widget->get_setting('arrows','false');  
$hover_animate = $widget->get_setting('hover_animate','false');  
$pagination = $widget->get_setting('pagination','false');
$pagination_type = $widget->get_setting('pagination_type','bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite','false');  
$speed = $widget->get_setting('speed', '500');
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => '1', 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => $col_xl,
    'slides_to_show_xxl'             => $col_xxl,  
    'slides_to_show_lg'             => $col_lg, 
    'slides_to_show_md'             => $col_md, 
    'slides_to_show_sm'             => $col_sm, 
    'slides_to_show_xs'             => $col_xs, 
    'slides_to_scroll'              => $slides_to_scroll,
    'arrow'                         => $arrows,
    'pagination'                    => $pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => $autoplay,
    'pause_on_hover'                => $pause_on_hover,
    'pause_on_interaction'          => 'true',
    'delay'                         => $autoplay_speed,
    'loop'                          => $infinite,
    'speed'                         => $speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$gradient_color = icoland()->get_opt( 'gradient_color' );
if(isset($settings['collection']) && !empty($settings['collection']) && count($settings['collection'])): ?>
    <div class="pxl-swiper-sliders pxl-collection-carousel pxl-collection-carousel1 <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?> <?php echo esc_attr($settings['style_arr']); ?>" data-view-auto="<?php echo esc_attr($col_xl); ?>" data-show-arrow="<?php echo esc_attr($arrows); ?>">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['collection'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $image_quote = isset($value['image_quote']) ? $value['image_quote'] : '';
                        $link_key = $widget->get_repeater_setting_key( 'link', 'value', $key );
                        if ( ! empty( $value['link']['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

                            if ( $value['link']['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $value['link']['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
                        ?>
                        <div class="pxl-swiper-slide">
                            <?php if(!empty($image['id'])) { 
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $image['id'],
                                    'thumb_size' => 'full',
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                            <?php } ?>

                            <div class="wrap-inner-content">
                                <div class="pxl-item--inner " data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                    <div class="bg-collection" style="background-image: url(<?php echo esc_attr($value['image']['url']);?>)">
                                    </div>
                                    <?php if(!empty($image_quote['id'])) { 
                                        $img_quote = pxl_get_image_by_size( array(
                                            'attach_id'  => $image_quote['id'],
                                            'thumb_size' => 'full',
                                            'class' => 'no-lazyload',
                                        ));
                                        $thumbnail_2 = $img_quote['thumbnail'];
                                        ?>
                                    <?php } ?>
                                    <div class="author-collection">
                                        <?php echo wp_kses_post($thumbnail_2); ?>
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="pxl-item--holder">
                                        <h5 class="pxl-item--title">    
                                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                                <?php echo pxl_print_html($title); ?>
                                            </a>
                                        </h5>
                                        <div class="pxl-item--position">
                                            <?php echo pxl_print_html($position); ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if($arrows !== 'false'): 
                $mouse_move_animation = icoland()->get_theme_opt('mouse_move_animation', false); 
                ?>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>" data-cursor-label="<?php echo esc_html('Prev', 'icoland'); ?>"><i class="fal fa-chevron-left"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>" data-cursor-label="<?php echo esc_html('Next', 'icoland'); ?>"><i class="fal fa-chevron-right"></i></div>
            <?php endif; ?>
            <?php if($pagination !== 'false'): ?>
                <div class="pxl-swiper-dots"></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
