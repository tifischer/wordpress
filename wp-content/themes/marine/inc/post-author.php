<?php
/**
 * Post author info
 *
 * @package marine
 * @since marine 1.0
 */

global $current_user;
get_currentuserinfo();

if (is_object($current_user)):?>
	<!-- Post Author -->
	<div class="post-author">

		<?php
		echo get_avatar( get_the_author_meta( 'user_email'), '70');
		?>
		<h3><?php echo sprintf(__('About %s', 'marine'), $current_user -> display_name); ?></h3>

		<?php echo  get_the_author_meta( 'description');?>

	</div>
	<!-- /Post Author -->
<?php endif; ?>