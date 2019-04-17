<?php

get_header();

$video_background = get_theme_mod( 'video_bg' );
$video_mp4 = get_theme_mod( 'video_mp4' );
$video_webm = get_theme_mod( 'video_webm' );
$video_ogv = get_theme_mod( 'video_ogv' );
$custom_logo = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo , 'full' );
$home_text = get_theme_mod( 'home_text' );

if ( !empty( $video_mp4 ) ) { ?>

  <div class="video-wrapper">
    <video poster="<?php echo $video_background; ?>" autoplay="true" loop >
      <source src="<?php echo $video_mp4; ?>" type="video/mp4">
      <source src="<?php echo $video_webm; ?>" type="video/webm">
      <source src="<?php echo $video_ogv; ?>" type="video/ogv">
    </video>
    <div class="content-wrapper">
      <div class="content">
        <?php
          if( !empty( $home_text ) ) {
            ?>
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6">
                  <img src="<?php echo $logo[0]; ?>" alt="logo">
                </div>
                <div class="col-12 col-md-6">
                  <h1><?php echo $home_text; ?></h1>
                </div>
              </div>
            </div>
            <?php
          } else {
            ?>
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12">
                  <img src="<?php echo $logo[0]; ?>" alt="logo">
                </div>
              </div>
            </div>
            <?php
          }
        ?>
      </div>
      <?php get_template_part( '/template-parts/footer' ); ?>
    </div>
  </div>

<?php }

get_footer();
