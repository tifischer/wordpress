<?php
/**
 * Shortcode Title: Alerts
 * Shortcode: alert
 * Usage: [alert animation="fade" message="error message" style="info" icon="" close_btn="yes"]
 * */

add_shortcode('alert', 'ts_alert_func');

function ts_alert_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation'=>'',
		'style' => 'info',
		'icon'=>'',
		'close_btn' => 'yes',
		'message' => ''
	),
	$atts));

	$html='';
    if($icon!=''){

        $icon = '<i class="icons '.$icon.'"></i>';
    }
    $html .= '<div class="alert-box ' . $style . ts_get_animation_class($animation).'">'.$icon.'<p>' . $message . '</p>';
    if ($close_btn == 'yes') {
        $html .= '<i class="close-button icon-cancel-circle-2"></i>';
    }
    $html .= '</div>';

    return $html;
}