<?php
/**
 * The Footer for our theme.
 *
 * @package marine
 * @since marine 1.0
 */

$show_shop_footer = get_post_meta($post->ID,'show_shop_footer',true);

if(empty($show_shop_footer)){
    $show_shop_footer = ot_get_option('show_shop_footer');
}
if($show_shop_footer == 'yes'):
?>
	<!-- Shop footer -->
	<section class="section normal-padding">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'shop-footer-area-1' ); ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar( 'shop-footer-area-2' ); ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?php dynamic_sidebar( 'shop-footer-area-3' ); ?>
			</div>
		</div>
	</section>
	<!-- /Shop footer -->
<?php endif;?>
</div>
<!-- /Container -->
</section>
<!-- /Main Content -->


</div>
<!-- /Marine Conten Inner -->




<!-- Footer -->
<?php
$footer_class = null;
$footer_style = 1;
if (is_page() && get_post_meta($post -> ID, 'footer_style', true) == 'alternative' || ot_get_option('footer_style') == 'alternative'):
	$footer_style = 2;
	$footer_class = 'footer-2';
endif;

?>
<footer id="footer" <?php echo !empty($footer_class) ? 'class="'.$footer_class.'"' : ''; ?>>
    <?php
    $xs_show_twitter = get_post_meta($post->ID, 'show_recent_tweet_footer', true);
	if (empty($xs_show_twitter) || $xs_show_twitter == 'default'):
		$xs_show_twitter =  ot_get_option('show_recent_tweet_footer');
	endif;
	
	if ($xs_show_twitter == 'yes'):
        ?>
        <!-- Upper Footer -->
        <div id="upper-footer" class="blue-bg">

            <div class="container">


                <!-- Latest Tweets -->
                <div class="latest-tweets">

                    <div class="tweet-icon">

                        <img src="<?php echo get_template_directory_uri(); ?>/img/tweets-icon.png" alt="">

                    </div>

                    <div class="tweet-carousel">
                        <?php
                        $ts_tweets = null;
                        $ts_user_tweets = ts_get_recent_tweet(true);
                       
                        if (isset($ts_user_tweets['tweets'])) {
                            $ts_tweets = $ts_user_tweets['tweets'];
							$ts_tweets_obj = json_decode($ts_tweets);
                           
                            ?>
                            <div class="flexslider tweets-flexslider">
                                <ul class="slides">
                                    <?php 
									if (is_array($ts_tweets_obj) && count($ts_tweets_obj) > 0): ?>
                                        <?php foreach ($ts_tweets_obj as $tweet): 
											
											$tweet_text = ts_replace_in_tweets($tweet); ?>
                                            <li>
												<div class="tweet-wrapper">
												<div class="tweet-wrapper-inner">
												
                                                <p class="tweet-content"><a href="https://twitter.com/<?php  echo ts_get_twitter_username();?>">@<?php echo ts_get_twitter_username(); ?></a> <?php echo $tweet_text; ?> <a
                                                        href="https://twitter.com/<?php  echo ts_get_twitter_username();?>">by
                                                        <?php echo $tweet->user->name;?></a></p>
												<span class="tweet-date">
													<?php echo date(get_option('date_format'), strtotime($tweet->created_at)); ?>
												</span>
												
												</div>
												</div>
                                            </li>
                                        <?php endforeach;
                                    else: ?>

                                        <?php _e('No Tweets to show', 'marine'); ?>

                                    <?php endif; ?>


                                </ul>

                                <div class="tweet-slider-arrows">
                                    <i class="arrow-left icons icon-angle-left"></i>
                                    <i class="arrow-right icons icon-angle-right"></i>
                                </div>

                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
                <!-- /Latest Tweets -->

            </div>

        </div>
        <!-- /Upper Footer -->
    <?php endif; ?>

   
	<!-- Main Footer -->
	<?php if ($footer_style == 2): ?>		
		<div id="main-footer" class="smallest-padding">
				
			<div class="container">

				<div class="row">
					
					<?php get_sidebar('footer-2'); ?>

				</div>

			</div>

		</div>
	
	<?php else: //$footer_style = 1 ?>
		<div id="main-footer" class="smallest-padding">
			<div class="container">
				<div class="row">

					<?php get_sidebar('footer'); ?>

				</div>
			</div>
		</div>
	
	<?php endif; ?>
	<!-- /Main Footer -->
    
    <!-- Lower Footer -->
    <div id="lower-footer">
        <div class="container">
            <span class="copyright"><?php echo ot_get_option('footer_text'); ?></span>
        </div>
    </div>
    <!-- /Lower Footer -->
	
</footer>
<!-- /Footer -->


</div>
<!-- /Marine Conten Wrapper -->



<div id="back-to-top">
	<a href="#"></a>
</div>



<?php echo ot_get_option('scripts_footer'); ?>
<div class="media_for_js"></div>
<?php wp_footer(); ?>

<?php $preloader = ot_get_option('preloader'); 
if ($preloader != 'disabled' && !empty($preloader)): ?>
	<div class="page-loadingstage">
		<div>
			<div>
				<?php
				switch ($preloader):
					case 1: ?>
						<div class="spinner style1"></div> 
						<?php break;
					case 2: ?>
						<div class="spinner style2">
							<div class="double-bounce1"></div>
							<div class="double-bounce2"></div>
						</div>
						<?php break;

					case 3: ?>
						<div class="spinner style3">
							<div class="rect1"></div>
							<div class="rect2"></div>
							<div class="rect3"></div>
							<div class="rect4"></div>
							<div class="rect5"></div>
						</div>
						<?php break;

					case 4: ?>
						<div class="spinner style4">
							<div class="cube1"></div>
							<div class="cube2"></div>
						</div>
						<?php break;

					case 5: ?>
						<div class="spinner style5"></div>
						<?php break;

					case 6: ?>
						<div class="spinner style6">
							<div class="dot1"></div>
							<div class="dot2"></div>
						</div>
						<?php break;

					case 7: ?>
						<div class="spinner style7">
							<div class="bounce1"></div>
							<div class="bounce2"></div>
							<div class="bounce3"></div>
					  </div>
						<?php break;

					case 8: ?>
						<div class="spinner style8">
							<div class="spinner-container container1">
								  <div class="circle1"></div>
								  <div class="circle2"></div>
								  <div class="circle3"></div>
								  <div class="circle4"></div>
							  </div>
							  <div class="spinner-container container2">
								  <div class="circle1"></div>
								  <div class="circle2"></div>
								  <div class="circle3"></div>
								  <div class="circle4"></div>
							  </div>
							  <div class="spinner-container container3">
								  <div class="circle1"></div>
								  <div class="circle2"></div>
								  <div class="circle3"></div>
								  <div class="circle4"></div>
							  </div>
						  </div>
						<?php break;
				endswitch;
				?>
			</div>
		</div>
	</div>
<?php endif; ?>
</body>
</html>