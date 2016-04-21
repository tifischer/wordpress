<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

if (is_shop()):
	$classes[] = 'col-lg-3 col-md-4 col-sm-6 col-xs-12 mix';
else:
	$classes[] = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
endif;


?>

<div <?php post_class( $classes ); ?>>
							
	<!-- Shop Product -->
	<div class="shop-product">
		<div class="featured-image">
			<?php 
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			
			<div class="product-buttons">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				<a href="<?php the_permalink(); ?>" class="button details-button"><?php _e('Details', 'marine'); ?></a>
			</div>
		</div>
		<div class="product-info">
			<span>
				<?php 
				woocommerce_template_loop_price(); ?>
				<span class="product-title"><?php the_title(); ?></span>
				<?php woocommerce_template_loop_rating();
				
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				//do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</span>
		</div>
	</div>
	<!-- /Shop Product -->

</div>