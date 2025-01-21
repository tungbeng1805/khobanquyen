<?php if(isset($settings['team']) && !empty($settings['team']) && count($settings['team'])): ?>
<div class="pxl-grid pxl-team-grid pxl-team-grid1 ">
    <div class="pxl-grid-inner" data-gutter="15">
        <?php if(!empty( $settings['image_map']['id'])) { 
            $img1 = pxl_get_image_by_size( array(
                'attach_id'  => $settings['image_map']['id'],
                'thumb_size' => 'full',
                'class' => 'no-lazyload'
            ));
            $thumbnail1 = $img1['thumbnail'];
            ?>
            <div class="pxl-item--map">
                <?php echo wp_kses_post($thumbnail1); ?>

            </div>
        <?php } ?>
        <?php foreach ($settings['team'] as $key => $value):
            $item_cls = [ 'elementor-repeater-item-'.$value['_id'] ];
            $title = isset($value['title']) ? $value['title'] : '';
            $type_position = isset($value['type_position']) ? $value['type_position'] : '';
            $ct_position = isset($value['ct_position']) ? $value['ct_position'] : '';
            $position = isset($value['position']) ? $value['position'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
            $social = isset($value['social']) ? $value['social'] : '';
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
            
            <?php if($type_position == 'top-left') : ?>
                <div class="team-list pxl--widget-click <?php echo implode(' ', $item_cls) ?> <?php echo esc_attr($ct_position); ?>">
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
                        <div class="pxl-item--holder pxl-item--front">
                            <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                            <h5 class="pxl-item--title">    
                                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                    <?php echo pxl_print_html($title); ?>
                                </a>
                            </h5>
                            <div class="pxl-item--description"><?php echo pxl_print_html($desc); ?></div>
                            <?php if(!empty($social)): ?>
                                <div class="pxl-item--social">
                                    <?php  $team_social = json_decode($social, true);
                                    foreach ($team_social as $value): ?>
                                        <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
            <?php if($type_position == 'top-right') : ?>
                <div class="team-list pxl--widget-click <?php echo implode(' ', $item_cls) ?> <?php echo esc_attr($ct_position); ?>">
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
                        <div class="pxl-item--holder pxl-item--front">
                            <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                            <h5 class="pxl-item--title">    
                                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                    <?php echo pxl_print_html($title); ?>
                                </a>
                            </h5>
                            <div class="pxl-item--description"><?php echo pxl_print_html($desc); ?></div>
                            <?php if(!empty($social)): ?>
                                <div class="pxl-item--social">
                                    <?php  $team_social = json_decode($social, true);
                                    foreach ($team_social as $value): ?>
                                        <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
            <?php if($type_position == 'bottom-left') : ?>
               <div class="team-list pxl--widget-click <?php echo implode(' ', $item_cls) ?> <?php echo esc_attr($ct_position); ?>">
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
                    <div class="pxl-item--holder pxl-item--front">
                        <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                        <h5 class="pxl-item--title">    
                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                <?php echo pxl_print_html($title); ?>
                            </a>
                        </h5>
                        <div class="pxl-item--description"><?php echo pxl_print_html($desc); ?></div>
                        <?php if(!empty($social)): ?>
                            <div class="pxl-item--social">
                                <?php  $team_social = json_decode($social, true);
                                foreach ($team_social as $value): ?>
                                    <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endif; ?>
        <?php if($type_position == 'bottom-right') : ?>
            <div class="team-list pxl--widget-click <?php echo implode(' ', $item_cls) ?> <?php echo esc_attr($ct_position); ?>">
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
                    <div class="pxl-item--holder pxl-item--front">
                        <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                        <h5 class="pxl-item--title">    
                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                <?php echo pxl_print_html($title); ?>
                            </a>
                        </h5>
                        <div class="pxl-item--description"><?php echo pxl_print_html($desc); ?></div>
                        <?php if(!empty($social)): ?>
                            <div class="pxl-item--social">
                                <?php  $team_social = json_decode($social, true);
                                foreach ($team_social as $value): ?>
                                    <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
</div>
<?php endif; ?>
