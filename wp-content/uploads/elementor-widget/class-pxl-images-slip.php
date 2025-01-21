<?php

class PxlImagesSlip_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_images_slip';
    protected $title = 'BR Images Slip';
    protected $icon = 'eicon-tabs';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"image_content","label":"Images","tab":"content","controls":[{"name":"images","label":"List","type":"repeater","controls":[{"name":"image","label":"Image","type":"media"}]},{"name":"img_size","label":"Image Size","type":"text","description":"Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height))."},{"name":"gap_height","label":"Space Image","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .pxl-images-slip .pxl-images--content":"gap: {{SIZE}}{{UNIT}};"}},{"name":"img_height","label":"Max Height Imgage","type":"slider","control_type":"responsive","size_units":["px","%"],"range":{"px":{"min":0,"max":1000},"%":{"min":0,"max":100}},"selectors":{"{{WRAPPER}} .pxl-images-slip .pxl-item--image":"max-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'maiko-tabs' );
}