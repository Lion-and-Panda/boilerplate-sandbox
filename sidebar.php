<?php
/* ------------------------------------------------------------------------- *
 *  Sidebar
/* ------------------------------------------------------------------------- */
?>
<div id="secondary">
	<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-main' ); ?>
		</div>
	<?php endif; ?>
</div>
