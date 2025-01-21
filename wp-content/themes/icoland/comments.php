<?php
/**
 * @package Tnex-Themes
 */

if ( post_password_required() ) {
    return;
} ?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) : ?>
        <div class="comment-list-wrap">

            <h2 class="comments-title">
                <?php
                $comment_count = get_comments_number();
                if ( 1 === intval($comment_count) ) {
                    echo esc_html__( 'Comment', 'icoland' );
                } else {
                    echo esc_html__('Comments', 'icoland');
                }
                ?>
            </h2>

            <?php the_comments_navigation(); ?>

            <ul class="comment-list">
                <?php
                wp_list_comments( array(
                    'style'      => 'ul',
                    'short_ping' => true,
                    'callback'   => 'icoland_comment_list',
                    'max_depth'  => 3
                ) );
                ?>
            </ul>

            <?php the_comments_navigation(); ?>
        </div>
        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'icoland' ); ?></p>
            <?php
        endif;

    endif;

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => esc_attr__( 'Leave a Comment', 'icoland'),
        'title_reply_to'    => esc_attr__( 'Leave a Comment To ', 'icoland') . '%s',
        'cancel_reply_link' => esc_attr__( 'Cancel Comment', 'icoland'),
        'label_submit'      => esc_attr__( 'Send', 'icoland'),
        'comment_notes_before' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(

            'label' =>
            '<div class="title-form">'.
            'Name*</div>',

            'author' =>
            '<div class="wrap-comment"><div class="comment-form-author ">'.
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30" placeholder="'.esc_attr__('', 'icoland').'"/></div>',
            '<div class="title-form">'.
            'Email*</div>',
            'email' =>
            '<div class="comment-form-email ">'.
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30" placeholder="'.esc_attr__('', 'icoland').'"/></div>',
            '<div class="title-form">'.
            'Message *</div>',
        )
    ),
        
        'comment_field' =>  '<div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('', 'icoland').'" aria-required="true">' .
        '</textarea></div>',
    );
    comment_form($args); ?>
</div>
