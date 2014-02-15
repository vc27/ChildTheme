<?php
/**
 * File Name search.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.3
 * @updated 01.20.14
 **/
#################################################################################################### */
global $s;

get_template_part( 'header' );

if ( ! have_posts() ) {

	get_template_part( 'loop-no-search' ); 

} else {

	echo "<div class=\"page-title-wrapper\">";
		echo '<h1 class="h1">' . get__option( 'search', 'results_title' ) . '</h1>';
	echo '</div>';

	get_template_part( 'loop-default' );

}

get_template_part( 'footer' );