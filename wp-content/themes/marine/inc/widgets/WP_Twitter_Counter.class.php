<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */

add_action('widgets_init', 'init_WP_Twitter_Counter_Widget');

function init_WP_Twitter_Counter_Widget()
{
    register_widget('WP_Twitter_Counter_Widget');
}

class WP_Twitter_COunter_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname' => '_Twitter_Counter_media',
            'description' => __("Twitter + RSS", "framework"));
        parent::__construct('twitter-rss', __('Twitter + RSS', "framework"), $widget_ops);

        $this->alt_option_name = 'widget_twitter_counter_entries';

    }

    function widget($args, $instance)
    { 
		ob_start();
        extract($args);
        echo $before_widget;
        
        $ts_tweets = null;
        $ts_user_tweets = ts_get_recent_tweet(true);
        // print_r($ts_user_tweets);
        if (isset($ts_user_tweets['tweets'])) {
            $ts_tweets = $ts_user_tweets['tweets'];
            $ts_tweets_obj = json_decode($ts_tweets);
            foreach($ts_tweets_obj as $tweet){
                $follower_count  = $tweet->user->followers_count;
            }
        }

?>
        <div class="social">
            <div class="social-item">
                <a href="<?php echo ts_get_twitter_username();?>">
                    <img alt="" src="<?php echo get_stylesheet_directory_uri();?>/img/twitter.png">
                    <span><span class="bold"><?php echo $follower_count;?></span><br><?php _e('Followers','marine');?></span>
                </a>
            </div>
            <div class="social-item">
                <a href="<?php bloginfo('rss_url'); ?>">
                    <img alt="" src="<?php echo get_stylesheet_directory_uri();?>/img/rss.png">
                    <span><span class="bold"><?php _e('Subscribe', 'marine'); ?></span><br><?php _e('to RSS Feed', 'marine'); ?></span>
                </a>
            </div>
        </div>

<?php


        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {

    }



    function form($instance)
    {
		?>
		<p><?php _e('No options here','framework');?></p>
		<?php
    }
}