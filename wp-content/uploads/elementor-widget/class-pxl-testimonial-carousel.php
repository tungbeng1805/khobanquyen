<?php

class PxlTestimonialCarousel_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_testimonial_carousel';
    protected $title = 'BR Testimonial Carousel';
    protected $icon = 'eicon-testimonial';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_layout","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_testimonial_carousel\/layout1.jpg"},"2":{"label":"Layout 2","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_testimonial_carousel\/layout2.jpg"},"3":{"label":"Layout 3","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_testimonial_carousel\/layout3.jpg"},"4":{"label":"Layout 4","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_testimonial_carousel\/layout4.jpg"}}}]},{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"testimonial","label":"Testimonial","type":"repeater","condition":{"layout":["1","2","4"]},"controls":[{"name":"image","label":"Avatar","type":"media"},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"position","label":"Position","type":"text"},{"name":"desc","label":"Description","type":"textarea","show_label":false},{"name":"star","label":"Star","type":"select","default":"5","options":{"":"None","1":"1","2":"2","3":"3","4":"4","5":"5"}}],"title_field":"{{{ title }}}"},{"name":"testimonial1","label":"Testimonial","type":"repeater","condition":{"layout":["3"]},"controls":[{"name":"pxl_icon","label":"Icon Quote","type":"icons","fa4compatibility":"icon"},{"name":"title3","label":"Title","type":"text","label_block":true},{"name":"desc3","label":"Description","type":"textarea","show_label":false}],"title_field":"{{{ title3 }}}"},{"name":"show_icon","label":"Show Quote","type":"switcher","condition":{"layout":"3"}},{"name":"style3","label":"Style","type":"select","options":{"df":"Default","style-2":"Style 2"},"default":"df","condition":{"layout":"3"}},{"name":"link","label":"Link More","type":"url","label_block":true,"condition":{"layout":"2"}},{"name":"style4","label":"Style","type":"select","options":{"df":"Default","style-2":"Style 2"},"default":"df","condition":{"layout":"4"}}]},{"name":"section_style_title","label":"Title","tab":"style","controls":[{"name":"title_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title":"color: {{VALUE}} !important;"}},{"name":"title_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title"}]},{"name":"section_style_position","label":"Position","tab":"style","condition":{"layout":["1","2"]},"controls":[{"name":"position_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position":"color: {{VALUE}} !important;"}},{"name":"position_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position"}]},{"name":"section_style_desc","label":"Description","tab":"style","controls":[{"name":"line_color","label":"Under Line Color","type":"color","condition":{"layout":"1"},"selectors":{"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc":"border-color: {{VALUE}} !important;"}},{"name":"desc_max_height","label":"Desc Max Height","type":"slider","description":"Enter number.","range":{"px":{"min":0,"max":1000}},"control_type":"responsive","selectors":{"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc":"max-width: {{SIZE}}{{UNIT}};margin: 0 auto;"}},{"name":"desc_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc":"color: {{VALUE}} !important;"}},{"name":"desc_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc"}]},{"name":"section_settings_carousel","label":"Settings","tab":"settings","controls":[{"name":"item_padding_r","label":"Item Padding","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .pxl-swiper-container":"margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};","{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"control_type":"responsive"},{"name":"col_xs","label":"Columns XS Devices","type":"select","default":"1","options":{"auto":"Auto","1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_sm","label":"Columns SM Devices","type":"select","default":"2","options":{"auto":"Auto","1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_md","label":"Columns MD Devices","type":"select","default":"3","options":{"auto":"Auto","1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_lg","label":"Columns LG Devices","type":"select","default":"3","options":{"auto":"Auto","1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_xl","label":"Columns XL Devices","type":"select","default":"3","options":{"auto":"Auto","1":"1","2":"2","3":"3","4":"4","5":"5","6":"6"}},{"name":"col_xxl","label":"Columns XXL Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","5":"5","6":"6"}},{"name":"slides_to_scroll","label":"Slides to scroll","type":"select","default":"1","options":{"1":"1","2":"2","3":"3","4":"4","5":"5","6":"6"}},{"name":"arrows","label":"Show Arrows","type":"switcher"},{"name":"pagination","label":"Show Pagination","type":"switcher","default":false},{"name":"pagination_type","label":"Pagination Type","type":"select","default":"bullets","options":{"bullets":"Bullets","fraction":"Fraction","progressbar":"Progressbar"},"condition":{"pagination":"true"}},{"name":"dot_progressbar_color","label":"Progressbar Color","type":"color","selectors":{"{{WRAPPER}} .pxl-swiper-dots.pxl-swiper-pagination-progressbar .swiper-pagination-progressbar-fill":"background-color: {{VALUE}};"},"condition":{"pagination_type":"progressbar"}},{"name":"pause_on_hover","label":"Pause on Hover","type":"switcher"},{"name":"autoplay","label":"Autoplay","type":"switcher"},{"name":"autoplay_speed","label":"Autoplay Delay","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"infinite","label":"Infinite Loop","type":"switcher"},{"name":"speed","label":"Animation Speed","type":"number","default":500},{"name":"drap","label":"Show Scroll Drap","type":"switcher","default":false}]},{"name":"section_animation","label":"Animation","tab":"style","condition":[],"controls":[{"name":"pxl_animate","label":"Bravis Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipCase":"flipCase","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomInSmall":"zoomInSmall","wow zoomIn":"zoomInBig","wow zoomOut":"zoomOut","wow skewIn":"skewInLeft","wow skewInRight":"skewInRight","wow skewInBottom":"skewInBottom","wow RotatingY":"RotatingY","wow PXLfadeInUp":"PXLfadeInUp","fadeInPopup":"fadeInPopup"},"default":""},{"name":"pxl_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'swiper','pxl-swiper' );
}