<?php
/**
 * Shortcode Title: Accordion
 * Shortcode: accordion
 * Usage: [accordion animation="bounceInUp" open="yes"][accordion_toggle title="title 1"]Your content[/accordion_toggle][/accordion]
 */
add_shortcode('accordion', 'ts_accordion_func');

function ts_accordion_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'open' => 'no',
		'animation' => ''
	), $atts));

	global $single_tab_array;
	$single_tab_array = array();

	do_shortcode($content);
	$i = 0;

	$tabs_nav = '';

	foreach ($single_tab_array as $tab => $tab_attr_array) {

		$open_class = '';
		if ($open == "yes" && $i == 0)
		{
			$open_class = 'accordion-active';
		}

		$tabs_nav .= '
			<div class="accordion '.$open_class.'">
				<div class="accordion-header">
										<div class="accordion-icon"></div>
										<h5>'.$tab_attr_array['title'].'</h5>

				</div>
				<div class="accordion-content" '.($open == "yes" && $i == 0 ? 'style="display: block;"' : '').'>
					' . $tab_attr_array['content'] . '
				</div>
			</div>';
		$i++;
	}

	$content = '<div class="accordions">'.$tabs_nav.'</div>';

	$single_tab_array = array();
	return $content;
}
/**
 * Shortcode Title: Sidebar Toggle
 * Shortcode: accordion_toggle
 * Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 */
add_shortcode('accordion_toggle', 'ts_accordion_toggle_func');

function ts_accordion_toggle_func($atts, $content = null) {
	extract(shortcode_atts(array(
				'title' => '',
					), $atts));
	global $single_tab_array;
	$single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
	return '';
}