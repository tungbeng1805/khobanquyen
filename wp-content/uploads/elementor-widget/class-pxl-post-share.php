<?php

class PxlPostShare_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_post_share';
    protected $title = 'BR Post Share';
    protected $icon = 'eicon-navigation-horizontal';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"show_share","label":"Show Share","type":"switcher","default":"true"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}