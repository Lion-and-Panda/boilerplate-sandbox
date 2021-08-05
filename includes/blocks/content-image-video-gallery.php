<?php
//content
$section_headline = get_field( 'section_headline' );

//Background
$content_background_color = get_field( 'background_color' );
$content_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($content_background_image) {
  $content_background_image = $content_background_image[ 'sizes' ][ $size ];
}

//Style
$headline_aligment = get_field( 'headline_alignment' );
$headline_color = get_field( 'headline_color' );
$video_headline_aligment = get_field( 'video_headline_alignment' );
$video_content_aligment = get_field( 'video_content_alignment' );
$button_aligment = get_field( 'button_alignment' );
$block_spacing = get_field( 'block_spacing' );
$video_invert = get_field( 'video_invert' );
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

//Video Overlay
$show_slide_overlay = get_field('show_overlay_slide');
$video_overlay_color= get_field( 'video_overlay_color' );
$video_overlay_opacity= get_field( 'video_overlay_opacity' );

//sectin overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
 $className = 'image-video-slider';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'image-video-slider-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!--defer magnific.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js" integrity="sha512-+m6t3R87+6LdtYiCzRhC5+E0l4VQ9qIT1H9+t1wmHkMJvvUQNI5MKKb7b08WL4Kgp9K0IBgHDSLCRJk05cFUYg==" crossorigin="anonymous"></script>

<script>
//image and video gallery slider
$(document).ready(function(){
  jQuery('.slider-for').each(function(key, item) {

  var sliderIdName = 'slider' + key;
  var sliderNavIdName = 'sliderNav' + key;

  this.id = sliderIdName;
  jQuery('.slider-nav')[key].id = sliderNavIdName;

  var sliderId = '#' + sliderIdName;
  var sliderNavId = '#' + sliderNavIdName;

  jQuery(sliderId).not('.slick-initialized').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    infinite: true,
    useTransform: true,
    speed: 400,
    cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
    asNavFor: sliderNavId
  });

  jQuery(sliderNavId).not('.slick-initialized').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: sliderId,
    arrows: true,
    centerMode: false,
    focusOnSelect: true,
    infinite: true,
    variableWidth: true,
    accessibility: true
  });

  });
});
</script>

<!--SLIDER-->
<section id="<?= $section_id; ?>"  class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">
<div class="container zindex-2">

  <!--large side-->
  <div class="columns is-multiline is-centered">

    <!--section headline-->
    <?php if($section_headline) { ?>
      <div class="heading column is-12">
        <h2 class="headingLarge"  style="text-align: <?= $headline_aligment ;?>; color: <?= $headline_color ;?>">
          <?= $section_headline ?>
        </h2>
      </div>
     <?php } ?>

    <div class="column is-12-mobile is-12-tablet is-9-desktop slideBig">
      <ul aria-label="carousel" class="slider-for <?php if($video_invert) { ?> inverted <?php } ?>">
          <?php if( have_rows('slides') ): ?>
          <?php
          while ( have_rows( 'slides' ) ): the_row();

          //Column Content
          $slide_bg = get_sub_field( 'slide_bg' );
          $image_alt = $slide_bg['alt'];
          $slide_headline = get_sub_field( 'slide_headline' );
          $slide_content = get_sub_field( 'slide_content' );
          $video_embed_url = get_sub_field('video_url', false, false);
          $size = 'big-feature';
          if ($slide_bg) {
            $slide_bg = $slide_bg[ 'sizes' ][ $size ];

          }
          ?>

          <!--slide-->
          <li>
            <div class="slide cover" style="background-image: url(<?= $slide_bg ?>); position: relative;" aria-label="<?= $image_alt ?>" role="img">
              <div class="container zindex-2">

                <?php if($slide_headline) { ?>
                  <h2 class="headingLarge"  style="text-align: <?= $video_headline_aligment ;?>;">
                    <?= $slide_headline ?>
                  </h2>
                <?php } ?>

                <?php if($slide_content) { ?>
                  <div style="text-align: <?= $video_content_aligment ;?>;">
                    <?= $slide_content ?>
                  </div>
                <?php } ?>

                <?php if($video_embed_url) { ?>
                <div class="buttonHolder" style="text-align: <?= $button_aligment ;?> ;">
                  <a class="popup-video" href="<?= $video_embed_url; ?>" title="play video" aria-haspopup="true">
                    <i class="fal fa-play-circle"></i>
                  </a>
                </div>
                <?php } ?>

              </div>

            </div>
            <?php if ($show_slide_overlay &&  $slide_headline || $slide_content || $video_embed_url) { ?>
              <div class="overlay" style="background-color: <?= $video_overlay_color ?>; opacity: <?= $video_overlay_opacity ?>;"></div>
            <?php } ?>

          <?php endwhile; ?>
          <?php endif; ?>
        </li>
        </ul>
      </div>
  </div>

      <!--slider nav-->
      <div class="columns is-centered">
        <div class="column is-12-mobile is-12-tablet is-9-desktop">
          <ul aria-label="thumbnails" class="slider-nav">
              <?php if( have_rows('slides') ): ?>
              <?php
              while ( have_rows( 'slides' ) ): the_row();

              //Column Content
              $slide_bg = get_sub_field( 'slide_bg' );
              $video_embed_url = get_sub_field('video_url', false, false);
              $size = 'big-feature';
              $alt = $slide_bg['alt'];
              if ($slide_bg) {
                $slide_bg = $slide_bg[ 'sizes' ][ $size ];
              }
              ?>

              <!--thumbnails-->
              <li class="relative <?php if($video_invert) { ?> inverted <?php } ?>">
                  <div class="thumbnail cover" style="background-image: url(<?= $slide_bg ?>); position: relative;">
                    <div class="container zindex-2">

                    <?php if($video_embed_url) { ?>
                        <i class="fal fa-play-circle"></i>
                    <?php } ?>

                  </div>

                  <?php if ($video_embed_url) { ?>
                    <div class="overlay" style="background-color: <?= $video_overlay_color ?>; opacity: <?= $video_overlay_opacity ?>;"></div>
                  <?php } ?>

                  </div>

              </li>

              <?php endwhile; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div><!--end container-->

      <!--overlay-->
      <?php if($show_overlay) { ?>
      <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
      <?php } ?>
      <!--end overlay-->

</section>

 <script>
//magnific
function extendMagnificIframe(){

    var $start = 0;
    var $iframe = {
        markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" aria-label="video popup" allowfullscreen></iframe>' +
                '</div>' +
                '<div class="mfp-bottom-bar">' +
                '<div class="mfp-title"></div>' +
                '</div>',
        patterns: {
            youtube: {
                index: 'youtu',
                id: function(url) {

                    var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
                    if ( !m || !m[1] ) return null;

                        if(url.indexOf('t=') != - 1){

                            var $split = url.split('t=');
                            var hms = $split[1].replace('h',':').replace('m',':').replace('s','');
                            var a = hms.split(':');

                            if (a.length == 1){

                                $start = a[0];

                            } else if (a.length == 2){

                                $start = (+a[0]) * 60 + (+a[1]);

                            } else if (a.length == 3){

                                $start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                            }
                        }

                        var suffix = '?autoplay=1';

                        if( $start > 0 ){

                            suffix = '?start=' + $start + '&autoplay=1';
                        }

                    return m[1] + suffix;
                },
                src: '//www.youtube.com/embed/%id%'
            },
            vimeo: {
                index: 'vimeo.com/',
                id: function(url) {
                    var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                    if ( !m || !m[5] ) return null;
                    return m[5];
                },
                src: '//player.vimeo.com/video/%id%?autoplay=1'
            }
        }
    };

    return $iframe;

}

$('.popup-video').magnificPopup({
    type: 'iframe',
    iframe: extendMagnificIframe()
});

  </script>

<!-- End video gallery -->
