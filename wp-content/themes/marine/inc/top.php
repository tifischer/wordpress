<?php
/**
 * Top secion of the theme, includes page header or image slider
 *
 * @package marine
 * @since marine 1.0
 */
if (is_tag()) {
    $title = sprintf(__('Posts Tagged "%s"', 'marine'), single_tag_title('', false));
} elseif (is_day()) {
    $title = sprintf(esc_html__('Posts made in %s', 'marine'), get_the_time('F jS, Y'));
} elseif (is_month()) {
    $title = sprintf(esc_html__('Posts made in %s', 'marine'), get_the_time('F, Y'));
} elseif (is_year()) {
    $title = sprintf(esc_html__('Posts made in %s', 'marine'), get_the_time('Y'));
} elseif (is_search()) {
    $title = sprintf(esc_html__('Search results for %s', 'marine'), get_search_query());
} elseif (is_category()) {
    $title = single_cat_title('', false);
} elseif (is_author()) {
    global $wp_query;
    $curauth = $wp_query->get_queried_object();
    $title = sprintf(__('Posts by %s', 'marine'), $curauth->nickname);
} elseif (is_single()) {
    
	$title = get_the_title();
    
} elseif (is_page()) {
    $title = get_the_title();
} else if (is_404()) {
    $title = __('404 Page Not Found', 'marine');
} else if (function_exists('is_woocommerce') && is_woocommerce()) {
    $title = __('Shop', 'marine');
} else {
    $title = get_bloginfo('name');
}

$titlebar = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar', true);
$no_titlebar = false;

$image = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_background', true);
$titlebar_bg = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_bg', true);


switch ($titlebar) {
    case 'title':
        $show_title = true;
        $show_breadcrumbs = false;
        break;

    case 'breadcrumbs':
        $show_title = true;
        $show_breadcrumbs = true;
        break;

    case 'no_titlebar':
        $no_titlebar = true;
        break;

    default:
        $show_title = true;
        $show_breadcrumbs = true;
}

$class = '';

$titlebar_style = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_style', true);

if (function_exists('is_woocommerce') && is_woocommerce()) {
    $titlebar_style = ot_get_option('default_shop_titlebar_style');
}

if (empty($titlebar_style) || $titlebar_style == 'default') {
    $titlebar_style = ot_get_option('default_titlebar_style');
}

if (empty($image)) {
	if (function_exists('is_woocommerce') && is_woocommerce()) {
		$image = ot_get_option('default_shop_title_background');
	}
	if (empty($image)) {
		$image = ot_get_option('default_title_background');
	}
}
if (!empty($image)) {
    $title_background_position = ot_get_option('default_title_background_position');
    
    if (!empty($title_background_position)) {
        $class .= ' ' . $title_background_position;
    }

    $title_background_size = ot_get_option('default_title_background_size');
	
	if (!empty($title_background_size) && $title_background_size != 'default') {
        $class .= ' ' . $title_background_size;
    }
}

$styles = array();
if (!empty($image)) {
     $styles[] = 'background-image: url(' . $image . ')';
}


if (!empty($titlebar_bg)) {
     $styles[] = 'background-color: '.$titlebar_bg;
}

$style = '';
if (count($styles) > 0) {
	$style = 'style="'.implode(';',$styles).'"';
}

if ($no_titlebar === false):
	
	switch ($titlebar_style):
		case 'style2': ?>
			<section class="full-width dark-blue-bg page-heading <?php echo $class; ?>" <?php echo $style; ?>>				
				<div class="container">
				<div class="row">
					<?php if ($show_title): ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h1><?php echo $title; ?></h1>
						</div>
					<?php endif;
					if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<?php ts_the_breadcrumbs(); ?>
						</div>
					<?php endif;?>
				</div>
				</div>
			</section>
			<?php break;
			
		case 'style3': ?>
			<section class="full-width style2 page-heading dark-blue-bg header_bg <?php echo $class; ?>" <?php echo $style; ?>>
				<div class="container">
					<div class="row">
						<?php if ($show_title): ?>
							<div class="col-lg-12">
								<?php
								$icon = get_post_meta(is_singular() ? get_the_ID() : null,'page_title_icon_upload', true);
								if (!empty($icon)): ?>
									<img src="<?php echo $icon; ?>" />
								<?php elseif (empty($icon)): 
									$icon = get_post_meta(is_singular() ? get_the_ID() : null,'page_title_icon', true);
									if (!empty($icon)): ?>
										<i class="icons <?php echo $icon; ?>"></i>
									<?php else: ?>	
										<i class="icons icon-sun-2"></i>
									<?php endif;
								endif; ?>
								<h1><span class="extra-bold"><?php echo $title; ?></span></h1>

							</div>
							<?php echo get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_text', true); ?>
						<?php endif;
						if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
							<div class="col-lg-12  portfolio-bc">
								<?php ts_the_breadcrumbs(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<?php break;
			
		case 'style1':
		default: ?>
			<div class="page-heading style3 wrapper border-bottom  <?php echo $class; ?>" <?php echo $style; ?>>
				<div class="row">
					<?php
					if ($show_title): ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h1><?php echo $title; ?></h1>
						</div>
						<?php echo get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_text', true); ?>
					<?php endif;
					if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<?php ts_the_breadcrumbs(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			break;

	endswitch;
endif;
