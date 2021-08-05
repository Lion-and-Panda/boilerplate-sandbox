<?php
//Background
$content_background_color = get_field( 'background_color' );
$content_background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($content_background_image) {
  $content_background_image = $content_background_image[ 'sizes' ][ $size ];
}

//Content
$heading = get_field('heading');
$heading_alignment = get_field('heading_alignment');

//Style
$content_spacing = get_field( 'content_spacing' );
$invert = get_field('invert');
$narrow = get_field( 'narrow' );

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );
$num = mt_rand ();
$i = sprintf ($num);

$classSpace = 'is-' . $content_spacing;

// Create class attribute allowing for custom "className"
 $className = 'accordion';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'accordion-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }

?>

<!-- ACCORDION -->
<script type="text/javascript">
jQuery(document).ready(function( $ ) {
  $('.accordion-toggle-li-<?php echo $i;?>').find('.accordion-toggle-<?php echo $i;?>').click(function(){
    var question = $(this).closest('.card-header');
    if(question.hasClass("open")){
      // $(".open").removeClass("open");
      question.removeClass('open');
      question.attr('aria-expanded', 'false');
      $(this).siblings('.card-content').removeClass('open');
      $(this).siblings('.card-content').addClass('is-hidden');
      $(this).siblings('.card-content').attr('aria-hidden', 'true');
    } else {
      question.addClass('open');
      $(this).siblings('.card-content').addClass('open');
      $(this).siblings('.card-content').removeClass('is-hidden');
      $(this).siblings('.card-content').attr('aria-hidden', 'false');
      $(this).attr('aria-expanded', 'true');
    }
    $('html, body').animate({
          scrollTop: $(this).closest('.card-header').offset().top - 100
      }, 500);
  });
});
</script>

<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">
    <div class="container zindex-2">
        <div class="columns">
            <div class="column is-12">
                <!--heading-->
                <?php if($heading) { ?>
                <div>
                    <h2 class="headingLarge" style="text-align: <?= $heading_alignment ;?>;"><?= $heading ?></h2>
                </div>
                <?php } ?>
                <?php if( have_rows('tabs') ): ?>
                <?php
                while ( have_rows( 'tabs' ) ): the_row();
                //Column Content
                $tab_heading = get_sub_field( 'tab_heading' );
                $tab_content = get_sub_field( 'tab_content' );
                ?>
                <div class="card is-fullwidth accordion-toggle-li-<?php echo $i;?>">
                    <header class="card-header accordion-toggle-<?php echo $i;?>" aria-expanded="false" aria-controls="<?= $tab_heading ?>">
                        <h4><?= $tab_heading ?></h4>
                        <a href="#" onclick="return false;" title="open accordion tab" class="card-header-icon card-toggle"><i class="fa fa-angle-down"></i></a>
                    </header>
                    <div class="card-content is-hidden accordion-content-<?php echo $i;?>" aria-hidden="true" role="region" aria-labelledby="<?= $tab_heading ?>">
                        <div class="content">
                            <?= $tab_content ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div><!--end container-->

    <!--overlay-->
    <?php if($show_overlay) { ?>
    <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
    <?php } ?>
    <!--end overlay-->

</section>
<!-- End accordion -->
