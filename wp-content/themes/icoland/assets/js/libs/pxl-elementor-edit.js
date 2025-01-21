( function( $ ) {
    
    function icoland_section_start_render(){
        var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        _elementor.hooks.addFilter( 'pxl_section_start_render', function( html, settings, el ) {
            if(typeof settings.pxl_parallax_bg_img != 'undefined' && settings.pxl_parallax_bg_img.url != ''){
                html += '<div class="pxl-section-bg-parallax"></div>';
            }
            return html;
        } );
    } 
       
    $( window ).on( 'elementor/frontend/init', function() {
        icoland_section_start_render();
    } );
     
} )( jQuery );