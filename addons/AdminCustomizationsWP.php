<?php
/**
 * File Name AdminCustomizationsWP.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * AdminCustomizationsWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$AdminCustomizationsWP = new AdminCustomizationsWP();
class AdminCustomizationsWP {



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

		add_action( 'login_init', array( &$this, 'login_init' ) );

		if ( is_admin() ) {
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			// add_action( 'admin_menu', array( &$this, 'remove_mene_page' ), 99 );
			add_action( 'admin_menu', array( &$this, 'remove_submenus' ), 199 );
		}

	} // end function __construct






	/**
	 * login_init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function login_init() {

		add_action( 'login_enqueue_scripts', array( &$this, 'login_enqueue_scripts' ) );

		/* Other actions

		// add_action( 'login_head', array( &$this, 'login_head' ) );
		// add_action( 'login_body_class', array( &$this, 'login_body_class' ) );
		// add_action( 'login_footer', array( &$this, 'login_footer' ) );
		// add_action( 'lostpassword_post', array( &$this, 'lostpassword_post' ) );
		// add_action( 'retrieve_password', array( &$this, 'retrieve_password' ) );
		// add_action( 'retrieve_password_key', array( &$this, 'retrieve_password_key' ) );

		// add_action( 'lost_password', array( &$this, 'lost_password' ) );
		// add_action( 'login_form_' . $action, array( &$this, 'login_form_' . $action ) );
		// add_action( 'lostpassword_form', array( &$this, 'lostpassword_form' ) );
		// add_action( 'validate_password_reset', array( &$this, 'validate_password_reset' ) );
		// add_action( 'register_form', array( &$this, 'register_form' ) );
		// add_action( 'login_form', array( &$this, 'login_form' ) );

		*/

	} // end function login_init






	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function admin_init() {

		add_action( 'admin_footer_text', array( &$this, 'admin_footer_text' ) );
		add_filter( 'update_footer', '__return_false', 9999 );

	} // end function admin_init






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






	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################






	/**
	 * login_enqueue_scripts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function login_enqueue_scripts() {

		if (
			file_exists( get_stylesheet_directory() . "/css/admin-login.css" )
			AND file_exists( get_stylesheet_directory() . "/images/login-logo.png" )
		) {
			wp_enqueue_style( 'childtheme-admin-login', get_stylesheet_directory_uri() . "/css/admin-login.css", array(), null );
		}
		/*
		if ( $this->show_adminLogin AND file_exists( get_stylesheet_directory() . "/js/min/adminLogin-min.js" ) ) {
			wp_enqueue_script( 'childtheme-admin-login', get_stylesheet_directory_uri() . "/min/adminLogin-min", array('jquery'), null );
		}
		*/

	} // end function login_enqueue_scripts






	/**
	 * admin_footer_text
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function admin_footer_text( $text ) {

		$theme = wp_get_theme();
		$text = "<span id=\"footer-thankyou\">" . $theme->get('Name') . ": Version: " . $theme->get('Version') . " by <a href=\"" . $theme->get('AuthorURI') . "\" target=\"_blank\">" . $theme->get('Author') . "</a></span>";
		return $text;

	} // end function admin_footer_text






	/**
	 * remove_submenus
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function remove_submenus() {
		// global $submenu; print_r($submenu);

		remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
		remove_submenu_page( 'tools.php', 'tools.php' );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
		remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2Foptions-general.php' );

		if ( ! current_user_can('administrator') ) {

			remove_submenu_page( 'options-general.php', 'members-settings' );
			remove_submenu_page( 'options-general.php', 'duplicatepost' );
			remove_submenu_page( 'users.php', 'roles' );

		}

		// global $submenu; print_r($submenu);

	} // end function remove_submenus






	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################






	/**
	 * haveErrors
	 **/
	function haveErrors() {

		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'haveErrors', 1 );
		} else {
			$this->set( 'haveErrors', 0 );
		}

		return $this->haveErrors;

	} // end function haveErrors



} // end class AdminCustomizationsWP
