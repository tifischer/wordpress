<?php
/**
 * Shortcode Title: Pricing table
 * Shortcode: pricing_table
 * Usage: [pricing_table animation="bounceInUp" style="style1"][pricing_table_column featured="no" title="Your title" price="12" currency="$" period="per month" buttontext="Buy" url="http://yourdomain.com"][pricing_table_item value="text" text="Your text"][/pricing_table_column][/pricing_table]
 */
add_shortcode('pricing_table', 'ts_pricing_table_func');

function ts_pricing_table_func( $atts, $content = null ) {

	global $pricing_table_columns;
    $col  = 0;
    $pricing_table_columns = array(); // clear the array

	do_shortcode($content); // execute the '[pricing_table_columns]' shortcode first to get columns

	extract(shortcode_atts(array(
		'animation' => '',
        'style'=>'style1'
	), $atts));

	$columns = '';

	if (!is_array($pricing_table_columns) || count($pricing_table_columns) == 0) {
		return '';
	}
    
    foreach ($pricing_table_columns as $column) {
        $col++;
		$features = '';
		if (is_array($column)) {
			foreach ($column['rows'] as $row) {
                if ($row['value'] == 'checked') {
                    $features .= '<span class="value checked"><span></span></span>';
                } else if ($row['value'] == 'notchecked') {
                     $features .= '<span class="value not-checked"><span></span></span>';
                } else {
                    $features .= '<span class="value">'.$row['text'].'</span>';
                }
            }
		}

		$button = '';
		if (!empty($column['buttontext'])) {

			$button = '<a class="button '.($column['featured'] == 'yes' ? 'blue' : 'light').'" href="'.$column['url'].'">'.$column['buttontext'].'</a>';
		}

            if($col==1 && $style=='style2'){
                $legend_col =' pricing-table-legend';
            }else{
                $legend_col ='';
            }

        if($legend_col!=''  ){
            $columns .= '<td class="pricing-table-item '.$legend_col.' '.($column['featured'] == 'yes' ? 'featured' : '').'">

			   <div class="table-content">'.$features.'</div>
				 </td>';
        }else{
				
				$price = intval($column['price']);
				$price_fraction = substr(fmod($column['price'], 1) * 100,0);
				
				
        		$columns .= '<td class="'.$legend_col.'  pricing-table-item '.($column['featured'] == 'yes' ? 'featured' : '').'">


				  <div class="table-header"><h3>'.$column['title'].'</h3></div>
				  <div class="table-price">

											<span class="currency">'.$column['currency'].'</span>
											<span class="price-main">'.$price.'</span>
											<span class="price-secondary">'.$price_fraction.'<br><span class="period">'.$column['period'].'</span></span>

										</div>




			   <div class="table-content">'.$features.'</div>
				  <div class="table-footer">'.$button.'</div></td>';
        }

	}
    $pricing_table_columns = array();

	return '
		<table class="pricing-table '.($style == 'style2' ? 'small' : '').' '.ts_get_animation_class($animation).'">
			<tr>
			  '.$columns.'
			</tr>
		</table>';
}

/**
 * Shortcode Title: Pricing Table Column - can be used only with pricing_table shortcode
 * Shortcode: pricing_table_columns
 * Usage: [pricing_table_column featured="no" title="Medium plan" price="25" currency="$" period="per month" buttontext="Signup" url="..."][/pricing_table_column]
 */
add_shortcode('pricing_table_column', 'ts_pricing_table_column_func');
function ts_pricing_table_column_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'featured' => 'no',
	    'title' => '',
	    'price' => '',
	    'currency' => '',
	    'period' => '',
	    'discount' => '',
	    'buttontext' => '',
	    'url' => ''
    ), $atts));
    global $pricing_table_columns, $pricing_table_items;
	$pricing_table_items = array();
	do_shortcode($content);

    $pricing_table_columns[] = array(
		'featured' => $featured,
	    'title' => $title,
	    'price' => $price,
	    'currency' => $currency,
	    'period' => $period,
	    'discount' => $discount,
		'buttontext' => $buttontext,
	    'url' => $url,
		'rows' => $pricing_table_items
	);

	$pricing_table_items = array();
}

/**
 * Shortcode Title: Pricing Table Item - can be used only with pricing_table_column shortcode
 * Shortcode: pricing_table_columns
 * Usage: [pricing_table_item value="text" text="Your text"]
 */
add_shortcode('pricing_table_item', 'ts_pricing_table_item_func');
function ts_pricing_table_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'value' => 'text',
        'text' => ''
    ), $atts));
    global $pricing_table_items;
    $pricing_table_items[] = array(
		'value' => $value,
		'text' => $text,
	);
}