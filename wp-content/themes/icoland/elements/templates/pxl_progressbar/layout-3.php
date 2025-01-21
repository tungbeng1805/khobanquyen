<?php
if(isset($settings['progressbar']) && !empty($settings['progressbar'])): ?>
    <div class="pxl-progressbar pxl-progressbar-1 <?php echo esc_attr($settings['style']); ?>">
        <?php foreach ($settings['progressbar'] as $key => $progressbar): ?>
            <div class="pxl--item <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                <div class="pxl--meta">
                    <h5 class="pxl--title el-empty pxl-mr-20"><?php echo pxl_print_html($progressbar['title']); ?></h5>
                    <h5 class="pxl--title pxl--title-end el-empty pxl-mr-20"><?php echo pxl_print_html($progressbar['title_end']); ?></h5>
                </div>
                <div class="pxl--holder">
                    <div class="pxl--progressbar" role="progressbar" data-valuetransitiongoal="<?php echo esc_attr($progressbar['percent']['size']); ?>">
                        <div class="pxl--percentage">
                            <?php if (!empty($progressbar['title_rp'])){
                                echo pxl_print_html($progressbar['title_rp']);
                            }
                            else {
                                echo pxl_print_html($progressbar['percent']['size']).'%'; 
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php if ($progressbar['vl1']): ?>
                    <span class="pxl--value pxl--value1"><?php echo pxl_print_html($progressbar['vl1']); ?></span>
                <?php endif ?>
                <?php if ($progressbar['vl2']): ?>
                    <span class="pxl--value pxl--value2"><?php echo pxl_print_html($progressbar['vl2']); ?></span>  
                <?php endif ?>
                <?php if ($progressbar['vl3']): ?>
                    <span class="pxl--value pxl--value3"><?php echo pxl_print_html($progressbar['vl3']); ?></span>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>