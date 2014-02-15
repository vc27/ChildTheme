<?php
/**
 * File Name ImageModal.php
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * ImageModal
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$ImageModal = new ImageModal();
class ImageModal {
	
	
	
	/**
	 * Option name
	 * 
	 * @access public
	 * @var string
	 * Description:
	 * Used for various purposes when an import may be adding content to an option.
	 **/
	var $option_name = false;
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() . "/addons/ImageModal" );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		// register styles and scripts
		$this->register_style_and_scripts();
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.00
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
	 * Register Styles and Scripts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function register_style_and_scripts() {
		
		// Custom JS
		wp_register_script( 'imageModal', "$this->stylesheet_directory_uri/js/imageModal.js", array( 'jquery' ) );
		
	} // end function register_style_and_scripts
	
	
	
	
	
	
	/**
	 * Enqueue Scripts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function wp_enqueue_scripts() {
		
		wp_enqueue_script( 'imageModal' );
		
	} // function wp_enqueue_scripts 
	
	
	
	
	
	
	/**
	 * wp_footer
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function wp_footer() {
		
		echo "<div id=\"image-modal\" class=\"fade out\">";
			echo "<div class=\"inside-wrapper\">";
				echo "<div class=\"close icon-cancel-circle\"></div>";
				echo "<div class=\"image-title\">image title goes here</div>";
				echo "<div class=\"image-wrapper\"></div>";
			echo "</div>";
		echo "</div>";
		
	} // function wp_footer
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_something
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_something() {
		
		if ( isset( $this->something ) AND ! empty( $this->something ) ) {
			$this->set( 'have_something', 1 );
		} else {
			$this->set( 'have_something', 0 );
		}
		
		return $this->have_something;
		
	} // end function have_something
	
	
	
} // end class ImageModal