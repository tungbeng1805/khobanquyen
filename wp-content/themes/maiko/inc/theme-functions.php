<?php
/**
 * Helper functions for the theme
 *
 * @package Bravis-Themes
 */


function maiko_html($html){
    return $html;
}

/**
 * Google Fonts
*/
function maiko_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    
    if ( 'off' !== _x( 'on', 'DM Sans font: on or off', 'maiko' ) ) {
        $fonts[] = 'DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000';
    }


    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $fonts ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css2' );
    }
    return $fonts_url;
}

/*
 * Get page ID by Slug
*/
function maiko_get_id_by_slug($slug, $post_type){
    $content = get_page_by_path($slug, OBJECT, $post_type);
    $id = $content->ID;
    return $id;
}

/**
 * Show content by slug
 **/
function maiko_content_by_slug($slug, $post_type){
    $content = maiko_get_content_by_slug($slug, $post_type);

    $id = maiko_get_id_by_slug($slug, $post_type);
    echo apply_filters('the_content',  $content);
}

/**
 * Get content by slug
 **/
function maiko_get_content_by_slug($slug, $post_type){
    $content = get_posts(
        array(
            'name'      => $slug,
            'post_type' => $post_type
        )
    );
    if(!empty($content))
        return $content[0]->post_content;
    else
        return;
}


/**
 * Custom Comment List
 */
function maiko_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-inner">

            <div class="comment-content">
                <div class="comment-holder pxl-flex">
                    <?php if ($args['avatar_size'] != 0) : ?> 
                        <div class="comment-image pxl-mr-25">
                            <?php echo get_avatar($comment, 90); ?>
                        </div>
                    <?php endif; ?>
                    <div class="comment-meta ">
                        <h4 class="comment-title">
                            <?php printf( '%s', get_comment_author_link() ); ?>
                        </h4>
                        <span class="comment-date">
                            <?php echo get_comment_date('F d, Y').', at '.get_comment_time(); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="comment-text "><?php comment_text(); ?></div>
            <div class="comment-reply">
                <?php comment_reply_link( array_merge( $args, array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth']
                ) ) ); ?>
            </div>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <div class="pxl-el-divider"></div>
    <?php endif;

}

/**
 * Paginate Links
 */
function maiko_ajax_paginate_links($link){
    $parts = parse_url($link);
    if( !isset($parts['query']) ) return $link;
    parse_str($parts['query'], $query);
    if(isset($query['page']) && !empty($query['page'])){
        return '#' . $query['page'];
    }
    else{
        return '#1';
    }
}


/**
 * RGB Color
 */
function maiko_hex_rgb($color) {

    $default = '0,0,0';

    //Return default if no color provided
    if(empty($color))
        return $default; 

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    $output = implode(",",$rgb);

    //Return rgb(a) color string
    return $output;
}


/**
 * Image Size Crop
 */
if(!function_exists('maiko_get_image_by_size')){
    function maiko_get_image_by_size( $params = array() ) {
        $params = array_merge( array(
            'post_id' => null,
            'attach_id' => null,
            'thumb_size' => 'thumbnail',
            'class' => '',
        ), $params );

        if ( ! $params['thumb_size'] ) {
            $params['thumb_size'] = 'thumbnail';
        }

        if ( ! $params['attach_id'] && ! $params['post_id'] ) {
            return false;
        }

        $post_id = $params['post_id'];

        $attach_id = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
        $attach_id = apply_filters( 'pxl_object_id', $attach_id );
        $thumb_size = $params['thumb_size'];
        $thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

        global $_wp_additional_image_sizes;
        $thumbnail = '';

        $sizes = array(
            'thumbnail',
            'thumb',
            'medium',
            'medium_large',
            'large',
            'full',
        );
        if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
            $attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
            $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
            $thumbnail_url = wp_get_attachment_image_url($attach_id, $thumb_size, false);
        } elseif ( $attach_id ) {
            if ( is_string( $thumb_size ) ) {
                preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
                if ( isset( $thumb_matches[0] ) ) {
                    $thumb_size = array();
                    $count = count( $thumb_matches[0] );
                    if ( $count > 1 ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][1]; // height
                    } elseif ( 1 === $count ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][0]; // height
                    } else {
                        $thumb_size = false;
                    }
                }
            }
            if ( is_array( $thumb_size ) ) {
                // Resize image to custom size
                $p_img = pxl_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
                $alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
                $attachment = get_post( $attach_id );
                if ( ! empty( $attachment ) ) {
                    $title = trim( wp_strip_all_tags( $attachment->post_title ) );

                    if ( empty( $alt ) ) {
                        $alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                    }
                    if ( empty( $alt ) ) {
                        $alt = $title;
                    }
                    if ( $p_img ) {

                        $attributes = pxl_stringify_attributes( array(
                            'class' => $thumb_class,
                            'src' => $p_img['url'],
                            'width' => $p_img['width'],
                            'height' => $p_img['height'],
                            'alt' => $alt,
                            'title' => $title,
                        ) );

                        $thumbnail = '<img ' . $attributes . ' />';
                    }
                }
            }
            $thumbnail_url = $p_img['url'];
        }

        $p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

        return apply_filters( 'pxl_el_getimagesize', array(
            'thumbnail' => $thumbnail,
            'url' => $thumbnail_url,
            'p_img_large' => $p_img_large,
        ), $attach_id, $params );

    }
}

/**
 * Search Form
 */
function maiko_header_mobile_search_form() { 
    $search_mobile = maiko()->get_theme_opt( 'search_mobile', false );
    $search_placeholder_mobile = maiko()->get_theme_opt( 'search_placeholder_mobile' );
    if($search_mobile) : ?>
        <div class="pxl-header-mobile-search pxl-hide-xl">
            <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                <input type="text" placeholder="<?php if(!empty($search_placeholder_mobile)) { echo esc_attr($search_placeholder_mobile); } else { esc_attr_e('Search...', 'maiko'); } ?>" name="s" class="search-field" />
                <button type="submit" class="search-submit"><i class="caseicon-search"></i></button>
            </form>
        </div>
    <?php endif; }

/**
 * Year Shortcode [pxl_year]
 */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_year_shortcode() {
        ob_start(); ?>
        <span><?php the_date('Y'); ?></span>
        <?php $output = ob_get_clean();
        return $output;
    }
    pxl_register_shortcode('pxl_year', 'maiko_year_shortcode');
}

/* Highlight Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_text_highlight_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
         'style' => '',
     ), $atts));

        ob_start();
        if(!empty($text)) : ?>
            <span class="pxl-title--highlight <?php echo esc_attr($style); ?>">
                <?php echo wp_kses_post($text); ?>
            </span>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('highlight', 'maiko_text_highlight_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_text_highlight_shortcode_editor( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
     ), $atts));

        ob_start();
        if(!empty($text)) : ?>
            <span class="pxl-text--highlight">
                <?php echo esc_attr($text); ?>
            </span>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_highlight', 'maiko_text_highlight_shortcode_editor');
}

/* Typewriter Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_text_typewriter_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
     ), $atts));

        ob_start();
        if(!empty($text)) : 
            $arr_str = explode(',', $text);
            ?>
            <span class="pxl-title--typewriter">
                <?php foreach ($arr_str as $index => $value) {
                    $item_count = '';
                    if($index == 0) {
                        $item_count = 'is-active';
                    }
                    $arr_str[$index] = '<span class="pxl-item--text '.$item_count.'">' . $value . '</span>';
                }
                $str = implode(' ', $arr_str);
                echo wp_kses_post($str); ?>
            </span>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('typewriter', 'maiko_text_typewriter_shortcode');
}

/* Button Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_btn_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
         'style' => '',
         'icon_class' => '',
         'text_color' => '',
     ), $atts));

        ob_start();
        if(!empty($text)) : ?>
            <span class="btn <?php echo esc_attr($style); ?>" <?php if(!empty($text_color)) { ?>style="color: <?php echo esc_attr($text_color); ?>"<?php } ?>>
                <span class="pxl--btn-text" data-text="<?php echo esc_attr($text); ?>">
                    <?php $chars = str_split($text);
                    foreach ($chars as $value) {
                        if($value == ' ') {
                            echo '<span class="spacer">&nbsp;</span>';
                        } else {
                            echo '<span>'.esc_attr($value).'</span>';
                        }
                    } ?>
                </span>
                <?php if(!empty($icon_class)) : ?>
                    <i class="<?php echo esc_attr($icon_class); ?> pxl-ml-14"></i>
                <?php endif; ?>
            </span>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_button', 'maiko_btn_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_btn_video_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
         'url' => '',
     ), $atts));

        ob_start();
        if(!empty($text)) : ?>
            <a class="shortcode-btn-style1 pxl-action-popup btn-text-parallax" href="<?php echo esc_url($url); ?>">
                <span class="shortcode-btn-icon caseicon-play1 pxl-mr-18"></span>
                <span class="pxl--btn-text"><?php echo pxl_print_html($text); ?></span>
            </a>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_btn_video', 'maiko_btn_video_shortcode');
}


if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_btn_submit_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'text' => '',
         'style' => 'btn btn-outline-gradient btn-border-3x btn-text-nina wpcf7-submit',
     ), $atts));

        ob_start();
        if(!empty($text)) : ?>
            <button class="<?php echo esc_attr($style); ?>" type="submit">
                <span class="pxl--btn-text" data-text="<?php echo esc_attr($text); ?>">
                    <?php $chars = str_split($text);
                    foreach ($chars as $value) {
                        if($value == ' ') {
                            echo '<span class="spacer">&nbsp;</span>';
                        } else {
                            echo '<span>'.esc_attr($value).'</span>';
                        }
                    } ?>
                </span>
            </button>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_button_submit', 'maiko_btn_submit_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_slider_arrow( $atts = array() ) {
        extract(shortcode_atts(array(
         'type' => 'next',
         'style' => 'style-1',
     ), $atts));

     ob_start(); ?>
     <div class="pxl-slider-rev-arrow">
        <?php if($type == 'next') { ?>
            <i class="caseicon-angle-arrow-right"></i>
        <?php } else { ?>
            <i class="caseicon-angle-arrow-left"></i>
        <?php } ?>
    </div>
    <?php $output = ob_get_clean();

    return $output;
}
pxl_register_shortcode('slider_arrow', 'maiko_slider_arrow');
}

// Shortcode Row/Column Grid
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_start_row_shortcode( $atts = array() ) {
        ob_start(); ?>
        <div class="pxl-post-container">
            <div class="row pxl-post-row">
                <?php $output = ob_get_clean();
                return $output;
            }
            pxl_register_shortcode('pxl_start_row', 'maiko_start_row_shortcode');
        }

        if(function_exists( 'pxl_register_shortcode' )) {
            function maiko_end_row_shortcode( $atts = array() ) {
                ob_start(); ?>
            </div>
        </div>       
        <?php $output = ob_get_clean();
        return $output;
    }
    pxl_register_shortcode('pxl_end_row', 'maiko_end_row_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_start_col_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'class' => 'col-12',
     ), $atts));
     ob_start(); ?>
     <div class="<?php echo esc_attr($class); ?>">     
        <?php $output = ob_get_clean();
        return $output;
    }
    pxl_register_shortcode('pxl_start_column', 'maiko_start_col_shortcode');
}

if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_end_col_shortcode( $atts = array() ) {
        ob_start(); ?>
    </div>  
    <?php $output = ob_get_clean();
    return $output;
}
pxl_register_shortcode('pxl_end_column', 'maiko_end_col_shortcode');
}

// End Shortcode Row/Column Grid

/* Gallery Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_gallery_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'link_video' => '',
         'images_id' => '',
         'col' => '2',
         'img_size' => '800x608',
         'masonry' => '',
     ), $atts));

        $pxl_g_id = uniqid();

        ob_start();
        ?>
        <div id="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>" class="pxl-gallery gallery-<?php echo esc_attr($col); ?>-columns <?php if(!empty($masonry)) { echo 'masonry-'.esc_attr($masonry); } ?>">
            <?php
            $pxl_images = explode( ',', $images_id );
            foreach ($pxl_images as $key => $img_id) :
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $thumbnail_url = $img['url'];
                ?>
                <div class="pxl--item">
                    <div class="pxl--item-inner">
                        <a href="<?php echo esc_url($thumbnail_url); ?>" data-elementor-lightbox-slideshow="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>"><?php echo maiko_html($thumbnail); ?></a>
                        <?php if($key == 0 && !empty($link_video)) : ?>
                            <a class="pxl-btn-video style2 pxl-action-popup" href="<?php echo esc_url($link_video); ?>"><i class="fa fa-play"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_gallery', 'maiko_gallery_shortcode');
}

/* Addd shortcode Video button */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_video_button_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'link' => '',
         'text' => '',
         'class' => 'style1',
     ), $atts));

        ob_start();
        ?>
        <a href="<?php echo esc_url($link); ?>" class="pxl-button-video1 btn-video pxl-video-popup <?php echo esc_attr($class); ?>">
            <span>
                <i class="caseicon-play1"></i>
            </span>
            <?php if(!empty($text)) : ?>
                <span class="slider-video-title"><?php echo pxl_print_html($text); ?></span>
            <?php endif; ?>
        </a>
        <?php
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_video_button', 'maiko_video_button_shortcode');
}

/* Get Category Shortcode  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_post_category_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'items' => '6',
         'columns' => '2',
     ), $atts));

        ob_start();
        $categories = get_categories(); ?>
        <div class="pxl-wg-categories columns-<?php echo esc_attr($columns); ?>">
            <?php foreach($categories as $category) {
                $term_bg = get_term_meta( $category->term_id, 'bg_category', true ); ?>
                <div class="pxl-category">
                    <div class="pxl-category--inner">
                        <div class="pxl-category--img bg-image" <?php if(!empty($term_bg["url"])) : ?>style="background-image: url(<?php echo esc_url($term_bg["url"]); ?>);"<?php endif; ?>></div>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"></a>
                        <span><?php echo pxl_print_html($category->name); ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_post_category', 'maiko_post_category_shortcode');
}

/* Slider 1  */
if(function_exists( 'pxl_register_shortcode' )) {
    function maiko_slider_price_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
         'price' => '',
         'desc' => '',
     ), $atts));

        ob_start();
        if(!empty($price) || !empty($desc)) : ?>
            <div class="pxl-slider-price1">
                <div class="pxl-item--inner">
                    <div class="pxl-item--price"><?php echo pxl_print_html($price); ?></div>
                    <div class="pxl-item--desc"><?php echo pxl_print_html($desc); ?></div>
                </div>
            </div>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('pxl_slider_price', 'maiko_slider_price_shortcode');
}

/**
 * Custom Widget Categories - Count
 */
add_filter('wp_list_categories', 'maiko_wg_category_count');
function maiko_wg_category_count($output) {
    $dir = is_rtl() ? 'pxl-left' : 'pxl-right';
    $output = str_replace("\t", '', $output);
    $output = str_replace(")\n</li>", ')</li>', $output);
    $output = str_replace('</a> (', '<span class="pxl-count pxl-r-15 '.$dir.'">', $output);
    $output = str_replace(")</li>", "</span></a></li>", $output);
    $output = str_replace("\n<ul", "</span></a>\n<ul", $output);
    return $output;
}


/**
 * Custom Widget Archive - Count
 */
add_filter('get_archives_link', 'maiko_wg_archive_count');
function maiko_wg_archive_count($links) {
    $dir = is_rtl() ? 'pxl-left' : 'pxl-right';
    $links = str_replace('</a>&nbsp;(', ' <span class="pxl-count pxl-r-15 '.$dir.'">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}

/**
 * Custom Widget Product Categories 
 */
add_filter('wp_list_categories', 'maiko_wc_cat_count_span');
function maiko_wc_cat_count_span($links) {
    $dir = is_rtl() ? 'pxl-left' : 'pxl-right';
    $links = str_replace('</a> <span class="count">(', ' <span class="pxl-count pxl-r-15 '.$dir.'">', $links);
    $links = str_replace(')</span>', '</span></a>', $links);
    return $links;
}

/**
 * Get mega menu builder ID
 */
function maiko_get_mega_menu_builder_id(){
    $mn_id = [];
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            if ( is_object( $menu )){
                $menu_obj = get_term( $menu->term_id, 'nav_menu' );
                $menu = wp_get_nav_menu_object( $menu_obj ) ;
                $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
                foreach ($menu_items as $menu_item) {
                    if( !empty($menu_item->pxl_megaprofile)){
                        $mn_id[] = (int)$menu_item->pxl_megaprofile;
                    }
                }  
            }
        }
    }
    return $mn_id;
}

/**
 * Get page popup builder ID
 */
function maiko_get_page_popup_builder_id(){
    $pp_id = [];
    $page_popup = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $page_popup ) && ! empty( $page_popup ) ) {
        foreach ( $page_popup as $page ) {
            if ( is_object( $page )){
                $page_obj = get_term( $page->term_id, 'nav_menu' );
                $page = wp_get_nav_menu_object( $page_obj ) ;
                $page_items = wp_get_nav_menu_items( $page->term_id, array( 'update_post_term_cache' => false ) );
                foreach ($page_items as $page_item) {
                    if( !empty($page_item->pxl_page_popup)){
                        $pp_id[] = (int)$page_item->pxl_page_popup;
                    }
                }  
            }
        }
    }
    return $pp_id;
}

/* Mouse Move Animation */
function maiko_mouse_move_animation() { 
    $mouse_move_animation = maiko()->get_theme_opt('mouse_move_animation', false); 
    if($mouse_move_animation) {
        wp_enqueue_script( 'maiko-cursor', get_template_directory_uri() . '/assets/js/libs/cursor.js', array( 'jquery' ), '1.0.0', true ); ?>  
        <div class="pxl-cursor pxl-js-cursor">
            <div class="pxl-cursor-wrapper">
                <div class="pxl-cursor--follower pxl-js-follower"></div>
                <div class="pxl-cursor--label pxl-js-label"></div>
                <div class="pxl-cursor--drap pxl-js-drap"></div>
                <div class="pxl-cursor--icon pxl-js-icon"></div>
            </div>
            <div class="pxl-cursor-arrow-prev"><?php esc_html_e('Prev Image', 'maiko'); ?></div>
            <div class="pxl-cursor-arrow-next"><?php esc_html_e('Next Image', 'maiko'); ?></div>
        </div>
    <?php }
}


/**
 * Start - Cookie Policy
 */
function maiko_cookie_policy() {
    $cookie_policy = maiko()->get_theme_opt('cookie_policy', 'hide');
    $cookie_policy_description = maiko()->get_theme_opt('cookie_policy_description');
    $cookie_policy_btntext = maiko()->get_theme_opt('cookie_policy_btntext');
    $cookie_policy_link = get_permalink(maiko()->get_theme_opt('cookie_policy_link')); 
    wp_enqueue_script('pxl-cookie'); ?>
    <?php if($cookie_policy == 'show' && !empty($cookie_policy_description)) : ?>
        <div class="pxl-cookie-policy">
            <div class="pxl-item--icon pxl-mr-8"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/cookie.png'); ?>" alt="<?php echo esc_attr($cookie_policy_btntext); ?>" /></div>
            <div class="pxl-item--description">
                <?php echo esc_attr($cookie_policy_description); ?>
                <a class="pxl-item--link" href="<?php echo esc_url( $cookie_policy_link ); ?>" target="_blank"><?php echo pxl_print_html($cookie_policy_btntext); ?></a>
            </div>
            <div class="pxl-item--close pxl-close"></div>
        </div>
    <?php endif; ?>
<?php }   
/**
 * End - Cookie Policy
 */

/**
 * Start - Subscribe Popup
 */
function maiko_subscribe_popup() {
    $subscribe = maiko()->get_theme_opt('subscribe', 'hide');
    $subscribe_layout = maiko()->get_theme_opt('subscribe_layout');
    $popup_effect = maiko()->get_theme_opt('popup_effect', 'fade');
    $args = [
        'subscribe_layout' => $subscribe_layout
    ];
    wp_enqueue_script('pxl-cookie'); ?>
    <?php if($subscribe == 'show' && isset($args['subscribe_layout']) && $args['subscribe_layout'] > 0) : ?>
        <div class="pxl-popup pxl-subscribe-popup pxl-effect-<?php echo esc_attr($popup_effect); ?>">
            <div class="pxl-popup--content">
                <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $args['subscribe_layout']); ?>
            </div>
        </div>
    <?php endif; ?>
<?php }   
/**
 * End - Subscribe Popup
 */

/**
 * Start - User custom fields.
 */
add_action( 'show_user_profile', 'maiko_user_fields' );
add_action( 'edit_user_profile', 'maiko_user_fields' );
function maiko_user_fields($user){

    $user_name = get_user_meta($user->ID, 'user_name', true);
    $user_position = get_user_meta($user->ID, 'user_position', true);

    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
    $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
    $user_youtube = get_user_meta($user->ID, 'user_youtube', true);

    ?>
    <h3><?php esc_html_e('Theme Custom', 'maiko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_name"><?php esc_html_e('Author Name', 'maiko'); ?></label></th>
            <td>
                <input id="user_name" name="user_name" type="text" value="<?php echo esc_attr(isset($user_name) ? $user_name : ''); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="user_position"><?php esc_html_e('Author Position', 'maiko'); ?></label></th>
            <td>
                <input id="user_position" name="user_position" type="text" value="<?php echo esc_attr(isset($user_position) ? $user_position : ''); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'maiko'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'maiko'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram', 'maiko'); ?></label></th>
            <td>
                <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'maiko'); ?></label></th>
            <td>
                <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_youtube"><?php esc_html_e('Youtube', 'maiko'); ?></label></th>
            <td>
                <input id="user_youtube" name="user_youtube" type="text" value="<?php echo esc_attr(isset($user_youtube) ? $user_youtube : ''); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'personal_options_update', 'maiko_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'maiko_save_user_custom_fields' );
function maiko_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    if(isset($_POST['user_name']))
        update_user_meta( $user_id, 'user_name', $_POST['user_name'] );

    if(isset($_POST['user_position']))
        update_user_meta( $user_id, 'user_position', $_POST['user_position'] );

    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_instagram']))
        update_user_meta( $user_id, 'user_instagram', $_POST['user_instagram'] );
    if(isset($_POST['user_linkedin']))
        update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    if(isset($_POST['user_youtube']))
        update_user_meta( $user_id, 'user_youtube', $_POST['user_youtube'] );
}

function maiko_get_user_name() {

    $user_name = get_user_meta(get_the_author_meta( 'ID' ), 'user_name', true);
    if(!empty($user_name)) { ?>
        <div class="pxl-user--name">
            <?php echo esc_attr($user_name); ?>
        </div>
    <?php } else { ?>
        <div class="pxl-user--name">
            <?php the_author_posts_link(); ?>
        </div>
    <?php }
}

function maiko_get_user_position() {

    $user_position = get_user_meta(get_the_author_meta( 'ID' ), 'user_position', true);
    if(!empty($user_position)) { ?>
        <div class="pxl-user--position">
            <?php echo esc_attr($user_position); ?>
        </div>
    <?php }
}
/**
 * End - User custom fields.
 */

/* Start Custom Field Media */
function maiko_attachment_field_credit( $form_fields, $post ) {
    $form_fields['img_theme_custom_link'] = array(
        'label' => 'Theme Custom Link',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'img_theme_custom_link', true ),
    );

    return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'maiko_attachment_field_credit', 1, 2 );


function maiko_attachment_field_credit_save( $post, $attachment ) {
    if( isset( $attachment['img_theme_custom_link'] ) )
        update_post_meta( $post['ID'], 'img_theme_custom_link', $attachment['img_theme_custom_link'] );

    return $post;
}

add_filter( 'attachment_fields_to_save', 'maiko_attachment_field_credit_save', 1, 2 );
/* End Custom Field Media */

/* Author Social */
function maiko_get_user_social() {

    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
    $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true); ?>
    <div class="pxl-post--author-social">
        <?php if(!empty($user_facebook)) { ?>
            <a href="<?php echo esc_url($user_facebook); ?>" class="pxl-mr-18"><i class="caseicon-facebook"></i></a>
        <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <a href="<?php echo esc_url($user_twitter); ?>" class="pxl-mr-18"><i class="caseicon-twitter"></i></a>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <a href="<?php echo esc_url($user_linkedin); ?>" class="pxl-mr-18"><i class="caseicon-linkedin"></i></a>
        <?php } ?>
        <?php if(!empty($user_instagram)) { ?>
            <a href="<?php echo esc_url($user_instagram); ?>" class="pxl-mr-18"><i class="caseicon-instagram"></i></a>
        <?php } ?>
        <?php if(!empty($user_youtube)) { ?>
            <a href="<?php echo esc_url($user_youtube); ?>" class="pxl-mr-18"><i class="caseicon-youtube"></i></a>
        <?php } ?>
    </div>
<?php }