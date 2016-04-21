<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="shop-we-recommend">

		<h4><?php _e( 'Related Products', 'woocommerce' ); ?></h4>

		<div class="shop-products-recommend">
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<div class="item">
					<a href="<?php the_permalink(); ?>"><?php echo woocommerce_get_product_thumbnail( 'shop_catalog'); ?></a>
					<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php
					global $product;
					$price_html = $product->get_price_html();
					if ( $price_html ) : ?>
						<span class="price"><?php echo $price_html; ?></span>
					<?php endif; ?>
				</div>
			<?php endwhile; // end of the loop. ?>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
