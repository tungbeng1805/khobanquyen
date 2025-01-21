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

$template = (int)$widget->get_setting('popup_template','0');
if($template > 0 ){
    if ( !has_action( 'pxl_anchor_target_page_popup_'.$template) ){
        add_action( 'pxl_anchor_target_page_popup_'.$template, 'maiko_hook_anchor_page_popup' );
    } 
}

?>
<div id="pxl-<?php echo esc_attr($html_id) ?>" class="pxl-button <?php echo esc_attr($settings['btn_action'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn <?php if(!empty($settings['btn_icon'])) { echo 'pxl-icon-active'; } ?> <?php echo esc_attr($settings['btn_text_effect'].' '.$settings['btn_style'].' '.$settings['pxl_animate'].' '.$settings['btn_w'].' pxl-icon--'.$settings['icon_align']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" data-target=".pxl-page-popup-template-<?php echo esc_attr($template); ?>">
        <?php if ($settings['btn_text_effect'] != 'btn-text-applied') { ?>
            <?php if(!empty($settings['btn_icon'])) { \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); } ?>
        <?php } else { ?>
            <span class="btn-icon-left">
                <?php if (!empty($settings['btn_icon'])) { 
                    \Elementor\Icons_Manager::render_icon($settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i'); 
                } ?>
            </span>
        <?php } ?>
        <?php if ($settings['btn_style'] == 'btn-drow-arrow') : ?>
            <span class="crossline-arrow">
                <span class="crossline1"></span>
                <span class="crossline2"></span>
            </span>
        <?php endif; ?>
        <span class="pxl--btn-text" data-text="<?php echo esc_attr($settings['text']); ?>">
            <?php 
            if($settings['btn_text_effect'] == 'btn-text-nina' || $settings['btn_text_effect'] == 'btn-text-nanuk') {
                $btn_text = $settings['text'];
                $chars = preg_split('//u', $btn_text, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($chars as $value) {
                    if($value == ' ') {
                        echo '<span class="spacer">&nbsp;</span>';
                    } else {
                        echo '<span>'.$value.'</span>';
                    }
                }
            } elseif($settings['btn_text_effect'] == 'btn-text-applied') {
                $btn_text = $settings['text'];
                $chars = preg_split('//u', $btn_text, -1, PREG_SPLIT_NO_EMPTY);
                $totalChars = count($chars) - 1;
                echo '<span class="chars">';
                foreach ($chars as $index => $value) {
                    $class = $value == ' ' ? 'spacer' : '';
                    $char = $value == ' ' ? '&nbsp;' : htmlspecialchars($value);
                    echo '<span class="' . $class . '" style="--chars-index: ' . $index . '; --chars-last-index: ' . ($totalChars - $index) . ';">' . $char . '</span>';
                }
                echo '</span>';
            } elseif($settings['btn_text_effect'] == 'btn-text-smoke' || $settings['btn_text_effect'] == 'btn-text-reverse') { ?>
                <span class="pxl-text--front">
                    <span class="pxl-text--inner">
                        <?php 
                        $btn_text = $settings['text'];
                        $chars = preg_split('//u', $btn_text, -1, PREG_SPLIT_NO_EMPTY);
                        foreach ($chars as $value) {
                            if($value == ' ') {
                                echo '<span class="spacer">&nbsp;</span>';
                            } else {
                                echo '<span>'.$value.'</span>';
                            }
                        } ?>
                    </span>
                </span>
                <span class="pxl-text--back">
                    <span class="pxl-text--inner">
                        <?php 
                        $btn_text = $settings['text'];
                        $chars = preg_split('//u', $btn_text, -1, PREG_SPLIT_NO_EMPTY);
                        foreach ($chars as $value) {
                            if($value == ' ') {
                                echo '<span class="spacer">&nbsp;</span>';
                            } else {
                                echo '<span>'.$value.'</span>';
                            }
                        } ?>
                    </span>
                </span>
            <?php } else {
                echo pxl_print_html($settings['text']);
            }
            ?>
        </span>
        <?php if ($settings['btn_text_effect'] == 'btn-text-applied') { ?>
            <span class="btn-icon-right">
                <?php if (!empty($settings['btn_icon'])) { 
                    \Elementor\Icons_Manager::render_icon($settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i'); 
                } ?>
            </span>
        <?php } ?>
        <?php if ($settings['btn_style'] == 'btn-stroke') : ?>
            <svg class="pxl-svg-line" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 407"><path d="M972.93,86.54S671-39.25,337.37,29.6c-80.16,16.54-161,42.55-230.72,86.3-41.44,26-92,65.5-97.81,118.12-6,54.11,45,90.17,88,110.52,70.87,33.53,149.4,43.59,226.73,49.23,125.73,9.17,252.43,1.74,377.33-14.07,51.43-6.5,102.76-14.71,152.76-28.37,61-16.66,156.08-57.51,137.63-137.73C979.5,162.21,933.23,134.78,887,117.4,814.24,90,734.45,79.35,657.54,71.31c-7-.73-13.94-1.42-20.93-2"/></svg>
        <?php endif; ?>
    </a>
</div>