<?php
/**
 * Title: Agency, full page pattern
 * Slug: papanek/full-page-agency
 * Categories: full-page
 * Block Types: core/post-content
 */
?>
<!-- wp:spacer {"height":"60px","className":"mobile-hide"} -->
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
            <div class="wp-block-button has-custom-font-size has-small-font-size"><a class="wp-block-button__link wp-element-button" href="#contact-us"><?php _e('Contact us', 'papanek'); ?></a></div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"is-style-outline","fontSize":"small"} -->
            <div class="wp-block-button has-custom-font-size is-style-outline has-small-font-size"><a class="wp-block-button__link wp-element-button" href="#projects"><?php _e('Our projects →', 'papanek'); ?></a></div>
            <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
    <!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg","dimRatio":0,"minHeight":300,"isDark":false,"className":"is-style-papanek-rounded-borders","style":{"color":{"duotone":["#111111","#30BAFB"]}}} -->
<div class="wp-block-cover is-light is-style-papanek-rounded-borders" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/desk-computer-work-black-and-white-white-building-689275-pxhere.com.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php _e("Hello! We are <strong>Papanek</strong>.<br>We're an award-winning digital agency from <strong>Belgrade, Serbia</strong>, focused on <a href='#'>UX/UI</a> and <a href='#'>website design</a>. Our team is dedicated to delivering innovative solutions that meet and exceed <a href='#'>our clients'</a> expectations.", 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|70","left":"var:preset|spacing|70","top":"var:preset|spacing|70","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|50"},"border":{"radius":"8px"}},"backgroundColor":"background-secondary","textColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-primary-color has-background-secondary-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"bottom"} -->
    <div class="wp-block-columns are-vertically-aligned-bottom"><!-- wp:column {"verticalAlignment":"bottom"} -->
        <div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:heading {"fontSize":"extra-large"} -->
            <h2 class="wp-block-heading has-extra-large-font-size"><?php _e('Services', 'papanek'); ?></h2>
            <!-- /wp:heading --></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"bottom"} -->
        <div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0"}}}} -->
            <p style="margin-bottom:0"><?php _e('We offer full digital solutions to help businesses thrive online.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php _e('Branding →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php _e('We create user-friendly interfaces that captivate your audience.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php _e('Design →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php _e('We strengthen your brand identity through comprehensive strategies.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php _e('Development →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php _e('Our developers build scalable solutions that empower your business.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php echo _e('Marketing →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php echo _e('Our marketing experts reach your audience and drive conversions.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php echo _e('Analytics →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php echo _e('We use data-driven insights to optimize strategies and achieve objectives.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} -->
            <h2 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--20);margin-right:0;margin-bottom:0;margin-left:0"><a href="#"><?php echo _e('Support →', 'papanek'); ?></a></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}},"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
            <p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0;line-height:1.5"><?php echo _e('We provide ongoing support to keep your online presence running smoothly.', 'papanek'); ?></p>
            <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--60)"><?php echo _e('Projects', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"width":"16px"}},"borderColor":"background-secondary"} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-cover-white.jpg" alt="" class="has-border-color has-background-secondary-border-color" style="border-width:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size"><?php echo _e('Papanek White', 'papanek'); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="font-style:normal;font-weight:600"><?php echo _e('Design / Development ', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo _e('Papanek is a stunning WordPress theme featuring a clean and minimalist design.', 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="#"><?php echo _e('Read more →', 'papanek'); ?></a></p>
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

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php _e('Our team', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:spacer {"height":"0px"} -->
<div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face-portrait.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal"} -->
<h2 class="wp-block-heading has-normal-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('Sarah Johnson', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('CEO', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face-portrait.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal"} -->
<h2 class="wp-block-heading has-normal-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('David Patel', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('CTO', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:spacer {"height":"80px","className":"mobile-hide"} -->
<div style="height:80px" aria-hidden="true" class="wp-block-spacer mobile-hide"></div>
<!-- /wp:spacer -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face-portrait.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal"} -->
<h2 class="wp-block-heading has-normal-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('Aisha Khan', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('Web Developer', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:spacer {"height":"60px","className":"mobile-hide"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer mobile-hide"></div>
<!-- /wp:spacer -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/papanek-face-portrait.jpg" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal"} -->
<h2 class="wp-block-heading has-normal-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('Michael Torres', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","right":"0","bottom":"0","left":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);margin-right:0;margin-bottom:0;margin-left:0"><?php _e('UI/UX Designer', 'papanek'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php _e('What our clients say', 'papanek'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|60"}}},"fontSize":"medium"} -->
<p class="has-medium-font-size" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--60)"><?php _e("Check out our clients' reviews to see what they have to say about our exceptional digital solutions.", 'papanek'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
    <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"background-secondary","layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-background-secondary-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"fontSize":"normal"} -->
            <p class="has-normal-font-size"><strong><?php _e('Stellar Cosmetics', 'papanek'); ?></strong></p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php _e("Papanek's team created a stunning website that perfectly captured our brand image and enhanced our online presence. Highly recommended. ", "papanek"); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
                <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"small"} -->
                    <p class="has-small-font-size"><?php _e('David Kim<br>Creative Director', 'papanek'); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#30BAFB","className":"is-style-logos-only"} -->
                    <ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
                    <!-- /wp:social-links --></div>
                <!-- /wp:group --></div>
            <!-- /wp:group --></div>
        <!-- /wp:group --></div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:spacer {"height":"150px","className":"mobile-hide"} -->
        <div style="height:150px" aria-hidden="true" class="wp-block-spacer mobile-hide"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"background-secondary","layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-background-secondary-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"fontSize":"normal"} -->
            <p class="has-normal-font-size"><strong><?php _e('Fusion Technologies', 'papanek'); ?></strong></p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php _e("We're extremely pleased with the results of our digital marketing campaign thanks to Papanek's expert knowledge in SEO, social media, and PPC advertising.", 'papanek'); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
                <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"small"} -->
                    <p class="has-small-font-size"><?php _e('Sarah Lee<br>Marketing Manager', 'papanek'); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:social-links {"iconColor":"secondary","iconColorValue":"#30BAFB","className":"is-style-logos-only"} -->
                    <ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
                    <!-- /wp:social-links --></div>
                <!-- /wp:group --></div>
            <!-- /wp:group --></div>
        <!-- /wp:group --></div>
    <!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
    <h2 class="wp-block-heading"><?php _e('Blog', 'papanek'); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p><a href="#"><?php _e('Go to blog →', 'papanek'); ?></a></p>
    <!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":8,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3}} -->
<div class="wp-block-query"><!-- wp:post-template -->
    <!-- wp:post-featured-image {"isLink":true} /-->

    <!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","right":"0","bottom":"0","left":"0"}}},"fontSize":"medium"} /-->

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
    <div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-date /-->

        <!-- wp:post-terms {"term":"post_tag"} /--></div>
    <!-- /wp:group -->

    <!-- wp:post-excerpt {"moreText":"Read more →","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"fontSize":"small"} /-->

    <!-- wp:spacer {"height":"80px"} -->
    <div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination -->
    <!-- wp:query-pagination-previous {"fontSize":"normal"} /-->

    <!-- wp:query-pagination-numbers {"fontSize":"normal"} /-->

    <!-- wp:query-pagination-next {"fontSize":"normal"} /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
    <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
    <p>No posts</p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","right":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70"},"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-columns has-background-color has-primary-background-color has-text-color has-background" id="contact-us" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:column {"style":{"spacing":{}},"layout":{"type":"default"}} -->
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

        <!-- wp:contact-form-7/contact-form-selector  -->
        <div class="wp-block-contact-form-7-contact-form-selector">[contact-form-7]</div>
        <!-- /wp:contact-form-7/contact-form-selector --></div>
    <!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->