<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nexter
 * @since	1.0.0
 */

?>
		<?php nxt_content_bottom(); ?>
		</div><!--nxt container-->
	<?php nxt_footer_before(); ?>	
	</div><!-- content -->
	
	<?php do_action( 'nexter_footer' ); ?>
	
	<?php nxt_footer_after(); ?>
	
</div><!-- wrapper-main -->

<?php wp_footer(); ?>
<?php nxt_body_bottom(); ?>
</body>
</html>