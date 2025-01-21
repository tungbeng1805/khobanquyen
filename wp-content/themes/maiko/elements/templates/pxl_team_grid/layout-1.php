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
<?php if(isset($settings['team']) && !empty($settings['team']) && count($settings['team'])): ?>
<div class="pxl-grid pxl-team-grid pxl-team-grid1 pxl-team-layout1 pxl-effect--3d <?php echo esc_attr($settings['style_l1']); ?>" data-layout="<?php echo esc_attr($settings['layout_mode']); ?>">
    <?php if ($settings['show_fillter'] == 'true'): ?>
        <div class="pxl-grid-filter normal style-1">
            <div class="pxl--filter-inner">
                <span class="filter-item active" data-filter="*">All</span>
                <?php foreach ($settings['list_name'] as $key2 => $value2):
                    $title_fillter = isset($value2['title_fillter']) ? $value2['title_fillter'] : '';
                    ?>
                    <span class="filter-item" data-filter="<?php echo esc_attr('.' . $title_fillter); ?>">
                        <?php echo esc_html($title_fillter); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif ?>
    <div class="pxl-grid-inner pxl-grid-masonry row" data-gutter="15">
        <?php foreach ($settings['team'] as $key => $value):
            $title = isset($value['title']) ? $value['title'] : '';
            $position = isset($value['position']) ? $value['position'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
            $popup_template = isset($value['popup_template']) ? $value['popup_template'] : '';
            $image = isset($value['image']) ? $value['image'] : '';
            $social = isset($value['social']) ? $value['social'] : '';
            $link = isset($value['link']) ? $value['link'] : '';
            $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
            if ( ! empty( $link['url'] ) ) {
                $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                if ( $link['is_external'] ) {
                    $widget->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $link['nofollow'] ) {
                    $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
            }
            $link_attributes = $widget->get_render_attribute_string( $link_key );
            $cat = isset($value['cat']) ? $value['cat'] : '';
            ?>
            <div class="<?php echo esc_attr($item_class); ?> <?php echo esc_attr($cat); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                    <div class="pxl-effect--direction">   
                        <?php if(!empty($image['id'])) { 
                            $img = pxl_get_image_by_size( array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => $image_size,
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail = $img['thumbnail'];
                            ?>
                            <div class="pxl-item--image">
                                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        <?php } ?>
                        <div class="pxl-item--holder pxl-effect--content">
                            <div class="pxl-item--meta pxl-flex-grow ">
                                <h3 class="pxl-item--title">    
                                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php echo pxl_print_html($title); ?></a>
                                </h3>
                                <div class="pxl-item--position"><?php echo pxl_print_html($position); ?></div>
                                <div class="pxl-item--desc"><?php echo pxl_print_html($desc); ?></div>
                                <?php if(!empty($social)): ?>
                                    <div class="pxl-item--social">
                                     <?php
                                     $team_social = json_decode($social, true);
                                     foreach ($team_social as $value):
                                        if (!empty($value['url'])): ?>
                                            <a href="<?php echo esc_url($value['url']); ?>">
                                            <?php endif; ?>
                                            <span><?php echo pxl_print_html($value['content']); ?></span>
                                            <?php if (!empty($value['url'])): ?>
                                            </a>
                                        <?php endif;
                                    endforeach;
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $link['url'] ) ) { ?><a class="btn-arrow" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="512" viewBox="0 0 24 24" width="512"><path d="m16.0039 9.414-8.60699 8.607-1.414-1.414 8.60599-8.607h-7.58499v-2h10.99999v11h-2z" fill="rgb(0,0,0)"/></svg>
                            <?php } ?>
                            <?php if ( ! empty( $link['url'] ) ) { ?></a><?php } ?>
                        </div>
                        <?php if ( ! empty( $link['url'] ) ) { ?><a class="overlay" <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
                        <?php if ( ! empty( $link['url'] ) ) { ?></a><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
</div>
</div>
<?php endif; ?>
