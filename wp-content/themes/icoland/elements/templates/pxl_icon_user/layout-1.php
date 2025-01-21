<?php 
$default_settings = [
	'style' => '',
	'text_placeholder' => '',
	'text_button' => '',
	'post_type' => '',
	'quick_user' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>

<div class="pxl-icon--users icon-item h-btn-user <?php echo esc_attr($settings['style']) ?>">
	<div class="wrap-content">
		<?php if(is_user_logged_in()) {  ?>
			<div class="pxl-modal pxl-user-popup">
				<div class="pxl-modal-content">
					<div class="pxl-user pxl-user-logged-in u-close">
						<div class="pxl-user-content">
							<?php echo do_shortcode('[tnex-user-form form_type="login"]'); ?>
						</div>
					</div>

				</div>
			</div>
		<?php }else { ?>
			<div class="pxl-user pxl-user-register hide">
				<div class="pxl-user-content">
					<div class="wrap-user-content">
						<h3 class="pxl-user-heading"><?php echo esc_html__('Sign up','icoland'); ?></h3>
						<p class="sub-title">Create New ICOLand Account</p>
						<?php echo do_shortcode('[tnex-user-form form_type="register" is_logged="profile"]'); ?>
						<p class="orlg"><span>Or Sign up With</span></p>  
						<div class="lg-or">
							<a href="#"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fb.png'); ?>" alt="<?php echo esc_attr__('404 Error', 'icoland'); ?>" /></a>
							<a href="#"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/gg.png'); ?>" alt="<?php echo esc_attr__('404 Error', 'icoland'); ?>" /></a>
						</div>
					</div>
				</div>
				<div class="button-to-login">
					<div id="to-login" class="btn-sign-up">Already have an account? <span>Login here</span></div>
				</div>
			</div>
			<div class="pxl-user pxl-user-login  ">
				<div class="pxl-user-content">
					<div class="wrap-user-content">
						<h3 class="pxl-user-heading"><?php echo esc_html__('Sign in','icoland'); ?></h3>
						<p class="sub-title">With your ICO Account</p>
						<?php echo do_shortcode('[tnex-user-form form_type="login" is_logged="profile"]'); ?>
						<p class="orlg"><span>Or Sign in With</span></p>  
						<div class="lg-or">
							<a href="#"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/fb.png'); ?>" alt="<?php echo esc_attr__('404 Error', 'icoland'); ?>" /></a>
							<a href="#"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/gg.png'); ?>" alt="<?php echo esc_attr__('404 Error', 'icoland'); ?>" /></a>
						</div>
					</div>
				</div>
				<div class="button-to-register">
					<div id="to-register" class="btn-sign-up">Dont have an account? <span>Sign up</span></div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>