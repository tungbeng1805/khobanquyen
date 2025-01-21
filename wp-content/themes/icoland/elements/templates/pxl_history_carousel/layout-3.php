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
    <div class="pxl-swiper-sliders pxl-history-carousel pxl-history-carousel3 <?php echo esc_attr($settings['style']); ?>" data-view-auto="<?php echo esc_attr($col_xl); ?>" data-show-arrow="<?php echo esc_attr($arrows); ?>">
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
            <div class="wrap-navigation-carousel">
                <?php if($arrows !== 'false'): 
                    $mouse_move_animation = icoland()->get_theme_opt('mouse_move_animation', false); 
                    ?>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>">
                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28 0.5C43.1878 0.5 55.5 12.8122 55.5 28C55.5 43.1878 43.1878 55.5 28 55.5C12.8122 55.5 0.5 43.1878 0.5 28C0.5 12.8122 12.8122 0.5 28 0.5ZM42.3854 28.625C42.3854 27.2443 41.2661 26.125 39.8854 26.125H23.4209L30.4031 19.1428C31.3795 18.1665 31.3795 16.5835 30.4031 15.6072C29.4268 14.6309 27.8439 14.6309 26.8676 15.6072L15.6194 26.8555C15.6134 26.8615 15.6073 26.8675 15.6014 26.8736C15.3697 27.1095 15.1943 27.3799 15.0751 27.668C14.9537 27.9606 14.8864 28.2813 14.8854 28.6175L14.8854 28.625L14.8854 28.6325C14.8874 29.3116 15.1601 29.927 15.6014 30.3764C15.6073 30.3825 15.6134 30.3885 15.6194 30.3945L26.8676 41.6428C27.8439 42.6191 29.4268 42.6191 30.4031 41.6428C31.3795 40.6665 31.3795 39.0835 30.4031 38.1072L23.4209 31.125H39.8854C41.2661 31.125 42.3854 30.0057 42.3854 28.625Z" stroke="#210A5C" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next <?php if($mouse_move_animation) { echo 'pxl-mouse-effect'; } ?>"><svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28 0.5C12.8122 0.5 0.5 12.8122 0.5 28C0.5 43.1878 12.8122 55.5 28 55.5C43.1878 55.5 55.5 43.1878 55.5 28C55.5 12.8122 43.1878 0.5 28 0.5ZM13.6146 28.625C13.6146 27.2443 14.7339 26.125 16.1146 26.125H32.5791L25.5969 19.1428C24.6205 18.1665 24.6205 16.5835 25.5969 15.6072C26.5732 14.6309 28.1561 14.6309 29.1324 15.6072L40.3806 26.8555C40.3866 26.8615 40.3927 26.8675 40.3986 26.8736C40.6303 27.1095 40.8057 27.3799 40.9249 27.668C41.0463 27.9606 41.1136 28.2813 41.1146 28.6175L41.1146 28.625L41.1146 28.6325C41.1126 29.3116 40.8399 29.927 40.3986 30.3764C40.3927 30.3825 40.3866 30.3885 40.3806 30.3945L29.1324 41.6428C28.1561 42.6191 26.5732 42.6191 25.5969 41.6428C24.6205 40.6665 24.6205 39.0835 25.5969 38.1072L32.5791 31.125H16.1146C14.7339 31.125 13.6146 30.0057 13.6146 28.625Z" fill="#210A5C"/>
                    </svg>
                </div>
            <?php endif; ?>
            <?php if($pagination !== 'false'): ?>
                <div class="pxl-swiper-dots"></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>
