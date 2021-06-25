<?php
//Background and clors
$vic_background_color = get_field( 'background_color' );
$vic_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($vic_background_image) {
  $vic_background_image = $vic_background_image[ 'sizes' ][ $size ];
}

//Content
$vic_heading = get_field( 'vic_headline' );
$vic_bodycopy = get_field( 'vci_bodycopy' );
$vic_featured_image = get_field( 'featured_image' );
if ( $vic_featured_image) {
  $image_alt = $vic_featured_image['alt'];
}
$vic_featured_image_size = get_field( 'featured_image_size' );
$vic_featured_video = get_field( 'feature_video' );

//styles
$vic_alignment = get_field( 'vic_alignment' );
$headline_color = get_field( 'headline_color' );
$vic_content_aligment = get_field( 'vic_content_alignment' );
$vic_spacing = get_field( 'vci_spacing' );
$invert = get_field( 'vic_invert' );
$narrow = get_field( 'narrow' );

//Button
$button = get_field( 'button_link' );
if ($button) {
  $button_target = $button[ 'target' ] ? $button[ 'target' ] : '_self';
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

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classAlign = 'align-' . $vic_alignment;
$classSpace = 'is-' . $vic_spacing;

// Create class attribute allowing for custom "className"
 $className = 'viCopy';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'viCopy-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- vido image and copy -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($vic_background_color) { ?> background-color: <?= $vic_background_color ?>; <?php } ?> <?php if($vic_background_image) { ?> background-image: url(<?= $vic_background_image ?>); <?php } ?> ">
    <div class="container zindex-2 relative">

      <div class="columns <?php if($vic_alignment == 'center') {?> is-centered has-text-centered <?php } else if ($vic_alignment == 'right') { ?> reverse-row-order <?php } ?>">
        <div class="hero-image-hero-video column <?php if($vic_featured_image OR $vic_featured_video) {?> is-5 <?php } ?>">
          <?php
          if ( $vic_featured_image ) {
              $sizeImg = 'full'; // (thumbnail, medium, large, full or custom size)
              $vic_featured_image = $vic_featured_image[ 'sizes' ][ $size ];
            ?>
          <div class="image-container">
            <img src="<?= $vic_featured_image; ?> " alt="<?=  $image_alt ?>" style="text-align: center; height: auto; width: <?= $vic_featured_image_size ?>%; " loading="lazy" />
          </div>
          <?php } else if ($vic_featured_video) { ?>
          <div class="embed-container">
            <?= $vic_featured_video; ?>
          </div>
          <?php } ?>
        </div>

        <div class="hero-text column <?php if($vic_featured_image OR $vic_featured_video) {?> is-7 <?php } else { ?> is-12 <?php } ?>" style="text-align: <?= $vic_content_aligment ?> ">

          <?php if($vic_heading) { ?>
                <h2 class="headingLarge"  style="color: <?= $headline_color ?> !important">
                  <?= $vic_heading ?>
                </h2>
          <?php } ?>

          <div class="body-copy" style="text-align: <?= $vic_content_aligment ?>;" >
            <?php the_field('vic_bodycopy'); ?>
          </div>

          <div class="buttonHolder">
            <?php if($button) { ?>
            <a href="<?= $button['url']; ?>" role="button" target="<?= esc_attr($button_target); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
            <?= esc_html($button['title']); ?>
          </a>
            <?php } ?>
          </div>

        </div>

      </div>
    </div> <!-- End Container -->

    <!--overlay-->
    <?php if($show_overlay) { ?>
    <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
    <?php } ?>
    <!--end overlay-->
</section>
<!-- End Video, Image, and copy -->
