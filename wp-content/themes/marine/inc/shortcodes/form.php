<?php
/**
 * Shortcode Title: Form
 * Shortcode: form
 * Usage: [form animation="bounceInUp" skin="1" title="Your title" success_message="Thank you! Form was sent!" send_button="Send" send_button="Clear"][field name="Your name" type="text" required="yes" icon="icon-glass"][/form]
 */
add_shortcode('form', 'ts_form_func');

function ts_form_func( $atts, $content = null ) {
	
	global $ts_form_iterator;
	
	if (!isset($ts_form_iterator)) {
		$ts_form_iterator = 1;
	} else {
		$ts_form_iterator ++;
	}
	
	extract(shortcode_atts(array(
	    'animation' => '',
	    'skin' => '1',
		'title' => '',
	    'success_message' => '',
		'send_button' => __('Send message','marine'),
		'clear_button' => __('Clear','marine')
    ), $atts));
	
	wp_enqueue_script( 'jquery-validate' );
	
	global $shortcode_fields, $shortcode_form_email_sent;
    $shortcode_fields = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$fields_content = '';
	$rules_content = '';
	$i = 0;
	foreach ($shortcode_fields as $field) {
		
		$required_sign = '';
		
		$rules = array();
		if ($field['required'] == 'yes') {
			$required_sign = '*';			
			$rules[] = '.require()';
		}
		
		if ($field['type'] == 'email') {
			$rules[] = '.match("email")';
		}
		
		if (count($rules) > 0) {
			$rules_content .= '$("#shortcode_form_'.sanitize_text_field($field['name']).'")'.implode('',$rules).";\n";
		}
		
		$form_field = '';
		switch ($field['type']) {
			
			case 'textarea':
				$fields_content .= '
					<div class="iconic-input">
						<textarea id="shortcode_form_'.sanitize_text_field($field['name']).'" placeholder="'.esc_attr($field['name']).$required_sign.'" name="shortcode_form_'.sanitize_text_field($field['name']).'"></textarea>
						<i class="icons '.$field['icon'].'"></i>
					</div>';
				
				break;
			
			case 'email':
			case 'text':
			default:
				$fields_content .= '
					<div class="iconic-input">
						<input id="shortcode_form_'.sanitize_text_field($field['name']).'" name="shortcode_form_'.sanitize_text_field($field['name']).'" placeholder="'.esc_attr($field['name']).$required_sign.'" type="text" value="">
						<i class="icons '.$field['icon'].'"></i>
					</div>';
				break;
		}
		
		if ($field['required'] == 'yes') {
			
		}
	}
    $shortcode_fields = array();

	if (empty($fields_content)) {
		return '';
	}
	
	$skin_class = '';
	if ($skin == 1) {
		$skin_class = 'light';
	}
	
	$content = '
		<div class="sc-form '. ts_get_animation_class($animation) . '">
			<h2 class="wow">'.$title.'</h2>
			<form id="sc-form-'.$ts_form_iterator.'" class="get-in-touch '. ts_get_animation_class($animation) . ' '.$skin_class.'" method="post">
				'.(isset($shortcode_form_email_sent) && $shortcode_form_email_sent === true ? '<div class="sc-form-success">'.$success_message.'</div>' : '').'
				'.wp_nonce_field( 'shortcode-form_', '_wpnonce', true, false ).'
				'.$fields_content.'
				<input type="submit" value="' . esc_attr($send_button) . '">
				<div class="iconic-button">
					<input type="reset" value="' . esc_attr($clear_button) . '">
					<i class="icons icon-cancel-circle-1"></i>
				</div>
			</form>
		</div>';
	
	$content .= '
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				$("#sc-form-'.$ts_form_iterator.'").validity(function() {
					'.$rules_content.'
				});
			});
		</script>
	';
	
	return $content;
}

/**
 * Shortcode Title: Field - can be used only with form shortcode
 * Shortcode: field
 * Usage: [field name="Your name" type="text" required="yes" icon="icon-glass"]
 */
add_shortcode('field', 'ts_field_func');
function ts_field_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'name' => '',
	    'type' => '',
	    'icon' => 'no',
	    'icon_upload' => '',
	    'required' => 'no',
    ), $atts));
    global $shortcode_fields;
    $shortcode_fields[] = array(
		'name' => $name, 
		'type' => $type, 
		'icon' => $icon, 
		'icon_upload' => $icon_upload, 
		'required' => $required, 
	);
}