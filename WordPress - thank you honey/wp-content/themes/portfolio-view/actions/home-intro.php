<?php
/*
*
* Home intro section for Portfolio View section
*
*
*/



function portfolio_view_intro_section_output()
{
  $portfolio_view_dfimgh = get_template_directory_uri() . '/assets/img/man.png';
  $portfolio_view_intro_img = get_theme_mod('portfolio_view_intro_img', $portfolio_view_dfimgh);
  $portfolio_view_intro_subtitle = get_theme_mod('portfolio_view_intro_subtitle', __('Hello, I\'m James Smith', 'portfolio-view'));
  $portfolio_view_intro_title = get_theme_mod('portfolio_view_intro_title', __('A Web Designer', 'portfolio-view'));
  $portfolio_view_intro_desc = get_theme_mod('portfolio_view_intro_desc');
  $portfolio_view_header_social_show = get_theme_mod('portfolio_view_header_social_show');
  $portfolio_view_hfacebook_link = get_theme_mod('portfolio_view_hfacebook_link');
  $portfolio_view_htwitter_link = get_theme_mod('portfolio_view_htwitter_link');
  $portfolio_view_hlinkedin_link = get_theme_mod('portfolio_view_hlinkedin_link');
  $portfolio_view_hyoutube_link = get_theme_mod('portfolio_view_hyoutube_link');
  $portfolio_view_hpinterest_link = get_theme_mod('portfolio_view_hpinterest_link');
  $portfolio_view_hinstagram_link = get_theme_mod('portfolio_view_hinstagram_link');
?>
  <!-- home -->
  <section class="home-intro" id="sa-home">
    <div class="container">
      <div class="home-all-content">
        <div class="row">
          <div class="col-lg-6">
            <div class="content">
              <?php if ($portfolio_view_intro_subtitle) : ?>
                <h5><?php echo esc_html($portfolio_view_intro_subtitle); ?></h5>
              <?php endif; ?>
              <?php if ($portfolio_view_intro_title) : ?>
                <h1><?php echo esc_html($portfolio_view_intro_title); ?></h1>
              <?php endif; ?>
              <?php if ($portfolio_view_intro_desc) : ?>
                <p><?php echo esc_html($portfolio_view_intro_desc); ?></p>
              <?php endif; ?>
              <?php if ($portfolio_view_header_social_show) : ?>
                <div class="header-links">
                  <div class="social-links">
                    <?php if ($portfolio_view_hfacebook_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_hfacebook_link); ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ($portfolio_view_htwitter_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_htwitter_link); ?>"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if ($portfolio_view_hlinkedin_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_hlinkedin_link); ?>"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if ($portfolio_view_hyoutube_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_hyoutube_link); ?>"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if ($portfolio_view_hpinterest_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_hpinterest_link); ?>"><i class="fab fa-pinterest"></i></a>
                    <?php endif; ?>
                    <?php if ($portfolio_view_hinstagram_link) : ?>
                      <a href="<?php echo esc_url($portfolio_view_hinstagram_link); ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>

          </div>

          <div class="col-lg-6">
            <?php if ($portfolio_view_intro_img) : ?>
              <div class="hero-img">
                <img src="<?php echo esc_url($portfolio_view_intro_img); ?>" alt="<?php esc_attr($portfolio_view_intro_title); ?>">
              <?php else : ?>
                <div class="hero-img px-noimg">
                <?php endif; ?>
                </div>

              </div>

          </div>
        </div>
      </div>
  </section>

<?php
}
add_action('portfolio_view_profile_intro', 'portfolio_view_intro_section_output');
