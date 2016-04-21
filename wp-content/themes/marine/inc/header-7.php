<?php
/**
 * Header style 8 template
 *
 * @package marine
 * @since marine 1.0
 */
?>
<!-- Header -->
<header id="header" class="style8">
	<?php ts_show_preheader(); ?>
	<!-- Main Header -->
	<div id="main-header">

		<div class="container">

			<div class="row">

				<!-- Logo -->
				<div class="col-lg-3 col-md-3 col-sm-3 logo">

					<?php ts_the_logo() ?>

					<div id="main-nav-button">
						<span></span>
						<span></span>
						<span></span>
					</div>

				</div>


				<div class="col-lg-9 col-md-9 col-sm-9 align-right">
					
					
					<!-- Search Box -->
					<div id="search-box" class="align-right">
						
						<i class="icons icon-search"></i>
						<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
							<input type="text" name="s" placeholder="<?php _e('Search here..', 'marine'); ?>">
							<div class="iconic-submit">
								<div class="icon">
									<i class="icons icon-search"></i>
								</div>
								<input type="submit" value="">
							</div>
						</form>

					</div>
					<!-- /Search Box -->
					
					<!-- Main Navigation -->
                    <?php wp_nav_menu(array(
                        'theme_location'	=> 'primary',
                        'container'			=> false,
                        'menu_id'			=> 'main-nav',
                        'depth'				=> 4,
						'walker'			=> has_nav_menu('primary') ? new ts_walker_nav_menu : null
                    ));?>
                    <!-- /Main Navigation -->

				</div>


			</div>

		</div>

	</div>
	<!-- /Main Header -->
</header>