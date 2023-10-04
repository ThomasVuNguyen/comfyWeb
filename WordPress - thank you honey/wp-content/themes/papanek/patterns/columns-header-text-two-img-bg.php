<?php
/**
 * Title: Header, description and 2 image gallery with background
 * Slug: papanek/columns-header-text-two-img-bg
 * Categories: columns
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","right":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"background-secondary","textColor":"primary","layout":{"type":"default"}} -->
<div class="wp-block-group has-primary-color has-background-secondary-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php _e('Create perfect landing pages', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
<p style="margin-bottom:var(--wp--preset--spacing--60)"><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"linkTo":"none","sizeSlug":"full","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"className":"mobile-gallery-column"} -->
<figure class="wp-block-gallery has-nested-images columns-default is-cropped mobile-gallery-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"width":"8px"}},"borderColor":"primary-second"} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-light.png" alt="" class="has-border-color has-primary-second-border-color" style="border-width:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"width":"8px"}},"borderColor":"primary-second"} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-dark.png" alt="" class="has-border-color has-primary-second-border-color" style="border-width:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->