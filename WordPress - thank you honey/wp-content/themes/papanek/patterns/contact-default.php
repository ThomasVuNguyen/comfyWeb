<?php
/**
 * Title: Contacts block with CF7 form
 * Slug: papanek/contact-default
 * Categories: contact
 */
?>
<!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","right":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70"},"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-columns has-background-color has-primary-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:column {"style":{"spacing":{}},"layout":{"type":"default"}} -->
<div class="wp-block-column"><!-- wp:group {"className":"full-height","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group full-height"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php _e('Contact us', 'papanek'); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php _e('Office 3<br>Main Street 17<br>Belgrade, Serbia', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#30BAFB","showLabels":true,"className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-visible-labels has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"whatsapp","label":"+381 (999) 111-22-33"} /--></ul>
<!-- /wp:social-links -->

<!-- wp:paragraph -->
<p><a href="mailto:hello@papanek.romanfink.com">hello@romanfink.com</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p><?php _e('Contact us and provide details about your inquiry. Our team will get back to you soon.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:contact-form-7/contact-form-selector -->
<div class="wp-block-contact-form-7-contact-form-selector">[contact-form-7]</div>
<!-- /wp:contact-form-7/contact-form-selector --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->