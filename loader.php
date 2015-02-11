<?php
/**
 * @package WordPress
 * @subpackage ChildTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

?>
<div id="loader" ng-show="loader.isShow" ng-class="loader.cssClass" ng-cloak>
	<div class="inside-wrapper">
		<div id="loader-container" ng-if="loader.displayHtml()">
			<div class="loader-content" ng-bind-html="loader.html"></div>
		</div>
		<div id="loader-container" ng-include src="loader.tpl"></div>
	</div>
</div>
<script type="text/ng-template" id="/loader-default.html">
	<div class="loader-content"><?php get_template_part('loader-default'); ?></div>
</script>