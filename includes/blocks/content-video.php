<?php
//Background
$background_color = get_field( 'background_color' );
$background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($background_image) {
  $background_image = $background_image[ 'sizes' ][ $size ];
}

//content
$content_headline = get_field( 'content_headline' );
$featured_video = get_field( 'feature_video' );

//style
$headline_aligment = get_field( 'headline_alignment' );
$headline_color = get_field( 'headline_color' );
$video_spacing = get_field( 'video_spacing' );
$invert = get_field( 'invert' );
$narrow = get_field( 'narrow' );

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $video_spacing;

// Create class attribute allowing for custom "className"
 $className = 'video';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'video-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- Video -->
<section id="<?= $section_id; ?>" class="<?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?> relative" style="background: <?= $background_color ;?> ">

  <div class="<?= $className; ?> cover relative <?= $classSpace ;?> " style="<?php if($background_image): ?> background-image: url(<?= $background_image ?>); <?php elseif($background_color): ?> background: <?= $background_color ?>; <?php else: ?> <?php endif; ?>  ">

      <div class="container zindex-2 relative">
        <div class="columns is-centered">
          <div class="column is-12-mobile is-10-desktop">

             <!--headline-->
            <?php if($content_headline) { ?>
            <div class="heading">
              <h2 class="headingLarge"  style="text-align: <?= $headline_aligment ;?>; color: <?= $headline_color ;?>">
                <?= $content_headline ?>
              </h2>
            </div>
             <?php } ?>

             <!--video-->
            <div class="embed-container">
              <?php
                // get iframe HTML
                $featured_video = get_field('feature_video');
                // use preg_match to find iframe src
                preg_match('/src="(.+?)"/', $featured_video, $matches);
                $src = $matches[1];

                // add extra params to iframe src
                $params = array(
                    'controls'    => 0,
                    'hd'        => 1,
                    'autohide'    => 1
                );

                $new_src = add_query_arg($params, $src);

                $featured_video = str_replace($src, $new_src, $featured_video);

                // add extra attributes to iframe html
                $attributes = 'frameborder="0" loading="lazy"';
                // use preg_replace to change iframe src to data-src
                $new_src = add_query_arg($params, $src);

                $featured_video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $featured_video);

                // echo iframe
                echo $featured_video;
                ?>
            </div>

          </div>
        </div>
      </div><!-- End Container -->

      <!--overlay-->
      <?php if($show_overlay) { ?>
      <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
      <?php } ?>
      <!--end overlay-->

  </div>
</section>
<!-- End Video -->
