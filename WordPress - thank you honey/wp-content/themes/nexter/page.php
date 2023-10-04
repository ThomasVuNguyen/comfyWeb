<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nexter
 * @since	1.0.0
 */

get_header(); ?>
<?php 
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

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

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