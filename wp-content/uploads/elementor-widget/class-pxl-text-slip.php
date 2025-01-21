<?php

class PxlTextSlip_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_text_slip';
    protected $title = 'BR Text Slip';
    protected $icon = 'eicon-tabs';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"text_content","label":"Text","tab":"content","controls":[{"name":"texts","label":"List","type":"repeater","controls":[{"name":"text","label":"Text","type":"textarea"}]}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'maiko-tabs' );
}