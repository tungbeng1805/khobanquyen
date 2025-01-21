<?php
if (!class_exists('icoland_Blog')) {

    class icoland_Blog
    {

        public function get_archive_meta() {
            $archive_author = icoland()->get_theme_opt( 'archive_author', true );  
            $archive_date = icoland()->get_theme_opt( 'archive_date', true );
            if( $archive_author || $archive_date) : ?>
                <ul class="pxl-item--meta">
                    <?php if($archive_author) : ?>
                        <li class="pxl-item--author">
                            <span>by</span><?php the_author_posts_link(); ?> 
                        </li>
                    <?php endif; ?>
                    <?php if($archive_date) : ?>
                        <li class="pxl-item--date"><?php echo get_the_date('F,d Y'); ?></li>
                    <?php endif; ?>
                </ul>
            <?php endif; 
        }

        public function get_archive_categorie() {
            $archive_categorie = icoland()->get_theme_opt( 'archive_categorie', true );
            if($archive_categorie) : ?>
                <?php if($archive_categorie) : ?>
                    <div class="pxl-item--category">
                        <?php the_terms( get_the_ID(), 'category' ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; 
        }


        public function get_excerpt(){
            $archive_excerpt_length = icoland()->get_theme_opt('archive_excerpt_length', '20');
            $icoland_the_excerpt = get_the_excerpt();
            if(!empty($icoland_the_excerpt)) {
                echo wp_trim_words( $icoland_the_excerpt, $archive_excerpt_length, $more = null );
            } else {
                echo wp_kses_post($this->get_excerpt_more( $archive_excerpt_length ));
            }
        }

        public function get_excerpt_more( $post = null ) {
            $archive_excerpt_length = icoland()->get_theme_opt('archive_excerpt_length', '50');
            $post = get_post( $post );

            if ( empty( $post ) || 0 >= $archive_excerpt_length ) {
                return '';
            }

            if ( post_password_required( $post ) ) {
                return esc_html__( 'Post password required.', 'icoland' );
            }

            $content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
            $content = str_replace( ']]>', ']]&gt;', $content );

            $excerpt_more = apply_filters( 'icoland_excerpt_more', '&hellip;' );
            $excerpt      = wp_trim_words( $content, $archive_excerpt_length, $excerpt_more );

            return $excerpt;
        }

        public function get_post_metas(){
            $post_author = icoland()->get_theme_opt( 'post_author', true );  
            $post_date = icoland()->get_theme_opt( 'post_date', true );
            if( $post_author || $post_date) : ?>
              <ul class="pxl-item--meta">
                <?php if($post_author) : ?>
                    <li class="pxl-item--author">
                        <span>by</span><?php the_author_posts_link(); ?> 
                    </li>
                <?php endif; ?>
                <?php if($post_date) : ?>
                    <li class="pxl-item--date"><?php echo get_the_date('d M Y'); ?></li>
                <?php endif; ?>
            </ul>
        <?php endif; 
    }
    public function get_post_categorie(){
        $post_category = icoland()->get_theme_opt( 'post_category', true );  
        if( $post_category) : ?>
            <div class="pxl-item--category">
              <?php the_terms( get_the_ID(), 'category','',',' ); ?>
          </div>
      <?php endif; 
  }

  public function icoland_set_post_views( $postID ) {
    $countKey = 'post_views_count';
    $count    = get_post_meta( $postID, $countKey, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $countKey );
        add_post_meta( $postID, $countKey, '0' );
    } else {
        $count ++;
        update_post_meta( $postID, $countKey, $count );
    }
}

public function get_tagged_in(){
    $tags_list = get_the_tag_list( '<label class="label">'.esc_attr__('Tags:', 'icoland'). '</label>', ',' );
    if ( $tags_list )
    {
        echo '<div class="pxl--tags">';
        printf('%2$s', '', $tags_list);
        echo '</div>';
    }
}

public function get_socials_share() { 
    $img_url = '';
    if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)) {
        $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false);
    }
    $social_facebook = icoland()->get_theme_opt( 'social_facebook', true );
    $social_twitter = icoland()->get_theme_opt( 'social_twitter', true );
    $social_pinterest = icoland()->get_theme_opt( 'social_pinterest', true );
    $social_linkedin = icoland()->get_theme_opt( 'social_linkedin', true );
    ?>
    <div class="pxl--social">
        <label class="label">Share:</label>
        <?php if($social_facebook) : ?>
            <a class="fb-social" title="<?php echo esc_attr__('Facebook', 'icoland'); ?>" target="_blank" href="http://www.facebook.com/"><i class="caseicon-facebook"></i></a>
        <?php endif; ?>
        <?php if($social_twitter) : ?>
            <a class="tw-social" title="<?php echo esc_attr__('Twitter', 'icoland'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>%20"><i class="caseicon-twitter"></i></a>
        <?php endif; ?>
        <?php if($social_pinterest) : ?>
            <a class="pin-social" title="<?php echo esc_attr__('Pinterest', 'icoland'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($img_url[0]); ?>&description=<?php the_title(); ?>%20"><i class="caseicon-pinterest"></i></a>
        <?php endif; ?>
        <?php if($social_linkedin) : ?>
            <a class="lin-social" title="<?php echo esc_attr__('LinkedIn', 'icoland'); ?>" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>%20"><i class="caseicon-linkedin"></i></a>
        <?php endif; ?>
    </div>
    <?php
}
function icoland_get_user_social() {

    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_skype = get_user_meta(get_the_author_meta( 'ID' ), 'user_skype', true);
    $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true);
    $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
    $user_tumblr = get_user_meta(get_the_author_meta( 'ID' ), 'user_tumblr', true);
    $user_pinterest = get_user_meta(get_the_author_meta( 'ID' ), 'user_pinterest', true);
    $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
    $user_yelp = get_user_meta(get_the_author_meta( 'ID' ), 'user_yelp', true);

    ?>
    <ul class="user-social">
        <?php if(!empty($user_facebook)) { ?>
            <li><a href="<?php echo esc_url($user_facebook); ?>"><i class="Caseicon-facebook"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <li><a href="<?php echo esc_url($user_twitter); ?>"><i class="Caseicon-twitter"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <li><a href="<?php echo esc_url($user_linkedin); ?>"><i class="Caseicon-linkedin"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_instagram)) { ?>
            <li><a href="<?php echo esc_url($user_instagram); ?>"><i class="Caseicon-instagram"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_skype)) { ?>
            <li><a href="<?php echo esc_url($user_skype); ?>"><i class="Caseicon-skype"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_pinterest)) { ?>
            <li><a href="<?php echo esc_url($user_pinterest); ?>"><i class="Caseicon-pinterest"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_vimeo)) { ?>
            <li><a href="<?php echo esc_url($user_vimeo); ?>"><i class="Caseicon-vimeo"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_youtube)) { ?>
            <li><a href="<?php echo esc_url($user_youtube); ?>"><i class="Caseicon-youtube"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_yelp)) { ?>
            <li><a href="<?php echo esc_url($user_yelp); ?>"><i class="Caseicon-yelp"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_tumblr)) { ?>
            <li><a href="<?php echo esc_url($user_tumblr); ?>"><i class="Caseicon-tumblr"></i></a></li>
        <?php } ?>

        </ul> <?php
    }
    public function get_socials_share_classes() { 
        $img_url = '';
        if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)) {
            $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false);
        }
        ?>
        <div class="pxl--social">
            <a class="fb-social" title="<?php echo esc_attr__('Facebook', 'icoland'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="caseicon-facebook"></i></a>
            <a class="tw-social" title="<?php echo esc_attr__('Twitter', 'icoland'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>%20"><i class="caseicon-twitter"></i></a>
            <a class="pin-social" title="<?php echo esc_attr__('Pinterest', 'icoland'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($img_url[0]); ?>&description=<?php the_title(); ?>%20"><i class="caseicon-pinterest"></i></a>
            <a class="lin-social" title="<?php echo esc_attr__('LinkedIn', 'icoland'); ?>" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>%20"><i class="caseicon-linkedin"></i></a>
        </div>
        <?php
    }

    public function get_post_nav() {
        global $post;
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
        ?>
        <?php
        $next_post = get_next_post();
        $previous_post = get_previous_post();

        if( !empty($next_post) || !empty($previous_post) ) { 
            ?>
            <div class="pxl-post--navigation">
                <div class="pxl--items">
                    <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { ?>
                     <div class="pxl--item pxl--item-prev">
                        <div class="label-nav"><?php echo esc_html__('Previous', 'icoland'); ?></div>
                        <div class="pxl--holder">
                            <div class="pxl--meta">
                                <div class="title-post-nav"><a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { ?>
                    <div class="pxl--item pxl--item-next">
                        <div class="label-nav"><?php echo esc_html__('Next', 'icoland'); ?></div>
                        <div class="pxl--holder">
                            <div class="pxl--meta">
                                <div class="title-post-nav">
                                    <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                
            </div><!-- .nav-links -->
        </div>
    <?php }
}

public function get_project_nav() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();

    if( !empty($next_post) || !empty($previous_post) ) { 
        ?>
        <div class="pxl-project--navigation">
            <div class="pxl--items">
                <div class="pxl--item pxl--item-prev">
                    <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { 
                        ?>
                        <a  href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><i class="far fa-long-arrow-left"></i>Prev Project</a>
                    <?php } ?>
                </div>
                <div class="pxl--item pxl--item-next">
                    <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') {
                        ?>
                        <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">Next Project <i class="far fa-long-arrow-right"></i> </a>
                    <?php } ?>
                </div>
            </div><!-- .nav-links -->
        </div>
    <?php }
}


public function icoland_related_post(){
    $post_related = icoland()->get_theme_opt( 'post_related', false );

    if($post_related) {
        global $post;
        $current_id = $post->ID;
        $posttags = get_the_category($post->ID);
        if (empty($posttags)) return;

        $tags = array();

        foreach ($posttags as $tag) {

            $tags[] = $tag->term_id;
        }
        $post_number = ' 6';
        $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
        if (count($query_similar->posts) > 1) {
            wp_enqueue_script( 'swiper' );
            wp_enqueue_script( 'pxl-swiper' );
            $opts = [
                'slide_direction'               => 'horizontal',
                'slide_percolumn'               => '1', 
                'slide_mode'                    => 'slide', 
                'slides_to_show'                => 4, 
                'slides_to_show_lg'             => 3, 
                'slides_to_show_md'             => 2, 
                'slides_to_show_sm'             => 2, 
                'slides_to_show_xs'             => 1, 
                'slides_to_scroll'              => 1, 
                'slides_gutter'                 => 30, 
                'arrow'                         => false,
                'dots'                          => true,
                'dots_style'                    => 'bullets'
            ];
            $data_settings = wp_json_encode($opts);
            $dir           = is_rtl() ? 'rtl' : 'ltr';
            ?>
            <div class="container">
                <div class="pxl-related-post">
                    <h6 class="widget-sub-title"><?php echo esc_html__('BLOGS', 'icoland'); ?></h6>
                    <h4 class="widget-title"><?php echo esc_html__('Related News', 'icoland'); ?></h4>
                    <div class="pxl-swiper-container" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
                        <div class="pxl-related-post-inner pxl-swiper-wrapper swiper-wrapper ">
                            <?php foreach ($query_similar->posts as $post):
                                $thumbnail_url = '';
                                if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'pxl-blog-small', false);
                            endif;
                            if ($post->ID !== $current_id) : ?>
                                <div class="pxl-swiper-slide swiper-slide grid-item">
                                    <div class="pxl-item--inner">
                                        <div class="pxl-item-image hover-imge-effect3">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" /></a>
                                            <?php } ?>
                                            <div class="item--category">
                                                <?php the_terms( $post->ID, 'category', '', ',' ); ?>
                                            </div>
                                        </div>
                                        <div class="content-bottom">
                                            <div class="pxl-item--date "><?php $date_formart = get_option('date_format'); echo get_the_date('d F Y', $post->ID); ?></div>
                                            <h3 class="pxl-item--title">
                                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>
            </div><?php }
        }
        wp_reset_postdata();
    }
}
}
