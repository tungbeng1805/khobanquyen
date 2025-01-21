<?php

class PxlCounter_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_counter';
    protected $title = 'BR Counter';
    protected $icon = 'eicon-counter-circle';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_layout","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout1.jpg"},"2":{"label":"Layout 2","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout2.jpg"},"3":{"label":"Layout 3","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout3.jpg"},"4":{"label":"Layout 4","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout4.jpg"},"5":{"label":"Layout 5","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout5.jpg"},"6":{"label":"Layout 6","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout6.jpg"},"7":{"label":"Layout 7","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_counter\/layout7.jpg"}}}]},{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"title7","label":"Title 2","type":"text","label_block":true,"condition":{"layout":["7"]}},{"name":"content","label":"Content","type":"textarea","label_block":true,"condition":{"layout":["6"]}},{"name":"starting_number","label":"Starting Number","type":"number","default":1},{"name":"ending_number","label":"Ending Number","type":"number","default":100},{"name":"ending_number7","label":"Ending Number 2","type":"number","default":100,"condition":{"layout":["7"]}},{"name":"prefix","label":"Number Prefix","type":"text","default":""},{"name":"prefix7","label":"Number Prefix 2","type":"text","default":"","condition":{"layout":["7"]}},{"name":"suffix","label":"Number Suffix","type":"text","default":""},{"name":"thousand_separator_char","label":"Number Separator","type":"select","options":{"":"Default",".":"Dot",",":"Comma"," ":"Space"},"default":""},{"name":"thousand_separator_char7","label":"Number Separator2","type":"select","options":{"":"Default",".":"Dot",",":"Comma"," ":"Space"},"default":"","condition":{"layout":["7"]}},{"name":"icon_type","label":"Icon Type","type":"select","options":{"icon":"Icon","image":"Image"},"default":"icon"},{"name":"pxl_icon","label":"Icon","type":"icons","fa4compatibility":"icon","condition":{"icon_type":["icon"]}},{"name":"icon_image","label":"Icon Image","type":"media","description":"Select image icon.","condition":{"icon_type":["image"]}},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"right":{"title":"Right","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--inner":"text-align: {{VALUE}};"},"condition":{"layout":["3"]}}]},{"name":"section_style_general","label":"General","tab":"style","controls":[{"name":"effect","label":"Effect","type":"select","options":{"effect-default":"Default","effect-slide":"Slide"},"default":"effect-default"},{"name":"style-l3","label":"Style","type":"select","default":"default","options":{"default":"Default","style-2":"Style 2"},"condition":{"layout":["3","5"]}},{"name":"box_size_z","label":"Box Icon Size","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--holder":"width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};"}},{"name":"box_gap","label":"Box Gap","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--holder":"gap: {{SIZE}}{{UNIT}};"}}]},{"name":"section_style_title","label":"Title","tab":"style","controls":[{"name":"title_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--title, {{WRAPPER}} .pxl-counter .pxl-counter-title":"color: {{VALUE}};"}},{"name":"title_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-counter .pxl-counter--title, {{WRAPPER}} .pxl-counter .pxl-counter-title"},{"name":"title_w","label":"Width","control_type":"responsive","type":"select","options":{"title-full-w":"Full","title-inline-w":"Inline"},"default":"title-inline-w"}]},{"name":"section_style_desc","label":"Description","tab":"style","condition":{"layout":"6"},"controls":[{"name":"desc_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--content":"color: {{VALUE}};"}},{"name":"desc_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-counter .pxl-counter--content"},{"name":"desc_padding","label":"Desc Padding","type":"dimensions","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--content":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;"},"responsive":true}]},{"name":"section_style_icon","label":"Icon","tab":"style","controls":[{"name":"box_size","label":"Box Icon Size","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon":"width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};"},"condition":{"icon_type":"icon"}},{"name":"icon_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon i":"color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;","{{WRAPPER}} .pxl-counter .pxl-counter--icon svg path":"fill: {{VALUE}};"}},{"name":"bg_icon_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon":"background-color: {{VALUE}};"}},{"name":"icon_font_size","label":"Icon Font Size","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon i":"font-size: {{SIZE}}{{UNIT}};","{{WRAPPER}} .pxl-counter .pxl-counter--icon svg":"width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};"},"condition":{"icon_type":"icon"}},{"name":"icon_space_top","label":"Top Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon":"padding-top: {{SIZE}}{{UNIT}};"}},{"name":"icon_space_bottom","label":"Bottom Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--icon":"margin-bottom: {{SIZE}}{{UNIT}};"},"separator":"after"}]},{"name":"section_number","label":"Number","tab":"style","controls":[{"name":"number_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number":"color: {{VALUE}};"}},{"name":"number_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--value"},{"name":"custom_font","label":"Custom Font Family","type":"select","options":{"":"Default","ft-gt":"Founders Grotesk"},"default":""},{"name":"prefix_suffix_color","label":"Prefix\/Suffix Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix, {{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix":"color: {{VALUE}};"},"condition":{"number_color_type":["color"]}},{"name":"duration","label":"Animation Duration","type":"number","default":2000,"min":100,"step":100},{"name":"number_space_top","label":"Top Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number":"margin-top: {{SIZE}}{{UNIT}};"}},{"name":"number_space_bottom","label":"Bottom Spacer","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number":"margin-bottom: {{SIZE}}{{UNIT}};"}}]},{"name":"section_number_suf","label":"Suffix","tab":"style","controls":[{"name":"suf_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--suffix":"color: {{VALUE}};"}},{"name":"suf_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-counter .pxl-counter--suffix"},{"name":"number_space_tb","label":"Transform X","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":-300,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix":"transform: translatey({{SIZE}}{{UNIT}});"}},{"name":"number_space_lr","label":"Padding Left\/Right","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":-300,"max":300}},"selectors":{"{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix":"margin-left:{{SIZE}}{{UNIT}};"}}]},{"name":"section_animation","label":"Animation","tab":"style","condition":[],"controls":[{"name":"pxl_animate","label":"Bravis Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipCase":"flipCase","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomInSmall":"zoomInSmall","wow zoomIn":"zoomInBig","wow zoomOut":"zoomOut","wow skewIn":"skewInLeft","wow skewInRight":"skewInRight","wow skewInBottom":"skewInBottom","wow RotatingY":"RotatingY","wow PXLfadeInUp":"PXLfadeInUp","fadeInPopup":"fadeInPopup"},"default":""},{"name":"pxl_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'elementor-waypoints','jquery-numerator','pxl-counter','pxl-counter-slide','maiko-counter' );
}