<?php
//Background
$background_color = get_field( 'background_color' );
$background_image = get_field( 'background_image' );
$size = 'big-feature';
if ($background_image) {
  $background_image = $background_image[ 'sizes' ][ $size ];
}
$block_headline = get_field( 'block_headline' );
$tags = get_field( 'tags' );
$category = get_field('category');

//style
$block_headline_aligment = get_field( 'block_headline_alignment' );
$headline_aligment = get_field( 'headline_alignment' );
$content_aligment = get_field( 'block_content_alignment' );
$button_aligment = get_field( 'button_alignment' );
$block_spacing = get_field( 'block_spacing' );
$overlay_color = get_field( 'overlay_color_hero', 'option' );
$invert = get_field( 'invert' );
$narrow = get_field( 'narrow' );

//button
$button_bg = get_field( 'button_background_color', 'option' );
$button_text_color = get_field( 'button_text_color', 'option' );
$button_padding = get_field( 'button_padding', 'option' );
$button_text_size = get_field( 'button_font_size', 'option' );
$button_text_weight = get_field( 'button_font_weight', 'option' );
$button_text_transform = get_field( 'button_font_transform', 'option' );
$button_radius = get_field( 'button_radius', 'option' );
$button_border_size = get_field( 'button_border_size', 'option' );
$button_border_color = get_field( 'button_border_color', 'option' );
$secondary_button_bg = get_field( 'secondary_button_background_color', 'option' );
$secondary_button_text_color = get_field( 'secondary_button_text_color', 'option' );
$secondary_button_border_color = get_field( 'secondary_button_border_color', 'option' );

//Overlay
$show_overlay = get_field( 'show_overlay' );
$overlay_type= get_field( 'overlay_type' );
$overlay_color= get_field( 'overlay_color' );
$gradient_color_1= get_field( 'gradient_color_1' );
$gradient_color_2= get_field( 'gradient_color_2' );
$gradient_direction= get_field( 'gradient_direction' );
$overlay_opacity= get_field( 'overlay_opacity' );

$args = array(
    "post_type" => 'post',
    "posts_per_page" => 4,
    "tag" => $tags,
    'category' => $category ,
);

$classSpace = 'is-' . $block_spacing;

// Create class attribute allowing for custom "className"
$className = 'recentPosts';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Create id attribute allowing for custom "anchor" value.
$section_id = 'recentPosts-' . $block['id'];
if( !empty($block['anchor']) ) {
    $section_id = $block['anchor'];
}


$category = get_field('category');
$postsPerPage = get_field('posts_per_page');

$tag = get_field('tags');


        if($tag){
            $tagID = array();
            foreach($tag as $single){
                array_push($tagID , $single->term_id);
            }
        }

        if($category){
            $categoryID = array();
            foreach($category as $single){
                array_push($categoryID , $single->term_id);
            }
        }

        $taxQuery = array(
            'relation' => 'AND',
        );
        if($tag && $tagID){
            $tagQuery = array(
                        'taxonomy' => 'post_tag',
                        'field' => 'id',
                        'terms' => $tagID,
            );
            array_push($taxQuery,$tagQuery);
        }
        if($categoryID){
            $resourceQuery = array(
                        'taxonomy' => 'category',
                        'field' => 'id',
                        'terms' => $categoryID,

            );
            array_push($taxQuery,$resourceQuery);
        }


        $query = array(
            'post_type' => 'post',
            'tax_query' => $taxQuery,
            'posts_per_page' => $postsPerPage,
        );

        $posts = get_posts($query);

?>

<section id="<?= $section_id; ?>" class="<?= $className; ?> cover relative <?= $classSpace ;?> <?php if($invert) { ?> inverted <?php } ?> <?php if($narrow) { ?> is-narrow <?php } ?>" style=" <?php if($background_color) { ?> background-color: <?= $background_color ?>; <?php } ?> <?php if($background_image) { ?> background-image: url(<?= $background_image ?>); <?php } ?> ">

  <div class="container zindex-2">
    <div class="columns is-multiline">

      <!--BLOCK HEADLINE-->
      <div class="column is-12 <?php if($invert) { ?> inverted <?php } ?>">
        <h2 class="headingLarge"  style="text-align: <?= $block_headline_aligment ;?>;"><?php echo $block_headline; ?></h2>
      </div>

      <?php
          foreach($posts as $post){ ?>
        <?php


              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'square' );
                if ($image) {
                $image = $image[ 0 ];
                $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
              }
              $short = get_the_excerpt($post->ID);
              $permalink = get_the_permalink($post->ID);
              $tags = get_the_tags($post->ID);
              $date_format = get_option( 'date_format' );
              get_the_date( $date_format, $post->ID );
              $the_date = get_the_date($date_format, $post->ID);
      ?>
               <div class="column is-one-quarter <?php if($invert) { ?> inverted <?php } ?>">
                  <article class="postBlock">

                    <?php if($image) { ?>
                    <div class="blog-feature">
                      <img src="<?php echo $image; ?>" alt="<?=  $image_alt ?>" class="postImg" loading="lazy" />
                    </div>
                     <?php } ?>

                    <div class="postContent">
                    <?php if($tags) { ?>
                      <div class="postTags">
                        <ul>
                            <?php
                            if ( $tags ) :
                                foreach ( $tags as $tag ) : ?>
                                    <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                      </div>
                   <?php } ?>

            				<div class="post-header">
            					  <a href="<?=$permalink?>"><h3 style="text-align: <?= $headline_aligment ;?>;"><?=$post->post_title?></h3></a>
            				</div>

                    <div class="postDate">
                      <p style="text-align: <?= $content_aligment ;?>;"><?php echo $the_date; ?></p>
                    </div>

            				<div class="post-section">
            				  <p style="text-align: <?= $content_aligment ;?>;"><?=$short?></p>
                      <p style="text-align: <?= $button_aligment ;?>;"><a href="<?=$permalink?>">Read Post</a></p>
            				</div>

                  </div>

                </article>
              </div>
           <?php } ?>
            </div>

          <!--go to blog button-->
          <div class="columns align-center">
            <div class="column">
              <a class="button" href="/blog">More Posts</a>
            </div>
          </div>

        </div><!-- end content-->

        <!--overlay-->
        <?php if($show_overlay) { ?>
        <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
        <?php } ?>
        <!--end overlay-->

</section>
<!--end recent posts-->
