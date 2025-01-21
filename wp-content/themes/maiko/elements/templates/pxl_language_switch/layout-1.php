<?php if(isset($settings['language']) && !empty($settings['language']) && count($settings['language'])): ?>
<div class="pxl-language-switch <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="language">
        <?php if ($settings['style'] !='style-3'): ?>
            <div class="title"> <?php echo esc_html__('language','maiko') ?></div>
        <?php endif ?>
        <div class="language-first"> 
            <?php if ($settings['style'] !='style-3'): ?>
                <?php echo esc_html__('En','maiko') ?> <i class="caseicon-angle-arrow-down"></i></div>
            <?php endif ?>
            <?php if ($settings['style'] =='style-3'): ?>
                <?php echo esc_html__('EN','maiko') ?> <i class="caseicon-angle-arrow-down"></i></div>
            <?php endif ?>
        </div>
        <div class="list-language">
            <?php foreach ($settings['language'] as $key => $value):
                $link_key = $widget->get_repeater_setting_key( 'link', 'value', $key );
                if ( ! empty( $value['link']['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

                    if ( $value['link']['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $value['link']['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );
                if(!empty($value['name'])) : ?>
                    <div class="pxl--item">
                        <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                            <?php echo esc_attr($value['name']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>