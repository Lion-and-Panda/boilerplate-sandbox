<?php
//Content
$ls_heading = get_field('ls_headline');

//Style
$block_spacing = get_field('block_spacing');
$headline_aligment = get_field( 'headline_alignment' );
$headline_color = get_field( 'headline_color' );
$invert = get_field('cta_invert');
$narrow = get_field( 'narrow' );

//Background
$cta_background_color = get_field('background_color');
$cta_background_image = get_field('background_image');
if ($cta_background_image) {
  $size = 'big-feature';
  $cta_background_image = $cta_background_image['sizes'][ $size ];
}

//Button
$button = get_field('ls_link');
if ($button) {
  $button_target = $button['target'] ? $button['target'] : '_self';
}

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
 $className = 'logoSlider';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'logoSlider-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<script>
// logo sliders
$(document).ready(function(){
var myCarousel = $(".logoSlides");
myCarousel.each(function() {
    $(this).not('.slick-initialized').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      accessibility: true,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  });
});
</script>

<!-- Logo Slider -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($cta_background_color) { ?> background-color: <?= $cta_background_color ?>; <?php } ?> <?php if($cta_background_image) { ?> background-image: url(<?= $cta_background_image ?>); <?php } ?> ">
  <div class="container zindex-2 relative">

      <!--block headline-->
      <?php if($ls_heading) { ?>
        <div class="columns">
          <div class="column text-centered">
            <h2 class="headingLarge"  style="text-align: <?= $headline_aligment ;?>; color: <?= $headline_color ;?> !important">
              <?= $ls_heading ;?>
            </h2>
    			</div>
        </div>
      <?php } ?>

      <!--logo slider-->
      <div class="columns">
        <div class="column is-12 text-centered">
          <div class="logoSlides">

            <?php if( have_rows('logos') ): ?>
            <?php while ( have_rows( 'logos' ) ): the_row();
            //Column Content
            $logo_image = get_sub_field( 'column_image' );
            $logo_link = get_sub_field( 'column_link' );
            ?>

            <!--individual logo slides-->
            <?php if($logo_link) { ?>
              <a href="<?= $logo_link['url']; ?>" target="<?= esc_attr($logo_link); ?>" aria-label="visit our client's website">
              <?php } ?>
            <img src="<?php echo $logo_image['url']; ?>" alt="<?php echo esc_attr($logo_image['alt']); ?>" loading="lazy" />
            <?php if($logo_link) { ?>
              </a>
            <?php } ?>

            <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
    </div>

    <!--block button-->
    <?php if($button) { ?>
      <div class="columns">
        <div class="column text-centered">
          <a href="<?= $button['url']; ?>" target="<?= esc_attr($button_target); ?>" class="button jumbo"><?= esc_html($button['title']); ?></a>
        </div>
      </div>
      <?php } ?>

</div><!-- end container-->

<!--overlay-->
<?php if($show_overlay) { ?>
<div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
<?php } ?>
<!--end overlay-->

</section>

<!-- End logo slider -->
