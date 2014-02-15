/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.20
 * @updated 00.00.00
 **/
jQuery(document).ready(function($) {
	
	childTheme.init();
	
});






/**
 * childTheme
 * @version 1.0
 * @updated 00.00.00
 **/
var childTheme = {
	
	
	/**
	 * init
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	init : function() {
		
		childTheme.Flickr();
		childTheme.navSwap();
		
	}, // end init : function
	
	
	
	/**
	 * navSwap
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	navSwap : function() {
		
		jQuery('#primary-navigation .icon-smiley').hover(
			function() {
				jQuery(this).removeClass('icon-smiley').addClass('icon-grin');
			},
			function() {
				jQuery(this).removeClass('icon-grin').addClass('icon-smiley');
			}
		);
		
		jQuery('#primary-navigation .icon-github').hover(
			function() {
				jQuery(this).removeClass('icon-github').addClass('icon-github2');
			},
			function() {
				jQuery(this).removeClass('icon-github2').addClass('icon-github');
			}
		);
		
	}, // end navSwap : function
	
	
	
	/**
	 * Flicker
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	Flickr : function() {

		// Flickr
		jQuery('.thumb').each(function() {
			
			var imgSrc = jQuery('img', this).attr('src');
			imgSrc = imgSrc.replace("_s.jpg", ".jpg");
			
			jQuery('a', this).attr({
				"href": imgSrc,
			});
			
		});
		
	}, // end Flickr : function
	
	
	
	// ##################################################
	/**
	 * Setters
	 **/
	// ##################################################
	
	
	
	/**
	 * setParams
	 * 
	 * version 1.0
	 * updated 00.00.00
	 **/
	setParams : function() {
		
		
		
	}  // end setParams : function
	
	
	
}; // end var childTheme