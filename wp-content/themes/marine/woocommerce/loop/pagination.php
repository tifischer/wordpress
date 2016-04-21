<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;

if (is_shop()):
	$url = ts_get_theme_next_page_url();
	if (!empty($url)): ?>
		<div class="row shop-pagination">	
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="align-center">
					<a href="<?php echo $url; ?>" id="wc-load-more" class="load-more-button button unfilled black"><?php _e('Load More','marine');?> <i class="icons icon-spin3"></i></a>
				</div>
			</div>
		</div>
	<?php endif;
endif; ?>



