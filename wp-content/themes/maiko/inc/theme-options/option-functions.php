<?php 
/**
 * Get Post List 
*/
if(!function_exists('maiko_list_post')){
	function maiko_list_post($post_type = 'post', $default = false){
		$post_list = array();
		$posts = get_posts(array('post_type' => $post_type, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => '-1'));
		if($default){
			$post_list[-1] = esc_html__( 'Inherit', 'maiko' );
		}
		foreach($posts as $post){
			$post_list[$post->ID] = $post->post_title;
		}
		return $post_list;
	}
}

if(!function_exists('maiko_get_templates_option')){
	function maiko_get_templates_option($meta_value = 'df', $default = false){
		$post_list = array();
		if($default && !is_array($default)){
			$post_list[-1] = esc_html__('Inherit','maiko');
		}
		if(is_array($default)){
			$key = isset($default['key']) ? $default['key'] : '0';
			$post_list[$key] = !empty($default['value']) ? $default['value'] : esc_html__('None','maiko');
		}
		$args = array(
			'post_type' => 'pxl-template',
			'posts_per_page' => '-1',
			'orderby' => 'date',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key'       => 'template_type',
					'value'     => $meta_value,
					'compare'   => '='
				)
			)
		);

		$posts = get_posts($args);

		foreach($posts as $post){  
			$template_type = get_post_meta( $post->ID, 'template_type', true );
			if($template_type == 'df') continue;
			$post_list[$post->ID] = $post->post_title;
		}

		return $post_list;
	}
}

if(!function_exists('maiko_get_templates_slug')){
	function maiko_get_templates_slug($meta_value = 'df'){
		$post_list = array();
		$posts = get_posts(
			array(
				'post_type' => 'pxl-template', 
				'orderby' => 'date', 
				'order' => 'ASC', 
				'posts_per_page' => '-1',
				'meta_query' => array(
					array(
						'key'       => 'template_type',
						'value'     => $meta_value,
						'compare'   => '='
					)
				)
			)
		);

		foreach($posts as $post){
			$template_type = get_post_meta( $post->ID, 'template_type', true );
			if($template_type == 'df') continue;
			$value_args = [
				'post_id' => $post->ID, 
				'title' => $post->post_title
			];
			$template_position = get_post_meta( $post->ID, 'template_position', true );

			$value_args['position'] = !empty($template_position) ? $template_position : '';

			$post_list[$post->post_name] = $value_args;
		}
		return $post_list;
	}
}

if(!function_exists('maiko_header_opts')){
	function maiko_header_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);

		$opts = array(
			array(
				'id'      => 'header_layout',
				'type'    => 'select',
				'title'   => esc_html__('Main Header Layout', 'maiko'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','maiko'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => maiko_get_templates_option('header',$args['default']),
				'default' => $args['default_value']  
			),
			array(
				'id'      => 'header_layout_sticky',
				'type'    => 'select',
				'title'   => esc_html__('Sticky Header Layout', 'maiko'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','maiko'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => maiko_get_templates_option('header',$args['default']),
				'default' => $args['default_value'],
			)
		);

		return $opts;
	}
}

if(!function_exists('maiko_header_mobile_opts')){
	function maiko_header_mobile_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);

		$opts = array(
			array(
				'id'      => 'header_mobile_layout',
				'type'    => 'select',
				'title'   => esc_html__('Mobile Header Layout', 'maiko'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','maiko'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => maiko_get_templates_option('header-mobile',$args['default']),
				'default' => $args['default_value']  
			),
		);

		return $opts;
	}
}

if(!function_exists('maiko_page_title_opts')){
	function maiko_page_title_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => '1'
		]);
		if($args['default']){
			$pt_mode_options = [
				'-1'  => esc_html__('Inherit', 'maiko'),
				'bd'   => esc_html__('Builder', 'maiko'),
				'none'  => esc_html__('Disable', 'maiko')
			];
			$pt_mode_default = '-1';
		}else{
			$pt_mode_options = [
				'df'  => esc_html__('Default', 'maiko'),
				'bd'   => esc_html__('Builder', 'maiko'),
				'none'  => esc_html__('Disable', 'maiko')
			];
			$pt_mode_default = 'df';
		}
		$opts = array(
			array(
				'id'           => 'pt_mode',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'maiko' ),
				'options' => $pt_mode_options, 
				'default' => $pt_mode_default
			),
			array(
				'id'       => 'ptitle_layout',
				'type'     => 'select',
				'title'    => esc_html__('Page Title Layout', 'maiko'),
				'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','maiko'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options'  => maiko_get_templates_option('page-title',false),
				'default'  => $args['default_value'],
				'required' => array( 'pt_mode', '=', 'bd' )
			),
			array(
				'id'       => 'background_ptitle',
				'type'     => 'background',
				'title'    => esc_html__('Select Background Page Title', 'kimono'),			
				'output' => [
					'#pxl-page-title-elementor .pxl-section-bg-parallax',
				],
				'required' => array(
					array( 'pt_mode', '!=', 'none' )				
				),
				'url'      => false
			),    
		);

		return $opts;
	}
}
if(!function_exists('maiko_footer_opts')){
	function maiko_footer_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);

		$opts = array(
			array(
				'id'          => 'footer_layout',
				'type'        => 'select',
				'title'       => esc_html__('Footer Layout', 'maiko'),
				'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','maiko'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options'     => maiko_get_templates_option('footer', $args['default']),
				'default'     => $args['default_value'],
			)
		);

		return $opts;
	}
}
if(!function_exists('maiko_sidebar_pos_opts')){
	function maiko_sidebar_pos_opts($args=[]){
		$args = wp_parse_args($args,[
			'prefix'        => 'blog_',
			'default'       => false,
			'default_value' => 'right'
		]);

		if($args['default']){
			$options = [
				'-1'    => esc_html__('Inherit','maiko'),
				'left'  => esc_html__('Left','maiko'),
				'right' => esc_html__('Right','maiko'),
				'0'     => esc_html__('Disable','maiko'),
			];

		} else {
			$options = [
				'left'  => esc_html__('Left','maiko'),
				'right' => esc_html__('Right','maiko'),
				'0'     => esc_html__('Disable','maiko'),
			]; 
		}  
		$opts = array(
			array(
				'id'       => $args['prefix'].'sidebar_pos',
				'type'     => 'button_set',
				'title'    => esc_html__('Sidebar Position', 'maiko'),
				'subtitle' => esc_html__('Select a sidebar position is displayed.', 'maiko'),
				'options'  => $options,
				'default'  => $args['default_value'],
			),
		);

		return $opts;
	}
}


/* Get list menu */
function maiko_get_nav_menu_slug(){

	$menus = array(
		'-1' => esc_html__('Inherit', 'maiko')
	);

	$obj_menus = wp_get_nav_menus();

	foreach ($obj_menus as $obj_menu){
		$menus[$obj_menu->slug] = $obj_menu->name;
	}
	return $menus;
}