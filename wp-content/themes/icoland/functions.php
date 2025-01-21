<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Tnex-Themes
 * @since icoland 1.0
 */

if(!defined('THEME_DEV_MODE_ELEMENTS') && is_user_logged_in()){
	define('THEME_DEV_MODE_ELEMENTS', true);
}

require_once get_template_directory() . '/inc/classes/class-main.php';

if ( is_admin() ){ 
	require_once get_template_directory() . '/inc/admin/admin-init.php'; }
	
/**
 * Theme Require
*/
icoland()->require_folder('inc');
icoland()->require_folder('inc/classes');
icoland()->require_folder('inc/post_favorite');
icoland()->require_folder('inc/theme-options');
icoland()->require_folder('template-parts/widgets');
if(class_exists('Woocommerce')){
	icoland()->require_folder('woocommerce');
}

if(!defined('DEV_MODE')){
	define('DEV_MODE', true);
}