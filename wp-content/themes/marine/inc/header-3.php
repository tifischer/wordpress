<?php
/**
 * Header style 3 template
 *
 * @package marine
 * @since marine 1.0
 */
?>
<!-- Header -->
<header id="header" class="style4">

    <?php ts_show_preheader(); ?>
    <!-- Main Header -->
    <div id="main-header">

        <div class="container">

            <div class="row">

                <!-- Logo -->
                <div class="col-lg-12 col-md-12 col-sm-12 logo">

                    <?php ts_the_logo() ?>
					
                    <div id="main-nav-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- /Main Header -->



    <!-- Lower Header -->
    <div id="lower-header">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">


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
    <!-- /Lower Header -->



</header>
<!-- /Header -->