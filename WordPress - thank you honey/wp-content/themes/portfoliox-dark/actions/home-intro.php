<?php
/*
*
* Home intro section for Portfolix Dark section
*
*
*/



function portfoliox_dark_intro_section_output()
{
  $portfoliox_dark_intro_show = get_theme_mod('portfoliox_dark_intro_show', 1);
  $portfoliox_dark_dfimgh = get_template_directory_uri() . '/assets/img/hero.png';
  $portfoliox_dark_intro_img = get_theme_mod('portfoliox_dark_intro_img', $portfoliox_dark_dfimgh);
  $portfoliox_dark_intro_subtitle = get_theme_mod('portfoliox_dark_intro_subtitle', __('WELCOME TO MY WORLD', 'portfoliox-dark'));
  $portfoliox_dark_intro_title = get_theme_mod('portfoliox_dark_intro_title', __('Hi, I\'m Bryan Pit', 'portfoliox-dark'));
  $portfoliox_dark_intro_designation = get_theme_mod('portfoliox_dark_intro_designation', __('Creative Web & App Developer', 'portfoliox-dark'));
  $portfoliox_dark_intro_desc = get_theme_mod('portfoliox_dark_intro_desc');
  $portfoliox_dark_btn_text_one = get_theme_mod('portfoliox_dark_btn_text_one', __('Hire me', 'portfoliox-dark'));
  $portfoliox_dark_btn_url_one = get_theme_mod('portfoliox_dark_btn_url_one', '#');
  $portfoliox_dark_btn_text_two = get_theme_mod('portfoliox_dark_btn_text_two', __('Download CV', 'portfoliox-dark'));
  $portfoliox_dark_btn_url_two = get_theme_mod('portfoliox_dark_btn_url_two', '#');
  if (empty($portfoliox_dark_intro_show)) {
    return;
  }
?>
  <!-- home -->
  <section class="home" id="home">
    <div class="container">
      <div class="home-all-content">
        <div class="row">
          <div class="col-lg-6">
            <?php if ($portfoliox_dark_intro_img) : ?>
              <div class="hero-img">
                <img src="<?php echo esc_url($portfoliox_dark_intro_img); ?>" alt="<?php esc_attr($portfoliox_dark_intro_title); ?>">
              <?php else : ?>
                <div class="hero-img px-noimg">
                <?php endif; ?>
                </div>

              </div>
              <div class="col-lg-6">

                <div class="content">
                  <?php if ($portfoliox_dark_intro_subtitle) : ?>
                    <h5><?php echo esc_html($portfoliox_dark_intro_subtitle); ?></h5>
                  <?php endif; ?>
                  <?php if ($portfoliox_dark_intro_title) : ?>
                    <h1><?php echo esc_html($portfoliox_dark_intro_title); ?> <br><span id="type1"><?php echo esc_html($portfoliox_dark_intro_designation); ?></span></h1>
                  <?php endif; ?>
                  <?php if ($portfoliox_dark_intro_desc) : ?>
                    <p><?php echo esc_html($portfoliox_dark_intro_desc); ?></p>
                  <?php endif; ?>
                  <?php if ($portfoliox_dark_btn_url_one || $portfoliox_dark_btn_url_two) : ?>
                    <div class="intro-btns">
                      <?php if ($portfoliox_dark_btn_url_one) : ?>
                        <a href="<?php echo esc_url($portfoliox_dark_btn_url_one); ?>" class="btn btn-hero"><?php echo esc_html($portfoliox_dark_btn_text_one); ?></a>
                      <?php endif; ?>
                      <?php if ($portfoliox_dark_btn_url_two) : ?>
                        <a href="<?php echo esc_url($portfoliox_dark_btn_url_two); ?>" class="btn btn-hero"><?php echo esc_html($portfoliox_dark_btn_text_two); ?></a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>

              </div>

          </div>
        </div>
      </div>
  </section>

<?php
}
add_action('portfoliox_dark_profile_intro', 'portfoliox_dark_intro_section_output');
