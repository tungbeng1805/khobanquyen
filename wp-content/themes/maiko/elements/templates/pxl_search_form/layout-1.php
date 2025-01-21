<div class="pxl-search-form1">
	<h3 class="pxl-widget-title pxl-empty"><?php echo esc_attr($settings['wg_title']); ?></h3>
	<form role="search" method="get" class="pxl-search-form <?php echo esc_attr($settings['pxl_animate']); ?>" action="<?php echo esc_url(home_url( '/' )); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
		<div class="pxl-searchform-wrap">
	        <input type="text" class="pxl-search-field" placeholder="<?php if(!empty($settings['email_placefolder'])) { echo esc_attr($settings['email_placefolder']); } else { esc_attr_e('Type Words Then Enter', 'maiko'); } ?>" name="s" />
	    	<button type="submit" class="pxl-search-submit"><i class="flaticon-search"></i></button>
	    </div>
	</form>
</div>