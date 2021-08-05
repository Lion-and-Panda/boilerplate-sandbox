<?php
/* ------------------------------------------------------------------------- *
 * mobile menu
/* ------------------------------------------------------------------------- */

$email = get_field( 'email_address', 'option' );
$phone_num = get_field( 'phone_num', 'option' );

?>
<div id="lpbp-lateral-nav" aria-hidden="true" >
	<!-- menu -->
	<div class="closing-time clearfix text-right">
		<a id="lpbp-menu-trigger-close" href="#0" class="is-clicked closing-tim">
			<i class="fas fa-times"></i>
		</a>
	</div>

  <!--search bar-->
  <div class="mobileSearch">
    <form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" id="search2" class="search-field" placeholder="&#xf002;" value="<?php echo get_search_query(); ?>" name="s" />
    </form>
  </div>

  <!--menu links-->
	<nav id="mobileMenu" aria-label="mobile navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'lpbp-navigation', 'menu_id' => 'main-nav') ); ?>
	</nav>

	<hr>

<?php if($show_socialicons) { ?>
	<div class="socialcons">
		<h4 class="bold">Social</h4>
		<?php include('socialconsHeader.php'); ?>
	</div>
  <?php } ?>

	<hr>

	<h4 class="bold">Contact</h4>

	<div class="email">
		<a href="mailto:<?= $email ?>"><?= $email ?></a>
	</div>

    <div class="phoneNum" style="font-size: <?= $phone_num_size ;?>rem; font-weight:<?= $phone_num_weight ;?>; ">
      <a href="tel:<?= $phone_num ?>" style="color: <?= $phone_num_color ;?>;"><?= $phone_num ?></a>
    </div>

		<!--meta links-->
		<?php wp_nav_menu( array( 'theme_location' => 'meta', 'menu_class' => 'meta-meta', 'menu_id' => 'meta-nav') ); ?>

</div>
