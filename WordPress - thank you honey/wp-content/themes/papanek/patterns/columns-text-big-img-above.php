<?php
/**
 * Title: Text and big image above
 * Slug: papanek/columns-text-big-img-above
 * Categories: columns
 */
?>
<!-- wp:columns {"verticalAlignment":"bottom","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns are-vertically-aligned-bottom" style="padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.3"}}} -->
<h1 class="wp-block-heading" style="line-height:1.3"><?php _e('Create perfect landing pages', 'papanek'); ?></h1>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0"}}}} -->
<p style="margin-bottom:0"><?php _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg" alt=""/></figure>
<!-- /wp:image -->