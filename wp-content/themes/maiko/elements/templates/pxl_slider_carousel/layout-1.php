<?php
$html_id = pxl_get_element_id($settings);
extract($settings);

$ids = esc_attr('grad-'.$html_id);
$ids1 = esc_attr('grad1-'.$html_id);

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
$allow_touchmove = $widget->get_setting('allow_touchmove','false');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');
$arrows = $widget->get_setting('arrows','false');
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
    'slide_mode'                    => 'fade',
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
    'speed'                         => (int)$speed,
    'allow_touch_move'              => false
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if(isset($settings['slider1']) && !empty($settings['slider1']) && count($settings['slider1'])): ?>
    <div class="pxl-swiper-slider pxl-slider-carousel pxl-slider-carousel1 pxl-drag-area pxl-parent-transition pxl-parent-cursor pxl-swiper-arrow-show <?php if($arrows == 'true') { echo esc_attr__( 'pxl-show-arrow', 'maiko' ); } ?>" data-view-auto="<?php echo esc_attr($col_xl); ?>">
        <div class="pxl-carousel-inner">
            <div class="connect-global">
                <div class="pxl-circle-svg cc1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="358" height="358" viewBox="0 0 500 500 " fill="none">
                      <defs>
                          <linearGradient class="linear-dot1" id="<?php echo esc_attr($ids); ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop class="stop1" offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                            <stop class="stop2" offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                        </linearGradient>
                        <linearGradient class="linear-dot2" id="<?php echo esc_attr($ids1); ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop class="stop1" offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                            <stop class="stop2" offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <g id="Layer_1" data-name="Layer 1">
                      <path d="M0,403.4c39.68-94.2,127.46-164.69,234-183.21h0a325.48,325.48,0,0,1,56-4.82c80.8,0,154.44,29.48,210,77.86" style="fill:none;stroke:#353e47;stroke-miterlimit:3;opacity: 1;"/>
                  </g>
              </svg>    
          </div>
      </div>
      <div class="connect-global">
        <div class="pxl-circle-svg cc1">
          <svg xmlns="http://www.w3.org/2000/svg" width="358" height="358" viewBox="0 0 500 500 " fill="none">
              <defs>
                  <linearGradient class="linear-dot1" id="<?php echo esc_attr($ids); ?>" x1="50%" y1="0%" x2="100%" y2="0%">
                    <stop class="stop1" offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                    <stop class="stop2" offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                </linearGradient>
                <linearGradient class="linear-dot2" id="<?php echo esc_attr($ids1); ?>" x1="50%" y1="0%" x2="100%" y2="0%">
                    <stop class="stop1" offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                    <stop class="stop2" offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                </linearGradient>
            </defs>
            <g id="Layer_1" data-name="Layer 1">
              <path d="M157.85,403.4c2.49-69.64,30.72-133.32,76.19-183.21h0c60-65.83,150.07-107.69,250.76-107.69,5.1,0,10.15.1,15.18.32" style="fill:none;stroke:#353e47;stroke-miterlimit:3;"/>
          </g>
      </svg>    
  </div>
</div>
<div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
    <div class="pxl-swiper-wrapper">
        <?php foreach ($settings['slider1'] as $key => $value):
            $image_light = isset($value['image1']) ? $value['image1'] : '';
            $title = isset($value['title1']) ? $value['title1'] : '';
            $desc = isset($value['desc1']) ? $value['desc1'] : '';
            $btn_text = isset($value['btn_text1']) ? $value['btn_text1'] : '';
            $link = isset($value['btn_link1']) ? $value['btn_link1'] : '';
            $link_key = $widget->get_repeater_setting_key( 'title1', 'value', $key );
            if ( ! empty( $link['url'] ) ) {
                $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                if ( $link['is_external'] ) {
                    $widget->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $link['nofollow'] ) {
                    $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
            }
            $link_attributes = $widget->get_render_attribute_string( $link_key );
            ?>
            <div class="pxl-swiper-slide">
                <div class="swiper-slide-inner" >
                    <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>"  data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                        <div class="pxl-item--content">
                            <div class="content--inner">
                                <div class="content--wrapper">
                                    <?php if(!empty($sub_text)) : ?>
                                        <div class="pxl-item--subtitle wow fadeInUp" data-wow-delay="300ms"><?php echo pxl_print_html($sub_text); ?></div>
                                    <?php endif; ?>
                                    <?php if(!empty($title)) : ?>
                                        <h2 class="pxl-item--title el-empty wow fadeInUp" data-wow-delay="600ms"><?php echo pxl_print_html($title); ?></h2>
                                    <?php endif; ?>
                                    <?php if(!empty($desc)) : ?>
                                        <p class="pxl-item--desc el-empty wow fadeInUp" data-wow-delay="900ms"><?php echo pxl_print_html($desc); ?></p>
                                    <?php endif; ?>
                                    <div class="pxl-item--link  wow fadeInUp" data-wow-delay="1200ms">
                                        <?php if ( !empty( $link['url'] ) ) { ?>
                                            <a class="item--button btn-1" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                                <span class="btn-text">
                                                    <?php if(!empty($btn_text)) {
                                                        echo pxl_print_html($btn_text);
                                                    } else {
                                                        echo esc_html__('VIEW DETAILS', 'maiko');
                                                    } ?>
                                                </span> 
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($image_light['id'])) : ?>
                        <div class="mask--content" style="background-image: url(<?php echo esc_url($image_light['url']); ?>);">
                            <span class="block wow fadeInLeft" data-wow-delay="300ms"></span>
                            <span class="block wow fadeInLeft" data-wow-delay="600ms"></span>
                            <span class="block wow fadeInLeft" data-wow-delay="900ms"></span>
                            <span class="block wow fadeInLeft" data-wow-delay="1200ms"></span>
                            <span class="block wow fadeInLeft" data-wow-delay="1500ms"></span>
                            <span class="block wow fadeInLeft" data-wow-delay="1800ms"></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php if($pagination !== 'false'): ?>
    <div class="pxl-swiper-dots style-1"></div>
<?php endif; ?>
<?php if($arrows !== 'false'): ?>
    <div class="pxl-swiper-arrow-wrap style-5 ">
        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="far fa-arrow-left rtl-icon"></i></div>
        <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="far fa-arrow-right rtl-icon"></i></div>
    </div>
<?php endif; ?>
</div>
</div>
<?php endif; ?>
