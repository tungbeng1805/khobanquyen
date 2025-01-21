<?php

class PxlBreadcrumb_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_breadcrumb';
    protected $title = 'BR Breadcrumb';
    protected $icon = 'eicon-yoast';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_style","label":"Style","tab":"style","controls":[{"name":"text_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb":"color: {{VALUE}};"}},{"name":"ic_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb i":"color: {{VALUE}};"}},{"name":"active_color","label":"Active Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb span.breadcrumb-entry":"color: {{VALUE}};"}},{"name":"hover_color","label":"Hover Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb a:hover":"color: {{VALUE}};"}},{"name":"text_typography","label":"Text Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-breadcrumb"}]},{"name":"section_animation","label":"Animation","tab":"style","condition":[],"controls":[{"name":"pxl_animate","label":"Bravis Animate","type":"select","options":{"":"None","wow bounce":"bounce","wow flash":"flash","wow pulse":"pulse","wow rubberBand":"rubberBand","wow shake":"shake","wow swing":"swing","wow tada":"tada","wow wobble":"wobble","wow bounceIn":"bounceIn","wow bounceInDown":"bounceInDown","wow bounceInLeft":"bounceInLeft","wow bounceInRight":"bounceInRight","wow bounceInUp":"bounceInUp","wow bounceOut":"bounceOut","wow bounceOutDown":"bounceOutDown","wow bounceOutLeft":"bounceOutLeft","wow bounceOutRight":"bounceOutRight","wow bounceOutUp":"bounceOutUp","wow fadeIn":"fadeIn","wow fadeInDown":"fadeInDown","wow fadeInDownBig":"fadeInDownBig","wow fadeInLeft":"fadeInLeft","wow fadeInLeftBig":"fadeInLeftBig","wow fadeInRight":"fadeInRight","wow fadeInRightBig":"fadeInRightBig","wow fadeInUp":"fadeInUp","wow fadeInUpBig":"fadeInUpBig","wow fadeOut":"fadeOut","wow fadeOutDown":"fadeOutDown","wow fadeOutDownBig":"fadeOutDownBig","wow fadeOutLeft":"fadeOutLeft","wow fadeOutLeftBig":"fadeOutLeftBig","wow fadeOutRight":"fadeOutRight","wow fadeOutRightBig":"fadeOutRightBig","wow fadeOutUp":"fadeOutUp","wow fadeOutUpBig":"fadeOutUpBig","wow flip":"flip","wow flipCase":"flipCase","wow flipInX":"flipInX","wow flipInY":"flipInY","wow flipOutX":"flipOutX","wow flipOutY":"flipOutY","wow lightSpeedIn":"lightSpeedIn","wow lightSpeedOut":"lightSpeedOut","wow rotateIn":"rotateIn","wow rotateInDownLeft":"rotateInDownLeft","wow rotateInDownRight":"rotateInDownRight","wow rotateInUpLeft":"rotateInUpLeft","wow rotateInUpRight":"rotateInUpRight","wow rotateOut":"rotateOut","wow rotateOutDownLeft":"rotateOutDownLeft","wow rotateOutDownRight":"rotateOutDownRight","wow rotateOutUpLeft":"rotateOutUpLeft","wow rotateOutUpRight":"rotateOutUpRight","wow hinge":"hinge","wow rollIn":"rollIn","wow rollOut":"rollOut","wow zoomInSmall":"zoomInSmall","wow zoomIn":"zoomInBig","wow zoomOut":"zoomOut","wow skewIn":"skewInLeft","wow skewInRight":"skewInRight","wow skewInBottom":"skewInBottom","wow RotatingY":"RotatingY","wow PXLfadeInUp":"PXLfadeInUp","fadeInPopup":"fadeInPopup"},"default":""},{"name":"pxl_animate_delay","label":"Animate Delay","type":"text","default":"0","description":"Enter number. Default 0ms"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}