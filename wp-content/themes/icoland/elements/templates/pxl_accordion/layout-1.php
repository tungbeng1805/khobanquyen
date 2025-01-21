<?php
$html_id = pxl_get_element_id($settings);
$active = intval($settings['active']);
$accordion = $widget->get_settings('accordion');
if(!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion1 <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="wrap-item">
         <?php foreach ($accordion as $key => $value):
            $is_active = ($key + 1) == $active;
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
            ?>

            <div class="pxl--item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <<?php pxl_print_html($settings['title_tag']); ?> class="pxl-item-accordion overlay" data-target="<?php echo esc_attr('#pxl-accordion-'.$pxl_id.$html_id); ?>">
                </<?php pxl_print_html($settings['title_tag']); ?>>
                <<?php pxl_print_html($settings['title_tag']); ?> class="pxl-item-accordion" data-target="<?php echo esc_attr('#pxl-accordion-'.$pxl_id.$html_id); ?>">
                <span><?php echo wp_kses_post($title); ?></span>
                <?php if ($settings['style_arr']=='plus') {?>
                    <i class='icon-plus'></i>
                <?php } ?>
                <?php if ($settings['style_arr']=='arr') {?>
                     <i class="far fa-chevron-down"></i>
                <?php } ?>
                </<?php pxl_print_html($settings['title_tag']); ?>>
                <div id="<?php echo esc_attr('pxl-accordion-'.$pxl_id.$html_id); ?>" class="pxl-item--content-acc" <?php if($is_active){ ?>style="display: block;"<?php } ?>><?php echo wp_kses_post(nl2br($desc)); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>