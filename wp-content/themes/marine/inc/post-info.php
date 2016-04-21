<?php
/**
 * The default template for displaying post info
 *
 * @package marine
 * @since marine 1.0
 */
global $content_grid;

?>
<span class="post-author"><?php the_author_posts_link();?></span>
<span class="post-date"><?php the_time(get_option('date_format')); ?></span>
<?php if (is_single() || isset($content_grid) && $content_grid === true): ?>
	<span class="post-comments"><?php comments_number(__('No comments', 'marine'),__('1 comment', 'marine'),__('% comments', 'marine')); ?></span>
<?php else: ?>
	<span class="post-comments"><?php comments_number('0','1','%'); ?></span>
<?php endif; ?>
<?php if (!isset($content_grid) || $content_grid !== true):
	$categories = get_the_category_list(', ');
	if (!empty($categories)): ?>
		<span class="post-categories"><?php echo $categories; ?></span>
	<?php endif; ?>
<?php endif; ?>