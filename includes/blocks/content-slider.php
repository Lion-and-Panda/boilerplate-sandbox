<?php
//Style
$headline_aligment = get_field( 'headline_alignment' );
$content_aligment = get_field( 'content_alignment' );
$block_spacing = get_field( 'block_spacing' );
$button_aligment = get_field( 'button_alignment' );
$invert = get_field( 'title_invert' );
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
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
 $className = 'slider';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'slider-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<script>
  $(document).ready(function(){
  var myCarousel = $(".slider");
  myCarousel.each(function() {
      $(this).not('.slick-initialized').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 600,
        accessibility: true,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
        autoplay: true,
        autoplaySpeed: 6000,
        pauseOnHover: false
      });
    });
  });
</script>

<!--SLIDER-->
<section id="<?= $section_id; ?>" class="<?= $className; ?> <?php if($narrow) { ?> is-narrow <?php } ?>>
  <div id="slider" class="sliders">

    <ul class="slider <?php if($invert) { ?> inverted <?php } ?>">
        <?php if( have_rows('slides') ): ?>
        <?php
        while ( have_rows( 'slides' ) ): the_row();

        //Column Content
        $slide_bg = get_sub_field( 'slide_bg' );
        $slide_headline = get_sub_field( 'slide_headline' );
        $slide_content = get_sub_field( 'slide_content' );
        $button = get_sub_field( 'button_link' );
        if ($button) {
          $button_target = $button[ 'target' ] ? $button[ 'target' ] : '_self';
        }
        $size = 'big-feature';
        if ($slide_bg) {
          $slide_bg = $slide_bg[ 'sizes' ][ $size ];
        }
        ?>

        <!--slide-->
        <li>
          <div class="slide cover <?= $classSpace ;?>" style="background-image: url(<?= $slide_bg ?>); position: relative;">
            <div class="container zindex-2">
              <h2 class="headingLarge"  style="text-align: <?= $headline_aligment ;?>;">
                <?= $slide_headline ?>
              </h2>
              <div style="text-align: <?= $content_aligment ;?>;">
                <?= $slide_content ?>
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

          <!--overlay-->
          <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
          <!--end overlay-->



        </li>

        <?php endwhile; ?>
        <?php endif; ?>
      </ul>
  </div>
</section>

<!-- End Slider -->
