<?php
//Background
$content_background_color = get_field( 'background_color' );
$content_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($content_background_image) {
  $content_background_image = $content_background_image[ 'sizes' ][ $size ];
}
$block_headline= get_field( 'block_headline' );

//Style
$headline_aligment = get_field( 'headline_alignment' );
$content_aligment = get_field( 'block_content_alignment' );
$content_spacing = get_field( 'content_spacing' );
$invert = get_field( 'title_invert' );
$column_background = get_field( 'column_background' );
$column_background_color = get_field( 'steps_column_background_color' );
$column_border_radius = get_field( 'steps_column_border_radius' );
$column_dropshadow = get_field( 'drop_shadow' );
$narrow = get_field( 'narrow' );

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
 $className = 'featuredColumns';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'featuredColumns-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }


?>

<!-- Featued Columns -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> steps relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">
  <div class="container zindex-2">

    <?php if($block_headline) {?>
      <div class="columns">
          <div class="column">
            <h2 class="headingLarge" ><?=$block_headline?></h2>
          </div>
        </div>
      <?php } ?>

    <div class="columns is-multiline">
      <?php if( have_rows('step_columns') ):  $step = 1; ?>
      <?php
      while ( have_rows( 'step_columns' ) ): the_row();

      //Column Content
      $column_headline = get_sub_field( 'column_headline' );
      $column_content = get_sub_field( 'column_content' );
      ?>
      <div class="column">
        <div class="stepsCol <?php if($column_dropshadow ) { ?> dropshadow <?php } ?>" <?php if($column_background ) { ?>  style="padding: 15px; background: <?= $column_background_color ;?>; border-radius: <?= $column_border_radius ;?>px ;" <?php } ?> >
          <h4 style="text-align: <?= $headline_aligment ;?>;">Step <?php echo $step; ?></h4>
          <h3 style="text-align: <?= $headline_aligment ;?>;">
            <?= $column_headline ;?>
          </h3>
            <hr>
          <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
            <?= $column_content ;?>
          </div>
        </div>
      </div>
      <?php
      $step++;
      endwhile;
      ?>
      <?php endif; ?>
    </div> <!--end columns-->

  </div><!--end container-->

  <!--overlay-->
  <?php if($show_overlay) { ?>
  <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
  <?php } ?>
  <!--end overlay-->

</section>
<!-- End Steps -->
