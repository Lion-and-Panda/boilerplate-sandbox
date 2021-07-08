<?php
/* ------------------------------------------------------------------------- *
Header
/* ------------------------------------------------------------------------- */

//LOGO
$header_logo = get_field( 'header_logo', 'option' );
$header_logo_size = get_field( 'header_logo_size', 'option' );

//STYLE
$header_bg = get_field( 'header_bg', 'option' );

//SHOW HIDE OPTIONS'
$show_phone = get_field( 'show_phone', 'option' );
$show_search = get_field( 'show_search', 'option' );
$show_socialicons = get_field( 'show_social_icons', 'option' );

//CONTACT INFO
$phone_num = get_field( 'phone_num', 'option' );
$phone_num_size = get_field( 'phone_size', 'option' );
$phone_num_weight = get_field( 'phone_weight', 'option' );
$phone_num_color = get_field( 'phone_color', 'option' );

// Scripts
$scripts_head = get_field( 'scripts_head', 'option' );
$scripts_body = get_field( 'scripts_body', 'option' );

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); ?> | <?php wp_title(); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/images/favicon/favicon.ico" />

<!--

test23
                        ,,,         ,,,
                      ;"   ^;     ;'   ",
                      ;    s$$$$$$$s     ;
                      ,  ss$$$$$$$$$$s  ,'
                      ;s$$$$$$$$$$$$$$$
                      $$$$$$$$$$$$$$$$$$
                     $$$$$""$$$$$""$$$$$
                     $$$$   "$$$"  $$$$$
                     $$$$  .$$$$$.  $$$$
                      $$$$$$$$$$$$$$$$
                        "$$$$"*"$$$$"
                          "$$$.$$$"
      __    _                         ____                  __
     / /   (_)___  ____       __     / __ \____ _____  ____/ /___ _
    / /   / / __ \/ __ \   __/ /_   / /_/ / __ `/ __ \/ __  / __ `/
   / /___/ / /_/ / / / /  /_  __/  / ____/ /_/ / / / / /_/ / /_/ /
  /_____/_/\____/_/ /_/    /_/    /_/    \__,_/_/ /_/\__,_/\__,_/
  Get your custom website from the folks at lionandpanda.com. They're pretty awesome.
  -->

<?php wp_head(); ?>

<!--call in header scripts-->
<?php if ( $scripts_head ) { ?>
  <?= $scripts_head ?>
<?php } ?>

</head>

<body <?php body_class(); ?> >

  <!--call in body scripts-->
  <?php if ( $scripts_body ) { ?>
    <?= $scripts_body ?>
  <?php } ?>


  <!--skip to content for screen readers-->
  <a class="skip-link screen-reader-text" tabindex="0" href="#page-content"><?php esc_html_e( 'Skip to content' ); ?> > </a>

  <!--main header-->
  <header id="main" class="headerMain <?php if ( is_front_page() ) { ?>is-transparent-nav<?php } ?> zindex-5" style="background-color:<?= $header_bg ;?>;">
      <div class="container">
        <div class="columns is-vcentered">

  			  <!--logo-->
          <div class="column is-2-desktop is-12-mobile">
    			  <div class="navbar-brand">
              <?php if ( is_front_page() ) { ?>
                <a class="logo" href="/" aria-label="go to homepage">
      						<img src="<?php echo $header_logo['url']; ?>" style= "width:<?= $header_logo_size ;?>;" alt="<?php bloginfo('name'); ?> logo" loading="lazy" />
      					</a>
               <?php } else { ?>
                 <a class="logo" href="/" aria-label="go to homepage">
                   <img src="<?php echo $header_logo['url']; ?>" style= "width:<?= $header_logo_size ;?>;" alt="<?php bloginfo('name'); ?> logo" loading="lazy" />
                 </a>
      				<?php } ?>

      				<!--mobile hamburger menu icon-->
              <a id="lpbp-menu-trigger" class="navbar-burger burger" href="#" aria-haspopup="true" aria-expanded="false" aria-label="open Mobile navigation">
                <i class="fas fa-bars"></i>
              </a>

            </div>
    		  </div>

          <!--menu-->
          <div class="column is-6-desktop is-hidden-mobile">
              <nav id="mainNavbar" class="mainNav is-transparent" aria-label="main navigation">
                <div class="navbar-menu">
                      <?php wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'depth' => 3,
                        'menu' => 'primary',
                        'container' => '',
                        'menu_class' => '',
                        'items_wrap' => '%3$s',
                      'walker' => new Bulma_NavWalker(),
                      'fallback_cb' => 'Bulma_NavWalker::fallback'
                    )); ?>
                  </div>
                </nav>
          </div>

    			<!--search social media icons-->
          <div class="column is-4-desktop is-hidden-mobile menuIcons">

            <!--search-->
    			  <?php if($show_search) { ?>
    				  <div class="topSearch">
      					<form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <label for="search1" class="visually-hidden">Search</label>
      					  <input type="search" id="search1" class="search-field" placeholder="&#xf002;" value="<?php echo get_search_query(); ?>" aria-label="search the site" name="s" />
                  <input type="submit" id="searchsubmit" class="visually-hidden" value="Search" />
      					</form>
    				  </div>
    			  <?php } ?>

            <!--phone number-->
            <?php if($show_phone) { ?>
              <a href="tel:<?= $phone_num ?>">
                <div class="phoneNum" style="font-size: <?= $phone_num_size ;?>rem; font-weight:<?= $phone_num_weight ;?>; color: <?= $phone_num_color ;?>; ">
                    <?= $phone_num ?>
                </div>
              </a>
            <?php } ?>

  				  <!--social icons-->
  				  <?php if($show_socialicons) { ?>
  		        <div class="socialIcons">
                <?php include('includes/socialconsHeader.php'); ?>
              </div>
  				  <?php } ?>

    			</div>
  		</div>
	  </div>
  </header><!--end header-->

<!--call in moblie menu-->
<?php include('includes/mobilemenu.php'); ?>
