<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;

$next_url = ts_get_theme_next_page_url();
$prev_url = ts_get_theme_prev_page_url();
?>

<form class="woocommerce-ordering" method="get">
	<label><?php _e('Sort by', 'marine'); ?></label>
	<select name="orderby" class="orderby">
		<?php
			$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by newness', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
				unset( $catalog_orderby['rating'] );

			foreach ( $catalog_orderby as $id => $name )
				echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
		?>
	</select>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key )
				continue;
			
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
	<ul>
		<?php if (!empty($prev_url)): ?>
			<li><a href="<?php echo $prev_url; ?>"><?php _e('Previous', 'marine'); ?></a></li>
		<?php endif; ?>
		
		<li><?php 
		$paged = get_query_var( 'paged' );
		if (!$paged):
			$paged = 1;
		endif;
		
		echo sprintf(__('View Page %d of %d', 'marine'), $paged, $wp_query->max_num_pages); ?></li>
		
		<?php if (!empty($next_url)): ?>
			<li><a href="<?php echo $next_url; ?>"><?php _e('Next', 'marine'); ?></a></li>
		<?php endif; ?>
		
	</ul>
</form>