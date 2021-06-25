<?php
//Background
$title_background_color = get_field( 'pagetitle_background_color', 'option' );
$title_background_color_custom = get_field( 'background_color' );
$title_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($title_background_image) {
  $title_background_image = $title_background_image[ 'sizes' ][ $size ];
}

//Colors
$title_color = get_field( 'pagetitle_color', 'option' );
$title_color_custom = get_field( 'pagetitle_color' );

//Content
$title_heading = get_field( 'title_headline' );
$title_subtitle = get_field( 'title_subtitle' );

$title_content_aligment = get_field( 'title_content_alignment', 'option' );
$title_content_aligment_custom = get_field( 'title_content_alignment' );
$title_text_size = get_field( 'title_text_size', 'option' );
$title_text_weight = get_field( 'title_text_weight', 'option' );
$title_text_transform = get_field( 'title_text_transform', 'option' );
$title_spacing = get_field( 'title_spacing' );
$invert = get_field( 'title_invert' );

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $title_spacing;

// Create class attribute allowing for custom "className"
 $className = 'pageTitle';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'pageTitle-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- Page Title -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?>" style=" <?php if($title_background_image) { ?> background-image: url(<?= $title_background_image ?>); <?php } ?> <?php if($title_background_color_custom) { ?> background-color: <?= $title_background_color_custom ?>; <?php } else if ($title_background_color) { ?> background-color: <?= $title_background_color_custom ;?> <?php } ?>">

  <div class="container zindex-2 relative">
    <div class="columns">

      <div class="column is-12" style="text-align:  <?php if($title_content_aligment_custom) { echo  $title_content_aligment_custom;  }  else {  echo $title_content_aligment; } ?> ;">

        <?php if($title_heading) { ?>
        <h1 class="headingLarge"  style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">
          <?= $title_heading ?>
        </h1>
        <?php } ?>

        <?php if($title_subtitle) { ?>
          <h3><?= $title_subtitle ?></h3>
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
<!-- End Page Title -->
