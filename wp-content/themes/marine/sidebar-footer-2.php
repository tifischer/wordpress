<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package marine
 * @since marine 1.0
 */


global $post, $ts_cf_error, $ts_cf_message, $ts_cf_form_name, $ts_cf_form_email, $ts_cf_form_message;
?>
<div class="col-lg-3 col-md-3 col-sm-3">
    <?php dynamic_sidebar( 'footer-2-area-1' ); ?>
</div>
<!-- Contact form -->
<?php

$cf_header = '';
$header_style_html = '';
$cf_name_label = '';
$cf_name_icon = '';
$cf_email_label = '';
$cf_email_icon = '';
$cf_message_label = '';
$cf_send_label = '';
if (is_page()) {
	$cf_font_style = get_post_meta($post -> ID, 'footer_cf_font_style', true);
	$cf_font_size = get_post_meta($post -> ID, 'footer_cf_font_size', true);
	$cf_color = get_post_meta($post -> ID, 'footer_cf_color', true);
	$cf_header = get_post_meta($post -> ID, 'footer_cf_header', true);
	$cf_name_label = get_post_meta($post -> ID, 'footer_cf_name_label', true);
	$cf_name_icon = get_post_meta($post -> ID, 'footer_cf_name_icon', true);
	$cf_email_label = get_post_meta($post -> ID, 'footer_cf_email_label', true);
	$cf_email_icon = get_post_meta($post -> ID, 'footer_cf_email_icon', true);
	$cf_message_label = get_post_meta($post -> ID, 'footer_cf_message_label', true);
	$cf_send_label = get_post_meta($post -> ID, 'footer_cf_send_label', true);
	$cf_submit_style = get_post_meta($post -> ID, 'footer_cf_submit_style', true);
	
	$header_style = array();
	if (!empty($cf_font_style) && $cf_font_style != 'default' && $cf_font_style != 'google_web_fonts') {
		$header_style[] = 'font-family: '.str_replace('google_web_font_', '', $cf_font_style);
	}	
	if (!empty($cf_font_size) && intval($cf_font_size) > 0) {
		$header_style[] = 'font-size: '.intval($cf_font_size).'px';
	}
	if (!empty($cf_color)) {
		$header_style[] = 'color: '.$cf_color;
	}
	
	if (count($header_style) > 0) {
		$header_style_html = 'style="'.implode(';', $header_style).'"';
	}
}

?>

<div  class="col-lg-6 col-md-6 col-sm-6 footer-contact-form">
	<form id="footer-contact-form" _lpchecked="1" method="post" action="<?php echo get_the_permalink(get_the_ID()); ?>#footer-contact-form">
		<?php wp_nonce_field( 'footer-2-cf_mar', 'cf_wpnonce', true, true ); ?>
		<h3 class="cursive-style" <?php echo $header_style_html; ?>><?php echo !empty($cf_header) ? $cf_header : __('Contact Form', 'marine'); ?></h3>
		<?php if ($ts_cf_error || $ts_cf_message): ?>
			<div class="<?php echo ($ts_cf_error === true ? 'error': 'message')?>"><?php echo $ts_cf_message; ?> </div>
		<?php endif; ?>
		<div class="iconic-input">
			<input type="text" name="form_name" placeholder="<?php echo empty($cf_name_label) ? esc_attr('Name', 'marine') : esc_attr($cf_name_label); ?>*" value="<?php echo isset($ts_cf_form_name) ? esc_attr($ts_cf_form_name) : ''; ?>">
			<i class="icons <?php echo empty($cf_name_icon) || $cf_name_icon == 'default'  ? 'icon-user-1' : esc_attr($cf_name_icon); ?>"></i>
		</div>
		<div class="iconic-input">
			<input type="text" name="form_email" placeholder="<?php echo empty($cf_email_label) ? esc_attr('E-mail', 'marine') : esc_attr($cf_email_label); ?>*" value="<?php echo isset($ts_cf_form_email) ? esc_attr($ts_cf_form_email) : ''; ?>">
			<i class="icons <?php echo empty($cf_email_icon) || $cf_email_icon == 'default' ? 'icon-mail-4' : esc_attr($cf_email_icon); ?>"></i>
		</div>
		<textarea rows="6" name="form_message" placeholder="<?php echo empty($cf_message_label) ? esc_attr('Message', 'marine') : esc_attr($cf_message_label); ?>*"><?php echo isset($ts_cf_form_message) ? $ts_cf_form_message : ''; ?></textarea>
		<input class="unfilled big black <?php echo ($cf_submit_style != 'default' ? $cf_submit_style : ''); ?>" type="submit" value="<?php echo empty($cf_send_label) ? esc_attr('Send Message', 'marine') : esc_attr($cf_send_label); ?>">
	</form>
</div>
<!-- /Contact form -->
<div class="col-lg-3 col-md-3 col-sm-3">
    <?php dynamic_sidebar( 'footer-2-area-2' ); ?>
</div>