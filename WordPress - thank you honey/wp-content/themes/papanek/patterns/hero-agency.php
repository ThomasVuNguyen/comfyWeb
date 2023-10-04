<?php
/**
 * Title: Hero section for agency
 * Slug: papanek/hero-agency
 * Categories: about
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:spacer {"height":"60px","className":"mobile-hide"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer mobile-hide"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"verticalAlignment":"bottom","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60"},"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns are-vertically-aligned-bottom" style="padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"bottom","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:60%"><!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"bottom":"0"}}},"className":"mobile-no-br"} -->
<h1 class="wp-block-heading mobile-no-br" style="margin-bottom:0;line-height:1.1"><?php _e('A creative design agency from <br>Belgrade, Serbia', 'papanek'); ?></h1>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:40%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0"}}}} -->
<p style="margin-bottom:0"><?php _e('We are full-service agency, busy designing and building digital products.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-buttons" style="margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link wp-element-button"><?php _e('Contact us', 'papanek'); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","fontSize":"small"} -->
<div class="wp-block-button has-custom-font-size is-style-outline has-small-font-size"><a class="wp-block-button__link wp-element-button"><?php _e('Our projects →', 'papanek'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

    <!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg","dimRatio":0,"minHeight":300,"isDark":false,"className":"is-style-papanek-rounded-borders","style":{"color":{"duotone":["#111111","#30BAFB"]}}} -->
    <div class="wp-block-cover is-light is-style-papanek-rounded-borders" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
            <p class="has-text-align-center has-large-font-size"></p>
            <!-- /wp:paragraph --></div></div>
    <!-- /wp:cover --></div>

<!-- /wp:group -->