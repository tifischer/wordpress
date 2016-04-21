<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		
		if (is_shop()) {
			remove_filter('woocommerce_before_main_content','woocommerce_breadcrumb',20);
		}
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>
		
		<?php if (is_shop()) :
			do_action( 'woocommerce_archive_description' ); ?>
		
			<?php if ( have_posts() ) : ?>
				<div class="shop-main-padding">
					<?php
						$args = array(
							'taxonomy'     => 'product_cat',
							'orderby'      => 'name',
							'hierarchical' => 1,
							'hide_empty'   => 1
						);
						$all_categories = get_categories( $args );

					if (is_array($all_categories) && count($all_categories) > 0): ?>
						<div class="shop-filters">
							<span class="filter" data-filter="all"><?php _e('All', 'marine');?></span>
							<?php foreach ($all_categories as $cat): ?>
								<span class="filter" data-filter=".product-cat-<?php echo $cat -> slug; ?>"><?php echo $cat -> name; ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<div id="sortable-shop-products" class="row">

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					</div>
					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>
				</div>
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif;
			
		else: ?>
			
			<?php if ( have_posts() ) : ?>
				
				
			
				<div class="row">

					<!-- Content -->
					<section class="main-content col-lg-9 col-md-9 col-sm-8 small-padding">

						<!-- Shop Options -->
						<div class="shop-options">
							
							<?php
							woocommerce_catalog_ordering();
							woocommerce_result_count();
							
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>
						<!-- /Shop Options -->

						<!-- Shop Products -->
						<div class="row">	
							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						</div>
						<!-- /Shop Products -->
						
						<!-- Shop Options -->
						<div class="shop-options">
							
							<?php
							woocommerce_result_count();
							woocommerce_catalog_ordering();
							
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
						</div>
						<!-- /Shop Options -->
						
					</section>
					<!-- /Content -->

					<?php get_sidebar('woocomerce'); ?>
					
				</div>
			
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		<?php endif; ?>
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

	<?php get_footer( 'shop' ); ?>