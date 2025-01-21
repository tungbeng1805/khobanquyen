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
<div class="pxl-download pxl-download1">
    <div class="pxl-item--inner">
        <div class="pxl-item--meta">
            <h5 class="pxl-item--title el-empty"><?php echo pxl_print_html($settings['title']); ?></h5>
            <p class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc']); ?></p> 
            <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn-download">
                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/download.png'); ?>" alt="<?php echo esc_attr__('download', 'icoland'); ?>" />
            </a>
        </div>
    </div>
</div>