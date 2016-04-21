<?php
/**
 * Shortcode Title: Multi Posts
 * Shortcode: multi_posts
 * Usage: [multi_posts animation="" limit="2"]
 */
add_shortcode('multi_posts', 'ts_multi_posts_func');

function ts_multi_posts_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'limit' => 2,
		'animation' => ''
		),
	$atts));

	if (!intval($limit)) {
		$limit = 2;
	}
	ob_start();
	?>
	<div class="tabs <?php echo ts_get_animation_class($animation); ?>">

		<div class="tab-header">
			<ul>
				<li><a href="#tab1"><?php _e('Popular', 'marine'); ?></a></li>
				<li><a href="#tab2"><?php _e('Recent', 'marine'); ?></a></li>
				<li><a href="#tab3"><?php _e('Comments', 'marine'); ?></a></li>
			</ul>
		</div>

		<div class="tab-content">
			<div id="tab1" class="tab">
				<?php
				$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'comment_count DESC', 'posts_per_page' => $limit, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
				if ($r->have_posts()) : ?>
					<ul class="posts-list">
						<?php  while ($r->have_posts()) : $r->the_post(); ?>
							<li class="post-item">
								<div class="featured-image">
									<?php ts_the_resized_post_thumbnail('multipost-widget',get_the_title()); ?>
								</div>
								<div class="post-content">
									<ul class="post-meta">
										<li><?php the_time('M d, Y'); ?></li>
										<li><?php _e('BY', 'marine'); ?> <?php the_author(); ?></li>
									</ul>
									<a class="post-title" href="<?php echo esc_attr(get_the_title());?>"><?php the_title(); ?></a>
									<p><?php ts_the_excerpt_theme(5); ?></p>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php
					wp_reset_postdata();
				endif; //have_posts()
				?>
			</div>

			<div id="tab2" class="tab">
				<?php
				$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $limit, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true  ) ) );
				if ($r->have_posts()) : ?>
					<ul class="posts-list">
						<?php  while ($r->have_posts()) : $r->the_post(); ?>
							<li class="post-item">
								<div class="featured-image">
									<?php ts_the_resized_post_thumbnail('multipost-widget',get_the_title()); ?>
								</div>
								<div class="post-content">
									<ul class="post-meta">
										<li><?php the_time('M d, Y'); ?></li>
										<li><?php _e('BY', 'marine'); ?> <?php the_author(); ?></li>
									</ul>
									<a class="post-title" href="<?php echo esc_attr(get_the_title());?>"><?php the_title(); ?></a>
									<p><?php ts_the_excerpt_theme(5); ?></p>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php
					wp_reset_postdata();
				endif; //have_posts()
				?>
			</div>

			<div id="tab3" class="tab">
				<?php
				$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $limit, 'status' => 'approve', 'post_status' => 'publish' ) ) );
				$i = 0;
				if ( $comments ) { 
					?>
					<ul class="posts-list">
						<?php foreach ( (array) $comments as $comment) { ?>
							<li class="post-item">
								<div class="featured-image">
									<?php echo ts_get_resized_post_thumbnail($comment -> comment_post_ID,'multipost-widget', get_the_title($comment -> comment_post_ID)); ?>
								</div>
								<div class="post-content">
									<ul class="post-meta">
										<li><?php echo get_comment_date('M d, Y', $comment->comment_ID); ?></li>
										<li><?php _e('BY', 'marine'); ?> <?php echo $comment -> comment_author; ?></li>
									</ul>
									<a class="post-title" href='<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>'><?php echo get_the_title($comment -> comment_post_ID); ?> </a>
									<p><?php echo ts_get_shortened_string($comment->comment_content,5); ?></p>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- /Tabs -->
	<?php
	$html =  ob_get_contents();

    ob_end_clean();
    return $html;
}