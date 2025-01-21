<?php if ( ! empty( $settings['btn_link']['url'] ) ) {
    $widget->add_render_attribute( 'btn_link', 'href', $settings['btn_link']['url'] );

    if ( $settings['btn_link']['is_external'] ) {
        $widget->add_render_attribute( 'btn_link', 'target', '_blank' );
    }
    if ( $settings['btn_link']['nofollow'] ) {
        $widget->add_render_attribute( 'btn_link', 'rel', 'nofollow' );
    }
} ?>
<div class="pxl-image-box pxl-image-box2 <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--inner">
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
        <div class="pxl-item--holder">
            <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title el-empty"><a class="title-link" <?php pxl_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>>
                <?php echo pxl_print_html($settings['title']); ?>
            </a></<?php echo esc_attr($settings['title_tag']); ?>>
            <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc']); ?></div>
        </div>
        <div class="btn-readmore">
         <a <?php pxl_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>>
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M28.8601 11.86L41.0001 24L28.8601 36.14" stroke="#B4E116" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"/>
                <path d="M7 24H40.66" stroke="#B4E116" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
</div>
</div>