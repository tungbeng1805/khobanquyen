<?php
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => 1, 
    'slides_to_show_xxl'            => 1, 
    'slides_to_show_lg'             => 1, 
    'slides_to_show_md'             => 1, 
    'slides_to_show_sm'             => 1, 
    'slides_to_show_xs'             => 1, 
    'slides_to_scroll'              => 1,
    'arrow'                         => 'false',
    'pagination'                    => 'false',
    'pagination_type'               => 'bullets',
    'autoplay'                      => '',
    'pause_on_hover'                => '',
    'pause_on_interaction'          => 'true',
    'delay'                         => 5000,
    'loop'                          => 'false',
    'speed'                         => 500,
];

$opts_thumb = [
    'slide_direction'               => 'horizontal',
    'slides_to_show'                => 1, 
    'slide_mode'                    => 'slide',
    'loop'                          => false,
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'data-settings' => wp_json_encode($opts)
]);

$widget->add_render_attribute( 'thumb', [
    'class'         => 'pxl-swiper-thumbs',
    'data-settings' => wp_json_encode($opts_thumb)
]);

$is_new = \Elementor\Icons_Manager::is_migration_allowed();

if(isset($settings['content_tab']) && !empty($settings['content_tab']) && count($settings['content_tab'])): ?>
    <div class="pxl-swiper-slider pxl-tab-carousel1 pxl-flex-middle pxl-slider-effect">

        <div class="pxl-tab-left pxl-pr-30 pxl-pl-14">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'thumb' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php foreach ($settings['content_tab'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : ''; ?>
                        <div class="pxl-swiper-slide swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <h5 class="pxl-thumb--title"><?php echo esc_attr($title); ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="pxl-tab-right">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php foreach ($settings['content_tab'] as $key => $value):
                        $feature = isset($value['feature']) ? $value['feature'] : '';
                        $title = isset($value['title']) ? $value['title'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $img = isset($value['img']) ? $value['img'] : ''; 
                        $sec_img = isset($value['sec_img']) ? $value['sec_img'] : ''; 
                        $btn_text = isset($value['btn_text']) ? $value['btn_text'] : ''; 
                        $btn_link = isset($value['btn_link']) ? $value['btn_link'] : '';
                        $icon_key = $widget->get_repeater_setting_key( 'pxl_icon', 'icons', $key );
                        $widget->add_render_attribute( $icon_key, [
                            'class' => $value['pxl_icon'],
                            'aria-hidden' => 'true',
                        ] );
                        $link_key = $widget->get_repeater_setting_key( 'btn_link', 'value', $key );
                        if ( ! empty( $btn_link['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $btn_link['url'] );

                            if ( $btn_link['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $btn_link['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key ); ?>
                        <div class="pxl-swiper-slide swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <div class="pxl-item--top pxl-flex <?php if(!empty($img['id'])) { echo 'main-img-active'; } ?>">
                                    <?php if(!empty($img['id'])) { 
                                        $main_img = pxl_get_image_by_size( array(
                                            'attach_id'  => $img['id'],
                                            'thumb_size' => '316x311',
                                            'class' => 'no-lazyload',
                                        ));
                                        $thumbnail_main = $main_img['thumbnail'];?>
                                        <div class="pxl-main--image wow skewIn">
                                            <?php echo wp_kses_post($thumbnail_main); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $value['pxl_icon'] ) ) : ?>
                                        <div class="pxl-item--icon">
                                            <?php if ( $is_new ):
                                                \Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
                                            elseif(!empty($value['pxl_icon'])): ?>
                                                <i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pxl-item--holder">
                                    <?php if ( ! empty( $value['pxl_icon'] ) ) : ?>
                                        <div class="pxl-item--icon">
                                            <?php if ( $is_new ):
                                                \Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
                                            elseif(!empty($value['pxl_icon'])): ?>
                                                <i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="pxl-item--title">
                                        <?php echo esc_attr($title); ?>
                                    </h3>
                                    <div class="pxl-item--box pxl-flex">
                                        <div class="pxl-item--boxleft pxl-pr-30">
                                            <div class="pxl-item--content">
                                                <?php echo esc_attr($desc); ?>
                                            </div>
                                            <?php if(!empty($feature)): ?>
                                                <ul class="pxl-item--feature">
                                                    <?php  $tab_feature = json_decode($feature, true); ?>
                                                    <?php foreach ($tab_feature as $value): ?>
                                                        <li><i class="<?php echo esc_attr($value['icon']); ?>"></i><?php echo esc_attr($value['content']); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pxl-item--boxright">
                                            <?php if(!empty($sec_img['id'])) { 
                                                $sec_img = pxl_get_image_by_size( array(
                                                    'attach_id'  => $sec_img['id'],
                                                    'thumb_size' => '160x165',
                                                    'class' => 'no-lazyload',
                                                ));
                                                $thumbnail_secondary = $sec_img['thumbnail'];?>
                                                <div class="pxl-secondary--image wow skewIn">
                                                    <?php echo wp_kses_post($thumbnail_secondary); ?>
                                                </div>
                                            <?php } ?>
                                            <?php if(!empty($btn_text)) : ?>
                                                <div class="pxl-item--button">
                                                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?> class="btn btn-text-parallax">
                                                        <span class="pxl--btn-text"><?php echo esc_attr($btn_text); ?></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
    </div>
<?php endif; ?>
