 <?php
/**
 * The template for displaying video post format content
 *
 * @package marine
 * @since marine 1.0
 */
global $content_alternative, $content_grid;

$terms = wp_get_post_terms($post->ID, 'category');
$term_slugs = array();
if (count($terms) > 0):
	foreach ($terms as $term):
		$term_slugs[] = $term->slug;
	endforeach;
endif;

$post_class = array('post');
if (get_post_format()) {
	$post_class[] = 'format-' . get_post_format();
}
if (count($term_slugs) > 0) {
	$post_class = array_merge($post_class, $term_slugs);
}
?>
<div <?php post_class($post_class); ?>>
	<?php
	$url = get_post_meta($post->ID, 'video_url', true);
	if (!empty($url)) {
		$embadded_video = ts_get_embaded_video($url);
	} else if (empty($url)) {
		$embadded_video = get_post_meta($post->ID, 'embedded_video', true);
	}

	if (isset($embadded_video) && !empty($embadded_video)): ?>
		<div class="post-video">

				<?php echo $embadded_video; ?>

		</div>
	<?php elseif (has_post_thumbnail()): ?>
		<div class="post-thumbnail">
		   <?php ts_the_resized_post_thumbnail('blog-timeline-img',get_the_title(),'img-responsive'); ?>
		   <div class="post-hover">
			   <a class="link-icon" href="<?php the_permalink(); ?>"></a>
			   <a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
		   </div>
	   </div>
	<?php endif; ?>
	<div class="post-content">
		<div class="post-details">
			<h4 class="post-title">
				<span class="post-format">
					<?php ts_post_icon(); ?>
				</span>
				<a href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"><?php the_title(); ?></a>
			</h4>
		</div>
		<p class="latest-from-blog_item_text">
			<?php
			$excerpt_length = get_post_meta(CURRENT_ID, 'excerpt_length', true);
			if (empty($excerpt_length)):
				$excerpt_length = 'regular';
			endif;
			echo ts_get_the_excerpt_theme($excerpt_length); ?>
		</p>
		<a class="read-more big" href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"><?php _e('Read more', 'marine'); ?></a>
	</div>
	<div class="clear"></div>
</div>




