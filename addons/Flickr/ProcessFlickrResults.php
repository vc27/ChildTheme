<?php
/**
 * File Name ProcessFlickrResults.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * ProcessFlickrResults
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class ProcessFlickrResults {
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	/**
	 * size
	 * 
	 * @access public
	 * @var string
	 **/
	var $size = 'medium-500';
	
	
	
	/**
	 * image_url
	 * 
	 * @access public
	 * @var string
	 *
	 * Info:
	 * farm, server, secret, id, size
	 **/
	var $image_url = 'http://farm%1$s.staticflickr.com/%2$s/%3$s_%4$s%5$s.jpg';
	
	
	
	/**
	 * sizes
	 * 
	 * @access public
	 * @var array
	 **/
	var $sizes = array(
		'square-75' => array(
			'name' => 'Square 75',
			'id' => '_s',
			'dimensions' => '75,75',
		),
		'square-150' => array(
			'name' => 'Square 150',
			'id' => '_q',
			'dimensions' => '150,150',
		),
		'thumbnail' => array(
			'name' => 'Thumbnail',
			'id' => '_t',
			'dimensions' => '100,75',
		),
		'small-240' => array(
			'name' => 'Small 240',
			'id' => '_m',
			'dimensions' => '240,180',
		),
		'small-320' => array(
			'name' => 'Small 320',
			'id' => '_n',
			'dimensions' => '320,240',
		),
		'medium-500' => array(
			'name' => 'Medium 500',
			'id' => '',
			'dimensions' => '500,375',
		),
		'medium-640' => array(
			'name' => 'Medium 640',
			'id' => '_z',
			'dimensions' => '640,480',
		),
		'medium-800' => array(
			'name' => 'Medium 800',
			'id' => '_c',
			'dimensions' => '800,600',
		),
		'large-1024' => array(
			'name' => 'Large 1024',
			'id' => '_b',
			'dimensions' => '1024,768',
		),
		'large-1600' => array(
			'name' => 'Large 1600',
			'id' => '_h',
			'dimensions' => '1600,1200',
		),
		'large-2048' => array(
			'name' => 'Large 2048',
			'id' => '_k',
			'dimensions' => '2048,1536',
		),
		'original' => array(
			'name' => 'Original',
			'id' => '_o',
			'dimensions' => '',
		),
	);
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

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
	 * set_photoset_attr
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_photoset_attr( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND ! empty( $val ) ) {
			$this->flickr['photoset'][$key] = $val;
		}
		
	} // end function set_photoset_attr 
	
	
	
	
	
	
	/**
	 * set_photo_attr
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_photo_attr( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND ! empty( $val ) ) {
			$this->flickr['photoset']['photo'][$this->k][$key] = $val;
		}
		
	} // end function set_photo_attr
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * process_images
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function process_images( $incoming ) {
		
		if ( $this->have_size() ) {
			
			$this->set( 'flickr', $incoming );
			
			if ( $this->have_photos() ) {
				
				$this->set_photoset_attr( 'size', $this->size );
				$this->set_photoset_attr( 'size_meta', $this->sizes[$this->size] );
				
				foreach ( $this->flickr['photoset']['photo'] as $this->k => $this->photo ) {
					
					// farm, server, id, secret, size
					$this->set_photo_attr( 'url', sprintf( $this->image_url, 
						$this->photo['farm'], 
						$this->photo['server'], 
						$this->photo['id'],
						$this->photo['secret'], 
						$this->sizes[$this->size]['id'] 
					) );
					
				}
				
				$this->set_photoset_attr( 'is_processed', 1 );
				
				return $this->flickr['photoset'];
				
			} else {
				
				$this->error('no-photo-array');
				
			}
			
		} else {
			
			$this->error('incorrect-size');
			
		}
		
		return $this->errors;
		
	} // end function process_images
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_size
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_size() {
		
		if ( isset( $this->size ) AND ! empty( $this->size ) AND isset( $this->sizes[$this->size] ) AND ! empty( $this->sizes[$this->size] ) ) {
			$this->set( 'have_size', 1 );
		} else {
			$this->set( 'have_size', 0 );
		}
		
		return $this->have_size;
		
	} // end function have_size 
	
	
	
	
	
	
	/**
	 * have_photos
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_photos() {
		
		if ( isset( $this->flickr['photoset']['photo'] ) AND ! empty( $this->flickr['photoset']['photo'] ) AND is_array( $this->flickr['photoset']['photo'] ) ) {
			$this->set( 'have_photos', 1 );
		} else {
			$this->set( 'have_photos', 0 );
		}
		
		return $this->have_photos;
		
	} // end function have_photos
	
	
	
} // end class ProcessFlickrResults