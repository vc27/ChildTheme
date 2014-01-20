/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 06.28.13
 **/
jQuery(document).ready(function($) {
	
	childTheme.init({
		scaleFix : true,
		displayIEMessage : true
	});
	
});






/**
 * childTheme
 * @version 1.0
 * @updated 06.28.13
 **/
var childTheme = {
	
	
	/**
	 * init
	 * @version 1.0
	 * @updated 06.28.13
	 **/
	init : function( params ) {
		
		childTheme.setParams(params);
		
		childTheme.mbpScaleFix();
		childTheme.checkIEVersion();
		
	}, // end init : function
	
	
	
	/**
	 * mbpScaleFix
	 * @version 1.0
	 * @updated 06.28.13
	 **/
	scaleFix : false,
	mbpScaleFix : function() {
		
		if ( typeof MBP != 'undefined' && childTheme.scaleFix == true ) {
			MBP.scaleFix();
		}
		
	}, // end mbpScaleFix : function
	
	
	
	/**
	 * Return IE Message in body tag
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	displayIEMessage : false,
	ieVersion : get_ie_version(),
	ieMessage : 'You are using an outdated version of Internet Explorer please update your copy for a better experience.',
	checkIEVersion : function() {
		
		if ( childTheme.displayIEMessage == true && childTheme.ieVersion > -1 && childTheme.ieVersion <= 7.0 ) {
			jQuery('body').prepend('<div class="bad-ie-message" style="display:block;text-align:center;font-size:11px;padding-top:7px;height:15px;overflow:hidden;color:#000;background:#fff;width:100%;"><p>'+childTheme.ieMessage+'</p></div>');
		}
		
	}, // end checkIEVersion : function
	
	
	
	// ##################################################
	/**
	 * Setters
	 **/
	// ##################################################
	
	
	
	/**
	 * setParams
	 * 
	 * version 1.0
	 * updated 00.00.13
	 **/
	setParams : function( params ) {
		
		if ( typeof params != 'undefined' ) {
			
			if ( typeof params.scaleFix != 'undefined' && params.scaleFix == true ) {
				childTheme.scaleFix = params.scaleFix;
			}
			
			if ( typeof params.displayIEMessage != 'undefined' && params.displayIEMessage == true ) {
				childTheme.displayIEMessage = params.displayIEMessage;
			}
			
		}
		
	}  // end setParams : function
	
	
	
}; // end var childTheme