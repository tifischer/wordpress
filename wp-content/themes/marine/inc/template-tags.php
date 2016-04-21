<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package marine
 * @since marine 1.0
 */

/**
 * Display site logo
 */
function ts_the_logo() { 
	
	$logo_url = null;
	if (is_page()) {
		$logo_url = get_post_meta(get_the_ID(), 'logo_url', true);
	}
	if (empty($logo_url) && function_exists('is_woocommerce') && (
			is_shop() ||
			is_woocommerce() ||
			is_product_category() ||
			is_product_tag() ||
			is_product() ||
			is_cart() ||
			is_checkout() ||
			is_account_page()
		)) {
		$logo_url = get_post_meta(get_option('woocommerce_shop_page_id'), 'logo_url', true);
	}
	
	if (empty($logo_url)) {
		$logo_url = ot_get_option('logo_url');
	}
	
	if (!empty($logo_url)) {
		$logo = '<img class="logo" src="' . $logo_url . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '">';
	} else {
		$logo = '<img class="logo" src="' . get_template_directory_uri() . '/img/marine-logo.png" alt="' . esc_attr(get_bloginfo('name','display')) . '">';
	}
	?>
	<a href='<?php echo home_url('/'); ?>' title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php echo $logo; ?></a>
	<?php
}

/**
 * Getting google web fonts
 * @return type
 */
function ts_get_used_googe_web_fonts()
{
    $fonts = array(
        'content_font' => ot_get_option('content_font'),
        'title_font' => ot_get_option('title_font'),
        'menu_font' => ot_get_option('menu_font'),
        'headers_font' => ot_get_option('headers_font')
    );
    //get fonts from page content
    if (is_page()) {
        $page = get_page(get_the_ID());
        preg_match_all('/google_web_font_[a-zA-Z0-9. ]*+/i', $page->post_content, $matches);

        if (isset($matches[0]) && is_array($matches[0])) {
            foreach ($matches[0] as $font) {
                $fonts[] = $font;
            }
        }
		
		$cf_font_style = get_post_meta(get_the_ID(), 'footer_cf_font_style', true);
		if (!empty($cf_font_style) && strstr($cf_font_style, 'google_web_font_') && get_post_meta(get_the_ID(), 'footer_style', true) == 'alternative') {
			$fonts[] = $cf_font_style;
		}
    }

    $fonts_to_get = array();
	$fonts_to_get[] = 'Lato';
    $local_fonts_to_load = array();
    $fonts_return = array();
    foreach ($fonts as $key => $font) {
        if (empty($font)) {
            continue;
        }
        $tmp = $font;
        if (strstr($font, 'google_web_font_')) {
            $tmp = str_replace('google_web_font_', '', $tmp);
            $fonts_to_get[] = $tmp;
        }

        $fonts_return[$key] = $tmp;
    }

    $fonts_to_get = array_unique($fonts_to_get);
    $subset = '';
    $character_sets = ot_get_option('character_sets');
    if (is_array($character_sets) && count($character_sets) > 0) {
        $subset = '&subset=latin,' . implode(',', $character_sets);
    }

    if (count($fonts_to_get) > 0) {
        $protocol = is_ssl() ? 'https' : 'http';

        foreach ($fonts_to_get as $font) {
            ?>
            <link href="<?php echo $protocol; ?>://fonts.googleapis.com/css?family=<?php echo urlencode($font); ?>:400,800,300,700" rel="stylesheet" type="text/css">
        <?php
        }
    }

    if (count($local_fonts_to_load) > 0) {
        ?>
        <style type="text/css">
            <?php
            foreach ($local_fonts_to_load as $font)
            {?>
            @font-face {
                font-family: '<?php echo $font; ?>';
                src: url("<?php echo get_template_directory_uri()?>/font/<?php echo $font; ?>.otf") format("opentype");
            }

            <?php
            } ?>
        </style>
    <?php
    }

    return $fonts_return;
}

if (!function_exists('ts_theme_styles')) :

    function ts_theme_styles()
    {
        $fonts = ts_get_used_googe_web_fonts();
		
		$content_font = isset($fonts['content_font']) ? $fonts['content_font'] : '';
        $title_font = isset($fonts['title_font']) ? $fonts['title_font'] : '';
        $menu_font = isset($fonts['menu_font']) ? $fonts['menu_font'] : '';
        $headers_font = isset($fonts['headers_font']) ? $fonts['headers_font'] : '';
        ?>
        <style type="text/css">
            <?php if (!empty( $content_font ) && $content_font != 'default'): ?>
				body {
					font-family: '<?php echo $content_font; ?>';
				}
            <?php endif; ?>

            <?php if (ot_get_option('content_font_size')): ?>
				body,
				p {
					font-size: <?php echo ot_get_option('content_font_size'); ?>px;
				}
            <?php endif; ?>

            <?php if (!empty( $title_font ) && $title_font != 'default'): ?>
				.page-heading h1 {
					font-family: '<?php echo $title_font; ?>';
				}
            <?php endif; ?>

            <?php if (ot_get_option('title_font_size')): ?>
				.page-heading h1 {
					font-size: <?php echo ot_get_option('title_font_size'); ?>px;
				}
            <?php endif; ?>

            <?php if (!empty( $menu_font ) && $menu_font != 'default'): ?>
				#main-nav>li>a, 
				#header div.menu>ul>li>a,
				#main-nav li ul li a, 
				#main-nav .mega-menu li span, 
				#main-nav .mega-menu-footer span, 
				#side-nav-menu>li>a, 
				#side-nav li ul li>a, 
				#side-nav .mega-menu li span, 
				#side-nav .mega-menu-footer span {
					font-family: '<?php echo $menu_font; ?>';
				}
            <?php endif; ?>

            <?php if (ot_get_option('menu_font_size')): ?>
				#main-nav>li>a, 
				#header div.menu>ul>li>a {
					font-size: <?php echo ot_get_option('menu_font_size'); ?>px;
				}
            <?php endif; ?>

            <?php if (!empty( $headers_font ) && $headers_font != 'default'): ?>
				h1,
				h2,
				h3,
				h4,
				h5,
				h6,
				aside h5 {
                font-family: '<?php echo $headers_font; ?>';
            }
            <?php endif; ?>

            <?php if (ot_get_option('h1_size')): ?>
				h1 {
                font-size: <?php echo ot_get_option('h1_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (ot_get_option('h2_size')): ?>
				h2 {
                font-size: <?php echo ot_get_option('h2_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (ot_get_option('h3_size')): ?>
				h3 {
                font-size: <?php echo ot_get_option('h3_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (ot_get_option('h4_size')): ?>
				h4 {
                font-size: <?php echo ot_get_option('h4_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (ot_get_option('h5_size')): ?>
				h5 {
                font-size: <?php echo ot_get_option('h5_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (ot_get_option('h6_size')): ?>
				h6 {
                font-size: <?php echo ot_get_option('h6_size'); ?>px;
            }
            <?php endif; ?>

            <?php if (
				in_array(ot_get_option('body_class'),array('b1170','b960')) && (!isset($_GET['switch_layout']) || in_array($_GET['switch_layout'],array('b1170','b960'))) ||
				isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ||
				(ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_body_class']) && in_array($_COOKIE['theme_body_class'],array('b1170','b960') ) )
			): ?>
				body.b1170, body.b960 {
					<?php if (isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ): ?> 
						background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/dark_wood.png);
						background-attachment: fixed;

					<?php elseif (ts_check_if_control_panel() && isset($_COOKIE['theme_background']) && !empty($_COOKIE['theme_background'])): ?> 
						background-image: url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $_COOKIE['theme_background']; ?>);
						background-repeat: no-repeat;
						background-position: center;
						background-attachment: fixed;

					<?php elseif (ot_get_option('background_pattern') == 'image' && ot_get_option('background_image') != '' ): ?> 
						background-image: url(<?php echo ot_get_option('background_image'); ?>);

						<?php if (ot_get_option('background_attachment') != '' ): ?> 
							background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
						<?php endif; ?>

					<?php elseif (ot_get_option('background_pattern') != 'none' ): ?> 
						background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/<?php echo ot_get_option('background_pattern'); ?>);

						<?php if (ot_get_option('background_attachment') != '' ): ?> 
							background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
						<?php endif; ?> 
					<?php endif; ?> 
					<?php if (ot_get_option('background_color') != '' ): ?> 
							background-color: <?php echo ot_get_option('background_color'); ?>;
					<?php endif; ?> 
					<?php if (ot_get_option('background_repeat') != '' ): ?> 
							background-repeat: <?php echo ot_get_option('background_repeat'); ?>;
					<?php endif; ?> 
					<?php if (ot_get_option('background_position') != '' ): ?> 
							background-position: <?php echo ot_get_option('background_position'); ?> top;
					<?php endif; ?> 
					<?php if (ot_get_option('background_size') == 'browser' ): ?> 
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
						background-size: cover;
					<?php endif; ?>
				}

            <?php endif; ?>

            img.logo {
				<?php if (ot_get_option('logo_top_margin')): ?> 
					margin-top: <?php echo ot_get_option('logo_top_margin'); ?>px;
				<?php endif; ?> 
				<?php if (ot_get_option('logo_left_margin')): ?> 
					margin-left: <?php echo ot_get_option('logo_left_margin'); ?>px;
				<?php endif; ?> 
				<?php if (ot_get_option('logo_bottom_margin')): ?> 
					margin-bottom: <?php echo ot_get_option('logo_bottom_margin'); ?>px;
				<?php endif; ?>
            }

            <?php
            if (is_page()) {
                $page_title_color = get_post_meta(get_the_ID(),'page_title_color', true);
                if (empty($page_title_color)) {
                    $page_title_color = ot_get_option('page_title_color');
                }
                if (!empty($page_title_color)) { ?>
                    /* page_title_color */
					.page-heading h1, 
                    .page-heading.style3 h1, 
					.page-heading.style2 h1 {
                        color: <?php echo $page_title_color; ?>;
                    }
                <?php } ?>
            <?php }
            
            if (ot_get_option('megamenu_background')) { ?>
                #main-nav .mega-menu>ul,
                .headerstyle1 #main-nav .mega-menu>ul,
                .headerstyle4 #main-nav .mega-menu>ul,
                .headerstyle5 #main-nav .mega-menu>ul,
                .headerstyle8 #main-nav .mega-menu>ul {
                    background-image: url(<?php echo ot_get_option('megamenu_background'); ?>);
                }
            <?php }            
            ?>
        </style>
        <style type="text/css" id="dynamic-styles">
            <?php ts_the_theme_dynamic_styles(false); ?>
        </style>
        <?php if (ot_get_option('custom_css')): ?>
        <style type="text/css">
            <?php echo ot_get_option('custom_css'); ?>
        </style>

    <?php endif; ?>
		
	<style><?php

        /* ALTERNATE SLIDER TEMPLATE */
        global $post;
		
		$slider_content_bg1 = get_post_meta(is_singular() ? get_the_ID() : null, 'slider_content_bg', true);
        $slider_content_bg2 = get_post_meta(is_singular() ? get_the_ID() : null, 'slider_content_bg_2', true);
        $slider_content_bg_transparency = get_post_meta(is_singular() ? get_the_ID() : null, 'slider_content_bg_transparency', true);
        if (!empty($slider_content_bg1) || !empty($slider_content_bg2)):?>

           .alternate-slider-bg {
				background-image: -webkit-gradient(
				  linear, right top, left top, from(<?php echo ts_hex_to_rgb($slider_content_bg1,$slider_content_bg_transparency / 100); ?>),
				  to(<?php echo ts_hex_to_rgb($slider_content_bg2, $slider_content_bg_transparency / 100); ?>)
				);
				background-image: -moz-linear-gradient(
				  right center,
				  <?php echo ts_hex_to_rgb($slider_content_bg1,$slider_content_bg_transparency / 100); ?> 20%, <?php echo ts_hex_to_rgb($slider_content_bg2, $slider_content_bg_transparency / 100); ?> 95%
				);
				filter: progid:DXImageTransform.Microsoft.gradient(
				  gradientType=1, startColor=<?php echo $slider_content_bg1; ?>, endColorStr=<?php echo $slider_content_bg2; ?>
				);
				-ms-filter: progid:DXImageTransform.Microsoft.gradient(
				  gradientType=1, startColor=<?php echo $slider_content_bg1; ?>, endColorStr=<?php echo $slider_content_bg2; ?>
				);
			}
         <?php endif;

		$page_title_color = get_post_meta(is_singular() ? get_the_ID() : null, 'page_title_color', true);
		$titlebar_bg = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_bg', true);
		$titlebar_background = get_post_meta(is_singular() ? get_the_ID() : null, 'titlebar_background', true);
		$breadcrumb_color = get_post_meta(is_singular() ? get_the_ID() : null, 'breadcrumb_color', true);

		$heading_box=array();
		if(!empty($titlebar_bg)){
			$heading_box[] = 'background-color:'.$titlebar_bg;
		}else{
			$heading_box[] = 'background-color:'.ot_get_option('page_title_background_color');
		}

		if(!empty($titlebar_background)){
			$heading_box[] = 'background-image:'.$titlebar_background;
		}

		if(is_array($heading_box)){
			echo '.portfolio-heading,.page-heading{'.implode(';',$heading_box).'}';
		}

		if(!empty($page_title_color)){
			 echo '.portfolio-heading h1 span,.page-heading h1{color:'.$page_title_color.'!important} ';
		}else{
			echo '.portfolio-heading h1 span,.page-heading h1{color:'.ot_get_option('page_title_color').'!important} ';
		}

		if(!empty($breadcrumb_color)){
			echo '.breadcrumbs a, .breadcrumbs span, .breadcrumbs {
			color:'. $breadcrumb_color.'!important}';
		}
		
        /*  FOR FOOTER  */
        $lower_footer_bg = ot_get_option('copyrights_bar_background');
        if(!empty($lower_footer_bg)){
            echo '#lower-footer{background-color:'.$lower_footer_bg.'}';
        }

        $copyrights_bar_text_color = ot_get_option('copyrights_bar_text_color');
        if(!empty($copyrights_bar_text_color)){
            echo '#lower-footer{color:'.$copyrights_bar_text_color.'}';
        }

        $footer_background_color =  ot_get_option('footer_background_color');
        if(!empty($footer_background_color)){
            echo '#main-footer{background-color:'.$footer_background_color.'}';
        }

        $footer_main_text_color = ot_get_option('footer_main_text_color');
        if(!empty($footer_main_text_color)){
            echo '#main-footer{color:'.$footer_main_text_color.'}';
        }

        $footer_headers_color = ot_get_option('footer_headers_color');
        if(!empty($footer_headers_color)){
            echo '#main-footer h4{color:'.$footer_headers_color.'}';
        }
        /*  END FOOTER STYLES  */

        $main_body_text_color = ot_get_option('main_body_text_color');
        if(!empty($main_body_text_color)){
            echo '#main-content p{color:'.$main_body_text_color.'}';
        }
        $main_body_background_color = ot_get_option('main_body_background_color');
        if(!empty($main_body_background_color)){
            echo 'body { background: '.$main_body_background_color.'!important   }';

        }
		?>
        </style>
    <?php
}

    add_action('wp_head', 'ts_theme_styles');
endif;


function ts_the_theme_dynamic_styles($ajax_request = true)
{
    $main_color = ot_get_option('main_color');

    //change color if control panel is enabled
    if (ts_check_if_control_panel()) {
        if (isset($_GET['main_color']) && !empty($_GET['main_color'])) {
            setcookie('theme_main_color', $_GET['main_color'], null, '/');
            $_COOKIE['theme_main_color'] = $_GET['main_color'];
            $main_color = $_COOKIE['theme_main_color'];
        }

        if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_main_color']) && !empty($_COOKIE['theme_main_color'])) {
            $main_color = $_COOKIE['theme_main_color'];
        }
    }
    ?>
    <?php if (1 == 2): //fake <style> tag, reguired only for editor formatting, please don't remove ?>
    <style>
<?php endif; ?>

    <?php if (ot_get_option('main_body_background_color')): ?>
    .
    page-wrapper,
    header {
    background:
<?php echo ot_get_option('main_body_background_color'); ?>
}
<?php endif; ?>

    <?php if ($main_color): ?>
    /* main_color */
	a,
	#upper-header .menu>li:hover>a, 
	#upper-header .cart-menu-item:before, 
	.page-heading.style3 .breadcrumbs .current, 
	.accordion-active .accordion-header h5, 
	blockquote span, 
	blockquote span a,
	span.post-day, 
	.iconic-input .icons, 
	.project.light:hover .project-meta h4, 
	.project.light:hover .project-meta h4 a, 
	.tab-header ul li.active-tab a, 
	.table-price .price-main, 
	.table-price .price-secondary, 
	.testimonial-quote, 
	.testimonial-slide span.job, 
	.sidebar .categories a:hover, 
	.widget>ul li a:hover, 
	.light-blue,
	.team-member .job-title,
	
	.headerstyle1 #main-nav li ul li.current-menu-item>a, 
	.headerstyle1 #main-nav li ul li.current-menu-ancestor>a, 
	.headerstyle1 #header div.menu>ul li ul li.current-menu-item>a, 
	.headerstyle1 #header div.menu>ul li ul li.current-menu-ancestor>a, 
	.headerstyle1 #main-nav li ul li:hover>a, 
	.headerstyle1 #header div.menu>ul li ul li:hover>a, 
	.headerstyle5 #main-nav li ul li.current-menu-item>a, 
	.headerstyle5 #main-nav li ul li.current-menu-ancestor>a, 
	.headerstyle5 #header div.menu>ul li ul li.current-menu-item>a, 
	.headerstyle5 #header div.menu>ul li ul li.current-menu-ancestor>a, 
	.headerstyle5 #main-nav li ul li:hover>a, 
	.headerstyle5 #header div.menu>ul li ul li:hover>a, 
	.headerstyle8 #main-nav li ul li.current-menu-item>a, 
	.headerstyle8 #main-nav li ul li.current-menu-ancestor>a, 
	.headerstyle8 #header div.menu>ul li ul li.current-menu-item>a, 
	.headerstyle8 #header div.menu>ul li ul li.current-menu-ancestor>a, 
	.headerstyle8 #main-nav li ul li:hover>a, 
	.headerstyle8 #header div.menu>ul li ul li:hover>a,
	
	#header.style3 #lower-header #main-nav li ul li.current-menu-item>a, 
	#header.style3 #lower-header #main-nav li ul li.current-menu-ancestor>a, 
	#header.style4 #lower-header #main-nav li ul li.current-menu-item>a, 
	#header.style4 #lower-header #main-nav li ul li.current-menu-ancestor>a, 
	#header.style3 #lower-header div.menu>ul li ul li.current-menu-item>a, 
	#header.style3 #lower-header div.menu>ul li ul li.current-menu-ancestor>a, 
	#header.style4 #lower-header div.menu>ul li ul li.current-menu-item>a, 
	#header.style4 #lower-header div.menu>ul li ul li.current-menu-ancestor>a,
	
	.shop-filters span.active, .shop-filters span:hover,
	.shop-product .product-info .price.blue,
	.shop-product-details .price, 
	.shop-product-details .price ins .amount, 
	.recently-viewed-product .product-info ins, 
	.shop-products-recommend .item .price ins, 
	.cart-subtotal .price.blue,
	
	ul.sidenav li:hover a, 
	ul.sidenav li.current-menu-item a, 
	.sidebar .widget_nav_menu ul li:hover a, 
	.sidebar .widget_nav_menu ul li.current-menu-item a, 
	.faq-filters li.active, 
	.faq-filters li:hover
	{
        color: <?php echo $main_color; ?>;
    }
	
	ul.arrow-list a:hover, 
	.shop-footer .shop-widget ul a:hover {
		color: <?php echo $main_color; ?>;
		border-bottom: 1px solid <?php echo $main_color; ?>;
	}
	
	#main-nav .mega-menu li:hover>a {
        color: <?php echo $main_color; ?> !important;
    }
	
    a.button, 
	.blue-bg, 
	.get-in-touch.light input[type="submit"], 
	.service-icon, 
	.featured .table-header, 
	.widget_calendar #today, 
	.audio-play-button, 
	.post-image-gallery a.flex-prev:hover, 
	.post-image-gallery a.flex-next:hover,
	#search-box .iconic-submit:hover .icon, 
	.tweet-icon, 
	input.blue[type="submit"], 
	button.blue, 
	.style2 .tab-header ul li.active-tab
    {
        background-color: <?php echo $main_color; ?>;
    }

	a.button:hover, 
	input[type="submit"].blue:hover, 
	.get-in-touch.light input[type="submit"]:hover {
		background-color: <?php echo ts_change_color($main_color, 10); ?>;
	}
	
	.service-icon .icons, 
	.style2 .tab-header ul li.active-tab .icons, 
	.blue-bg .icons, 
	.darker-blue-bg p, 
	.darker-blue-bg .icons {
		color: <?php echo ts_change_color($main_color, 60); ?>;
	}
	
	.service .content_box, 
	span.testimonial-job, 
	.sorting-tags div.filter.active, 
	.sorting-tags div.filter:hover {
		color: <?php echo ts_change_color($main_color, 20); ?>;
	}
	
	.services-list li {
		border-bottom-color: <?php echo $main_color; ?>;
	}
	
	.tab-header ul li.active-tab, 
	.featured .table-header:after {
		border-top-color: <?php echo $main_color; ?>;
	}
	
	ul.sidenav li:hover:after, 
	ul.sidenav li.current-menu-item:after, 
	.sidebar .widget_nav_menu ul li:hover:after, 
	.sidebar .widget_nav_menu ul li.current-menu-item:after {
		border-right-color: <?php echo $main_color; ?>;
	}
	
	.tweet-icon:after {
		border-color: <?php echo $main_color; ?> transparent transparent;
	}
	
	<?php
	$main_color_lighter = ts_change_color($main_color, 10);
	?>
	
	.alternate-slider-bg {
		background-image: -webkit-gradient(
		  linear, right top, left top, from(<?php echo ts_hex_to_rgb($main_color,'0.8'); ?>),
		  to(<?php echo ts_hex_to_rgb($main_color_lighter, '0.8'); ?>)
		);
		background-image: -moz-linear-gradient(
		  right center,
		  <?php echo ts_hex_to_rgb($main_color,'0.8'); ?> 20%, <?php echo ts_hex_to_rgb($main_color_lighter,'0.8'); ?> 95%
		);
		filter: progid:DXImageTransform.Microsoft.gradient(
		  gradientType=1, startColor=<?php echo $main_color; ?>, endColorStr=<?php echo $main_color_lighter; ?>
		);
		-ms-filter: progid:DXImageTransform.Microsoft.gradient(
		  gradientType=1, startColor=<?php echo $main_color; ?>, endColorStr=<?php echo $main_color_lighter; ?>
		);
	}

<?php endif; ?>

    <?php if (ot_get_option('main_body_text_color')): ?>
    /* main_body_text_color */
		body {
			color: <?php echo ot_get_option('main_body_text_color'); ?>
		;
		}
	<?php endif; ?>

    <?php if (ot_get_option('header_background_color')): ?>
		/* header_background_color */
		#main-header, 
		#lower-header {
			background-color: <?php echo ot_get_option('header_background_color'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('page_title_background_color')): ?>
		/* page_title_background_color */
		.page-header {
			background-color: <?php echo ot_get_option('page_title_background_color'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('menu_background_color')): ?>
		/* menu_background_color */
		#lower-header,
		body.b1170 #lower-header>.container, 
		body.b960 #lower-header>.container, 
		#header.style3 #lower-header, 
		#header.style4 #lower-header, 
		#header.style5 #lower-header, 
		#header.style6 #lower-header {
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('menu_background_color'),'.67'); ?>;
		}
		
		body.b1170 #header.style2 #main-header>.container, 
		body.b960 #header.style2 #main-header>.container, 
		#header.style2 #main-header, 
		#header.style8 #main-header {
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('menu_background_color'),'.56'); ?>;
		}
		
	<?php endif; ?>
		
	<?php if (ot_get_option('sub_menu_background_color')): ?>
		
		.headerstyle1 #main-nav li ul li a, 
		.headerstyle1 #header div.menu>ul li ul li a, 
		.headerstyle5 #main-nav li ul li a, 
		.headerstyle5 #header div.menu>ul li ul li a, 
		.headerstyle8 #main-nav li ul li a, 
		.headerstyle8 #header div.menu>ul li ul li a,
		
		.headerstyle1 #main-nav li ul li.current-menu-item>a, 
		.headerstyle1 #main-nav li ul li.current-menu-ancestor>a, 
		.headerstyle1 #header div.menu>ul li ul li.current-menu-item>a, 
		.headerstyle1 #header div.menu>ul li ul li.current-menu-ancestor>a, 
		.headerstyle1 #main-nav li ul li:hover>a, 
		.headerstyle1 #header div.menu>ul li ul li:hover>a, 
		.headerstyle5 #main-nav li ul li.current-menu-item>a, 
		.headerstyle5 #main-nav li ul li.current-menu-ancestor>a, 
		.headerstyle5 #header div.menu>ul li ul li.current-menu-item>a, 
		.headerstyle5 #header div.menu>ul li ul li.current-menu-ancestor>a, 
		.headerstyle5 #main-nav li ul li:hover>a, 
		.headerstyle5 #header div.menu>ul li ul li:hover>a, 
		.headerstyle8 #main-nav li ul li.current-menu-item>a, 
		.headerstyle8 #main-nav li ul li.current-menu-ancestor>a, 
		.headerstyle8 #header div.menu>ul li ul li.current-menu-item>a, 
		.headerstyle8 #header div.menu>ul li ul li.current-menu-ancestor>a, 
		.headerstyle8 #main-nav li ul li:hover>a, 
		.headerstyle8 #header div.menu>ul li ul li:hover>a,
		
		.headerstyle1 #main-nav .mega-menu>ul, 
		.headerstyle4 #main-nav .mega-menu>ul, 
		.headerstyle5 #main-nav .mega-menu>ul, 
		.headerstyle8 #main-nav .mega-menu>ul, 
		
		#main-nav .mega-menu>ul, 
		#main-nav .mega-menu-footer, 
		.headerstyle1 #main-nav .mega-menu-footer, 
		.headerstyle4 #main-nav .mega-menu-footer, 
		.headerstyle5 #main-nav .mega-menu-footer, 
		.headerstyle8 #main-nav .mega-menu-footer
		{
			background-color: <?php echo ot_get_option('sub_menu_background_color'); ?>;
		}
		
		#main-nav li ul li a, 
		#header div.menu>ul li ul li a {
			background: <?php echo ot_get_option('sub_menu_background_color'); ?>;
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('sub_menu_background_color'),'.89'); ?>;
		}
		
		
		#header.style3 #lower-header #main-nav li ul li.current-menu-item>a, 
		#header.style3 #lower-header #main-nav li ul li.current-menu-ancestor>a, 
		#header.style4 #lower-header #main-nav li ul li.current-menu-item>a, 
		#header.style4 #lower-header #main-nav li ul li.current-menu-ancestor>a, 
		#header.style3 #lower-header div.menu>ul li ul li.current-menu-item>a, 
		#header.style3 #lower-header div.menu>ul li ul li.current-menu-ancestor>a, 
		#header.style4 #lower-header div.menu>ul li ul li.current-menu-item>a, 
		#header.style4 #lower-header div.menu>ul li ul li.current-menu-ancestor>a,
		
		#main-nav li ul li:hover>a, 
		#header div.menu>ul li ul li:hover>a, 
		
		#main-nav li ul li.current-menu-item>a, 
		#main-nav li ul li.current-menu-ancestor>a, 
		#header div.menu>ul li ul li.current-menu-item>a, 
		#header div.menu>ul li ul li.current-menu-ancestor>a
		{
			background: <?php echo ot_get_option('sub_menu_background_color'); ?>;
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('sub_menu_background_color'),'.95'); ?>;
		}
		
	<?php endif; ?>

    <?php if (ot_get_option('headers_text_color')): ?>
		/* headers_text_color */
		#main-content h1,
		#main-content h2,
		#main-content h3,
		#main-content h4,
		#main-content h5,
		#main-content h6 {
			color: <?php echo ot_get_option('headers_text_color'); ?>;
		}
	<?php endif; ?>
    <?php /* if (ot_get_option('preheader_background_color')): ?>
		/* preheader_background_color * /
		#preheader,
		#preheader .top-menu li ul {
			background-color: <?php echo ot_get_option('preheader_background_color'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('preheader_text_color')): ?>
		/* preheader_text_color * /
		#preheader span,
		#preheader .top-menu a {
			color: <?php echo ot_get_option('preheader_text_color'); ?> !important;
		}
	<?php endif; */ ?>

    <?php if (ot_get_option('footer_background_color')): ?>
		/* footer_background_color */
		#main-footer {
			background-color: <?php echo ot_get_option('footer_background_color'); ?>;
		}
		
		#main-footer input[type="text"], 
		#main-footer input[type="password"], 
		#main-footer textarea {
			background-color:  <?php echo ts_change_color(ot_get_option('footer_background_color'),10); ?>;
		}
		
		#main-footer input[type="text"]:focus, 
		#main-footer input[type="password"]:focus, 
		#main-footer textarea:focus {
			background-color:  <?php echo ts_change_color(ot_get_option('footer_background_color'),15); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('footer_headers_color')): ?>
		#footer h4 {
			color: <?php echo ot_get_option('footer_headers_color'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('footer_main_text_color')): ?>
		/* footer_main_text_color */
		#main-footer, 
		#main-footer .blog-post .post-title {
			color: <?php echo ot_get_option('footer_main_text_color'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('copyrights_bar_background')): ?>
		/* copyrights_bar_background */
		#lower-footer {
			background-color: <?php echo ot_get_option('copyrights_bar_background'); ?>;
		}
	<?php endif; ?>

    <?php if (ot_get_option('copyrights_bar_text_color')): ?>
		/* copyrights_bar_text_color */
		#lower-footer {
			color: <?php echo ot_get_option('copyrights_bar_text_color'); ?>;
		}
	<?php endif; ?>

    <?php if (1 == 2): //fake </style> tag, reguired only for editor formatting, please don't remove ?>
    </style>
<?php endif; ?>
    <?php
    if ($ajax_request === true) {
        die();
    }
}

function ts_the_theme_dynamic_styles_ajax_request()
{
    ts_the_theme_dynamic_styles(true);
}

add_action('wp_ajax_nopriv_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request');
add_action('wp_ajax_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request');


if (!function_exists('ts_theme_navi')):

    /**
     * Posts annd search pagination
     *
     * @since marine 1.0
     */
    function ts_theme_navi()
    {
        $args = array(
            'container' => 'ul',
            'container_id' => 'pager',
            'container_class' => 'post-pagination',
            'items_wrap' => '<li class="%s"><span></span>%s</li>',
            'item_class' => '',
            'item_active_class' => '',
            'list_item_active_class' => 'active',
            'item_prev_class' => 'prev-page',
            'item_next_class' => 'next-page',
            'prev_text' => '',
            'next_text' => ''
        );
        ts_wp_custom_corenavi($args);
    }
endif; //ends check for theme_navi

if (!function_exists('ts_get_theme_navi_array')):

    /**
     * Get Posts annd search pagination array
     *
     * @since marine 1.0
     */
    function ts_get_theme_navi_array()
    {
        $args = array(
            'container' => '',
            'container_id' => 'pager',
            'container_class' => 'clearfix',
            'items_wrap' => '%s',
            'item_class' => 'page',
            'item_active_class' => 'active',
            'item_prev_class' => 'prev-page',
            'item_next_class' => 'next-page',
            'prev_text' => '',
            'next_text' => '',
            'next_prev_only' => false,
            'type' => 'array'
        );
        return ts_wp_custom_corenavi($args);
    }
endif; //ends check for theme_navi

if (!function_exists('ts_get_theme_next_page_url')):

    /**
     * Get next page url
     *
     * @since marine 1.0
     */
    function ts_get_theme_next_page_url()
    {
        $args = array(
            'container' => '',
            'container_id' => 'pager',
            'container_class' => 'clearfix',
            'items_wrap' => '%s',
            'item_class' => 'page',
            'item_active_class' => 'active',
            'item_prev_class' => 'prev-page',
            'item_next_class' => 'next-page',
            'prev_text' => '',
            'next_text' => '',
            'next_prev_only' => true,
            'type' => 'array'
        );
        $pages = ts_wp_custom_corenavi($args);

		if (isset($pages['links']['next'])) {
            preg_match('/href="(.*)"/', $pages['links']['next'], $matches);

            if (isset($matches[1]) && !empty($matches[1])) {
                return $matches[1];
            }
        }
        return false;
    }
endif;

if (!function_exists('ts_get_theme_prev_page_url')):

    /**
     * Get prev page url
     *
     * @since marine 1.0
     */
    function ts_get_theme_prev_page_url()
    {
        $args = array(
            'container' => '',
            'container_id' => 'pager',
            'container_class' => 'clearfix',
            'items_wrap' => '%s',
            'item_class' => 'page',
            'item_active_class' => 'active',
            'item_prev_class' => 'prev-page',
            'item_next_class' => 'next-page',
            'prev_text' => '',
            'next_text' => '',
            'next_prev_only' => true,
            'type' => 'array'
        );
        $pages = ts_wp_custom_corenavi($args);
		
		if (isset($pages['links']['prev'])) {
            preg_match('/href="(.*)"/', $pages['links']['prev'], $matches);

            if (isset($matches[1]) && !empty($matches[1])) {
                return $matches[1];
            }
        }
        return false;
    }
endif;

if (!function_exists('ts_the_marine_navi')):

    /**
     * Show corp navi
     *
     * @since marine 1.0
     */
    function ts_the_marine_navi()
    {
        $pagination = ts_get_theme_navi_array();
        if (is_array($pagination['links']) && count($pagination['links']) > 0) {
            ?>
            <ul class='post-pagination'>
                <?php foreach ($pagination['links'] as $key => $item): ?>

                    <?php if ($key == 'prev' || $key == 'next'): ?>
                        <li>
                            <?php echo $item; ?>
                        </li>
                    <?php else: ?>
                        <li <?php echo($pagination['active'][(int)$key] === true ? 'class="active"' : '') ?>>
                            <span></span>
                            <?php echo $item; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php
        }
    }
endif; //ends check for theme_navi

function ts_the_breadcrumbs($delimiter=null)
{

    /* === OPTIONS === */
    $text['home'] = __('Home', 'marine'); // text for the 'Home' link
    $text['category'] = __('Archive by Category "%s"', 'marine'); // text for a category page
    $text['search'] = __('Search Results for "%s" Query', 'marine'); // text for a search results page
    $text['tag'] = __('Posts Tagged "%s"', 'marine'); // text for a tag page
    $text['author'] = __('Posts by %s', 'marine'); // text for an author page
    $text['404'] = __('404 Page Not Found', 'marine'); // text for the 404 page

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    if(empty($delimiter)){
        $delimiter = '<span class="delimiter">|</span> '; // delimiter between crumbs
    }

    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<span typeof="v:Breadcrumb">';
    $linkAfter = '</span>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1) echo '<p class="breadcrumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></p>';

    } else {

        echo '<p class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

        if (function_exists('is_shop') && is_shop()) {
            echo $before . __('Shop', 'marine') . $after;
        } else if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif (is_search()) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif (is_day()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());

                if ($post_type->query_var == 'product') {
                    $label = __('Shop', 'marine');
                } else {
                    $label = $post_type->labels->singular_name;
                }
                $slug = $post_type->rewrite;

                $portfolio_page_id = null;
                if (get_post_type() == 'portfolio') {
                    $portfolio_page_id = ot_get_option('portfolio_page');
                }
                if (!empty($portfolio_page_id)) {
                    echo '<a href="' . get_permalink($portfolio_page_id) . '">' . get_the_title($portfolio_page_id) . '</a>';
                } else {
                    printf($link, get_post_type_archive_link($post_type->name), $label);
                }
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = isset($cat[0]) ? $cat[0] : null;
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = isset($cat[0]) ? $cat[0] : null;
            $cats = get_category_parents($cat, TRUE, $delimiter);
            if (!is_wp_error($cats)) {
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                printf($link, get_permalink($parent), $parent->post_title);
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;

        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) echo $delimiter;
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif (is_tag()) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif (is_404()) {
            echo $before . $text['404'] . $after;
        }
        echo '</p>';

    }
}

/**
 * Get post slider
 * @since marine 1.0
 */
if (!function_exists('ts_get_post_slider')) {
    function ts_get_post_slider($post_id, $force_slider = null)
    {
		if ($force_slider == null) {
			$a = get_post_meta($post_id, 'post_slider', true);
		} else {
			$a = $force_slider;
		}

		//layerslider
        if (strstr($a, 'LayerSlider')) {
            $id = str_replace('LayerSlider-', '', $a);
            return do_shortcode('[layerslider id="' . $id . '"]');
		
		//revslider
        } else if (strstr($a, 'revslider')) {
            $id = str_replace('revslider-', '', $a);
            return do_shortcode('[rev_slider ' . $id . ']');
		
		//masterslider
        } else if (strstr($a, 'masterslider')) {
            $id = str_replace('masterslider-', '', $a);
            return do_shortcode('[masterslider id="' . $id . '"]');
        }
		
		//banner builder
        if (strstr($a, 'banner-builder')) {
            $id = str_replace('banner-builder-', '', $a);
            return td_get_banner($id);
        }
    }
}


/**
 * Share buttons
 * Can be included in the loop only
 * @since marine 1.0
 */

function ts_share_buttons($class = '')
{
    ?>
    <div class="ts-share">
        <ul class="social-icons style2 <?php echo $class; ?>">
            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <i class="icon-facebook-squared"></i>
                </a>
			</li>
            <li>
				<a target="_blank" class="fa fa-twitter twitter-share-button"
                   href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <i class="icon-twitter"></i>
				</a>
			</li>
            <li>
				<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>"
                   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<i class="icon-google"></i>
                </a>
            </li>
			<?php 
			$pin_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'pinterest' );
			if ($pin_image): ?>
				<li>
					<a target="_blank" href="http://pinterest.com/pin/create%2Fbutton/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode($pin_image[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<i class="icon-pinterest"></i>
					</a>
				</li>
			<?php endif; ?>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>&summary=<?php echo urlencode(ts_get_the_excerpt_theme(10)); ?>&source=<?php echo get_bloginfo( 'name' );?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=531,width=545');return false;">
					<i class="icon-linkedin"></i>
				</a>
			</li>	
        </ul>
    </div>

<?php
}

/**
 * Outputs the pre header
 * @param int $cols
 */
function ts_show_preheader()
{

    global $woocommerce;

    $preheader = ot_get_option('preheader');
	
    $show_preheader = ot_get_option('show_preheader');

	$show_post_preheader = get_post_meta(is_singular() ? get_the_ID() : null, 'show_preheader', true);
    if (in_array($show_post_preheader, array('yes', 'no'))) {
        $show_preheader = $show_post_preheader;
    }
	
    if ($show_preheader == 'yes' && is_array($preheader) && count($preheader) > 0): ?>


        <div id="upper-header">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <?php
                        $firstLeft = false;
                        $firstRight = false;
                        $left = 0;
                        $right = 0;

                        foreach ($preheader as $item):
                            if ($item['float'] == 'right'):
                                $right++;
                            endif;
                        endforeach;

                        $right2 = 0;
                        foreach (array('left', 'right') as $float):
                            foreach ($preheader as $item):

                                if ($item['float'] != $float):
                                    continue;
                                endif;

                                $class = '';
                                if ($firstLeft == false && $float == 'left'):
                                    $class = 'hidden-separator';
                                endif;

                                if ($float == 'right'):
                                    $right2++;
                                endif;

                                if ($float == 'right' && $right == $right2):
                                    $class = 'hidden-separator';
                                endif;
                                ?>
                                <div class="item <?php echo $float . ' ' . $class; ?>">
                                    <?php if (isset($item['icon']) && $item['icon'] != 'no'): ?>
                                        <span class="fa <?php echo $item['icon']; ?>"></span>
                                    <?php endif;
									
									$menu_id = null;
									if (strstr($item['type'],'menu_')) {
										$menu_id = str_replace('menu_', '', $item['type']);
										$item['type'] = 'menu';
									}
									
                                    switch ($item['type']):
                                        case 'date':
                                            echo date(get_option('date_format'));
                                            break;
										
                                        case 'login':
                                            echo '<a href="' . wp_login_url() . '">' . __('Login', 'marine') . '</a>';
                                            break;
										
                                        case 'cart':
                                            if (is_object($woocommerce)) { ?>
										
												<div class="cart-menu-item"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php echo $woocommerce->cart->cart_contents_count; ?> <?php _e('ITEMS(S)', 'marine');?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
													<div class="shopping-cart-dropdown">
														<?php if ( sizeof( WC()->cart->get_cart() ) == 0 ) { ?>
															<div class="sc-header">
																<h4><?php _e('Cart is empty', 'marine'); ?></h4>
															</div>
														<?php } else { ?>
															<div class="sc-header">
																<h4><?php echo sprintf(_n('%d item <span>in cart</span>', '%d items <span>in cart</span>', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></h4>
																<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?empty-cart=1" class="sc-remove-button"><i class="icons icon-cancel-circled"></i></a>
															</div>
															<div class="sc-content">
																<?php
																foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
																	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
																	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

																	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
																		?>
																		<div class="sc-item">
																			<div class="featured-image">
																				<?php
																					$image = wp_get_attachment_url( get_post_thumbnail_id($_product-> id) );
																					echo ts_get_resized_image_by_size($image, 'cart-thumb', $alt = '', false);
																				?>
																			</div>
																			<div class="item-info">
																				<?php
																				if ( ! $_product->is_visible() )
																					echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
																				else
																					echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="title">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
																				?>
																				
																				<span class="price">
																					<?php
																						echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
																					?>
																				</span>
																				
																				<?php // Meta data
																				echo WC()->cart->get_item_data( $cart_item ); ?>
																			</div>
																		</div>
																		<?php
																	} //if
																} //foreach ?>
																</div>
																<div class="sc-footer">
																	<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button unfilled black"><?php _e('View Cart', 'marine'); ?></a>
																	<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button"><?php _e('Checkout', 'marine'); ?></a>
																</div>
														<?php } ?>
													</div>
												</div>
                                            <?php }
                                            break;
                                        case 'language':
                                            _e('Language', 'marine');
                                            break;
										
										case 'menu':
											if (intval($menu_id)) {
												$defaults = array(
													'container'			=> false,
													'container_class'	=> 'menu',
													'fallback_cb'		=> '',
													'menu'				=> $menu_id,
													'depth' 			=> 1
												);
												wp_nav_menu( $defaults );
											}
											break;
											
                                        case 'social_icons':
                                            get_template_part('inc/social-icons');
                                            break;
										
										case 'search_icon': ?>
                                            <div id="search-box-pre">
												<i class="icons icon-search"></i>
												<form role="search" method="get" id="searchform-pre" action="<?php echo home_url(); ?>">
													<input type="text" name="s" placeholder="<?php _e('Search here..', 'marine'); ?>">
													<div class="iconic-submit">
														<div class="icon">
															<i class="icons icon-search"></i>
														</div>
														<input type="submit" value="">
													</div>
												</form>
											</div>
                                            <?php break;
										
                                        default:
                                            echo $item['text'];
                                    endswitch; ?>
                                </div>

                                <?php
                                if ($float == 'left') {
                                    $firstLeft = true;
                                }
                                ?>

                            <?php endforeach;
                        endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif;
}

/**
 * WooCoomerce recently viewed
 * @global type $product
 * @return type
 */
function ts_woocommerce_recently_viewed() {
	
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

	if ( empty( $viewed_products ) )
		return;

	$query_args = array( 
		'posts_per_page' => 6, 
		'no_found_rows' => 1, 
		'post_status' => 'publish', 
		'post_type' => 'product', 
		'post__in' => $viewed_products, 
		'orderby' => 'rand' 
	);

	$query_args['meta_query'] = array();
	$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	$query_args['meta_query'] = array_filter( $query_args['meta_query'] );
	
	$r = new WP_Query($query_args);

	if ( $r->have_posts() ): 
		
		 ?>

		<!-- Recently Viewed -->
		<section class="section full-width-bg normal-padding light-gray-bg">

			<div class="row">

				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="recent-products-header">
						<h5><strong><?php _e('RECENTLY VIEWED', 'marine'); ?></strong><i class="icons icon-angle-down"></i></h5>
						<a href="#" class="clear-recent-products"><i class="icons icon-cancel-circled"></i> <?php _e('Clear All', 'marine'); ?></a>
					</div>
				</div>
				<?php while ( $r->have_posts()):
					$r->the_post(); 
					global $product;
				?>
					<div class="col-lg-2 col-md-3 col-sm-4">
						<!-- Shop Product -->
						<div class="recently-viewed-product">
							<div class="featured-image">
								<a href="#" class="remove-product-button" data-id="<?php echo $product->id; ?>"><i class="icons icon-cancel-circled"></i></a>
								<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_image(); ?></a>
								<div class="product-buttons">
									<a href="#" class="button"><?php _e('Save for later', 'marine'); ?></a>
								</div>
							</div>
							<div class="product-info">
								<span><?php echo $product->get_title(); ?></span>
								<?php echo $product->get_price_html(); ?>
							</div>
						</div>
						<!-- /Shop Product -->
					</div>
				<?php endwhile; ?>
			</div>
		</section>
		<!-- /Recently Viewed -->
	
	<?php endif;
	wp_reset_postdata();
}

function ts_post_icon() {
	$xs_post_format = get_post_format();
	switch ($xs_post_format) {
		case 'video':
			echo '<span class="video-icon"></span>';
			break;

		case 'image':
			echo '<span class="photo-icon"></span>';
			break;

		case 'audio':
			echo '<span class="audio-icon"></span>';
			break;

		case 'link':
			echo '<span class="link-icon"></span>';
			break;

		default:
			echo '<span class="document-icon"></span>';
			break;

	}
}