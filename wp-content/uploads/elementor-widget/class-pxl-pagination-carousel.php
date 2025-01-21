<?php

class PxlPaginationCarousel_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_pagination_carousel';
    protected $title = 'BR Pagination Carousel';
    protected $icon = 'eicon-animation';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"style_section","label":"Style","tab":"content","controls":[{"name":"flex_grow","label":"Flex Grow","type":"choose","options":{"inherit":{"title":"Inherit","icon":"fas fa-arrows-alt-v"},"1":{"title":"Full","icon":"fas fa-arrows-alt-h"}},"selectors":{"{{WRAPPER}}":"flex-grow: {{VALUE}};"}},{"name":"color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-pagination-carousel .pxl-swiper-dots span.pxl-swiper-pagination-bullet":"color: {{VALUE}};"}},{"name":"color_active","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-pagination-carousel .pxl-swiper-dots span.pxl-swiper-pagination-bullet.swiper-pagination-bullet-active,{{WRAPPER}} .pxl-pagination-carousel .pxl-swiper-dots span.pxl-swiper-pagination-bullet:hover":"color: {{VALUE}};"}},{"name":"bg_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-pagination-carousel .pxl-swiper-dots span.pxl-swiper-pagination-bullet.swiper-pagination-bullet-active:after":"background-color: {{VALUE}} !important;"}},{"name":"color_hover","label":"Background Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-pagination-carousel .pxl-swiper-dots span.pxl-swiper-pagination-bullet:hover":"background-color: {{VALUE}} !important;"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}