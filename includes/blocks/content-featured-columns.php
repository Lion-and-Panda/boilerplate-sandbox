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
$invert = get_field( 'title_invert' );
$image_size = get_field( 'image_size' );
$image_border_radius = get_field( 'image_border_radius' );
$column_background = get_field( 'column_background' );
$column_background_color = get_field( 'featured_column_background_color' );
$column_border_radius = get_field( 'featured_column_border_radius' );
$column_dropshadow = get_field( 'drop_shadow' );
$narrow = get_field( 'narrow' );

//Button
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
<section id="<?= $section_id; ?>" class="<?= $className; ?> relative cover <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">

<!--headline-->
 <?php if($block_headline) { ?>
  <div class="container zindex-2">
      <div class="columns">
          <div class="column">
              <h2 class="headingLarge" style="text-align: <?= $headline_aligment ;?>;"> <?= $block_headline ;?></h2>
          </div>
      </div>
  </div>
  <?php } ?>

<div class="container zindex-2">
  <div class="columns columns is-multiline">
  <?php if( have_rows('featured_columns') ): ?>
  <?php
  while ( have_rows( 'featured_columns' ) ): the_row();

  //Column Content
  $column_image = get_sub_field( 'column_image' );
  $column_headline = get_sub_field( 'column_headline' );
  $column_content = get_sub_field( 'column_content' );
  $button = get_sub_field( 'button_link' );
  if ($button) {
    $button_target = $button[ 'target' ] ? $button[ 'target' ] : '_self';
}
  ?>

    <div class="column">
      <div class="featCol <?php if($column_dropshadow ) { ?> dropshadow <?php } ?>" <?php if($column_background ) { ?>  style="padding: 15px; background: <?= $column_background_color ;?>; border-radius: <?= $column_border_radius ;?>px ;" <?php } ?> >

        <?php if($column_image) { ?>
          <div class="columnImage relative <?= $image_size ;?>"  style="border-radius: <?= $image_border_radius ;?>px " >
            <img src="<?php echo $column_image['url']; ?>" alt="<?php echo esc_attr($column_image['alt']); ?>" loading="lazy" />
          </div>
        <?php } ?>

        <h3 style="text-align: <?= $headline_aligment ;?>;">
          <?= $column_headline ;?>
        </h3>
        <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
          <?= $column_content ;?>
        </div>

        <?php if($button) {?>
        <div class="buttonHolder" style="text-align: <?= $button_aligment ;?> ;">
          <a href="<?= $button['url']; ?>" target="<?= esc_attr($button_target); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?= $button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; " role="button">
          <?= esc_html($button['title']); ?>
        </a>
       </div>
        <?php } ?>
      </div>
    </div>
  <?php endwhile; ?>
  <?php endif; ?>

</div><!--end columns-->
</div><!--end container-->

<!--overlay-->
<?php if($show_overlay) { ?>
<div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
<?php } ?>
<!--end overlay-->

</section>
<!-- End Featured Columns -->
