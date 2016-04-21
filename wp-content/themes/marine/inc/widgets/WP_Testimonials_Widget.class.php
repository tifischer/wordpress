<?php
/**
 * Testimonials widget class
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Testimonials_Widget' );

function init_WP_Testimonials_Widget() {
	register_widget('WP_Testimonials_Widget');
}

class WP_Testimonials_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_testimonials', 'description' => __( 'Displays testimonial by ID', 'marine' ) );
		parent::__construct('testimonials-widget', __('Testimonials', 'marine'), $widget_ops);
		$this->alt_option_name = 'widget_testimonials';
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_testimonials', 'widget');
	}

	function widget( $args, $instance ) {
	
		$cache = wp_cache_get('widget_testimonials', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		ob_start();
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$testimonial_id = !empty($instance['testimonial_id']) ? $instance['testimonial_id'] : null;
		
		$r = new WP_Query( array(
			'p' => $testimonial_id,
			'post_type' => 'testimonial',
			'posts_per_page' => 1
		) );
		if ($r->have_posts()) : ?>
			<?php 
			if ($title):
				echo $before_title.$title.$after_title;
			endif;
			?>
			<?php if ($r->have_posts()) : ?>
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
					<div class="testimonial">
						<div class="testimonial-header">
							<div class="testimonial-image">
								<?php echo ts_get_resized_post_thumbnail(get_the_ID(),'testimonials-widget',get_the_title(),'img-responsive');?>
							</div>
							<div class="testimonial-meta">
								<span class="testimonial-author"><?php the_title(); ?></span>
								<span class="testimonial-job"><?php echo get_post_meta($testimonial_id, 'position', true); ?>, <?php echo get_post_meta($testimonial_id, 'company', true); ?></span>
							</div>
						</div>
						<blockquote class="testimonial-quote"><?php echo get_post_meta($testimonial_id, 'quote', true); ?></blockquote>
						<div class="testimonial-desc">
							<?php
							$content = get_the_content();
							$content = apply_filters( 'the_content', $content );
							$content = str_replace( ']]>', ']]&gt;', $content );
							echo $content;
							?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_testimonials', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['testimonial_id'] = strip_tags($new_instance['testimonial_id']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_testimonials']) )
			delete_option('widget_testimonials');

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$testimonial_id  = isset( $instance['testimonial_id'] ) ? esc_attr( $instance['testimonial_id'] ) : ''; 
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'testimonial_id' ); ?>"><?php _e( 'Testimonial ID:', 'marine' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'testimonial_id' ); ?>" name="<?php echo $this->get_field_name( 'testimonial_id' ); ?>" type="text" value="<?php echo $testimonial_id; ?>" /></p>
	<?php
	}
}
