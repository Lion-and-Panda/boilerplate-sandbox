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
    
<section>
<div class="container is-medium simple-resource">
    <h1><?=$headline?></h1>
    <div><?=$wysiwyg?></div>


    <div class="columns is-multiline">
        
        <?php

            


            foreach($posts as $post){ ?>
                <div class="column is-4">
                    <div class="single-resource">

                        <div class="blog-feature">
                        <?=get_the_post_thumbnail($post->ID);?>
                            </div>
                        <?php $short = get_the_excerpt($post->ID);?> 
                        <h4><?=$post->post_title?></h4>
                        <p><?=$short?></p>


                        <div class="post-footer">
                        <?php
                            if(get_field('video_link',$post->ID)){
                                $vidlink = get_field('video_link',$post->ID);
                                ?>
                                    <a onclick="linkVideo('<?php echo $vidlink; ?>?rel=0&autoplay=1'); ga('<?php the_title(); ?>');"  style="cursor: pointer;">Video Link</a>
                                <?php
                            }
                            else if (get_field('file',$post->ID)){

                                $downloadLink = get_field('file',$post->ID);
                                ?>
                                    <a href="<?=$downloadLink['url']?>">Download Link</a>
                                <?php
                            }
                            else if (get_field('link',$post->ID)){
                                $theLink = get_field('link',$post->ID);
                                ?>
                                    <a href="<?=$theLink['url']?>"  target="_self">Link</a>
                                <?php
                            }
                            ?>
                            </div>
                        
                          
                


                    <?php
                        // print_r($post);
                        // echo "<br>";
                    ?>
                    </div>
                </div>
                <?php
            }
        ?>
        
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
				//function ga(title)
				//{	
                    // ga('send', 'event', 'Web Application', 'Resource', title)
                    //gtag('event', 'Resources', {
                        //'event_category': 'Resources',
                        //'event_label': title,
                        //'value': title
                 //   });

				//}
		</script>
    
    
    </div>
    
         <!--link to all resources-->
        <div class="columns align-center">
            <div class="column">
                <a class="button" href="/resources">All Resources</a>
                </div>
            </div>
    
    </div>
</section>