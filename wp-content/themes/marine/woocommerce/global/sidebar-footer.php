<?php
/**
 * The Sidebar containing the footer widget areas for WooCoomerce page
 *
 * @package marine
 * @since marine 1.0
 */
?>
<section class="section normal-padding shop-footer">			
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6">
			<?php dynamic_sidebar('shop-footer-area-1'); ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<?php dynamic_sidebar('shop-footer-area-2'); ?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<?php dynamic_sidebar('shop-footer-area-3'); ?>
		</div>
	</div>
</section>
