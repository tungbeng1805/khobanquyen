<?php
$html_id = pxl_get_element_id($settings);
$tax = ['portfolio-category'];
$select_post_by = $widget->get_setting('select_post_by', '');
$source = $post_ids = [];
if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
}
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
extract(pxl_get_posts_of_grid(
    'portfolio', 
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids],
    $tax
));
$filter_default_title = $widget->get_setting('filter_default_title', 'All');
if($settings['col_xl'] == '5') {
    $col_xl = 'pxl5';
} else {
    $col_xl = 12 / intval($widget->get_setting('col_xl', 4));
}

$col_xxl = $widget->get_setting('col_xxl', '');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
} elseif($col_xxl == '5') {
    $col_xxl = 'pxl5';
} else {
    $col_xxl = 12 / intval($widget->get_setting('col_xxl', 4));
}

$col_lg = 12 / intval($widget->get_setting('col_lg', 4));
$col_md = 12 / intval($widget->get_setting('col_md', 3));
$col_sm = 12 / intval($widget->get_setting('col_sm', 2));
$col_xs = 12 / intval($widget->get_setting('col_xs', 1));
$grid_sizer = "col-xxl-{$col_xxl} col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$grid_class = '';
$grid_class = 'pxl-grid-inner pxl-grid-masonry row';

$filter = $widget->get_setting('filter', 'false');
$filter_type = $widget->get_setting('filter_type', 'normal');
$filter_style = $widget->get_setting('filter_style', 'style-1');
$filter_alignment = $widget->get_setting('filter_alignment', 'center');
$pagination_type = $widget->get_setting('pagination_type', 'pagination');

$post_type = $widget->get_setting('post_type', 'portfolio');
$layout = $widget->get_setting('layout_'.$post_type, 'portfolio-1');

$wg_heading = $widget->get_setting('wg_heading');
$show_button = $widget->get_setting('show_button');
$show_category = $widget->get_setting('show_category');
$show_excerpt = $widget->get_setting('show_excerpt');
$num_words = $widget->get_setting('num_words');
$button_text = $widget->get_setting('button_text');
$img_size = $widget->get_setting('img_size');
$grid_masonry = $widget->get_setting('grid_masonry');
$pxl_animate = $widget->get_setting('pxl_animate');

$load_more = array(
    'tax'             => $tax,
    'post_type'       => $post_type,   
    'layout'          => $layout,
    'startPage'       => $paged,
    'maxPages'        => $max,
    'total'           => $total,
    'perpage'         => $limit,
    'filter'          => $filter,
    'filter_type'     => $filter_type,
    'nextLink'        => $next_link,
    'source'          => $source,
    'orderby'         => $orderby,
    'order'           => $order,
    'limit'           => $limit,
    'post_ids'        => $post_ids,
    'col_xxl'          => $col_xxl,
    'col_xl'          => $col_xl,
    'col_lg'          => $col_lg,
    'col_xxl'          => $col_xxl,
    'col_md'          => $col_md,
    'col_sm'          => $col_sm,
    'col_xs'          => $col_xs,
    'pagination_type' => $pagination_type,
    'show_button'     => $show_button,
    'button_text'     => $button_text,
    'num_words'       => $num_words,
    'show_category'     => $show_category,
    'show_excerpt'     => $show_excerpt,
    'img_size'        => $img_size,
    'grid_masonry'    => $grid_masonry,
    'pxl_animate'     => $pxl_animate,
);

$wrap_attrs = [
    'id'               => $html_id,
    'class'            => trim('pxl-grid pxl-portfolio-grid pxl-portfolio-grid-layout3 pxl-portfolio-style3'),
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
    echo '<div class="pxl-no-post-grid">'.esc_html__( 'No Post Found', 'maiko' ). '</div>';
    return;
}
?>

<div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?> data-layout="<?php echo esc_attr($settings['layout_mode']); ?>">
    <?php if ($select_post_by == 'term_selected' && $filter == "true"): ?>
        <div class="pxl-grid-filter">
            <div class="pxl--filter-inner">
                <span class="filter-item active" data-filter="*">
                    <?php echo esc_html($filter_default_title); ?>
                    <?php if ($settings['filter_style'] == 'style-2') { ?>
                        <span class="filter-item-count">
                            <?php
                            echo count($posts); 
                            ?>
                        </span> 
                    <?php } ?>
                </span>
                <?php foreach ($categories as $category):
                    $category_arr = explode('|', $category);
                    $term = get_term_by('slug',$category_arr[0], $category_arr[1]);
                    $tax_count = 0;
                    foreach ($posts as $key => $post){
                        $this_terms = get_the_terms( $post->ID, 'portfolio-category' );
                        $term_list = [];
                        foreach ($this_terms as $t) {
                            $term_list[] = $t->slug;
                        } 
                        if(in_array($term->slug,$term_list))
                            $tax_count++;
                    } 
                    if($tax_count > 0): ?>
                        <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                            <?php echo esc_html($term->name); ?>
                            <?php if ($settings['filter_style'] == 'style-2') { ?>
                                <span class="filter-item-count">
                                    <?php
                                    echo esc_html($tax_count); 
                                    ?>
                                </span> 
                            <?php } ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="filter-marker"></div>
        </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="15">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php maiko_get_post_grid($posts, $load_more); ?>
    </div>
    <?php if ($pagination_type == 'pagination') { ?>
        <div class="pxl-grid-pagination">
            <?php maiko()->page->get_pagination($query, true); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore') { ?>
        <div class="pxl-load-more">
            <span class="btn-grid-loadmore ">
                <span class="pxl-loadmore-text" data-text="Learn More Services"><?php echo esc_html__('Load More Projects', 'maiko') ?></span>
                <span class="pxl-load-icon"></span>
            </span>
        </div>
    <?php } ?>
</div>