<?php
/**
 * Title: Header, description and buttons with dark background
 * Slug: papanek/columns-cols-header-text-btns-dark-bg
 * Categories: columns
 */
?>
<!-- wp:columns {"verticalAlignment":"bottom","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","right":"var:preset|spacing|70","left":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-columns are-vertically-aligned-bottom has-background-color has-primary-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:heading {"style":{"typography":{"lineHeight":"1.3"}}} -->
<h2 class="wp-block-heading" style="line-height:1.3"><?php _e('Create perfect<br>landing pages<br>with Papanek', 'papanek'); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0"}}}} -->
<p style="margin-bottom:0"><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-background-background-color has-text-color has-background wp-element-button"><?php _e('Contact us', 'papanek'); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php _e('Sent a request', 'papanek'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->