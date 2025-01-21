<?php 
	$dashboard_page_url = admin_url( 'admin.php?page=pxlart' );
	if( isset( $_GET['page'] ) && 'pxlart' === sanitize_text_field($_GET['page']) ) {
		$dashboard_page_url = '';
	}
	$plugin_page_url = admin_url( 'admin.php?page=pxlart-plugins' );
	$import_demos_page_url = admin_url( 'admin.php?page=pxlart-import-demos' );

	$pxl_server_info = apply_filters( 'pxl_server_info', 
		[
			'video_url' => '#',
			'demo_url' => 'https://demo.tnexthemes.com/icoland/',
			'docs_url' => 'https://doc.tnexthemes.com/icoland/', 
			'support_url' => 'mailto:tnexthemes@gmail.com'] 
		) ; 
?>
<nav class="pxl-dsb-menubar">
	<?php 
	$favicon = icoland()->get_theme_opt( 'favicon' );
	$logo_url = !empty($favicon['url']) ? $favicon['url'] : get_template_directory_uri() . '/inc/admin/assets/img/logo.png'; ?>
	<div class="pxl-dsb-logo">
		<div class="pxl-dsb-logo-inner">
			<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( icoland()->get_name() ); ?>">
		</div>
		<div class="pxl-dsb-logo-title">
			<h2><?php esc_html_e( 'Welcome to', 'icoland' ); ?> <?php echo esc_attr( icoland()->get_name() ).'!'; ?></h2>
			<span class="pxl-v"><?php esc_html_e( 'Version', 'icoland' ); ?> <?php echo esc_html(icoland()->get_version()) ?></span>
		</div>
	</div>
	<div class="pxl-dsb-menu">
		<ul class="pxl-dsb-menu-left">
			<li class="<?php echo ( isset( $_GET['page'] ) && 'pxlart' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_attr($dashboard_page_url); ?>">
					<span><?php echo sprintf( esc_html__( '%s Dashboard', 'icoland' ), icoland()->get_name()); ?></span>
				</a>
			</li>
			<li class="<?php echo ( isset( $_GET['page'] ) && 'pxlart-plugins' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_url($plugin_page_url); ?>">
					<span><?php esc_html_e( 'Install Plugins', 'icoland' ); ?></span>
				</a>
			</li>
			<li class="<?php echo ( isset( $_GET['page'] ) && 'pxlart-import-demos' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_url($import_demos_page_url); ?>">
					<span><?php esc_html_e( 'Import Demo', 'icoland' ); ?></span>
				</a>
			</li>
		</ul>
		<ul class="pxl-dsb-menu-right">
			<li>
				<a href="#link" target="_blank">
					<span><?php esc_html_e( 'Videos tutorial', 'icoland' ); ?></span>
				</a>
			</li>
			<li>
				<a href="mailto:tnexthemes@gmail.com" target="_blank">
					<span><?php esc_html_e( 'Support system', 'icoland' ); ?></span>
				</a>
			</li>
			<li>
				<a href="https://demo.tnexthemes.com/icoland/" target="_blank">
					<span><?php esc_html_e( 'Live Demo', 'icoland' ); ?></span>
				</a>
			</li>
			 
			<li>
				<a href="https://doc.tnexthemes.com/icoland/" target="_blank">
					<i class="pxl-icn-ess icon-md-help-circle"></i>
					<span><?php esc_html_e( 'Documentations', 'icoland' ); ?></span>
				</a>
			</li>
		</ul>
	</div>
</nav> 
