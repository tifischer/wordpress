<?php
/**
 * Template Name: Contact Page 2
 * 
 * @package marine
 * @since marine 1.0
 */

$header = get_post_meta(get_the_ID(), 'contact_form_header', true);
$name_field_label = get_post_meta(get_the_ID(), 'contact_form_name_field_label', true);
$name_field_icon = get_post_meta(get_the_ID(), 'contact_form_name_field_icon', true);
$email_field_label = get_post_meta(get_the_ID(), 'contact_form_email_field_label', true);
$email_field_icon = get_post_meta(get_the_ID(), 'contact_form_email_field_icon', true);
$message_field_label = get_post_meta(get_the_ID(), 'contact_form_message_field_label', true);
$submit_field_label = get_post_meta(get_the_ID(), 'contact_form_submit_field_label', true);
$clear_field_label = get_post_meta(get_the_ID(), 'contact_form_clear_field_label', true);

get_header(); ?>    
<?php if (have_posts()):
	while (have_posts()):
		the_post(); ?>    <!-- Google Map -->
		<section class="full-width google-map-ts ext2" style="margin-top:30px;">
			<?php //echo do_shortcode(get_post_meta(get_the_ID(), 'contact_map', true)); ?> 
			<section class="full-width-bg gray-bg normal-padding get-in-touch-overlay">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-2">
							<h2><?php echo $header ? $header : __('Contact Form', 'marine'); ?></h2>
							<form class="get-in-touch light contact-form" method="post">
								<?php wp_nonce_field('contact_form_submission', 'contact_nonce', true,true); ?>
								<input type="hidden" name="contact-form-value" value="1" id=""/>
								<div class="iconic-input"><input type="text" name="name" placeholder="<?php echo $name_field_label ? $name_field_label : esc_attr(__('Name*', 'marine')); ?>"> <i class="icons <?php echo $name_field_icon ? $name_field_icon : 'icon-user-1'; ?>"></i></div>
								<div class="iconic-input"><input type="text" name="email" placeholder="<?php echo $email_field_label ? $email_field_label : esc_attr(__('E-mail*', 'marine')); ?>"> <i class="icons <?php echo $email_field_icon ? $email_field_icon : 'icon-mail-4'; ?>"></i></div>
								<textarea name="msg" placeholder="<?php echo $message_field_label ? $message_field_label : esc_attr(__('Message', 'marine')); ?>"></textarea> <input type="submit" value="<?php echo $submit_field_label ? $submit_field_label : esc_attr(__('Send Message', 'marine')); ?>">
								<div class="iconic-button"><input type="reset" value="<?php echo $clear_field_label ? $clear_field_label : esc_attr(__('Clear', 'marine')); ?>"> <i class="icons icon-cancel-circle-1"></i></div>
							</form>
							<div id="msg"></div>
						</div>
					</div>
				</div>
			</section>   
		 </section>    <!-- /Google Map --> 
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 small-padding"><?php the_content(); ?></div>
		</div>
	<?php endwhile;
endif;
get_footer(); ?>