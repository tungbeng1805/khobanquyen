<?php

if (!class_exists('Maiko_Header')) {

    class Maiko_Header
    {
        public function getHeader()
        {
            
            $header_layout = (int)maiko()->get_opt('header_layout'); 
            $header_layout_sticky = (int)maiko()->get_opt('header_layout_sticky'); 
             
            if ($header_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {
                get_template_part( 'template-parts/header/default');
            } else {
                $args = [
                    'header_layout' => $header_layout,
                    'header_layout_sticky' => $header_layout_sticky
                ];
                get_template_part( 'template-parts/header/elementor','', $args );
            } 
             
        }
 
    }
}
