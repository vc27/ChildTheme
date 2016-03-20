<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * ACFThemeOptionsWP
 **/
$ACFThemeOptionsWP = new ACFThemeOptionsWP();
class ACFThemeOptionsWP {






	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'init', array( $this, 'init' ) );
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'remove_mene_page' ), 99 );
		}

	} // end function __construct






	/**
	 * after_setup_theme
	 **/
	function after_setup_theme() {

		add_theme_support('acf-theme-options');

	} // end function after_setup_theme






	/**
	 * init
	 **/
	function init() {

		$this->add_options_pages();

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
	 * add_options_pages
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function add_options_pages() {

		if ( function_exists('acf_add_options_sub_page') ) {

			acf_add_options_sub_page( array(
				'title' => 'Theme Options',
				'menu' => 'Theme Options',
				'slug' => 'theme-options',
				'parent' => 'themes.php',
				'capability' => 'manage_options'
			) );

		}

	} // end function add_options_pages






	/**
	 * remove_mene_page
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
    function remove_mene_page() {

		if (
			! is__user('randy')
			AND ! is__user('metacake')
		) {
			remove_menu_page( 'edit.php?post_type=acf' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
		}

    } // end function remove_mene_page



} // end class ACFThemeOptionsWP
