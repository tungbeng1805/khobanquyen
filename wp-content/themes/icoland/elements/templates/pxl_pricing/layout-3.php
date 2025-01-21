<?php
if ( ! empty( $settings['button_link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['button_link']['url'] );

    if ( $settings['button_link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['button_link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>
<div class="pxl-pricing pxl-pricing3 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if ( !empty($settings['image']['id']) ) : ?>
        <div class="pxl-item--icon">
            <?php $img_icon  = pxl_get_image_by_size( array( 
                'attach_id'  => $settings['image']['id'],
                'thumb_size' => 'full',
            ) );
            $thumbnail_icon    = $img_icon['thumbnail'];
            echo pxl_print_html($thumbnail_icon); ?>
        </div>
    <?php endif; ?>
    <h4 class="pxl-item--title text-center"><?php echo esc_attr($settings['title']); ?></h4>
    <h5 class="pxl-item--subtitle text-center"><span><?php echo esc_attr($settings['sub_title']); ?></span></h5>
    <div class="pxl-item--meta">
        <div class="pxl-item--price"><?php echo pxl_print_html($settings['price']); ?></div>
    </div>
    <?php if(isset($settings['feature']) && !empty($settings['feature']) && count($settings['feature'])): ?>
    <ul class="pxl-item--feature">
        <?php foreach ($settings['feature'] as $key => $value): ?>
            <li class="<?php echo esc_attr($value['active']); ?>"><i class="fa fa-check"></i><?php echo pxl_print_html($value['feature_text'])?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if(!empty($settings['button_text'])) : ?>
    <div class="pxl-item--button">
        <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>><?php echo esc_attr($settings['button_text']); ?></a>
    </div>
<?php endif; ?>
</div>