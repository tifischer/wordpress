<?php
/**
 * Shortcode Title: Recent News Big
 * Shortcode: recent_news_big
 * Usage: [recent_news_big animation="fade" length="100" count=10 ],
 */

add_shortcode('recent_news_big', 'ts_recent_news_big_func');

function ts_recent_news_big_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'animation' => '',
        'limit' => '',
		'category' => ''
    ), $atts));

    $html = '';
    if (empty($limit)) {
        $limit = 1;
    }

    $latest = new Wp_Query(
        array(
            'post_type' => 'post',
            'posts_per_page' => $limit
        )
    );

    ob_start();

    if ($latest->have_posts()): ?>
		<section class="section normal-padding">				
			<div class="row">
				<?php while ($latest->have_posts()): $latest->the_post();?>
					<div class="col-lg-10 col-md-10 col-sm-12 col-lg-push-1 col-md-push-1 <?php echo ts_get_animation_class($animation); ?>">
						<div class="blog-post">
							<div class="blog-post-list">
								<div class="blog-post-meta">
									<span class="post-date">
										<span class="post-day"><?php echo get_the_date('d'); ?></span><br>
										<?php echo get_the_date('M, Y'); ?>
									</span>
									<span class="post-format">
										<?php ts_post_icon(); ?>
									</span>
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?><span class="author"><?php _e('By', 'marine'); ?> <?php the_author(); ?></span>
								</div>

								<div class="blog-post-content">
									<!-- Post Image -->
									<div class="post-thumbnail">
										<?php ts_the_resized_post_thumbnail('recent-news-big', get_the_title(), 'img-responsive'); ?>
										<div class="post-hover">
											<a class="link-icon" href="<?php the_permalink(); ?>"></a>
											<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
										</div>
									</div>
									<!-- /Post Image -->

									<!-- Post Content -->
									<div class="post-content">
										<ul class="post-meta">
											<li><?php _e('By', 'marine'); ?> <?php the_author(); ?></li>
											<li><?php echo ts_post_categories(get_the_ID()); ?></li>
										</ul>
										<h4><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h4>
										<?php echo ts_get_the_excerpt_theme(30); ?>
									</div>
									<!-- /Post Content -->
								</div>
							</div>
						</div>
					</div>
				<?php  endwhile; ?>
			</div>
		</section>		
	<?php endif;

    wp_reset_postdata();
    $html = ob_get_contents();
    ob_end_clean();
	return $html;
}