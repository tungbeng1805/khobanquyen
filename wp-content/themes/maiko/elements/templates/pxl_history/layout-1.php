<div class="pxl-history">
    <div class="dot dot1"></div>
    <div class="dot dot2"></div>
  <?php
  if(isset($settings['history']) && !empty($settings['history']) && count($settings['history'])): ?>
    <div class=" pxl-history-l1 " data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php
        foreach ($settings['history'] as $key => $history):
            $image = isset($history['image']) ? $history['image'] : '';
            $text = isset($history['text']) ? $history['text'] : '';
            $decs = isset($history['decs']) ? $history['decs'] : '';
            $btn_text = isset($history['btn_text']) ? $history['btn_text'] : '';
            $btn_link = isset($history['btn_link']) ? $history['btn_link'] : '';
            ?>
            <div class="entry-body <?php echo esc_attr($settings['pxl_animate']); ?>">
                <?php if(!empty($image['id'])) { 
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => 'full',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];?>
                    <div class="pxl-item--image wow fadeInUp" >
                        <?php echo wp_kses_post($thumbnail); ?>
                    </div>
                <?php } ?>
                <div class="wrap-content ">
                    <div class="date ">
                        <?php echo pxl_print_html($history['date']); ?>
                    </div>
                    <h4 class="title wow fadeInUp"><?php echo pxl_print_html($history['text']); ?></h4>
                    <p class="desc wow fadeInUp"><?php echo pxl_print_html($history['decs']); ?></p>
                    <a href="<?php echo esc_url($btn_link); ?>" class="btn-link wow fadeInUp"> <?php echo pxl_print_html($btn_text); ?>
                        <i class="far fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</div>
