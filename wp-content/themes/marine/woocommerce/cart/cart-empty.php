<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="info-box">
	<h4 class="bold"><?php _e( 'UNFORTUNATELY, YOUR SHOPPING BAG IS EMPTY', 'woocommerce' ) ?></h4>
	<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	<a href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="button unfilled black"><?php _e( 'Back to store', 'woocommerce' ) ?></a>
</div>

<?php 
$shop_page   = get_post( wc_get_page_id( 'shop' ) );
if ( $shop_page ) {
	echo apply_filters( 'the_content', $shop_page->post_content );
}
?>

<?php
	/**
	 * woocommerce_after_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php 
ts_woocommerce_recently_viewed();
wc_get_template( 'global/sidebar-footer.php' );
?>