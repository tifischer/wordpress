<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package liva
 * @since liva 1.0
 */

get_header(); ?>
<!-- Main Content -->
<section id="main-content">


	<!-- Container -->
	<div class="container">

		<!-- 404 Section -->
		<section class="section error404-section">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<h1><?php _e('404', 'marine'); ?></h1>
					<h2><?php _e('Oops, This page couldn\'t be found!', 'marine'); ?></h2>
					<a href="#" class="button blue big"><i class="icons icon-home"></i> <?php _e('Go back home', 'marine'); ?></a>
				</div>
			</div>
		</section>
		<!-- 404 Section -->

		<!-- New Section -->
		<section class="section normal-padding">

			<div class="row">

				<div class="col-lg-6 col-md-6 col-sm-6">
					
					<?php echo do_shortcode(ot_get_option('404_content')); ?>
					
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6">

					<h3><?php _e('Search Our Website', 'marine'); ?></h3>
					<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
						<p><?php _e("Can't find what you need? Take a moment and do a search below!", 'marine'); ?></p>
						<div class="iconic-submit">
							<input type="text" name="s">
							<input type="submit" value="">
							<i class="icons icon-search"></i>
						</div>
					</form>

				</div>

			</div>

		</section>
		<!-- /New Section -->



	</div>
	<!-- / Container -->


</section>
<!-- /Main Content -->

<?php get_footer(); ?>