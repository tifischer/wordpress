<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Recent_Works_Slider_Widget' );

function init_WP_Recent_Works_Slider_Widget() {
	register_widget('WP_Recent_Works_Slider_Widget');
}

class WP_Recent_Works_Slider_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_mini_slider', 'description' => __( "Displays the most recent portfolio items.", "framework" ) );
		parent::__construct('recent-works-slider', __( 'Recent Works Slider', "framework" ), $widget_ops);

		$this-> alt_option_name = 'widget_recent_works_slider_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;

		$cache = wp_cache_get('widget_recent_works_slider_entries', 'widget');

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
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Popular Posts', "framework" ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
		{
			$number = 10;
		}

		$argsq = array(
			'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
			'offset' => 0,
			'post_type' => 'portfolio',
			'paged'=> 1,
			'orderby'=> 'date',
			'order' => 'DESC',
			'posts_per_page' => $number,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true
		);

		$r = new WP_Query( $argsq );
		if ($r->have_posts()) : ?>
			<?php echo $before_title.$title.$after_title;  ?>
			<div class="mini-slider">
				<div class="flexslider-nav style2">
					<a class="flexslider-prev"></a>
					<a class="flexslider-next"></a>
				</div>
				<div class="sc-flexslider-wrapper">
					<div class="flexslider one-col">
						<ul class="slides">
							<?php while ($r->have_posts()) : $r->the_post(); ?>
							<li>
								<a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php ts_the_resized_post_thumbnail('recent-works-slider-widget');?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_works_slider_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_works_slider_entries']) )
		{
			delete_option('widget_recent_works_slider_entries');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_recent_works_slider_entries', 'widget');
	}

	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', "framework" ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}