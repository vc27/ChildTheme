<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


/**
 * Composer: Vendor Autoload
 * @since 6.0.2
 **/
require_once( "vendor/autoload.php" );

/**
 * Initiate Addons
 * @since 4.0.0
 **/
require_once( "addons/initiate-addons.php" );

/**
 * ChildTheme
 * @since 4.0.0
 **/
$ChildTheme = new ChildTheme();
$ChildTheme->initChildTheme();
class ChildTheme {

	/**
	 * is_IE
	 * @since 4.0.0
	 **/
	var $is_IE = false;

	/**
	 * ajax_action
	 * @since 4.0.0
	 **/
	var $ajax_action = 'theme-ajax';


	/**
	 * __construct
	 * @since 4.0.0
	 **/
	function __construct() {

		if ( isset( $_GET['is_IE'] ) ) {
			$this->set( 'is_IE', 1 );
		}

		$this->set( 'stylesheet_directory', get_stylesheet_directory() );
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );

	} // end function __construct


	/**
	 * initChildTheme
	 * @since 4.0.0
	 **/
	function initChildTheme() {

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'init', array( $this, 'init' ) );

	} // end function initChildTheme


	/**
	 * set
	 * @since 4.0.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set


	/**
	 * after_setup_theme
	 * @since 4.0.0
	 **/
	function after_setup_theme() {

		// Translations can be added to the /languages/ directory.
		// load_theme_textdomain( 'childtheme', "$this->stylesheet_directory/languages" );
		// load_theme_textdomain( 'parenttheme', $this->ParentTheme->template_directory . "/languages" );

		add_image_size( 'standard', 300, 300, false );
		add_image_size( 'medium', 600, 1000, false );
		add_image_size( 'large', 1000, 2000, false );
		add_image_size( 'large-ex', 2000, 4000, false );

	} // end function after_setup_theme


	/**
	 * init
	 * @since 4.0.0
	 **/
	function init() {

		// add_filter( 'tag_html_attr', array( $this, 'tag_html_attr' ) );
		// add_filter( 'tag_body_attr', array( $this, 'tag_body_attr' ) );

		$this->set( 'ParentTheme', new ParentTheme() );

		$this->ParentTheme->register_sidebars( array(
			'Primary Sidebar' => array(
				'desc' => 'This is the primary widgetized area.',
			),
		) );

		register_nav_menus( array(
			'primary-menu' => __( 'Primary Menu Navigation', 'parenttheme' ),
			'footer-menu' => __( 'Footer Menu Navigation', 'parenttheme' )
		) );

		add_theme_support( 'acf-theme-options' );

		add_action( 'template_redirect', array( $this, 'layout_options' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_style_and_scripts' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'parenttheme-localize_script', array( $this, 'filter_localize_script' ) );

	} // end function init


	####################################################################################################
	/**
	 * Register / De-Register Scripts & CSS
	 **/
	####################################################################################################


	/**
	 * register_style_and_scripts
	 * @since 4.0.0
	 **/
	function register_style_and_scripts() {
		global $is_IE;

		wp_register_style( 'icomoon', "$this->stylesheet_directory_uri/css/icomoon/style.css", array(), null );
		wp_register_style( 'childtheme-style', "$this->stylesheet_directory_uri/css/style.css", array(), null );

		wp_register_script( 'childtheme-scripts', "$this->stylesheet_directory_uri/js/siteScripts.js", array('jquery'), null );

		/*
		if ( $is_IE OR $this->is_IE ) {
			wp_register_style( 'IE8', "$this->stylesheet_directory_uri/css/IE8.css", array(), null );
			wp_register_style( 'IE9', "$this->stylesheet_directory_uri/css/IE9.css", array(), null );
		}
		*/

	} // end function register_style_and_scripts


	####################################################################################################
	/**
	 * Front End - Enqueue, Print & other menial labor
	 **/
	####################################################################################################


	/**
	 * layout_options
	 * @since 4.0.0
	 **/
	function layout_options() {

		// Archive Post Navigation
		add_action( 'after-loop', 'previous_next___posts_link' );

		// Single Post Navigation
		add_action( 'after-loop', 'previous_next___post_link' );

		// Add Page Title
		add_action( 'before-loop', 'archive__title' );


	} // end function layout_options


	/**
	 * wp_enqueue_scripts
	 * @since 4.0.0
	 **/
	function wp_enqueue_scripts() {
		global $is_IE;

		// Styles
		wp_enqueue_style( 'icomoon' );
		wp_enqueue_style( 'childtheme-style' );

		// IE
		/*
		if ( $is_IE OR $this->is_IE ) {
			global $wp_styles;
			wp_enqueue_style( 'IE8' );
			wp_enqueue_style( 'IE9' );
			$wp_styles->add_data( 'IE8', 'conditional', 'lt IE 9' );
			$wp_styles->add_data( 'IE9', 'conditional', 'lt IE 10' );
		}
		*/

		// JS Scripts
		wp_enqueue_script( 'childtheme-scripts' );

	} // function wp_enqueue_scripts


	/**
	 * filter_localize_script
	 * @since 4.0.0
	 **/
	function filter_localize_script( $array ) {

		$array['action'] = $this->ajax_action;
		$array['ajaxurl'] = admin_url( 'admin-ajax.php' );

		return $array;

	} // function filter_localize_script


	/**
	 * tag_html_attr
	 **/
	function tag_html_attr( $attr ) {

		$attr = " ng-app=\"ngApp\" ng-controller=\"ngAppCtrl\" ng-cloak";

		return $attr;

	} // end function tag_html_attr


	/**
	 * tag_body_attr
	 **/
	function tag_body_attr( $attr ) {

		$attr = " ng-controller=\"anotherApp\"";

		return $attr;

	} // end function tag_body_attr


} // end class ChildTheme
