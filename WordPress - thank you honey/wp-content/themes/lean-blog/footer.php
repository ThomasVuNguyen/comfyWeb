<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lean-blog
 */

?>

	<?php

	if ( is_active_sidebar( 'footer-1' ) ||
		 is_active_sidebar( 'footer-2' ) ||
		 is_active_sidebar( 'footer-3' ) ||
		 is_active_sidebar( 'footer-4' ) ) :
	?>

	<footer id="colophon" class="site-footer">
		<div class="footer-wrapper block-gap">
			<?php
			$column_count = 0;
			for ( $i = 1; $i <= 4; $i++ ) {

				if ( is_active_sidebar( 'footer-' . $i ) ) {
					$column_count++;
				}
			} ?>

			<?php
			$column_class = 'column-' . absint( $column_count ); ?>
				<div class="container">

					<div class="<?php echo esc_attr( $column_class ); ?>">
						<?php
						for ( $i = 1; $i <= 4 ; $i++ ) {

							if ( is_active_sidebar( 'footer-' . $i ) ) { ?>

								<div class="widget-column">

									<?php dynamic_sidebar( 'footer-' . $i ); ?>

								</div>

								<?php
							}

						} ?>
					</div><!-- .container -->
				</div><!-- .footer-widgets-area -->
		<?php endif; ?>
	</div>

		<div class="site-info">
			<div class="container">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'lean-blog' ), 'WordPress' );
				?>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'lean-blog' ), 'Lean Blog', 'Crimson Themes' );
					?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
