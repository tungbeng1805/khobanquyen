<?php
$widget->add_render_attribute( 'counter', [
    'class' => 'pxl-counter--value '.$settings['effect'].' '.$settings['custom_font'].'',
    'data-duration' => $settings['duration'],
    'data-startnumber' => $settings['starting_number'],
    'data-endnumber' => $settings['ending_number'],
    'data-to-value' => $settings['ending_number'],
    'data-delimiter' => $settings['thousand_separator_char'],
] );
$widget->add_render_attribute( 'counter7', [
    'class' => 'pxl-counter--value '.$settings['effect'].'',
    'data-duration' => $settings['duration'],
    'data-startnumber' => $settings['starting_number'],
    'data-endnumber' => $settings['ending_number7'],
    'data-to-value' => $settings['ending_number7'],
    'data-delimiter' => $settings['thousand_separator_char7'],
] ); ?>
<div class="pxl-counter pxl-counter7 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-counter--inner">
        <div class="pxl-counter--holder ">
            <?php if ( $settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value']) ) : ?>
                <div class="pxl-counter--icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
                <div class="pxl-counter--icon">
                    <?php $img_icon  = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['icon_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail_icon    = $img_icon['thumbnail'];
                    echo pxl_print_html($thumbnail_icon); ?>
                </div>
            <?php endif; ?>
            <?php if ($settings['layout'] == '7') { ?>
                <span class="pxl-counter--prefix el-empty"><?php echo pxl_print_html($settings['prefix']); ?></span>
            <?php } ?>
            <?php if(!empty($settings['title'])) : ?>
                <div class="pxl-counter--title <?php echo esc_attr($settings['title_w']); ?>"><?php echo pxl_print_html($settings['title']); ?></div>
            <?php endif; ?>
            <div class="pxl-counter--number ">
                <?php if ($settings['layout'] != '7') { ?>
                    <span class="pxl-counter--prefix el-empty"><?php echo pxl_print_html($settings['prefix']); ?></span>
                <?php } ?>
                <span <?php pxl_print_html($widget->get_render_attribute_string( 'counter' )); ?>><?php echo esc_html($settings['starting_number']); ?></span>
                <?php if(!empty($settings['suffix'])) : ?>
                    <span class="pxl-counter--suffix"><?php echo pxl_print_html($settings['suffix']); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="pxl-counter--holder pxl-counter--revert active">
            <?php if ($settings['layout'] == '7') { ?>
                <span class="pxl-counter--prefix el-empty"><?php echo pxl_print_html($settings['prefix7']); ?></span>
            <?php } ?>
            <?php if(!empty($settings['title7'])) : ?>
                <div class="pxl-counter--title <?php echo esc_attr($settings['title_w']); ?>"><?php echo pxl_print_html($settings['title7']); ?></div>
            <?php endif; ?>
            <div class="pxl-counter--number ">
                <?php if ($settings['layout'] != '7') { ?>
                    <span class="pxl-counter--prefix el-empty"><?php echo pxl_print_html($settings['prefix7']); ?></span>
                <?php } ?>
                <span <?php pxl_print_html($widget->get_render_attribute_string( 'counter7' )); ?>><?php echo esc_html($settings['starting_number']); ?></span>
            </div>
        </div>
    </div>
</div>