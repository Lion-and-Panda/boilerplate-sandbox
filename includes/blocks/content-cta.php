<?php
//Background
$cta_background_color = get_field('background_color');
$cta_background_image = get_field('background_image');
$size = 'big-feature';
if ($cta_background_image) {
  $cta_background_image = $cta_background_image['sizes'][ $size ];
}

//Content
$cta_heading = get_field('cta_headline');
$cta_bodycopy = get_field('cta_bodycopy');

//Style
$content_aligment = get_field('cta_content_alignment');
$button_aligment = get_field('cta_button_alignment');
$block_spacing = get_field('block_spacing');
$invert = get_field('cta_invert');
$headline_color = get_field('cta_headline_color');
$headline_size = get_field('cta_headline_size');
$headline_weight = get_field('cta_headline_weight');
$parallax = get_field( 'parallax' );
$narrow = get_field( 'narrow' );

//Button
$button = get_field('button_link');
if ($button) {
  $button_target = $button['target'] ? $button['target'] : '_self';
}
$button_right = get_field('button_right');
$button_bg = get_field('button_background_color', 'option');
$button_text_color = get_field('button_text_color', 'option');
$button_padding = get_field('button_padding', 'option');
$button_text_size = get_field('button_font_size', 'option');
$button_text_weight = get_field('button_font_weight', 'option');
$button_text_transform = get_field('button_font_transform', 'option');
$button_radius = get_field('button_radius', 'option');
$button_border_size = get_field('button_border_size', 'option');
$button_border_color = get_field('button_border_color', 'option');

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
 $className = 'cta';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'cta-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- CTA -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($parallax) { ?> paraxify <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($cta_background_color) { ?> background-color: <?= $cta_background_color ?>; <?php } ?> <?php if($cta_background_image) { ?> background-image: url(<?= $cta_background_image ?>); <?php } ?> ">
          <div class="container zindex-2  relative">
              <div class="columns is-multiline is-vcentered">

      					<div class="column <?php if($button_right) {?> is-7 <?php } else { ?> is-12 <?php } ?> ">
                  <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
      							<h2 class="headingLarge"  style="color: <?= $headline_color ;?> !important; font-size: <?= $headline_size ;?>rem; font-weight: <?= $headline_weight ;?>;"> <?= $cta_heading ?> </h2>
      							<?= $cta_bodycopy ?>
      						</div>
      					</div>

                <?php if($button) { ?>
      					<div class="column <?php if($button_right) {?> is-5 <?php } else { ?> is-12 <?php } ?> ">
                  <div class="cta-button" style="text-align: <?= $button_aligment ;?>;">
                          <a href="<?= $button['url']; ?>" role="button" target="<?= esc_attr($button_target); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; "><?= esc_html($button['title']); ?></a>
                  </div>
              </div>
              <?php } ?>

          </div>
        </div> <!-- End Container -->

        <!--overlay-->
        <?php if($show_overlay) { ?>
        <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
        <?php } ?>
        <!--end overlay-->

</section>
<!-- End CTA -->
