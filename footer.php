<?php
/* ------------------------------------------------------------------------- *
Footer
/* ------------------------------------------------------------------------ */

//SYTLE
$footer_logo = get_field( 'footer_logo', 'option' );
$footer_logo_size = get_field( 'footer_logo_size', 'option' );
$footer_bg = get_field( 'footer_bg', 'option' );

//CONTACT INFO STYLE
$email_size = get_field( 'email_size_footer', 'option' );
$email_weight = get_field( 'email_weight_footer', 'option' );
$email_color = get_field( 'email_color_footer', 'option' );
$address_size = get_field( 'address_size_footer', 'option' );
$address_weight = get_field( 'address_weight_footer', 'option' );
$address_color = get_field( 'address_color_footer', 'option' );
$phone_num_size = get_field( 'phone_size_footer', 'option' );
$phone_num_weight = get_field( 'phone_weight_footer', 'option' );
$phone_num_color = get_field( 'phone_color_footer', 'option' );

//SHOW HIDE OPITONS
$show_email = get_field( 'show_email_footer', 'option' );
$show_socialicons = get_field( 'show_social_icons_footer', 'option' );
$show_address = get_field( 'show_address_footer', 'option' );
$show_phone = get_field( 'show_phone_footer', 'option' );

//CONTACT INFO
$email = get_field( 'email_address', 'option' );
$address = get_field( 'address', 'option' );
$phone_num = get_field( 'phone_num', 'option' );

?>

<!--FOOTER-->
<footer class="is-small" style="background-color: <?= $footer_bg ;?>;">
  <div class="container">
    <div class="columns is-multiline">

      <!--logo-->
      <div class="column is-3">
        <div class="footerLogo">
          <a class="logo" href="/" title="go to homepage">
           <img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>" style="width: <?= $footer_logo_size ;?>;" loading="lazy" />
         </a>
        </div>
      </div>

      <!--footer menu-->
      <div class="column is-3">
        <nav class="footerMenu" aria-label="Footer Menu">
          <?php wp_nav_menu( array('theme_location' => 'footer_menu', 'depth' => 1, 'container' => false )); ?>
        </nav>
      </div>

        <!--contact info-->
      <div class="column is-3 contactInfo">

          <!--email-->
          <?php if($show_email) { ?>
          <div class="email" style="font-size: <?= $email_size ;?>rem; font-weight:<?= $email_weight ;?>;">
            <a href="mailto:<?= $email ?>" style="color: <?= $email_color ;?>; "><?= $email ?></a>
          </div>
          <?php } ?>

          <!--phone number-->
          <?php if($show_phone) { ?>
            <div class="phoneNum" style="font-size: <?= $phone_num_size ;?>rem; font-weight:<?= $phone_num_weight ;?>;">
              <a href="tel:<?= $phone_num ?>" style="color: <?= $phone_num_color ;?>;"><?= $phone_num ?></a>
            </div>
          <?php } ?>

          <!--address-->
          <?php if($show_address) { ?>
          <div class="address" style="font-size: <?= $address_size ;?>rem; font-weight:<?= $address_weight ;?>; color: <?= $address_color ;?>; ">
            <?= $address ?>
           </div>
          <?php } ?>

      </div>

    		<!--socal icons-->
        <?php if($show_socialicons) { ?>
    			<div class="column is-3">
    				<div class="footerSocial">
    					<?php include('includes/socialconsFooter.php'); ?>
    				</div>
    			</div>
          <?php } ?>

          <div class="column is-12">
            <div id="copyright">
              <p class="text-centered small-paragraph">Copyright© <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?></p>
            </div>
          </div>

    </div>
  </div>

  <!--footer scripts-->
  <?php
  $scripts_footer = get_field( 'scripts_footer', 'option' );
   ?>

   <?php if ( $scripts_footer ) { ?>
     <?= $scripts_footer ?>
   <?php } ?>

</footer>

<!--cookie policy banner-->
<?php
$show_cookie_policy = get_field('show_cookie_policy_banner', 'option');
$cookie_policy_link = get_field('cookie_policy_link', 'option');
if ($cookie_policy_link) {
  $cookie_policy_link_target = $cookie_policy_link[ 'target' ] ? $cookie_policy_link[ 'target' ] : '_self';
}
?>

<?php if($show_cookie_policy) { ?>
  <div class="cookie-banner" style="display: none">
  <div class="columns is-multiline is-vcentered">
    <div class="column is-12-mobile is-9-desktop">
      <p>We use cookies on this site to enhance your user experience. For more information about how we use cookies please read our <a href="<?= $cookie_policy_link['url']; ?>" target="<?= esc_attr($cookie_policy_link_target); ?>">cookie policy</a>.</p>
    </div>
    <div class="column is-12-mobile is-3-desktop">
        <a class="button close">I understand</a>
    </div>
  </div>
</div>

<script>
if(localStorage.getItem('cookieSeen') != 'shown'){
    $(".cookie-banner").delay(2000).fadeIn();
    localStorage.setItem('cookieSeen','shown')
}

$('.close').click(function(e) {
  $('.cookie-banner').fadeOut();
});
</script>

<?php } ?>


<?php wp_footer(); ?>

<!--defer wow.js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<!--defer slick slider.js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<!--defer fontawesom.js-->
<script type="text/javascript" src="https://kit.fontawesome.com/ff7131ed3b.js"></script>

<!--defer animate.css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />

<script>
  // iniciate wow so animations only happen on page reveal
  new WOW().init();
</script>

</body></html>
