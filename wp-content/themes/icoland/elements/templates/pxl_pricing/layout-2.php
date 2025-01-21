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
<div class="pxl-pricing pxl-pricing2 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <h4 class="pxl-item--title text-center"><?php echo esc_attr($settings['title']); ?></h4>
    <h5 class="pxl-item--subtitle text-center"><span><?php echo esc_attr($settings['sub_title']); ?></span></h5>
    <div class="pxl-item--meta">
        <div class="pxl-item--price"><?php echo pxl_print_html($settings['price']); ?></div>
        <?php if(!empty($settings['video_link'])) : ?>
            <div class="pxl-item--video bg-image" style="background-image: url(<?php echo esc_url($settings['video_image']['url']); ?>);"><a class="btn-video" href="<?php echo esc_attr($settings['video_link']); ?>"><i class="flaticon flaticon-play-button"></i></a></div>
        <?php endif; ?>
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
            <a class="btn  btn-default" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>><?php echo esc_attr($settings['button_text']); ?></a>
        </div>
    <?php endif; ?>
</div>