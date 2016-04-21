<?php
/**
 * Header style 12 template
 *
 * @package marine
 * @since marine 1.0
 */
?>
<!-- Header -->
<!-- Header -->
<header id="header" class="style9">
	<?php ts_show_preheader(); ?>
	<div id="main-header">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-4 col-sm-4 logo">
					<?php ts_the_logo() ?>
					<div id="main-nav-button">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>

				<div class="col-lg-8 col-md-8 col-sm-8 align-right">

					<div class="navigation-style2">

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

					<div id="nav-button">
						<span></span>
						<span></span>
						<span></span>
					</div>

				</div>

			</div>
		</div>
	</div>

</header>

<!-- Sticky Header Hover Button -->
<div id="sticky-header-hover-button">
	<div class="container">
		<div class="button-content">
			<div class="menuicon">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
</div>
<!-- /Sticky Header Hover Button -->