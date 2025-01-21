<?php

class PxlBannerBox_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_banner_box';
    protected $title = 'BR Banner Box';
    protected $icon = 'eicon-posts-ticker';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_layout","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"https:\/\/demo.tnexthemes.com\/dataclient\/wp-content\/themes\/maiko\/elements\/widgets\/img-layout\/pxl_banner_box\/layout1.jpg"}}}]},{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"banner_image","label":"Image","type":"media"},{"name":"text","label":"Text","type":"text","default":"Click Here"},{"name":"btn_icon","label":"Icon","type":"icons","label_block":true,"fa4compatibility":"icon"},{"name":"link","label":"Link","type":"url","default":{"url":"#"}}]},{"name":"section_style","label":"Style","tab":"style","controls":[{"name":"style","label":"Style","type":"select","options":{"style-1":"Style 1","style-2":"Style 2"},"default":"style-1"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}