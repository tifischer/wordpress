<?php
/*
 * Shortcode Name: Contact Form
 * Shortcode: contact_form
 * Usage: [contact_form animation="fade" name_label="Name" name_icon="fa-user" email_label="your@email.com" email_icon="fa-envelope" message_label="Message" send_label="Send" clear_label="Clear" skin="1" button_align="left" ]
 */

add_shortcode('contact_form', 'ts_contact_form_func');

function ts_contact_form_func($atts, $content = null)
{
    extract(

        shortcode_atts(array(
            'animation' => '',
            'name_label' => '',
            'name_icon' => '',
            'email_label' => '',
            'email_icon' => '',
            'message_label' => '',
            'send_label' => '',
            'clear_label' => '',
            'skin' => 1,
            'button_align' => 'left',
        ), $atts)

    );

	$style = '';
    if(!empty($button_align)){
        $style = 'style="text-align: ' . $button_align . '";';
    }
	
	$skin_class = '';
	if ($skin == 1) {
		$skin_class = 'light';
	}
	
    $html = '
		<form '.$style.' class="get-in-touch contact-form '. ts_get_animation_class($animation) . ' '.$skin_class.'" method="post">
		   '.wp_nonce_field( 'contact_form_submission', 'contact_nonce', true,false).'
		   <input type="hidden" name="contact-form-value" value="1" id=""/>
		   <div class="iconic-input">
			   <input type="text" name="name" placeholder="' . $name_label . '*">
			   <i class="icons ' . $name_icon . '"></i>
		   </div>
		   <div class="iconic-input">
			   <input type="text" name="email" placeholder="' . $email_label . '*">
			   <i class="icons ' . $email_icon . '"></i>
		   </div>
		   <textarea name="msg" placeholder="' . $message_label . '"></textarea>
		   <input type="submit" value="' . $send_label . '">
		   <div class="iconic-button">
			   <input type="reset" value="' . $clear_label . '">
			   <i class="icons icon-cancel-circle-1"></i>
		   </div>
	   </form>
	   <div id="msg"></div>';
    return $html;
}





