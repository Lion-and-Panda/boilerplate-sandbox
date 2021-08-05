<div class="columns is-multiline" style="text-align: center">
<?php foreach($posts as $post){ ?>

  <!--a single resource block -->
  <div class="column is-4">
    <div class="single-resource">

      <!-- featured image -->
      <?php
      $thumbnail_id = get_post_thumbnail_id();
      $thumbnail_url= wp_get_attachment_image_src($thumbnail_id, 'small_thumb', true);
      $thumbnail_meta = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
      $hero = get_the_post_thumbnail($post->ID);
      $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

      // if post thumbnail exists
      if ( $hero ) { ?>
        <div class="blog-feature">
          <?= $hero ?>
        </div>

        <!-- add type icon to header image -->
        <div class="typeIcon">
          <?php
          if(get_field('video_link',$post->ID)){
            $vidlink = get_field('video_link',$post->ID);
          ?>
          <i class="fas fa-play"></i>

          <?php
            } else if (get_field('file',$post->ID)){
              ?>
              <i class="fas fa-download"></i>

          <?php
            } else if (get_field('link',$post->ID)){
          ?>
          <i class="fas fa-link"></i>

          <?php
            } else {
          ?>
          <i class="fas fa-file"></i>

          <?php } ?>
          </div>

      <?php }

      // if no thumbnail exists show type icon
     else { ?>
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
        <?php } else if(get_field('video_link',$post->ID)){ ?>
          <div class="blog-feature no-image">
            <div class="typeIcon">
            <i class="fas fa-play"></i>
          </div>
        </div>
        <?php } else { ?>
          <div class="blog-feature no-image">
            <div class="typeIcon">
              <i class="fas fa-file"></i>
            </div>
          </div>
        <?php } ?>
    <?php } ?>

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
    </div>
    <?php } ?>
</div>
