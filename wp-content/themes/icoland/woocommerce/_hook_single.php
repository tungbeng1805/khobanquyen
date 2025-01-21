<?php

// Related Products
//if(icoland()->get_theme_opt('product_related', '1') === '0' ){
	remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
//}


add_action('woocommerce_single_product_summary','icoland_single_product_title', 6);
function icoland_single_product_title(){
	global $product;
	$title_product_single = get_post_meta($product->get_id(),'title_product_single', true);
	echo '<h3 class="woocommerce-product-single-title">';
	echo icoland_html($title_product_single); 
	echo '</h3>';
}

function icoland_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$categories='',$param_args=[]){
    global $wp_query;

    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
    if(!empty($product_ids)){

        if (get_query_var('paged')) {
            $pxl_paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $pxl_paged = get_query_var('page');
        } else {
            $pxl_paged = 1;
        }

        $pxl_query = new WP_Query(array(
            'post_type' => 'product',
            'post__in' => array_map('intval', explode(',', $product_ids)),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                )
            ),
        ));

        $posts = $pxl_query;

        $categories = [];
    }else{
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'post_parent' => 0,
            'date_query' => array(
                array(
                   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                )
            ),
        );

        if(!empty($categories)){

            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'operator' => 'IN',
                'terms' => $categories,
            );
        }

        if( !empty($param_args['pro_atts']) ){
            foreach ($param_args['pro_atts'] as $k => $v) {
                $args['tax_query'][] = array(
                    'taxonomy' => $k,
                    'field' => 'slug',
                    'terms' => $v
                );
            }
        }

        $args['meta_query'] = array(
            'relation'    => 'AND'
        );

        if( !empty($param_args['min_price']) && !empty($param_args['max_price'])){
            $args['meta_query'][] =   array(
                'key'     => '_price',
                'value'   => array( $param_args['min_price'], $param_args['max_price'] ),
                'compare' => 'BETWEEN',
                'type'    => 'DECIMAL(10,' . wc_get_price_decimals() . ')',
            );
        }

        $args = icoland_product_filter_type_args($type,$args);

        if (get_query_var('paged')){
            $pxl_paged = get_query_var('paged');
        }elseif(get_query_var('page')){
            $pxl_paged = get_query_var('page');
        }else{
            $pxl_paged = 1;
        }
        if($pxl_paged > 1){
            $args['paged'] = $pxl_paged;
        }

        $posts = $pxl_query = new WP_Query($args);

        if (empty($categories)) {
            $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
            $categories = array();
            foreach($product_categories as $key => $category){
                $categories[] = $category->slug;
            }
        }
    }
    global $wp_query;
    $wp_query = $pxl_query;
    $pagination = get_the_posts_pagination(array(
        'screen_reader_text' => '',
        'mid_size' => 2,
        'prev_text' => esc_html__('Back', 'icoland'),
        'next_text' => esc_html__('Next', 'icoland'),
    ));
    global $paged;
    $paged = $pxl_paged;


    wp_reset_query();
    return array(
        'posts' => $posts,
        'categories' => $categories,
        'query' => $pxl_query,
        //'args' => $args,
        'paged' => $paged,
        'max' => $pxl_query->max_num_pages,
        'next_link' => next_posts($pxl_query->max_num_pages, false),
        'total' => $pxl_query->found_posts,
        'pagination' => $pagination
    );
}

function icoland_product_filter_type_args($type,$args){
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => $product_visibility_term_ids['featured'],
            );
            break;
        case 'top_rate':
            $args['meta_key']   ='_wc_average_rating';
            $args['orderby']    ='meta_value_num';
            $args['order']      ='DESC';
            break;
        case 'recent_product':
            $args['orderby']    = 'date';
            $args['order']      = 'DESC';
            break;
        case 'on_sale':
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = $wpdb->prepare("SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d", $_limit);
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            $args['post__in'] = $_pids;
            break;
        case 'deals':
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'separate':
            if ( ! empty( $product_ids ) ) {
                $ids = array_map( 'trim', explode( ',', $product_ids ) );
                if ( 1 === count( $ids ) ) {
                    $args['p'] = $ids[0];
                } else {
                    $args['post__in'] = $ids;
                }
            }
            break;
    }
    return $args;
}