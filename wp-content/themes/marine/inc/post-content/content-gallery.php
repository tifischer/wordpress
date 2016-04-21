<?php
/**
 * The template for displaying gallery post format content
 *
 * @package marine
 * @since marine 1.0
 */
?>
<div class="col-lg-4 col-md-4 col-sm-4 masonry-box">
	<div class="blog-post masonry">
		<?php $terms = wp_get_post_terms($post->ID, 'category');
		$term_slugs = array();
		if (count($terms) > 0): foreach ($terms as $term): $term_slugs[] = $term->slug;
			endforeach;
		endif;
		$post_class = array('post');
		if (get_post_format()) {
			$post_class[] = 'format-' . get_post_format();
		} if (count($term_slugs) > 0) {
			$post_class = array_merge($post_class, $term_slugs);
		} ?>
		<div <?php post_class($post_class); ?>>
			
			<?php 
			$gallery = get_post_meta($post->ID, 'gallery_images',true);
			if (is_array($gallery) && count($gallery) > 0): ?>	
				<div class="post-thumbnail">
					<div class="post-image-gallery">
						<ul class="slides">
							<?php foreach ($gallery as $image): ?>
								<li>
									<?php 
									echo ts_get_resized_image_by_size($image['image'], 'blog-grid-img', $image['title']);
									?>
									<div class="post-hover">
										<a class="link-icon" href="<?php the_permalink(); ?>" title="<?php echo esc_attr($image['title']); ?>"></a>
										<a class="search-icon" href="<?php echo esc_attr($image['image']); ?>" rel="prettyPhoto"></a>
									</div>
								</li>
								
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php elseif (has_post_thumbnail()): ?>
				<div class="post-thumbnail">
					<?php ts_the_resized_post_thumbnail_sidebar(array('blog-grid-img'), get_the_title(), 'img-responsive'); ?>
					<div class="post-hover">
						<a class="link-icon" href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"></a>
						<a class="search-icon" href="<?php echo ts_img_url();?>" rel="prettyPhoto"></a>
					</div>
				</div>
			<?php endif; ?>
			<div class="post-content">
				<div class="post-details">
					<h4 class="post-title">
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
				<a class="read-more" href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"><?php _e('Read more', 'marine'); ?></a>
			</div>
			<div class="clear"></div>        
		</div>
		<div class="post-footer">
			<?php echo get_avatar(get_the_author_meta('user_email'), '60'); ?>
			<span class="post-date">
				<span class="post-day"><?php echo the_date('d'); ?></span>
				<?php echo date('M, Y'); ?>
			</span>
			<ul class="post-meta">
				<li><?php _e('By', 'marine'); ?> <?php the_author(); ?></li>
				<?php $categories = get_the_category_list(', ');
				if (!empty($categories)): ?>
					<li><?php echo ts_get_shortened_string_by_letters(strip_tags($categories), 15); ?></li>
				<?php endif; ?>	
				<li><?php comments_number( __('No comments', 'marine'), __('1 comment', 'marine'), __('% comments', 'marine')) ;?></li>
			</ul>
		</div>
	</div>
</div>