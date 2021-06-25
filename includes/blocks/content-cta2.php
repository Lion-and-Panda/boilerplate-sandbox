<?php
//Columnn One Content
$cta_heading = get_field( 'cta_headline' );
$cta_bodycopy = get_field( 'cta_bodycopy' );
$button = get_field( 'button_link' );
if ($button) {
  $button_target = $button[ 'target' ] ? $button[ 'target' ] : '_self';
}
$cta_background_color = get_field( 'background_color' );
$cta_background_image = get_field( 'background_image' );
$cta_overlay_color_custom_1 = get_field( 'overlay_color_1' );

//Columnn Two Content
$cta_heading_2 = get_field( 'cta_headline_2' );
$cta_bodycopy_2 = get_field( 'cta_bodycopy_2' );
$button_2 = get_field( 'button_link_2' );
if ($button_2) {
  $button_target_2 = $button_2[ 'target' ] ? $button_2[ 'target' ] : '_self';
}
$cta_background_color_2 = get_field( 'background_color_2' );
$cta_background_image_2 = get_field( 'background_image_2' );
$cta_overlay_color_custom_2 = get_field( 'overlay_color_2' );

//Background
$size = 'big-feature';
if ($cta_background_image){
  $cta_background_image = $cta_background_image[ 'sizes' ][ $size ];
}
if ($cta_background_image_2){
  $cta_background_image_2 = $cta_background_image_2[ 'sizes' ][ $size ];
}

//Style
$content_aligment = get_field( 'cta_content_alignment' );
$button_aligment = get_field( 'cta_button_alignment' );
$block_spacing = get_field( 'block_spacing' );
$show_overlay = get_field( 'show_overlay' );
$invert1 = get_field( 'cta_invert_1' );
$invert2 = get_field( 'cta_invert_2' );
$headline_color = get_field( 'cta_headline_color' );
$headline_size = get_field( 'cta_headline_size' );
$headline_weight = get_field( 'cta_headline_weight' );

//Button Styles
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

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
 $className = 'cta2';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'cta2-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- two sided call to action -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> relative">
  <div class="columns">

    <!--COLUMN ONE-->
    <div class="column cta2-col cover relative <?= $classSpace ;?> <?php if($invert1) { ?> inverted <?php } ?>" style=" <?php if($cta_background_color) { ?> background-color: <?= $cta_background_color ?>; <?php } ?> <?php if($cta_background_image) { ?> background-image: url(<?= $cta_background_image ?>); <?php } ?> ">
      <div class="zindex-2 relative ">
        <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
          <h2 style="color: <?= $headline_color ;?>; font-size: <?= $headline_size ;?>rem; font-weight: <?= $headline_weight ;?>;">
            <?= $cta_heading ?>
          </h2>
          <?= $cta_bodycopy ?>
        </div>
        <div class="cta-button" style="text-align: <?= $button_aligment ;?>;">
          <?php if($button) { ?>
          <a href="<?= $button['url']; ?>" role="button" target="<?= esc_attr($button_target); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
          <?= esc_html($button['title']); ?>
        </a>
          <?php } ?>
        </div>
      </div>

      <!--column overlay-->
       <div class="overlay" style="background-color: <?= $cta_overlay_color_custom_1 ?>;"></div>

    </div>


  <!--COLUMN TWO-->
  <div class="column cta2-col cover relative <?= $classSpace ;?> <?php if($invert2) { ?> inverted <?php } ?>" style=" <?php if($cta_background_color_2) { ?> background-color: <?= $cta_background_color_2 ?>; <?php } ?> <?php if($cta_background_image_2) { ?> background-image: url(<?= $cta_background_image_2 ?>); <?php } ?> ">
    <div class="zindex-2 relative ">
      <div class="body-copy" style="text-align: <?= $content_aligment ;?>;" >
        <h2 style="color: <?= $headline_color ;?>; font-size: <?= $headline_size ;?>rem; font-weight: <?= $headline_weight ;?>;">
          <?= $cta_heading_2 ?>
        </h2>
        <?= $cta_bodycopy_2 ?>
      </div>
      <div class="cta-button" style="text-align: <?= $button_aligment ;?>;">
        <?php if($button_2) { ?>
        <a href="<?= $button_2['url']; ?>" role="button" target="<?= esc_attr($button_target_2); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
        <?= esc_html($button_2['title']); ?>
      </a>
        <?php } ?>
      </div>
    </div>

      <!--column overlay-->
     <div class="overlay" style="background-color: <?= $cta_overlay_color_custom_2 ?>;"></div>

  </div>

  </div>

  <!--overlay-->
  <?php if($show_overlay) { ?>
  <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
  <?php } ?>
  <!--end overlay-->

</section>
<!--END TWO SIDED CTA-->
