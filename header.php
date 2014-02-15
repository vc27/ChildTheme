<?php
/**
 * File Name header.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.3
 * @updated 01.20.14
 **/
#################################################################################################### */

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class(); ?>>
	<?php do_action('after_body_tag'); ?>
	<div id="page">
			
		<!-- Start Header -->
		<div id="header" class="outer-wrap">
			<header class="inner-wrap">
				
				<img id="img-birds" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-birds.png" alt="" />
				
				<div id="primary-navigation">
					<a id="site-title" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( strip_tags( get_bloginfo('name') ) ); ?>"><?php bloginfo('name'); ?></a>
					<a class="icon-smiley" href="<?php echo home_url(); ?>/about-me" title="About Me"></a>
					<a class="icon-image" target="_blank" href="http://www.flickr.com/photos/visualcoma/sets" title="Photos"></a>
					<a class="icon-wordpress" target="_blank" href="http://wpnashville.com/" title="WordPress Nashville"></a>
					<a class="icon-twitter"target="_blank" href="http://twitter.com/vc27" title="Twitter"></a>
					<a class="icon-facebook" target="_blank" href="http://facebook.com/randyhicks" title="Facebook"></a>
					<a class="icon-google-plus" target="_blank" href="https://plus.google.com/u/0/114522957738365915130/about" title="Google+"></a>
					<a class="icon-github" target="_blank" href="https://github.com/vc27" title="GitHub"></a>
				</div>
				
				<div class="clear"></div>
			</header>
		</div>
		
		<!-- Start Main Content -->
		<div id="content-wrap" class="outer-wrap">
			<div class="inner-wrap">