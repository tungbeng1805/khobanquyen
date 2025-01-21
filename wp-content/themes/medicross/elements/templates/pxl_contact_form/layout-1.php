<?php
if(class_exists('WPCF7') && !empty($settings['form_id'])) : ?>
    <div class="pxl-contact-form pxl-contact-form1 <?php echo esc_attr($settings['btn_width'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $settings['form_id'] ).'"]'); ?>
        <div id="qrcode" class="hide-qr"></div>
    </div>
<?php endif; ?>
<div id="qrcode"></div>
<p id="your-text-two"></div>
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@master/qrcode.js"></script> 
<script type="text/javascript">
var wpcf7Elm = document.querySelector( '.wpcf7' );
var qr = document.getElementById("qrcode");
var yourTextTwo = document.getElementById('your-text-two');
wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) { 
 setTimeout(function() {
  var respElem= document.querySelector( '.wpcf7-response-output' );
  var resp = respElem.innerHTML.split("%%");
  respElem.innerHTML = resp[0];
  qr.innerHTML='';
  new QRCode(document.getElementById("qrcode"), resp[1] ); 
  var yourText = document.createTextNode('ciao '+resp[1]);
  qr.parentNode.insertBefore( yourText, qr );
  yourTextTwo.innerHTML = '<a href="'+resp[1]+'">after</a>';
 }, 100);
}, false );
wpcf7Elm.addEventListener( 'wpcf7mailfailed', function( event ) {
 qr.innerHTML='';
});
</script>