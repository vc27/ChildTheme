<?php
/**
 * File Name DisplayFlickrVC.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * DisplayFlickrVC
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class DisplayFlickrVC {
	
	
	
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
	 * image_args
	 * 
	 * @access public
	 * @var array
	 **/
	var $image_args = array();
	
	
	
	/**
	 * default_image_args
	 * 
	 * @access public
	 * @var array
	 **/
	var $default_image_args = array(
		'before_image' => '',
		'after_image' => '',
		'before' => '',
		'after' => '',
		'container_id' => '',
		'container_class' => '',
		'element' => 'div',
		'permalinks' => '',
	);
	
	
	
	/**
	 * html
	 * 
	 * @access public
	 * @var string
	 **/
	var $html = '';
	
	
	
	/**
	 * flickr
	 * 
	 * @access public
	 * @var object
	 **/
	var $flickr = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		if ( ! class_exists( 'GetFlickrVC' ) ) {
			require_once( "GetFlickrVC.php" );
		}
		
		$this->set( 'flickr', new GetFlickrVC() );

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
	 * set_transient_name
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set_transient_name() {
		
		if ( $this->use_transient OR $this->delete_transient ) {
			$this->set( 'transient_name', "flickr-html-$this->id-$this->size" );
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
	
	
	
	
	
	
	/**
	 * append_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append_image() {
		
		$defaults = array(
			'content_id' => false,
			'content_id_attr' => false,
			'title' => $this->image['title'],
			'src' => $this->image['url'],
			'height' => false,
			'height_attr' => false,
			'width' => false,
			'width_attr' => false,
			'class' => false,
			'class_attr' => false,
			'alt_text' => $this->image['title'],
			'rel' => '',
			'data_attr' => '',
			'before' => '',
			'after' => '',
			'echo' => 0,
		);
		
		$r = wp_parse_args( $defaults, $this->image_args );
		extract( $r );
		
		if ( isset( $this->image_args['permalink'] ) AND ! empty( $this->image_args['permalink'] ) ) {
			$a_ = "<a href=\"$src\" title=\"" . esc_attr( strip_tags( $title ) ) . "\" rel=\"$rel\" $data_attr>";
			$_a = "</a>";
		} else {
			$a_ = "";
			$_a = "";
		}
		
		if ( isset( $this->image_args['inner_before'] ) AND ! empty( $this->image_args['inner_before'] ) ) {
			$inner_before = $a_ . $this->image_args['inner_before'];
		} else {
			$inner_before = $a_;
		}
		
		if ( isset( $this->image_args['inner_after'] ) AND ! empty( $this->image_args['inner_after'] ) ) {
			$inner_after = $this->image_args['inner_after'] . $_a;
		} else {
			$inner_after = $_a;
		}
		
		if ( isset( $this->image_args['before'] ) AND ! empty( $this->image_args['before'] ) ) {
			$before = $this->image_args['before'] . $inner_before;
		} else {
			$before = $inner_before;
		}
		
		if ( isset( $this->image_args['after'] ) AND ! empty( $this->image_args['after'] ) ) {
			$after = $inner_after . $this->image_args['after'];
		} else {
			$after = $inner_after;
		}
		
		$this->html .= $this->html_image( array(
			'content_id' => $content_id,
			'content_id_attr' => $content_id_attr,
			'title' => $title,
			'src' => $src,
			'height' => $height,
			'height_attr' => $height_attr,
			'width' => $width,
			'width_attr' => $width_attr,
			'class' => $class,
			'class_attr' => $class_attr,
			'alt_text' => $alt_text,
			'before' => $before,
			'after' => $after,
			'echo' => $echo,
		) );
		
	} // end function append_image
	
	
	
	
	
	
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
	function get_photoset( $id, $args, $size, $image_args = array() ) {
		
		$this->set( 'id', $id );
		$this->set( 'args', $args );
		$this->set( 'size', $size );
		$this->set( 'image_args', $image_args );
		
		$this->set_transient_name();
		$this->delete_transient();
		$this->get_transient_results();
		
		if ( $this->have_html() ) {
			
			return $this->html;
			
		} else {
			
			$this->flickr->get_photoset( $id, $args, $size );

			if ( $this->have_results() ) {

				if ( $this->have_photos() ) {
					
					$this->set( 'image_args', wp_parse_args( $this->image_args, $this->default_image_args ) );

					foreach ( $this->flickr->results['photo'] as $this->image ) {

						$this->append_image();

					}

					if ( $this->have_html() ) {

						if ( $this->use_transient AND $this->have_transient_name() ) {				
							$this->set( 'transient_set', set_transient( $this->transient_name, $this->html ) );
						}

						return $this->html;

					} else {

						$this->error( 'html-empty' );

					}

				} else {

					$this->error( 'photos-empty' );

				}

			} else {

				$this->error( 'no-results' );

			}
			
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
			
			$this->set( 'html', get_transient( $this->transient_name ) );
			
			if ( $this->have_html() ) {
				$this->set( 'is_transient', 1 );
			}
		}
		
	} // end function get_transient_results
	
	
	
	
	
	
	/**
	 * html_image
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function html_image( $args ) {
		
		// Set Defaults
		$defaults = array(
			'content_id' => false,
			'content_id_attr' => false,
			'title' => false,
			'src' => false,
			'height' => false,
			'height_attr' => false,
			'width' => false,
			'width_attr' => false,
			'class' => false,
			'class_attr' => false,
			'alt_text' => false,
			'before' => '',
			'after' => '',
			'echo' => 1,
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

        // Build Image or return false
		if ( isset( $src ) AND ! empty( $src ) ) {
			
			// sanatize class sting
			$class = sanitize_title_with_dashes( $class );


			// Check for width and height
			if ( isset( $width ) AND is_numeric( $width ) AND isset( $height ) AND is_numeric( $height ) ) {
				$width_attr = "width=\"$width\" ";
				$height_attr = "height=\"$height\" ";
			}


			// Set html id
			if ( isset( $content_id ) AND ! empty( $content_id ) ) {
				$content_id_attr = "id=\"" . sanitize_title_with_dashes( $content_id ) . "\" ";
			}

			// Set html class
			if ( isset( $class ) AND ! empty( $class ) ) {
				$class_attr = "class=\"$class\" ";
			}
			
			$image = "$before<img " . $class_attr . $content_id_attr . "title=\"" . esc_attr( strip_tags( $title ) ) . "\" alt=\"" . esc_attr( strip_tags( $alt_text ) ) . "\" src=\"$src\" " . $width_attr . $height_attr . "/>$after";
			
		} else {
			
			$image = false;
			
		}


		// Echo or return
		if ( $echo )
			echo $image;
		else
			return $image;
		
	} // end function html_image
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_results
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_results() {
		
		if ( isset( $this->flickr->results ) AND ! empty( $this->flickr->results ) AND is_array( $this->flickr->results ) ) {
			$this->set( 'have_results', 1 );
		} else {
			$this->set( 'have_results', 0 );
		}
		
		return $this->have_results;
		
	} // end function have_results
	
	
	
	
	
	
	/**
	 * have_photos
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_photos() {
		
		if ( isset( $this->flickr->results['photo'] ) AND ! empty( $this->flickr->results['photo'] ) AND is_array( $this->flickr->results['photo'] ) ) {
			$this->set( 'have_photos', 1 );
		} else {
			$this->set( 'have_photos', 0 );
		}
		
		return $this->have_photos;
		
	} // end function have_photos 
	
	
	
	
	
	
	/**
	 * have_html
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_html() {
		
		if ( isset( $this->html ) AND ! empty( $this->html ) ) {
			$this->set( 'have_html', 1 );
		} else {
			$this->set( 'have_html', 0 );
		}
		
		return $this->have_html;
		
	} // end function have_html
	
	
	
	
	
	
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
	
	
	
} // end class DisplayFlickrVC