<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Nexter
 * @since	1.0.0
 */

get_header();

$get_sidebar = nexter_site_sidebar_layout();

$content_column = 'nxt-col-md-12';	
if(!empty($get_sidebar) && ($get_sidebar['layout'] == 'left-sidebar' || $get_sidebar['layout'] == 'right-sidebar') ){

	$content_column = ' nxt-col-md-8 nxt-col-sm-12';		
}
?>
	<div class="nxt-row">
	
		<?php 
			/* Left Sidebar */
			if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'left-sidebar' ) :
				get_sidebar();
			endif
		?>
	
		<div class="nxt-col <?php echo esc_attr($content_column); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();					
					if ( is_singular( 'nxt_builder' ) ) {
						get_template_part( 'template-parts/content', 'single' );
					}else{
						get_template_part( 'template-parts/blog/blog', 'layout-1' );
					}
						
				endwhile; // End of the loop.
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		
		<?php
			/* Right Sidebar */
			if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'right-sidebar' ) :
				get_sidebar();
			endif
		?>
		
	</div>
<?php
get_footer();