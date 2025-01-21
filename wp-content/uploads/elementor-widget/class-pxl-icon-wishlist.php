<?php

class PxlIconWishlist_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_icon_wishlist';
    protected $title = 'BR Icon Wishlist';
    protected $icon = 'eicon-heart';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"pxl_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .pxl-wishlist-button i":"color: {{VALUE}};"}},{"name":"darkmode_icon_color","label":"Icon Color (Dark Mode)","type":"color","selectors":{".dark-mode {{WRAPPER}} .pxl-wishlist-button i":"color: {{VALUE}};"}},{"name":"icon_color_hover","label":"Icon Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-wishlist-button:hover i":"color: {{VALUE}};"}},{"name":"darkmode_icon_color_hover","label":"Icon Color Hover (Dark Mode)","type":"color","selectors":{".dark-mode {{WRAPPER}} .pxl-wishlist-button:hover i":"color: {{VALUE}};"}},{"name":"icon_font_size","label":"Icon Font Size","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-wishlist-button":"font-size: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}