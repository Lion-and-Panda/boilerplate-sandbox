<?php
/* ------------------------------------------------------------------------- *
 *  search results page
/* ------------------------------------------------------------------------- */
?>
<?php get_header(); ?>
<?php
$title_background_color = get_field( 'pagetitle_background_color', 'option' );
$title_content_aligment = get_field( 'title_content_alignment', 'option' );
$title_text_size = get_field( 'title_text_size', 'option' );
$title_text_weight = get_field( 'title_text_weight', 'option' );
$title_text_transform = get_field( 'title_text_transform', 'option' );

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
?>

<main id="wrapper"><!-- main -->
  <div id="search-content" class="main-content" role="main">

    <!--PAGE TITLE-->
    <div class="relative">
      <section class="pageTitle is-small" style="background-color: <?= $title_background_color ;?>; ">
        <div class="container">
          <div class="columns">
            <div class="column is-12" style="text-align: <?= $title_content_aligment ;?>;">
              <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Here is what we found for &quot;<?php echo get_search_query(); ?>&quot;</h1>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!--search results area-->
    <div class="main-content" role="main">
      <div class="container is-medium">
        <div class="columns">
          <div class="column is-12">
              <?php if ( have_posts() ) :  // results found?>
              <?php while ( have_posts() ) : the_post(); ?>
              <article>
                <div class="post-page">
                  <h2><a href="<?php the_permalink(); ?>">
                    <?php the_title();  ?>
                    </a></h2>
                  <?php the_excerpt(); ?>
                  <div class="buttonHolder"> <a href="<?php the_permalink(); ?>" class="button" style="background: <?= $button_bg ;?> ; color: <?= $button_text_color ;?> ; padding: <?= $button_padding ;?>px; font-size: <?= $button_text_size ;?>rem; font-weight: <?= $button_text_weight ;?>; text-transform: <?= $button_text_transform ;?>; border: solid <?= $button_border_size ;?>px <?= $button_border_color ;?>; border-radius: <?= $button_radius ;?>px; ">View</a> </div>
                  <hr>
                </div>
              </article>
              <?php endwhile; ?>
              <?php else :  // no results?>
              <article>
                <h3>No Results Found.</h3>
              </article>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
