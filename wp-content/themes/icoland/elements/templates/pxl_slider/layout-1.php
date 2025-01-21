<?php
$progressbar = $widget->get_setting('progressbar','false');  
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
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => '1',
    'slides_to_show_xxl'            => '1', 
    'slides_to_show_lg'             => '1', 
    'slides_to_show_md'             => '1', 
    'slides_to_show_sm'             => '1',
    'slides_to_show_xs'             => '1', 
    'slides_to_scroll'              => '1',
    'arrow'                         => $arrows,
    'pagination'                    => $pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => $autoplay,
    'pause_on_hover'                => $pause_on_hover,
    'pause_on_interaction'          => 'true',
    'delay'                         => $autoplay_speed,
    'loop'                          => $infinite,
    'speed'                         => $speed,
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

if(isset($settings['slides']) && !empty($settings['slides']) && count($settings['slides'])): ?>
    <div class="pxl-swiper-sliders pxl-element-slider pxl-swiper-nogap <?php echo esc_attr($settings['style']); ?>  <?php if($arrows !== 'false') { echo 'pxl-swiper-show-arrow'; } if($pagination !== 'false') { echo ' pxl-swiper-show-pagination'; } if(!empty($settings['slogan_label'])) { echo ' pxl-swiper-show-slogan'; } ?>" data-slider-mode="fade">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['slides'] as $key => $value):
                        $bg_image = isset($value['bg_image']) ? $value['bg_image'] : '';
                        $overlay_image = isset($value['overlay_image']) ? $value['overlay_image'] : '';
                        $bg_ken_burns = isset($value['bg_ken_burns']) ? $value['bg_ken_burns'] : '';
                        if(!empty($value['slide_template'])) : ?>
                            <div class="pxl-swiper-slide">
                                <div class="pxl-slider--inner elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                                    <?php if(!empty($bg_image['id'])) :
                                        $img  = pxl_get_image_by_size( array(
                                            'attach_id'  => $bg_image['id'],
                                            'thumb_size' => 'full',
                                            'class' => 'no-lazyload'
                                        ) );
                                        $thumbnail_url = $img['url']; ?>
                                        <div class="pxl-slider--mainimage <?php if($bg_ken_burns !== 'false') { echo 'pxl-image--kenburns wow'; } ?>">
                                            <div class="pxl-slider--image bg-image" style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);"></div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($overlay_image['id'])) :
                                        $overlay_img  = pxl_get_image_by_size( array(
                                            'attach_id'  => $overlay_image['id'],
                                            'thumb_size' => 'full',
                                            'class' => 'no-lazyload'
                                        ) );
                                        $overlay_thumbnail_url = $overlay_img['url']; ?>
                                        <div class="pxl-slider--overlay bg-image elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>" style="background-image: url(<?php echo esc_url($overlay_thumbnail_url); ?>);">
                                        </div>
                                    <?php endif; ?>

                                    <div class="pxl-slider--content">
                                        <?php $slide_content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$value['slide_template']);
                                        pxl_print_html($slide_content); ?>
                                    </div>
                               </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if($progressbar !== 'false'): ?>
            <div class="pxl-slider-progressbar"></div>
        <?php endif; ?>
        <div class="pxl-swiper-footer">
            <?php if( $settings['style'] == 'style-1' && isset($settings['social']) && !empty($settings['social']) && count($settings['social'])): 
                $is_new = \Elementor\Icons_Manager::is_migration_allowed(); ?>
                <div class="pxl-swiper-social pxl-pr-20">
                    <?php foreach ($settings['social'] as $key => $value):
                        $icon_key = $widget->get_repeater_setting_key( 'pxl_icon', 'icons', $key );
                        $widget->add_render_attribute( $icon_key, [
                            'class' => $value['pxl_icon'],
                            'aria-hidden' => 'true',
                        ] );
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
                        $link_attributes = $widget->get_render_attribute_string( $link_key ); ?>
                        <?php if ( ! empty( $value['pxl_icon'] ) ) : ?>
                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                <?php if ( $is_new ):
                                    \Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
                                elseif(!empty($value['pxl_icon'])): ?>
                                    <i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if( $settings['style'] == 'style-1' && !empty($settings['slogan_label'])) : ?>
                <div class="pxl-swiper-slogan pxl-pr-20">
                    <?php if(!empty($settings['slogan_icon']['value'])) { \Elementor\Icons_Manager::render_icon( $settings['slogan_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); } ?>
                    <span class="pxl-ml-10"><?php echo esc_attr($settings['slogan_label']); ?></span>
                </div>
            <?php endif; ?>
            <?php if($pagination !== 'false'): ?>
                <div class="pxl-swiper-pagination">
                    <div class="pxl-swiper-dots style-1"></div>
                </div>
            <?php endif; ?>
            <?php if($arrows !== 'false'): ?>
                <div class="pxl-swiper-arrow-wrap">
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="fal fa-chevron-left rtl-icon"></i></div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="fal fa-chevron-right rtl-icon"></i></div>
                </div>
            <?php endif; ?>
        </div>

    </div>
<?php endif; ?>
