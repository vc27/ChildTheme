<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * ACFWP
 * @since 0.0.0
 **/
class ACFWP {


	/**
	 * __construct
	 * @since 0.0.0
	 **/
	function __construct() {

	} // end function __construct


	/**
	 * set
	 * @since 0.0.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set


	/**
	 * get
	 * @since 0.0.0
	 **/
	function get( $key ) {

		if (
			isset( $key )
			AND ! empty( $key )
			AND isset( $this->$key )
			AND ! empty( $this->$key )
		) {
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
	 * get_image
	 * @since 0.0.0
	 **/
	static function get_image( $meta_key, $post_id, $size ) {

		$image = get_field( $meta_key, $post_id );
		return self::return_image( $image, $size );

	} // end function get_image


	/**
	 * return_image
	 * @since 0.0.0
	 **/
	static function return_image( $image, $size ) {

		if (
			isset( $image['sizes'] )
			AND is_array( $image['sizes'] )
			AND isset( $image['sizes'][$size] )
			AND ! empty( $image['sizes'] )
		) {
			return $image['sizes'][$size];
		} else if ( isset( $image['url'] ) AND ! empty( $image['url'] ) ) {
			return $image['url'];
		} else {
			return false;
		}

	} // end function return_image


	/**
	 * get_sub_field
	 * @since 0.0.0
	 **/
	static function get_sub_field( $field_value, $key ) {

		if (
			isset( $field_value )
			AND ! empty( $field_value )
			AND isset( $key )
			AND ! empty( $key )
			AND isset( $field_value[$key] )
			AND ! empty( $field_value[$key] )
		) {
			return $field_value[$key];
		} else {
			return false;
		}

	} // end static function get_sub_field



} // end class ACFWP
