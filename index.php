<?php
/* ------------------------------------------------------------------------- *
 *  index
/* ------------------------------------------------------------------------- */
?>
<?php get_header(); ?>
<main id="wrapper"><!-- main -->
	<div id="postFeed" class="main-content" role="main">

		<!-- Blog Post Feed -->
		<div class="section postFeed">
			<div class="container">
				<div class="columns">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<?php the_content(); ?>
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

			</div>


		</div>
	</div>
</main><!-- main -->
<?php get_footer(); ?>
