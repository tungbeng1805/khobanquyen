<div class="pxl-process pxl-process1 <?php echo esc_attr($settings['pxl_animate'] .' '.$settings['style']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if(!empty($settings['step'])) : ?>
        <div class="pxl-item--step">
            <?php echo esc_attr($settings['step']); ?>
        </div>
    <?php endif; ?>
    <div class="pxl-item--inner">
        <?php if (!empty($settings['image']['id']) ) : ?>
            <div class="pxl-item--image">
                <?php $img  = pxl_get_image_by_size( array(
                    'attach_id'  => $settings['image']['id'],
                    'thumb_size' => 'full',
                ) );
                $thumbnail    = $img['thumbnail'];
                echo pxl_print_html($thumbnail); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['pxl_icon']['value'])) { 
            echo '<div class="pxl-icon">';
            \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
            echo '</div>';
        } ?>
        <div class="wrap-content">
            <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title el-empty"><?php echo pxl_print_html($settings['title']); ?></<?php echo esc_attr($settings['title_tag']); ?>>
            <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc']); ?></div>
            <?php if(isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
            <ul class="pxl-list-text">
                <?php foreach ($settings['lists'] as $key => $value): ?>
                    <li class="pxl--item">
                        <?php echo pxl_print_html($value['label']); ?>
                    </li>
                <?php endforeach; ?>
                </ul> <?php endif; ?>
            </div>
        </div>
    </div>