<?php
/**
 * The template for displaying audio post format content
 *
 * @package marine
 * @since marine 1.0
 */
?>
<div class="col-lg-4 col-md-4 col-sm-4 masonry-box">    
	<div class="blog-post masonry"> 
		<?php
		global  $content_grid;
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
						<source type="audio/mpeg" src="<?php echo $audio_url; ?>">
						<?php _e('Your browser does not support the audio element.','marine'); ?>
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
                <?php if (isset($content_grid) && $content_grid === true): ?>
					<a class="read-more big" href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"><?php _e('Read more', 'marine'); ?></a>
                <?php else: ?>
                    <a class="sc-button" href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>"><?php _e('Read more', 'marine'); ?>
						<i class="icons icon-angle-right"></i></a>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="post-footer">
            <?php echo get_avatar(get_the_author_meta('user_email'), '60'); ?>
            <span class="post-date">
				<span class="post-day"><?php echo get_the_date('d M');?></span>
				<?php echo get_the_date('Y');?>
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