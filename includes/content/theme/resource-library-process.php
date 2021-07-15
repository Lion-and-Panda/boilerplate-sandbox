<?php
/* ------------------------------------------------------------------------- *
 * 	Butler
 *  Resource Library Process		Version		 1.0.0
/* ------------------------------------------------------------------------- */
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    /**********************
    ****** GET ARGS *******
    **********************/

    $resource_categories    = isset($_POST['resource_categories'])? $_POST['resource_categories'] : false;
    $groups                 = isset($_POST['groups'])? $_POST['groups'] : false;
    $types                  = isset($_POST['types'])? $_POST['types'] : false;
    $tags                   = isset($_POST['tags'])? $_POST['tags'] : false;
    $tagSearchString        = isset($_POST['tagSearch'])? $_POST['tagSearch'] : false;
    $titleSearchString      = isset($_POST['titleSearch'])? $_POST['titleSearch'] : false;

    $args = [];
    $taxCount = 0; //track the number of taxonomy query values

    /********* LIBRARY TYPES *********/

    $itemTerms = [];

    if($resource_categories){
        //if user wants all categories, then simply don't apply this
        if($resource_categories[0] <> "all"){
            //loop through each term, and add it to the search
            if(count($resource_categories) > 1){
                $resourceSearch['relation'] = 'OR';
            }

            $i = 0;
            foreach($resource_categories as $item){
                $itemTerms['taxonomy'] = 'resource_category';
                $itemTerms['field'] = 'slug';
                $itemTerms['terms'] = $item;

                $resourceSearch[$i] = $itemTerms;
                $i++;
            }
            $taxCount++;
        }
    }

    /********* GROUPS *********/

    $itemTerms = [];

    if($groups){
        //loop through each term, and add it to the search
        if(count($groups) > 1){
            $groupSearch['relation'] = 'OR';
        }

        $i = 0;
        foreach($groups as $item){
            $itemTerms['taxonomy'] = 'product_group';
            $itemTerms['field'] = 'slug';
            $itemTerms['terms'] = $item;

            $groupSearch[$i] = $itemTerms;
            $i++;
        }
        $taxCount++;
    }

    /********* TYPES *********/

    $itemTerms = [];

    if($types){
        //loop through each term, and add it to the search
        if(count($types) > 1){
            $typeSearch['relation'] = 'OR';
        }

        $i = 0;
        foreach($types as $item){
            $itemTerms['taxonomy'] = 'type_group';
            $itemTerms['field'] = 'slug';
            $itemTerms['terms'] = $item;

            $typeSearch[$i] = $itemTerms;
            $i++;
        }
        $taxCount++;
    }

    /********* TAGS *********/

    $itemTerms = [];

    if($tags){
        //loop through each term, and add it to the search
        if(count($tags) > 1){
            $tagSearch['relation'] = 'OR';
        }

        $i = 0;
        foreach($tags as $item){
            $itemTerms['taxonomy'] = 'post_tag';
            $itemTerms['field'] = 'slug';
            $itemTerms['terms'] = $item;

            $tagSearch[$i] = $itemTerms;
            $i++;
        }
        $taxCount++;
    }

    /********* COMBINE FILTERS *********/

    if($taxCount > 1){
        $args['tax_query']['relation'] = 'AND';
        $i = 0;
        //only apply resources, if there is specific criteria to search for
        if(($resource_categories) && ($resource_categories[0] <> "all")){
            $args['tax_query'][$i] = $resourceSearch;
            $i++;
        }
        if($groups){
            $args['tax_query'][$i] = $groupSearch;
            $i++;
        }
        if($types){
            $args['tax_query'][$i] = $typeSearch;
            $i++;
        }
        if($tags){
            $args['tax_query'][$i] = $tagSearch;
            $i++;
        }

    } elseif(($resource_categories) && ($resource_categories[0] <> "all")){
        $args['tax_query'] = $resourceSearch;
    } elseif($groups){
        $args['tax_query'] = $groupSearch;
    } elseif($types){
        $args['tax_query'] = $typeSearch;
    } elseif($tags){
        $args['tax_query'] = $tagSearch;
    }

    //global query values
    if($titleSearchString){
		$args['s'] = $titleSearchString;
		// ga track search term.
    }

    $args['post_type'] = 'resource';
    $args['posts_per_page'] = -1;
    $args['orderby'] = 'date';
	$args['order'] = 'DESC';



    if($_POST['pullType'] == "results"){

        /***************************
        ****** SUBMIT FILTER *******
        ***************************/
        ?>
        <div class="columns is-multiline is-mobile" style="display: flex;">
        <?php
        $searchLoop = new WP_Query( $args );

        // echo "<pre>";
        // print_r($searchLoop);
        // echo "</pre>";
		$now = new DateTime();

        ?>

		<?php if($searchLoop->have_posts()){ ?>
			<?php while ( $searchLoop->have_posts() ) : $searchLoop->the_post();
				$start = null;
				$end = null;
				$start = get_field('start_date');
				$end = get_field('end_date');


				if(empty($start) || strtotime($start) > strtotime('now') ) {


				if(empty($end) || strtotime($end) < strtotime('now') ) {

					if(get_field('file')){
						$searchURL = get_field('file')['url']; ?>
					<div data-type="file" data-id="post-<?php the_ID(); ?>" <?php post_class('column is-4-desktop is-6-mobile feed'); ?> >
						<article onclick="window.open('<?= $searchURL; ?>'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">


					<?php } elseif(get_field('link')){
						$searchURL = get_field('link'); ?>
					<div  data-type="link" data-id="post-<?php the_ID(); ?>" <?php post_class('column is-4-desktop is-6-mobile feed'); ?> >
						<article onclick="window.open('<?= $searchURL['url']; ?>'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">

            <?php } elseif(get_field('email_text')){
              $searchURL = get_permalink(get_the_ID()); ?>
            <div  data-type="email" data-id="post-<?php the_ID(); ?>" <?php post_class('column is-4-desktop is-6-mobile feed'); ?> >
              <article onclick="link('<?= $searchURL; ?>'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">

					<?php } elseif(get_field('video_link')){
						$vid = get_field('video_link', false, false); ?>
					<div data-type="video" data-id="post-<?php the_ID(); ?>" <?php post_class('column is-4-desktop is-6-mobile feed '); ?> >
						<article class="popup-youtube" onclick="linkVideo('<?php echo $vid; ?>?rel=0&autoplay=1'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">

					<?php } else {
						$searchURL = get_permalink(get_the_ID()); ?>
					<div data-type="regular-default" data-id="post-<?php the_ID(); ?>" <?php post_class('column is-4-desktop is-6-mobile feed'); ?> >
						<article onclick="link('<?= $searchURL; ?>'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">

					<?php }

          ?>

						<?php
						$terms = get_the_terms(get_the_ID(), 'type_group');
						if($terms){
							$type = $terms[0]->name;
						} else {
							$type = "Info";
						}

						// $post_date = get_the_date( 'F n, Y' );

						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail_url= wp_get_attachment_image_src($thumbnail_id, 'small_thumb', true);
						$thumbnail_meta = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
						$hero = $thumbnail_url[0];
						if ( has_post_thumbnail() ) { ?>
							<div class="blog-feature">
								<img class="hundred" src="<?= $hero; ?>">
							</div>

							<div class="typeIcon">
								<?php
                            if(get_field('video_link',$post->ID)){
                                $vidlink = get_field('video_link',$post->ID);
                                ?>
                                    <a onclick="linkVideo('<?php echo $vidlink; ?>?rel=0&autoplay=1'); ga('<?php the_title(); ?>');"  style="cursor: pointer;"><i class="fas fa-play"></i></a>
                                <?php
                            }
                            else if (get_field('file',$post->ID)){

                                $downloadLink = get_field('file',$post->ID);
                                ?>
                                    <a href="<?=$downloadLink['url']?>"><i class="fas fa-download"></i></a>
                                <?php
                            }
                            else if (get_field('link',$post->ID)){
                                $theLink = get_field('link',$post->ID);
                                ?>
                                    <a href="<?=$theLink['url']?>"><i class="fas fa-link"></i></a>
                                <?php
                            }
                            else if (get_field('email_text',$post->ID)){
                                $emailLink = get_field('email_text',$post->ID);
                                ?>
                                    <a><i class="fas fa-envelope"></i></a>
                                <?php
                            }
                            ?>
							</div>

						<?php } else { ?>
							<?php if($type == 'Downloads' || $type == 'PDF' || $type == 'File') { ?>
                <div class="blog-feature no-image">
                 <div class="typeIcon">
									 <i class="fas fa-file-alt"></i>
								</div>
              </div>
							<?php } else if (get_field('link',$post->ID)){ ?>
                <div class="blog-feature no-image">
                 <div class="typeIcon">
									<i class="fas fa-link"></i>
								</div>
              </div>
							<?php }
              else if (get_field('email_text',$post->ID)){ ?>
                <div class="blog-feature no-image">
                 <div class="typeIcon">
									<i class="fas fa-envelope"></i>
								</div>
              </div>
							<?php }
               else if(get_field('video_link',$post->ID)){ ?>
                 <div class="blog-feature no-image">
                  <div class="typeIcon">
									<i class="fas fa-play">
								</div>
              </di>
							<?php }
               else { ?>
                   <div class="blog-feature no-image">
    								<div class="typeIcon">
    									<i class="fas fa-download"></i>
                    </div>
								</div>
							<?php } ?>
						<?php } ?>

						<div class="blog-feed">

							<section class="post-section">
								<div class="entry-content">
									<h3>	<?php the_title(); ?></h3>
									<?php the_excerpt(); ?>
								</div>
							</section>
						</div>

                            <div class="post-footer">
								<?php
                            if(get_field('video_link',$post->ID)){
                                $vidlink = get_field('video_link',$post->ID);
                                ?>
                                    <a onclick="linkVideo('<?php echo $vidlink; ?>?rel=0&autoplay=1'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">Watch Video</a>
                                <?php
                            }
                            else if (get_field('file',$post->ID)){

                                $downloadLink = get_field('file',$post->ID);
                                ?>
                                    <a>Download</a>
                                <?php
                            }
                            else if (get_field('link',$post->ID)){
                                $theLink = get_field('link',$post->ID);
                                ?>
                                    <a>Go To Link</a>
                                <?php
                            }
                            else if (get_field('email_text',$post->ID)){
                                $emailLink = get_field('email_text',$post->ID);
                                ?>
                                    <a>Get Email</a>
                                <?php
                            }
                            ?>
							</div>

					</article>
				</div><!-- data id --><!-- post class -->

			<?php

				 }

				}

			endwhile;
			wp_reset_query();
			wp_reset_postdata(); ?>
            <?php } else { ?>

				<div class="text-center">No Resources match your search criteria. Please try changing the filters.</div>

			<?php } ?>
        </div>
    <?php
    } else if($_POST['pullType'] == "updateTags"){

		/*************************
		****** UPDATE TAGS *******
		*************************/

		$newTags = getTags($args, $tagSearchString);
		$sliced_tags = array_slice($newTags,0,11);

		if($sliced_tags){
			foreach($sliced_tags as $tag){
				if($tag->count > 0){
					if($tags) {
						$checkedString = (array_search($tag->slug, $tags) > -1 ? 'checked="checked"' : '');
					} else {
						$checkedString = '';
					}
					?>
					<div class="item">
						<input class="filter with-font tagFilter" type="checkbox" name="tags[]" id="<?= $tag->slug; ?>" value="<?= $tag->slug; ?>" data-count="<?= $tag->count; ?>" <?= $checkedString; ?>>
						<label for="<?= $tag->slug; ?>"><?= truncate($tag->name); ?></label>
					</div>
				<?php }
			}
		} else { ?>
			<div class="item">No tags found; please try a different search.</div>
		<?php } ?>
		<!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js'></script> -->

		<script type="text/javascript">
				function link(link)
				{
					location.href = link;
				}
				function linkVideo(vid)
				{
                    console.log(vid);
					jQuery.magnificPopup.open({
						items: {
							src: vid,
						},
						disableOn: 700,
						type: 'iframe',
					});
				}
				function ga(title)
				{
                    // ga('send', 'event', 'Web Application', 'Resource', title)
                    gtag('event', 'Resources', {
                        'event_category': 'Resources',
                        'event_label': title,
                        'value': title
                    });

				}
		</script>
		<!-- <input id="tagSearch" class="right" type="search" placeholder="Search" value="<?php //echo $_POST['tagValue']; ?>"/> -->
    <?php
    } else if($_POST['pullType'] == "updateSidebar"){

		/****************************
		****** UPDATE SIDEBAR *******
		****************************/

		$newTags = getTags($args, $tagSearchString);


		$sliced_tags = array_slice($newTags,0,6);

		if($sliced_tags){
			foreach($sliced_tags as $tag){
				//if tag has count, and tag isn't already selected in the filter, THEN display in sidebar
				if($tags) {
					if ($tag->count > 0 && !(array_search($tag->slug, $tags) > -1)) { ?>
						<li class="sidebarFilter" id="<?= $tag->slug; ?>-sidebar" data-count="<?= $tag->count; ?>"><a><?= $tag->name; ?></a></li>
					<?php }
				} else { ?>
						<li class="sidebarFilter" id="<?= $tag->slug; ?>-sidebar" data-count="<?= $tag->count; ?>"<a><?= $tag->name; ?></a></li>
					<?php
				}
			}
		}
    }

    /***************************
    ***** DATABASE LOGGING *****
    ***************************/

    //only run when the search results are displayed, to avoid mis-counting the tag/sidebar updates
    // if($_POST['pullType'] == "results"){
    //     require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
    //     require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    //     global $wpdb;

    //     $pageName = "Resource Library";
    //     $values = '{"resource_categories": "'. ( $resource_categories ? implode(", ", $resource_categories) : "" ) .'", "groups": "'. ( $groups ? implode(", ", $groups) : "" ) .'", "types": "'.( $types ? implode(", ", $types) : "" ) .'", "tags": "'. ( $tags ? implode(", ", $tags) : "" ) .'", "titleSearch": "'. ( $titleSearchString ? $titleSearchString : "" ) .'", "tagSearch": "'. ( $tagSearchString ? $tagSearchString : "" ) .'"}';

    // }

//get the tags for the searched posts
function getTags( $args, $tagSearchString ) {
    $searchLoop = new WP_Query( $args );

    $searchTags = [];

    if($searchLoop->have_posts()){
        while ( $searchLoop->have_posts() ) : $searchLoop->the_post();
            $tags = wp_get_post_tags(get_the_ID());

            foreach ($tags as $tag){
                if(!isInMultiArray($searchTags, "term_id", $tag->term_id )){
                    if($tagSearchString){
                        //if user is searching for a specific tag name, filter by that
                        //echo "name: ".$tag->name." search: ".$tagSearchString." strpos: ".strpos($tag->name, $tagSearchString)."<br>";
                        if(is_numeric(strpos(strtolower($tag->name), strtolower($tagSearchString)))){
                            $searchTags[] = $tag;
                        }
                    } else {
                        $searchTags[] = $tag;
                    }
                }
            }

        endwhile; wp_reset_query(); wp_reset_postdata();
    } else { ?>
        <!--<div class="text-center">No tags match your search criteria.</div>-->
    <?php }

    return sort_posts( $searchTags, 'term_id', 'count', $order = 'DESC', $unique = true );
}


//function used for array validation
function isInMultiArray($array, $field, $position) {
    foreach($array as $index => $item) {
        if($item->$field == $position){
            return TRUE;
        }
    }
    return FALSE;
}

//used for sorting WP_post object arrays
function sort_posts( $posts, $IDfield, $orderby, $order = 'ASC', $unique = true ) {
	if ( ! is_array( $posts ) ) {
		return false;
	}

	usort( $posts, array( new Sort_Posts( $orderby, $order ), 'sort' ) );

	// use post ids as the array keys
	if ( $unique && count( $posts ) ) {
		$posts = array_combine( wp_list_pluck( $posts, $IDfield ), $posts );
	}

	return $posts;
}

//used for sorting WP_post object arrays
class Sort_Posts {
	var $order, $orderby;

	function __construct( $orderby, $order ) {
		$this->orderby = $orderby;
		$this->order = ( 'desc' == strtolower( $order ) ) ? 'DESC' : 'ASC';
	}

	function sort( $a, $b ) {
		if ( $a->{$this->orderby} == $b->{$this->orderby} ) {
			return 0;
		}

		if ( $a->{$this->orderby} < $b->{$this->orderby} ) {
			return ( 'ASC' == $this->order ) ? -1 : 1;
		} else {
			return ( 'ASC' == $this->order ) ? 1 : -1;
		}
	}
}
?>
