<?php
/**
 * Shortcode Title: Testimonial
 * Shortcode: testimonial
 * Usage: [testimonial animation="bounceInUp" id="2" ]
 */
add_shortcode('testimonial', 'ts_testimonial_func');

function ts_testimonial_func($atts, $content = null)
{
    extract(shortcode_atts(array(
            'animation' => '',
            "id" =>'',

        ),
        $atts));


    $testimonial = new Wp_Query(array(
        'p' => $id,
        'post_type' => 'testimonial'
    ));

	ob_start();

	while ($testimonial->have_posts()): $testimonial->the_post();
		?>
		<div class="testimonial <?php echo ts_get_animation_class($animation);?>">

			<div class="testimonial-header">

				<div class="testimonial-image">
					<?php echo ts_get_resized_post_thumbnail(get_the_ID(),'testimonial',get_the_title(),'img-responsive');?>

				</div>

				<div class="testimonial-meta">
					<span class="testimonial-author"><?php the_title(); ?></span>
					<span class="testimonial-job"><?php echo get_post_meta($id, 'position', true); ?>, <?php echo get_post_meta($id, 'company', true); ?></span>
				</div>

			</div>
			<blockquote class="testimonial-quote"><?php echo get_post_meta($id, 'quote', true); ?></blockquote>
			<div class="testimonial-desc">
				<?php
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				echo $content;
				?>
			</div>

		</div>

    <?php endwhile;
	wp_reset_postdata();

    $html =  ob_get_contents();
    ob_end_clean();
    return $html;
}