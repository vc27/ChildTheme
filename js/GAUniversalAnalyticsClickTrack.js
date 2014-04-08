/**
 * File Name GAUniversalAnalyticsClickTrack.js
 * @version 1.0
 * @updated 00.00.00
 **/
jQuery(document).ready(function() {
	jQuery('a').click(function(e) {
        var $this = jQuery(this);
        var href = $this.prop('href').split('?')[0];
        var ext = href.split('.').pop();
        if ('xls,xlsx,doc,docx,ppt,pot,pptx,pdf,pub,txt,zip,rar,tar,7z,exe,wma,mov,avi,wmv,wav,mp3,midi,csv,tsv,jar,psd,pdn,ai,pez,wwf'.split(',').indexOf(ext) !== -1) {		
			ga('send', 'event', 'Download', ext, href);
		}
		if (href.toLowerCase().indexOf('mailto:') === 0) {
			ga('send', 'event', 'Mailto', href.substr(7));
		}
		if ((this.protocol === 'http:' || this.protocol === 'https:') && this.hostname.indexOf(document.location.hostname) === -1) {
			ga('send', 'event', 'Outbound', this.hostname, this.pathname);
		}
	});
});