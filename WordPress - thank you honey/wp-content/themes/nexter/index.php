<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nexter
 * @since	1.0.0
 */

get_header();
?>

<?php 	
	$get_sidebar = nexter_site_sidebar_layout();
	$content_column = 'nxt-col-md-12';
	
	if(!empty($get_sidebar) && ($get_sidebar['layout'] == 'left-sidebar' || $get_sidebar['layout'] == 'right-sidebar') ){
		$content_column = ' nxt-col-md-8 nxt-col-sm-12';		
	}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

				echo '<div class="nxt-row">';
				
					/* Left Sidebar */
					if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'left-sidebar' ) :
						get_sidebar();
					endif;
					/* Left Sidebar */
					
					echo '<div class="nxt-col '.esc_attr($content_column).'">';
				
						echo '<div class="nxt-blog-post-listing nxt-block mt-2">';
						
							echo '<div class="nxt-row m-0">';
							/* Start the Loop */
								while ( have_posts() ) :
									the_post();
									
									get_template_part( 'template-parts/archive/archive', 'layout-1' ); 
									
								endwhile;
								
							echo '</div>'; //End nxt-row
							
							echo wp_kses_post(nexter_pagination());
						echo '</div>'; //End blog-post-listing
				
					echo '</div>'; //End nxt-col
					
					/* Right Sidebar */
					if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'right-sidebar' ) :
						get_sidebar();
					endif;
					/* Right Sidebar */
					
				echo '</div>'; //End nxt-row
				
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();