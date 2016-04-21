<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */

add_action('widgets_init', 'init_WP_Social_Media_Widget');

function init_WP_Social_Media_Widget()
{
    register_widget('WP_Social_Media_Widget');
}

class WP_Social_Media_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'widget_social_media',
            'description' => __("Social Media Icons", "framework"));
        parent::__construct('social-media', __('Social Media Icons', "framework"), $widget_ops);

        $this->alt_option_name = 'widget_social_media_entries';

    }

    function widget($args, $instance)
    {
        global $post;

        ob_start();
        extract($args);
        echo $before_widget;
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        echo '<h4>'.$title.'</h4>';
?>

        <ul class="social-media">

        <?php if($instance['fb_icons'] !='' ):?><li class="tooltip-ontop" title="Facebook"><a href="<?php echo  esc_attr($instance['fb_icons']);?>"><i class="icon-facebook"></i></a></li><?php endif;?>
        <?php if($instance['tw_icons'] !='' ):?><li class="tooltip-ontop" title="Twitter"><a href="<?php echo  esc_attr($instance['tw_icons']);?>"><i class="icon-twitter"></i></a></li><?php endif;?>
        <?php if($instance['sk_icons'] !='' ):?><li class="tooltip-ontop" title="Skype"><a href="<?php echo  esc_attr($instance['sk_icons']);?>"><i class="icon-skype"></i></a></li>      <?php endif;?>
        <?php if($instance['gp_icons'] !='' ):?><li class="tooltip-ontop" title="Google Plus"><a href="<?php echo  esc_attr($instance['gp_icons']);?>"><i class="icon-google"></i></a></li>   <?php endif;?>
        <?php if($instance['vi_icons'] !='' ):?><li class="tooltip-ontop" title="Vimeo"><a href="<?php echo  esc_attr($instance['vi_icons']);?>"><i class="icon-vimeo"></i></a></li>    <?php endif;?>
        <?php if($instance['in_icons'] !='' ):?><li class="tooltip-ontop" title="Linkedin"><a href="<?php echo  esc_attr($instance['in_icons']);?>"><i class="icon-linkedin"></i></a></li>  <?php endif;?>
        <?php if($instance['ig_icons'] !='' ):?><li class="tooltip-ontop" title="Instagram"><a href="<?php echo  esc_attr($instance['ig_icons']);?>"><i class="icon-instagram"></i></a></li>  <?php endif;?>

                    </ul>
<?php


        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['fb_icons'] = $new_instance['fb_icons'];
        $instance['tw_icons'] = $new_instance['tw_icons'];
        $instance['sk_icons'] = $new_instance['sk_icons'];
        $instance['gp_icons'] = $new_instance['gp_icons'];
        $instance['vi_icons'] = $new_instance['vi_icons'];
        $instance['in_icons'] = $new_instance['in_icons'];
        $instance['ig_icons'] = $new_instance['ig_icons'];
        return $new_instance;
    }



    function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $fb_icons = isset($instance['fb_icons']) ? esc_attr($instance['fb_icons']) : '';
        $tw_icons = isset($instance['tw_icons']) ? esc_attr($instance['tw_icons']) : '';
        $sk_icons = isset($instance['sk_icons']) ? esc_attr($instance['sk_icons']) : '';
        $gp_icons = isset($instance['gp_icons']) ? esc_attr($instance['gp_icons']) : '';
        $vi_icons = isset($instance['vi_icons']) ? esc_attr($instance['vi_icons']) : '';
        $in_icons = isset($instance['in_icons']) ? esc_attr($instance['in_icons']) : '';
        $ig_icons = isset($instance['ig_icons']) ? esc_attr($instance['ig_icons']) : '';


        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo $title; ?>"/></p>

        <p><label for="<?php echo $this->get_field_id('fb_icons'); ?>"><?php _e('Facebook:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('fb_icons'); ?>" name="<?php echo $this->get_field_name('fb_icons'); ?>" type="text" value="<?php echo $fb_icons; ?>"
                   size="3"/></p>


        <p><label for="<?php echo $this->get_field_id('tw_icons'); ?>"><?php _e('Twitter:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('tw_icons'); ?>" name="<?php echo $this->get_field_name('tw_icons'); ?>" type="text" value="<?php echo $tw_icons; ?>"
                   size="3"/></p>

        <p><label for="<?php echo $this->get_field_id('sk_icons'); ?>"><?php _e('Skype:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sk_icons'); ?>" name="<?php echo $this->get_field_name('sk_icons'); ?>" type="text" value="<?php echo $sk_icons; ?>"
                   size="3"/></p>

        <p><label for="<?php echo $this->get_field_id('gp_icons'); ?>"><?php _e('Google+:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('gp_icons'); ?>" name="<?php echo $this->get_field_name('gp_icons'); ?>" type="text" value="<?php echo $gp_icons; ?>"
                   size="3"/></p>

        <p><label for="<?php echo $this->get_field_id('vi_icons'); ?>"><?php _e('Vimeo:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('vi_icons'); ?>" name="<?php echo $this->get_field_name('vi_icons'); ?>" type="text" value="<?php echo $vi_icons; ?>"
                   size="3"/></p>

        <p><label for="<?php echo $this->get_field_id('in_icons'); ?>"><?php _e('Linkdin:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('in_icons'); ?>" name="<?php echo $this->get_field_name('in_icons'); ?>" type="text" value="<?php echo $in_icons; ?>"
                   size="3"/></p>

        <p><label for="<?php echo $this->get_field_id('ig_icons'); ?>"><?php _e('Instagram:', "framework"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('ig_icons'); ?>" name="<?php echo $this->get_field_name('ig_icons'); ?>" type="text" value="<?php echo $ig_icons; ?>"
                   size="3"/></p>
    <?php
    }
}