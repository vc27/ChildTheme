<?php
/**
 * @package WordPress
 * @subpackage ChildTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

?>
<div id="modal" ng-show="modal.isShow" ng-class="modal.cssClass" ng-cloak>
	<div class="inside-wrapper">
		<span ng-click="modal.hide()" class="icon-close close"></span>
		<span class="modal-title" ng-show="modal.title" ng-bind="modal.title"></span>
		<div id="modal-container" ng-if="modal.displayHtml()">
			<div class="modal-content" ng-bind-html="modal.html"></div>
		</div>
		<div id="modal-container" ng-include src="modal.tpl"></div>
	</div>
</div>
<script type="text/ng-template" id="/section-newsletter-large.html">
	<div class="modal-content"><?php get_template_part('section-newsletter-large'); ?></div>
</script>