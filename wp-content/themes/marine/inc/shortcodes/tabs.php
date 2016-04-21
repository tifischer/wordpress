<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [tabs  orientation="horizontal"  animation="fadein"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]
 */
add_shortcode('tabs', 'ts_tabs_func');

function ts_tabs_func( $atts, $content = null ) {

	//[tabs ]
	extract(shortcode_atts(array(
		'orientation' => 'horizontal',
	    'animation' => 'fadeIn',
    ), $atts));

	if (!in_array($orientation,array('horizontal','vertical')))
	{
		$orientation = 'horizontal';
	}

    $tab_style='';
    if ($orientation == 'vertical'){
        $tab_style=" style2";
    }

	global $shortcode_tabs;
    $shortcode_tabs = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$tabs_nav = '';
	$tabs_content = '';
	$tabs_count = count($shortcode_tabs);
	$i = 0;
	foreach ($shortcode_tabs as $tab) {

		$i ++;
		$tabs_nav .= '<li><a href="#tab'.$i.'">';
		if ($tab['icon'] != 'no')
		{
			$tabs_nav.= '<i class="icons '.$tab['icon'].'"></i>';
		}
		$tabs_nav .= ''.$tab['title'].'</a></li>';

		$tabs_content .= '<div id="tab'.$i.'" class="tab">'.$tab['content'].'</div>';


	}
    $shortcode_tabs = array();

	$rand = rand(15000,50000); // TODO add \/remove options

	$content = "
		<div id='tab-".$rand."' class='tabs animated ".$animation.' '.$tab_style."'>
		<div class=\"tab-header\">
			<ul class=''>
				".$tabs_nav."
			</ul>
			</div>
			<div class=\"tab-content\">
				".$tabs_content."
			</div>
		</div>
		 ";
	return $content;
}

/**
 * Shortcode Title: Tab - can be used only with tabs shortcode
 * Shortcode: tab
 * Usage: [tabs][tab label="New 1"]Your text here...[/tab][/tabs]
 */
add_shortcode('tab', 'ts_tab_func');
function ts_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'icon' => 'no'
    ), $atts));
    global $shortcode_tabs;
    $shortcode_tabs[] = array('title' => $title, 'icon' => $icon, 'content' => trim(do_shortcode($content)));
}