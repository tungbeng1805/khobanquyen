<?php
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');

$col_xl = 12 / intval($col_xl);
$col_lg = 12 / intval($col_lg);
$col_md = 12 / intval($col_md);
$col_sm = 12 / intval($col_sm);
$col_xs = 12 / intval($col_xs);

$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
?>
<?php if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
<div class="pxl-grid pxl-testimonial-grid pxl-testimonial-grid2 <?php echo esc_attr($settings['style']); ?>" data-layout="<?php echo esc_attr($settings['layout_mode']); ?>">
    <div class="pxl-grid-inner pxl-grid-masonry row" data-gutter="15">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php foreach ($settings['testimonial'] as $key => $value):
           $title = isset($value['title']) ? $value['title'] : '';
           $position = isset($value['position']) ? $value['position'] : '';
           $title_rate = isset($value['title_rate']) ? $value['title_rate'] : '';
           $desc = isset($value['description']) ? $value['description'] : '';
           ?>
           <div class="<?php echo esc_attr($item_class); ?>">
            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                <?php if (!empty($title_rate)) { ?>
                    <div class="title-rate"><?php echo esc_html($title_rate); ?></div>  
                <?php } ?>
                <div class="top-content">
                    <div class="quote">
                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fm-qt.png'); ?>" />
                    </div>
                    <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
                </div>
                <div class="bottom-content">
                    <h3 class="pxl-item--title">    
                        <?php echo pxl_print_html($title); ?>
                    </h3>
                    <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php endif; ?>
