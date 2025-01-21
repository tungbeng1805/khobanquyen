<?php if ( ! empty( $settings['btn_link']['url'] ) ) {
    $widget->add_render_attribute( 'btn_link', 'href', $settings['btn_link']['url'] );

    if ( $settings['btn_link']['is_external'] ) {
        $widget->add_render_attribute( 'btn_link', 'target', '_blank' );
    }
    if ( $settings['btn_link']['nofollow'] ) {
        $widget->add_render_attribute( 'btn_link', 'rel', 'nofollow' );
    }
} ?>
<div class="pxl-image-box pxl-image-box3 <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--inner">
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
        <div class="wrap-content">
            <?php if ( !empty($settings['image']['id']) ) : ?>
                <div class="pxl-item-image">
                    <a <?php pxl_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>>
                        <?php 
                        $image_size = !empty($settings['img_size']) ? $settings['img_size'] : '';
                        $img  = pxl_get_image_by_size( array(
                            'attach_id'  => $settings['image']['id'],
                            'thumb_size' => $image_size,
                        ) );
                        $thumbnail    = $img['thumbnail'];
                        echo pxl_print_html($thumbnail); ?>
                    </a>
                </div>
            <?php endif; ?>
            <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title el-empty"><a class="title-link" <?php pxl_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>>
                <?php echo pxl_print_html($settings['title']); ?>
            </a></<?php echo esc_attr($settings['title_tag']); ?>>
        </div>
    </div>
</div>