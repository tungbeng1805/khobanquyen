<?php

class PxlIconUser_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_icon_user';
    protected $title = 'TN User';
    protected $icon = 'eicon-user';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"box_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-icon--users":"background-color: {{VALUE}};"}},{"name":"title","label":"Title Box","type":"text"},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .pxl-icon--users .pxl-user-heading":"color: {{VALUE}};"}},{"name":"button_color","label":"Background Button Color","type":"color","selectors":{"{{WRAPPER}} .pxl-icon--users  button":"background-color: {{VALUE}};","{{WRAPPER}} .pxl-icon--users  .btn":"background-color: {{VALUE}};"}},{"name":"border_color","label":"Input Border Color","type":"color","selectors":{"{{WRAPPER}} .pxl-icon--users .fields-content .field-group input":"border-color: {{VALUE}};"}},{"name":"button_to_color","label":"Link Color","type":"color","selectors":{"{{WRAPPER}} .btn-sign-up  span":"color: {{VALUE}};"}},{"name":"link_typography","label":"Link Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .btn-sign-up  span:nth-child(1)"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}