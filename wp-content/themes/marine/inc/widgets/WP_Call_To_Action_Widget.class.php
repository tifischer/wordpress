<?php
/**
 * Call To Action widget class
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Call_To_Action_Widget' );

function init_WP_Call_To_Action_Widget() {
	register_widget('WP_Call_To_Action_Widget');
}

class WP_Call_To_Action_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_call_to_action', 'description' => __( 'Title with button widget', 'marine' ) );
		parent::__construct('call-to-action-widget', __('Call To Action', 'marine'), $widget_ops);
		$this->alt_option_name = 'widget_call_to_action';
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_call_to_action', 'widget');
	}

	function widget( $args, $instance ) {
	
		$cache = wp_cache_get('widget_call_to_action', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		
		echo $before_widget;
		echo $before_title . $title . $after_title;

		?>
		<div class="info-box">
			<h2><?php echo $instance['line1']; ?></h2>
			<h4><?php echo $instance['line2']; ?></h4>
			<a href="<?php echo esc_attr($instance['url']); ?>" target="<?php echo esc_attr($instance['target']); ?>" class="button"><?php echo $instance['button']; ?></a>
		</div>
		<?php 		
		echo $after_widget;

		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_call_to_action', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['line1'] = strip_tags($new_instance['line1']);
		$instance['line2'] = strip_tags($new_instance['line2']);
		$instance['button'] = strip_tags($new_instance['button']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['target'] = strip_tags($new_instance['target']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_call_to_action']) )
			delete_option('widget_call_to_action');

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$line1  = isset( $instance['line1'] ) ? esc_attr( $instance['line1'] ) : '';
		$line2  = isset( $instance['line2'] ) ? esc_attr( $instance['line2'] ) : '';
		$button  = isset( $instance['button'] ) ? esc_attr( $instance['button'] ) : '';
		$url  = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '';
		$target  = isset( $instance['target'] ) ? esc_attr( $instance['target'] ) : ''; ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'line1' ); ?>"><?php _e( 'Line 1:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'line1' ); ?>" name="<?php echo $this->get_field_name( 'line1' ); ?>" type="text" value="<?php echo $line1; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'line2' ); ?>"><?php _e( 'Line 2:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'line2' ); ?>" name="<?php echo $this->get_field_name( 'line2' ); ?>" type="text" value="<?php echo $line2; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button text:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo $button; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'marine' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>">
			<option value="_self" <?php selected($target,'_self'); ?>>_self</option>
			<option value="_blank" <?php selected($target,'_blank'); ?>>_blank</option>
			<option value="_top" <?php selected($target,'_top'); ?>>_top</option>
			<option value="_parent" <?php selected($target,'_parent'); ?>>_parent</option>
		</select>
<?php
	}
}
