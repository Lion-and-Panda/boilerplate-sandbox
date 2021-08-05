<?php
//Background
$content_background_color = get_field( 'background_color' );
$content_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($content_background_image) {
  $content_background_image = $content_background_image[ 'sizes' ][ $size ];
}

//Content
$content_headline = get_field( 'content_headline' );
$headline_color = get_field( 'headline_color' );
$headline_aligment = get_field( 'headline_alignment' );
$content_aligment = get_field( 'block_content_alignment' );
$button_aligment = get_field( 'button_alignment' );
$content_spacing = get_field( 'content_spacing' );
$invert = get_field( 'title_invert' );
$parallax = get_field( 'parallax' );
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

$classSpace = 'is-' . $content_spacing;

// Create class attribute allowing for custom "className"
 $className = 'contentBlock';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'contentBlock-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }


?>

<!-- Content Block -->
  <section id="<?= $section_id; ?>"  class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($parallax) { ?> paraxify <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">
    <div class="container zindex-2 ">
        <?php if($content_headline) { ?>
      <div class="heading">
        <h2 class="headingLarge"  style="text-align: <?= $headline_aligment ;?>; color: <?= $headline_color ;?>">
          <?= $content_headline ?>
        </h2>
      </div>
         <?php } ?>
      <div class="columns is-multiline">
        <?php if( have_rows('content_block_columns') ): ?>
        <?php while ( have_rows('content_block_columns') ) : the_row(); ?>
        <div class="column">
          <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
            <?php the_sub_field('column_content'); ?>
          </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <!--end columns-->

      <?php if($button) { ?>
      <div class="buttonHolder" style="text-align: <?= $button_aligment ;?> ;">
        <a class="button" href="<?= $button['url']; ?>" role="button" target="<?= esc_attr($button_target); ?>" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
          <?= esc_html($button['title']); ?>
        </a>
      </div>
      <?php } ?>
    </div><!--end container-->

    <!--overlay-->
    <?php if($show_overlay) { ?>
    <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
    <?php } ?>
    <!--end overlay-->

</section>
<!-- End Content Block -->
