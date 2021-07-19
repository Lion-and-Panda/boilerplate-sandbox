<?php
    $headline = get_field('headline');
    $wysiwyg = get_field('textarea');
    $type = get_field('type');
    $tag = get_field('tag');
    $resourceCategory = get_field('resource_category');
    $postsPerPage = get_field('posts_per_page');

    if($type){
        $typeID = array();
        foreach($type as $single){
            array_push($typeID , $single->term_id);
        }
    }

    if($tag){
        $tagID = array();
        foreach($tag as $single){
            array_push($tagID , $single->term_id);
        }
    }

    if($resourceCategory){
        $resourceCategoryID = array();
        foreach($resourceCategory as $single){
            array_push($resourceCategoryID , $single->term_id);
        }
    }

    $taxQuery = array(
        'relation' => 'AND',
    );

    if($typeID){
        $typeQuery = array(
          'taxonomy' => 'type_group',
          'field' => 'id',
          'terms' => $typeID,
        );
        array_push($taxQuery,$typeQuery);
    }

    if($tagID){
        $tagQuery = array(
          'taxonomy' => 'post_tag',
          'field' => 'id',
          'terms' => $tagID,
        );
        array_push($taxQuery,$tagQuery);
    }

    if($resourceCategoryID){
        $resourceQuery = array(
          'taxonomy' => 'resource_category',
          'field' => 'id',
          'terms' => $resourceCategoryID,
        );
        array_push($taxQuery,$resourceQuery);
    }

    $query = array(
        'post_type' => 'resource',
        'tax_query' => $taxQuery,
    );

    if($postsPerPage){
        // array_push($query, array('posts_per_page' => $postsPerPage));
        $query['posts_per_page'] = $postsPerPage;
    }

    $posts = get_posts($query);

?>

<!--defer magnific.js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js" integrity="sha512-+m6t3R87+6LdtYiCzRhC5+E0l4VQ9qIT1H9+t1wmHkMJvvUQNI5MKKb7b08WL4Kgp9K0IBgHDSLCRJk05cFUYg==" crossorigin="anonymous"></script>

<section>
  <div class="container is-medium simple-resource">
    <h2 class="headingLarge"><?=$headline?></h2>
    <div><?=$wysiwyg?></div>

    <div class="columns is-multiline">
      <?php
      foreach($posts as $post){ ?>

        <!--a single resource block markup-->
        <div class="column is-4">
          <div class="single-resource">

            <div class="blog-feature">
              <?=get_the_post_thumbnail($post->ID);?>
            </div>

            <h4><?=$post->post_title?></h4>
            <p><?= get_post_field('post_excerpt', $post->ID) ?></p>

            <div class="post-footer">
              <?php
                if(get_field('video_link',$post->ID)){
                    $vidlink = get_field('video_link',$post->ID);
                    ?>
                    <div class="buttonHolder">
                      <a class="button popup-video" href="<?= $vidlink; ?>" title="play video" aria-label="Watch <?php the_title(); ?>" aria-haspopup="true">Watch Video</a>
                    </div>

                    <?php } else if (get_field('file',$post->ID)){
                      $downloadLink = get_field('file',$post->ID);
                    ?>
                    <div class="buttonHolder">
                      <a class="button" href="<?=$downloadLink['url']?>" target="_blank">Download</a>
                    </div>

                    <?php } else if (get_field('link',$post->ID)){
                    $theLink = get_field('link',$post->ID);
                    ?>
                    <div class="buttonHolder">
                      <a class="button" href="<?=$theLink['url']?>"  target="<?=$theLink['target']?>">Go to Link</a>
                    </div>

                  <?php } else {
                    $pageURL = get_permalink($post->ID);
                  ?>
                  <div class="buttonHolder">
                    <a class="button" href="<?=$pageURL?>">Go To Document</a>
                  </div>

                    <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>

          <script>
          //magnific
          function extendMagnificIframe(){

             var $start = 0;
             var $iframe = {
                 markup: '<div class="mfp-iframe-scaler">' +
                         '<div class="mfp-close"></div>' +
                         '<iframe class="mfp-iframe" frameborder="0" aria-label="video popup" allowfullscreen></iframe>' +
                         '</div>' +
                         '<div class="mfp-bottom-bar">' +
                         '<div class="mfp-title"></div>' +
                         '</div>',
                 patterns: {
                     youtube: {
                         index: 'youtu',
                         id: function(url) {

                             var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
                             if ( !m || !m[1] ) return null;

                                 if(url.indexOf('t=') != - 1){

                                     var $split = url.split('t=');
                                     var hms = $split[1].replace('h',':').replace('m',':').replace('s','');
                                     var a = hms.split(':');

                                     if (a.length == 1){

                                         $start = a[0];

                                     } else if (a.length == 2){

                                         $start = (+a[0]) * 60 + (+a[1]);

                                     } else if (a.length == 3){

                                         $start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                                     }
                                 }

                                 var suffix = '?autoplay=1';

                                 if( $start > 0 ){

                                     suffix = '?start=' + $start + '&autoplay=1';
                                 }

                             return m[1] + suffix;
                         },
                         src: '//www.youtube.com/embed/%id%'
                     },
                     vimeo: {
                         index: 'vimeo.com/',
                         id: function(url) {
                             var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                             if ( !m || !m[5] ) return null;
                             return m[5];
                         },
                         src: '//player.vimeo.com/video/%id%?autoplay=1'
                     }
                 }
             };

             return $iframe;

          }

          $('.popup-video').magnificPopup({
             type: 'iframe',
             iframe: extendMagnificIframe()
          });

           </script>
    </div>
  </div>
</section>
