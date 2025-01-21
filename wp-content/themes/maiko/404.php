<?php
/**
 * @package Bravis-Themes
 */
$subtitle_404 = maiko()->get_theme_opt('subtitle_404');
$title_404 = maiko()->get_theme_opt('title_404');
$des_404 = maiko()->get_theme_opt('des_404');
$button_404 = maiko()->get_theme_opt('button_404');
get_header(); ?>
<div class="wrap-content-404">
    <div class="pxl-error-image" style="background-image:url(<?php echo esc_url(get_template_directory_uri().'/assets/img/404.webp'); ?>);"></div>
    <div class="pxl-error-inner">
        <div class="content">
            <span class="pxl-error-subtitle">
                <?php if (!empty($subtitle_404)) {
                    echo pxl_print_html($subtitle_404);
                } else{
                    echo esc_html__('Oopsie!', 'maiko'); 
                } ?>
            </span>
            <div class="pxl-error-number">
                <span>4</span>
                <span style="background-image:url(<?php echo esc_url(get_template_directory_uri().'/assets/img/404-1.webp'); ?>);"></span>
                <span>4</span>
            </div>
            <div class="pxl-error-bottom">
                <div class="pxl-error-left">
                    <h3 class="pxl-error-title">
                        <?php if (!empty($title_404)) {
                            echo pxl_print_html($title_404);
                        } else{
                           echo esc_html__( 'Something\'s Missing...', 'maiko' );
                       } ?>

                   </h3>
                   <p class="pxl-error-description">
                    <?php if (!empty($des_404)) {
                        echo pxl_print_html($des_404);
                    } else{
                        echo esc_html__('The page you are looking for doesn\'t exist. It may have been moved or removed altogether. Please try
                            searching for some other page, or return to the website\'s homepage to find what you\'re looking for.', 'maiko');
                        } ?>
                    </p>
                </div>
                <a class="btn-sm" href="<?php echo esc_url(home_url('/')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256"><path d="M240,208H224V136l2.34,2.34A8,8,0,0,0,237.66,127L139.31,28.68a16,16,0,0,0-22.62,0L18.34,127a8,8,0,0,0,11.32,11.31L32,136v72H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM48,120l80-80,80,80v88H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48Zm96,88H112V160h32Z"/></svg>
                    <span>
                        <?php if (!empty($button_404)) {
                            echo pxl_print_html($button_404);
                        } else{
                           echo esc_html__('back to homepage', 'maiko'); 
                       } ?>
                   </span>
               </a>
           </div>
   </div>
</div>
<?php get_footer();
