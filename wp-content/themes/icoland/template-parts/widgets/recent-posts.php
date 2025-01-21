<?php defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 * @package Case-Themes
 */

class icoland_Recent_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'pxl_recent_posts',
            esc_html__( 'Icoland Recent Posts', 'icoland' ),
            array(
                'description' => esc_html__( 'Your site’s most recent Posts.', 'icoland' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => '',
            'number'        => 3,
            'post_in'        => '',
        ) );

        $title = $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo wp_kses_post($args['before_widget']);

        echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);

        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10)
        {
            $number = 4;
        }
        $post_in = $instance['post_in'];
        $sticky = '';
        if($post_in == 'featured') {
            $sticky = get_option( 'sticky_posts' );
        }
        $r = new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in'  => $sticky,
        ) );

        if ( $r->have_posts() )
        {
            echo '<div class="pxl--items">';

            while ( $r->have_posts() )
            {
                $r->the_post();
                global $post; ?>
                <div class="pxl--item">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'icoland-thumb-small', false); ?>
                    <div class="pxl-item--img">
                     <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
                 </div>
             <?php endif; ?>
             <div class="pxl-item--meta">
                    <div class="pxl-item--categorie">
                        <?php the_terms( get_the_ID(), 'category' ); ?>
                    </div>
                <?php printf(
                    '<h4 class="pxl-item--title"><a href="%1$s" title="%2$s">%3$s</a></h4>',
                    esc_url( get_permalink() ),
                    esc_attr( get_the_title() ),
                    get_the_title()
                ); ?>
                

            </div>
        </div>
    <?php }

    echo '</div>';
}

wp_reset_postdata();
wp_reset_query();

echo wp_kses_post($args['after_widget']);
}

function update( $new_instance, $old_instance )
{
    $instance = $old_instance;
    $instance['title']         = sanitize_text_field( $new_instance['title'] );
    $instance['number']        = absint( $new_instance['number'] );
    $instance['post_in'] = strip_tags($new_instance['post_in']);
    return $instance;
}

function form( $instance )
{
    $instance = wp_parse_args( (array) $instance, array(
        'title'         => esc_html__( 'Recent Posts', 'icoland' ),
        'number'        => 4,
    ) );

    $title         = $instance['title'];
    $number        = absint( $instance['number'] );
    $post_in = isset($instance['post_in']) ? esc_attr($instance['post_in']) : '';

    ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'icoland' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>

    <p><label for="<?php echo esc_url($this->get_field_id('post_in')); ?>"><?php esc_html_e( 'Post in', 'icoland' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_in') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_in') ); ?>">
            <option value="recent"<?php if( $post_in == 'recent' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent', 'icoland'); ?></option>
            <option value="featured"<?php if( $post_in == 'featured' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Featured', 'icoland'); ?></option>
        </select>
    </p>

    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'icoland' ); ?></label>
        <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
    </p>

    <?php
}
}
add_action( 'widgets_init', 'icoland_register_recent_widget' );
function icoland_register_recent_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'icoland_Recent_Posts_Widget' );
    }
}