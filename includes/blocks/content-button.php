<?php

//Style
$block_spacing = get_field( 'block_spacing' );
$block_content_aligment = get_field( 'block_content_alignment' );

//Button
$button = get_field( 'button_link' );
$button_target = $button[ 'target' ] ? $button[ 'target' ] : '_self';

//Global Button Style
$button_bg = get_field( 'button_background_color', 'option' );
$button_text_color = get_field( 'button_text_color', 'option' );
$button_padding = get_field( 'button_padding', 'option' );
$button_text_size = get_field( 'button_font_size', 'option' );
$button_text_weight = get_field( 'button_font_weight', 'option' );
$button_text_transform = get_field( 'button_font_transform', 'option' );
$button_radius = get_field( 'button_radius', 'option' );
$button_border_size = get_field( 'button_border_size', 'option' );
$button_border_color = get_field( 'button_border_color', 'option' );

//custom Button Style
$button_size = get_field('button_size');
$background_color = get_field('background_color');
$text_color = get_field('text_color');

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
 $className = 'buttonHolder';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'buttonHolder-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }


?>

<!-- Button -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> relative <?= $classSpace ;?>">

  <div class="container">
      <div class="columns">

        <div class="column" style="text-align: <?= $block_content_aligment ?> ">

			<a href="<?= $button['url']; ?>" target="<?= esc_attr($button_target); ?>" class="button <?= $button_size ;?>" style="background-color: <?php if($background_color) { echo  $background_color;  }  else {  echo $button_bg; } ?>; color: <?php if($text_color) { echo  $text_color;  }  else {  echo $button_text_color; } ?>; padding: <?=$button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ; ?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">
			  	  <?= esc_html($button['title']); ?>
          </a>

        </div>

      </div>
    </div><!-- End Container -->

</section>
<!-- End Button -->
