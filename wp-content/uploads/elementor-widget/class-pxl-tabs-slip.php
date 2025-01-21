<?php

class PxlTabsSlip_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_tabs_slip';
    protected $title = 'BR Tabs Slip';
    protected $icon = 'eicon-tabs';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_layout","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/templates\/pxl_tabs_slip\/layout-image\/layout1.jpg"}}}]},{"name":"tab_content","label":"Tabs","tab":"content","controls":[{"name":"style","label":"Style","type":"select","options":{"style-1":"Style 1","style-2":"Style 2"},"default":"style-1"},{"name":"tabs","label":"Content","type":"repeater","controls":[{"name":"content_template","label":"Select Templates","type":"select","options":{"0":"None","1073":"Pricing Basic","1155":"Pricing Advance","1159":"Pricing Premium","1163":"Pricing Custom","4173":"Tab Accordion","10689":"Section Approach 1","10728":"Section Approach 2","10729":"Section Approach 3","11781":"Home 2-tab-service","11796":"Home 2-tab-service-2","11798":"Home 2-tab-service-3"},"default":"df","description":"Add new tab template: \"<a href=\"https:\/\/demo.tnexthemes.com\/dataclient\/wp-admin\/edit.php?post_type=pxl-template\" target=\"_blank\">Click Here<\/a>\""}]}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'maiko-tabs' );
}