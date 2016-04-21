<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce, $embadded_video;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	

	$loop = 0;
	$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

	foreach ( $attachment_ids as $attachment_id ) {

		$classes = array( 'zoom' );

		if ( $loop == 0 || $loop % $columns == 0 )
			$classes[] = 'first';

		if ( ( $loop + 1 ) % $columns == 0 )
			$classes[] = 'last';

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
			continue;

		$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
		$image_class = esc_attr( implode( ' ', $classes ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );

		?>
		<li data-thumb="<?php echo $image_link; ?>">
			<?php echo $image; ?>
			<ul class="product-buttons">
				<li><a href="<?php echo $image_link; ?>" class="button" data-rel="prettyPhoto[product-gallery]"><?php _e('Zoom', 'marine'); ?> <i class="icons icon-plus"></i></a></li>
				
				<?php if ($embadded_video): ?>
					<li><a href="#video-layer" data-rel="prettyPhoto" class="button"><?php _e('Video', 'marine'); ?> <i class="icons icon-play"></i></a></li>
				<?php endif; ?>
				
			</ul>
		</li>
		<?php
		$loop++;
	}
}