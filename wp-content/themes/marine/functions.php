<?php
/**
 * marine functions and definitions
 *
 * @package marine
 * @since marine 1.0
 */
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter ( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter ( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter ( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once ('option-tree/ot-loader.php');

/**
 * Theme Options
 */
include_once ('inc/theme-options.php');
/**
 * Meta boxes + page builder
 */

include_once ('inc/meta-boxes.php');
include_once ('framework/page-builder.php');

/**
 * Framework functions
 */
include_once ('framework/framework.php');

/**
 * Installer
 */
include_once( 'framework/installer.php' );

/**
 * Widgets initalization
 */
include_once ('inc/widgets.php');

/**
 * Shortcodes initalization
 */
include_once ('inc/shortcodes.php');

/**
 * Third Party Plugins activation
 */
include_once ('framework/plugins-activation.php');

/**
 * Comment Walker Class
 */
include_once ('inc/Comment_Walker.class.php');

/**
 * Framework menus
 */
include_once ('framework/custom-menus.php');

/**
 * Framework menus
 */
include_once ('framework/class/ts_extra_taxonomy_fields.class.php');

/**
 * Sample data importer
 */
include_once ('framework/importer/importer.php');

/**
 * Featured image
 */
add_theme_support ( 'post-thumbnails' ); // enable
add_image_size ( 'pinterest', 735, 735, true );

// standard content
ts_add_theme_image_size ( 'full', 1170, 516, true );
ts_add_theme_image_size ( 'one-sidebar', 800, 320, true );
ts_add_theme_image_size ( 'alternate', 400, 320, true );
ts_add_theme_image_size ( 'blog-grid-img', 400, 320, true );
ts_add_theme_image_size ( 'person', 400, 381, true );
ts_add_theme_image_size ( 'slider', 800, 530, true );
ts_add_theme_image_size ( 'slider-thumb', 300, 200, true );
ts_add_theme_image_size ( 'blog-timeline-img', 800, 320, true );
ts_add_theme_image_size ( 'recent_posts_sc', 260, 260, true );
ts_add_theme_image_size ( 'two-sidebars', 566, 283, true );
ts_add_theme_image_size ( 'half-full', 578, 288, true );
ts_add_theme_image_size ( 'half-one-sidebar', 431, 215, true );
ts_add_theme_image_size ( 'half-two-sidebars', 283, 142, true );
ts_add_theme_image_size ( 'third-full', 385, 192, true );
ts_add_theme_image_size ( 'third-one-sidebar', 287, 143, true );
ts_add_theme_image_size ( 'third-two-sidebars', 188, 94, true );
ts_add_theme_image_size ( 'fourth-full', 289, 144, true );
ts_add_theme_image_size ( 'fourth-one-sidebar', 215, 107, true );
ts_add_theme_image_size ( 'fourth-two-sidebars', 141, 70, true );
ts_add_theme_image_size ( 'content-alternative', 468, 251, true );
ts_add_theme_image_size ( 'content-grid', 369, 241, true );
ts_add_theme_image_size ( 'blog-related', 72, 48, true );

// shortcodes
ts_add_theme_image_size ( 'testimonial', 81, 81, true );
ts_add_theme_image_size ( 'testimonials', 128, 128, true );
ts_add_theme_image_size ( 'featured_projects', 284, 203, true );
ts_add_theme_image_size ( 'featured_projects_full', 776, 404, true );
ts_add_theme_image_size ( 'featured_projects_2', 359, 197, true );
ts_add_theme_image_size ( 'featured_projects_3', 359, 197, true );
ts_add_theme_image_size ( 'featured_projects_3-3', 617, 338, true );
ts_add_theme_image_size ( 'featured_projects_3-4', 463, 254, true );
ts_add_theme_image_size ( 'featured_projects_4', 370, 296, true );
ts_add_theme_image_size ( 'person', 570, 543, true );
ts_add_theme_image_size ( 'person-slider-avatar', 100, 100, true );
ts_add_theme_image_size ( 'person-slider', 720, 578, true );
ts_add_theme_image_size ( 'project', 359, 234, true );
ts_add_theme_image_size ( 'latest-works', 387, 252, true );
ts_add_theme_image_size ( 'latest-posts', 272, 152, true );
ts_add_theme_image_size ( 'recent-news-big', 856, 346, true );

// Portfolio
ts_add_theme_image_size ( 'portfolio-1-col', 878, 312, true );
ts_add_theme_image_size ( 'portfolio-3-col', 388, 202, true );
ts_add_theme_image_size ( 'portfolio-single', 960, 422, true );
ts_add_theme_image_size ( 'portfolio-single-style1', 1920, 515, true ); // FULL WIDE in gallery
ts_add_theme_image_size ( 'portfolio-single-style2', 870, 475, true );
ts_add_theme_image_size ( 'portfolio-related', 140, 140, true );

// widgets
ts_add_theme_image_size ( 'latest-posts-widget', 72, 48, true );
ts_add_theme_image_size ( 'recent-works-widget', 77, 77, true );
ts_add_theme_image_size ( 'recent-works-slider-widget', 264, 172, true );
ts_add_theme_image_size ( 'multipost-widget', 50, 50, true );
ts_add_theme_image_size ( 'testimonials-widget', 80, 80, true );

//Shop
ts_add_theme_image_size('shop-slider', 270, 351, true);
ts_add_theme_image_size('cart-thumb', 80, 80, true);


/**
 * Woocommerce support
 */
add_theme_support ( 'woocommerce' );
/**
 * Exerpt length
 * Usage ts_the_excerpt_theme('short');
 */
define ( 'TINY_EXCERPT', 12 );
define ( 'SHORT_EXCERPT', 22 );
/**
 */
define ( 'REGULAR_EXCERPT', 40 );
define ( 'LONG_EXCERPT', 55 );

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 */
function woo_related_products_limit() {
    global $product;

    $args = array (
        'post_type' => 'product',
        'no_found_rows' => 1,
        'posts_per_page' => 4,
        'ignore_sticky_posts' => 1,
        // 'orderby' => $orderby,
        // 'post__in' => $related,
        'post__not_in' => array (
            $product->id
        )
    );
    return $args;
}

add_filter ( 'woocommerce_related_products_args', 'woo_related_products_limit' );

/**
 * Enable Retina Support
 */
function ts_theme_init() {
    if (! is_admin () && ot_get_option ( 'retina_support' ) == 'enabled') {
        define ( 'RETINA_SUPPORT', true );
    }
}

add_action ( 'init', 'ts_theme_init' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since marine 1.0
 */
if (! isset ( $content_width )) {
    $content_width = 848; /* pixels */
}

if (! function_exists ( 'ts_theme_setup' )) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since marine 1.0
     */
    function ts_theme_setup() {
        /**
         * Custom template tags for this theme.
         */
        require (get_template_directory () . '/inc/template-tags.php');

        /**
         * Custom functions that act independently of the theme templates
         */
        require (get_template_directory () . '/inc/tweaks.php');

        /**
         * Make theme available for translation
         */
        load_theme_textdomain ( 'marine', get_template_directory () . '/languages' );
        load_theme_textdomain ( 'framework', get_template_directory () . '/languages' );

        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support ( 'automatic-feed-links' );

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus ( array (
            'primary' => __ ( 'Primary Menu', 'marine' ),
            'footer' => __ ( 'Footer Menu', 'marine' ),
            'shop-header'=>__('Shop Header','marine')
        ) );

        add_editor_style ( 'css/main.css' );
    }

endif; // theme_setup
add_action ( 'after_setup_theme', 'ts_theme_setup' );

if (! function_exists ( 'ts_theme_activation' )) :
    /**
     * Runs on theme activation
     *
     * @since marine 1.0
     */
    function ts_theme_activation() {
        global $wpdb;

        $table = $wpdb->get_var ( "SHOW TABLES LIKE '" . $wpdb->prefix . "fs_sliders'" );
        if (! strstr ( $table, 'fs_sliders' )) {
            $wpdb->query ( "
		   CREATE TABLE `" . $wpdb->prefix . "fs_sliders` (
			`slider_id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(64) NOT NULL,
			`created_date` int(11) NOT NULL,
			`animation` varchar(32) NOT NULL,
			`direction` varchar(32) NOT NULL,
			`slideshow_speed` int(10) unsigned NOT NULL,
			`animation_speed` int(10) unsigned NOT NULL,
			`background` varchar(512) NOT NULL,
			`reverse` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`randomize` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`control_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`direction_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (`slider_id`)
		  ) ENGINE=MyISAM;
		" );
        }
        $table = $wpdb->get_var ( "SHOW TABLES LIKE '" . $wpdb->prefix . "fs_slides'" );
        if (! strstr ( $table, 'fs_slides' )) {
            $wpdb->query ( "
		   CREATE TABLE `" . $wpdb->prefix . "fs_slides` (
			`slide_id` int(11) NOT NULL AUTO_INCREMENT,
			`slider_id` int(11) NOT NULL,
			`image` varchar(255) NOT NULL,
			`show_order` int(10) unsigned NOT NULL,
			`update_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (`slide_id`),
			KEY `slider_id` (`slider_id`)
		  ) ENGINE=MyISAM;
		 " );
        }
    }

endif; // theme_activation
add_action ( 'after_switch_theme', 'ts_theme_activation' );

/**
 * Enable support for Post Formats for post edit form
 * Formats depends on post type here
 */
function ts_set_custom_post_formats() {
    $postType = '';
    if (isset ( $_GET ['post'] )) {
        $postType = get_post_type ( $_GET ['post'] );
    }

    if ($postType == 'portfolio' || (isset ( $_GET ['post_type'] ) && $_GET ['post_type'] == 'portfolio')) {
        add_theme_support ( 'post-formats', array (
            'gallery',
            'video'
        ) );
        add_post_type_support ( 'portfolio', 'post-formats' );
    } else {
        add_theme_support ( 'post-formats', array (
            'aside',
            'gallery',
            'image',
            'audio',
            'video',
            'quote',
            'status'
        ) );
    }
}

add_action ( 'load-post.php', 'ts_set_custom_post_formats' );
add_action ( 'load-post-new.php', 'ts_set_custom_post_formats' );

/**
 * Reset post formats for public part of the website
 * Using set_custom_ost_formats() is not enough, it sets only formats for post edit form
 */
function ts_reset_post_formats() {
    add_theme_support ( 'post-formats', array (
        'aside',
        'gallery',
        'image',
        'audio',
        'video',
        'quote',
        'status'
    ) );
    add_post_type_support ( 'portfolio', 'post-formats' );
}

add_action ( 'after_setup_theme', 'ts_reset_post_formats' );

/**
 * Register post type
 *
 * @since marine 1.0
 */
add_action ( 'init', 'ts_register_theme_post_types' );
function ts_register_theme_post_types() {
    register_post_type ( 'portfolio', array (
        'labels' => array (
            'name' => __ ( 'Portfolio', 'marine' ),
            'singular_name' => __ ( 'Portfolio', 'marine' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array (
            'slug' => __ ( 'portfolio-item', 'marine' )
        ),
        'supports' => array (
            'title',
            'editor',
            // 'author',
            'thumbnail',
            // 'excerpt',
            'comments'
        )
    ) );

    register_taxonomy ( "portfolio-categories", array (
        "portfolio"
    ), array (
        "hierarchical" => true,
        "label" => __ ( "Categories", 'marine' ),
        "singular_label" => __ ( "Category", 'marine' ),
        "rewrite" => true
    ) );

    register_post_type ( 'faq', array (
        'labels' => array (
            'name' => __ ( 'FAQ', 'marine' ),
            'singular_name' => __ ( 'FAQ', 'marine' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => true,
        'supports' => array (
            'title',
            'editor',
            'page-attributes'
        )
    ) );

    register_taxonomy ( "faq-categories", array (
        "faq"
    ), array (
        "hierarchical" => true,
        "label" => __( "Categories", 'marine' ),
		"singular_label" => __( "Category", 'marine' ),
        "rewrite" => true
    ) );

    register_post_type ( 'team', array (
        'labels' => array (
            'name' => __ ( 'Team Members', 'marine' ),
            'singular_name' => __ ( 'Team Member', 'marine' ),
            'add_new' => __ ( 'Add New', 'marine' ),
            'add_new_item' => __ ( 'Add New Team Member', 'marine' ),
            'edit_item' => __ ( 'Edit Team Member', 'marine' ),
            'new_item' => __ ( 'New Team Member', 'marine' ),
            'all_items' => __ ( 'All Team Members', 'marine' ),
            'view_item' => __ ( 'View Team Member', 'marine' ),
            'search_items' => __ ( 'Search Team Members', 'marine' ),
            'not_found' => __ ( 'No team members found', 'marine' ),
            'not_found_in_trash' => __ ( 'No team member found in Trash', 'marine' ),
            'parent_item_colon' => '',
            'menu_name' => __ ( 'Team Members', 'marine' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => true,
        'capability_type' => 'page',
        'supports' => array (
            'title',
            'editor',
            // 'author',
            'thumbnail',
            // 'excerpt',
            // 'comments'
            'page-attributes'
        )
    ) );

    register_post_type ( 'testimonial', array (
        'labels' => array (
            'name' => __ ( 'Testimonials', 'marine' ),
            'singular_name' => __ ( 'Testimonial', 'marine' ),
            'add_new' => __ ( 'Add New', 'marine' ),
            'add_new_item' => __ ( 'Add New Testimonials', 'marine' ),
            'edit_item' => __ ( 'Edit Testimonials', 'marine' ),
            'new_item' => __ ( 'New Testimonials', 'marine' ),
            'all_items' => __ ( 'All Testimonials', 'marine' ),
            'view_item' => __ ( 'View Testimonials', 'marine' ),
            'search_items' => __ ( 'Search Testimonials', 'marine' ),
            'not_found' => __ ( 'No Testimonials found', 'marine' ),
            'not_found_in_trash' => __ ( 'No Testimonials found in Trash', 'marine' ),
            'parent_item_colon' => '',
            'menu_name' => __ ( 'Testimonials', 'marine' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => true,
        'capability_type' => 'page',
        'supports' => array (
            'title',
            'editor',
            // 'author',
            'thumbnail',
            // 'excerpt',
            // 'comments'
            'page-attributes'
        )
    ) );
	
	register_taxonomy ( "testimonial-category", 
		array (
			"testimonial"
		), 
		array (
			"hierarchical" => true,
			"label" => __( "Categories", 'marine' ),
			"singular_label" => __( "Category", 'marine' ),
			"rewrite" => true
		) 
	);
	
	register_post_type ( 'food_menu', array (
        'labels' => array (
            'name' => __ ( 'Food Menu', 'marine' ),
            'singular_name' => __ ( 'Food Menu', 'marine' ),
            'add_new' => __ ( 'Add New', 'marine' ),
            'add_new_item' => __ ( 'Add New Item', 'marine' ),
            'edit_item' => __ ( 'Edit Item', 'marine' ),
            'new_item' => __ ( 'New Items', 'marine' ),
            'all_items' => __ ( 'All Items', 'marine' ),
            'view_item' => __ ( 'View Items', 'marine' ),
            'search_items' => __ ( 'Search Items', 'marine' ),
            'not_found' => __ ( 'No Items found', 'marine' ),
            'not_found_in_trash' => __ ( 'No Items found in Trash', 'marine' ),
            'parent_item_colon' => '',
            'menu_name' => __ ( 'Food Menu', 'marine' )
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => true,
        'capability_type' => 'page',
        'supports' => array (
            'title',
            'editor',
            'thumbnail',
            'page-attributes'
        )
    ) );
	
	register_taxonomy ( "menu-categories", array (
        "food_menu"
    ), array (
        "hierarchical" => true,
        "label" => __( "Categories", 'marine' ),
        "singular_label" => "Category",
        "rewrite" => true
    ) );
}


add_action( 'admin_head-edit-tags.php', 'ts_remove_menu_parent_category' );
/**
 * Removing parent category dropdown from menu custom post type category
 * @return type
 */
function ts_remove_menu_parent_category()
{
	// don't run in the Tags screen
    if ( 'menu-categories' != $_GET['taxonomy'] )
        return;

    //New Category
    $parent = 'parent()';

    //Edit Category
    if ( isset( $_GET['action'] ) )
        $parent = 'parent().parent()';

    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
                $('label[for=parent]').<?php echo $parent; ?>.remove();       
            });
        </script>
    <?php
}

/**
 * Modify title placeholder for custom post types
 *
 * @since marine 1.0
 */
add_filter ( 'enter_title_here', 'ts_custom_enter_title' );
function ts_custom_enter_title($input) {
    global $post_type;

    if (is_admin () && 'team' == $post_type) {
        return __ ( 'Enter team member name here', 'marine' );
    }
    return $input;
}

/**
 * Enqueue scripts and styles
 *
 * @since marine 1.0
 */
function ts_theme_scripts() {
    wp_register_style ( 'twitter-bootstrap', get_template_directory_uri () . '/css/bootstrap.min.css', array (), null, 'all' );
    wp_register_style ( 'fontello', get_template_directory_uri () . '/css/fontello.css', array (), null, 'all' );
    wp_register_style ( 'prettyphoto-css', get_template_directory_uri () . '/js/prettyphoto/css/prettyPhoto.css', array (), null, 'all' );
    wp_register_style ( 'animation', get_template_directory_uri () . '/css/animation.css', array (), null, 'all' );
    wp_register_style ( 'flexSlider', get_template_directory_uri () . '/css/flexslider.css', array (), null, 'all' );
    wp_register_style ( 'nouislider', get_template_directory_uri () . '/css/jquery.nouislider.css', array (), null, 'all' );
    wp_register_style ( 'perfectscrollbar', get_template_directory_uri () . '/css/perfect-scrollbar-0.4.10.min.css', array (), null, 'all' );
    wp_register_style ( 'jquery-validity', get_template_directory_uri () . '/css/jquery.validity.css', array (), null, 'all' );
    wp_register_style ( 'jquery-ui', get_template_directory_uri () . '/css/jquery-ui.min.css', array (), null, 'all' );
	wp_register_style ( 'style', get_template_directory_uri () . '/css/style.css', array (), null, 'all' );
    wp_register_style ( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', array (), null, 'all' );
    wp_register_style ( 'custom-style', get_stylesheet_uri () );

    wp_enqueue_style ( 'twitter-bootstrap' );
    wp_enqueue_style ( 'fontello' );
    wp_enqueue_style ( 'prettyphoto-css' );
    wp_enqueue_style ( 'animation' );
    wp_enqueue_style ( 'flexSlider' );
    wp_enqueue_style ( 'perfectscrollbar' );
    wp_enqueue_style ( 'nouislider' );
    wp_enqueue_style ( 'jquery-validity' );
	wp_enqueue_style ( 'jquery-ui' );
    wp_enqueue_style ( 'style' );
    wp_enqueue_style ( 'google-fonts' );
    wp_enqueue_style ( 'animate' );
    wp_enqueue_style ( 'custom-style' );

    wp_register_script ( 'jquery', get_template_directory_uri () . '/js/jquery-1.11.0.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-ui', get_template_directory_uri () . '/js/jquery-ui.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-easing', get_template_directory_uri () . '/js/jquery.easing.1.3.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-mousewheel', get_template_directory_uri () . '/js/jquery.mousewheel.min.js', array ('jquery'), null, true );
    wp_register_script ( 'smoothscroll', get_template_directory_uri () . '/js/SmoothScroll.min.js', array ('jquery'), null, true );
    wp_register_script ( 'bootstrap-js', get_template_directory_uri () . '/js/bootstrap.min.js', array ('jquery'), null, true );
    wp_register_script ( 'prettyphoto-js', get_template_directory_uri () . '/js/prettyphoto/js/jquery.prettyPhoto.js', array ('jquery'), null, true );
    wp_register_script ( 'modernizr', get_template_directory_uri () . '/js/modernizr.js', array ('jquery'), null, true );
    wp_register_script ( 'wow', get_template_directory_uri () . '/js/wow.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-sharre', get_template_directory_uri () . '/js/jquery.sharre.min.js', array ('jquery'), null, true );
    wp_register_script ( 'bootstrap-js', get_template_directory_uri () . '/js/bootstrap.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-flexslider', get_template_directory_uri () . '/js/jquery.flexslider-min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-knob', get_template_directory_uri () . '/js/jquery.knob.js', array ('jquery'), null, true );
    wp_register_script ( 'mixitup', get_template_directory_uri () . '/js/jquery.mixitup.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-masonry', get_template_directory_uri () . '/js/jquery.masonry.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jplayer', get_template_directory_uri () . '/js/jquery.jplayer.min.js', array ('jquery'), null, true );
    wp_register_script ( 'fitvids', get_template_directory_uri () . '/js/jquery.fitvids.js', array ('jquery'), null, true );
    wp_register_script ( 'perfectscrollbar', get_template_directory_uri () . '/js/perfect-scrollbar-0.4.10.with-mousewheel.min.js', array ('jquery'), null, true );
    wp_register_script ( 'nouislider', get_template_directory_uri () . '/js/jquery.nouislider.min.js', array ('jquery'), null, true );
    wp_register_script ( 'jquery-validity', get_template_directory_uri () . '/js/jquery.validity.min.js', array ('jquery'), null, true );
    wp_register_script( 'retina', get_template_directory_uri().'/js/retina.js',null,null,true);
	wp_register_script ( 'main', get_template_directory_uri () . '/js/script.js', array ('jquery'), null, true );
	
    wp_enqueue_script ( 'jquery' );
    wp_enqueue_script ( 'bootstrap-js' );
    wp_enqueue_script ( 'jquery-ui' );
    wp_enqueue_script ( 'jquery-easing' );
    wp_enqueue_script ( 'jquery-mousewheel' );
    wp_enqueue_script ( 'smoothscroll' );
    wp_enqueue_script ( 'prettyphoto-js' );
    wp_enqueue_script ( 'modernizr' );
    wp_enqueue_script ( 'wow' );
    wp_enqueue_script ( 'jquery-sharre' );
    wp_enqueue_script ( 'jquery-flexslider' );
    wp_enqueue_script ( 'jquery-knob' );
    wp_enqueue_script ( 'mixitup' );
    wp_enqueue_script ( 'jquery-masonry' );
    wp_enqueue_script ( 'jplayer' );
    wp_enqueue_script ( 'fitvids' );
    wp_enqueue_script ( 'perfectscrollbar' );
    wp_enqueue_script ( 'nouislider' );
    wp_enqueue_script ( 'jquery-validity' );
    wp_enqueue_script ( 'main' );

    if (defined ( 'RETINA_SUPPORT' ) && RETINA_SUPPORT === true) {
        wp_enqueue_script ( 'retina' );
    }

    if (is_singular () && comments_open () && get_option ( 'thread_comments' )) {
        wp_enqueue_script ( 'comment-reply' );
    }
}

add_action ( 'wp_enqueue_scripts', 'ts_theme_scripts' );

$html5shim = create_function ( '', 'echo \'<!--[if lt IE 9]><script>document.createElement("header"); document.createElement("nav"); document.createElement("section"); document.createElement("article"); document.createElement("aside"); document.createElement("footer"); document.createElement("hgroup");</script><![endif]-->\';' );
add_action ( 'wp_head', $html5shim );

$html5shim = create_function ( '', 'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5.js"></script><![endif]-->\';' );
add_action ( 'wp_head', $html5shim );

$icomoon = create_function ( '', 'echo \'<!--[if lt IE 7]><script src="\'.get_template_directory_uri().\'/js/icomoon.js"></script><![endif]-->\';' );
add_action ( 'wp_head', $icomoon );

$ie_style = create_function ( '', 'echo \'<!--[if lt IE 9]><link href="\'.get_template_directory_uri().\'/css/ie.css" rel="stylesheet"><![endif]-->\';' );
add_action ( 'wp_head', $ie_style );

$ie_scripts = create_function ( '', 'echo \'
<!--[if lt IE 9]>
<script src="\'.get_template_directory_uri().\'/js/jquery.placeholder.js"></script>
<script src="\'.get_template_directory_uri().\'/js/script_ie.js"></script>
<![endif]-->\';' );
add_action ( 'wp_head', $ie_scripts );

$no_fouc = create_function ( '', 'echo \'
<!-- Preventing FOUC -->
<style>
.no-fouc{ display:none; }
</style>

<script>

// Prevent FOUC(flash of unstyled content)
jQuery("html").addClass("no-fouc");

jQuery(document).ready(function($) {

	$("html").show();

	setFullWidthFirst();

	// Set Full Width on Resize & Load
	$(window).bind("load", function(){

		setFullWidthFirst();
        setTimeout(function(){
            setFullWidthFirst();
        }, 500);

	});

	// Set Full Width Function
	function setFullWidthFirst(){
		
		if(!$("body").hasClass("b960") && !$("body").hasClass("b1170")){
			$(".full-width").each(function(){
				
				var element = $(this);

				// Reset Styles
				element.css("margin-left", "");
                element.css("padding-left", "0!important");
				element.css("width", "");	

				var element_x = element.offset().left;

				// Set New Styles
				element.css("margin-left", -element_x+"px");
				element.css("width", $(window).width()+"px");	
                element.css("padding-left", "");

			});
		}

	}

}); 


var mobilenav_screen_size = \'.(ot_get_option(\'switch_menu_to_mobile\') ? ot_get_option(\'switch_menu_to_mobile\') : 767 ).\';

</script>\';
');
add_action ( 'wp_head', $no_fouc );


function ts_add_mobilenav_css() {
	
	$ie_style = create_function ( '', 'echo \'<link rel="stylesheet" href="\'.get_template_directory_uri().\'/css/mobilenav.css" media="screen and (max-width: \'.(ot_get_option(\'switch_menu_to_mobile\') ? ot_get_option(\'switch_menu_to_mobile\') : 767 ).\'px)">\';' );
	add_action ( 'wp_head', $ie_style );
}
add_action ('init', 'ts_add_mobilenav_css');


function ts_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}

add_action ( 'wp_head', 'ts_ajaxurl' );

/**
 * Google analytics ourput
 */
function ts_google_analytics_output() {
    if (ot_get_option ( 'google_analytics_id' ) != "") {
        ?>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo ot_get_option('google_analytics_id'); ?>']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
    <?php
    }
}

add_action ( 'wp_footer', 'ts_google_analytics_output', 1200 );

/**
 * Register theme widgets
 *
 * @since marine 1.0
 */
function ts_theme_widgets_init() {
    register_sidebar ( array (
        'name' => __ ( 'Main Sidebar', 'marine' ),
        'id' => 'main',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );

    for($i = 1; $i <= 4; $i ++) {
        register_sidebar ( array (
            'name' => __ ( 'Footer Area', 'marine' ) . ' ' . $i,
            'id' => 'footer-area-' . $i,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ) );
    }
	
	for($i = 1; $i <= 2; $i ++) {
        register_sidebar ( array (
            'name' => __ ( 'Footer 2 Area', 'marine' ) . ' ' . $i,
            'id' => 'footer-2-area-' . $i,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ) );
    }

	register_sidebar ( array (
        'name' => __ ( 'Shop', 'marine' ),
        'id' => 'shop',
        'before_widget' => '<div id="%1$s" class="dupa shop-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="header"><h4>',
        'after_title' => '</h4><div class="arrow"></div></div>'
    ) );
	
    register_sidebar ( array (
        'name' => __ ( 'Shop Footer Area', 'marine' ) . ' 1',
        'id' => 'shop-footer-area-1',
        'before_widget' => '<div id="%1$s" class="shop-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Shop Footer Area', 'marine' ) . ' 2',
        'id' => 'shop-footer-area-2',
        'before_widget' => '<div id="%1$s" class="shop-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Shop Footer Area', 'marine' ) . ' 3',
        'id' => 'shop-footer-area-3',
        'before_widget' => '<div id="%1$s" class="shop-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
	
    $user_sidebars = ot_get_option ( 'user_sidebars' );

    if (is_array ( $user_sidebars )) {
        foreach ( $user_sidebars as $sidebar ) {
            register_sidebar ( array (
                'name' => $sidebar ['title'],
                'id' => sanitize_title ( $sidebar ['title'] ),
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5>',
                'after_title' => '</h5>'
            ) );
        }
    }
}

add_action ( 'widgets_init', 'ts_theme_widgets_init' );

/**
 * Add classes to body
 *
 * @param array $classes
 * @return array
 * @since framework 1.0
 */
// Add specific CSS class by filter
add_filter ( 'body_class', 'ts_get_body_main_class' );
function ts_get_body_main_class($classes) {

    // add body class and main menu style selected from control panel
    $added_body_class = false;
    $added_main_menu_style = false;
    if (ts_check_if_control_panel())
	{
		if (ts_check_if_use_control_panel_cookies() && !empty($_COOKIE['theme_body_class']))
		{
			$added_body_class = true;
			$classes[] = $_COOKIE['theme_body_class'];
		}
		else if (isset($_GET['switch_layout']) && !empty($_GET['switch_layout']))
		{
			$added_body_class = true;
			$classes[] = $_GET['switch_layout'];
		}

		if (ts_check_if_use_control_panel_cookies() &&  !empty($_COOKIE['theme_main_menu_style']))
		{
			$main_menu_style = $_COOKIE['theme_main_menu_style'];
		}
		elseif (isset($_GET['switch_main_menu_style']) && !empty($_GET['switch_main_menu_style']))
		{
			$main_menu_style = $_GET['switch_main_menu_style'];
		}

		if (!empty($main_menu_style))
		{
			$added_main_menu_style = true;
			$classes[] = ts_get_body_header_class($main_menu_style);
		}
	}
    // add body_class set in theme options only if not added from control panel
    if ($added_body_class == false) {
		
		if (is_singular(array('post', 'page')) && $page_body_class = get_post_meta(get_the_ID(), 'body_class', true) ) {
			$class = $page_body_class;
		}
		else {
			$class = ot_get_option('body_class');
		}
		
        if (empty ( $class )) {
            $class = 'w1170';
        }
        $classes[] = $class;
    }
	
	//add body_class set in theme options only if not added from control panel
	if ($added_main_menu_style == false)
	{
		$style = ts_get_main_menu_style();
		if (!empty($style))
		{
			$classes[] = ts_get_body_header_class($style);
		}
	}
	//add class if preheader is enabled
	if (is_page()) {
		
		$show_preheader = get_post_meta(get_the_ID(), 'show_preheader', true);
		if ($show_preheader == 'yes' || 
			((empty($show_preheader) || get_post_meta(get_the_ID(), 'show_preheader', true) == 'default') && ot_get_option('show_preheader') == 'yes')
		) {
			$classes[] = 'preheader-on';
		}
	}
	else if (!is_page() && ot_get_option('show_preheader') == 'yes') {
		$classes[] = 'preheader-on';
	}
	
	$preloader = ot_get_option('preloader');
	if (!empty($preloader) && $preloader != 'disabled') {
		$classes[] = 'page_transitions_enabled';
	}
	
	if (ot_get_option('sticky_footer') == 'yes') {
		$classes[] = 'sticky-footer-on';
	}
	
    return $classes;
}

/**
 * Get body class
 * @param type $style
 * @return string
 */
function ts_get_body_header_class($style) {
	
	switch ($style) {
		
		case 'style2':
			$class = 'headerstyle2';
			break;
			
		case 'style3':
			$class = 'headerstyle3';
			break;
		
		case 'style4':
			$class = 'headerstyle4';
			break;
		
		case 'style5':
			$class = 'headerstyle5';
			break;
		
		case 'style6':
			$class = ' headerstyle7';
			break;
		
		case 'style7':
			$class = ' headerstyle8';
			break;
		
		case 'style8':
		case 'style9':
			$class = ' sidemenu-fixed';
			break;
		
		case 'style10':
		case 'style11':
			$class = ''; //no class for this style
			break;
		
		case 'style12':
			$class = 'headerstyle9';
			break;
		
		case 'style1':
		default:
			$class = 'headerstyle1';
	}
	return $class;
}

/**
 * Get a list of supported header styles
 *
 * @return array
 */
function ts_get_header_styles($empty_option = false) {
    if ($empty_option === true) {
        $styles [] = array (
            'value' => 'default',
            'label' => __ ( 'Default', 'framework' ),
            'src' => ''
        );
    }
    $styles [] = array (
        'value' => 'style1',
        'label' => __ ( 'Style 1 (default)', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style2',
        'label' => __ ( 'Style 2', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style3',
        'label' => __ ( 'Style 3', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style4',
        'label' => __ ( 'Style 4', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style5',
        'label' => __ ( 'Style 5', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style6',
        'label' => __ ( 'Style 6', 'framework' ),
        'src' => ''
    );
    $styles [] = array (
        'value' => 'style7',
        'label' => __ ( 'Style 7', 'framework' ),
        'src' => ''
    );
	
	$styles [] = array (
        'value' => 'style8',
        'label' => __ ( 'Style 8 (side menu)', 'framework' ),
        'src' => ''
    );
	$styles [] = array (
        'value' => 'style9',
        'label' => __ ( 'Style 9 (side menu)', 'framework' ),
        'src' => ''
    );
	$styles [] = array (
        'value' => 'style10',
        'label' => __ ( 'Style 10 (side menu)', 'framework' ),
        'src' => ''
    );
	$styles [] = array (
        'value' => 'style11',
        'label' => __ ( 'Style 11 (side menu)', 'framework' ),
        'src' => ''
    );
	$styles [] = array (
        'value' => 'style12',
        'label' => __ ( 'Style 12', 'framework' ),
        'src' => ''
    );
    return $styles;
}

/**
 * Get control panel colors
 *
 * @return array
 */
function ts_get_control_panel_colors() {
    return array (
        '#647c02',
        '#01748f',
        '#ab5900',
        '#ab2501',
        '#01750f',
        '#017155',
        '#1a448a',
        '#312c9b',
        '#6222a7',
        '#891b72',
        '#910c0c',
        '#22292c'
    );
}
function ts_get_control_panel_backgrounds() {
    return array (
        'corp.jpg',
        'city.jpg',
        'city_1.jpg',
        'hills.jpg',
        'nature.jpg',
        'wood.jpg'
    );
}

// page builder configuration
// content - element required for each template
$page_builder_config = array (
    'default' => array (
        'content' => __ ( 'Page builder', 'framework' )
    ),
    'template-alternative.php' => array (
        'content' => __ ( 'Page builder', 'framework' ),
        'slider_content' => __ ( 'Slider area content', 'framework' )
    )
);

/**
 * Gettext filter, used in functions: __,_e etc.
 *
 * @global array $ns_options_translations
 * @param string $content
 * @param string $text
 * @param string $domain
 * @return string
 */
if (! is_admin ()) {
    function ts_translation($content, $text, $domain) {
        if (in_array ( $domain, array (
            'marine'
        ) )) {
            return ot_get_option ( 'translator_' . sanitize_title ( $content ), $content );
        }
        return $content;
    }
    function ts_check_if_translations_enabled() {
        if (ot_get_option ( 'enable_translations' ) == 'yes') {
            add_filter ( 'gettext', 'ts_translation', 20, 3 );
        }
    }

    add_action ( 'init', 'ts_check_if_translations_enabled' );
}

/**
 * Woocommerce support - hiding title on product's list
 *
 * @param type $content
 * @return boolean
 */
function ts_hide_woocommerce_page_title($content) {
    return false;
}

add_filter ( 'woocommerce_show_page_title', 'ts_hide_woocommerce_page_title' );

/**
 * Get animation class for animated shortcodes
 *
 * @param type $animation
 * @return string
 */
function ts_get_animation_class($animation, $add_class_attr = false) {
    if (! empty ( $animation )) {
        $class = ' wow animated ' . $animation;

        if ($add_class_attr === true) {
            return 'class="' . $class . '"';
        }
        return $class;
    }
    return '';
}
function trim_excerpt($text) {
    return rtrim ( $text, '[...]' );
}
function change_excerpt_more($more) {
    return '';
}
add_filter ( 'excerpt_more', 'change_excerpt_more' );

/**
 * Return the concatinated category list of a post
 *
 * @param null $post_id
 * @return string
 */
function ts_post_categories($post_id = null) {
    if (! $post_id) {
        global $post;
        $post_id = $post->ID;
    }

    $post_categories = wp_get_post_categories ( $post_id );
    $cats = array ();

    foreach ( $post_categories as $c ) {
        $cat = get_category ( $c );
        $cats [] = '<a href="' . get_term_link ( $c, 'category' ) . '">' . $cat->name . '</a>';
    }

    return implode ( ',', $cats );
}
function ts_img_url($size = 'full') {
    global $post;
    $image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), $size );
    return $image [0];
}

/**
 * Add a reset button to comment form
 */
add_action ( 'comment_form', 'ts_add_reset_btn' );
function ts_add_reset_btn() {
    ?><input type="submit" value="<?php _e('Send Message', 'marine'); ?>">
    <div class="iconic-button reset_btn">
        <input type="reset" value="<?php _e('Clear', 'marine'); ?>"> <i
            class="icons icon-cancel-circle-1"></i>
    </div>
<?php
}

/**
 * Process the contact form (template)
 */
if (isset ( $_POST ['contact-form-value'] )) {
    function ts_process_contact_form() {
        $data = array ();
        $err = array ();
        $headers = null;
        if (! wp_verify_nonce ( $_POST ['contact_nonce'], 'contact_form_submission' )) {
            $data ['status'] = 0;
            $err = array ();
            $err [] = "Invalid Form Submission";
            $data ['message'] = implode ( '<br>', $err );
            exit ( 0 );
        }

        if ($_POST ['contact-form-value'] == 1) {
            $name = $field ['Name'] = mysql_real_escape_string ( $_POST ['name'] );
            $email = $field ['Email'] = mysql_real_escape_string ( $_POST ['email'] );
            $field ['Message'] = mysql_real_escape_string ( $_POST ['msg'] );

            foreach ( $field as $k => $v ) {
                if (trim ( $v ) == '') {
                    $err [] = $k . ' ' . __ ( 'is required', 'marine' );
                }
            }

            if (! filter_var ( $field ['Email'], FILTER_VALIDATE_EMAIL )) {
                $err [] = __ ( 'Email is invalid', 'marine' );
            }

            if (empty ( $err )) {
                // send the mail

                $to = ot_get_option ( 'contact_form_email' );
                $headers = "From: $name <$email>" . "\r\n";

                add_filter ( 'wp_mail_content_type', 'set_html_content_type' );
                function set_html_content_type() {
                    return 'text/html';
                }

                if (wp_mail ( $to, 'Query', $field ['Message'], $headers )) {
                    $data ['status'] = 1;
                    $data ['message'] = __ ( 'Message Sent', 'marine' );
                } else {
                    $data ['status'] = 0;
                    $data ['message'] = __ ( 'An Error occured.', 'marine' );
                }

                // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
                remove_filter ( 'wp_mail_content_type', 'set_html_content_type' );
            } else {
                $data ['status'] = 0;
                $data ['message'] = implode ( '<br>', $err );
            }
            echo json_encode ( $data );
            exit ( 0 );
        }
    }
    add_action ( 'init', 'ts_process_contact_form' );
}

/**
 * Process the contact form (footer-2)
 */
function ts_process_footer_contact_form() {
	
	global $ts_cf_error, $ts_cf_message, $ts_cf_form_name, $ts_cf_form_email, $ts_cf_form_message;
	
	if (!isset($_POST['cf_wpnonce'])) {
		return;
	}
	
	
	$ts_cf_form_name = '';
	$ts_cf_form_email = '';
	$ts_cf_form_message = '';
	
	$ts_cf_error = false; 
	$ts_cf_message = '';
	
	//checking if email is valid
	$email = ot_get_option('contact_form_email');
	if ( !is_email( $email ) )
	{
		$ts_cf_error = true;
	}
	
	if (wp_verify_nonce($_POST['cf_wpnonce'],'footer-2-cf_mar'))
	{
		$ts_cf_form_name = sanitize_text_field($_POST['form_name']);
		$ts_cf_form_email = sanitize_text_field($_POST['form_email']);
		$ts_cf_form_message = filter_var($_POST['form_message'], FILTER_SANITIZE_STRING);
		
		$ts_cf_error = false;
		if (empty($ts_cf_form_name) || empty($ts_cf_form_email) || empty($ts_cf_form_message)) {
			$ts_cf_message .= '<p>' . __('Please fill all required fields.','marine') . '</p>';
			$ts_cf_error = true;
		}
		
		if ( $ts_cf_error == false && !is_email( $ts_cf_form_email )) {
			$ts_cf_message .= '<p>' . __('Please check your email.','marine') . '</p>';
			$ts_cf_error = true;
		}
		
		if ( $ts_cf_error === false ) {
			
			$site_name = is_multisite() ? $current_site->site_name : get_bloginfo('name');
			if (wp_mail($email, $site_name, esc_html($ts_cf_form_message),'From: "'. esc_html($ts_cf_form_name) .'" <' . esc_html($ts_cf_form_email) . '>')) {
				$ts_cf_message = '<p>' . __('Email sent. Thank you for contacting us','marine') . '</p>';
			} else {
				$ts_cf_message = '<p>' .__('Server error. Pease try again later.','marine') . '</p>';
				$ts_cf_error = true;
			}
		}
	}
	
	return;
}
add_action ( 'init', 'ts_process_footer_contact_form' );

/*
 * Replacement for get_adjacent_post() This supports only the custom post types you identify and does not look at categories anymore. This allows you to go from one custom post type to another which was not possible with the default get_adjacent_post(). Orig: wp-includes/link-template.php @param string $direction: Can be either 'prev' or 'next' @param multi $post_types: Can be a string or an array of strings
 */
function mod_get_adjacent_post($direction = 'prev', $post_types = 'post') {
    global $post, $wpdb;

    if (empty ( $post ))
        return NULL;
    if (! $post_types)
        return NULL;

    if (is_array ( $post_types )) {
        $txt = '';
        for($i = 0; $i <= count ( $post_types ) - 1; $i ++) {
            $txt .= "'" . $post_types [$i] . "'";
            if ($i != count ( $post_types ) - 1)
                $txt .= ', ';
        }
        $post_types = $txt;
    }

    $current_post_date = $post->post_date;

    $join = '';
    $in_same_cat = FALSE;
    $excluded_categories = '';
    $adjacent = $direction == 'prev' ? 'previous' : 'next';
    $op = $direction == 'prev' ? '<' : '>';
    $order = $direction == 'prev' ? 'DESC' : 'ASC';

    $join = apply_filters ( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
    $where = apply_filters ( "get_{$adjacent}_post_where", $wpdb->prepare ( "WHERE p.post_date $op %s AND p.post_type IN({$post_types}) AND p.post_status = 'publish'", $current_post_date ), $in_same_cat, $excluded_categories );
    $sort = apply_filters ( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

    $query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
    $query_key = 'adjacent_post_' . md5 ( $query );
    $result = wp_cache_get ( $query_key, 'counts' );
    if (false !== $result)
        return $result;

    $result = $wpdb->get_row ( "SELECT p.* FROM $wpdb->posts AS p $join $where $sort" );
    if (null === $result)
        $result = '';

    wp_cache_set ( $query_key, $result, 'counts' );
    return $result;
}

/**
 * Generate Select values for transparency
 *
 * @return array
 */
function ts_transparentArray() {
    for($i = 0; $i < 101; $i ++) {
        $d [] = $i . '%';
    }
    return $d;
}
function ts_get_follower_count($return_array = false) {
    $username = ts_get_twitter_username ();
    if ($username === false) {
        return '';
    }
    $cache = get_option ( 'theme-recent-tweet' );

    // display from cache, skip cache if username is changed
    if (is_array ( $cache ) && $cache ['username'] == $username && (( int ) $cache ['time'] + (5 * 60)) > time ()) {
        if (isset ( $cache ['tweets'] ) && ! empty ( $cache ['tweets'] )) {
            return $cache;
        }
        return false;
    } 	// get fromt twitter
    else {
        require_once get_template_directory () . '/framework/class/tmhOAuth.php';
        require_once get_template_directory () . '/framework/class/tmhUtilities.php';
        $tmhOAuth = new tmhOAuth ( $a = array (
            'consumer_key' => ot_get_option ( 'twitter_consumer_key' ),
            'consumer_secret' => ot_get_option ( 'twitter_consumer_secret' ),
            'user_token' => ot_get_option ( 'twitter_user_token' ),
            'user_secret' => ot_get_option ( 'twitter_token_secret' ),
            'curl_ssl_verifypeer' => false
        ) );

        $code = $tmhOAuth->request ( 'GET', $tmhOAuth->url ( '1.1/statuses/user_timeline' ), array (
            'screen_name' => $username
        ) );
        $response = $tmhOAuth->response;

        $tweets = null;
        if ($response ['code'] == 200 && isset ( $response ['response'] ) && ! empty ( $response ['response'] )) {
            $tweets = json_decode ( $response ['response'] );
        } else {
            $tweets = json_decode ( $response ['response'] );

            return array (
                'is_error' => true,
                'error' => (isset ( $tweets->errors [0]->message ) ? $tweets->errors [0]->message : 'Unknown error')
            );
        }

        if ($response ['code'] == 200) {

            if (is_array ( $tweets ) && count ( $tweets ) > 0) {

                $data = array (
                    'time' => time (),
                    'username' => $username,
                    'tweets' => $response ['response'],
                    'is_error' => false
                );
            } else {

                $data = array (
                    'time' => time (),
                    'username' => $username,
                    'tweets' => '',
                    'is_error' => false
                );
            }
            update_option ( 'theme-recent-tweet', $data );
            return $data;
        }
    }
}

/* Woocommerce */


/**
 * Remove Woocommerce Default styles
 * @param $enqueue_styles
 * @return mixed
 */
function ts_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
    return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'ts_dequeue_styles' );

//remove_filter('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);

remove_filter('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
function ts_woocommerce_share_btns(){
    echo  '<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fa0dd020995c117"></script>
<!-- AddThis Button END -->';
}
add_action('woocommerce_share','ts_woocommerce_share_btns',5);

/**
 * Define image sizes on theme activation
 */
function ts_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '263',	// px
		'height'	=> '341',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '370',	// px
		'height'	=> '478',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '166',	// px
		'height'	=> '214',	// px
		'crop'		=> 1 		// true
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action ( 'after_switch_theme', 'ts_woocommerce_image_dimensions' );


function ts_woocommerce_get_price_html($price) {
	
	return str_replace( '<ins>', '<ins class="price blue">'.__('Now:', 'marine').' ', $price );
}

add_filter('woocommerce_get_price_html', 'ts_woocommerce_get_price_html');

//Remove WooCoomerce default hooks
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


/**
 * Slider option for woocommerce shop category
 */

add_action('product_cat_edit_form_fields','ts_product_cat_edit_form_fields');
add_action('product_cat_add_form_fields','ts_product_cat_edit_form_fields');
add_action('edited_product_cat', 'ts_product_cat_save_form_fields', 10, 2);
add_action('created_product_cat', 'ts_product_cat_save_form_fields', 10, 2);

function ts_product_cat_save_form_fields($term_id) {
    $meta_name = 'slider';
    if ( isset( $_POST[$meta_name] ) ) {
        $meta_value = $_POST[$meta_name];
        // This is an associative array with keys and values:
        // $term_metas = Array($meta_name => $meta_value, ...)
        $term_metas = get_option("taxonomy_{$term_id}_metas");
        if (!is_array($term_metas)) {
            $term_metas = Array();
        }
        // Save the meta value
        $term_metas[$meta_name] = $meta_value;
        update_option( "taxonomy_{$term_id}_metas", $term_metas );
    }
}

function ts_product_cat_edit_form_fields ($term_obj) {
    // Read in the order from the options db
    $term_id = $term_obj->term_id;
    $term_metas = get_option("taxonomy_{$term_id}_metas");
    if ( isset($term_metas['slider']) ) {
        $slider = $term_metas['slider'];
    } else {
        $slider = '0';
    }
	
	$options = ts_get_slider_items_for_theme_options();
?>
    <tr class="form-field">
		<th valign="top" scope="row">
			<label for="slider"><?php _e('Slider', ''); ?></label>
		</th>
		<td>
			<?php
			if (is_array($options) && count($options) > 0) { ?>
				<select name="slider" id="slider">
					<?php foreach ($options as $option) { ?>
						<option value="<?php echo esc_attr($option['value']); ?>" <?php echo $option['value'] == $slider ? 'selected' : ''; ?>><?php echo $option['label']; ?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</td>
	</tr>
<?php 
}

/**
 * Empty the cart
 * @global object $woocommerce
 */
function ts_woocommerce_clear_cart_url() {
  global $woocommerce;
	
	if (is_object($woocommerce) && isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
		wp_redirect( get_permalink( woocommerce_get_page_id( 'shop' ) ) );
	}
}
add_action( 'init', 'ts_woocommerce_clear_cart_url' );


/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) {
	vc_set_as_theme();
}


$settings = array(
	'menu-categories' => array('order', 'image')
);
$tf = new ts_extra_taxonomy_fields($settings);


