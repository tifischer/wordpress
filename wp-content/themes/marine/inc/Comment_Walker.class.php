<?php
/** Custom COMMENTS WALKER */
class ts_walker_comment extends Walker_Comment {

// init classwide variables
var $tree_type = 'comment';
var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

/** CONSTRUCTOR
* You'll have to use this if you plan to get to the top of the comments list, as
* start_lvl() only goes as high as 1 deep nested comments */
function __construct() { ?>


<ul class="comments">

    <?php }

    /** START_LVL
     * Starts the list before the CHILD elements are added. Unlike most of the walkers,
     * the start_lvl function means the start of a nested comment. It applies to the first
     * new level under the comments that are not replies. Also, it appear that, by default,
     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    $GLOBALS['comment_depth'] = $depth + 1; ?>

    <ul>
        <?php }

        /** END_LVL
         * Ends the children list of after the elements are added. */
        function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

    </ul><!-- /.children -->

<?php }

/** START_EL */
function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
$depth++;
$GLOBALS['comment_depth'] = $depth;
$GLOBALS['comment'] = $comment;
$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>

    <li  id="comment-<?php comment_ID() ?>">
        <div class="comment">

            <div class="comment-author">

                <?php echo get_avatar( $comment, 70 ); ?>
                <span class="author"><?php _e('By', 'marine'); ?> <?php echo get_comment_author();?></span>
            </div>
            <div id="comment-body-<?php comment_ID() ?>" class="comment-content">
				<div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
                    <?php if( !$comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'marine');?></em>

                    <?php else: comment_text(); ?>
                    <?php endif; ?>
                </div><!-- /.comment-content -->


				<?php if ( ! comments_open() ) : ?>
					<div class="reply">
						<?php 
						if (!isset($add_below)):
							$add_below = '';
						endif;

						$reply_args = array(
							'add_below' => $add_below,
							'depth' => $depth,
							'max_depth' => $args['max_depth'] );

						comment_reply_link( array_merge( $args, $reply_args ) );  ?>
					</div><!-- /.reply -->
				<?php endif; ?>
            </div><!-- /.comment-body -->
        </div>
        <?php }

        function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

    </li><!-- /#comment-' . get_comment_ID() . ' -->

<?php }

/** DESTRUCTOR
 * I just using this since we needed to use the constructor to reach the top
 * of the comments list, just seems to balance out :) */
function __destruct() { ?>

</ul><!-- /#comment-list -->

<?php }
}