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
<div class="pxl-download pxl-download3">
    <div class="pxl-item--inner">
        <div class="pxl-item--meta">
            <h5 class="pxl-item--title el-empty"><?php echo pxl_print_html($settings['title']); ?></h5>
            <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn-download">
                <i class="fas fa-cloud-download-alt"></i> <?php echo pxl_print_html('PDF','icoland') ?>
            </a>
        </div>
    </div>
</div>