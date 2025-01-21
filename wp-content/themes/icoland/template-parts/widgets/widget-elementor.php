<?php defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 * @package Tnex-Themes
 */

class icoland_Elementor_box_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'pxl_elementor_box',
            esc_html__( '* Icoland Elementor Box', 'icoland' ),
            array(
                'description' => esc_html__( 'Your site’s most Icon Social.', 'icoland' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    function widget($args, $instance) {
        global $woocommerce;
        $post_type = (int)$instance['post_type'];
        extract($args);

        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Social', 'icoland' ) : $instance['title'], $instance, $this->id_base);
        }

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', $before_widget);
        }
        echo ''.$before_widget;
        if (!empty($title))
            echo ''.$before_title . $title . $after_title;
        if($post_type > 0){
          $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $post_type );
          pxl_print_html($content);  
      }
      echo ''.$after_widget;
  }

  function update( $new_instance, $old_instance ) {
   $instance = $old_instance;
   $instance['title'] = strip_tags($new_instance['title']);
   $instance['post_type'] = $new_instance['post_type'];
   return $instance;
}

function form( $instance ) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $post_type_list = icoland_get_templates_option('widget','');
     $post_type = isset($instance['post_type']) ? esc_attr($instance['post_type']) : '';
    ?>
    <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'icoland' ); ?></label>
     <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
     <p>
        <label for="<?php echo esc_url($this->get_field_id('post_type')); ?>"><?php esc_html_e( 'Templates :', 'icoland' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_type') ); ?>">
            <?php 
            foreach ($post_type_list as $key => $value) {
                ?>
                <option value="<?php echo esc_attr($key) ?>"<?php if( $post_type == $key ){ echo 'selected="selected"';} ?>><?php echo esc_html($value); ?></option>
                <?php
            }
            ?>
        </select>
    </p>
    <?php
}

}

add_action( 'widgets_init', 'icoland_register_elementor_box_widget' );
function icoland_register_elementor_box_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'icoland_Elementor_box_Widget' );
    }
}