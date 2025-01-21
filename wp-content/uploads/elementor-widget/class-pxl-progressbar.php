<?php

class PxlProgressbar_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_progressbar';
    protected $title = 'BR Progress Bar';
    protected $icon = 'eicon-skill-bar';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"tab_layout","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_progressbar\/layout1.jpg"}}}]},{"name":"tab_content","label":"Content","tab":"content","controls":[{"name":"progressbar","label":"Progress Bar","type":"repeater","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"percent","label":"Percentage","type":"slider","default":{"size":50,"unit":"%"},"label_block":true}],"title_field":"{{{ title }}}"},{"name":"item_space","label":"Item Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-progressbar .pxl--item + .pxl--item":"margin-top: {{SIZE}}{{UNIT}};"}}]},{"name":"section_style_general","label":"General","tab":"style","controls":[{"name":"style","label":"Style","type":"select","options":{"style-1":"Style 1","style-2":"Style 2"},"default":"style-1","condition":{"layout":"1"}}]},{"name":"tab_style_title","label":"Title","tab":"style","controls":[{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .pxl-progressbar .pxl--title":"color: {{VALUE}};"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}}  .pxl-progressbar .pxl--title"}]},{"name":"tab_style_percentage","label":"Percentage","tab":"style","controls":[{"name":"percentage_color","label":"Percentage Color","type":"color","selectors":{"{{WRAPPER}} .pxl-progressbar .pxl--percentage":"color: {{VALUE}};"}},{"name":"percentage_typography","label":"Percentage Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-progressbar .pxl--percentage"}]},{"name":"tab_style_bar","label":"Bar","tab":"style","controls":[{"name":"bar_color","label":"Bar Color","type":"color","selectors":{"{{WRAPPER}} .pxl-progressbar .pxl--progressbar":"background-color: {{VALUE}};"}},{"name":"bar_bg_color","label":"Bar Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-progressbar .pxl-progressbar--wrap":"background-color: {{VALUE}};"}}]},{"name":"section_animation","label":"Animation","tab":"style","condition":[],"controls":[{"name":"pxl_animate","label":"Bravis Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipCase":"flipCase","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomInSmall":"zoomInSmall","wow zoomIn":"zoomInBig","wow zoomOut":"zoomOut","wow skewIn":"skewInLeft","wow skewInRight":"skewInRight","wow skewInBottom":"skewInBottom","wow RotatingY":"RotatingY","wow PXLfadeInUp":"PXLfadeInUp","fadeInPopup":"fadeInPopup"},"default":""},{"name":"pxl_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'pxl-progressbar','maiko-progressbar' );
}