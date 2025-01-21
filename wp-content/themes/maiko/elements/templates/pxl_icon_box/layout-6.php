<div class="pxl-icon-box pxl-icon-box6 <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if ( ! empty( $settings['item_link']['url'] ) ) {
        $widget->add_render_attribute( 'item_link2', 'href', $settings['item_link']['url'] );

        if ( $settings['item_link']['is_external'] ) {
            $widget->add_render_attribute( 'item_link2', 'target', '_blank' );
        }

        if ( $settings['item_link']['nofollow'] ) {
            $widget->add_render_attribute( 'item_link2', 'rel', 'nofollow' );
        } ?>
        <div class="pxl-item--inner">
            <div class="pxl-content content-1">
                <?php if (!empty($settings['bg_image']['id']) ) : ?>
                    <?php $img_icon2  = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['bg_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail    = $img_icon2['thumbnail']; ?>
                    <div class="pxl-item-image">
                        <a <?php pxl_print_html($widget->get_render_attribute_string( 'item_link2' )); ?>>
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="entry-body">
                    <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title el-empty">
                    <a <?php pxl_print_html($widget->get_render_attribute_string( 'item_link2' )); ?>>
                        <?php echo pxl_print_html($settings['title']); ?>
                    </a>
                    </<?php echo esc_attr($settings['title_tag']); ?>>
                    <div class="pxl-item--description el-empty">
                        <?php echo pxl_print_html($settings['desc']); ?>
                    </div>
                    <div class="btn-show-more">
                        <span><?php echo esc_html__('Show More','maiko') ?></span>
                        <span class="ic"><i class="fas fa-caret-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="pxl-content content-2">
                <?php if ( $settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value']) ) : ?>
                    <div class="pxl-item--icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
                    <div class="pxl-item--icon">
                        <?php $img_icon  = pxl_get_image_by_size( array(
                            'attach_id'  => $settings['icon_image']['id'],
                            'thumb_size' => 'full',
                        ) );
                        $thumbnail_icon    = $img_icon['thumbnail'];
                        echo pxl_print_html($thumbnail_icon); ?>
                    </div>
                <?php endif; ?>

                <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title el-empty">
                <a <?php pxl_print_html($widget->get_render_attribute_string( 'item_link2' )); ?>>
                    <?php echo pxl_print_html($settings['title']); ?>
                </a>
                </<?php echo esc_attr($settings['title_tag']); ?>>

                <div class="pxl-item--description el-empty">
                    <?php echo pxl_print_html($settings['desc2']); ?>
                </div>
                <?php if(isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
                <ul class="pxl-list-item">
                    <?php foreach ($settings['lists'] as $key => $value): ?>
                        <?php if(!empty($value['content'])) : ?>
                            <li class="pxl-item">
                                <i class="fas fa-arrow-right"></i>
                                <span>
                                    <?php echo pxl_print_html($value['content'])?>
                                </span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul><?php endif; ?>


                    <a class="pxl-item--button" <?php pxl_print_html($widget->get_render_attribute_string( 'item_link2' )); ?>>
                        <?php echo pxl_print_html($settings['button_text']); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" x="0" y="0" viewBox="0 0 1560 1560" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(1,0,0,1,4.999999999999545,4.547473508864641e-13)"><path d="M1524 811.8H36c-17.7 0-32-14.3-32-32s14.3-32 32-32h1410.7l-194.2-194.2c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l248.9 248.9c9.2 9.2 11.9 22.9 6.9 34.9-5 11.9-16.7 19.7-29.6 19.7z" fill="#ffffff" opacity="1" data-original="#000000"></path><path d="M1274.8 1061c-8.2 0-16.4-3.1-22.6-9.4-12.5-12.5-12.5-32.8 0-45.3l249.2-249.2c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-249.2 249.2c-6.3 6.3-14.5 9.4-22.7 9.4z" fill="#ffffff" opacity="1" data-original="#000000"></path></g></svg>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>