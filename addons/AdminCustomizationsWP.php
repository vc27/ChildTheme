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
	 * role__restrict_management
	 * 
	 * @access public
	 * @var string
	 **/
	var $role__restrict_management = 'mc_restrict_management';
	
	
	
	/**
	 * show_adminLogin
	 * 
	 * @access public
	 * @var string
	 **/
	var $show_adminLogin = 0;
	
	
	
	/**
	 * included_post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $included_post_types = array( 'post', 'page' );
	
	
	
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
			add_action( 'admin_menu', array( &$this, 'remove_mene_page' ), 99 );
			add_action( 'admin_menu', array( &$this, 'remove_submenus' ), 199 );
			
			// add_filter("manage_edit-page_columns", array( &$this, "edit_columns" ) );
			// add_filter("manage_edit-post_columns", array( &$this, "edit_columns" ) );
			// add_action("manage_pages_custom_column", array( &$this, "custom_columns" ) );
			// add_action("manage_posts_custom_column", array( &$this, "custom_columns" ) );
		}
		
		// 
		
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
		
		if ( file_exists( get_stylesheet_directory() . "/css/admin-login.css" ) ) {
			wp_enqueue_style( 'childtheme-admin-login', get_stylesheet_directory_uri() . "/css/admin-login.css", array(), null );
		}
		if ( $this->show_adminLogin AND file_exists( get_stylesheet_directory() . "/js/min/adminLogin-min.js" ) ) {
			wp_enqueue_script( 'childtheme-admin-login', get_stylesheet_directory_uri() . "/min/adminLogin-min", array('jquery'), null );
		}
		
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
	 * remove_mene_page
	 * 
	 * @version 1.0
	 * @updated 00.00.00
	 **/
    function remove_mene_page() {
		
		remove_menu_page( 'link-manager.php' );
		
		// Advanced Custom Fields
		if ( current_user_can( $this->role__restrict_management ) ) {
			remove_menu_page( 'edit.php?post_type=acf' );
			remove_menu_page( 'google_universal_analytics' );
		}
		
		if ( ! is__user('randy') ) {
			remove_menu_page( 'edit.php?post_type=acf' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
		}
        
    } // end function remove_mene_page

	
	
	
	
	
	/**
	 * remove_submenus
	 * 
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function remove_submenus() {
		global $submenu;
		
		if ( ! current_user_can( $this->role__restrict_management ) AND isset( $_GET['showMenuWP'] ) ) { 
			print_r($submenu); 
		}
		
		// unset($submenu['themes.php'][5]); // Removes 'Themes'
		// unset($submenu['themes.php'][12]); // Removes Theme Editor
		unset($submenu['plugins.php'][15]); // Plugin Editor
		unset($submenu['tools.php'][5]); // Tools area
		
		if ( current_user_can($this->role__restrict_management) ) {
			
			unset($submenu['upload.php'][11]); // Featured Image Sizes
			
			unset($submenu['themes.php'][6]);
			
			unset($submenu['users.php'][16]);
			unset($submenu['users.php'][17]);
			
			unset($submenu['options-general.php'][40]);
			unset($submenu['options-general.php'][42]);
			unset($submenu['options-general.php'][41]);
			
			unset($submenu['wpseo_dashboard'][8]);
			
		}
		
		// print_r($submenu);
		
	} // end function remove_submenus
	
	
	
	
	
	
	/**
	 * Add Featured Image to the Post and Page section of the WP admin edit
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function edit_columns( $columns ) {

		$columns['pt-image'] = 'Image';

		return $columns;

	} // end function edit_columns





	/**
	 * Add Custom Columns to Post & Page
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function custom_columns( $column ) {
		global $post;

		if ( in_array( $post->post_type, $this->included_post_types ) ) {

			switch ( $column ) {

				case "pt-image":
					if ( has_post_thumbnail( $post->ID ) )
						echo get_the_post_thumbnail( $post->ID, array( 50, 50 ) );
					break;

			} // end switch

		} // endif
	
	} // end function custom_columns
	
	
	
	
	
	
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
	
	
	
} // end class AdminCustomizationsWP