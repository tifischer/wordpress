<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Contact_Info_Widget' );

function init_WP_Contact_Info_Widget() {
	register_widget('WP_Contact_Info_Widget');
}

class WP_Contact_Info_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_contact_info', 'description' => __( "Displays contact info.", "framework" ) );
		parent::__construct('contact-info', __( 'Contact Info', "framework" ), $widget_ops);

		$this-> alt_option_name = 'widget_contact_info';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;

		$cache = wp_cache_get('widget_contact_info', 'widget');

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
		
		if (!empty($instance['title'])) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
			echo $before_title.$title.$after_title;  
		}
		?>
			
		<div class="contact-info">							
			<p>
				<?php if (!empty($instance['address'])): ?>
					<span class="light-blue"><?php _e('Address:', 'marine'); ?> </span><br>
					<?php echo nl2br( $instance['address'] ); ?><br/><br/>
				<?php endif; ?>
				
				<?php if (!empty($instance['phone'])): ?>
					<span class="light-blue"><?php _e('Phone:', 'marine'); ?> </span><br>
					<?php echo $instance['phone']; ?><br/><br/>
				<?php endif; ?>
					
				<?php if (!empty($instance['fax'])): ?>
					<span class="light-blue"><?php _e('Fax:', 'marine'); ?> </span><br>
					<?php echo $instance['fax']; ?><br/><br/>
				<?php endif; ?>
					
				<?php if (!empty($instance['email'])): ?>
					<span class="light-blue"><?php _e('E-mail:', 'marine'); ?> </span><br>
					<a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo $instance['email']; ?></a><br/><br/>
				<?php endif; ?>
			</p>
			<?php if ($instance['social_links'] == 1): ?>
				<?php get_template_part('inc/social-icons'); ?>
			<?php endif; ?>	
		</div>
		<?php echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_contact_info', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['social_links'] = (int) $new_instance['social_links'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_contact_info']) ) {
			delete_option('widget_contact_info');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_contact_info', 'widget');
	}

	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$fax = isset($instance['fax']) ? esc_attr($instance['fax']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$social_links = isset($instance['social_links']) && $instance['social_links'] == 1 ? 1 : '';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e( 'Address:', "framework" ); ?></label>
		<textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e( 'Phone:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e( 'Fax:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e( 'Email:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
		<p><input type="checkbox" id="<?php echo $this->get_field_id('social_links'); ?>" value="1" name="<?php echo $this->get_field_name('social_links'); ?>"<?php if($social_links == 1){ ?> checked="checked"<?php } ?>> <label for="<?php echo $this->get_field_id('social_links'); ?>"><?php _e('Show social links'); ?></label></p>	
		<?php
	}
}