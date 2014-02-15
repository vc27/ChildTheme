/**
 * File Name imageModal.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.20
 * @updated 00.00.00
 **/
jQuery(document).ready(function($) {
	
	imageModal.init();
	
});






/**
 * imageModal
 * @version 1.0
 * @updated 00.00.00
 **/
var imageModal = {
	
	
	/**
	 * init
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	init : function() {
		
		imageModal.modal();
		
	}, // end init : function
	
	
	
	/**
	 * modal
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	modal : function() {

		// Flickr
		jQuery('.flickr-gallery').find('a').each(function() {
			
			var a = jQuery(this);
			a.click(function(event) {
				event.preventDefault();
				var src = jQuery(this).attr('href');
				var title = jQuery(this).attr('title');
				jQuery('#image-modal .image-wrapper').html('<img src="'+src+'" alt="" />');
				jQuery('#image-modal .image-title').html(title+' <a target="_blank" href="'+src+'" class="icon-new-tab"></a>');
				jQuery('#image-modal').addClass('in').removeClass('out');
			});
			
		});
		
		jQuery('.close').click(function() {
			jQuery('#image-modal').addClass('out').removeClass('in');
		});
		
		jQuery(document).keyup(function(e) {
			if ( e.keyCode == 27 ) {
				jQuery('#image-modal').addClass('out').removeClass('in');
			}
		});
		
	}, // end modal : function
	
	
	
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
	
	
	
}; // end var imageModal