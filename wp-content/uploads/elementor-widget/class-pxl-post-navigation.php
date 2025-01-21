<?php

class PxlPostNavigation_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_post_navigation';
    protected $title = 'BR Post Navigation';
    protected $icon = 'eicon-navigation-horizontal';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"type","label":"Type","type":"select","default":"pagination","options":{"navigation":"Navigation"}},{"name":"show_share","label":"Show Share","type":"switcher","default":"true"},{"name":"show_grid","label":"Show Grid","type":"switcher","default":"false"},{"name":"link_grid_page","label":"Link Gird Page","type":"text","default":"#","condition":{"show_grid":"true"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}