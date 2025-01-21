<?php
$html_id = pxl_get_element_id($settings);
if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>
<div id="pxl-<?php echo esc_attr($html_id) ?>" class="pxl-button <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php switch ($settings['btn_style']) {
        case 'btn-shape-primary': ?>
            <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn btn-shape-primary btn-flex  <?php if(!empty($settings['btn_icon'])) { echo 'pxl-icon-active'; } ?> <?php echo esc_attr($settings['pxl_animate'].' pxl-icon--'.$settings['icon_align']); ?>">
                 <?php if(!empty($settings['btn_icon'])) { \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); } ?>
                <span class="pxl--btn-text pxl-mr-30"><?php echo pxl_print_html($settings['text']); ?></span>
                <span class="pxl-item--shape pxl-r-12"></span>
            </a>
            <?php break;

        default: ?>
            <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn <?php if(!empty($settings['btn_icon'])) { echo 'pxl-icon-active'; } ?> <?php echo esc_attr($settings['btn_style'].' '.$settings['pxl_animate'].' pxl-icon--'.$settings['icon_align']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                <?php if(!empty($settings['btn_icon'])) { \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); } ?>
                <span class="pxl--btn-text" data-text="<?php echo esc_attr($settings['text']); ?>">
                <?php echo pxl_print_html($settings['text']); ?>
                </span>
            </a>
        <?php break;
    } ?>
</div>