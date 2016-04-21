<?php
/**
 * Post date
 *
 * @package marine
 * @since marine 1.0
 */
?>
<span class="post-date">
	<span class="post-day"><?php echo get_the_date('d');?></span><br/>
	<?php echo get_the_date('M, Y');?>
</span>

<span class="post-format">
	<?php ts_post_icon(); ?>
</span>

<?php echo get_avatar( get_the_author_meta( 'user_email'), '70'); ?>
<span class="author"><?php _e('By','marine');?> <?php the_author();?></span>