<?php 
if ( ! empty( $settings['btn_link']['url'] ) ) {
    $widget->add_render_attribute( 'btn_link', 'href', $settings['btn_link']['url'] );

    if ( $settings['btn_link']['is_external'] ) {
        $widget->add_render_attribute( 'btn_link', 'target', '_blank' );
    }

    if ( $settings['btn_link']['nofollow'] ) {
        $widget->add_render_attribute( 'btn_link', 'rel', 'nofollow' );
    }
}
?>
<div class="pxl-location pxl-location1">
    <?php
    if(!empty($settings['img']['id'])) : 
        $img  = pxl_get_image_by_size( array(
            'attach_id'  => $settings['img']['id'],
            'thumb_size' => 'full',
        ) );
        $thumbnail    = $img['thumbnail'];
        ?>
        <div class="pxl-image">
            <?php echo wp_kses_post($thumbnail); ?>
        </div>
    <?php endif; ?>
    <div class="pxl-holder-items">
        <?php if ($settings['title']) { ?>
            <h3 class="pxl-title-location">
                <?php echo pxl_print_html($settings['title']); ?>
            </h3>
        <?php } ?>
        <?php if ($settings['sub_title']) { ?>
            <div class="pxl-subtitle-location">
                <?php echo pxl_print_html($settings['sub_title']); ?>
            </div>
        <?php } ?>
        <div class="pxl-list">
            <?php foreach ($settings['lists'] as $key => $value): ?>
                <div class="pxl--item">
                    <?php if(!empty($value['content'])) : ?>
                        <?php echo pxl_print_html($value['content'])?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($settings['btn_text']) { ?>
            <div class="pxl-button-location">
                <?php if ( ! empty( $settings['btn_link']['url'] ) ) { ?><a <?php pxl_print_html($widget->get_render_attribute_string( 'btn_link' )); ?>><?php } ?>
                <?php echo pxl_print_html($settings['btn_text']); ?>
                <i class="far fa-arrow-right"></i>
                <?php if ( ! empty( $settings['btn_link']['url'] ) ) { ?></a><?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
