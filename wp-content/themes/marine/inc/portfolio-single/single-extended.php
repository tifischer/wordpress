<?php 
/**
 * The template for displaying portfolio single extended content
 *
 * @package marine
 * @since marine 1.0
 */

if (have_posts()): while (have_posts()): the_post(); ?>    
	<section class="row normal-padding">        
		<div class="col-lg-12 col-md-12 col-sm-12">            
			<?php the_content(); ?>        
		</div>    
	</section>
<?php endwhile; endif; ?>