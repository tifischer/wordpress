<?php
/*
 * Template Name: Contact Page 2
 *
 */
get_header(); ?>    <!-- Main Content -->
<section id="main-content">    <!-- Container -->
    <div class="container"><?php if (have_posts()): while (have_posts()):    the_post(); ?>    <!-- Google Map -->
    <section
        class="full-width google-map google-map-heading">                                                                                    <?php echo do_shortcode(get_post_meta(get_the_ID(),
            'contact_map', true)); ?>    </section>    <!-- /Google Map -->
    <section class="full-width-bg gray-bg normal-padding get-in-touch-overlay">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-2">
			<h2><?php _e('Contact Form', 'marine'); ?></h2>

                <form class="get-in-touch contact-form" method="post">                    <?php wp_nonce_field('contact_form_submission', 'contact_nonce', true,
                        true); ?>                    <input type="hidden" name="contact-form-value" value="1" id=""/>

                    <div class="iconic-input"><input type="text" name="name" placeholder="<?php _e('Name*', 'marine'); ?>"> <i class="icons icon-user-1"></i></div>
                    <div class="iconic-input"><input type="text" name="email" placeholder="<?php _e('E-mail*', 'marine'); ?>"> <i class="icons icon-mail-4"></i></div>
                    <textarea name="msg" placeholder="<?php _e('Message', 'marine'); ?>"></textarea> <input type="submit"
                                                                                                            value="<?php _e('Send Message', 'marine'); ?>">

                    <div class="iconic-button"><input type="reset" value="<?php _e('Clear', 'marine'); ?>"> <i class="icons icon-cancel-circle-1"></i></div>
                </form>
                <div id="msg"></div>
            </div>
        </div>
    </section>
    <section>
        <div class="col-lg-12 col-md-12 col-sm-12">            <?php the_content(); ?>        </div>
    </section>    </div><?php endwhile;endif; ?>
<?php get_footer(); ?>