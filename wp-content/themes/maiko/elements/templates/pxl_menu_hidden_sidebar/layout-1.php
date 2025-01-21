<?php
if(!empty($settings['menu'])) { 
    $p_menu = maiko()->get_page_opt('p_menu'); 
    $show_image = $widget->get_setting('show_image', false);
    if ( ! empty( $settings['link']['url'] ) ) {
        $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );

        if ( $settings['link']['is_external'] ) {
            $widget->add_render_attribute( 'button', 'target', '_blank' );
        }

        if ( $settings['link']['nofollow'] ) {
            $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
        }
    }
    $editor_content = $widget->get_settings_for_display( 'text_ed' );
    $editor_content = $widget->parse_text_editor( $editor_content );
    if(!empty($p_menu)) {
        $settings['menu'] = $p_menu;
    } ?>
    <div class="pxl-menu-hidden-sidebar <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-menu-button-wrap">
            <div class="pxl-menu-button <?php echo esc_attr($settings['icon_type']); ?>">
                <div class="pxl-anchor-divider">
                    <div class="pxl-icon-line pxl-icon-line1"></div>
                    <div class="pxl-icon-line pxl-icon-line2"></div>
                    <div class="pxl-icon-line pxl-icon-line3"></div>
                    <div class="pxl-icon-line pxl-icon-line4"></div>
                </div>
            </div>
        </div>
        <div class="pxl-menu-wrap">
            <div class="pxl-background">
                <div class="pxl-bg-side-container pxl-bg-before-container">
                    <span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span>
                </div>
                <div class="pxl-bg-container">
                    <div class="pxl-bg-row">
                        <div><span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span></div>
                        <div><span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span></div>
                        <div><span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span></div>
                        <div><span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span></div>
                    </div>
                </div>
                <div class="pxl-bg-side-container pxl-bg-after-container">
                    <span style="<?php if ($show_image) { ?><?php if (!empty($settings['image']['id'])) { ?>background-image: url(<?php echo esc_url($settings['image']['url']); ?>);<?php } ?><?php } ?>"></span>
                </div>
            </div>
            <div class="pxl-menu-popup-wrap">
                <div class="pxl-menu-popup-container">
                    <div class="pxl-menu-popup-close">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 496.096 496.096" width="26" height="26" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M259.41,247.998L493.754,13.654c3.123-3.124,3.123-8.188,0-11.312c-3.124-3.123-8.188-3.123-11.312,0L248.098,236.686
                                L13.754,2.342C10.576-0.727,5.512-0.639,2.442,2.539c-2.994,3.1-2.994,8.015,0,11.115l234.344,234.344L2.442,482.342
                                c-3.178,3.07-3.266,8.134-0.196,11.312s8.134,3.266,11.312,0.196c0.067-0.064,0.132-0.13,0.196-0.196L248.098,259.31
                                l234.344,234.344c3.178,3.07,8.242,2.982,11.312-0.196c2.995-3.1,2.995-8.016,0-11.116L259.41,247.998z"/>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="pxl-menu-popup-inner">
                    <div class="pxl-menu-popup">
                        <?php wp_nav_menu(array(
                            'menu_class' => 'pxl-menu-hidden clearfix',
                            'walker'     => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                            'link_before'     => '<span class="pxl-menu-item-text">',
                            'link_after'      => '</span>',
                            'menu'        => wp_get_nav_menu_object($settings['menu']))
                        ); ?>
                    </div>
                    <div class="pxl-menu-popup-content">
                        <?php if(!empty($settings['image_r']['id'])) :
                            $img = pxl_get_image_by_size( array(
                                'attach_id'  => $settings['image_r']['id'],
                                'thumb_size' => 'full',
                            ));
                            $thumbnail = $img['thumbnail']; ?>
                            <div class="pxl-item--image">
                                <?php echo pxl_print_html($thumbnail); ?>
                            </div>
                        <?php endif; ?>
                        <div class="pxl-item-content">
                            <?php echo wp_kses_post($editor_content); ?>    
                            <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn btn-default">
                                <span class="pxl--btn-text"><?php echo pxl_print_html($settings['btn_text']); ?></span>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="36" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 1230.3 556.2" style="enable-background:new 0 0 1230.3 556.2;" xml:space="preserve">
                                <style type="text/css">
                                    .st0{fill:none;stroke:#fff;stroke-width:55;stroke-miterlimit:10;}
                                </style>
                                <g>
                                    <polyline class="st0" points="983.5,91.5 1165.3,279.2 983.5,464.7   "/>
                                    <line class="st0" x1="1165.3" y1="279.2" x2="22.7" y2="279.2"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php if(isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
            <div class="pxl-list-info">
                <?php foreach ($settings['lists'] as $key => $value): 
                    $link_key = $widget->get_repeater_setting_key( 'icon_link', 'value', $key );
                    if ( ! empty( $value['link']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

                        if ( $value['link']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $value['link']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key ); ?>
                    <div class="pxl--item">
                        <?php if(!empty($value['sub_title'])) : ?><h5><?php echo pxl_print_html($value['sub_title'])?></h5><?php endif; ?>

                        <?php if(!empty($value['content'])) : ?><?php echo pxl_print_html($value['content'])?><?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if(!empty($settings['social'])): ?>
                    <div class="pxl-item--social">
                        <?php
                        $team_social = json_decode($settings['social'], true);
                        foreach ($team_social as $value):
                            if (!empty($value['url'])): ?>
                                <a href="<?php echo esc_url($value['url']); ?>">
                                <?php endif; ?>
                                <i class="<?php echo esc_attr($value['icon']); ?>"></i>
                                <?php if (!empty($value['url'])): ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
</div>
<?php } ?>