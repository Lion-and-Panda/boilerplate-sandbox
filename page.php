<?php
/* ------------------------------------------------------------------------- *
 *  page
/* ------------------------------------------------------------------------- */
?>
<?php get_header(); ?>

<main id="wrapper"><!-- main -->
	<div id="page-content" class="main-content">
			<?php wp_reset_query(); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
