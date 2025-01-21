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
<div class="pxl-pricing pxl-pricing1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php 
    if (!empty($settings['title_note'])) { ?>
        <div class="pxl-item--title--note"><span><?php echo esc_attr($settings['title_note']); ?></span></div>
    <?php } ?>
    <div class="wrap-content">
        <h4 class="pxl-item--title--pr"><span><?php echo esc_attr($settings['title']); ?></span></h4>
        <div class="pxl-item--subtitle"><?php echo esc_attr($settings['sub_title']); ?></div>
        <div class="pxl-item--price"><?php echo pxl_print_html($settings['price']); ?></div>
        <div class="pxl-item--sub--price"><?php echo pxl_print_html($settings['sub_price']); ?></div>
        <?php if(!empty($settings['button_text'])) : ?>
            <div class="pxl-item--readmore">
                <a class="btn-readmore " <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>><?php echo esc_attr($settings['button_text']); ?></a>
                <h4 class="sub-btn"><span><?php echo esc_attr($settings['sub_btn']); ?></span></h4>
            </div>
        <?php endif; ?>
        <div class="wrap-feature wrap-feature-1">
            <span><?php echo pxl_print_html($settings['title_ft1']); ?></span>
            <?php if(isset($settings['feature']) && !empty($settings['feature']) && count($settings['feature'])): ?>
            <ul class="pxl-item--feature">
                <?php foreach ($settings['feature'] as $key => $value): ?>
                    <li class="<?php echo esc_attr($value['active']); ?>"><i class="fa fa-check"></i><?php echo pxl_print_html($value['feature_text'])?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?></div>
            <div class="wrap-feature wrap-feature-2">
              <span class="pxl-item--title"><?php echo esc_attr($settings['title_ft2']); ?></span></h4>
              <?php if(isset($settings['feature_2']) && !empty($settings['feature_2']) && count($settings['feature_2'])): ?>
              <ul class="pxl-item--feature">
                <?php foreach ($settings['feature_2'] as $key => $value2): ?>
                    <li class="<?php echo esc_attr($value2['active_2']); ?>"><i class="fa fa-check"></i><?php echo pxl_print_html($value2['feature_text_2'])?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
</div>