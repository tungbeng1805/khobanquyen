<?php
/**
 * @package Tnex-Themes
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
     <?php $pxl_page_cls = apply_filters( 'pxl_page_class', 'pxl-page' ); ?>
    <div id="pxl-wapper" class="pxl-wapper <?php echo esc_attr($pxl_page_cls) ?>">
        <?php 
        	icoland()->page->get_site_loader();
            icoland()->header->getHeader();
            icoland()->page->get_page_title();
        ?>
        <div id="pxl-main"> 
