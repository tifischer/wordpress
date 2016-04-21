<?php
/**
 * The template for displaying portfolio single basic content
 *
 * @package marine
 * @since marine 1.0
 */

if (have_posts()) : while (have_posts()): the_post(); ?>

    <section class="row normal-padding">
		<div class="col-lg-9 col-md-9 col-sm-9">
			<?php
			if (get_post_format() == 'video'):
				$video_url = get_post_meta($post->ID, 'video_url', true);
				if (!empty($video_url)):
					$embadded_video = ts_get_embaded_video($video_url);
				elseif (empty($video_url)):
					$embadded_video = get_post_meta($post->ID, 'embedded_video', true);
				endif;
				echo '<div class="format-video">' . $embadded_video . '</div>';

			elseif (get_post_format() == 'gallery'):
				$gallery = get_post_meta($post->ID, 'gallery_images', true);
				$gallery_html = '';
				if (is_array($gallery)):
					foreach ($gallery as $image):
						$gallery_html .= '<li>' . ts_get_resized_image_by_size($image['image'], 'portfolio-single-style2', $image['title']) . '</li>';
					endforeach;
				endif;
				echo ' <div class="flexslider portfolio-flexslider"><ul class="slides">' . $gallery_html . '</ul> </div>';
			else:
				echo ts_get_resized_post_thumbnail($post->ID, 'portfolio-single-style2', get_the_title(), 'img-responsive');
			endif;?>
			<?php
			if (comments_open()):
				comments_template('', true);
			endif;
			?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="project-description">
				<?php
				$xs_author = get_post_meta(get_the_ID(), 'work_author', true);
				$xs_author_url = get_post_meta(get_the_ID(), 'work_author_url', true);
				?>
				<?php ts_share_buttons('social-media'); ?>
				<?php if ($xs_author != ''): ?>
					<h6 class="bold"><?php _e('Work by', 'marine'); ?> <a href="<?php echo $xs_author_url; ?>"><?php echo $xs_author; ?></a></h6>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
			<?php
			$related_projects = get_post_meta($post->ID, 'show_related_projects_on_portfolio_single', true);
			if (empty($related_projects) || $related_projects == 'default') {
				$related_projects = ot_get_option('show_related_projects_on_portfolio_single');
			}
			if ($related_projects != 'no'): ?>
				<?php
				$args = array(
					'posts_per_page' => -1,
					'offset' => 0,
					'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
					'cat' => '',
					'orderby' => 'date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => get_the_ID(),
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'portfolio',
					'post_mime_type' => '',
					'post_parent' => '',
					'paged' => 1,
					'post_status' => 'publish',
					'post__not_in' => array(get_the_ID())
				);
				query_posts($args);
				?>
				<?php if (have_posts()) : ?>
					<h3 class="bold"><?php _e('Related Projects', 'marine'); ?></h3>
					<ul class="thumb-gallery">
						<?php while (have_posts()) : the_post();
							if (has_post_thumbnail($post->ID)):
								$image = ts_get_resized_post_thumbnail($post->ID, 'portfolio-related', get_the_title(), 'img-responsive');
							else:
								continue;
							endif;
							?>
							<li>
								<a class="prettyPhoto" rel="prettyPhoto[pp_gal]" href="<?php echo ts_img_url('full'); ?>">
									<?php echo $image; ?>
									<div class="carousel-item-hover"></div>
								</a>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php 
					wp_reset_postdata();
				endif;
				wp_reset_query();
				?>
			<?php endif; ?>
		</div>
    </section>
<?php endwhile; endif; ?>

