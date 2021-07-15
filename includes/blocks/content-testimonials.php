<?php
//content
$block_headline = get_field( 'block_headline' );

//Background
$content_background_color = get_field( 'background_color' );
$content_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($content_background_image) {
  $content_background_image = $content_background_image[ 'sizes' ][ $size ];
}

//Style
$headline_aligment = get_field( 'headline_alignment' );
$content_aligment = get_field( 'block_content_alignment' );
$button_aligment = get_field( 'button_alignment' );
$content_spacing = get_field( 'content_spacing' );
$invert_title = get_field( 'title_invert' );
$invert_testimonials = get_field( 'invert_testimonials' );
$column_background = get_field( 'column_background' );
$column_background_color = get_field( 'featured_column_background_color' );
$column_border_radius = get_field( 'featured_column_border_radius' );
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
 $className = 'testimonials';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'testimonials-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }


?>

<!-- Featued Columns -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> relative cover <?= $classSpace ;?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">

<!--headline-->
 <?php if($block_headline) { ?>
  <div class="container zindex-2 <?php if($invert_title) { ?> inverted <?php } ?>">
      <div class="columns">
          <div class="column">
              <h2 class="headingLarge" style="text-align: <?= $headline_aligment ;?>;"> <?= $block_headline ;?></h2>
          </div>
      </div>
  </div>
  <?php } ?>

<div class="container zindex-2">
  <?php if( have_rows('testimonials') ): ?>
  <?php
  while ( have_rows( 'testimonials' ) ): the_row();

  //Column Content
  $headshot = get_sub_field( 'headshot' );
  $testimonial_content = get_sub_field( 'testimonial_content' );
  $name = get_sub_field( 'name' );
  $company = get_sub_field( 'company' );
  $reverse_row = get_sub_field( 'reverse_row' );
  ?>
    <div class="testimonial <?php if($invert_testimonials) { ?> inverted <?php } ?> <?php if($column_dropshadow ) { ?> dropshadow <?php } ?>" <?php if($column_background ) { ?>  style="background: <?= $column_background_color ;?>; border-radius: <?= $column_border_radius ;?>px ;" <?php } ?> >
      <div class="columns columns is-multiline <?php if($reverse_row ) { ?> reverse-row-order <?php } ?>">

        <!--headshot-->
        <?php if($headshot) { ?>
          <div class="column is-3">
            <div class="headshot relative">
              <img src="<?php echo $headshot['url']; ?>" alt="<?php echo esc_attr($headshot['alt']); ?>" loading="lazy" />
            </div>
          </div>
        <?php } ?>

        <!--testimonial text content-->
        <div class="column <?php if($headshot) {?> is-9 <?php } else { ?> is-12 <?php } ?>">
            <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
              <?= $testimonial_content ;?>
            </div>
            <div class="byline">
              <p><span><?= $name ;?></span><?php if($company) { ?>| <?= $company ;?> <?php } ?></p>
            </div>
          </div>

        </div><!--end columns-->
    </div>
  <?php endwhile; ?>
  <?php endif; ?>

</div><!--end container-->

<!--overlay-->
<?php if($show_overlay) { ?>
<div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
<?php } ?>
<!--end overlay-->

</section>
<!-- End Featured Columns -->
