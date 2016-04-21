<?php
/**
 * Template Name: Contact Basic
 * 
 * @package marine
 * @since marine 1.0
 */

get_header();

if (have_posts()): while (have_posts()): the_post(); ?>
	<!-- Google Map -->
	<section class="full-width google-map-ts">
		<?php echo do_shortcode(get_post_meta(get_the_ID(), 'contact_map', true)); ?>
	</section>
	<!-- /Google Map -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 small-padding"><?php the_content(); ?></div>
	</div>
<?php endwhile; 
endif;

get_footer(); ?>