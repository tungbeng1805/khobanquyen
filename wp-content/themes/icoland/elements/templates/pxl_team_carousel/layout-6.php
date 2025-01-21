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
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');
$arrows = $widget->get_setting('arrows','false');  
$dots = $widget->get_setting('dots','false');
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
    'dots'                          => $dots,
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
?>
<?php if(isset($settings['team']) && !empty($settings['team']) && count($settings['team'])): ?>
<div class="pxl-swiper-sliders pxl-team pxl-team-carousel6">
    <div class="pxl-carousel-inner">
        
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper">
                <?php foreach ($settings['team'] as $key => $value):
                 $title = isset($value['title']) ? $value['title'] : '';
                 $image = isset($value['image']) ? $value['image'] : '';
                 $link_key = $widget->get_repeater_setting_key( 'btn_link', 'value', $key );
                 if ( ! empty( $value['btn_link']['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $value['btn_link']['url'] );

                    if ( $value['btn_link']['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $value['btn_link']['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                <div class="pxl-swiper-slide ">
                    <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                        <?php if(!empty($image['id'])) { 
                            $img = pxl_get_image_by_size( array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => 'full',
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail = $img['thumbnail'];
                            ?>
                            <div class="pxl-item--image">
                                <?php echo wp_kses_post($thumbnail); ?>
                                
                            </div>
                        <?php } ?>
                        <div class="pxl-item--holder pxl-item--front">
                            <h5 class="pxl-item--title">    
                                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                    <i class="fab fa-twitter"></i>
                                    <?php echo pxl_print_html($title); ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if($arrows !== 'false'): 
        $mouse_move_animation = icoland()->get_theme_opt('mouse_move_animation', false); 
        ?>
        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>" data-cursor-label="<?php echo esc_html('Prev', 'icoland'); ?>"><i class="caseicon-angle-arrow-left"></i></div>
        <div class="pxl-swiper-arrow pxl-swiper-arrow-next <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>" data-cursor-label="<?php echo esc_html('Next', 'icoland'); ?>"><i class="caseicon-angle-arrow-right"></i></div>
    <?php endif; ?>
    <?php if($dots !== 'false'): ?>
        <div class="pxl-swiper-thumbs " >
            <div class="swiper-wrapper">
                <?php foreach ($settings['team'] as $key => $value_top):
                    $image = isset($value_top['image']) ? $value_top['image'] : '';
                    ?>
                    <div class="swiper-slide">
                        <div class="pxl-item--inner">
                            <?php if(!empty($image['id'])) { 
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $image['id'],
                                    'thumb_size' => 'full',
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="pxl-item--image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
<?php endif; ?>
