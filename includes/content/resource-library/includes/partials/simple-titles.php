<?php foreach($posts as $post){ ?>

  <!--a single resource block -->
  <div class="simple-titles">

    <!-- Post title -->
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
  <?php } ?>
