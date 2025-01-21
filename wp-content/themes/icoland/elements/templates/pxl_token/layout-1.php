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
$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
?>
<?php if(isset($settings['token']) && !empty($settings['token']) && count($settings['token'])): ?>
<div class="pxl-grid pxl-token-grid pxl-token-grid1 pxl-token-layout1 <?php echo esc_attr($settings['style']); ?>">
    <div class="pxl-grid-inner pxl-grid-masonry row" data-gutter="15">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php foreach ($settings['token'] as $key => $value):
         $title = isset($value['title']) ? $value['title'] : '';
         $position = isset($value['position']) ? $value['position'] : '';
        ?>
        <div class="<?php echo esc_attr($item_class); ?>">
            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                <h5 class="pxl-item--title">    
                        <?php echo pxl_print_html($title); ?>
                </h5>
                <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php endif; ?>
