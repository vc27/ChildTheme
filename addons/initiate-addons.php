<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


if ( ! defined('THEME_ADDONS_INIT') ) {
	
	// Init ParentTheme lib
	require_once( get_template_directory() . "/includes/initiate-lib.php" );
	
	// Added Functionality
	require_once( "ACFThemeOptionsWP.php" );
	require_once( "ACFWP.php" );
	require_once( "AdminCustomizationsWP.php" );
	require_once( "WPSEOEdits.php" );
	
	define( 'THEME_ADDONS_INIT', true );
	
} // end if ( ! defined('THEME_ADDONS_INIT') )