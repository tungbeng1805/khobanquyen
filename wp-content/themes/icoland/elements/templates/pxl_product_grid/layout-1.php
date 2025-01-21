<?php
$html_id = pxl_get_element_id($settings);
$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$param_args=[];

$loop = icoland_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
extract($loop);

$layout               = $widget->get_setting('layout', '1');
$filter_default_title = $widget->get_setting('filter_default_title', 'All');
$filter               = $widget->get_setting('filter', 'false');
$pagination_type      = $widget->get_setting('pagination_type', 'false');

$item_animation          = $widget->get_setting('item_animation', '') ;
$item_animation_duration = $widget->get_setting('item_animation_duration', 'normal');
$item_animation_delay    = $widget->get_setting('item_animation_delay', '150');

$img_size = $widget->get_setting('img_size');
$show_cursor_text = $widget->get_setting('show_cursor_text');
$cursor_text = $widget->get_setting('cursor_text');

$data_cursor_text = '';
if(!empty($cursor_text)) {
    $data_cursor_text = $cursor_text;
} else {
    $data_cursor_text = esc_html__('◄ ►', 'icoland');
}

$load_more = array(
    'layout'             => $layout,
    'query_type'         => $query_type,
    'product_ids'        => $product_ids,
    'categories'         => $categories,
    'param_args'         => $param_args,
    'startPage'          => $paged,
    'maxPages'           => $max,
    'total'              => $total,
    'limit'              => $post_per_page,
    'nextLink'           => $next_link,
    'layout_mode'         => 'masonry',
    'filter'              => $filter,
    'item_animation'          => $item_animation ,
    'item_animation_duration' => $item_animation_duration,
    'item_animation_delay'    => $item_animation_delay,
    'col_xs'                  => $widget->get_setting('col_xs', '1'),
    'col_sm'                  => $widget->get_setting('col_sm', '2'),
    'col_md'                  => $widget->get_setting('col_md', '2'),
    'col_lg'                  => $widget->get_setting('col_lg', '3'),
    'col_xl'                  => $widget->get_setting('col_xl', '4'),
    'col_xxl'                 => $widget->get_setting('col_xxl', '4')
);

$widget->add_render_attribute( 'wrapper', [
    'id'               => $html_id,
    'class'            => trim('pxl-grid woocommerce pxl-product-grid layout-'.$layout),
    'data-layout'      =>  'masonry',
    'data-start-page'  => $paged,
    'data-max-pages'   => $max,
    'data-total'       => $total,
    'data-perpage'     => $post_per_page,
    'data-next-link'   => $next_link
]);

if(is_admin())
    $grid_class = 'pxl-grid-inner pxl-grid-masonry-adm row relative';
else
    $grid_class = 'pxl-grid-inner pxl-grid-masonry row relative';

$widget->add_render_attribute( 'grid', 'class', $grid_class);

if( $total <= 0){
    echo '<div class="pxl-no-post-grid">'.esc_html__( 'No Post Found', 'icoland' ). '</div>';
    return;
}

$col_xxl = 'col-xxl-'.str_replace('.', '',12 / floatval( $settings['col_xxl']));
$col_xl  = 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl']));
$col_lg  = 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg']));
$col_md  = 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md']));
$col_sm  = 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm']));
$col_xs  = 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs']));

$item_class = trim(implode(' ', ['pxl-grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$data_animation = [];
$animate_cls = '';
$data_settings = '';
if ( !empty( $item_animation ) ) {
    $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
    $data_animation['animation'] = $item_animation;
    $data_animation['animation_delay'] = $item_animation_delay;
}
$orderby_options = array(
    'menu_order' => __('Default sorting', 'icoland'),
    'popularity' => __('Sort by popularity', 'icoland'),
    'rating'     => __('Sort by average rating', 'icoland'),
    'date'       => __('Sort by latest', 'icoland'),
    'price'      => __('Sort by price: low to high', 'icoland'),
    'price-desc' => __('Sort by price: high to low', 'icoland')
);
$orderby = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : 'menu_order';
$shop_url = get_permalink( wc_get_page_id( 'shop' ) );

?>
<?php if ($posts->found_posts > 0): ?>
    <div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?>>
        <div class="pxl-grid-fillter">
            <?php if($settings['filter'] == 'true' && $settings['search']== 'on') : ?>
                <div class="pxl-header-search-form ">
                    <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                        <input type="text" placeholder="<?php esc_attr_e('Search', 'icoland'); ?>" name="s" class="search-field" />
                        <button type="submit" class="search-submit">
                                <i class="far fa-search"></i>
                        </button> 
                    </form>
                </div>
            <?php endif; ?>
            <div class="ft-right">
               <?php if($settings['filter'] == 'true') : ?>
                <div id="item_category" class="wrap-fillter-atb dropdown">
                    <?php if ($settings['filter_type'] == "ft-2"): ?>
                        <div class="atb-name">
                            Select Categories
                        </div>
                    <?php endif; ?>
                    <a href="javascript:void(0)" class="btn-selector">All Categories</a>
                    <?php if ($filter == "true" && !empty($categories) ): ?>
                        <ul class="grid-filter-wrap pxl-grid-filter pxl-filter-drag">
                            <li class="filter-item active pxl-transtion" data-filter="*"><?php echo esc_html($filter_default_title); ?></li>
                            <?php foreach ($categories as $category): ?>
                                <?php $term = get_term_by('slug',$category, 'product_cat'); ?>
                                <li class="filter-item pxl-transtion" data-filter="<?php echo esc_attr('.' . $term->slug); ?>"><?php echo esc_html($term->name); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if (function_exists('woocommerce_catalog_ordering') && $settings['filter'] == 'true' ): ?>
                <div class="woocommerce-topbar-ordering">
                    <?php
                    echo '<form class="woocommerce-ordering" method="get" action="' . esc_url( $shop_url ) . '">';
                    echo '<select name="orderby" class="orderby">';
                    foreach ($orderby_options as $key => $value) {
                        echo '<option value="' . esc_attr($key) . '" ' . selected($orderby, $key, false) . '>' . esc_html($value) . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="hidden" name="paged" value="1" />';
                    echo '<input type="hidden" name="post_type" value="product" />';
                    echo '</form>';
                    ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <div <?php pxl_print_html($widget->get_render_attribute_string('grid')); ?>>
        <?php
        $d = 0;
        while ($posts->have_posts()) {
            $posts->the_post();
            global $product;
            $d++;
            $term_list = array();
            $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
            $unit_price = get_post_meta($product->get_id(), 'unit_price');
            foreach ($term_of_post as $term) {
                $term_list[] = $term->slug;
            }
            $filter_class = implode(' ', $term_list);

            if ( !empty( $data_animation ) ) {
                $data_animation['animation_delay'] = ((float)$item_animation_delay * $d);
                $data_animations = json_encode($data_animation);
                $data_settings = 'data-settings="'.esc_attr($data_animations).'"';
            }

            ?>
            <div class="<?php echo trim(implode(' ', [$item_class, $filter_class, $animate_cls])); ?> " <?php pxl_print_html($data_settings); ?>>
                <div class="pxl-item--inner ">
                    <div class="woocommerce-product">
                        <?php
                        $image_size = !empty($img_size) ? $img_size : 'full';
                        $img_id     = get_post_thumbnail_id( get_the_ID() );
                        if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)):
                            $img = pxl_get_image_by_size( array(
                                'attach_id'  => $img_id,
                                'thumb_size' => $image_size
                            ) );
                        $thumbnail = $img['thumbnail'];
                        ?>
                    <?php endif; ?>
                    <?php 
                    echo wp_kses_post($thumbnail); ?>
                    <h5 class="woocommerce-product--title">
                        <a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><?php echo esc_attr(get_the_title(get_the_ID())); ?></a>
                    </h5>
                </div>
            </div>
        </div>
        <?php
    }
    echo '<div class="grid-sizer '.$item_class.'"></div>';
    ?>
    <?php wp_reset_postdata(); ?>
</div>

<?php if ($pagination_type == 'pagination') { ?>
    <div class="pxl-grid-pagination pagin-product d-flex" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
        <?php icoland()->page->get_pagination($query, true); ?>
    </div>
<?php } ?>
<?php if (!empty($next_link) && $pagination_type == 'loadmore'):
    ?>
    <div class="pxl-load-more product" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-loading-text="<?php echo esc_attr__('Loading', 'icoland') ?>" data-loadmore-text="<?php echo esc_html($settings['loadmore_text']); ?>">
        <span class="btn btn-default btn-product-grid-loadmore right">
            <span class="pxl--btn-text effect"><?php echo esc_html($settings['loadmore_text']); ?></span>
            <span class="pxl-btn-icon pxli-spinner"></span>
        </span>
    </div>
<?php endif; ?>
</div>
<?php endif; ?>