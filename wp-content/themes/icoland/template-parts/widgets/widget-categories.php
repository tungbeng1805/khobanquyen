<?php
/**
 * Widget Categories
 * Custom HTML output
*/
if(!function_exists('icoland_widget_categories_args')){
    add_filter('widget_categories_args', 'icoland_widget_categories_args');
    add_filter('woocommerce_product_categories_widget_args', 'icoland_widget_categories_args');
    function icoland_widget_categories_args($cat_args){
        $cat_args['walker'] = new Icoland_Categories_Walker;
        return $cat_args; 
    }
}

/**
 * Icoland_Categories_Walker
 *
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}
class Icoland_Categories_Walker extends Walker_Category {
    /**
     * Starts the element output.
     *
     * @since 2.1.0
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
 
        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }
 
        $link .= '>';

        if ( $args['has_children'] && $args['hierarchical'] && ( empty( $args['max_depth'] ) || $args['max_depth'] > $depth + 1 ) ) {
            $link .= '<span class="title">'.$cat_name.'</span>';
            if ( ! empty( $args['show_count'] ) ) {
                $cat_count = $category->count < 10 ? '0'.$category->count : $category->count;
                $link .= ' <span class="count">' .  $cat_count . '</span>';
            }
        } else {
            $link .= '<span class="title">'.$cat_name.'</span>';
            if ( ! empty( $args['show_count'] ) ) {  
                $cat_count = $category->count < 10 ? '0'.$category->count : $category->count;
                $link .= ' <span class="count">' .  $cat_count  . '</span>';
            }
        }

        $link .= '</a>';

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }
 
            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';
 
            if ( empty( $args['feed'] ) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s','icoland' ), $cat_name ) . '"';
            } else {
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }
 
            $link .= '>';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
            }
            $link .= '</a>';
 
            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }
        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_portfolio = array(
                'pxl-list-item',
                'pxl-cat-item',
                'pxl-cat-item-' . $category->term_id,
            );
            if($args['has_children']){
                $css_portfolio[] =  'pxl-cat-parents';
            }
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_portfolio[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_portfolio[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_portfolio[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
 
            /**
             * Filters the list of CSS portfolio to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_portfolio An array of CSS portfolio to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_portfolio = implode( ' ', apply_filters( 'category_css_class', $css_portfolio, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_portfolio . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
        if($args['has_children']){
            $output .= '<span class="pxl-menu-toggle"></span>';
        }
    }
}
/*
if(!function_exists('icoland_woocommerce_layered_nav_term_html')){
    add_filter('woocommerce_layered_nav_term_html', 'icoland_woocommerce_layered_nav_term_html', 10, 4);
    add_filter('woocommerce_layered_nav_count', function (){ return '';});
    
    function icoland_woocommerce_layered_nav_term_html($term_html, $term, $link, $count){
        $term_html = str_replace('<a rel="nofollow" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a>', '<a rel="nofollow" href="' . esc_url( $link ) . '"><span class="title">' . esc_html( $term->name ) . '</span><span class="count bbb">' . absint( $count ) . '</span></a>' ,$term_html);

        //$term_html = str_replace('</a>', '</span><span class="count">' . absint( $count ) . '</span></a>',$term_html);
        return $term_html;
    }
}*/