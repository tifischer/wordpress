<?php
/**
 * The template for displaying Comments.
 *
 * @package marine
 * @since marine 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

global $post;
$show_comment_form = get_post_meta($post->ID,'show_comment_form',true);


if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="post-comments">
    <?php if ( have_comments() ) : ?>
        <h3 class="bold"><span><?php echo number_format_i18n(get_comments_number()); ?></span> <?php _e('Comments','marine');?></h3>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'marine' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'marine' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'marine' ) ); ?></div>
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 70,
                'walker'=> new ts_walker_comment()
            ) );
            ?>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'marine' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'marine' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'marine' ) ); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // Check for comment navigation. ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'marine' ); ?></p>
        <?php endif; ?>
    <?php endif; // have_comments()
	if($show_comment_form != 'no'):
		$comment_args = array( 'title_reply'=> __('Leave A Reply Form', 'marine'),
		'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="iconic-input">
						<input placeholder="'.__('Name*', 'marine').'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
						<i class="icons icon-user-1"></i>
					</div>
				</div>',
		'email'  => '
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="iconic-input">
						<input id="email" placeholder="'.__('E-mail*', 'marine').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"  />
						<i class="icons icon-mail-4"></i>
					</div>
				</div>
			</div>',
		'url'    => '' ) ),
		'comment_field' => '<textarea placeholder="'.__('Message', 'marine').'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
		'submit'=>'',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		);
		comment_form($comment_args); 
	endif;
	?>
</div><!-- #comments -->