<?php
/**
 * File Name GetFlickrVC.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * GetFlickrVC
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class GetFlickrVC {
	
	
	
	/**
	 * settings
	 * 
	 * @access public
	 * @var class
	 **/
	var $settings = 0;
	
	
	
	/**
	 * have_api_key
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_api_key = 0;
	
	
	
	/**
	 * method
	 * 
	 * @access public
	 * @var string
	 **/
	var $method = 0;
	
	
	
	/**
	 * have_method
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_method = 0;
	
	
	
	/**
	 * size
	 * 
	 * @access public
	 * @var bool
	 **/
	var $size = 0;
	
	
	
	/**
	 * args
	 * 
	 * @access public
	 * @var array
	 **/
	var $args = array();
	
	
	
	/**
	 * use_transient
	 * 
	 * @access public
	 * @var bool
	 **/
	var $use_transient = 0;
	
	
	
	/**
	 * transient_name
	 * 
	 * @access public
	 * @var string
	 **/
	var $transient_name = false;
	
	
	
	/**
	 * transient_expiration
	 * 
	 * @access public
	 * @var string
	 **/
	var $transient_expiration = 2592000; // 30 days in seconds
	
	
	
	/**
	 * delete_transient
	 * 
	 * @access public
	 * @var bool
	 **/
	var $delete_transient = 0;
	
	
	
	/**
	 * transient_deleted
	 * 
	 * @access public
	 * @var bool
	 **/
	var $transient_deleted = 0;
	
	
	
	/**
	 * transient_set
	 * 
	 * @access public
	 * @var bool
	 **/
	var $transient_set = 0;
	
	
	
	/**
	 * is_transient
	 * 
	 * @access public
	 * @var bool
	 **/
	var $is_transient = 0;
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	/**
	 * have_results
	 * 
	 * @access public
	 * @var array
	 **/
	var $have_results = 0;
	
	
	
	/**
	 * results
	 * 
	 * @access public
	 * @var array
	 **/
	var $results = array();
	
	
	
	/**
	 * flickr
	 * 
	 * @access public
	 * @var mix
	 **/
	var $flickr = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		$this->set( 'settings', new SettingsFlickrVCWP() );

	} // end function __construct
	
	
	
	
	
	
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
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * set__flickr
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__flickr() {
		
		if ( $this->have_api_key() ) {
			
			if ( ! class_exists( 'phpFlickr' ) ) {
				require_once( "phpFlickr/phpFlickr.php" );
			}
			
			if ( class_exists( 'phpFlickr' ) ) {
				$this->set( 'flickr', new phpFlickr( $this->settings->api_key ) );
			}
			
		} else {
			
			$this->error('no-api-key');
			
		}
		
	} // end function set__flickr
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $method, $args ) {
		
		if ( $this->have_flickr() ) {
			
			$this->set( 'results', $this->flickr->call( $method, $args ) );
			return $this->results;
			
		} else {
			
			$this->error('no-flickr');
			return false;
			
		}
		
	} // end function get 
	
	
	
	
	
	
	/**
	 * process_results
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function process_results() {
		
		if ( ! class_exists( 'ProcessFlickrResults' ) ) {
			require_once( "ProcessFlickrResults.php" );
		}
		
		if ( class_exists( 'ProcessFlickrResults' ) ) {
			
			$processor = new ProcessFlickrResults();			
			if ( isset( $this->size ) AND ! empty( $this->size ) ) {
				$processor->set( 'size', $this->size );
			}
			$this->set( 'results', $processor->process_images( $this->results ) );
			
		} else {
			
			$this->error('missing-class-ProcessFlickrResults');
			
		}
		
		
	} // end function process_results 
	
	
	
	
	
	
	/**
	 * set_transient_name
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_transient_name() {
		
		if ( $this->use_transient OR $this->delete_transient ) {
			$this->set( 'transient_name', "flickr-$this->method-$this->id-$this->size" );
		}
		
	} // end function set_transient_name 
	
	
	
	
	
	
	/**
	 * delete_transient
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function delete_transient() {
		
		if ( $this->delete_transient ) {
			delete_transient( $this->transient_name );
		}
		
	} // end function delete_transient
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * get_photoset
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_photoset( $id, $args = array(), $size = 0 ) {
		
		$this->set( 'method', 'flickr.photosets.getPhotos' );
		$this->set( 'id', $id );
		$this->set( 'size', $size );
		$this->set( 'args', $args );
		
		if ( $this->have_id() AND $this->have_method() ) {			
			
			$this->set_transient_name();
			$this->delete_transient();
			$this->get_transient_results();
			
			// Get new results
			if ( ! $this->have_results() ) {
				
				$this->args['photoset_id'] = $this->id;
				$this->get_results();
				
			}
			
			if ( $this->have_results() ) {
				
				return $this->results;
				
			} else {
				
				$this->error('no-results');
				return $this->errors;
				
			}
			
		} else {
			
			$this->error('no-id-and-method');
			return $this->errors;
			
		}
		
	} // end function get_photoset
	
	
	
	
	
	
	/**
	 * get_transient_results
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_transient_results() {
		
		if ( $this->use_transient AND $this->have_transient_name() ) {
			
			if ( $this->delete_transient ) {
				$this->set( 'transient_deleted', delete_transient( $this->transient_name ) );
			}
			
			$this->set( 'results', get_transient( $this->transient_name ) );
			
			if ( $this->have_results() ) {
				$this->set( 'is_transient', 1 );
			}
		}
		
	} // end function get_transient_results
	
	
	
	
	
	
	/**
	 * get_results
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_results() {
		
		$this->set__flickr();
		$this->get( $this->method, $this->args );
		$this->process_results();
		
		if ( $this->use_transient AND $this->have_transient_name() ) {				
			$this->set( 'transient_set', set_transient( $this->transient_name, $this->results ) );
		}
		
	} // end function get_results
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_api_key
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_api_key() {
		
		if ( isset( $this->settings->api_key ) AND ! empty( $this->settings->api_key ) ) {
			$this->set( 'have_api_key', 1 );
		} else {
			$this->set( 'have_api_key', 0 );
		}
		
		return $this->have_api_key;
		
	} // end function have_api_key 
	
	
	
	
	
	
	/**
	 * have_id
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_id() {
		
		if ( isset( $this->id ) AND ! empty( $this->id ) ) {
			$this->set( 'have_id', 1 );
		} else {
			$this->set( 'have_id', 0 );
		}
		
		return $this->have_id;
		
	} // end function have_id
	
	
	
	
	
	
	/**
	 * have_flickr
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_flickr() {
		
		if ( isset( $this->flickr ) AND ! empty( $this->flickr ) ) {
			$this->set( 'have_flickr', 1 );
		} else {
			$this->set( 'have_flickr', 0 );
		}
		
		return $this->have_flickr;
		
	} // end function have_flickr 
	
	
	
	
	
	
	/**
	 * have_results
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_results() {
		
		if ( isset( $this->results ) AND ! empty( $this->results ) AND is_array( $this->results ) ) {
			$this->set( 'have_results', 1 );
		} else {
			$this->set( 'have_results', 0 );
		}
		
		return $this->have_results;
		
	} // end function have_results 
	
	
	
	
	
	
	/**
	 * have_transient_name
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_transient_name() {
		
		if ( isset( $this->transient_name ) AND ! empty( $this->transient_name ) ) {
			$this->set( 'have_transient_name', 1 );
		} else {
			$this->set( 'have_transient_name', 0 );
		}
		
		return $this->have_transient_name;
		
	} // end function have_transient_name
	
	
	
	
	
	
	/**
	 * have_delete_transient
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_delete_transient() {
		
		if ( isset( $this->delete_transient ) AND ! empty( $this->delete_transient ) ) {
			$this->set( 'have_delete_transient', 1 );
		} else {
			$this->set( 'have_delete_transient', 0 );
		}
		
		return $this->have_delete_transient;
		
	} // end function have_transient_name 
	
	
	
	
	
	
	/**
	 * have_method
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_method() {
		
		if ( isset( $this->method ) AND ! empty( $this->method ) ) {
			$this->set( 'have_method', 1 );
		} else {
			$this->set( 'have_method', 0 );
		}
		
		return $this->have_method;
		
	} // end function have_method
	
	
	
} // end class GetFlickrVC