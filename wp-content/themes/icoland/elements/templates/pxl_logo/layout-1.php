<?php
if ( ! empty( $settings['logo_link']['url'] ) ) {
    $widget->add_render_attribute( 'logo_link', 'href', $settings['logo_link']['url'] );

    if ( $settings['logo_link']['is_external'] ) {
        $widget->add_render_attribute( 'logo_link', 'target', '_blank' );
    }

    if ( $settings['logo_link']['nofollow'] ) {
        $widget->add_render_attribute( 'logo_link', 'rel', 'nofollow' );
    }
}
?>
<div class="pxl-logo <?php echo esc_attr($settings['pxl_animate'].' '.$settings['style']);?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if ( ! empty( $settings['logo_link']['url'] ) ) { ?><a <?php pxl_print_html($widget->get_render_attribute_string( 'logo_link' )); ?>><?php } ?>
    <?php if(!empty($settings['logo']['id'])) :
        $img  = pxl_get_image_by_size( array(
            'attach_id'  => $settings['logo']['id'],
            'thumb_size' => 'full',
            'class' => 'logo-light',
        ) );
        $thumbnail    = $img['thumbnail'];
        ?>
        <?php echo wp_kses_post($thumbnail); ?>
    <?php endif; ?>
    <?php if(!empty($settings['logo_dark']['id'])) :
        $img_dark  = pxl_get_image_by_size( array(
            'attach_id'  => $settings['logo_dark']['id'],
            'thumb_size' => 'full',
            'class' => 'logo-dark',
        ) );
        $thumbnail_dark    = $img_dark['thumbnail'];
        ?>
        <?php echo wp_kses_post($thumbnail_dark); ?>
    <?php endif; ?>
    <?php if ( ! empty( $settings['logo_link']['url'] ) ) { ?></a><?php } ?>
</div>