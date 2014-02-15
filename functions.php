<?php
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.3
 * @updated 10.17.13
 **/
#################################################################################################### */



/**
 * ThemeCompatibility
 * 
 * @access public
 * @var int
 **/
$ThemeCompatibility = 4.9;



/**
 * Initiate Addons
 **/
require_once( "addons/initiate-addons.php" );






/**
 * ChildTheme_VC Class
 *
 * @version 1.5
 * @updated 10.17.13
 **/
$ChildTheme_VC = new ChildTheme_VC();
$ChildTheme_VC->set( 'ThemeCompatibility', $ThemeCompatibility );
$ChildTheme_VC->init_child_theme();
class ChildTheme_VC {
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 10.17.13
	 **/
	function __construct() {
		
		$this->set( 'stylesheet_directory', get_stylesheet_directory() );
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );
		$this->set( 'ajax_action', 'vc-ajax' );
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * init_child_theme
	 *
	 * @version 1.0
	 * @updated 10.17.13
	 **/
	function init_child_theme() {
		
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		add_action( 'init', array( &$this, 'init' ) );
		
	} // end function init_child_theme
	
	
	
	
	
	
	/**
     * set
     *
     * @version 1.0
     * @updated 00.00.13
     **/
    function set( $key, $val = false ) {

        if ( isset( $key ) AND ! empty( $key ) ) {
            $this->$key = $val;
        }

    } // end function set
	
	
	
	
	
	
	/**
	 * After Setup Theme
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function after_setup_theme() {
		
		// Translations can be added to the /languages/ directory.
		load_theme_textdomain( 'childtheme', "$this->stylesheet_directory/languages" );
		load_theme_textdomain( 'parenttheme', $this->parent_theme->template_directory . "/languages" );
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function init() {
		
		// Add Parent Theme class
		$this->set( 'parent_theme', new ParentTheme_VC() );
		
		
		// register_sidebars
		$register_sidebars = $this->parent_theme->register_sidebars( array(
			'Primary Sidebar' => array(
				'desc' => 'This is the primary widgetized area.',
				),
			) );
		
		
		// register_nav_menus
		register_nav_menus( array(
			'primary-navigation' => 'Primary Navigation',
			'footer-navigation' => 'Footer Navigation'
			) );
		
		
		// register styles and scripts
		$this->register_style_and_scripts();
		
		
		/**
		 * Front End - Enqueue, Print & other menial labor
		 **/
		
		add_action( 'wp_head', array( &$this, 'wp_head' ) );
		
		// Layout Options
		add_action( 'template_redirect', array( &$this, 'layout_options' ) );
		
		// CSS // wp_print_styles
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_print_styles' ) );
		
		// Javascripts // wp_enqueue_scripts // wp_print_scripts
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		// add_filter( 'parenttheme-localize_script', array( &$this, 'localize_script' ) );
		
		// Breadcrumb Navigation
		// add_action( 'inner_wrap_top', array( &$this, 'breadcrumb_navigation' ) );
		
		// Login Scripts
		add_action( 'login_enqueue_scripts', array( &$this, 'login_enqueue_scripts' ) );
		
		// Admin Menu and Links
		add_action( 'admin_menu', array( &$this, 'remove_mene_page' ), 99 );
		add_action( 'admin_menu', array( &$this, 'remove_submenus' ), 200 );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * Admin Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function admin_init() {
		
		
		
	} // end function admin_init 
	
	
	
	
	
	
	/**
	 * Widgets Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function widgets_init() {
		
		// widgets_init
		
	} // end function widgets_init
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Register / De-Register Scripts & CSS
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Register Styles and Scripts
	 *
	 * @version 1.6
	 * @updated 02.11.13
	 **/
	function register_style_and_scripts() {
		
		/**
		 * CSS
		 **/
		wp_register_style( 'icomoon', "$this->stylesheet_directory_uri/css/icomoon/style.css" );
		wp_register_style( 'google-fonts', "http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:400italic,700italic,400,700" );
		wp_register_style( 'childtheme-default', "$this->stylesheet_directory_uri/css/default.css" );
		wp_register_style( 'childtheme-responsive', "$this->stylesheet_directory_uri/css/responsive.css" );
		
		
		
		/**
		 * JS
		 **/
		
		// Custom JS
		wp_register_script( 'childTheme', "$this->stylesheet_directory_uri/js/childTheme.js", array( 'helper' ) );
		
	} // end function register_style_and_scripts
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Front End - Enqueue, Print & other menial labor
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * wp_head
	 * 
	 * @version 1.0
	 * @updated	00.00.00
	 **/
	function wp_head() {
		
		echo "\n<link rel=\"icon\" type=\"image/png\" href=\"/favicon.png\" />\n";

	} // end function wp_head 
	
	
	
	
	
	
	/**
	 * Add Actions
	 * 
	 * @version 1.2
	 * @updated	11.18.12
	 * 
	 * These actions will add various items to the site.
	 * You are free to turn them off or move them around.
	 * 
	 * ToDo: remove apply_filters. add_action is the same thing, 
	 * this is doubling up on an item that does not need it.
	 **/
	function layout_options() {
		
		// Archive Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_posts' );
		
		// Single Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_post' );
		
		// Add Page Title
		add_action( 'inner_wrap_top', 'vc_page_title' );


	} // end function layout_options
	
	
	
	
	
	
	/**
	 * Add CSS
	 *
	 * @version 1.5
	 * @updated 10.20.12
	 **/
	function wp_print_styles() {
		
		wp_enqueue_style( 'parenttheme-reset' );		
		wp_enqueue_style( 'bootstrap-responsive' );
		wp_enqueue_style( 'icomoon' );
		wp_enqueue_style( 'google-fonts' );		
		wp_enqueue_style( 'childtheme-default' );		
		wp_enqueue_style( 'childtheme-responsive' );

	} // end function wp_print_styles
	
	
	
	
	
	
	/**
	 * Enqueue Scripts
	 *
	 * @version 1.4
	 * @updated 11.18.12
	 **/
	function wp_enqueue_scripts() {
		
		/**
		 * Notes on helper
		 * 
		 * Helper script pulls in all necessary scripts from parenttheme.
		 * It is added here to ensure it is called before child-custom.
		 * Do not add it as a dependent to childtheme-style or else 
		 * deregistering will be more of a pain in the ass.
		 **/
		wp_enqueue_script( 'helper' );		
		wp_enqueue_script( 'childTheme' );
		
	} // function wp_enqueue_scripts 
	
	
	
	
	
	
	/**
	 * Localize Scripts
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function localize_script( $array ) {
		
		$array['action'] = $this->ajax_action;
		$array['ajaxurl'] = admin_url( 'admin-ajax.php' );
		
		return $array;
		
	} // function localize_script
	
	
	
	
	
	
	/**
	 * login_enqueue_scripts
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 *
	 * Note: You can use the login_enqueue_scripts hook to insert CSS
	 * reference: http://codex.wordpress.org/Customizing_the_Login_Form#Change_the_Login_Logo
	 **/
	function login_enqueue_scripts() {
		
		wp_enqueue_style( 'login-style' );
		
	} // end function login_enqueue_scripts
	
	
	
	
	
	
	/**
	 * BreadCrumb Nav
	 *
	 * @version 0.1
	 * @update	11.16.12
	 **/
	function breadcrumb_navigation() {
		
		if ( ! get_vc_option( 'post_display', 'childpage_breadcrumb' ) ) {
			return;
		} else {
			
			require_once( $this->parent_theme->template_directory . "/includes/classes/Breadcrumb_Navigation_VC.php" );
			
			// Breadcrumb Navigation
			$this->set( 'breadcrumb', new Breadcrumb_Navigation_VC() );
			$this->breadcrumb->breadcrumb_navigation( array(
				'before' => '<div id="navigation-breadcrumb-inner-wrap">',
				'after' => '</div>',
				) );
			
		}
		
	} // end function breadcrumb_navigation
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin Menu & Links
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Remove Menu Pages
	 * 
	 * @version 0.1
	 * @updated 11.18.12
	 **/
    function remove_mene_page() {
		
		// remove_menu_page( 'edit.php' );
		remove_menu_page( 'link-manager.php' );
		// remove_menu_page( 'edit-comments.php' );
        
    } // end function remove_mene_page

	
	
	
	
	
	/**
	 * Remove Sub Menu Pages
	 * 
	 * @version 0.1
	 * @updated 11.18.12
	 **/
	function remove_submenus() {
		global $submenu;
		
		// print_r($submenu);
		
		// Dashboard menu
		// unset($submenu['index.php'][10]); // Removes Updates
		
		// Posts menu
		// unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
		// unset($submenu['edit.php'][10]); // Add new post
		// unset($submenu['edit.php'][15]); // Remove categories
		// unset($submenu['edit.php'][16]); // Removes Post Tags
		
		// Media Menu
		// unset($submenu['upload.php'][5]); // View the Media library
		// unset($submenu['upload.php'][10]); // Add to Media library
		
		// Links Menu
		//  unset($submenu['link-manager.php'][5]); // Link manager
		//  unset($submenu['link-manager.php'][10]); // Add new link
		//  unset($submenu['link-manager.php'][15]); // Link Categories
		
		// Pages Menu
		// unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
		// unset($submenu['edit.php?post_type=page'][10]); // Add New page
		
		// Appearance Menu
		// unset($submenu['themes.php'][5]); // Removes 'Themes'
		// unset($submenu['themes.php'][7]); // Widgets
		unset($submenu['themes.php'][12]); // Removes Theme Editor
		
		// Plugins Menu
		// unset($submenu['plugins.php'][5]); // Plugin Manager
		// unset($submenu['plugins.php'][10]); // Add New Plugins
		unset($submenu['plugins.php'][15]); // Plugin Editor
		
		// Users Menu
		// unset($submenu['users.php'][5]); // Users list
		// unset($submenu['users.php'][10]); // Add new user
		// unset($submenu['users.php'][15]); // Edit your profile
		
		// Tools Menu
		unset($submenu['tools.php'][5]); // Tools area
		// unset($submenu['tools.php'][10]); // Import
		// unset($submenu['tools.php'][15]); // Export
		// unset($submenu['tools.php'][20]); // Upgrade plugins and core files
		
		// Settings Menu
		// unset($submenu['options-general.php'][10]); // General Options
		// unset($submenu['options-general.php'][15]); // Writing
		// unset($submenu['options-general.php'][20]); // Reading
		// unset($submenu['options-general.php'][25]); // Discussion
		// unset($submenu['options-general.php'][30]); // Media
		// unset($submenu['options-general.php'][35]); // Privacy
		// unset($submenu['options-general.php'][40]); // Permalinks
		// unset($submenu['options-general.php'][45]); // Misc
		
		// print_r($submenu);
		
	} // end function remove_submenus
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Child Theme Options
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Child Options
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 * 
	 * Notes:
	 * This function can be used to filter the default options.
	 * e.g. remove an options metabox or alter a portion of the 
	 * default array from includes / options / default-options.php
	 **/
	function filter_default_vc_options( $default_options ) {
		
		return $default_options;
		
	} // function filter_default_vc_options
	
	
	
	
} // end class ChildTheme_VC