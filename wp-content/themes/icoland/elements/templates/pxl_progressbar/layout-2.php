<?php
if(isset($settings['progressbar_1']) && !empty($settings['progressbar_1'])): ?>
    <div class="pxl-progressbar pxl-progressbar-2">
        <?php foreach ($settings['progressbar_1'] as $key => $progressbar_1): ?>
            <div class="pxl--item <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                <div class="pxl--meta">
                    <h5 class="pxl--title el-empty pxl-mr-20"><?php echo pxl_print_html($progressbar_1['title_1']); ?></h5>
                    <div class="pxl--percentage"><?php echo esc_attr($progressbar_1['percent_1']['size']); ?>%</div>
                </div>
                <div class="pxl--holder">
                    <div class="pxl--progressbar" role="progressbar_1" data-valuetransitiongoal="<?php echo esc_attr($progressbar_1['percent_1']['size']); ?>"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>