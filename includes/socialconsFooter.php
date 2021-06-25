<ul class="socIcons" aria-label="Social Media Links">

	<?php
	//get urls
		$facebook = get_field('facebook_url','option');
		$twitter = get_field('twitter_url','option');
		$pinterest = get_field('pinterest_url','option');
		$youtube = get_field('youtube_url','option');
		$vimeo = get_field('vimeo_url','option');
		$linkedin = get_field('linkedin_url','option');
		$flickr = get_field('flickr_url','option');
		$insta = get_field('instagram_url','option');

	//style
		$icon_size = get_field('socicon_size_footer', 'option');
		$icon_color = get_field('socicon_color_footer', 'option');
	?>

	<!--Facebook-->
	<?php if( $facebook ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $facebook; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-facebook-f" role="img" aria-label="Visit our Facebook account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Facebook--><?php } ?>

	<!--Twitter-->
	<?php if ( $twitter ) { ?>
	<li><a  target="_blank" rel="noopener" href="<?php echo $twitter; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-twitter" role="img" aria-label="Visit our Twitter account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Twitter--><?php } ?>

	<!--Instagram-->
	<?php if ( $insta ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $insta; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-instagram" role="img" aria-label="Visit our Instagram account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Instagram--><?php } ?>

	<!--Youtube-->
	<?php if ( $youtube ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $youtube; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-youtube" role="img" aria-label="Visit our YouTube account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Youtube--><?php } ?>

	<!--Pinterest-->
	<?php if ( $pinterest ) { ?>
	<li><a  target="_blank" rel="noopener" href="<?php echo $pinterest; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-pinterest" role="img" aria-label="Visit our Pinterest account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Pinterest--><?php } ?>

	<!--Linkedin-->
	<?php if ( $linkedin ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $linkedin; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-linkedin-in" role="img" aria-label="Visit our Linkedin account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Linkedin--><?php } ?>

	<!--Vimeo-->
	<?php if ( $vimeo ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $vimeo; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-vimeo" role="img" aria-label="Visit our Vimeo account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Vimeo--><?php } ?>

	<!--Flickr-->
	<?php if ( $flickr ) { ?>
	<li><a target="_blank" rel="noopener" href="<?php echo $flickr; ?>" style= "color:<?= $icon_color ;?>;"><i class="fab fa-flickr" role="img" aria-label="Visit our Fickr account" style="font-size:<?= $icon_size ;?>rem;"></i></a></li>
	<?php } else { ?><!--Missing Flickr--><?php } ?>

</ul>
