<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $embadded_video;

$url = get_post_meta($post -> ID, 'video_url',true);

$embadded_video = '';
if (!empty($url)) {
	$embadded_video = ts_get_embaded_video($url);
} else if (empty($url)) {
	$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
}

?>
<div class="images">
	<div class="shop-product-slider flexslider">
		<?php woocommerce_show_product_sale_flash(); ?>
		<ul class="slides">
			<?php
			if ( has_post_thumbnail() ) {
				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}
				?>
				<li data-thumb="<?php echo $image_link; ?>">
					<?php echo $image; ?>
					<ul class="product-buttons">
						<li><a href="<?php echo $image_link; ?>" class="button" data-rel="prettyPhoto<?php echo $gallery; ?>"><?php _e('Zoom', 'marine')?> <i class="icons icon-plus"></i></a></li>
						<?php if ($embadded_video): ?>
							<li>
								<a href="#video-layer" class="button" data-rel="prettyPhoto"><?php _e('Video', 'marine')?> <i class="icons icon-play"></i></a>
								<div id="video-layer" class="hide">
									<?php echo $embadded_video; ?>
								</div>
							</li>
						<?php endif; ?>
					</ul>
				</li>
			<?php } //has_post_thumbnail ?>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</ul>
	</div>
</div>
