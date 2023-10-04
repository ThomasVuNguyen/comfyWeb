<?php
/**
 * Title: Big header, description and button with hero image
 * Slug: papanek/columns-hero-gray-bg
 * Categories: columns
 */
?>
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","right":"var:preset|spacing|70","left":"var:preset|spacing|70"},"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"background-secondary"} -->
<div class="wp-block-columns are-vertically-aligned-center has-background-secondary-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:column {"verticalAlignment":"center","className":"mobile-order-2"} -->
<div class="wp-block-column is-vertically-aligned-center mobile-order-2"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php _e('Create perfect <br>landing pages <br>with Papanek', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60","top":"var:preset|spacing|30"}},"typography":{"lineHeight":"1.5"}},"className":"mobile-no-br","fontSize":"normal"} -->
<p class="mobile-no-br has-normal-font-size" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--60);line-height:1.5"><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-bloc
k-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"><?php _e('Contact me', 'papanek'); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php _e('My projects', 'papanek'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"mobile-order-1"} -->
<div class="wp-block-column is-vertically-aligned-center mobile-order-1"><!-- wp:image {"align":"right","sizeSlug":"full","linkDestination":"none","style":{"color":{}},"className":"mobile-align-none"} -->
<figure class="wp-block-image alignright size-full mobile-align-none"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face.jpg" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->