<?php
/**
 * @package Tnex-Themes
 */
get_header();?>
<div class="container">
    <div class="row content-row">
        <div id="pxl-content-area" class="pxl-content-area col-12">
            <main id="pxl-content-main">
                <div class="wrap-content-404">
                    <div class="pxl-error-inner" >
                        <h3 class="pxl-error-title">
                            <?php echo esc_html__('Page Not Found', 'icoland'); ?>
                        </h3>
                        <div class="error-404-desc">
                            <?php echo esc_html__("We can’t find the page that you’re looking for.", "icoland"); ?>
                        </div>
                        <a class="pxl-error-button btn btn-gradient" href="<?php echo esc_url(home_url('/')); ?>">
                            <span class="pxl--btn-text  effect"><?php echo esc_html__('Back To Homepage', 'icoland'); ?></span>
                        </a>
                    </div>
                </div>
                
            </main>
        </div>
    </div>
</div>


