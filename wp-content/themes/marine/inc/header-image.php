<?php
/**
 * Header image/slider
 *
 * @package marine
 * @since marine 1.0
 */

$slider = null;

if (is_tax('product_cat')) {
	$slider_id = null;
	$term_meta = get_option('taxonomy_'.get_queried_object()->term_id.'_metas');
	
	if (isset($term_meta['slider']) && !empty($term_meta['slider'])) {
		$slider = ts_get_post_slider(null,$term_meta['slider']);
	}
} else if (function_exists('is_woocommerce') && is_woocommerce()) {
	$slider_id = get_post_meta(wc_get_page_id( 'shop' ), 'post_slider', true);
	if ($slider_id) {
		$slider = ts_get_post_slider(wc_get_page_id( 'shop' ));
	}
	
} else if (is_home() || is_page() || is_single()) {	
	$slider = null;
	$slider_id = get_post_meta(get_the_ID(), 'post_slider', true);
	if ($slider_id) {
		$slider = ts_get_post_slider(get_the_ID());
	}
}

if (!empty($slider)): ?>
	</div>
	<section id="slider">
		<div class="container">
			<?php echo $slider; ?>
			<script>
				/* Fix The Revolution Slider Loading Height issue */
				jQuery(document).ready(function($){
					$('.rev_slider_wrapper').each(function(){
						$(this).css('height','');
						var revStartHeight = parseInt($('>.rev_slider', this).css('height'));
						$(this).height(revStartHeight);
						$(this).parents('#slider').height(revStartHeight);
						
						$(window).load(function(){
							$('#slider').css('height','');
						});
					});
				});
			</script>
		</div>
    </section>
	<div class="container">
<?php endif;?>