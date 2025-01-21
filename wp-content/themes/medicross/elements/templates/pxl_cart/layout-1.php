<ul class="pxl-mini-cart">
  <?php
  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

        $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
        $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
        $img_id = get_post_thumbnail_id($product_id);
        if($img_id) {
            $img = pxl_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => 'full',
                'class' => 'no-lazyload',
            ));
            $thumbnail = $img['thumbnail'];
        }
        $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
        ?>
        <li>
            <?php if(!empty($thumbnail)) : ?>
                <div class="cart-product-image">
                    <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
                        <?php echo ''.$thumbnail; ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="cart-product-meta">
                <h3><a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html($product_name); ?></a></h3>
                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                <?php
                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                    '<a href="%s" class="remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">X</a>',
                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                    esc_attr__( 'Remove this item', 'medicross' ),
                    esc_attr( $product_id ),
                    esc_attr( $cart_item_key ),
                    esc_attr( $_product->get_sku() )
                ), $cart_item_key );
                ?>
            </div>  
        </li>
        <?php
    }
}
?>
</ul>

<div class="widget_shopping_cart_footer">
    <p class="total"><strong><?php esc_html_e( 'Subtotal', 'medicross' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="buttons">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-outline btn-animate wc-forward"><?php esc_html_e( 'View Cart', 'medicross' ); ?></a>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-animate checkout wc-forward"><?php esc_html_e( 'Checkout', 'medicross' ); ?></a>
    </p>
</div>

