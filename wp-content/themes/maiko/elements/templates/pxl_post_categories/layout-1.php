<?php
$post_id = get_the_ID();
$categories = get_the_terms($post_id, 'portfolio-category');
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
    echo '<ul class="pxl-portfolio-categories">';
    foreach ( $categories as $category ) {
        echo '<li>' . esc_html( $category->name ) . '</li>';
    }
    echo '</ul>';
}
?>