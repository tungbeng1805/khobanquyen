<?php

class PxlIconHiddenPanel_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_icon_hidden_panel';
    protected $title = 'BR Hidden Panel';
    protected $icon = 'eicon-menu-bar';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"content_template","label":"Select Template","type":"select","options":["None"],"default":"df","description":"Add new tab template: \"<a href=\"http:\/\/localhost\/icoland\/wp-admin\/edit.php?post_type=pxl-template\" target=\"_blank\">Click Here<\/a>\""},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .pxl-hidden-panel-button .line":"background-color: {{VALUE}};"}},{"name":"darkmode_icon_color","label":"Icon Color (Dark Mode)","type":"color","selectors":{".dark-mode {{WRAPPER}} .pxl-hidden-panel-button .line":"background-color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}