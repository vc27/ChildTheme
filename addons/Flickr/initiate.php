<?php
/**
 * File Name initiate.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
#################################################################################################### */


if ( ! defined('FlickrVCWP_INIT') ) {
	
	class SettingsFlickrVCWP {
		
		
		/**
		 * api_key
		 * 
		 * @access public
		 * @var string
		 **/
		var $api_key = 'e04973f4fb18f2162f401494d2e7e6af';
		
		
	}; // end class SettingsFlickrVCWP	
	
	
	// Classes
	require_once( "FlickrVCWP.php" );
	
	define( 'FlickrVCWP_INIT', true );
	
	
	
} // end if ( ! defined('FlickrVCWP_INIT') )