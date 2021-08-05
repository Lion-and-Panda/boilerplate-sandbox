<?php
/* ------------------------------------------------------------------------- *
Archive Page
/* ------------------------------------------------------------------------- */
?>
<?php get_header(); ?>
<?php
$title_background_color = get_field( 'pagetitle_background_color', 'option' );
$title_content_aligment = get_field( 'title_content_alignment', 'option' );
$title_text_size = get_field( 'title_text_size', 'option' );
$title_text_weight = get_field( 'title_text_weight', 'option' );
$title_text_transform = get_field( 'title_text_transform', 'option' );
?>

<main id="wrapper"><!-- main -->
	<div id="page-content" class="main-content" role="main">
<!--PAGE TITLE-->
<div class="relative">
  <section class="pageTitle is-small" style="background-color: <?= $title_background_color ;?>; ">
    <div class="container">
      <div class="columns">
        <div class="column is-12" style="text-align: <?= $title_content_aligment ;?>;">
          <?php
          if ( is_404() || is_category() || is_tag() || is_day() || is_month() ||

            is_year() || is_search() || is_paged() || is_author() ) {

            ?>
          <?php /* If this is a category archive */ if (is_category()) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">
            <!-- Archive for the ‘ -->
            <?php single_cat_title(); ?>
            <!--’ Category -->
          </h1>
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Posts Tagged with <?php single_tag_title(); ?></h1>
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Archive for <?php the_time('F jS, Y'); ?></h1>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Archive for <?php the_time('F, Y'); ?></h1>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Archive for <?php the_time('Y'); ?></h1>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">All Posts by <?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></h1><?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?></h1>
          <h1 style="font-size: <?= $title_text_size ;?>rem; font-weight: <?= $title_text_weight ;?>; text-transform: <?= $title_text_transform ;?>; color: <?php if($title_color_custom) { echo  $title_color_custom;  }  else {  echo $title_color; } ?> ;">Blog Archives</h1>
          <?php } ?>
          <?php }?>
        </div>
      </div>
    </div>
  </section>
</div>
<!--END page title-->


<div class="container is-small">
  <div class="columns is-multiline">

    <!--post feed-->
    <div id="postFeed" class="column is-9">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="columns">
					<?php
					$thumbnail_id  = get_post_thumbnail_id( $post->ID );
				  $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					?>

					<?php if(has_post_thumbnail()) { ?>
						<div class="column is-2">
							<img src="<?php echo the_post_thumbnail_url() ?>" alt="<?php echo $thumbnail_alt ?>" loading="lazy"/>
						</div>
					<?php } ?>

					<div class="column <?php if(has_post_thumbnail()) {?> is-10 <?php } else { ?> is-12 <?php } ?>">
						<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<?php the_excerpt(); ?>
							<p><a href="<?php the_permalink(); ?>" class="visually-hidden">Read <?php the_title(); ?></a></p>
						</div>
					</div>

			</div>

      <?php endwhile; ?>

        <div class="navigation">
          <div class="next-posts"><?php next_posts_link(); ?></div>
          <div class="prev-posts"><?php previous_posts_link(); ?></div>
        </div>

      <?php else : ?>

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <h1>Not Found</h1>
        </div>

      <?php endif; ?>

    </div>

    <!--blog sidebar-->
		<aside class="column is-3">
			<div class="blogSidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("sidebar-main") ) : ?>
        <?php endif;?>
			</div>
		</aside>

  </div>
</div>
</div>
  </main>

<?php
get_footer();
