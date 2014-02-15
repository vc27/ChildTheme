<?php
/**
 * File Name loop-default.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
#################################################################################################### */

do_action( 'vc_above_loop' );

if ( have_posts() ) {
	$i = 0; 
	
	echo "<div id=\"loop-default\" class=\"loop\">";
		
		while ( have_posts() ) { 
			the_post(); 
			$i++;
			
			
			// Display Full Post
			if ( $i <= 1 ) {
				
				echo "<article "; post_class(); echo ">";

					vc_title( $post, array( 
						'permalink' => true, 
						'element' => 'div', 
						'class' => 'h1' 
					) );
					
					echo "<div class=\"meta-data\">";
						vc_category( array( 'after' => ' | ' ) );
						vc_comments( $post );
						vc_date( array( 'before' => ' | ' ) );
					echo "</div>";

					vc_content();

					echo "<div class=\"clear\"></div>";
				echo "</article>";
				
				
				
				// Start archive block
				echo "<div id=\"loop-default-archived\">";
			
			// Display Archived posts
			} else {
				
				if ( $i == 2 ) {
					echo "<div class=\"h5\">Archived</div>";
				}
				
				echo "<article "; post_class("archived-post"); echo ">";
					featured__image( $post, array( 
						'post_thumbnail_size' => get__option( 'post_display', 'featured_image_size' ),
						'class' => 'archive-thumbnail',
					) );
					vc_title( $post, array( 
						'permalink' => true,
						'element' => 'div',
						'class' => 'h3',
					) );
					echo "<div class=\"clear\"></div>";					
				echo "</article>";
				
			}
			
		} // end while ( have_posts() )
		
		echo "</div>"; // end #loop-default-archived
		echo "<div class=\"clear\"></div>";
		
	echo "</div>";
	
} // end if ( have_posts() )

do_action( 'vc_below_loop' ); 