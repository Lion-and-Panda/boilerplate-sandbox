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
$invert_testimonials = get_field( 'testimonial_invert' );
$column_background = get_field( 'column_background' );
$column_background_color = get_field( 'featured_column_background_color' );
$column_border_radius = get_field( 'featured_column_border_radius' );
$column_dropshadow = get_field( 'drop_shadow' );
$parallax = get_field( 'parallax' );
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
 $className = 'ordered-list';
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 // Create id attribute allowing for custom "anchor" value.
 $section_id = 'ordered-list-' . $block['id'];
 if( !empty($block['anchor']) ) {
     $section_id = $block['anchor'];
 }


?>
<!-- Featued Columns -->
<section id="<?= $section_id; ?>" class="<?= $className; ?> relative cover <?= $classSpace ;?> <?php if($parallax) { ?> paraxify <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">

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

<!--content-->
<?php
  // setup counters
  $counter = 0;
  $letter_counter = 'a';
  $roman_counter = 1;
  $roman_iteration = 0;
?>
<div class="container zindex-2">
  <?php if( have_rows('list_content') ): ?>
  <?php
  while ( have_rows( 'list_content' ) ): the_row();
    if( have_rows('list_items_1') ): // 1st/Numbers level
      while ( have_rows( 'list_items_1')): the_row();
        $counter++;
        $list_item_1 = get_sub_field( 'list_item_1' );
        ?>
        <div class="content numeral">
          <aside class='arrow numeral'><span class="numberCircle"><?= $counter?></span>  <?= $list_item_1 ?></aside>
        </div>
        <?php
      endwhile;
    endif; // end first level

    if( get_row_layout() == 'layout_2'): // 2nd/letters level
      $letter_counter = 'a';
      if ( have_rows( 'inner_list_a' )):
        while ( have_rows( 'inner_list_a' )): the_row();
          if (have_rows( 'list_items_a' )):
            while ( have_rows( 'list_items_a' )): the_row();
            $list_item_a = get_sub_field( 'list_item_a' );
            ?>
            <div class="content letter">
              <aside class="arrow letter"><span class="numberCircle letter"><?=  $letter_counter?></span> <?= $list_item_a ?></aside>
            </div>
            <?php
            $letter_counter++;
            endwhile;
          endif;
          if( get_row_layout() == 'layout_2_a'): // 3rd/Roman layout
            $roman_counter = 1;
            $roman_iteration++;
            if ( have_rows( 'inner_list_i' )):
              while ( have_rows( 'inner_list_i' )): the_row();
                if (have_rows( 'list_items_i' )):
                  if ($roman_iteration==1): // if this is the first time using roman numerals run script
                  ?>
                    <!-- convert number to roman numerals -->
                    <script>
                      function romanize(num) {
                          if (isNaN(num))
                              return NaN;
                          var digits = String(+num).split(""),
                              key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
                                     "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
                                     "","I","II","III","IV","V","VI","VII","VIII","IX"],
                              roman = "",
                              i = 3;
                          while (i--)
                              roman = (key[+digits.pop() + (i * 10)] || "") + roman;
                          return Array(+digits.join("") + 1).join("M") + roman;
                      }
                    </script>
                  <?php
                  endif;
                  while ( have_rows( 'list_items_i' )): the_row();
                    $list_item_i = get_sub_field( 'list_item_i' );
                    ?>
                    <div class="content roman">
                      <aside class="arrow roman"><span class="numberCircle roman" id="roman<?=$roman_counter . "-" . $roman_iteration?>"></span><?=$list_item_i?></aside>
                    </div>
                    <!-- script inserts roman numerals into-->
                    <script>
                      var currentElement = document.getElementById("roman<?=$roman_counter . "-" . $roman_iteration?>");
                      currentElement.innerHTML = romanize(<?=$roman_counter?>).toLowerCase();
                    </script>
                    <?php
                    $roman_counter++;
                  endwhile;
                endif;
              endwhile;
            endif;
          endif; // end third level
        endwhile;
      endif;
    endif; // end second level


  ?>
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
