<?php
use Elementor\Embed;
$html_id = pxl_get_element_id($settings);
$tax = ['category'];
$select_post_by = $widget->get_setting('select_post_by', 'term_selected');
$source = $post_ids = $post_ids_unselected = [];

if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
    $post_ids_unselected  = $widget->get_setting('source_'.$settings['post_type'].'_post_ids_unselected', '');
}

if($settings['col_xl'] == '5') {
    $col_xl = 'pxl5';
} else {
    $col_xl = 12 / intval($widget->get_setting('col_xl', 4));
}
$col_lg = 12 / intval($widget->get_setting('col_lg', 4));
$col_md = 12 / intval($widget->get_setting('col_md', 3));
$col_sm = 12 / intval($widget->get_setting('col_sm', 2));
$col_xs = 12 / intval($widget->get_setting('col_xs', 1));
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

$grid_class = 'pxl-grid-inner pxl-list-inner d-flex-wrap relative row pxl-accordion';

$orderby   = $widget->get_setting('orderby', 'date');
$order     = $widget->get_setting('order', 'desc');
$limit     = $widget->get_setting('limit', 6);
$active = intval($settings['active']);
$query_result = pxl_get_posts_of_grid('service', ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids, 'post_not_in' => $post_ids_unselected ], $tax);

extract($query_result);

$post_type            = $widget->get_setting('post_type','service');
$layout               = $widget->get_setting('layout_'.$post_type, 'service-list-2');
$layout_mode          = $widget->get_setting('layout_mode', 'fitRows');
$pagination_type      = $widget->get_setting('pagination_type', 'pagination');
$pxl_animate = $widget->get_setting('pxl_animate');

$load_more = array(
    'tax'                 => $tax,
    'post_type'           => $post_type,   
    'layout'              => $layout,
    'select_post_by'      => $select_post_by,
    'layout_mode'         => $layout_mode,
    'startPage'           => $paged,
    'maxPages'            => $max,
    'total'               => $total,
    'perpage'             => $limit,
    'perpage'             => $limit,
    'active'            => $active,
    'source'              => $source,
    'post_ids'            => $post_ids,
    'orderby'             => $orderby,
    'order'               => $order,
    'limit'               => $limit,
    'col_xl'          => $col_xl,
    'col_lg'          => $col_lg,
    'col_md'          => $col_md,
    'col_sm'          => $col_sm,
    'col_xs'          => $col_xs,

    'item_animation'          => $widget->get_setting('item_animation', ''),  
    'item_animation_duration' => $widget->get_setting('item_animation_duration', 'normal'),  
    'item_animation_delay'    => $widget->get_setting('item_animation_delay', '150'),  

    'img_size'            => $widget->get_setting('img_size','773x574'),
    'show_date'           => $widget->get_setting('post_date'),
    'show_author'         => $widget->get_setting('post_author'),
    'show_number'       => $widget->get_setting('post_number'),
    'show_comment'        => $widget->get_setting('post_comment'),
    'show_excerpt'        => $widget->get_setting('post_excerpt'),
    'num_words'           => $widget->get_setting('post_num_words', 36),
    'show_readmore'       => $widget->get_setting('post_readmore'),
    'readmore_text'       => $widget->get_setting('post_readmore_text'),
    'post_share'          => $widget->get_setting('post_share'),
    'pxl_animate'     => $pxl_animate,

    'pagination_type'     => $pagination_type,
    'show_toolbar'        => $widget->get_setting('show_toolbar','hide'),
    'wg_type'             => 'service-list',
);

$wrap_attrs = [
    'id'               => $html_id,
    'class'            => trim('pxl-grid pxl-service-list ' . ($settings['scroll_effect'] != 'none' ? 'pxl-check-scroll ' : '') . 'pxl-effect--3d ' . esc_attr($settings['scroll_effect']) . ' layout-' . $layout),
    'data-layout-mode' => $layout_mode,
    'data-start-page'  => $paged,
    'data-max-pages'   => $max,
    'data-total'       => $total,
    'data-perpage'     => $limit,
    'data-next-link'   => $next_link
];

if ($pagination_type != 'false'){
    $wrap_attrs['data-loadmore'] = json_encode($load_more);
}

$widget->add_render_attribute( 'wrapper', $wrap_attrs );

if( count($posts) <= 0){
    echo '<div class="pxl-no-service-list">'.esc_html__( 'No Post Found', 'maiko' ). '</div>';
    return;
}
?>

<div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?>>
    <?php if($settings['show_toolbar'] == 'show'): ?>
        <div class="service-list-toolbar row align-items-center justify-content-between">
            <div class="col col-sm-auto">
                <?php 
                $limitpage = ($limit >= $total) ? $total : $limit;
                printf(
                    '<span class="result-count">%1$s %2$s %3$s %4$s %5$s</span>',
                    esc_html__('Showing','maiko'),
                    '1-'.$limitpage,
                    esc_html__('of','maiko'),
                    $total,
                    esc_html__('results','maiko')
                );
                ?>
            </div>
            <div class="col col-sm-auto">
                <select name="orderby" class="orderby nice-select">
                    <option value="date"><?php esc_html_e('Lastest Posts','maiko') ?></option>
                    <option value="author"><?php esc_html_e('Posts Author','maiko') ?></option>
                    <option value="title"><?php esc_html_e('Posts Title','maiko') ?></option>
                    <option value="rand"><?php esc_html_e('Posts Random','maiko') ?></option>
                    <option value="comment_count"><?php esc_html_e('Comment Count','maiko') ?></option>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="15"> 
        <?php maiko_get_post_list($posts, $load_more); ?>
    </div>

    <?php if ($pagination_type == 'pagination') { ?>
        <div class="pxl-grid-pagination pagin-post">
            <?php maiko()->page->get_pagination($query, true); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore'): 
        $icon_pos = ( !empty($settings['loadmore_icon']) && !empty($settings['icon_align'])) ? $settings['icon_align'] : ''; 
        ?>
        <div class="pxl-load-more " data-loading-text="<?php echo esc_attr__('Loading', 'maiko') ?>" data-loadmore-text="<?php echo esc_html($settings['loadmore_text']); ?>">
            <span class="btn btn-grid-loadmore">
                <span class="btn-text"><?php echo esc_html($settings['loadmore_text']); ?></span>
            </span>
        </div>
    <?php endif; ?>
</div>