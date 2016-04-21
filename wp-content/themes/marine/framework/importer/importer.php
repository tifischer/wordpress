<?php
if (!defined( 'ABSPATH' )) {
	die( 'You cannot access this script directly' );
}

// Hook importer into admin init
if (isset($_GET['import_sample_data']) && $_GET['import_sample_data'] == 1) {
	@ini_set('max_execution_time', 600); //execution time increased to 10 minutes
	add_action( 'admin_init', 'ts_importer_init' );
}

/**
 * Importer init
 * @global type $ts_import_notice
 * @global string $ts_import_notice_type
 */
function ts_importer_init() {
	
	global $ts_import_notice, $ts_import_notice_type;
	
	try {
		$importer = new ts_importer;
		
		if ($importer -> init()) {		
			wp_redirect( admin_url( 'themes.php?page=ot-theme-options&imported_sample_data=1' ) );
		}
		
	} catch (Exception $e) {
		
		$ts_import_notice = $e->getMessage();
		$ts_import_notice_type = 'error';
	}
}

/**
 * Print import notice
 * @global type $ts_import_notice
 * @global type $ts_import_notice_type
 */
function ts_import_notice() {
    
	global $ts_import_notice, $ts_import_notice_type;
	
	if (isset($_GET['imported_sample_data']) && $_GET['imported_sample_data'] == 1): ?>
		<div class="updated">
			<p><?php _e('Import completed', 'framework'); ?></p>
		</div>
	<?php elseif (isset($ts_import_notice) && !empty($ts_import_notice)): ?>
		<div class="<?php echo $ts_import_notice_type; ?>">
			<p><?php echo $ts_import_notice ?></p>
		</div>
	<?php endif;
}
add_action( 'admin_notices', 'ts_import_notice' );

class ts_importer {
	
	/**
	 * Import starts if initiated and value is true, otherwise does not start
	 * @var bool 
	 */
	var $import = false;
	
	/**
	 * Revolution slider UniteDBRev class object
	 * @var object
	 */
	var $db = null;
	
	/**
	 * Construct
	 */
	public function __construct() {
		
		if ( current_user_can( 'manage_options' ) && isset( $_GET['import_sample_data'] ) ) {
			$this -> import = true;
			
			if ( !defined('WP_LOAD_IMPORTERS') ) {
				define('WP_LOAD_IMPORTERS', true); 
			}
		}
	}
	
	/**
	 * Init importer
	 * @return boolean false if import failed
	 */
	public function init() {
		
		if ($this -> import !== true) {
			return false;
		}
		
		if (!$this -> include_files()) {
			return false;
		}
				
		if( class_exists('Woocommerce') ) {
			$this -> import('data_woocommerce.xml');
			$this -> set_woocommerce();
			
		} else {
			$this -> import('data.xml');
		}
		
		$this -> set_menus();
		$this -> import_theme_options();
		$this -> import_widgets();
		$this -> import_revolution_slider();
		$this -> set_reading_options();
		return true;
	}
	
	/**
	 * Include requried classes
	 * @return boolean true if all required files are included, false otherwise
	 */
	protected function include_files() {
		
		if (!class_exists( 'WP_Importer')) {
            include_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        }

        if (!class_exists('WP_Import')) {
            include_once get_template_directory() . '/framework/importer/wordpress-importer.php';
        }
		
		//check if required importer classes exist
		if (!class_exists('WP_Importer') || !class_exists('WP_Import')) {
			return false;
		}
		return true;
	}
	
	/**
	 * Import file with data including posts, pages, comments, custom fields, terms, navigation menus and custom posts and settings
	 * @param string file name to import eg. data.xml or data_woocommerce.xml
	 * @return boolean
	 */
	protected function import($file) {
		
		$importer = new WP_Import();
         
		$xml = get_template_directory() . '/sample_data/'.$file;
		
		if (!file_exists($xml)) {
			throw new Exception(sprintf(__('File %s not found.','framework'),$xml).' <br/><strong>'.__('Import stopped!','framework').'</strong>');
		}
		
		$importer->fetch_attachments = true;
		ob_start();
		$importer->import($xml);
		ob_end_clean();
		
		return true;
	}
	
	/**
	 * Set woocommerce pages
	 * @return boolean
	 */
	protected function set_woocommerce() {
		
		global $wpdb;
		
		$pages = array(
			'woocommerce_shop_page_id' => 'shop',
			'woocommerce_cart_page_id' => 'cart',
			'woocommerce_checkout_page_id' => 'checkout',
			'woocommerce_myaccount_page_id' => 'my-account',
			'woocommerce_lost_password_page_id' => 'lost-password',
			'woocommerce_edit_address_page_id' => 'edit-address',
			'woocommerce_view_order_page_id' => 'view-order',
			'woocommerce_change_password_page_id' => 'change-password',
			'woocommerce_logout_page_id' => 'logout',	
			'woocommerce_pay_page_id' => 'pay',
			'woocommerce_thanks_page_id' => 'order-received'
		);
		foreach($pages as $page_key => $slug) {
			
			$page = $wpdb -> get_row($wpdb -> prepare('SELECT * FROM '.$wpdb -> posts.' WHERE post_name= %s', $slug));
			if(isset( $page->ID ) && $page->ID) {
				update_option($page_key, $page->ID);
			}
		}
		
		// We no longer need to install pages
		delete_option( '_wc_needs_pages' );
		delete_transient( '_wc_activation_redirect' );

		// Flush rules after install
		flush_rewrite_rules();
		return true;
	}
	
	/**
	 * Set menus
	 * @return boolean
	 */
	protected function set_menus() {
		
		$registered_menus = get_registered_nav_menus();
		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		
		if ($registered_menus && $menus) {
			foreach ($registered_menus as $registered_menu_key => $registered_menu) {
				foreach ($menus as $menu) {
					
					if (stristr($menu->slug,$registered_menu_key)) {
						
						if (!is_array($locations)) {
							$locations = array();
						}
						
						$locations[$registered_menu_key] = $menu -> term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
		}
		return true;
	}
	
	/**
	 * Import theme options
	 * @return boolean
	 */
	protected function import_theme_options() {
		
		$theme_options_file = get_template_directory() . '/sample_data/theme_options.txt';
		$theme_options = file_get_contents( $theme_options_file );
		$data = unserialize(ot_decode( $theme_options ));
		$data = $this -> download_images($data);
		update_option( ot_options_id(), $data);
		return true;
	}
	
	protected function import_widgets() {
		$widget_data_file = get_template_directory() . '/sample_data/widget_data.json';
		
		$widget_data_json = file_get_contents( $widget_data_file );
		$json_data = json_decode($widget_data_json, true);
		
		if (!is_array($json_data)) {
			return false;
		}
		
		$sidebar_data = $json_data[0];
		$widget_data = $json_data[1];
		
		foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
			$widgets[ $widget_data_title ] = '';
			foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
				if( is_int( $widget_data_key ) ) {
					$widgets[$widget_data_title][$widget_data_key] = 'on';
				}
			}
		}
		unset($widgets[""]);
		
		foreach ( $sidebar_data as $title => $sidebar ) {
			
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}

		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}

		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		$status = $this -> parse_widget_import_data( $sidebar_data );
				
		return true;
	}
	
	/**
	 * Parsing widget import data
	 * Thanks to http://wordpress.org/plugins/widget-settings-importexport/
	 * @param type $import_array
	 * @return boolean
	 */
	protected function parse_widget_import_data( $import_array ) {
		$sidebars_data = $import_array[0];
		$widget_data = $import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		
		$new_widgets = array( );
		
		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
				
				//if the sidebar exists
				if ( array_key_exists($import_sidebar, $current_sidebars) ) :
					
					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name = $this -> get_new_widget_name( $title, $index );
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = $current_widget_data['_multiwidget'];
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}
				endif;
			endforeach;
		endforeach;
		
		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );
			
			foreach ( $new_widgets as $title => $content ) {
				$content = apply_filters( 'widget_data_import', $content, $title );
				
				update_option( 'widget_' . $title, $content );
			}
			
			return true;
		}

		return false;
	}
	
	/**
	 * New widget name
	 * @param string $widget_name
	 * @param string $widget_index
	 * @return string
	 */
	protected function get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}

	/**
	 * Import Revolution Slider
	 * @return boolean
	 */
	protected function import_revolution_slider() {
		
		if( !class_exists('UniteFunctionsRev') ) { // if revslider is activated
			//throw new Exception(__('Revslider is not activated', 'framework'));
			return false;
		}
		
		$this->db = new UniteDBRev();
		
		$rev_slider_dir = get_template_directory() . '/sample_data/revslider/';
		
		//get available sliders list
		$rev_slider_files = array();
		$found_files = glob( $rev_slider_dir . '*.zip' );
		if (is_array($found_files) && count($found_files) > 0) {
			foreach($found_files  as $filename ) {
				$filename = basename($filename);
				$rev_slider_files[] = get_template_directory() . '/sample_data/revslider/' . $filename ;
			}
		}
		
		if (count($rev_slider_files) > 0) {
			foreach( $rev_slider_files as $filepath ) {
				$this -> import_revolution_slider_item($filepath);
			}
		}
		return true;
	}
	
	/**
	 * 
	 * @param type $filepath
	 * @return boolean
	 */
	protected function import_revolution_slider_item($filepath) {
		
		if(file_exists($filepath) == false) {
			UniteFunctionsRev::throwError("Import file not found ".$filepath." !!!");
		}
		
		//check if zip file or fallback to old, if zip, check if all files exist
		if(!class_exists("ZipArchive")){
			$importZip = false;
		}else{
			
			$zip = new ZipArchive;
			$importZip = $zip->open($filepath, ZIPARCHIVE::CREATE);
		}
		
		if($importZip === true){ //true or integer. If integer, its not a correct zip file

			//check if files all exist in zip
			$slider_export = $zip->getStream('slider_export.txt');
			$custom_animations = $zip->getStream('custom_animations.txt');
			$dynamic_captions = $zip->getStream('dynamic-captions.css');
			$static_captions = $zip->getStream('static-captions.css');

			if(!$slider_export)  {
				UniteFunctionsRev::throwError("slider_export.txt does not exist!");
			}
			//if(!$custom_animations)  UniteFunctionsRev::throwError("custom_animations.txt does not exist!");
			//if(!$dynamic_captions) UniteFunctionsRev::throwError("dynamic-captions.css does not exist!");
			//if(!$static_captions)  UniteFunctionsRev::throwError("static-captions.css does not exist!");

			$content = '';
			$animations = '';
			$dynamic = '';
			$static = '';
			
			while (!feof($slider_export)) $content .= fread($slider_export, 1024);
			if($custom_animations){ while (!feof($custom_animations)) $animations .= fread($custom_animations, 1024); }
			if($dynamic_captions){ while (!feof($dynamic_captions)) $dynamic .= fread($dynamic_captions, 1024); }
			if($static_captions){ while (!feof($static_captions)) $static .= fread($static_captions, 1024); }

			fclose($slider_export);
			if($custom_animations){ fclose($custom_animations); }
			if($dynamic_captions){ fclose($dynamic_captions); }
			if($static_captions){ fclose($static_captions); }

			//check for images!

		}else{ //check if fallback
			//get content array
			$content = @file_get_contents($filepath);
		}

		if($importZip === true){ //we have a zip
			$db = new UniteDBRev();

			//update/insert custom animations
			$animations = @unserialize($animations);
			if(!empty($animations)){
				foreach($animations as $key => $animation){ //$animation['id'], $animation['handle'], $animation['params']
					$exist = $db->fetch(GlobalsRevSlider::$table_layer_anims, "handle = '".$animation['handle']."'");
					if(!empty($exist)){ //update the animation, get the ID
						if($updateAnim == "true"){ //overwrite animation if exists
							$arrUpdate = array();
							$arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
							$db->update(GlobalsRevSlider::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));

							$id = $exist['0']['id'];
						}else{ //insert with new handle
							$arrInsert = array();
							$arrInsert["handle"] = 'copy_'.$animation['handle'];
							$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

							$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
						}
					}else{ //insert the animation, get the ID
						$arrInsert = array();
						$arrInsert["handle"] = $animation['handle'];
						$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

						$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
					}

					//and set the current customin-oldID and customout-oldID in slider params to new ID from $id
					$content = str_replace(array('customin-'.$animation['id'], 'customout-'.$animation['id']), array('customin-'.$id, 'customout-'.$id), $content);	
				}
				//dmp(__("animations imported!",REVSLIDER_TEXTDOMAIN));
			}else{
				//dmp(__("no custom animations found, if slider uses custom animations, the provided export may be broken...",REVSLIDER_TEXTDOMAIN));
			}

			//overwrite/append static-captions.css
			if(!empty($static)){
				if($updateStatic == "true"){ //overwrite file
					RevOperations::updateStaticCss($static);
				}else{ //append
					$static_cur = RevOperations::getStaticCss();
					$static = $static_cur."\n".$static;
					RevOperations::updateStaticCss($static);
				}
			}
			//overwrite/create dynamic-captions.css
			//parse css to classes
			$dynamicCss = UniteCssParserRev::parseCssToArray($dynamic);

			if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0){
				foreach($dynamicCss as $class => $styles){
					//check if static style or dynamic style
					$class = trim($class);

					if((strpos($class, ':hover') === false && strpos($class, ':') !== false) || //before, after
						strpos($class," ") !== false || // .tp-caption.imageclass img or .tp-caption .imageclass or .tp-caption.imageclass .img
						strpos($class,".tp-caption") === false || // everything that is not tp-caption
						(strpos($class,".") === false || strpos($class,"#") !== false) || // no class -> #ID or img
						strpos($class,">") !== false){ //.tp-caption>.imageclass or .tp-caption.imageclass>img or .tp-caption.imageclass .img
						continue;
					}

					//is a dynamic style
					if(strpos($class, ':hover') !== false){
						$class = trim(str_replace(':hover', '', $class));
						$arrInsert = array();
						$arrInsert["hover"] = json_encode($styles);
						$arrInsert["settings"] = json_encode(array('hover' => 'true'));
					}else{
						$arrInsert = array();
						$arrInsert["params"] = json_encode($styles);
					}
					//check if class exists
					$result = $db->fetch(GlobalsRevSlider::$table_css, "handle = '".$class."'");

					if(!empty($result)){ //update
						$db->update(GlobalsRevSlider::$table_css, $arrInsert, array('handle' => $class));
					}else{ //insert
						$arrInsert["handle"] = $class;
						$db->insert(GlobalsRevSlider::$table_css, $arrInsert);
					}
				}
				//dmp(__("dynamic styles imported!",REVSLIDER_TEXTDOMAIN));
			}else{
				//dmp(__("no dynamic styles found, if slider uses dynamic styles, the provided export may be broken...",REVSLIDER_TEXTDOMAIN));
			}
		}

		$content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $content); //clear errors in string

		$arrSlider = @unserialize($content);
			if(empty($arrSlider)) {
				UniteFunctionsRev::throwError("Wrong export slider file format! This could be caused because the ZipArchive extension is not enabled.");	
			}

		//update slider params
		$sliderParams = $arrSlider["params"];

//		if($sliderExists){					
//			$sliderParams["title"] = $this->arrParams["title"];
//			$sliderParams["alias"] = $this->arrParams["alias"];
//			$sliderParams["shortcode"] = $this->arrParams["shortcode"];
//		}

		if(isset($sliderParams["background_image"]))
			$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);

		$json_params = json_encode($sliderParams);

		//update slider or create new
//		if($sliderExists){
//			$arrUpdate = array("params"=>$json_params);	
//			$this->db->update(GlobalsRevSlider::$table_sliders,$arrUpdate,array("id"=>$sliderID));
//		}else{	//new slider
			$arrInsert = array();
			$arrInsert["params"] = $json_params;
			$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
			$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");	
			$sliderID = $this->db->insert(GlobalsRevSlider::$table_sliders,$arrInsert);
//		}

		//-------- Slides Handle -----------

		//delete current slides
//		if($sliderExists)
//			$this->deleteAllSlides();

		//create all slides
		$arrSlides = $arrSlider["slides"];

		$alreadyImported = array();

		foreach($arrSlides as $slide){

			$params = $slide["params"];
			$layers = $slide["layers"];

			//convert params images:
			if(isset($params["image"])){
				//import if exists in zip folder
				if(strpos($params["image"], 'http') !== false){
				}else{
					if(trim($params["image"]) !== ''){
						if($importZip === true){ //we have a zip, check if exists
							$image = $zip->getStream('images/'.$params["image"]);
							if(!$image){
								echo $params["image"].__(' not found!<br>');

							}else{
								if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]])){
									$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$params["image"], $sliderParams["alias"].'/');

									if($importImage !== false){
										$alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]] = $importImage['path'];

										$params["image"] = $importImage['path'];
									}
								}else{
									$params["image"] = $alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]];
								}


							}
						}
					}
					$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
				}
			}

			//convert layers images:
			foreach($layers as $key=>$layer){					
				if(isset($layer["image_url"])){
					//import if exists in zip folder
					if(trim($layer["image_url"]) !== ''){
						if(strpos($layer["image_url"], 'http') !== false){
						}else{
							if($importZip === true){ //we have a zip, check if exists
								$image_url = $zip->getStream('images/'.$layer["image_url"]);
								if(!$image_url){
									echo $layer["image_url"].__(' not found!<br>');
								}else{
									if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]])){
										$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$layer["image_url"], $sliderParams["alias"].'/');

										if($importImage !== false){
											$alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]] = $importImage['path'];

											$layer["image_url"] = $importImage['path'];
										}
									}else{
										$layer["image_url"] = $alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]];
									}
								}
							}
						}
					}
					$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
					$layers[$key] = $layer;
				}
			}

			//create new slide
			$arrCreate = array();
			$arrCreate["slider_id"] = $sliderID;
			$arrCreate["slide_order"] = $slide["slide_order"];

			$my_layers = json_encode($layers);
			if(empty($my_layers))
				$my_layers = stripslashes(json_encode($layers));
			$my_params = json_encode($params);
			if(empty($my_params))
				$my_params = stripslashes(json_encode($params));


			$arrCreate["layers"] = $my_layers;
			$arrCreate["params"] = $my_params;

			$this->db->insert(GlobalsRevSlider::$table_slides,$arrCreate);									
		}

		//check if static slide exists and import
		if(isset($arrSlider['static_slides']) && !empty($arrSlider['static_slides'])){
			$static_slide = $arrSlider['static_slides'];
			foreach($static_slide as $slide){

				$params = $slide["params"];
				$layers = $slide["layers"];

				//convert params images:
				if(isset($params["image"])){
					//import if exists in zip folder
					if(strpos($params["image"], 'http') !== false){
					}else{
						if(trim($params["image"]) !== ''){
							if($importZip === true){ //we have a zip, check if exists
								$image = $zip->getStream('images/'.$params["image"]);
								if(!$image){
									echo $params["image"].__(' not found!<br>');

								}else{
									if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]])){
										$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$params["image"], $sliderParams["alias"].'/');

										if($importImage !== false){
											$alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]] = $importImage['path'];

											$params["image"] = $importImage['path'];
										}
									}else{
										$params["image"] = $alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]];
									}


								}
							}
						}
						$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
					}
				}

				//convert layers images:
				foreach($layers as $key=>$layer){					
					if(isset($layer["image_url"])){
						//import if exists in zip folder
						if(trim($layer["image_url"]) !== ''){
							if(strpos($layer["image_url"], 'http') !== false){
							}else{
								if($importZip === true){ //we have a zip, check if exists
									$image_url = $zip->getStream('images/'.$layer["image_url"]);
									if(!$image_url){
										echo $layer["image_url"].__(' not found!<br>');
									}else{
										if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]])){
											$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$layer["image_url"], $sliderParams["alias"].'/');

											if($importImage !== false){
												$alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]] = $importImage['path'];

												$layer["image_url"] = $importImage['path'];
											}
										}else{
											$layer["image_url"] = $alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]];
										}
									}
								}
							}
						}
						$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
						$layers[$key] = $layer;
					}
				}

				//create new slide
				$arrCreate = array();
				$arrCreate["slider_id"] = $sliderID;

				$my_layers = json_encode($layers);
				if(empty($my_layers))
					$my_layers = stripslashes(json_encode($layers));
				$my_params = json_encode($params);
				if(empty($my_params))
					$my_params = stripslashes(json_encode($params));


				$arrCreate["layers"] = $my_layers;
				$arrCreate["params"] = $my_params;

//				if($sliderExists){
//					unset($arrCreate["slider_id"]);
//					$this->db->update(GlobalsRevSlider::$table_static_slides,$arrCreate,array("slider_id"=>$sliderID));
//				}else{
					$this->db->insert(GlobalsRevSlider::$table_static_slides,$arrCreate);									
//				}
			}
		}
	}
	
	/**
	 * Set reading options
	 * @global type $wpdb
	 * @return boolean
	 */
	protected function set_reading_options() {
		
		global $wpdb;
		
		$homepage = $wpdb -> get_row('SELECT * FROM '.$wpdb -> posts.' WHERE post_name="home"');
		
		if(isset( $homepage ) && $homepage->ID) {
			update_option('show_on_front', 'page');
			update_option('page_on_front', $homepage->ID);
		}
		return true;
	}

		/**
	 * Download images
	 * @param type $data
	 * @return type
	 */
	protected function download_images($data) {
		
		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = $this -> download_images($val);
			}
		} else {
			
			$image_exp = '!http://[a-z0-9\-\.\/]+\.(?:jpe?g|png|gif)!Ui';
			
			if (preg_match_all($image_exp , $data , $matches)) {
				
				if (isset($matches[0]) && is_array($matches[0])) {
					foreach ($matches[0] as $match) {
						
						$new_image = media_sideload_image( $match, null );
						
						if (!is_wp_error($new_image)) {
							
							//$new_image is html tag img, we need to retrieve src attribute
							$dom = new DOMDocument();
							$dom -> loadHTML($new_image);
							$imageTags = $dom->getElementsByTagName('img') -> item(0);
							$data = $imageTags->getAttribute('src');
						}
					}
				}
			}
		}
		return $data;
	}
}