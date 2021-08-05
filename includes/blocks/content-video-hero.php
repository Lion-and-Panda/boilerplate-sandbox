<?php
//Background
$hero_background_video = get_field( 'background_video' );
$poster = get_field( 'poster' );

//Colors
$background_color = get_field( 'hero_background_color' );
$headline_color = get_field( 'hero_headline_color' );

//Content
$hero_heading = get_field( 'hero_headline' );
$hero_subheading = get_field( 'subhead' );
$content_spacing = get_field( 'content_spacing' );
$hero_content_aligment = get_field( 'hero_content_alignment' );
$hero_heading_size = get_field( 'hero_headline_size' );
$hero_heading_weight = get_field( 'hero_headline_weight' );
$hero_heading_transform = get_field( 'hero_headline_transform' );
$invert = get_field( 'hero_invert' );
$narrow = get_field( 'narrow' );

//Button
$hero_button_1 = get_field( 'button_link' );
$hero_button_2 = get_field( 'secondary_button' );
$hero_button_1_target = $hero_button_1[ 'target' ] ? $hero_button_1[ 'target' ] : '_self';
$hero_button_2_target = $hero_button_2[ 'target' ] ? $hero_button_2[ 'target' ] : '_self';
$button_bg = get_field( 'button_background_color', 'option' );
$button_text_color = get_field( 'button_text_color', 'option' );
$button_padding = get_field( 'button_padding', 'option' );
$button_text_size = get_field( 'button_font_size', 'option' );
$button_text_weight = get_field( 'button_font_weight', 'option' );
$button_text_transform = get_field( 'button_font_transform', 'option' );
$button_radius = get_field( 'button_radius', 'option' );
$button_border_size = get_field( 'button_border_size', 'option' );
$button_border_color = get_field( 'button_border_color', 'option' );
$secondary_button_bg = get_field( 'secondary_button_background_color', 'option' );
$secondary_button_text_color = get_field( 'secondary_button_text_color', 'option' );
$secondary_button_border_color = get_field( 'secondary_button_border_color', 'option' );

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $content_spacing;

// Create class attribute allowing for custom "className"
 $className = 'hero videoHero ';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'videoHero-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!--Video Hero -->
<section id="<?= $section_id; ?>"  class="<?= $className; ?> clearfix relative <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style="overflow: hidden; <?php if($background_color) { ?> background-color: <?= $background_color ?>; <?php } ?>">
  <div class="cover clearfix" style="position: relative;">
      <div class="container zindex-3 <?= $classSpace ;?>">
        <div class="columns">
          <div class="hero-text column is-12" style="text-align: <?= $hero_content_aligment ?> ">
            <?php if($hero_heading) { ?>
            <h2 class="headingLarge"  style="color: <?= $headline_color ;?>; font-size:<?= $hero_heading_size ;?>rem; font-weight:<?= $hero_heading_weight ;?>; text-transform:<?= $hero_heading_transform ;?>; ">
              <?= $hero_heading ?>
            </h2>
            <?php } ?>
            <?php if($hero_subheading) { ?>
            <p class="sub-title">
              <?= $hero_subheading ?>
            </p>
            <?php } ?>
            <div class="hero-button">
              <?php if($hero_button_1) { ?>
              <a class="button" href="<?= $hero_button_1['url']; ?>" target="<?= esc_attr($hero_button_1_target); ?>" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
              <?= esc_html($hero_button_1['title']); ?>
            </a>
              <?php } ?>
              <?php if($hero_button_2) { ?>
              <a class="button" href="<?= $hero_button_2['url']; ?>" target="<?= esc_attr($hero_button_2_target); ?>" style="background: <?= $secondary_button_bg ;?> ; color: <?= $secondary_button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $secondary_button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
              <?= esc_html($hero_button_2['title']); ?>
            </a>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="videoControls">
          <button onclick="pauseVid()" aria-label="Pause the background video" type="button"><i class="fas fa-pause"></i></button>
          <button onclick="playVid()" aria-label="Play the background video" type="button"><i class="fas fa-play"></i></button>
        </div>

      </div>

      <!--overlay-->
      <?php if($show_overlay) { ?>
      <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
      <?php } ?>
      <!--end overlay-->

  </div>
  <video id="videoEmbed" autoplay loop muted class="banner__video" poster="<?php echo $poster['url']; ?>">
    <source src="<?= $hero_background_video['url'] ?>" type="video/webm">
  </video>
  <script>
			var intro = document.querySelector('.videoHero');
      var introPlayer = document.querySelector('.banner__video');

      var iOS = /iPad|iPhone|iPod/.test(navigator.platform);
      if (iOS) {
        intro.style.backgroundImage = 'url("' + introPlayer.poster + '")';
        introPlayer.style.display = 'none';
      }

      var vid = document.getElementById("videoEmbed");

      function playVid() {
        vid.play();
      }

      function pauseVid() {
        vid.pause();
      }
		</script>
</section>

<!-- End Video Hero -->
