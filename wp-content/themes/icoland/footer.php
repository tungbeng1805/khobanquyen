<?php
/**
 * @package Tnex-Themes
 */
$back_totop_on = icoland()->get_theme_opt('back_totop_on', true); ?>
		</div><!-- #main -->

		<?php icoland()->footer->getFooter(); ?>
		<?php  do_action( 'pxl_anchor_target') ?>
		<?php if (isset($back_totop_on) && $back_totop_on) : ?>
		    <a class="pxl-scroll-top" href="#"><i class="caseicon-long-arrow-right-three"></i></a>
		<?php endif; ?>

		</div><!-- #wapper -->
	<?php wp_footer(); ?>
	</body>
</html>
