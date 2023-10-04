<?php
/**
 * The template for displaying archive pages
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

<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php if ( have_posts() ) : ?>
	
		<header class="archive-page-header nxt-block nxt-alignfull">						
			<div class="nxt-container">
				<div class="archive-header-content nxt-flex nxt-flex-column nxt-flex-wrap text-center">
					<?php									
						echo wp_kses_post(nexter_breadcrumbs());
						if ( is_category() ) {
							echo '<div class="archive-post-title">'.single_cat_title("", false).'</div>';
						} elseif ( is_tag() ) {
							echo '<div class="archive-post-title">'.single_tag_title( '', false ).'</div>';
						} elseif ( is_author() ) {
							$author = get_userdata( get_query_var('author') );
							echo '<div class="archive-post-title">'.esc_html($author->display_name).'</div>';
						} elseif ( is_year() ) {
							echo '<div class="archive-post-title">'.get_the_date('Y').'</div>';
						}elseif ( is_month() ) {
							echo '<div class="archive-post-title">'.get_the_date('F Y').'</div>';
						}elseif ( is_day() ) {
							echo '<div class="archive-post-title">'.get_the_date( 'F j, Y').'</div>';
						}elseif ( is_post_type_archive() ) {
							echo '<div class="archive-post-title">'.post_type_archive_title( '', false ).'</div>';
						} else {
							echo '<div class="archive-post-title">'.esc_html__( 'Archives','nexter' ).'</div>';
						}
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>
			</div>
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