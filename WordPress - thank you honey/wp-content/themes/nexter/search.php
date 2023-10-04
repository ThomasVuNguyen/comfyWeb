<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
	
<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php if ( have_posts() ) : ?>

		<header class="nxt-search-header nxt-block">
			<h2 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for : %s', 'nexter' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h2>
		</header><!-- .page-header -->

		<?php
			echo '<div class="nxt-row">';
			
				/* Left Sidebar */
				if ( !empty($get_sidebar) && $get_sidebar['layout'] == 'left-sidebar' ) :
					get_sidebar();
				endif;
				/* Left Sidebar */
				
				echo '<div class="nxt-col '.esc_attr($content_column).'">';
			
					echo '<div class="nxt-blog-post-listing nxt-block">';
					
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