<?php
//Background
$hero_background_color = get_field( 'background_color' );
$hero_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($hero_background_image) {
  $hero_background_image = $hero_background_image[ 'sizes' ][ $size ];
}

//Colors
$headline_color = get_field('hero_headline_color' );

//Content
$hero_heading = get_field( 'hero_headline' );
$hero_subheading = get_field( 'subhead' );
$hero_featured_image = get_field( 'featured_image' );
$hero_featured_image_size = get_field( 'featured_image_size' );
if ($hero_featured_image) {
  $image_alt = $hero_featured_image['alt'];
}
$hero_featured_video = get_field( 'feature_video' );
$hero_alignment = get_field( 'hero_alignment' );
$hero_content_aligment = get_field('hero_content_alignment');
$hero_spacing = get_field('hero_spacing');
$hero_heading_size = get_field( 'hero_headline_size' );
$hero_heading_weight = get_field( 'hero_headline_weight' );
$hero_heading_transform = get_field( 'hero_headline_transform' );
$invert = get_field( 'hero_invert' );
$parallax = get_field( 'parallax' );
$narrow = get_field( 'narrow' );

//Button
$hero_button_1 = get_field( 'button_link' );
$hero_button_2 = get_field( 'secondary_button' );
if ($hero_button_1) {
  $hero_button_1_target = $hero_button_1[ 'target' ] ? $hero_button_1[ 'target' ] : '_self';
}
if ($hero_button_2) {
  $hero_button_2_target = $hero_button_2[ 'target' ] ? $hero_button_2[ 'target' ] : '_self';
}
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
$secondary_button_border_color = get_field('secondary_button_border_color', 'option');

//Overlay
$show_overlay = get_field('show_overlay');
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $hero_spacing;

// Create class attribute allowing for custom "className"
 $className = 'hero';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'hero-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>
<!-- Hero -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($parallax) { ?> paraxify <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($hero_background_color) { ?> background-color: <?= $hero_background_color ?>; <?php } ?> <?php if($hero_background_image) { ?> background-image: url(<?= $hero_background_image ?>); <?php } ?> ">
  <div class="container zindex-2 relative">
          <div class="columns <?php if($hero_alignment == 'center') { ?> is-centered has-text-centered <?php } else if ($hero_alignment == 'right') { ?> reverse-row-order <?php } ?>">

            <div class="hero-text column <?php if($hero_featured_image OR $hero_featured_video) {?> is-7 <?php } else { ?> is-12 <?php } ?>" style="text-align: <?= $hero_content_aligment ?> ">
                  <?php if($hero_heading) { ?>
                  <h1 style="color: <?= $headline_color ;?> !important; font-size:<?= $hero_heading_size ;?>rem; font-weight:<?= $hero_heading_weight ;?>; text-transform:<?= $hero_heading_transform ;?>; ">
                      <?= $hero_heading ?>
                  </h1>
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
              <!-- End Hero Text -->

              <div class="hero-image-hero-video column <?php if($hero_featured_image OR $hero_featured_video) {?> is-5 <?php } else { ?> is-hidden <?php } ?>">
                  <?php
                  if ( $hero_featured_image ) {
                    $sizeImg = 'medium'; // (thumbnail, medium, large, full or custom size)
                    $hero_featured_image = $hero_featured_image[ 'sizes' ][ $size ];
                    ?>
                      <div class="image-container">
                        <img src="<?= $hero_featured_image; ?>" alt="<?=  $image_alt ?>" style="text-align: center; height: auto; width: <?= $hero_featured_image_size ?>%; " loading="lazy" />
                      </div>
                      <?php } else if ($hero_featured_video) { ?>
                        <div class="embed-container">
                          <?php
                            // get iframe HTML
                            // use preg_match to find iframe src
                            preg_match('/src="(.+?)"/', $hero_featured_video, $matches);
                            $src = $matches[1];

                            // add extra params to iframe src
                            $params = array(
                                'controls'    => 0,
                                'hd'        => 1,
                                'autohide'    => 1
                            );

                            $new_src = add_query_arg($params, $src);

                            $hero_featured_video = str_replace($src, $new_src, $hero_featured_video);

                            // add extra attributes to iframe html
                            $attributes = 'frameborder="0" loading="lazy"';
                            // use preg_replace to change iframe src to data-src
                            $new_src = add_query_arg($params, $src);

                            $hero_featured_video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $hero_featured_video);

                            // echo $iframe
                            echo $hero_featured_video;
                            ?>
                        </div>
                      <?php } ?>
              </div>
          </div>
      </div><!-- End Container -->

      <!--overlay-->
      <?php if($show_overlay) { ?>
      <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
      <?php } ?>
      <!--end overlay-->

</section>
<!-- End Hero -->
