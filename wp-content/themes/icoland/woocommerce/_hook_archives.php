<?php
/* Remove result count & product ordering & item product category..... */
function icoland_cwoocommerce_remove_function() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0 );
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10, 0 );
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'init', 'icoland_cwoocommerce_remove_function' );
add_filter( 'woocommerce_after_shop_loop_item', 'icoland_woocommerce_product' );
function icoland_woocommerce_product() {
    global $product;
    $line_color = get_post_meta($product->get_id(), 'line_color', true);
    ?>

    <div class="woocommerce-product-inner" <?php if(!empty($line_color['rgba'])) : ?>style="border-color: <?php echo esc_attr($line_color['rgba']); ?>"<?php endif; ?>>
        <?php 
        if ( $product->is_featured() ) {
            $feature_text = get_post_meta($product->get_id(),'product_feature_text', true);
            if (empty($feature_text)){
                $feature_text = "NEW";
            }
            ?>
            <span class="pxl-featured"><?php echo esc_html($feature_text); ?></span>
            <?php
        }
        ?>
        <div class="woocommerce-product-header">
            <a class="woocommerce-product-details" href="<?php the_permalink(); ?>">
                <?php woocommerce_template_loop_product_thumbnail(); ?>
            </a>
        </div>
        <div class="woocommerce-product-content">
            <div class="woocommerce-product--rating">
                <?php woocommerce_template_loop_rating(); ?>
            </div>
            <h4 class="woocommerce-product--title">
                <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            </h4>
            <div class="woocommerce-product--excerpt" style="display: none;">
                <?php woocommerce_template_single_excerpt(); ?>
            </div>
            
            <?php woocommerce_template_loop_price(); ?>
        </div>
        <div class="woocommerce-product-meta">
            <?php if (class_exists('WPCleverWoosw')) { ?>
                <div class="woocommerce-wishlist">
                    <?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
                </div>
            <?php } ?>
            <?php if (class_exists('WPCleverWoosq')) { ?>
                <div class="woocommerce-quick-view">
                    <?php echo do_shortcode('[woosq id="'.esc_attr( $product->get_id() ).'"]'); ?>
                </div>
            <?php } ?>
            <?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
            <?php } else { ?>
                <div class="woocommerce-add-to-cart">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php }
// remove page title on archive page
add_filter('woocommerce_show_page_title', function(){ return false;});

//Custom products layout on archive page
add_filter( 'loop_shop_columns', 'icoland_loop_shop_columns', 20 ); 
function icoland_loop_shop_columns() {
	$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : icoland()->get_theme_opt('products_columns', 3);
	return $columns;
}

function meta_single_product_woo() {
    echo '<div class="category-product">';
    $category1 = get_categories(array( 'taxonomy' => 'product_cat' )); 
    $categories = array();
    $categories_id = array();
    // $service_icon = get_term_meta( $category1['0']->term_id, 'service_icon', true );  
    // echo '<i class="'.$service_icon.'"></i>';
    global $product; 
    $terms = get_the_terms( get_the_ID(), 'product_cat' );
    echo wc_get_product_category_list( get_the_id());
    echo '</div>';
    echo '<div class="meta-single-product">';
    echo '<div class="views-product">';
    $id = get_the_ID();         
    $meta = get_post_meta( $id, 'views_count', TRUE );
    if(empty($meta))
    {
        $result = 0;
    }
    else
    {        
        $result = count(explode(',',$meta)); 
    }       
    echo "<i class='fa fa-eye'></i>";
    echo ''.$result;
    echo '</div>'; 
    echo '<div class="likes-product">';
    post_favorite(get_the_ID()); 
    echo '</div>';
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'meta_single_product_woo' );
//info author
// function author_collection_single_product_woo() {
//     echo '<div class="meta-author-collection-product">';
//     echo '<div class="author-creat">';
//     echo '<span>Creator</span>';
//     echo '<div class="author">';
//     echo '<div class="image-author">';
//     echo get_avatar( get_the_author_meta( 'ID' ), 160 );
//     echo '<i class="fas fa-check"></i>';
//     echo '</div>';
//     the_author_posts_link(); 
//     echo '</div>';
//     echo '</div>';
//     echo '<div class="collection-product">';
//     echo '<span>Collection</span>';
//     echo '<div class="collection-use">';
//     global $product;
//     $taxonomy = 'product-collection'; // <== Here set your custom taxonomy

//     $terms = get_the_terms( $product->get_id(), $taxonomy );
//     if ( !is_wp_error( $terms ) && !empty( $terms )) {

//         foreach ( $terms as $term ) {
//             $link = get_term_link( $term, $taxonomy );
//             if ( !is_wp_error( $link ) ) {
//                 $img = get_term_meta($term->term_id, 'img_collection', true);
//                 echo '<div class="collection-wrap">';
//                 echo '<div class="image-collection">';
//                 if(!empty($img['thumbnail'])){
//                     echo '<img src="'.esc_url($img['thumbnail']).'" alt="colection image" />';
//                 }
//                 echo '<i class="fas fa-check"></i>';
//                 echo '</div>';
//                 echo '<a href="'.esc_url( $link ).'">';
//                 echo '' . $term->name . '';
//                 echo '</a>';
//                 echo '</div>';
//             }
//         }
//     }

//     echo '</div>';
//     echo '</div>';
//     echo '</div>';
// }
// add_action( 'woocommerce_single_product_summary', 'author_collection_single_product_woo',20 );


// add_action( 'pxl_taxonomy_meta_register', 'icoland_taxonomy_service' );
// function icoland_taxonomy_service( $taxonomy ) {
//     $service_category = array(
//         'opt_name'     => 'product_cat',
//         'display_name' => esc_html__( 'Settings', 'icoland' ),
//     );

//     if ( ! $taxonomy->isset_args( 'product_cat' ) ) {
//         $taxonomy->set_args( 'product_cat', $service_category );
//     }

//     $taxonomy->add_section( 'product_cat', array(
//         'title'  => '',
//         'desc'   => '',
//         'fields' => array(
//             array(
//                 'id'       => 'service_icon',
//                 'type'     => 'pxl_iconpicker',
//                 'title'    => esc_html__( 'Icon', 'icoland' ),
//             ),
//             array(
//               'id'      => 'fix_val',
//               'type'    => 'select',
//               'title'   => esc_html__('fix value', 'icoland'),
//               'options' => [
//                 '' => 'default',
//                 'fix' => 'fix',
//             ],
//             'class' => 'redux-field-hidden',
//             'default' => ''  
//         ),
//         )
//     ));
// }



//video 
// add_action('woocommerce_before_single_product_summary','icoland_video', 19);    
// function icoland_video(){
//     global $product;
//     $product_video_url = get_post_meta($product->get_id(),'product_video_url', true);
//     if( !empty($product_video_url)){
//         echo '<div class="woocommerce-product-video-custom btn-video-wrap">';
//         echo '<video autoplay muted loop playsinline preload="metadata" controls>'; 
//         echo '<source src="'.''.esc_html__($product_video_url).''.'" type=video/mp4>';
//         echo '</video>';
//         echo '</div>';
//     }
// }

// //audio 
// add_action('woocommerce_before_single_product_summary','icoland_music', 19);    
// function icoland_music(){
//     global $product;
//     $product_music_url = get_post_meta($product->get_id(),'product_music_url', true);
//     if( !empty($product_music_url)){
//         echo '<div class="woocommerce-product-audio-custom btn-audio-wrap">';
//         echo '<audio class="audio-control" controls="" controlslist="nodownload">'; 
//         echo '<source src="'.''.esc_html__($product_music_url).''.'" type=audio/mp3>';
//         echo '</audio>';
//         echo '</div>';
//     }
// }
//countdown


function countdown_bid_product_woo() {
    global $product;
    $date = get_post_meta($product->get_id(),'cd_bids', true);
    $month = esc_html__('Month', 'icoland'); 
    $months = esc_html__('Months', 'icoland');
    $day = esc_html__('d', 'icoland');
    $days = esc_html__('d', 'icoland');
    $hour = esc_html__('h', 'icoland');
    $hours = esc_html__('h', 'icoland');
    $minute = esc_html__('m', 'icoland');
    $minutes = esc_html__('m', 'icoland');
    $second = esc_html__('s', 'icoland');
    $seconds = esc_html__('s', 'icoland');
    if(!empty($date)){
        echo '<div class="wrap-auctions">';
        echo '<p> Auctions ends in </p>';
        echo '<div class="pxl-countdown "';
        echo 'data-month="'.$month.'"';
        echo 'data-month="'.$months.'"';
        echo 'data-day="'.$day.'"';
        echo 'data-days="'.$days.'"';
        echo 'data-hour="'.$hour.'"';
        echo 'data-hours="'.$hours.'"';
        echo 'data-minute="'.$minute.'"';
        echo 'data-minutes="'.$minutes.'"';
        echo 'data-second="'.$second.'"';
        echo 'data-seconds="'.$seconds.'">';
        echo '<div class="pxl-countdown-inner" data-count-down="'.$date.'">';
        echo '</div></div></div>';
    }
}
add_action( 'woocommerce_single_product_summary', 'countdown_bid_product_woo',0);

// Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'icoland_loop_shop_per_page', 20 );
function icoland_loop_shop_per_page( $limit ) {
	$limit = icoland()->get_theme_opt('product_per_page', 9);
	return $limit;
}

// Loop product title 
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<span class="pxl-product-title">' . get_the_title() . '</span>';
	}
}

// paginate links
add_filter('woocommerce_pagination_args', 'icoland_woocommerce_pagination_args');
function icoland_woocommerce_pagination_args($default){
	$default = array_merge($default, [
		'prev_text' => '<span class="caseicon-angle-arrow-left"></span>',
		'next_text' => '<span class="caseicon-angle-arrow-right"></span>',
		'type'      => 'plain',
	]);
	return $default;
}

// Custom Top table: catalog order and result count
if(!function_exists('icoland_woocommerce_catalog_result')){
    // remove
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    // add back
    add_action('woocommerce_before_shop_loop','icoland_woocommerce_catalog_result', 20);
    add_action('icoland_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering');
    add_action('icoland_woocommerce_result_count', 'woocommerce_result_count');
    function icoland_woocommerce_catalog_result(){
        $columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : icoland()->get_theme_opt('products_columns', '2');
        $display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : icoland()->get_theme_opt('shop_display_type', 'grid');
        $active_grid = 'active';
        $active_list = '';
        if( $display_type == 'list' ){
            $active_list = $display_type == 'list' ? 'active' : '';
            $active_grid = '';
        }
        ?>
        <div class="pxl-shop-topbar-wrap row ">
            <div class="col-12 col-sm-auto order-md-2">
                <?php do_action('icoland_woocommerce_catalog_ordering'); ?>
            </div>
            <div class="col text-heading number-result">
                <?php do_action('icoland_woocommerce_result_count'); ?>
            </div>
        </div>
        <?php
    }
}

// Loop Start
add_filter( 'woocommerce_product_loop_start', 'icoland_product_loop_start' );
function icoland_product_loop_start(){
	$display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : icoland()->get_theme_opt('shop_display_type', 'grid');
	if( $display_type == 'list')
		return '<ul class="products shop-view-list">';
	else
		return '<ul class="products columns-'. esc_attr( wc_get_loop_prop( 'columns' ) ) .'">';
}
//
add_filter( 'woocommerce_sale_flash', 'icoland_replace_sale_text' );
function icoland_replace_sale_text( $html ) {
    $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
    $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
    $product_sale = '';
    if(!empty($sale_price)) {
        $product_sale = intval( ( (intval($regular_price) - intval($sale_price)) / intval($regular_price) ) * 100);
        return str_replace( 'Sale!', '<span class="onsale-inner"><span>' .$product_sale. '% OFF</span></span>', $html );
    }
}

/* Crop single gallery image */
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 190;
    $size['height'] = 190;
    $size['crop'] = 1;
    return $size;
});



add_filter('woocommerce_get_image_size_single', function ($size) {
    $size['width'] = 630;
    $size['height'] = 630;
    $size['crop'] = 1;
    return $size;
});




/* Pagination Args */
function icoland_filter_woocommerce_pagination_args( $array ) { 
    $array['end_size'] = 1;
    $array['mid_size'] = 1;
    return $array; 
}; 
add_filter( 'woocommerce_pagination_args', 'icoland_filter_woocommerce_pagination_args', 10, 1 ); 



/* bids NFT */
function icoland_bids_nft( $array ) { 
    echo "adsdadad";
}; 
add_filter( 'woocommerce_bids_nft', 'icoland_bids_nft', 10, 1 ); 


add_filter( 'woosw_button_position_archive', function() {
    return '';
} );
add_filter( 'woosc_button_position_archive', function() {
    return '';
} );
add_filter( 'woosq_button_position', function() {
    return '';
} );
add_filter( 'woocommerce_checkout_before_order_review_heading', 'icoland_checkout_before_order_review_heading', 10 );
function icoland_checkout_before_order_review_heading() {
    echo '<div class="ct-checkout-order-review">';
}
/* Product Single: Summary */
add_action( 'woocommerce_before_single_product_summary', 'icoland_woocommerce_single_summer_start', 0 );
function icoland_woocommerce_single_summer_start() { ?>
    <?php echo '<div class="woocommerce-summary-wrap row">'; ?>
<?php }
add_action( 'woocommerce_after_single_product_summary', 'icoland_woocommerce_single_summer_end', 5 );
function icoland_woocommerce_single_summer_end() { ?>
    <?php echo '</div></div>'; ?>
<?php }

/* Product Single: Gallery */
add_action( 'woocommerce_before_single_product_summary', 'icoland_woocommerce_single_gallery_start', 0 );
function icoland_woocommerce_single_gallery_start() { ?>
    <?php echo '<div class="woocommerce-gallery col-xl-6 col-lg-6 col-md-12 ">'; ?>
<?php }
add_action( 'woocommerce_before_single_product_summary', 'icoland_woocommerce_single_gallery_end', 30 );
function icoland_woocommerce_single_gallery_end() { ?>
    <?php echo '</div><div class="woocommerce-content col-xl-6 col-lg-6 col-md-12 ">'; ?>
<?php }

/* Ajax update cart item */
//add_filter('woocommerce_add_to_cart_fragments', 'icoland_woo_mini_cart_item_fragment');
function icoland_woo_mini_cart_item_fragment( $fragments ) {
    global $woocommerce;
    $product_subtitle = icoland_get_page_opt( 'product_subtitle' );
    ob_start();
    ?>
    <div class="widget_shopping_cart">
        <div class="widget_shopping_head">
            <div class="widget_shopping_title">
                <?php echo esc_html__( 'Cart', 'icoland' ); ?>
            </div>
        </div>
        <div class="widget_shopping_cart_content">
            <?php
            $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
            ?>
            <ul class="cart_list product_list_widget">

                <?php if ( ! WC()->cart->is_empty() ) : ?>

                <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                            <?php
                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            esc_attr__( 'Remove this item', 'icoland' ),
                            esc_attr( $product_id ),
                            esc_attr( $cart_item_key ),
                            esc_attr( $_product->get_sku() )
                        ),
                        $cart_item_key
                    );
                    ?>
                    <?php if ( empty( $product_permalink ) ) : ?>
                        <?php echo wp_kses_post($thumbnail) . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo wp_kses_post($thumbnail) . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                        <?php endif; ?>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </li>
                    <?php
                }
            }
            ?>

            <?php else : ?>

                <li class="empty">
                    <i class="bravisicon-shopping-cart-alt"></i>
                    <span><?php esc_html_e( 'Your cart is empty', 'icoland' ); ?></span>
                    <a class="btn btn-animate" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Browse Shop', 'icoland'); ?></a>
                </li>

            <?php endif; ?>

        </ul><!-- end product list -->
    </div>
    <?php if ( ! WC()->cart->is_empty() ) : ?>
    <div class="widget_shopping_cart_footer">
        <p class="total"><strong><?php esc_html_e( 'Subtotal', 'icoland' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

        <p class="buttons">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-outline btn-animate wc-forward"><?php esc_html_e( 'View Cart', 'icoland' ); ?></a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-animate checkout wc-forward"><?php esc_html_e( 'Checkout', 'icoland' ); ?></a>
        </p>
    </div>
<?php endif; ?>
</div>
<?php
$fragments['div.widget_shopping_cart'] = ob_get_clean();
return $fragments;
}