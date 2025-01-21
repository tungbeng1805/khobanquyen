<?php if(!function_exists('maiko_configs')){
    function maiko_configs($value){
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'maiko'), 
                    'value' => maiko()->get_opt('primary_color', '#121c27')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'maiko'), 
                    'value' => maiko()->get_opt('secondary_color', '#111111')
                ],
                'third'   => [
                    'title' => esc_html__('Third', 'maiko'), 
                    'value' => maiko()->get_opt('third_color', '#666666')
                ],
                'four'   => [
                    'title' => esc_html__('Four', 'maiko'), 
                    'value' => maiko()->get_opt('four_color', '#f5f2e5')
                ],
                'body_bg'   => [
                    'title' => esc_html__('Body Background Color', 'maiko'), 
                    'value' => maiko()->get_opt('body_bg_color', '#fff')
                ]
            ],

        ];
        return $configs[$value];
    }
}
if(!function_exists('maiko_inline_styles')) {
    function maiko_inline_styles() {  

        $theme_colors      = maiko_configs('theme_colors');
        //$link_color        = maiko_configs('link');
        //$gradient_color    = maiko_configs('gradient');
        ob_start();
        echo ':root{';

        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
        }
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color-rgb: %2$s;', str_replace('#', '',$color),  maiko_hex_rgb($value['value']));
        }
            // foreach ($link_color as $color => $value) {
            //     printf('--link-%1$s: %2$s;', $color, $value);
            // }
            // foreach ($gradient_color as $color => $value) {
            //     printf('--gradient-%1$s: %2$s;', $color, $value);
            //}
        echo '}';

        return ob_get_clean();

    }
}
