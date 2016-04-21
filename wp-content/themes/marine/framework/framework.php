<?php
/**
 * Framework functions, improvements and additions to OptionTree
 *
 * @package framework
 * @since framework 1.0
 */
add_filter('widget_text', 'do_shortcode');

/**
* Banner builder
*/
include_once( 'banner-builder.php' );

if (is_admin())
{
	function ts_admin_head() {
		?>
		<script type="text/javascript">
			var popupurl = '<?php echo get_template_directory_uri() . '/framework/popup.php'; ?>';
			var themeurl = '<?php echo get_template_directory_uri(); ?>';
		</script>
	<?php
	}

	add_action('admin_head', 'ts_admin_head');

	/**
	* Initalize theme options scripts
	*/
	function ts_load_custom_wp_admin_style() {
		wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/framework/css/admin.css', false);
		wp_register_style('jquery_select2_css', get_template_directory_uri() . '/framework/css/select2.css', false);
		wp_register_style('custom_option_tree_css', get_template_directory_uri() . '/framework/css/option-tree.css', array('ot-admin-css'));

		wp_register_style( 'fontello', get_template_directory_uri() . '/css/fontello.css', array(), null, 'all' );

		wp_enqueue_style('custom_wp_admin_css');
		wp_enqueue_style('jquery_select2_css');
		wp_enqueue_style('custom_option_tree_css');
		wp_enqueue_style('font-awesome' );
		wp_enqueue_style('fontello' );

		wp_register_script( 'ts-framework', get_template_directory_uri().'/framework/js/framework.js',array('jquery'),null);
		wp_register_script( 'jquery_select2', get_template_directory_uri().'/framework/js/select2.min.js',array('jquery'),null);
		wp_enqueue_script( 'ts-framework' );
		wp_enqueue_script( 'jquery_select2' );
	}

	add_action('admin_enqueue_scripts', 'ts_load_custom_wp_admin_style');

	/**
	 * Register tinymce plugins
	 * @param array $plugin_array
	 * @return array
	 */
	function ts__register_tinymce_javascript($plugin_array) {
	   $plugin_array['code'] = get_template_directory_uri().'/framework/js/tinymce/plugins/code/plugin.min.js';
	   return $plugin_array;
	}
	
	add_filter('mce_external_plugins', 'ts__register_tinymce_javascript');

	/**
	* Tinymce extensions
	*/
	include_once( 'tinymce.php' );
}

/**
 * Framework scripts
 */
function ts_framework_scripts() {
	if (ot_get_option('control_panel') == 'enabled_admin' && current_user_can('manage_options') || ot_get_option('control_panel') == 'enabled_all') {
		wp_register_style( 'control-panel', get_template_directory_uri() . '/framework/css/control-panel.css', array(), null, 'all' );
		wp_enqueue_style( 'control-panel' );
	}
}
add_action( 'wp_enqueue_scripts', 'ts_framework_scripts' );

/**
 * Custom popup items
 * @return array
 */
function ts_get_custom_popup_items() {

	$custom_popup_items = array(
		array(
			'shortcode' => 'custom_icon',
			'name' => __('Icon','framework'),
			'description' => '',
			'usage' => '',
			'code' => '{icon}',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => '',
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				)
			)
		)
	);

	return $custom_popup_items;
}

/**
 * Get main menu style
 * @return type
 */
function ts_get_main_menu_style()
{
	$control_panel = ot_get_option('control_panel');
	if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_main_menu_style']) && !empty($_COOKIE['theme_main_menu_style']) && ($control_panel == 'enabled_admin' && current_user_can('manage_options') || $control_panel == 'enabled_all')) {
		return $_COOKIE['theme_main_menu_style'];
	}
	else if (isset($_GET['switch_main_menu_style']) && !empty($_GET['switch_main_menu_style'])) {
		return $_GET['switch_main_menu_style'];
	}

	//get main menu style for specified page
	$main_menu_style = '';
	
	if (is_page()) {
		$main_menu_style = get_post_meta(get_the_ID(), 'main_menu_style', true);
	}

	if (!empty($main_menu_style) && $main_menu_style != 'default') {
		return $main_menu_style;
	} else {
		
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return ot_get_option('shop_menu_style');
		} else {
			return ot_get_option('main_menu_style');
		} 
	}
}

/**
 * Switch styles when
 *
 * @since framework 1.0
 */
function ts_switch_styles()
{
	if (isset($_GET['control_panel']) && $_GET['control_panel'] == 'defaults')
	{
		setcookie('theme_body_class', '');
		setcookie('theme_main_menu_style', '');
		setcookie('theme_background', '');
		setcookie('theme_main_color','',null,'/');
		unset($_COOKIE['theme_body_class']);
		unset($_COOKIE['theme_main_menu_style']);
		unset($_COOKIE['theme_background']);
		unset($_COOKIE['theme_main_color']);
	}
	if (isset($_GET['switch_layout']) && in_array($_GET['switch_layout'],array('w1170','b1170','w960','b960')))
	{
		if (ts_check_if_control_panel())
		{
			setcookie('theme_body_class', $_GET['switch_layout']);
			$_COOKIE['theme_body_class'] = $_GET['switch_layout'];
		}
	}

	if (isset($_GET['switch_main_menu_style']) && !empty($_GET['switch_main_menu_style']))
	{
		if (ts_check_if_control_panel())
		{
			setcookie('theme_main_menu_style', $_GET['switch_main_menu_style']);
			$_COOKIE['theme_main_menu_style'] = $_GET['switch_main_menu_style'];
		}
	}

}
add_action( 'init', 'ts_switch_styles' );

/**
 * Define current id (from get) for further use
 *
 * @since framework 1.0
 */
function ts_define_current_id()
{
	define('CURRENT_ID',is_singular() ? get_the_ID() : null);
}
add_action( 'wp_head', 'ts_define_current_id' );

/**
 * Get current id (set in wp_head)
 *
 * @since framework 1.0
 */
function ts_get_current_id()
{
	return CURRENT_ID;
}

/**
 * Get position of the sidebar defined for single post or page
 *
 * @return string sidebar position, possible values: left, right, both, no
 *
 * @since framework 1.0
 */
function ts_get_single_post_sidebar_position()
{
	return get_post_meta(ts_get_current_id(), 'sidebar_position_single',true);
}

/**
 * Get one of the registered sidebar, depends on Theme options or single post settings
 * Used when sidebar is defined in OptionTree and attached to single post or page using metaboxes
 * Function gets left_sidebar or right_sidebar (these are names of metaboxes not sidebars ids!)
 *
 * @param string sidebar position left or right
 * @param string default default sidebar is not set
 * @return string/bool return string sidebar id or false if sidebar doesn't exists
 *
 * @since framework 1.0
 */
function ts_get_single_post_sidebar_id($position, $default = 'main')
{
	$sidebar = get_post_meta(ts_get_current_id(), $position,true);
	if (empty($sidebar))
	{
		$sidebar = $default;
	}
	return $sidebar;
}

/**
 * Show sigle post sidebar, depends on position set on the post/page
 *
 * @since framework 1.0
 */
function ts_get_single_post_sidebar($position)
{
	if (!empty($position))
	{
		$single_post_sidebar_position = ts_get_single_post_sidebar_position();

		switch ($single_post_sidebar_position)
		{
			case 'left':
				if ( in_array( $position,array( 'left' ) ) )
				{
					get_sidebar($position);
				}
				break;

			case 'left2':
				if ( in_array( $position,array( 'left', 'left2' ) ) )
				{
					get_sidebar($position);
				}
				break;



			case 'right2':
				if ( in_array( $position,array( 'right', 'right2' ) ) )
				{
					get_sidebar($position);
				}
				break;

			case 'both':
				if ( in_array( $position,array( 'left','right' ) ) )
				{
					get_sidebar($position);
				}
				break;

			case 'no':
				break;

			case 'right':
			default:
				if ( in_array( $position,array( 'right' ) ) )
				{
					get_sidebar($position);
				}
				break;
		}
	}

	return '';
}

/**
 * Check if two sidebars are visible
 *
 * @since framework 1.0
 */
function ts_check_if_two_sidebars( )
{
	$single_post_sidebar_position = ts_get_single_post_sidebar_position();
	if (in_array($single_post_sidebar_position,array('left2','right2','both')))
	{
		return true;
	}
	else
	{
		return false;
	}
}

/**
 * Check if any sidebar is on
 *
 * @since framework 1.0
 */
function ts_check_if_sidebar( )
{
	$single_post_sidebar_position = ts_get_single_post_sidebar_position();
	if ($single_post_sidebar_position == 'no')
	{
		return false;
	}
	else
	{
		return true;
	}
}

/**
 * Check if any sidebar is on
 *
 * @since framework 1.0
 */
function ts_check_if_any_sidebar($ifNoSidebars,$ifOneSidebar, $ifTwoSidebars )
{
	if (ts_check_if_two_sidebars( ))
	{
		return $ifTwoSidebars;
	}
	if (ts_check_if_sidebar())
	{
		return $ifOneSidebar;
	}
	return $ifNoSidebars;
}

/**
 * Replace excerpt "more"
 *
 * @since framework 1.0
 */
function ts_new_excerpt_more( $excerpt )
{
	return str_replace( '[...]', '...', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'ts_new_excerpt_more' );

/**
 * Echo excerpt
 *
 * @param string/int integer for custom lenngth for tiny,short/regular/long for defined excerpt
 * @since framework 1.0
 */
require_once 'class/Excerpt.class.php';
function ts_the_excerpt_theme($length = 55)
{
	ts_Excerpt::length($length);
}

/**
 * get excerpt
 *
 * @param string/int integer for custom lenngth for tiny,short/regular/long for defined excerpt
 * @since framework 1.0
 */
function ts_get_the_excerpt_theme($length = 55)
{
	return ts_Excerpt::get_by_length($length);
}

/**
 * Get shortened string to words limit
 *
 * @param $text string
 * @param $word_limit
 * @return string cut to x words
 * @since framework 1.0
 */
function ts_get_shortened_string($text,$word_limit)
{
	$words = explode(' ', $text, ($word_limit + 1));
	if(count($words) > $word_limit)
	{
		array_pop($words);
		return implode(' ', $words)."...";
	}
	else
	{
		return implode(' ', $words);
	}
}

/**
 * Get shortened string to words limit
 *
 * @param $text string
 * @param $word_limit
 * @return string cut to x words
 * @since framework 1.0
 */
function ts_get_shortened_string_by_letters($text,$letters_limit, $at_space = true, $add = '...')
{
	if(strlen($text) > $letters_limit)
	{
		if ($at_space) {
			$pos = strpos($text, ' ', $letters_limit);

			if (!$pos) {
				return $text;
			}
			return substr($text, 0, $pos).$add;
		}
		return substr($text, 0, $letters_limit).$add;
	}
	else
	{
		return $text;
	}
}

/**
 * Get class for specified sidebar
 *
 * @param string $url
 * @param bool $return_url 
 * @return string
 * @since framework 1.0
 */
function ts_get_embaded_video($url, $return_url = false) {

	if (strstr($url,'vimeo'))
	{
		if (preg_match('/(\d+)/', $url, $matches))
		{
			if ($return_url) {
				return 'http://player.vimeo.com/video/'.$matches[0].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff';
			}
			return '<iframe src="http://player.vimeo.com/video/'.$matches[0].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff"></iframe>';
		}
	}
	else if (strstr($url,'youtu'))
	{
		$pattern = "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#";
		if (preg_match($pattern, $url, $matches))
		{
			if ($return_url) {
				return 'http://www.youtube.com/embed/'.$matches[0];
			}
			return '<iframe src="http://www.youtube.com/embed/'.$matches[0].'"></iframe>';
		}
	}
	return '';
}

/**
 * Gets twitter username from theme options
 * @return string|boolean
 */
function ts_get_twitter_username() {

	$url = ot_get_option('twitter_account_recent_tweets');
	if (empty($url) || !strstr($url,'twitter.com/'))
	{
		return '';
	}

	$url = trim($url);
	if (substr($url,-1) == '/')
	{
		$url = substr($url,0,-1);
	}
	$username = substr($url,strrpos($url,'/')+1);

	return $username;
}

/**
 * Get one recent tweet
 * @param type $return_array
 * @return string|boolean
 */
function ts_get_recent_tweet($return_array = false) {

	$username = ts_get_twitter_username();
	if ($username === false)
	{
		return '';
	}
	$cache = get_option('theme-recent-tweet');

	//display from cache, skip cache if username is changed
	if (ot_get_option('dont_cache_tweets') != 'yes' && is_array($cache) && $cache['username'] == $username && ((int)$cache['time'] + (5 * 60)) > time())
	{
		if (isset($cache['tweets']) && !empty($cache['tweets'])) {
			return $cache;
		}
		return false;
	}
	//get fromt twitter
	else
	{
		require_once get_template_directory().'/framework/class/TwitterAPIExchange.php';
		
		$settings = array(
			'oauth_access_token' => ot_get_option('twitter_user_token'),
			'oauth_access_token_secret' => ot_get_option('twitter_token_secret'),
			'consumer_key' => ot_get_option('twitter_consumer_key'),
			'consumer_secret' => ot_get_option('twitter_consumer_secret')
		);

		$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		$requestMethod = "GET";
		$getfield = '?screen_name='.$username.'&count=20';

		$twitter = new TwitterAPIExchange($settings);
		$response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
		
		$tweets = json_decode($response);
		
		if (is_array($tweets) && count($tweets) > 0) {

			$data = array(
				'time' => time(),
				'username' => $username,
				'tweets' => $response,
				'is_error' => false
			);
			
		} else {
			
			$data = array(
				'time' => time(),
				'username' => $username,
				'tweets' => null,
				'is_error' => false
			);
		}
		
		update_option('theme-recent-tweet',$data);
		return $data;
	}
}

/**
 * Replace urls, hashtags, mentions with html tags in tweet
 * @param type $tweet
 * @return null
 */
function ts_replace_in_tweets($tweet) {
	
	if (!is_object($tweet)) {
		return null;
	}
	
	$tweet_text = $tweet->text;
											
	// check if any entites exist and if so, replace then with hyperlinked versions
	if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
		foreach ($tweet->entities->urls as $url) {
			$find = $url->url;
			$replace = '<a href="'.$find.'" target="_blank">'.$find.'</a>';
			$tweet_text = str_replace($find,$replace,$tweet_text);
		}

		foreach ($tweet->entities->hashtags as $hashtag) {
			$find = '#'.$hashtag->text;
			$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
			$tweet_text = str_replace($find,$replace,$tweet_text);
		}

		foreach ($tweet->entities->user_mentions as $user_mention) {
			$find = "@".$user_mention->screen_name;
			$replace = '<a href="http://twitter.com/'.$user_mention->screen_name.'" target="_blank">'.$find.'</a>';
			$tweet_text = str_ireplace($find,$replace,$tweet_text);
		}
	}
	
	return $tweet_text;
}

/**
 * Convert twitter timestamp to "x ago"
 * @param type $created_at
 * @return type
 */
function ts_twitter_time($created_at) {
    //get current timestampt
    $b = strtotime("now"); 
    //get timestamp when tweet created
    $c = strtotime($a);
    //get difference
    $d = $b - $c;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
        
    if(is_numeric($d) && $d > 0) {
        //if less then 3 seconds
        if($d < 3) {
			return __('just now','framework');
		}
        //if less then minute
        if($d < $minute) {
			return sprintf(__('%d seconds ago','framework'), floor($d)); floor($d);
		}
        //if less then 2 minutes
        if($d < $minute * 2) {
			return __('1 minute ago','framework');
		}
        //if less then hour
        if($d < $hour) {
			return sprintf(__('%d minutes ago','framework'),floor($d / $minute)); floor($d);
		}
        //if less then 2 hours
        if($d < $hour * 2) {
			return __('1 hour ago','framework');
		}
        //if less then day
        if($d < $day) {
			return sprintf(__('%d hours ago','framework'),floor($d / $hour)); floor($d);
		}
        //if more then day, but less then 2 days
        if($d > $day && $d < $day * 2) {
			return __('yesterday','framework');
		}
        //if less then year
        if($d < $day * 365) {
			return sprintf(__('%d days ago','framework'),floor($d / $day)); floor($d);
		}
        //else return more than a year
		return __('over a year ago', 'framework');
    }
}

/**
 * Get main page builder content
 * @global object $post
 * @param string $content
 * @return type
 */
function ts_get_main_page_builder_content($content)
{
	global $post;

	if ($post -> post_type != 'page')
	{
		return $content;
	}
	$page_builder = get_post_meta($post -> ID,'page_builder_content',true);
	return $content.  do_shortcode($page_builder);
}
add_filter('the_content','ts_get_main_page_builder_content');

/**
 * Get page builder content
 * @global object $post
 * @param string $builder
 * @return type
 */
function ts_get_page_builder_content($builder)
{
	global $post;
	$page_builder = get_post_meta($post -> ID,'page_builder_content_'.$builder,true);
	return do_shortcode($page_builder);
}

/**
 * Add theme specific image size (used with resizing functions eg. get_resized_image, get_resized_post_thumbnail)
 * @global array $_theme_image_sizes
 * @param string $name
 * @param int $width
 * @param int $height
 * @param bool $crop
 */
function ts_add_theme_image_size( $name, $width = 0, $height = 0, $crop = false ) {
	global $_theme_image_sizes;
	$_theme_image_sizes[$name] = array( 'width' => absint( $width ), 'height' => absint( $height ), 'crop' => (bool) $crop );
}

/**
 * Get image tag
 * @param string $image_src
 * @param string $class
 * @param string $alt
 * @return string
 */
function ts_get_image($image_src, $class = '', $alt = '') {

	if (empty($image_src)) {
		return;
	}
	$attachment_id = ts_get_attachment_id_from_src($image_src);

	$attr = array(
		'class'	=> $class,
		'alt'   => $alt,
	);

	if ($attachment_id) {
		return wp_get_attachment_image( $attachment_id, 'full', false, $attr);
	} else {
		return '<img src="'.$image_src.'" class="'.$attr['class'].'" alt="'.$alt.'" />';
	}
}

/**
 * Get attachment id from src
 * @global object $wpdb
 * @param string $image_src
 * @return int
 */
function ts_get_attachment_id_from_src ($image_src) {

	global $wpdb;
	$query = $wpdb -> prepare("SELECT ID FROM {$wpdb->posts} WHERE guid= %s ",$image_src);
	$id = $wpdb->get_var($query);
	return $id;
}

/**
 * Get resized image
 * @param string $image local image url, must be from media library
 * @param int $width
 * @param int $height
 * @param string $alt
 * @param string $class
 * @param bool $crop
 * @param bool $reutrn_src
 * @param string $title
 * @return string/void
 * @since framework 1.0
 */
function ts_get_resized_image($image, $width, $height, $alt = '', $class = '', $crop = true, $return_src = false, $title = '')
{
	if (!empty($image))
	{
		if (!class_exists('fImg'))
		{
			require get_template_directory().'/framework/class/freshizer.php';
		}

		$upload_dir = wp_upload_dir();
		$skip_resize_remote_files = false;

		//check if file is in upload directory
		if (is_array($upload_dir) && !empty($upload_dir['url'])) {
			$path = str_replace($upload_dir['baseurl'],$upload_dir['basedir'],$image);

			if (!file_exists($path)) {
				$skip_resize_remote_files = true;
			}
		}

		//don't resize image if not found in upload dir
		if ($skip_resize_remote_files) {
			$src = $image;
		} else {
			$src = fImg::resize( $image, $width, $height, $crop );
		}

		if (!empty($src))
		{
			if ($return_src == true)
			{
				return $src;
			}
			else
			{
				if (empty($class))
				{
					$class = 'wp-post-image';
				}
				return '<img src="'.$src.'" class="'.$class.'" width="'.$width.'" height="'.$height.'" alt="'.  esc_attr($alt).'" '.(!empty($title) ? 'title="'. esc_attr($title) .'"' : '').' />';
			}
		}
	}
}

/**
 * Get resized image by size
 * @global array $_theme_image_sizes
 * @param string $image
 * @param array $size
 * @param string $alt
 * @param string $class
 * @param bool $return_src
 * @param string $title
 * @return string
 */
function ts_get_resized_image_by_size($image, $size, $alt = '', $class = '', $return_src = false, $title = '')
{
	global $_theme_image_sizes;

	//get size from array if is set
	if (!empty($size) && isset($_theme_image_sizes[(string)$size]))
	{
		$width = $_theme_image_sizes[$size]['width'];
		$height = $_theme_image_sizes[$size]['height'];
		$crop = $_theme_image_sizes[$size]['crop'];

		return ts_get_resized_image($image, $width, $height, $alt, $class, $crop, $return_src, $title);
	}

	return 'SIZE NOT DEFINED';
}

/**
 * Get resized post thumbnail
 * @param int $post_id
 * @param string $size
 * @param string $alt
 * @param string $class
 * @return string
 * @since framework 1.0
 */
function ts_get_resized_post_thumbnail($post_id,$size, $alt = '', $class = '')
{
	$image = wp_get_attachment_url( get_post_thumbnail_id( $post_id ));
	return ts_get_resized_image_by_size($image, $size, $alt, $class);
}

/**
 * Display resized post thumbnail
 * @global object $post
 * @param array $size
 * @param string $alt
 * @param string $class
 * @return void
 * @since framework 1.0
 */
function ts_the_resized_post_thumbnail($size,$alt = '', $class = '')
{
	global $post;
	echo ts_get_resized_post_thumbnail($post->ID,$size,$alt, $class);
}

/**
 * Get resized post thumbnail, checks for sidebars and choose best resolution
 * @global object $post
 * @param array $sizes array of 3 sizes, 0 - no sidebars, 1 - one siedebar, 2 - two siedbars, eg. array('600,300','400,200','300,150')
 * @param string $alt
 * @param string $class
 * @return string
 * @since framework 1.0
 */
function ts_get_resized_post_thumbnail_sidebar($post_id,$sizes,$alt = '', $class = '')
{
	if (ts_check_if_two_sidebars())
	{
		$size = 2;
	}
	else if (ts_check_if_sidebar())
	{
		$size = 1;
	}
	else
	{
		$size = 0;
	}
	if (!isset($sizes[$size]))
	{
		$current_size = false;
	}
	else
	{
		$current_size = $sizes[$size];
	}
	return ts_get_resized_post_thumbnail($post_id,$current_size,$alt, $class);
}

/**
 * Display resized post thumbnail, checks for sidebars and choose best resolution from sizes arrau
 * @global type $post
 * @param array $sizes
 * @param string $alt
 * @param string $class
 * @return void
 * @since framework 1.0
 */
function ts_the_resized_post_thumbnail_sidebar($sizes,$alt = '', $class = '')
{
	global $post;
	echo ts_get_resized_post_thumbnail_sidebar($post->ID,$sizes,$alt, $class);
}


/**
 * Get resized image, checks for sidebars and choose best resolution
 * @global type $post
 * @param string $image image url, must be from media library
 * @param array $sizes array of 3 sizes, 0 - no sidebars, 1 - one siedebar, 2 - two siedbars, eg. array('600,300','400,200','300,150')
 * @param string $alt
 * @param string $class
 * @param string $title
 * @return string
 * @since framework 1.0
 */
function ts_get_resized_image_sidebar($image,$sizes,$alt = '', $class = '', $title = '')
{
	if (ts_check_if_two_sidebars())
	{
		$size = 2;
	}
	else if (ts_check_if_sidebar())
	{
		$size = 1;
	}
	else
	{
		$size = 0;
	}
	return ts_get_resized_image_by_size($image, $sizes[$size], $alt, $class, false, $title);
}

/**
 * Display resized image, checks for sidebars and choose best resolution
 * @global type $post
 * @param string $image image url, must be from media library
 * @param array $sizes array of 3 sizes, 0 - no sidebars, 1 - one siedebar, 2 - two siedbars, eg. array('600,300','400,200','300,150')
 * @param string $alt
 * @param string $class
 * @return void
 * @since framework 1.0
 */
function ts_the_resized_image_sidebar($image,$sizes,$alt = '', $class = '')
{
	echo ts_get_resized_image_sidebar($image, $sizes, $alt, $class);
}

/**
 * Get prev slider text
 * @return string
 */
function ts_get_prev_slider_text()
{
	if (defined('SLIDER_PREV_TEXT')) {
		return SLIDER_PREV_TEXT;
	}
	return __('Previous', 'framework');
}

/**
 * Get next slider text
 * @return string
 */
function ts_get_next_slider_text()
{
	if (defined('SLIDER_NEXT_TEXT')) {
		return SLIDER_NEXT_TEXT;
	}
	return __('Next', 'framework');
}

/**
 * Save like for a post ajax request
 */
function ts_save_post_like_func()
{
	if (!isset($_GET['post_id']) || empty($_GET['post_id']))
	{
		die(); //die on wrong get parameter
	}
	$post_id = $_GET['post_id'];
	$likes = intval(get_post_meta($post_id,'theme_like',true));

	//don't add new like if cookie exists
	if (isset($_COOKIE['saved_post_like_'.$post_id]) && $_COOKIE['saved_post_like_'.$post_id] == 1)
	{
		echo $likes;
		die();
	}
	$likes++;
	setcookie('saved_post_like_'.$post_id,1,time()+60*60*24*30,'/');
	update_post_meta($post_id, 'theme_like',$likes);
	echo $likes;
	die();
}
add_action( 'wp_ajax_nopriv_save_post_like', 'ts_save_post_like_func' );
add_action( 'wp_ajax_save_post_like', 'ts_save_post_like_func' );

/**
 * Get post likes
 * @param type $post_id
 * @return type
 */
function ts_get_theme_likes($post_id = 0)
{
	global $post;

	if (empty($post_id))
	{
		$post_id = $post -> ID;
	}
	return intval(get_post_meta($post_id,'theme_like',true));
}

/**
 * Check if control panel is active
 * @return boolean
 */
function ts_check_if_control_panel()
{
	$control_panel = ot_get_option('control_panel');

	if ($control_panel == 'enabled_admin' && current_user_can('manage_options') || $control_panel == 'enabled_all')
	{
		return true;
	}
	return false;
}

/**
 * Check if control panel is active
 * @return boolean
 */
function ts_check_if_use_control_panel_cookies()
{
	return false;
}

/**
 * Change color
 * @param type $color
 * @param type $percentage_change
 * @return type
 */
function ts_change_color($color, $percentage_change, $return_rgba = false, $transparency = '')
{
    $color = substr( $color, 1 );
    $rgb = '';
    $percentage_change = $percentage_change/100*255;

	//make it darker
    if  ($percentage_change < 0 )
    {

        $per =  abs($percentage_change);
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($color,(2*$x),2)) - $percentage_change;
            $c = ($c < 0) ? 0 : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
	//make it ligher
    else
    {
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($color,(2*$x),2)) + $percentage_change;
            $c = ($c > 255) ? 'ff' : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
	if ($return_rgba)
	{
		return ts_hex_to_rgb($rgb,$transparency);
	}
	else
	{
		return '#'.$rgb;
	}
}

/**
 * Convert color to rgb
 * @param type $color
 * @param type $percentage_change
 * @return type
 */
function ts_hex_to_rgb($hex,$transparency = '') {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return 'rgba('.implode(",", $rgb).(!empty($transparency) ? ', '.$transparency : '').')';
}

/**
 * Get a list of available sliders for theme options
 *
 * @package framework
 * @since framework 1.0
 */
function ts_get_layer_slider_items_for_theme_options()
{
	global $wpdb;

	if($wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix . "layerslider'") != $wpdb->prefix . "layerslider") {
		return false;
	}

    // Get sliders
    $sliders = $wpdb->get_results( "
		SELECT
			*
		FROM
			".$wpdb->prefix . "layerslider
        WHERE
			flag_hidden = '0' AND
			flag_deleted = '0'
        ORDER BY
			date_c ASC
		LIMIT
			100");

    // Iterate over the sliders
	$slider_items = array();

    foreach($sliders as $key => $item) {

		$slider_items[] = array(
			'value'       => 'LayerSlider-'.$item -> id,
			'label'       => 'LayerSlider - '.$item -> name,
			'src'         => ''
		);
	}
	return $slider_items;
}

/**
 * Get font array
 * @param bool $bNoIconChoice
 * @param array $add_icons
 * @param bool $return_theme_options
 * @return array
 */
function ts_getFontAwesomeArray($bNoIconChoice = false,$add_icons = null, $return_theme_options = false)
{
	$icons = array();

	if (is_array($add_icons))
	{
		foreach($add_icons as $key => $icon){
			$icons[$key] = $icon;
		}
	}

//	ts_load_filesystem();
//	WP_Filesystem();
//	global $wp_filesystem;

//	if (ts_request_filesystem_credentials()) {
		if (file_exists(get_template_directory().'/css/fontello.css'))
		{
			$pattern = '/\.(icon-(?:\w+(?:-)?)+)/';

			//$subject = $wp_filesystem->get_contents(get_template_directory().'/css/fontello.css');
			$subject = file_get_contents(get_template_directory().'/css/fontello.css');

			preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

			foreach($matches as $match){
				$icons[$match[1]] = $match[1];
			}
		}

		if (file_exists(get_template_directory().'/css/icomoon.css'))
		{
			//$pattern = '/\.(icomoon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
			$pattern = '/\.(icomoon-(?:\w+(?:-)?)+)/';

			//$subject = $wp_filesystem->get_contents(get_template_directory().'/css/icomoon.css');
			$subject = file_get_contents(get_template_directory().'/css/icomoon.css');

			preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

			foreach($matches as $match){
				$icons[$match[1]] = $match[1];
			}
		}
//	}

	if (count($icons) > 0)
	{
		$icons_return = array();
		if ($bNoIconChoice === true)
		{
			$icons_return['no'] = __('no icon','framework');
		}
		$icons_return = array_merge($icons_return,$icons);

		if ($return_theme_options) {
			$icons_theme_options = array();
			foreach ($icons_return as $key => $icon) {
				$icons_theme_options[] = array(
					'value'       => $key,
					'label'       => $icon,
					'src'         => ''
				);
			}
			return $icons_theme_options;
		}
		
		return $icons_return;
	}

	return array('empty' => __('empty','framework'));
}

/**
 * Process and send mail from shortcode "form"
 * @global bool $shortcode_form_email_sent
 * @return void
 */
function ts_process_form_shortcode() {
	if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'],'shortcode-form_')) {
		return;
	}
	$data = array();
	foreach ($_POST as $key => $val) {
		if (!strstr($key,'shortcode_form_')) {
			continue;
		}
		$data[] = str_replace('shortcode_form_','',$key).': '.filter_var(stripslashes($val), FILTER_SANITIZE_STRING);
	}

	//send email
	if (count($data) > 0) {
		global $shortcode_form_email_sent;
		wp_mail( get_option( 'admin_email' ), __('Form', 'framework').': '.get_the_title(get_the_ID()), implode($data,"\n"));
		$shortcode_form_email_sent = true;
	}
}
add_action('get_header','ts_process_form_shortcode');

/**
 * Get user defined menus
 * @return array
 */
function ts_get_user_defined_menus() {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	
	$menuArray = array();
	foreach ( $menus as $menu ) {
		$menuArray[$menu->term_id] = $menu -> name;
	}
	return $menuArray;
}

/**
 * Request filesystem credentials
 * @param type $method
 * @param type $url
 * @param type $context
 * @return boolean
 */
function ts_request_filesystem_credentials($method = '', $url = '', $context = false) {
	if (strlen($url) <= 0) {
        $url = $_SERVER['REQUEST_URI'];
	}

	$success = true;
    ob_start();
    if (false === ($creds = request_filesystem_credentials($url, $method, false, $context, array()))) {
        $success =  false;
    }
    $form = ob_get_contents();
    ob_end_clean();

    ob_start();
    // If first check failed try again and show error message
    if (!WP_Filesystem($creds) && $success) {
        request_filesystem_credentials($url, $method, true, false, array());
        $success =  false;
        $form = ob_get_contents();
    }
    ob_end_clean();

    $error = '';
    if (preg_match("/<div([^c]+)class=\"error\">(.+)<\/div>/", $form, $matches)) {
        $error = $matches[2];
        $form = str_replace($matches[0], '', $form);
    }
	if (!$success) {
		return $error;
	}
	return true;
}

/**
 * Load WP_Filesystem
 * @return boolean
 */
function ts_load_filesystem() {

	if (function_exists('WP_Filesystem')) {
		return true;
	}
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	return true;
}

/**
 * Get image by attachement_id
 * @param type $image
 * @return type
 */
function ts_get_image_by_id($image) {
	$image_id = intval($image);	
	if (!empty($image_id)) {
		$image = wp_get_attachment_image_src( $image_id, 'full');
		if (is_array($image) && isset($image[0])) {
			return $image[0];
		}
	}
	
	return $image;
}

/**
 * Turn off comments for pages by default
 * @param type $data
 * @return int
 */
function ts_default_comments_off( $data ) {
    if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
        $data['ping_status'] = 0;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'ts_default_comments_off' );

/**
 * Get categories sorted by ts_taxonomy_order$term_id
 * @param type $terms
 */
function ts_get_sorted_terms($terms) {
	
	if (!is_array($terms)) {
		return $terms;
	}
	$terms_order = array();
	$terms_keys = array();
	
	foreach ($terms as $key => $term) {
		$terms_order[$term -> term_id] = intval(get_option('ts_taxonomy_order'.$term -> term_id));
		$terms_keys[$term -> term_id] = $key;
	}
	asort($terms_order);
	$new_terms = array();
	foreach ($terms_order as $term_id => $order) {
		$new_terms[] = $terms[$terms_keys[$term_id]];
	}
	
	return $new_terms;
}