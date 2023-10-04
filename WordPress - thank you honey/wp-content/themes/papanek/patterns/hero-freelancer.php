<?php
/**
 * Title: Hero section for freelancer
 * Slug: papanek/hero-freelancer
 * Categories: about
 */
?>
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}},"className":"mobile\u002d\u002dno-padding-top"} -->
<div class="wp-block-columns are-vertically-aligned-center mobile--no-padding-top" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:column {"verticalAlignment":"center","className":"mobile-order-2"} -->
<div class="wp-block-column is-vertically-aligned-center mobile-order-2"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:0"><?php _e("I'm a designer and WordPress developer", 'papanek'); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60","top":"var:preset|spacing|30"}},"typography":{"lineHeight":"1.5"}},"className":"mobile-no-br","fontSize":"normal"} -->
<p class="mobile-no-br has-normal-font-size" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--60);line-height:1.5"><?php _e("Hi, my name is Papanek. I'm a designer and WordPress developer. I can build your website from scratch. Check out <a href='#'>my portfolio</a> and <a href='#'>contact me</a>.", 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"><?php _e('Contact me', 'papanek'); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php _e('My portfolio', 'papanek'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"mobile-order-1"} -->
<div class="wp-block-column is-vertically-aligned-center mobile-order-1"><!-- wp:image {"align":"right","sizeSlug":"full","linkDestination":"none","style":{"color":{}},"className":"mobile-align-none"} -->
<figure class="wp-block-image alignright size-full mobile-align-none"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face.jpg" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->