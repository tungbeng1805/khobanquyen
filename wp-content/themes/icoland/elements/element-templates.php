<?php 

if(!function_exists('icoland_get_post_grid')){
    function icoland_get_post_grid($posts = [], $settings = []){ 
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['layout']) {
            case 'post-1':
            icoland_get_post_grid_layout1($posts, $settings);
            break;
            case 'post-2':
            icoland_get_post_grid_layout2($posts, $settings);
            break;
            case 'post-3':
            icoland_get_post_grid_layout3($posts, $settings);
            break;
            default:
            return false;
            break;
        }
    }
}

// Start Post Grid
//--------------------------------------------------
function icoland_get_post_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '818x546';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
            }
            $author = get_user_by('id', $post->post_author); ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                    <div class="pxl-item--image hover-imge-effect3">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                    </div>
                <?php endif; ?>
                <div class="wrap-content">
                    <div class="meta-top">
                        <?php if($show_category == 'true' ) : ?>
                            <div class="item--category">
                                <?php the_terms( $post->ID, 'category', '', ',' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="pxl-item--date "><?php $date_formart = get_option('date_format'); echo get_the_date('F d,Y', $post->ID); ?></div>
                    </div>
                    <h3 class="pxl-item--title">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                    </h3>
                    <div class="item--content">
                        <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                    </div>
                </div>
                
            </div>
        </div>
        <?php
    endforeach;
endif;
}

function icoland_get_post_grid_layout2($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '818x546';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
            }
            $author = get_user_by('id', $post->post_author); ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                    <div class="pxl-item--image hover-imge-effect3">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                    </div>
                <?php endif; ?>
                <div class="wrap-content">
                    <?php if($show_category == 'true' ) : ?>
                        <div class="item--category">
                            <?php the_terms( $post->ID, 'category', '', ',' ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="pxl-item--title">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                    </h3>
                    <div class="meta-top">
                        <div class="item--author">
                            <span>by </span><?php the_author_posts_link(); ?> 
                        </div>
                        <div class="pxl-item--date "><?php $date_formart = get_option('date_format'); echo get_the_date('F d,Y', $post->ID); ?></div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php
    endforeach;
endif;
}

function icoland_get_post_grid_layout3($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '818x546';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
            }
            $author = get_user_by('id', $post->post_author); ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                    <div class="pxl-item--image hover-imge-effect3">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                    </div>
                <?php endif; ?>
                <div class="wrap-content">
                    <div class="meta-top">
                        <?php if($show_category == 'true' ) : ?>
                            <div class="item--category">
                                <?php the_terms( $post->ID, 'category', '', ',' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="pxl-item--date "><?php $date_formart = get_option('date_format'); echo get_the_date('F d,Y', $post->ID); ?></div>
                    </div>
                    <h3 class="pxl-item--title">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                    </h3>
                    <div class="item--content">
                        <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                    </div>
                </div>
                
            </div>
        </div>
        <?php
    endforeach;
endif;
}


// End Post Grid
//--------------------------------------------------

// Start service Grid
//--------------------------------------------------


// End service Grid
//--------------------------------------------------

add_action( 'wp_ajax_icoland_load_more_product_grid', 'icoland_load_more_product_grid' );
add_action( 'wp_ajax_nopriv_icoland_load_more_product_grid', 'icoland_load_more_product_grid' );
function icoland_load_more_product_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'icoland'));
        }
        $settings = $_POST['settings'];
        set_query_var('paged', $settings['paged']);
        $query_type         = isset($settings['query_type']) ? $settings['query_type'] : 'recent_product';
        $post_per_page      = isset($settings['limit']) ? $settings['limit'] : 8;
        $product_ids        = isset($settings['product_ids']) ? $settings['product_ids'] : '';
        $categories         = isset($settings['categories']) ? $settings['categories'] : '';
        $param_args         = isset($settings['param_args']) ? $settings['param_args'] : [];

        $col_xxl = isset($settings['col_xxl']) ? 'col-xxl-'.str_replace('.', '',12 / floatval($settings['col_xxl'])) : '';
        $col_xl = isset($settings['col_xl']) ? 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl'])) : '';
        $col_lg = isset($settings['col_lg']) ? 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg'])) : '';
        $col_md = isset($settings['col_md']) ? 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md'])) : '';
        $col_sm = isset($settings['col_sm']) ? 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm'])) : '';
        $col_xs = isset($settings['col_xs']) ? 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs'])) : '';

        $item_class = trim(implode(' ', ['pxl-grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

        $loop = icoland_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
        extract($loop);

        $data_animation = [];
        $animate_cls = '';
        $data_settings = '';
        if ( !empty( $settings['item_animation'] ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$settings['item_animation_duration'];
            $data_animation['animation'] = $settings['item_animation'];
            $data_animation['animation_delay'] = $settings['item_animation_delay'];
        }
        if($posts->have_posts()){ 
            ob_start();
            $d = 0;
            while ($posts->have_posts()) {
                $posts->the_post();
                global $product;
                $term_list = array();
                $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
                foreach ($term_of_post as $term) {
                    $term_list[] = $term->slug;
                }
                $filter_class = implode(' ', $term_list);

                if ( !empty( $data_animation ) ) {
                    $data_animation['animation_delay'] = ((float)$settings['item_animation_delay'] * $d);
                    $data_animations = json_encode($data_animation);
                    $data_settings = 'data-settings="'.esc_attr($data_animations).'"';
                }

                ?>
                <div class="<?php echo trim(implode(' ', [$item_class, $filter_class, $animate_cls])); ?>" <?php pxl_print_html($data_settings); ?>>
                    <div class="pxl-item--inner ">
                        <div class="woocommerce-product">
                            <?php
                            $image_size = !empty($img_size) ? $img_size : 'full';
                            $img_id     = get_post_thumbnail_id( get_the_ID() );
                            if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)):
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $image_size
                                ) );
                            $thumbnail = $img['thumbnail'];
                            ?>
                        <?php endif; ?>
                        <?php 
                        echo wp_kses_post($thumbnail); ?>
                        <h5 class="woocommerce-product--title">
                            <a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><?php echo esc_attr(get_the_title(get_the_ID())); ?></a>
                        </h5>
                    </div>
                </div>
                <?php
            }
            if($settings['layout_mode'] == 'masonry')
                echo '<div class="grid-sizer '.$item_class.'"></div>';
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_html__('Load Post Grid Successfully!', 'icoland'),
                    'data' => array(
                        'html'  => $html,
                        'paged' => $settings['paged'],
                        'posts' => $posts,
                        'max' => $max,
                    ),
                )
            );
        }else{
            wp_send_json(
                array(
                    'status' => false,
                    'message' => esc_html__('Load Post Grid No More!', 'icoland')
                )
            );
        }
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}


// Start Portfolio Grid
//--------------------------------------------------

// End Portfolio Grid
//--------------------------------------------------

add_action( 'wp_ajax_icoland_get_pagination_html', 'icoland_get_pagination_html' );
add_action( 'wp_ajax_nopriv_icoland_get_pagination_html', 'icoland_get_pagination_html' );
function icoland_get_pagination_html(){
    try{
        if(!isset($_POST['query_vars'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'icoland'));
        }
        $query = new WP_Query($_POST['query_vars']);
        ob_start();
        icoland()->page->get_pagination( $query,  true );
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'icoland'),
                'data' => array(
                    'html' => $html,
                    'query_vars' => $_POST['query_vars'],
                    'post' => $query->have_posts()
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}

add_action( 'wp_ajax_icoland_load_more_post_grid', 'icoland_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_icoland_load_more_post_grid', 'icoland_load_more_post_grid' );
function icoland_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'icoland'));
        }
        $settings = $_POST['settings'];
        set_query_var('paged', $settings['paged']);
        extract(pxl_get_posts_of_grid($settings['post_type'], [
            'source' => isset($settings['source'])?$settings['source']:'',
            'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
            'order' => isset($settings['order'])?$settings['order']:'desc',
            'limit' => isset($settings['limit'])?$settings['limit']:'6',
            'post_ids' => isset($settings['post_ids'])?$settings['post_ids']:[],
        ]));
        ob_start();

        icoland_get_post_grid($posts, $settings);
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'icoland'),
                'data' => array(
                    'html' => $html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}