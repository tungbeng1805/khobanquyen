<?php
// make some configs
if(!function_exists('icoland_configs')){
    function icoland_configs($value){
         
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'icoland').' ('.icoland()->get_opt('primary_color', '#FF4581').')', 
                    'value' => icoland()->get_opt('primary_color', '#FF4581')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'icoland').' ('.icoland()->get_opt('secondary_color', '#ffffff').')', 
                    'value' => icoland()->get_opt('secondary_color', '#ffffff')
                ],
                'third'   => [
                    'title' => esc_html__('Third', 'icoland').' ('.icoland()->get_page_opt('third_color', '#403F83').')', 
                    'value' => icoland()->get_page_opt('third_color', '#403F83')
                ],
                'regular'   => [
                    'title' => esc_html__('Regular', 'icoland').' ('.icoland()->get_opt('regular_color', '#727272').')', 
                    'value' => icoland()->get_opt('regular_color', '#727272')
                ], 
            ],
            'link' => [
                'color' => icoland()->get_opt('link_color', ['regular' => '#ffffff'])['regular'],
                'color-hover'   => icoland()->get_opt('link_color', ['hover' => '#FF4581'])['hover'],
                'color-active'  => icoland()->get_opt('link_color', ['active' => '#FF4581'])['active'],
            ],
            'gradient' => [
                'color-from' => icoland()->get_page_opt('gradient_color', ['from' => '#FF4581'])['from'],
                'color-to' => icoland()->get_page_opt('gradient_color', ['to' => '#ffffff'])['to'],
            ],
               
        ];
        return $configs[$value];
    }
}
if(!function_exists('icoland_inline_styles')) {
    function icoland_inline_styles() {  
        
        $theme_colors      = icoland_configs('theme_colors');
        $link_color        = icoland_configs('link');
        $gradient_color        = icoland_configs('gradient');
         
        ob_start();
        echo ':root{';
            
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color-rgb: %2$s;', str_replace('#', '',$color),  icoland_hex_rgb($value['value']));
            }
            foreach ($link_color as $color => $value) {
                printf('--link-%1$s: %2$s;', $color, $value);
            } 
            foreach ($gradient_color as $color => $value) {
                printf('--gradient-%1$s: %2$s;', $color, $value);
            } 
        echo '}';

        return ob_get_clean();
         
    }
}
 