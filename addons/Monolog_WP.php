<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Description:
 **/
####################################################################################################

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

if ( ! class_exists( 'Monolog\Logger' ) ) {
	return false;
}

if ( ! defined( 'MONOLOG_APP_NAME' ) ) {
	return false;
}



/**
 * Monolog_WP
 * @since 1.0
 **/
$Monolog_WP = new Monolog_WP();
class Monolog_WP {



	/**
	 * $app_name
	 *
	 * @access public
	 * @var string
	 * @since 1.0
	 **/
	private $app_name = false;

	/**
	 * $stream_handler
	 *
	 * @access public
	 * @var string
	 * @since 1.0
	 **/
	private $stream_handler = false;

	/**
	 * $logger
	 *
	 * @access public
	 * @var mix
	 * @since 1.0
	 **/
	var $logger = false;



	/**
	 * __construct
	 **/
	function __construct() {

		if ( defined('MONOLOG_APP_NAME') ) {
			$this->set( 'app_name', MONOLOG_APP_NAME );
		}
		if ( defined('MONOLOG_STREAM_HANDLER') ) {
			$this->set( 'stream_handler', MONOLOG_STREAM_HANDLER );
		}

		// Create the logger
		$this->set( 'logger', new Logger( $this->app_name ) );

		// Now add some handlers
		$this->logger->pushHandler( new StreamHandler( $this->stream_handler, Logger::DEBUG ) );
		$this->logger->pushHandler( new FirePHPHandler() );

	} // end function __construct



	####################################################################################################
	/**
	 * Set Get
	 **/
	####################################################################################################



	/**
	 * set
	 * @since 1.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set



	/**
	 * get
	 * @since 1.0
	 **/
	function get( $key ) {

		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}

	} // end function get



} // end class Monolog_WP
