<?php
/* ------------------------------------------------------------------------- *
404
/* ------------------------------------------------------------------------- */
?>
<?php
get_header();
?>
<main id="wrapper"><!-- main -->
<div id="main-content" class="main-content" role="main">
	<section>
			<div class="section" style="text-align: center;">
				<div class="container paged">
					<div class="columns">
						<div class="column is-12">
							<h1>Uh Oh... Nothing was found here.</h1>
						<div class="page-content">
							<p><?php _e( 'Maybe try a search?' ); ?></p>
							<?php get_search_form(); ?>
						</div>
						</div>
					</div>
				</div>

			</div>
	</section>
</div>
</main><!-- end #main -->
<?php get_footer(); ?>
