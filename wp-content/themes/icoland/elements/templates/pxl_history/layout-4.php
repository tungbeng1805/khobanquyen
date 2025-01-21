<div class="pxl-history4">
    <?php if(isset($settings['history_2']) && !empty($settings['history_2']) && count($settings['history_2'])): ?>
    <div class="pxl-history-l4  " data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php
        foreach ($settings['history_2'] as $key => $history): ?>
            <?php
            $social = isset($history['social']) ? $history['social'] : '';
            $image = isset($history['image_2']) ? $history['image_2'] : '';
            $item_cls = [ 'elementor-repeater-item-'.$history['_id'] ]; 
            $item_at = [ 'elementor-repeater-item-'.$history['_id'] ]; 
            ?>
            <div class="corner-box <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo implode(' ', $item_cls) ?> ">
                <div class="wrap-content">
                    <div class="date"><?php echo pxl_print_html($history['date_2']); ?></div>
                    <div class="content">
                        <div class="title"><?php echo pxl_print_html($history['text_2']); ?></div>
                        <?php if(!empty($social)): ?>
                            <div class="pxl-item--social">
                                <?php  $team_social = json_decode($social, true);
                                foreach ($team_social as $history): ?>
                                    <div class="list">
                                        <i class="<?php echo esc_attr($history['icon']); ?>"></i>
                                        <span> <?php echo pxl_print_html($history['content']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div> 