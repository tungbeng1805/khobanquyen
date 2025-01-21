<?php

class PxlIcon_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_icon';
    protected $title = 'BR Icons';
    protected $icon = 'eicon-alert';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"icons","label":"Icons","type":"repeater","controls":[{"name":"pxl_icon","label":"Icon","type":"icons","fa4compatibility":"icon"},{"name":"icon_link","label":"Link","type":"url","label_block":true},{"name":"label","label":"Label","type":"text","label_block":true},{"name":"content","label":"Content","type":"textarea","label_block":true,"description":"Apply Style Box Paralax"},{"name":"color_item","label":"Color","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}":"color: {{VALUE}};"}},{"name":"color_item_hover","label":"Color Hover","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}:hover":"color: {{VALUE}};"}}],"title_field":"{{{ label }}}"},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"right":{"title":"Right","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-icon1":"text-align: {{VALUE}};"}}]},{"name":"section_style","label":"Style","tab":"style","controls":[{"name":"style","label":"Style","type":"select","options":{"style-1":"Default","style-2":"Style Box","style-4":"Style Box 2","style-3":"Style Label","style-6":"Style Label 2","style-5":"Draw Svg","style-box-paralax":"Box Paralax"},"default":"style-1"},{"name":"animate_hover","label":"Animation Hover","type":"select","default":"","options":{"":"Style 1","ani1":"Style 2","ani2":"Style 3","ani3":"Style 4","down":"Scroll Down"}},{"name":"color","label":"Color","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a":"color: {{VALUE}};","{{WRAPPER}} .pxl-icon1 a svg path":"fill: {{VALUE}};"}},{"name":"space_t_tl","label":"Space Bottom","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-icon-list i":"margin-bottom: {{SIZE}}{{UNIT}};","{{WRAPPER}} .pxl-icon-list img":"margin-bottom: {{SIZE}}{{UNIT}};","{{WRAPPER}} .pxl-icon-list svg":"margin-bottom: {{SIZE}}{{UNIT}};"}},{"name":"color_hover","label":"Icon Color Hover","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a:hover":"color: {{VALUE}};","{{WRAPPER}} .pxl-icon1 a:hover svg path":"fill: {{VALUE}};"}},{"name":"box_color","label":"Box Color","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a":"background-color: {{VALUE}};"}},{"name":"box_color_hover","label":"Box Color Hover","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a:hover":"background-color: {{VALUE}};"}},{"name":"box_width","label":"Box Width","type":"slider","control_type":"responsive","size_units":["px","%"],"range":{"px":{"min":0,"max":300},"%":{"min":0,"max":100}},"selectors":{"{{WRAPPER}} .pxl-icon1 a":"width: {{SIZE}}{{UNIT}};"}},{"name":"box_height","label":"Box Height","type":"slider","control_type":"responsive","size_units":["px","%"],"range":{"px":{"min":0,"max":300},"%":{"min":0,"max":100}},"selectors":{"{{WRAPPER}} .pxl-icon1 a":"height: {{SIZE}}{{UNIT}};"}},{"name":"icon_font_size","label":"Font Size","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-icon1 a":"font-size: {{SIZE}}{{UNIT}};","{{WRAPPER}} .pxl-icon1 a svg":"width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};"}},{"name":"border_type","label":"Border Type","type":"select","options":{"":"None","solid":"Solid","double":"Double","dotted":"Dotted","dashed":"Dashed","groove":"Groove"},"selectors":{"{{WRAPPER}} .pxl-icon1 a":"border-style: {{VALUE}} !important;"}},{"name":"border_width","label":"Border Width","type":"dimensions","selectors":{"{{WRAPPER}} .pxl-icon1 a":"border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;"},"condition":{"border_type!":""},"responsive":true},{"name":"border_color","label":"Border Color","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a":"border-color: {{VALUE}} !important;"},"condition":{"border_type!":""}},{"name":"border_color_hover","label":"Border Color Hover","type":"color","default":"","selectors":{"{{WRAPPER}} .pxl-icon1 a:hover":"border-color: {{VALUE}} !important;"},"condition":{"border_type!":""}},{"name":"icon_border_radius","label":"Border Radius","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .pxl-icon1 a":"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}},{"name":"icon_margin","label":"Margin","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .pxl-icon1 a":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};","{{WRAPPER}} .pxl-icon1":"margin-left: -{{LEFT}}{{UNIT}};margin-right: -{{RIGHT}}{{UNIT}};"},"control_type":"responsive"}]},{"name":"section_style_t","label":"Title","tab":"style","controls":[{"name":"title_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-icon-list span":"color: {{VALUE}};"}},{"name":"t_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-icon-list span"},{"name":"custom_font","label":"Custom Font Family","type":"select","options":{"":"Default","ft-gt":"Founders Grotesk"},"default":""}]},{"name":"section_animation","label":"Animation","tab":"style","condition":[],"controls":[{"name":"pxl_animate","label":"Bravis Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipCase":"flipCase","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomInSmall":"zoomInSmall","wow zoomIn":"zoomInBig","wow zoomOut":"zoomOut","wow skewIn":"skewInLeft","wow skewInRight":"skewInRight","wow skewInBottom":"skewInBottom","wow RotatingY":"RotatingY","wow PXLfadeInUp":"PXLfadeInUp","fadeInPopup":"fadeInPopup"},"default":""},{"name":"pxl_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}