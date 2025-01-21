<?php
/**
 * Filters hook for the theme
 *
 * @package Tnex-Themes
 */

/* Custom Classs - Body */
function icoland_body_classes( $classes ) {   

	if (class_exists('ReduxFramework')) {
		$classes[] = ' pxl-redux-page';
	}

	$footer_fixed = icoland()->get_theme_opt('footer_fixed');
	if(isset($footer_fixed) && $footer_fixed) {
		$classes[] = ' pxl-footer-fixed';
	}


	if(isset($theme_default['font-family']) && $theme_default['font-family'] == false) {
		$classes[] = ' pxl-font-default';
	}
	
	$type_home = icoland()->get_page_opt('type_home');
	if($type_home != 'none') {
		$classes[] = $type_home;
	}

	return $classes;
}
add_filter( 'body_class', 'icoland_body_classes' );

/* Post Type Support Elementor*/
add_filter( 'pxl_add_cpt_support', 'icoland_add_cpt_support' );
function icoland_add_cpt_support($cpt_support) { 
	$cpt_support[] = 'service';
	return $cpt_support;
}

add_filter( 'pxl_support_default_cpt', 'icoland_support_default_cpt' );
function icoland_support_default_cpt($postypes){
	return $postypes; // pxl-template
}

// add_filter( 'pxl_extra_post_types', 'icoland_add_posttype' );
// function icoland_add_posttype( $postypes ) {
// 	$postypes['service'] = array(
// 		'status' => true,
// 		'item_name'  => 'Service',
// 		'items_name' => 'Service',
// 		'args'       => array(
// 			'menu_icon'          => 'dashicons-feedback',
// 			'rewrite'             => array(
// 				'slug'       => 'service',
// 			),
// 		),
// 	);
// 	$postypes['pxl_event'] = array(
// 		'status' => true,
// 		'item_name'  => 'Events',
// 		'items_name' => 'Events',
// 		'args'       => array(
// 			'menu_icon'          => 'dashicons-admin-media',
// 			'rewrite'             => array(
// 				'slug'       => 'pxl_event',
// 			),
// 		),
// 	);
// 	$postypes['classes'] = array(
// 		'status' => true,
// 		'item_name'  => 'Portfolio',
// 		'items_name' => 'Portfolio',
// 		'args'       => array(
// 			'menu_icon'          => 'dashicons-welcome-learn-more',
// 			'rewrite'             => array(
// 				'slug'       => 'classes',
// 			),
// 		),
// 	);
// 	return $postypes;
// }

// add_filter( 'pxl_extra_taxonomies', 'icoland_add_tax' );
// function icoland_add_tax( $taxonomies ) {
// 	$taxonomies['product-collection'] = array(
// 		'status'     => true,
// 		'post_type'  => array( 'product' ),
// 		'taxonomy'   => 'Product Collection',
// 		'taxonomies' => 'Product Collection',
// 		'args'       => array(
// 			'rewrite'             => array(
// 				'slug'       => 'product-collection'
// 			),
// 		),
// 		'labels'     => array()
// 	);

// 	return $taxonomies;
// }
add_filter( 'pxl_page_class', 'icoland_page_classes' );
function icoland_page_classes($str_cls){
	$header_layout	= (int)icoland()->get_opt('header_layout');
	if ($header_layout > 0){
    	$header_position = get_post_meta( $header_layout, 'header_position', true );
    	if(!empty($header_position))
    		$str_cls .= ' header-pos-'.$header_position;
    }
    return $str_cls;
}

add_filter( 'pxl_theme_builder_post_types', 'icoland_theme_builder_post_type' );
function icoland_theme_builder_post_type($postypes){
	//default are header, footer, mega-menu
	return $postypes;
}

add_filter( 'pxl_theme_builder_layout_ids', 'icoland_theme_builder_layout_id' );
function icoland_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)icoland()->get_opt('header_layout');
	$header_sticky_layout = (int)icoland()->get_opt('header_sticky_layout');
	$footer_layout        = (int)icoland()->get_opt('footer_layout');
	$ptitle_layout        = (int)icoland()->get_opt('ptitle_layout');
	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_sticky_layout > 0) 
		$layout_ids[] = $header_sticky_layout;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;
	if( $ptitle_layout > 0) 
		$layout_ids[] = $ptitle_layout;
	
	return $layout_ids;
}

add_filter( 'pxl_wg_get_source_id_builder', 'icoland_wg_get_source_builder' );
function icoland_wg_get_source_builder($wg_datas){
	$wg_datas['tabs'] = ['control_name' => 'tabs', 'source_name' => 'content_template'];
	return $wg_datas;
}

/* Update primary color in Editor Builder */
add_action( 'elementor/preview/enqueue_styles', 'icoland_add_editor_preview_style' );
function icoland_add_editor_preview_style(){
	wp_add_inline_style( 'editor-preview', icoland_editor_preview_inline_styles() );
}
function icoland_editor_preview_inline_styles(){
	$theme_colors = icoland_configs('theme_colors');
	ob_start();
	echo '.elementor-edit-area-active{';
	foreach ($theme_colors as $color => $value) {
		printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
	}
	echo '}';
	return ob_get_clean();
}

add_filter( 'get_the_archive_title', 'icoland_archive_title_remove_label' );
function icoland_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'icoland_comment_reply_text' );
function icoland_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'icoland').'', $link );
	return $link;
}

add_filter( 'pxl_enable_megamenu', 'icoland_enable_megamenu' );
function icoland_enable_megamenu() {
	return true;
}
add_filter( 'pxl_enable_onepage', 'icoland_enable_onepage' );
function icoland_enable_onepage() {
	return true;
}

add_filter( 'pxl_support_awesome_pro', 'icoland_support_awesome_pro' );
function icoland_support_awesome_pro() {
	return true;
}

add_filter( 'redux_pxl_iconpicker_field/get_icons', 'icoland_add_icons_to_pxl_iconpicker_field' );
function icoland_add_icons_to_pxl_iconpicker_field($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("pxl_mega_menu/get_icons", "icoland_add_icons_to_megamenu");
function icoland_add_icons_to_megamenu($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'icoland_comment_field_to_bottom' );
function icoland_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );


//Hook Count Widget Archive
add_filter('get_archives_link', 'abcde',10,7);
function abcde($link_html, $url, $text, $format, $before, $after, $selected){
	$text         = wptexturize( $text );
	$url          = esc_url( $url );
	$aria_current = $selected ? ' aria-current="page"' : '';

	if ( 'link' === $format ) {
		$link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
	} elseif ( 'option' === $format ) {
		$selected_attr = $selected ? " selected='selected'" : '';
		$link_html     = "\t<option value='$url'$selected_attr>$before $text $after</option>\n";
	} elseif ( 'html' === $format ) {
		$after = str_replace('&nbsp;(', '<span class="count">', $after);
		$after = str_replace(')', '</span>', $after);
		$link_html = "\t<li>$before<a href='$url'$aria_current>$text</a>$after</li>\n";
	} else { // Custom.
		$link_html = "\t$before<a href='$url'$aria_current>$text</a>$after\n";
	}
	return $link_html;
}