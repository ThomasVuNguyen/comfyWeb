<?php
/**
 * Title: Portfolio default
 * Slug: papanek/portfolio-2-col-one
 * Categories: portfolio
 */
?>
<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--60)"><?php _e('Projects', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"width":"16px"}},"borderColor":"background-secondary"} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-cover-white.jpg" alt="" class="has-border-color has-background-secondary-border-color" style="border-width:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size"><?php _e('Papanek White', 'papanek'); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="font-style:normal;font-weight:600"><?php _e('Design / Development', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"><?php _e('Read more →', 'papanek'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"className":"mobile-max-height-40"} -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer mobile-max-height-40"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"className":"mobile-order-2"} -->
<div class="wp-block-column mobile-order-2"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size"><?php _e('Papanek Black', 'papanek'); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="font-style:normal;font-weight:600"><?php _e('Design / Development', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"><?php _e('Read more →', 'papanek'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"width":"16px"}},"borderColor":"primary-second","className":"mobile-order-1"} -->
<figure class="wp-block-image size-large has-custom-border mobile-order-1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-cover-black.jpg" alt="" class="has-border-color has-primary-second-border-color" style="border-width:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->