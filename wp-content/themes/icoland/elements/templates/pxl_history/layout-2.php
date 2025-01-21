<div class="pxl-history2">
  <?php if(isset($settings['history']) && !empty($settings['history']) && count($settings['history'])): ?>
  <div class="pxl-history-l2" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php
    foreach ($settings['history'] as $key => $history): ?>
      <?php
      $image = isset($history['image']) ? $history['image'] : '';
      $item_cls = [ 'elementor-repeater-item-'.$history['_id'] ]; 
      $item_at = [ 'elementor-repeater-item-'.$history['_id'] ]; 
      ?>
      <div class="corner-box <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo implode(' ', $item_cls) ?> <?php echo esc_attr($history['it_active']); ?>">
        <div class="wrap-content">
            <div class="line"></div>
            <div class="line2"></div>
            <div class="box"></div>
            <div class="date"><?php echo pxl_print_html($history['date']); ?></div>
            <div class="title"><?php echo pxl_print_html($history['text']); ?></div>
            <div class="desc"><?php echo pxl_print_html($history['decs']); ?></div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div> 