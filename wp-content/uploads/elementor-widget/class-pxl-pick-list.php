<?php

class PxlPickList_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_pick_list';
    protected $title = 'BR Pick List';
    protected $icon = 'eicon-editor-list-ul';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_list","label":"Content","tab":"content","controls":[{"name":"current","label":"Current Item","type":"text","label_block":true},{"name":"menu_item","label":"Item","type":"repeater","controls":[{"name":"title","label":"Text","type":"text","label_block":true},{"name":"link","label":"Link","type":"url","label_block":true}],"title_field":"{{{ title }}}"}]},{"name":"section_style","label":"Style","tab":"style","controls":[{"name":"current_item_typography","label":"Current Item Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-pick-list .pxl-current-item"},{"name":"current_item_color","label":"Current Item Color","type":"color","selectors":{"{{WRAPPER}} .pxl-pick-list .pxl-current-item":"color: {{VALUE}};"}},{"name":"icon_typography","label":"Icon Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-pick-list .pxl-current-item label:after"},{"name":"list_typography","label":"List Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-pick-list .pxl-current-list"},{"name":"list_color","label":"List Item Color","type":"color","selectors":{"{{WRAPPER}} .pxl-pick-list .pxl-current-list":"color: {{VALUE}};"}},{"name":"list_color_hover","label":"List Item Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-pick-list .pxl-current-list a:hover":"color: {{VALUE}};"}},{"name":"dropdown_position","label":"Dropdown Position","type":"select","options":{"dr-left":"Left","dr-right":"Right"},"default":"dr-left"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}