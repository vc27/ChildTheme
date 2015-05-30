<?php
/**
 * File Name WPSEOEdits.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */




$WPSEOEdits = new WPSEOEdits();
class WPSEOEdits {




	function __construct() {

		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'admin_init', array( &$this, 'admin_init' ), 9 );

	} // end function __construct






	/**
	 * init
	 *
	 * @version 0.1
	 * @updated 10.07.12
	 **/
	function init() {

		remove_action( 'admin_bar_menu', 'wpseo_admin_bar_menu', 95 );
		add_action( 'admin_menu', array( $this, 'remove_submenus' ), 999 );

	} // end function init






	/**
	 * admin_init
	 *
	 * @version 0.1
	 * @updated 04.19.14
	 **/
	function admin_init() {

		add_filter( 'wpseo_use_page_analysis', '__return_false' );
		add_filter( 'wpseo_stopwords', '__return_empty_array' );

	} // end function admin_init






	/**
	 * Remove Sub Menu Pages
	 **/
	function remove_submenus() {
		// global $submenu; print_r($submenu);
		remove_submenu_page( 'wpseo_dashboard', 'wpseo_files' );
	} // end function remove_submenus



} // end class WPSEOEdits
