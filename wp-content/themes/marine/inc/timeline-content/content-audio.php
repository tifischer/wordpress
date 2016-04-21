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

	<div class="blog-format-audio">
		<?php $audio_url = get_post_meta(get_the_ID(), 'audio_url', true);
		if ($audio_url != ''):?>

				<audio>
					<source type="audio/mpeg" src="<?php echo $audio_url; ?>"></source>
					<?php _e('Your browser does not support the audio element.', 'marine');?>
				</audio>



		<?php endif; ?>
	</div>

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




