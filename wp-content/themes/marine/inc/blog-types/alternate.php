<?php
/**
 * The template for displaying altenate blog post content
 *
 * @package marine
 * @since marine 1.0
 */

global $alternate_count, $post;
$xs_post_format = get_post_format();
if ($alternate_count == 0): $alternate_count = 1;endif;?>

<?php 

/* Full Width Alternate */			
$post_alternate_full_width = false;

if($xs_post_format != 'video' 
   && $xs_post_format != 'audio' 
   && $xs_post_format != 'quote' 
   && !has_post_thumbnail()){
	
	$post_alternate_full_width = true;
	
}

?>


<?php if ($alternate_count == 1): $alternate_count = 2; ?>
    <div <?php post_class('blog-post alternate-style');?>>
		
		<div class="blog-post-alternate">
		
			<!-- Post Image -->
			<div class="blog-post-meta">
				<?php get_template_part('inc/post-date'); ?>

			</div>
			
			<div class="blog-post-content">
				
				
				<?php if(!$post_alternate_full_width): ?>
				<div class="post-thumbnail col-lg-6 col-md-6 col-sm-6 col-lg-push-6 col-md-push-6 col-sm-push-6">


					<?php
					switch ($xs_post_format) {

						case 'video':
							?>

							<?php
							$url = get_post_meta($post->ID, 'video_url', true);
							if (!empty($url)) {
								$embadded_video = ts_get_embaded_video($url);
							} else if (empty($url)) {
								$embadded_video = get_post_meta($post->ID, 'embedded_video', true);
							}

							if (isset($embadded_video) && !empty($embadded_video)): ?>
								<div class="post-videp format-video">
									<?php echo $embadded_video; ?>

								</div>
							<?php elseif (has_post_thumbnail()): ?>
								<div class="post-image">
									<a href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>">
										<?php
										if (isset($content_alternative) && $content_alternative === true):
											ts_the_resized_post_thumbnail('content-alternative', get_the_title());
										elseif (isset($content_grid) && $content_grid === true):
											ts_the_resized_post_thumbnail('content-grid', get_the_title());
										else:
											ts_the_resized_post_thumbnail_sidebar(array('full', 'one-sidebar', 'two-sidebars'), get_the_title());
										endif; ?>
									</a>
								</div>
							<?php endif; ?>

							<?php
							break;
						case 'audio':
							?>
							<div class="blog-format-audio">
								<?php $audio_url = get_post_meta(get_the_ID(), 'audio_url', true);
								if ($audio_url != ''):?>

									<audio>
										<source type="audio/mpeg" src="<?php echo $audio_url; ?>"></source>
										<?php _e('Your browser does not support the audio element.', 'marine'); ?>
									</audio>



								<?php endif; ?>
							</div> <?php

							ts_the_resized_post_thumbnail('alternate', get_the_title(), 'img-responsive');
							?>
							<?php if ( has_post_thumbnail()) : ?>
							<div class="post-hover">

								<a class="link-icon" href="<?php the_permalink(); ?>"></a>
								<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>

							</div>					<?php endif; ?>					
							<?php break;
						case 'quote':
							?>
							<blockquote>

								<p><?php echo get_post_meta(get_the_ID(), 'quote_text', true); ?></p>
								<span class="author"><?php echo get_post_meta(get_the_ID(), 'author_text', true); ?></span>

							</blockquote>
							<?php

							break;
						default:
							echo ts_get_resized_post_thumbnail($post->ID, 'alternate', get_the_title(), 'img-responsive');
							?>
								<?php if ( has_post_thumbnail()) : ?>
									<div class="post-hover">
										<a class="link-icon" href="<?php the_permalink(); ?>"></a>
										<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
									</div>
								<?php endif; ?>
							<?php
					}


					?>
				</div>
				<!-- /Post Image -->
				
				<?php endif; ?>


				<!-- Post Content -->
				<div class="post-content <?php if(!$post_alternate_full_width){ ?>col-lg-6 col-md-6 col-sm-6 col-lg-pull-6 col-md-pull-6 col-sm-pull-6<?php } else{ ?>col-lg-12 col-md-12 col-sm-12 full-width-alternate<?php } ?>">

					<ul class="post-meta">
						<li><?php echo ts_post_categories(get_the_ID()); ?></li>
						<li><?php comments_number( __('No comments', 'marine'), __('1 comment', 'marine'), __('% comments', 'marine')) ;?></li>
					</ul>

					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<?php
					$excerpt_length = get_post_meta(CURRENT_ID, 'excerpt_length', true);
					if (empty($excerpt_length)):
						$excerpt_length = 'regular';
					endif;
					echo ts_get_the_excerpt_theme($excerpt_length); ?>
					<a class="read-more big" href="<?php the_permalink(); ?>"><?php _e('Learn more', 'marine'); ?></a>

				</div>
				<!-- /Post Content -->
			
			</div>
			
		</div>
		
    </div>
<?php else: $alternate_count = 1; ?>

    <div <?php post_class('blog-post alternate-style');?>>
		
		<div class="blog-post-alternate">
		
			<!-- Post Image -->
			<div class="blog-post-meta">
				<?php get_template_part('inc/post-date'); ?>

			</div>
			
			<div class="blog-post-content">
				
				
				<?php if(!$post_alternate_full_width): ?>
				<div class="post-thumbnail col-lg-6 col-md-6 col-sm-6">


					<?php
					switch ($xs_post_format) {

						case 'video':
							?>

							<?php
							$url = get_post_meta($post->ID, 'video_url', true);
							if (!empty($url)) {
								$embadded_video = ts_get_embaded_video($url);
							} else if (empty($url)) {
								$embadded_video = get_post_meta($post->ID, 'embedded_video', true);
							}

							if (isset($embadded_video) && !empty($embadded_video)): ?>
								<div class="post-videp format-video">
									<?php echo $embadded_video; ?>

								</div>
							<?php elseif (has_post_thumbnail()): ?>
								<div class="post-image">
									<a href='<?php the_permalink(); ?>' title="<?php esc_attr_e(get_the_title()); ?>">
										<?php
										if (isset($content_alternative) && $content_alternative === true):
											ts_the_resized_post_thumbnail('content-alternative', get_the_title());
										elseif (isset($content_grid) && $content_grid === true):
											ts_the_resized_post_thumbnail('content-grid', get_the_title());
										else:
											ts_the_resized_post_thumbnail_sidebar(array('full', 'one-sidebar', 'two-sidebars'), get_the_title());
										endif; ?>
									</a>
								</div>
							<?php endif; ?>

							<?php
							break;
						case 'audio':
							?>
							<div class="blog-format-audio">
								<?php $audio_url = get_post_meta(get_the_ID(), 'audio_url', true);
								if ($audio_url != ''):?>

									<audio>
										<source type="audio/mpeg" src="<?php echo $audio_url; ?>"></source>
										<?php _e('Your browser does not support the audio element.', 'marine'); ?>
									</audio>



								<?php endif; ?>
							</div> <?php

							ts_the_resized_post_thumbnail('alternate', get_the_title(), 'img-responsive');
							?>
							<?php if ( has_post_thumbnail()) : ?>
							<div class="post-hover">

								<a class="link-icon" href="<?php the_permalink(); ?>"></a>
								<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>

							</div>					<?php endif; ?>					
							<?php break;
						case 'quote':
							?>
							<blockquote>

								<p><?php echo get_post_meta(get_the_ID(), 'quote_text', true); ?></p>
								<span class="author"><?php echo get_post_meta(get_the_ID(), 'author_text', true); ?></span>

							</blockquote>
							<?php

							break;
						default:
							echo ts_get_resized_post_thumbnail($post->ID, 'alternate', get_the_title(), 'img-responsive');
							?>
								<?php if ( has_post_thumbnail()) : ?>						<div class="post-hover">							<a class="link-icon" href="<?php the_permalink(); ?>"></a>							<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>						</div>						<?php endif; ?>
							<?php

					}


					?>
				</div>
				<!-- /Post Image -->
				<?php endif; ?>

				<!-- Post Content -->
				<div class="post-content <?php if(!$post_alternate_full_width){ ?>col-lg-6 col-md-6 col-sm-6<?php } else{ ?>col-lg-12 col-md-12 col-sm-12 full-width-alternate<?php } ?>">

					<ul class="post-meta">
						<li><?php echo ts_post_categories(get_the_ID()); ?></li>
						<li><?php comments_number( __('No comments', 'marine'), __('1 comment', 'marine'), __('% comments', 'marine')) ;?></li>
					</ul>

					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<?php
					$excerpt_length = get_post_meta(CURRENT_ID, 'excerpt_length', true);
					if (empty($excerpt_length)):
						$excerpt_length = 'regular';
					endif;
					echo ts_get_the_excerpt_theme($excerpt_length); ?>
					<a class="read-more big" href="<?php the_permalink(); ?>"><?php _e('Learn more', 'marine'); ?></a>

				</div>
				<!-- /Post Content -->
			
			</div>
			
		</div>
		
    </div>
<?php endif; ?>