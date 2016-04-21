<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package marine
 * @since marine 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0'>
        <title><?php
            /*
             * Print the <title> tag based on what is being viewed.
             */

            global $page, $paged;
			
            wp_title('|', true, 'right');

            // Add the blog name.
            bloginfo('name');
			
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page()))
                echo " | $site_description";

            // Add a page number if necessary:
            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', 'marine'), max($paged, $page));
            ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <?php if (ot_get_option('favicon')) : ?>
            <link rel="shortcut icon" href="<?php echo ot_get_option('favicon') ?>" type="image/x-icon"/>
        <?php endif; ?>
        <?php echo ot_get_option('scripts_header'); ?>
        <?php wp_head(); ?>		
    </head>
<body <?php body_class(); ?>>

<!-- Marine Conten Wrapper -->
<div id="marine-content-wrapper">

<?php if (ot_get_option('control_panel') == 'enabled_admin' && current_user_can('manage_options') || ot_get_option('control_panel') == 'enabled_all'): ?>
    <?php get_template_part('framework/control-panel'); ?>
<?php endif; ?>

<?php
switch (ts_get_main_menu_style()) {
  
    case 'style2':
        get_template_part('inc/header-2');
        break;

    case 'style3':
        get_template_part('inc/header-3');
        break;

    case 'style4':
        get_template_part('inc/header-4');
        break;

    case 'style5':
        get_template_part('inc/header-5');
        break;

	case 'style6':
        get_template_part('inc/header-6');
		break;
	
    case 'style7':
        get_template_part('inc/header-7');
        break;
	
	case 'style8':
        get_template_part('inc/header-8');
        break;
	
	case 'style9':
        get_template_part('inc/header-9');
        break;
	
	case 'style10':
        get_template_part('inc/header-10');
        break;
	
	case 'style11':
        get_template_part('inc/header-11');
        break;
	
	case 'style12':
        get_template_part('inc/header-12');
        break;
	
    case 'style1':
    default:
        get_template_part('inc/header-1');
        break;
}
?>



<!-- Marine Content Inner -->
<div id="marine-content-inner">



    <!-- Main Content -->
    <section id="main-content">
        <!-- Container -->
        <div class="container">
			<?php if(get_post_type($post) != 'portfolio'):
				
				$slider_id = null;
				if (is_tax('product_cat')):
					$term_meta = get_option('taxonomy_'.get_queried_object()->term_id.'_metas');
					if (isset($term_meta['slider']) && !empty($term_meta['slider'])):
						$slider_id = $term_meta['slider'];
					endif;
				elseif (function_exists('is_shop') && is_shop()):
					$slider_id = get_post_meta(wc_get_page_id( 'shop' ), 'post_slider', true);
				elseif (is_singular()):
					$slider_id = get_post_meta(get_the_ID(), 'post_slider', true);
				endif;
				
				if ($slider_id):
					get_template_part('inc/header-image');
				elseif (!function_exists('is_woocommerce') || !is_woocommerce()):
					get_template_part('inc/top');
				endif;
			endif;