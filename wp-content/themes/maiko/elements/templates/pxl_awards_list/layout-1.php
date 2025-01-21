<?php if(isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
<div class="pxl-awards-list pxl-awards-list1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="content-inner">
        <?php foreach ($settings['lists'] as $key => $value):
            $image = isset($value['image']) ? $value['image'] : '';
            ?>
            <div class="pxl--item fade-in-up" data-target=".item-img-<?php echo esc_attr($key)?>">
                <?php if(!empty($value['content'])) : ?>
                    <div class="pxl-item-content">
                        <label class="pxl-year pxl-empty"><?php echo esc_attr($value['label']); ?></label>
                        <label class="pxl-title pxl-empty"><?php echo pxl_print_html($value['content'])?></label>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="pxl-imgs-hover absolute">
            <?php foreach ($settings['lists'] as $key => $value):  ?>
                <?php if(!empty($value['image']['url'])): ?>
                    <div class="img-item pxl-absoluted overflow-hidden item-img-<?php echo esc_attr($key)?>">
                        <div class="img-inner pxl-absoluted overflow-hidden">
                            <img src="<?php echo esc_url($value['image']['url'])?>" class="img-hv-ac img-cover-center w-100 h-100" alt="image hover">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?> 
        </div>
    </div>
</div>
<?php endif; ?>