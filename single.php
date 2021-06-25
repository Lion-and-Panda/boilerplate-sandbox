<?php
/* ------------------------------------------------------------------------- *
Single post page
/* ------------------------------------------------------------------------- */
?>
<?php get_header(); ?>

<?php
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	?>

  <main id="wrapper"><!-- main -->
			<div id="page-content" class="main-content">
				<article itemscope itemtype ="http://schema.org/Article">

					<!--Title-->
					<div class="postHeader" style="background-image: url('<?php echo $thumb['0'];?>')">
						<div class="container">
							<div class="columns">
								<div class="column">
									<div class="postTitle">
		              	<h1 itemprop="name"><?php the_title(); ?></h1>
									</div>
								</div>
							</div>
						</div>
					<div class="overlay"></div>
				</div>

					<!--post content-->
		      <div class="container section is-small postContent">
		          <div class="columns">
		              <div itemprop="articleBody" class="column is-9">
		                  <?php the_content();?>
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

		</article>
	</div>
</main>

<?php


get_footer();
