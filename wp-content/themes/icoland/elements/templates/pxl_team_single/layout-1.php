<div class="pxl-team-single pxl-team-single1">
    <div class="pxl-item--inner">
        <div class="content-left">
            <?php if ( !empty($settings['image']['id']) ) : ?>
                <div class="pxl-item--image">
                    <div class="boder bd1">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/bd-team.png'); ?>" alt="<?php echo esc_attr__('bd1', 'icoland'); ?>" />
                    </div>
                    <div class="boder bd2">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/bd-team.png'); ?>" alt="<?php echo esc_attr__('bd2', 'icoland'); ?>" />
                    </div>
                    <div class="boder bd3">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/bd-team.png'); ?>" alt="<?php echo esc_attr__('bd3', 'icoland'); ?>" />
                    </div>
                    <div class="boder bd4">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/bd-team.png'); ?>" alt="<?php echo esc_attr__('bd4', 'icoland'); ?>" />
                    </div>
                    <?php 
                    $img  = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail    = $img['thumbnail'];  
                    echo pxl_print_html($thumbnail); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="content-right">
            <div class="pxl-item--title">
                <?php echo pxl_print_html($settings['title']); ?>
            </div>
            <div class="pxl-item--subtitle">
                <?php echo pxl_print_html($settings['sub_title']); ?>
            </div>
            <div class="wrap-info">
                <div class="boder bd1">
                    <i class="icon icon-stroke"></i>
                </div>
                <div class="boder bd2">
                    <i class="icon icon-stroke"></i>
                </div>
                <div class="boder bd3">
                    <i class="icon icon-stroke"></i>
                </div>
                <div class="boder bd4">
                    <i class="icon icon-stroke"></i>
                </div>
                <h5 class="pxl-item--name">
                    <?php if ( ! empty( $settings['item_link']['url'] ) ) {
                        $widget->add_render_attribute( 'item_link', 'href', $settings['item_link']['url'] );

                        if ( $settings['item_link']['is_external'] ) {
                            $widget->add_render_attribute( 'item_link', 'target', '_blank' );
                        }

                        if ( $settings['item_link']['nofollow'] ) {
                            $widget->add_render_attribute( 'item_link', 'rel', 'nofollow' );
                        } ?>
                        <a class="item-link"<?php pxl_print_html($widget->get_render_attribute_string( 'item_link' )); ?>><?php echo pxl_print_html($settings['name']); ?></a>
                    <?php } ?>
                </h5>
                <div class="pxl-item--position">
                    <?php echo pxl_print_html($settings['position']); ?>
                </div>
                <div class="pxl-item--desc">
                    <?php echo pxl_print_html($settings['desc']); ?>
                </div>
                <?php if(!empty($settings['social'])): ?>
                    <div class="pxl-item--social">
                        <span class="item--social-btn"></span>
                        <?php  $team_social = json_decode($settings['social'], true);
                        foreach ($team_social as $value): ?>
                            <a href="<?php echo esc_url($value['url']); ?>" target="_blank"><i class="<?php echo esc_attr($value['icon']); ?>"></i></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
