<?php
/**
 * Title: Right image, left text
 * Slug: papanek/columns-text-img
 * Categories: columns
 */
?>
<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"className":"mobile-order-2"} -->
<div class="wp-block-column mobile-order-2"><!-- wp:heading {"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size"><?php _e('Some header here', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"mobile-order-1"} -->
<div class="wp-block-column mobile-order-1"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"width":"16px"}},"borderColor":"background-secondary"} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg" alt="" class="has-border-color has-background-secondary-border-color" style="border-width:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->