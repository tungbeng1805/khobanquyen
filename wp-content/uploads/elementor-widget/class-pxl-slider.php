<?php

class PxlSlider_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_slider';
    protected $title = 'TN Slider';
    protected $icon = 'eicon-slider-device';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"style","label":"Style","type":"select","default":"style-1","options":{"style-1":"Style 1","style-2":"Style 2","style-3":"Style 3"}},{"name":"slides","label":"Slides","type":"repeater","controls":[{"name":"slide_template","label":"Select Template","type":"select","options":["None"],"default":"df","description":"Add new tab template: \"<a href=\"https:\/\/demo.tnexthemes.com\/dataclient\/wp-admin\/edit.php?post_type=pxl-template\" target=\"_blank\">Click Here<\/a>\""},{"name":"bg_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-element-slider .pxl-slider--inner{{CURRENT_ITEM}}":"background-color: {{VALUE}};"}},{"name":"bg_image","label":"Background Image","type":"media"},{"name":"bg_ken_burns","label":"Background Ken Burns","type":"switcher","default":"false"},{"name":"overlay_color","label":"Overlay Color","type":"color","selectors":{"{{WRAPPER}} .pxl-element-slider .pxl-slider--overlay{{CURRENT_ITEM}}":"background-color: {{VALUE}};"}},{"name":"overlay_image","label":"Overlay Image","type":"media"}]},{"name":"social","label":"Social","type":"repeater","condition":{"style":["style-1"]},"controls":[{"name":"pxl_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"icon_link","label":"Link","type":"url","label_block":true}]}]},{"name":"section_content_slogan","label":"Slogan","tab":"content","condition":{"style":["style-1"]},"controls":[{"name":"slogan_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"slogan_label","label":"Label","type":"text","label_block":true}]},{"name":"section_settings_carousel","label":"Settings","tab":"settings","controls":[{"name":"arrows","label":"Show Arrows","type":"switcher"},{"name":"pagination","label":"Show Pagination","type":"switcher","default":"false"},{"name":"pagination_type","label":"Pagination Type","type":"select","default":"bullets","options":{"bullets":"Bullets","fraction":"Fraction"},"condition":{"pagination":"true"}},{"name":"pause_on_hover","label":"Pause on Hover","type":"switcher"},{"name":"autoplay","label":"Autoplay","type":"switcher"},{"name":"autoplay_speed","label":"Autoplay Delay","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"infinite","label":"Infinite Loop","type":"switcher"},{"name":"speed","label":"Animation Speed","type":"number","default":500},{"name":"progressbar","label":"Show Progress Bar","type":"switcher","default":"false"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'swiper','pxl-swiper' );
}