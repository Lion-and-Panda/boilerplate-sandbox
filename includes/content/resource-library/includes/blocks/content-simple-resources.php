<?php
  // backend resource library options
  $headline = get_field('headline');
  $textarea = get_field('textarea');
  $type = get_field('type');
  $tag = get_field('tag');
  $resourceCategory = get_field('resource_category');
  $resourceLayout = get_field('resource_layout');
  $postsPerPage = get_field('posts_per_page');
  // fixes undefined variables error
  $typeID = null;
  $tagID = null;

  // get every resource type in an array
  if($type){
      $typeID = array();
      foreach($type as $single){
          array_push($typeID , $single->term_id);
      }
  }
  // get every resource tag in an array
  if($tag){
      $tagID = array();
      foreach($tag as $single){
          array_push($tagID , $single->term_id);
      }
  }

  // get every resource category in an array
  if($resourceCategory){
      $resourceCategoryID = array();
      foreach($resourceCategory as $single){
          array_push($resourceCategoryID , $single->term_id);
      }
  }

  // setup cumulative query variable
  $taxQuery = array(
      'relation' => 'AND',
  );

  // if type exists add it to $taxQuery
  if($typeID){
      $typeQuery = array(
        'taxonomy' => 'type_group',
        'field' => 'id',
        'terms' => $typeID,
      );
      array_push($taxQuery,$typeQuery);
  }

  // if tag exists add it to $taxQuery
  if($tagID){
      $tagQuery = array(
        'taxonomy' => 'post_tag',
        'field' => 'id',
        'terms' => $tagID,
      );
      array_push($taxQuery,$tagQuery);
  }

  // if resource category exists add it to $taxQuery
  if($resourceCategoryID){
      $resourceQuery = array(
        'taxonomy' => 'resource_category',
        'field' => 'id',
        'terms' => $resourceCategoryID,
      );
      array_push($taxQuery,$resourceQuery);
  }

  // create resource query variable with the cumulative variable
  $query = array(
      'post_type' => 'resource',
      'tax_query' => $taxQuery,
  );

  // if posts per page exists add it to the query
  if($postsPerPage){
      $query['posts_per_page'] = $postsPerPage;
  }

  // get all the posts with specified tag, type, resource and posts per page
  $posts = get_posts($query);

  //Background
  $content_background_color = get_field( 'background_color' );
  $content_background_image = get_field( 'background_image' );
  $size = 'full-size';
  if ($content_background_image) {
    $content_background_image = $content_background_image[ 'sizes' ][ $size ];
  }

  //Content
  $invert = get_field( 'invert' );
  $resource_block_description = get_field('description');
  $block_headline = get_field( 'block_headline' );


  //Overlay
  $show_overlay = get_field( 'show_overlay' );
  $overlay_type= get_field( 'overlay_type' );
  $overlay_color= get_field( 'overlay_color' );
  $gradient_color_1= get_field( 'gradient_color_1' );
  $gradient_color_2= get_field( 'gradient_color_2' );
  $gradient_direction= get_field( 'gradient_direction' );
  $overlay_opacity= get_field( 'overlay_opacity' );


  // Create id attribute allowing for custom "anchor" value.
  $section_id = 'contentBlock-' . $block['id'];
  if( !empty($block['anchor']) ) {
      $section_id = $block['anchor'];
  }

  // Create class attribute allowing for custom "className"
   $className = 'contentBlock';
   if( !empty($block['className']) ) {
       $className .= ' ' . $block['className'];
   }
?>


<section id="<?= $section_id; ?>" class=" <?= $className; ?> is-small section cover relative resource-library <?php if($invert) { ?> inverted <?php } ?>" style=" <?php if($content_background_color) { ?> background-color: <?= $content_background_color ?>; <?php } ?> <?php if($content_background_image) { ?> background-image: url(<?= $content_background_image ?>); <?php } ?> ">

  <!--overlay-->
  <?php if($show_overlay) { ?>
  <div class="overlay" style="<?php if ($overlay_type === 'color') { ?> background-color: <?= $overlay_color ?>; opacity: <?= $overlay_opacity ?>;<?php } ?> <?php if ($overlay_type === 'gradient') { ?>background-image: linear-gradient(to <?= $gradient_direction ?>, <?= $gradient_color_1 ?> , <?= $gradient_color_2 ?>); opacity: <?= $overlay_opacity ?>; <?php } ?> "></div>
  <?php } ?>
  <!--end overlay-->

  <div class="container simple-resource">
    <h2 class="headingLarge"><?=$headline?></h2>
    <div><?=$textarea?></div>

    <?php if($resourceLayout == 'block') { ?>
      <?php include_once(get_template_directory() . '/includes/content/resource-library/includes/partials/simple-blocks.php') ?>
    <?php } ?>

    <?php if($resourceLayout == 'title') { ?>
      <?php include_once(get_template_directory() . '/includes/content/resource-library/includes/partials/simple-titles.php') ?>
    <?php } ?>

    <?php
    // Video player iframe
    include_once(get_template_directory() . '/includes/content/resource-library/includes/partials/magnefic-iframe.php')
    ?>

  </div>
</section>
