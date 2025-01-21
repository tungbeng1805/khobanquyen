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
if(isset($settings['history']) && !empty($settings['history']) && count($settings['history'])): ?>
    <div class="wrap-history-carousel2">
        <div class="pxl-swiper-sliders pxl-history-carousel pxl-history-carousel2 <?php echo esc_attr($settings['style']); ?>" data-view-auto="<?php echo esc_attr($col_xl); ?>" data-show-arrow="<?php echo esc_attr($arrows); ?>">
            <img class="prg" src="<?php echo esc_url(get_template_directory_uri().'/assets/img/prb.png'); ?>" alt="<?php echo esc_attr__('pr', 'icoland'); ?>" />
            <div class="pxl-carousel-inner">
                <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                    <div class="pxl-swiper-wrapper">
                        <?php foreach ($settings['history'] as $key => $value):
                            $title = isset($value['title']) ? $value['title'] : '';
                            $desc = isset($value['desc']) ? $value['desc'] : '';
                            $date = isset($value['date']) ? $value['date'] : '';
                            $it_active = isset($value['it_active']) ? $value['it_active'] : '';
                            ?>
                            <div class="pxl-swiper-slide <?php echo esc_attr($it_active); ?>">
                                <div class="corner-box">
                                    <div class="dot"></div>
                                    <div class="pxl-item--inner  <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                        <div class="pxl-item--holder">
                                            <div class="date"><?php echo pxl_print_html($date); ?></div>
                                            <div class="title"><?php echo pxl_print_html($title); ?></div>
                                            <div class="desc"><?php echo pxl_print_html($desc); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="wrap-arrow">
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
