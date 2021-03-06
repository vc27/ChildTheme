<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



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
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set


	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################


	/**
	 * add_options_pages
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
	 **/
	 function remove_mene_page() {

		if (
			! is__user('randy')
		) {
			remove_menu_page( 'edit.php?post_type=acf' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
		}

	} // end function remove_mene_page

} // end class ACFThemeOptionsWP
