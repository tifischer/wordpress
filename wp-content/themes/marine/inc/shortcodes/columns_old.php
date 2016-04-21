<?php
/**
 * Shortcode Title: Row
 * Shortcode: row
 * Usage: [row]....[/row]
 */
function ts_row($atts, $content = null)
{
    return '<div class="row">' . do_shortcode($content) . '</div> ';
}

add_shortcode('row', 'ts_row');

function ts_one($atts, $content = null)
{
	return '<div class="col-lg-12 col-md-12 col-sm-12">' . do_shortcode($content) . '</div> ';
}

add_shortcode('one', 'ts_one');

/**
 * Shortcode Title: Column One Third
 * Shortcode: one_third
 * Usage: [one_third]....[/one_third]
 */
function ts_one_third($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'one_third',
		'onmobile' => 'one_third'
	), $atts));
	
    return '<div class="col-lg-4 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_third', 'ts_one_third');


/**
 * Shortcode Title: Column One Two Third
 * Shortcode: two_third
 * Usage: [two_third]....[/two_third]
 */
function ts_two_third($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'two_third',
		'onmobile' => 'two_third'
	), $atts));
	
    return '<div class="col-lg-8 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('two_third', 'ts_two_third');


/**
 * Shortcode Title: Column One Half
 * Shortcode: one_half
 * Usage: [one_half]....[/one_half]
 */
function ts_one_half($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'one_third',
		'onmobile' => 'one_third'
	), $atts));
	
    return '<div class="col-lg-6 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_half', 'ts_one_half');


/**
 * Shortcode Title: Column One Fourth
 * Shortcode: one_fourth
 * Usage: [one_fourth]....[/one_fourth]
 */
function ts_one_fourth($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'one_fourth',
		'onmobile' => 'one_fourth'
	), $atts));
	
    return '<div class="col-lg-3 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_fourth', 'ts_one_fourth');


/**
 * Shortcode Title: Column Threee Fourth
 * Shortcode: three_fourth
 * Usage: [three_fourth]....[/three_fourth]
 */
function ts_three_fourth($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'three_fourth',
		'onmobile' => 'three_fourth'
	), $atts));
	
    return '<div class="col-lg-9 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fourth', 'ts_three_fourth');

/**
 * Shortcode Title: Column One Sixth
 * Shortcode: one_sixth
 * Usage: [one_sixth]....[/one_sixth]
 */
function ts_one_sixth($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'one_sixth',
		'onmobile' => 'one_sixth'
	), $atts));
	
    return '<div class="col-lg-2 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_sixth', 'ts_one_sixth');


/**
 * Shortcode Title: Column Five Sixth
 * Shortcode: five_sixth
 * Usage: [five_sixth]....[/five_sixth]
 */
function ts_five_sixth($atts, $content = null)
{
	extract(shortcode_atts(array(
		'ontablet' => 'one_sixth',
		'onmobile' => 'one_sixth'
	), $atts));
	
    return '<div class="col-lg-10 col-md-'.ts_get_columns($ontablet).' col-sm-'.ts_get_columns($onmobile).'">' . do_shortcode($content) . '</div>';
}

add_shortcode('five_sixth', 'ts_five_sixth');

function ts_get_columns($value) {
	
	switch ($value) {
		case 'one_half':	return 6 ; break;
		case 'one_third':	return 4 ; break;
		case 'two_third':	return 8 ; break;
		case 'one_fourth':	return 3 ; break;
		case 'three_fourth':return 9 ; break;
		case 'one_sixth':	return 2 ; break;
		case 'five_sixth':	return 10 ; break;
	}
	return 12;
}