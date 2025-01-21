<?php
$editor_title = $widget->get_settings_for_display( 'title' );
$editor_title = $widget->parse_text_editor( $editor_title );

if ( ! empty( $settings['link1']['url'] ) ) {
    $widget->add_render_attribute( 'link1', 'href', $settings['link1']['url'] );

    if ( $settings['link1']['is_external'] ) {
        $widget->add_render_attribute( 'link1', 'target', '_blank' );
    }

    if ( $settings['link1']['nofollow'] ) {
        $widget->add_render_attribute( 'link1', 'rel', 'nofollow' );
    }
}
if ( ! empty( $settings['link2']['url'] ) ) {
    $widget->add_render_attribute( 'link2', 'href', $settings['link2']['url'] );

    if ( $settings['link2']['is_external'] ) {
        $widget->add_render_attribute( 'link2', 'target', '_blank' );
    }

    if ( $settings['link2']['nofollow'] ) {
        $widget->add_render_attribute( 'link2', 'rel', 'nofollow' );
    }
}
if ( ! empty( $settings['title_link']['url'] ) ) {
    $widget->add_render_attribute( 'title_link', 'href', $settings['title_link']['url'] );

    if ( $settings['title_link']['is_external'] ) {
        $widget->add_render_attribute( 'title_link', 'target', '_blank' );
    }

    if ( $settings['title_link']['nofollow'] ) {
        $widget->add_render_attribute( 'title_link', 'rel', 'nofollow' );
    }
}

$img_size = '';
if(!empty($settings['img_size'])) {
    $img_size = $settings['img_size'];
} else {
    $img_size = 'full';
}
?>
<div class="pxl-showcase layout1 <?php if($settings['scroll_effect'] == 'true') { echo 'pxl-showcase-scroll'; } ?> <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" data-wow-duration="<?php echo esc_attr($settings['pxl_animate_duration']); ?>s">
    <div class="pxl-item--inner">
        <?php if (!empty($settings['image']['url'])) : ?>
            <div class="pxl-item--image">
                <?php if(!empty($settings['image']['id'])) :
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['image']['id'],
                        'thumb_size' => $img_size,
                        'class' => 'image-light no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail']; ?>
                    <div class="item--image image-light"><?php echo wp_kses_post($thumbnail); ?></div>
                <?php endif; ?>
                <?php if(!empty($settings['darkmode_image']['id'])) :
                    $img_dark = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['darkmode_image']['id'],
                        'thumb_size' => $img_size,
                        'class' => 'image-dark no-lazyload',
                    ));
                    $thumbnail_dark = $img_dark['thumbnail']; ?>
                    <div class="item--image image-dark"><?php echo wp_kses_post($thumbnail_dark); ?></div>
                <?php endif; ?>
                <?php if(!empty($settings['btn_text1']) || !empty($settings['btn_text2']) ) { ?>
                    <div class="pxl-item--button">
                        <?php if(!empty($settings['btn_text1']) || ! empty($settings['link1']['url'])) { ?>
                            <a class="item--link" <?php pxl_print_html($widget->get_render_attribute_string( 'link1' )); ?>>
                                <span class="pxl-wobble" data-animation="pxl-xspin">
                                    <?php $words = explode(' ', $settings['btn_text1']);
                                    foreach ($words as $word) {
                                        echo '<span>' . htmlspecialchars($word) . '</span> ';
                                    } ?>
                                </span>
                            </a>
                        <?php } ?>
                        <?php if(!empty($settings['btn_text2']) || ! empty($settings['link2']['url'])) { ?>
                            <a class="item--link" <?php pxl_print_html($widget->get_render_attribute_string( 'link2' )); ?>>
                                <span class="pxl-wobble" data-animation="pxl-xspin">
                                    <?php $words = explode(' ', $settings['btn_text2']);
                                    foreach ($words as $word) {
                                        echo '<span>' . htmlspecialchars($word) . '</span> ';
                                    } ?>
                                </span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php if ($settings['notification'] == 'true' && !empty($settings['notification_label'])) { ?>
                        <span class="notification"><?php echo pxl_print_html($settings['notification_label']); ?></span>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['title'])) : ?>
            <div class="pxl-item--title">
                <?php if(!empty($settings['title_link']['url'])) { ?><a <?php pxl_print_html($widget->get_render_attribute_string('title_link')); ?>><?php } ?>
                    <?php echo wp_kses_post($editor_title); ?>
                <?php if(!empty($settings['title_link']['url'])) { ?></a><?php } ?>
            </div>
        <?php endif; ?>
    </div>
</div>