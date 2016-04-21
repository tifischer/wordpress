<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Recent_Works_Widget' );

function init_WP_Recent_Works_Widget() {
	register_widget('WP_Recent_Works_Widget');
}
 
class WP_Recent_Works_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_recent_works', 'description' => __( "Displays the most recent portfolio items.", "framework" ) );
		parent::__construct('recent-works', __( 'Recent Works', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_recent_works_entries';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_recent_works_entries', 'widget');
		
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
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
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
			<ul>
				<?php while ($r->have_posts()) : $r->the_post(); ?>
					<li>
						<a href="<?php the_permalink() ?>"><?php ts_the_resized_post_thumbnail('recent-works-widget');?> <div class="cloud"><?php echo ts_get_shortened_string(get_the_title(),5); ?><div class="helper"></div></div></a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_works_entries', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_works_entries']) )
		{
			delete_option('widget_recent_works_entries');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_recent_works_entries', 'widget');
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