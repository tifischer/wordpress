<?php
/**
 * Header-9 side menu template
 *
 * @package marine
 * @since marine 1.0
 */
?>
<!-- Header -->
<!-- SIDEMENU -->
<aside id="sidemenu" class="dark">

	<div id="sidemenu-button">
		<div><span></span><span></span><span></span></div>
		<span><?php _e('Menu', 'marine'); ?></span>
	</div>

	<div id="sidemenu-wrapper">

		<div class="logo">
			<?php ts_the_logo() ?>
		</div>

		<div id="main-nav-button">
			<span></span>
			<span></span>
			<span></span>
		</div>
		
		<!-- Main Navigation -->
		<?php wp_nav_menu(array(
			'theme_location'	=> 'primary',
			'container'			=> 'nav',
			'container_id'		=> 'side-nav',
			'menu_id'			=> 'side-nav-menu',
			'depth'				=> 3,
			'walker'			=> has_nav_menu('primary') ? new ts_walker_nav_menu : null
		));?>
		<!-- /Main Navigation -->
				
		<?php
		$ts_tweets = null;
		$ts_user_tweets = ts_get_recent_tweet(true);

		if (isset($ts_user_tweets['tweets'])):
			$ts_tweets = $ts_user_tweets['tweets'];
			$ts_tweets_obj = json_decode($ts_tweets);

			?>
			<div class="sidemenu-tweets">	
				<?php 
				if (is_array($ts_tweets_obj) && count($ts_tweets_obj) > 0):
					
					$tweet = array_shift($ts_tweets_obj);
					if (is_object($tweet)):
						$tweet_text = ts_replace_in_tweets($tweet); ?>
						<div class="icon"><i class="icons icon-twitter"></i></div>
						<p><?php echo $tweet_text; ?></p>
						<span class="date"><?php echo ts_twitter_time($tweet -> created_at); ?></span>
					<?php endif;
				else: ?>
					<?php _e('No Tweets to show', 'marine'); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="sidemenu-footer">
			<?php get_template_part('inc/social-icons'); ?>
			<p class="copyright"><?php echo ot_get_option('footer_text'); ?></p>
		</div>
	</div>

</aside>
<!-- /SIDEMENU -->