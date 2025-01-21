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

if ( ! empty( $settings['link_download']['url'] ) ) {
    $widget->add_render_attribute( 'button2', 'href', $settings['link_download']['url'] );

    if ( $settings['link_download']['is_external'] ) {
        $widget->add_render_attribute( 'button2', 'target', '_blank' );
    }

    if ( $settings['link_download']['nofollow'] ) {
        $widget->add_render_attribute( 'button2', 'rel', 'nofollow' );
    }
}

?>
<div class="pxl-pricing pxl-pricing1 <?php echo esc_attr($settings['pxl_animate'].' '.$settings['popular']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="content-inner">
        <?php if(!empty($settings['title_box'])) : ?>
            <h5 class="pxl-item--title-box el-empty">
                <?php if ($settings['popular']== 'is-popular'): ?>
                    <svg id="fi_3303088" enable-background="new 0 0 512 512" height="14" viewBox="0 0 512 512" width="14" xmlns="http://www.w3.org/2000/svg"><g id="Star"><g><path d="m397.929 498.915-141.929-88.814-141.929 88.813c-5.156 3.267-11.807 3.018-16.772-.586-4.951-3.589-7.222-9.829-5.728-15.762l40.605-162.437-126.812-107.518c-4.688-3.926-6.519-10.313-4.629-16.128 1.89-5.83 7.134-9.917 13.228-10.342l165.514-11.558 62.607-155.288c4.6-11.338 23.232-11.338 27.832 0l62.607 155.288 165.514 11.558c6.094.425 11.338 4.512 13.228 10.342 1.89 5.815.059 12.202-4.629 16.128l-126.813 107.52 40.605 162.437c1.494 5.933-.776 12.173-5.728 15.762-5.067 3.68-11.699 3.763-16.771.585z"></path></g></g></svg>
                <?php endif ?>
                <?php echo pxl_print_html($settings['title_box']); ?>
            </h5>
        <?php endif; ?>
        <?php if (!empty($settings['price']) ) : ?>
            <div class="pxl-item--price">
                <?php echo pxl_print_html($settings['price']); ?>
                <?php if (!empty($settings['time']) ) : ?>
                    <span class="time"><?php echo pxl_print_html($settings['time']); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($settings['desc'])) : ?>
            <p class="pxl-item-description el-empty"><?php echo pxl_print_html($settings['desc']); ?></p>
        <?php endif; ?>

        <?php if(!empty($settings['button_text_docs'])) : ?>
            <div class="pxl-item--button_docs">
                <a class="btn-doc" <?php pxl_print_html($widget->get_render_attribute_string( 'button2' )); ?>>
                    <span><?php echo pxl_print_html($settings['button_text_docs']); ?> </span>
                    <span class="icon-download">
                        <i class="far fa-arrow-to-bottom"></i>
                    </span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(isset($settings['feature']) && !empty($settings['feature']) && count($settings['feature'])): ?>
        <div class="pxl-item--feature ">
            <?php foreach ($settings['feature'] as $key => $value): ?>
                <div class="<?php echo esc_attr($value['active']); ?> d-flex">
                    <div class="content">
                        <?php if ($value['active']== 'is-active'): ?>
                            <i class="far fa-check"></i>
                        <?php endif ?>
                        <?php if ($value['active'] != 'is-active'): ?>
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" id="fi_10412365"><path d="m6.81 25.19a2 2 0 0 0 2.83 0l6.36-6.36 6.36 6.36a2 2 0 0 0 2.83-2.83l-6.36-6.36 6.36-6.36a2 2 0 0 0 -2.83-2.83l-6.36 6.36-6.36-6.36a2 2 0 0 0 -2.83 2.83l6.36 6.36-6.36 6.36a2 2 0 0 0 0 2.83z"></path></svg>
                        <?php endif ?>
                        <?php echo pxl_print_html($value['feature_text'])?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <?php if(!empty($settings['button_text'])) : ?>
        <div class="pxl-item--button">
            <a class="btn-see" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                <span><?php echo pxl_print_html($settings['button_text']); ?> </span>
            </a>
        </div>
    <?php endif; ?>
</div>
</div>