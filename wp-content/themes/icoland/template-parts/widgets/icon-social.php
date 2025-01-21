<?php defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 * @package Tnex-Themes
 */

class icoland_Icon_Social_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'pxl_icon_social',
            esc_html__( '* Icoland Icon Social', 'icoland' ),
            array(
                'description' => esc_html__( 'Your site’s most Icon Social.', 'icoland' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    function widget($args, $instance) {
        global $woocommerce;

        extract($args);

        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Social', 'icoland' ) : $instance['title'], $instance, $this->id_base);
        }

        $icon_twitter = 'fab fa-twitter';
        $link_twitter = isset($instance['link_twitter']) ? $instance['link_twitter'] : '';
        
        $icon_facebook = 'fab fa-facebook-f';
        $link_facebook = isset($instance['link_facebook']) ? $instance['link_facebook'] : '';
        

        $icon_reddit = 'fab fa-reddit';
        $link_reddit = isset($instance['link_reddit']) ? $instance['link_reddit'] : '';


        $icon_linked = 'fab fa-linkedin-in';
        $link_linked = isset($instance['link_linked']) ? $instance['link_linked'] : '';
        

        $icon_printerest = 'fab fa-pinterest';
        $link_printerest = isset($instance['link_printerest']) ? $instance['link_printerest'] : '';
      
        $icon_stumbleupon = 'fab fa-stumbleupon';
        $link_stumbleupon = isset($instance['link_stumbleupon']) ? $instance['link_stumbleupon'] : '';
      
        $icon_delicious = 'fab fa-delicious';
        $link_delicious = isset($instance['link_delicious']) ? $instance['link_delicious'] : '';
 
        $icon_envelope = 'fas fa-envelope';
        $link_envelope = isset($instance['link_envelope']) ? $instance['link_envelope'] : '';
      
        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', $before_widget);
        }
        echo ''.$before_widget;

        if (!empty($title))
                echo ''.$before_title . $title . $after_title;

            echo "<ul class='pxl-social'>";

            if ($link_twitter != '') {
                echo "<li class='item-social tt'>";
                    echo '<a class="social-twitter" target="_blank" href="'.esc_url($link_twitter).'">';
                        echo '<i class="'.$icon_twitter.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_facebook != '') {
                echo "<li class='item-social fb'>";
                    echo '<a class="social-facebook" target="_blank" href="'.esc_url($link_facebook).'">';
                        echo '<i class="'.$icon_facebook.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_reddit != '') {
                echo "<li class='item-social rd'>";
                    echo '<a class="social-reddit" target="_blank" href="'.esc_url($link_reddit).'">';
                        echo '<i class="'.$icon_reddit.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_linked != '') {
                echo "<li class='item-social lk'>";
                    echo '<a class="social-linked" target="_blank" href="'.esc_url($link_linked).'">';
                        echo '<i class="'.$icon_linked.'"></i>';
                    echo "</a>";
                echo "</li>";
            } 

            if ($link_printerest != '') {
                echo "<li class='item-social pr'>";
                    echo '<a class="social-printerest" target="_blank" href="'.esc_url($link_printerest).'">';
                        echo '<i class="'.$icon_printerest.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_stumbleupon != '') {
                echo "<li class='item-social st'>";
                    echo '<a class="social-stumbleupon" target="_blank" href="'.esc_url($link_stumbleupon).'">';
                        echo '<i class="'.$icon_stumbleupon.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_delicious != '') {
                echo "<li class='item-social de'>";
                    echo '<a class="social-delicious" target="_blank" href="'.esc_url($link_delicious).'">';
                        echo '<i class="'.$icon_delicious.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            if ($link_envelope != '') {
                echo "<li class='item-social en'>";
                    echo '<a class="social-envelope" target="_blank" href="'.esc_url($link_envelope).'">';
                        echo '<i class="'.$icon_envelope.'"></i>';
                    echo "</a>";
                echo "</li>";
            }

            echo "</ul>";

        echo ''.$after_widget;
    }

    function update( $new_instance, $old_instance ) {
       $instance = $old_instance;
       $instance['title'] = strip_tags($new_instance['title']);

       $instance['link_twitter'] = strip_tags($new_instance['link_twitter']);

       $instance['link_facebook'] = strip_tags($new_instance['link_facebook']);

       $instance['link_reddit'] = strip_tags($new_instance['link_reddit']);

       $instance['link_linked'] = strip_tags($new_instance['link_linked']);

       $instance['link_printerest'] = strip_tags($new_instance['link_printerest']);

       $instance['link_stumbleupon'] = strip_tags($new_instance['link_stumbleupon']);

       $instance['link_delicious'] = strip_tags($new_instance['link_delicious']);

       $instance['link_envelope'] = strip_tags($new_instance['link_envelope']);


       return $instance;
   }

    function form( $instance ) {
         $title = isset($instance['title']) ? esc_attr($instance['title']) : '';

         $link_twitter = isset($instance['link_twitter']) ? esc_attr($instance['link_twitter']) : '';

         $link_facebook = isset($instance['link_facebook']) ? esc_attr($instance['link_facebook']) : '';

         $link_reddit = isset($instance['link_reddit']) ? esc_attr($instance['link_reddit']) : '';

         $link_linked = isset($instance['link_linked']) ? esc_attr($instance['link_linked']) : '';

         $link_printerest = isset($instance['link_printerest']) ? esc_attr($instance['link_printerest']) : '';

         $link_stumbleupon = isset($instance['link_stumbleupon']) ? esc_attr($instance['link_stumbleupon']) : '';

         $link_delicious = isset($instance['link_delicious']) ? esc_attr($instance['link_delicious']) : '';

         $link_envelope = isset($instance['link_envelope']) ? esc_attr($instance['link_envelope']) : '';


         ?>
         <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_twitter')); ?>"><?php esc_html_e( 'Link Twitter:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_twitter') ); ?>" type="text" value="<?php echo esc_attr( $link_twitter ); ?>" /></p>
         <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_facebook')); ?>"><?php esc_html_e( 'Link Facebook:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_facebook') ); ?>" type="text" value="<?php echo esc_attr( $link_facebook ); ?>" /></p>
         <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_reddit')); ?>"><?php esc_html_e( 'Link Reddit:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_reddit') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_reddit') ); ?>" type="text" value="<?php echo esc_attr( $link_reddit ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_linked')); ?>"><?php esc_html_e( 'Link Linked:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_linked') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_linked') ); ?>" type="text" value="<?php echo esc_attr( $link_linked ); ?>" /></p>
         <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_printerest')); ?>"><?php esc_html_e( 'Link Printerest:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_printerest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_printerest') ); ?>" type="text" value="<?php echo esc_attr( $link_printerest ); ?>" /></p>

        <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_stumbleupon')); ?>"><?php esc_html_e( 'Link Stumbleupon:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_stumbleupon') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_stumbleupon') ); ?>" type="text" value="<?php echo esc_attr( $link_stumbleupon ); ?>" /></p>

        <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_delicious')); ?>"><?php esc_html_e( 'Link Delicious:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_delicious') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_delicious') ); ?>" type="text" value="<?php echo esc_attr( $link_delicious ); ?>" /></p>

        <p><?php esc_html_e( '________________________________________', 'icoland' ); ?></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_envelope')); ?>"><?php esc_html_e( 'Link Envelope:', 'icoland' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_envelope') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_envelope') ); ?>" type="text" value="<?php echo esc_attr( $link_envelope ); ?>" /></p>

    <?php
    }

}

add_action( 'widgets_init', 'icoland_register_icon_social_widget' );
function icoland_register_icon_social_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'icoland_Icon_Social_Widget' );
    }
}