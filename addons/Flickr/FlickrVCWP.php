<?php
/**
 * File Name FlickrVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * FlickrVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$FlickrVCWP = new FlickrVCWP();
class FlickrVCWP {
	
	
	
	/**
	 * use_transient
	 * 
	 * @access public
	 * @var bool
	 **/
	static $use_transient = 1;
	
	
	
	/**
	 * transient_expiration
	 * 
	 * @access public
	 * @var string
	 **/
	static $transient_expiration = 2592000; // 30 days in seconds
	
	
	
	/**
	 * delete_transient
	 * 
	 * @access public
	 * @var bool
	 **/
	static $delete_transient = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// hook method after_setup_theme
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		add_shortcode( 'flickr_set', array( &$this, 'shortcode__photoset' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		// 
		
	} // end function admin_init
	
	
	
	
	
	
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
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * sss
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function sss() {
		
		// sss
		
	} // end function sss
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Static
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * photoset
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	static function photoset( $id, $args, $size, $image_args = array() ) {
		
		if ( ! class_exists( 'DisplayFlickrVC' ) ) {
			require_once( "DisplayFlickrVC.php" );
		}
		
		if ( class_exists( 'DisplayFlickrVC' ) ) {
			$flickr = new DisplayFlickrVC();
			
			$flickr->set( 'delete_transient', self::$delete_transient );
			$flickr->set( 'use_transient', self::$use_transient );
			$flickr->set( 'transient_expiration', self::$transient_expiration );
			
			return $flickr->get_photoset( $id, $args, $size, $image_args );
			
		} else {
			
			return false;
			
		}
		
	} // end function photoset
	
	
	
	
	
	
	/**
	 * shortcode__photoset
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	static function shortcode__photoset( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'id' => false,
			'size' => 'medium-640',
			'permalink' => true,
			'before' => '<div class="image-wrap">',
			'after' => '</div>',
			), $atts ) );
		
		if ( isset( $id ) AND ! empty( $id ) ) {
			
			$output = "<div class=\"flickr-gallery\">" . self::photoset( $id, array(
				'media' => 'photos'
			), $size, array(
				'permalink' => $permalink,
				'before' => $before,
				'after' => $after,
			) ) . "</div>";
			
		} else {
			
			$output = false;
			
		}
		
		return $output;
		
			
	} // end static function shortcode__photoset
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_something
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_something() {
		
		if ( isset( $this->something ) AND ! empty( $this->something ) ) {
			$this->set( 'have_something', 1 );
		} else {
			$this->set( 'have_something', 0 );
		}
		
		return $this->have_something;
		
	} // end function have_something
	
	
	
} // end class FlickrVCWP