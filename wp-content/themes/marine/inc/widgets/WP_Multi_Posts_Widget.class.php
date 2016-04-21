<?php
/**
 * Popular posts widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Multi_Posts_Widget' );

function init_WP_Multi_Posts_Widget() {
	register_widget('WP_Multi_Posts_Widget');
}

class WP_Multi_Posts_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_multi_posts_entries', 'description' => __( "Displays tabs with most popular posts, recent posts and comments","framework" ) );
		parent::__construct('multi-posts', __( 'Multi Posts', "framework" ), $widget_ops);

		$this-> alt_option_name = 'widget_multi_posts_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $comment;

		$cache = wp_cache_get('widget_multi_posts_entries', 'widget');

		if ( !is_array($cache) )
		{
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) )
		{
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) )
		{
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);
		echo $before_widget;
		$rand = rand(15000,50000);
		?>
		<div class="tabs">

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
					$limit = 3;
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
					$limit = 3;
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
					$limit = 3;
					$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $limit, 'status' => 'approve', 'post_status' => 'publish' ) ) );
					$i = 0;
					if ( $comments ) { ?>
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

		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_multi_posts_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
		{
			delete_option('widget_recent_entries');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_multi_posts_entries', 'widget');
	}

	function form( $instance )
	{
		?>
		<p><?php _e('No options here','framework');?></p>
		<?php
	}
}