<?php

class PxlShowcase_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_showcase';
    protected $title = 'BR Showcase';
    protected $icon = 'eicon-parallax';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"layout","label":"Icon Type","type":"select","options":{"1":"Layout 1","2":"Layout 2"},"default":"1"},{"name":"image","label":"Image","type":"media"},{"name":"title","label":"Title","type":"text","condition":{"layout":"2"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-showcase .pxl-item--title","condition":{"layout":"2"}},{"name":"btn_text","label":"Button Text","type":"text"},{"name":"btn_link","label":"Button Link","type":"url","label_block":true},{"name":"active","label":"Active","type":"select","options":{"":"No","yes":"Yes"},"default":""},{"name":"active_label","label":"Active Label","type":"text","condition":{"active":"yes"}},{"name":"label_typography","label":"Label Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-showcase .pxl-item--label"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}