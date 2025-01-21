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
if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel1" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'maiko'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <div class="pxl-item--desc el-empty"><?php echo pxl_print_html($desc); ?></div>
                                <div class="content-bottom">
                                    <div class="pxl-item--holder pxl-flex-middle">
                                        <?php if(!empty($image['id'])) { 
                                            $img = pxl_get_image_by_size( array(
                                                'attach_id'  => $image['id'],
                                                'thumb_size' => '90x90',
                                                'class' => 'no-lazyload',
                                            ));
                                            $thumbnail = $img['thumbnail'];?>
                                            <div class="pxl-item--avatar ">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="pxl-item--meta">
                                            <h3 class="pxl-item--title el-empty"><?php echo pxl_print_html($title); ?></h3>
                                            <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                                <svg  width="800px" version="1.1" id="Capa_1" viewBox="0 0 53.867 53.867">
                                                    <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                                </svg>
                                                <svg  width="800px" version="1.1" id="Capa_1" viewBox="0 0 53.867 53.867">
                                                    <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                                </svg>
                                                <svg  width="800px" version="1.1" id="Capa_1" viewBox="0 0 53.867 53.867">
                                                    <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                                </svg>
                                                <svg  width="800px" version="1.1" id="Capa_1" viewBox="0 0 53.867 53.867">
                                                    <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                                </svg>
                                                <svg  width="800px" version="1.1" id="Capa_1" viewBox="0 0 53.867 53.867">
                                                    <polygon  points="26.934,1.318 35.256,18.182 53.867,20.887 40.4,34.013 43.579,52.549 26.934,43.798 10.288,52.549 13.467,34.013 0,20.887 18.611,18.182 "/>
                                                </svg>
                                            </div>
                                            <div class="pxl-item--position el-empty"><?php echo pxl_print_html($position); ?></div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="13" viewBox="0 0 36 13">
                              <image id="right-arrow_copy" data-name="right-arrow copy" width="36" height="13" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAANCAYAAADBo8xmAAAA2klEQVQ4jcXVMUtCURiH8Z/hFARxtSXqCwTOQZO6iOYU+AWc7Rv4jVylaEldouYGFzelqVqEWuPACSTuot7ufeBs57w8vO//nFNKKidSuMYtbvCVtuG/OEip28QI5zjMU0aK0BXGeEML70UKXeIeH6hjlbfMplANd1ijUZRMoIwLPOIYQ5zFtS/VXUYebtlzHFfWfCLZtmboUB+zeHiAeUZiO3dIzNAU3zHQi4yktuY31K/o4AiTjDK0l1DgBW1UYrcKkfr7MD6hi1M8xBwUKhQIT0APy7z/MfgBkSIg7SlpxHYAAAAASUVORK5CYII="/>
                          </svg>
                      </div>
                      <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="13" viewBox="0 0 36 13">
                          <image id="right-arrow" width="36" height="13" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAANCAYAAADBo8xmAAAAzklEQVQ4jc3UsUrCURzF8U/iktCitYhuLQ3NQUsaUourL+Ar1VsITVq0VJPg3CMYTeUSuCY/uMJft8S8nvF3uL/75XDuPajWTuxYFTzgDqP1q0u7pklATQxwvQ9AX7jFJ4a4zA0U+kAL33jCRW6gJVQbP3jEeQyj1K0Nlh2n6LehM9xjhqsA+t1gaRyubgmoqEk5xfZX/VdC/Rz/UFGneMNhKvl7OSNMA684wk3AxDAXUCMlU0MnurM0cjz76N8z6uhiXDRzAM0xRQ8vKw4WE90hPFIi668AAAAASUVORK5CYII="/>
                      </svg>
                  </div>
              </div>
          <?php endif; ?>
      </div>
  <?php endif; ?>

</div>
<?php endif; ?>
