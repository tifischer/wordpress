<?php
/**
 * Header style 2 template
 *
 * @package marine
 * @since marine 1.0
 */
?>
<!-- Header -->
<header id="header" class="style3">

	<?php ts_show_preheader(); ?>

    <!-- Main Header -->
    <div id="main-header">

        <div class="container">

            <div class="row">

                <!-- Logo -->
                <div class="col-lg-4 col-md-4 col-sm-4 logo">
                    <?php ts_the_logo() ?>
					
                    <div id="main-nav-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>

				<div class="col-sm-8 align-right">
					<!-- Text List -->
					<ul class="text-list">
						<li><?php echo ot_get_option('header_text'); ?></li>
					</ul>

					<!-- Social Media -->
					<?php get_template_part('inc/social-icons');?>
				</div>

            </div>

        </div>

    </div>
    <!-- /Main Header -->


    <!-- Lower Header -->
    <div id="lower-header">

        <div class="container">

            <div class="row">

                <div class="col-lg-10 col-md-10 col-sm-10">
					
					<div class="lower-logo">
						<?php ts_the_logo() ?>
					</div>

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

                <div class="col-lg-2 col-md-2 col-sm-2">
					<?php if (ot_get_option('show_search_nav') != 'no'): ?>
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
					<?php endif; ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /Lower Header -->


</header>
<!-- /Header -->