<?php
/**
 * Shortcode Title: Skill bar
 * Shortcode: skillbar
 * Usage: [skillbar animation="bounceInUp" style="1"][skillbar_item percentage="80" title="Cooking" color="#FF0000"][/skillbar]
 */
add_shortcode('skillbar', 'ts_skillbar_func');
$shortcode_skillbar_border_color = null;
$shortcode_skillbar_text_color = null;
$shortcode_skillbar_style = null;

function ts_skillbar_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'animation' => '',
        'border_color' => '',
        'text_color' => '',
        'style' => ''
    ), $atts));

    global $shortcode_skillbar_style, $shortcode_skillbar_animation, $shortcode_skillbar_border_color, $shortcode_skillbar_text_color;
    $shortcode_skillbar_style = $style;
	
	if (empty($shortcode_skillbar_style)) {
		$shortcode_skillbar_style = 'style1';
	}
	
    $shortcode_skillbar_animation = $animation;
    $shortcode_skillbar_border_color = $border_color;
    $shortcode_skillbar_text_color = $text_color;
	
    return do_shortcode($content);
}

/**
 * Shortcode Title: Skill Bar item
 * Shortcode: skillbar_item
 * Usage: [skillbar_item percentage="80" title="Cooking" color="#FF0000"]
 */
add_shortcode('skillbar_item', 'ts_skillbar_item_func');
function ts_skillbar_item_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'percentage' => 0,
        'title' => '',
    ), $atts));

    global $shortcode_skillbar_style, $shortcode_skillbar_animation, $shortcode_skillbar_border_color, $shortcode_skillbar_text_color;

    $html = null;
    $rand = null;
    if ((int)$percentage > 100) {
        $percentage = 100;
    } else if ((int)$percentage < 1) {
        $percentage = 1;
    }

	$p_style = '';
    if (!empty($shortcode_skillbar_text_color)) {
        $p_style = 'style="color:' . $shortcode_skillbar_text_color . '"';
    }

    $html .= '<div class="' . $rand . ' '.$shortcode_skillbar_style.'" >
    	           <p ' . $p_style . '">' . $title . '</p>
				   <div  class="progressbar ' . ts_get_animation_class($shortcode_skillbar_animation) . '" data-percent="' . $percentage . '">
								<div class="progress-width"></div>
								<span class="progress-percent"></span>
				   </div>
			 </div>

		';

    return $html;
}