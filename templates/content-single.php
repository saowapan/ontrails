<?php while (have_posts()) : the_post(); ?>
    <?php 
    //    error_reporting(E_ALL);
    //    ini_set("display_errors", 1);
    ?>
    <?php $bg_img = get_field('background_headder'); ?>
    <section class="header-single-post" style="background-image:url(<?=$bg_img?>);background-color: #222;">
        <?php if ($bg_img) { 
            echo '<img class="img-fluid" src="'.$bg_img.'" />';
        }else{ ?>
            <img class="img-fluid" src="<?=build_url('/assets/images/default-bg-post.jpg');?>" style="width: 100%;"/>
        <?php } ?>  
        <div class="overlay"></div> 
    </section>
    <article <?php post_class(); ?>>
        <section class="single-post-content">
            <div class="container">
                <div class="row justify-content-center post-content">
                    <?php 
                        $categories = get_the_category($post->ID);
                        $cate_name  = $categories[0]->name; 
                        $cate_slug  = $categories[0]->slug; 
                        $post_id    = get_the_ID(); 
                        $tags       = get_the_tags();
                        if ($tags) {
                            $tag_id   = $tags[0]->term_id; 
                        }else{
                            $tag_id = '';
                        }   

                        $args_cate  = array(
                            'post_type'       => 'post', 
                            'posts_per_page'  => -1,  
                            'post_status'     => 'publish',
                            'post__not_in'    => array($post_id),
                            'tax_query'       => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'slug',
                                    'terms'    => $cate_slug,
                                ),
                            ),
                        );
                        $loop_cate    = new WP_Query($args_cate); 
                        $count_cate   = $loop_cate ->post_count;
                    ?>
                    <p class="post-info"><strong><?=$cate_name?></strong> / <?= get_the_date('d M Y'); ?>  /  0 COMMENTS</p>
                    <h1 class="big-title-content"><?=the_title()?></h1>
                    <?php 
                        $audio = get_field('audio');
                        $video = get_field('video'); 
                        if ($audio) { ?>
                            <p>
                                <span class="show-audio post-audio">
                                    <audio controls  preload='none'>
                                        <source src="<?php echo $audio; ?>" type="audio/mpeg">Your browser does not support the audio element.
                                    </audio> 
                                </span> 
                            </p>
                        <?php }if($video){ ?>
                            <figure class="post-image image-default post-video wp-caption alignnone text-center">
                                    <a id="vidwrap">
                                        <span class="video-play" style="background-image: url(<?= build_url('/assets/images/play-rounded-button.png')?>);"></span>
                                        <?=the_post_thumbnail(  'full', array( 'style' => 'max-width: 640px;' ) );?>
                                    </a>
                            </figure>
                            <script type="text/javascript">
                                jQuery('#vidwrap').click(function(){
                                    document.getElementById('vidwrap').innerHTML = '<iframe width="640px" height="340px" src="<?php echo $video;?>?autoplay=1" style="max-width: 100%;"></iframe>';
                                });
                            </script>
                        <?php }
                    ?>
                    <?php the_content(); ?>
                </div>
                <?php 
                 if ($count_cate != 0) { ?>
                    <div class="row next-previous-post">
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-start previous">
                            <small class="small-text">PREVIOUS STORY</small>
                            <?php previous_post_link( '%link', '<img src="'.get_bloginfo('template_url') . '/assets/images/left-arrow.png"><span>%title</span>', TRUE,''.$cate_slug.'' ); ?>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-end next">
                            <small class="small-text">NEXT STORY</small>
                            <?php next_post_link( '%link', '<span>%title</span><img src="'.get_bloginfo('template_url') . '/assets/images/right-arrow.png">', TRUE,''.$cate_slug.'' );?>
                        </div>
                    </div>
                <?php } ?>
            <?php comments_template('/templates/comments.php'); ?>
            </div>
        </section>
        <?php 
            if ($tag_id) {
                $args  = array(
                    'post_type'       => 'post', 
                    'posts_per_page'  => -1,  
                    'post_status'     => 'publish',
                    'tag_id'          => $tag_id,
                    'post__not_in'    => array($post_id),
                );
                $loop   = new WP_Query($args); 
                $count  = $loop->post_count;
                if ($count>1) {?>
                    <section id="postShowMore" class="section-default related-stories">
                        <div class="posts-box-default">
                            <div class="container">
                                <div class="main-title"><hr><h3 class="medium-title">More Stories</h3></div>
                                <div class="col-12 text-center">
                                    <div id="loadPage" style="opacity: 0.5;">
                                        <img src="<?=build_url('/assets/images/loadpost.svg');?>">
                                    </div>
                                    <?php if ($count<=6) {
                                        $add_calss = 'nobtn';
                                    }else{
                                        $add_calss = '';
                                    } ?>
                                    <div class="row wrap-posts-box <?=$add_calss?>">
                                        <script type="text/javascript">
                                            jQuery( document ).ready(function() {
                                                var post_id_js   = <?php echo $post_id; ?>;
                                                var countallpost = <?php echo $count; ?>;
                                                var tag_js       = '<?php echo $tag_id; ?>';
                                                // function showpost => ../assets/scripts/loadPost.js
                                                //category, post id current , show post , count all post , tag id
                                                showpost('',post_id_js,6,countallpost,tag_js); 
                                                
                                                jQuery('#more_posts').click(function(){
                                                    // function more_post => ../assets/scripts/loadPost.js
                                                    //category, post id current ,  count all post , tag id
                                                    more_post('',post_id_js,countallpost,tag_js); 
                                                    
                                                    jQuery("#more_posts").addClass("btn-loadmore");
                                                    jQuery(".imgload").fadeIn(500);
                                                });
                                            });
                                        </script>
                                    </div>
                                    <?php  if ($count>6) {?>
                                        <button  id="more_posts" class="btn-shape btn-default " style="display: none;"><img class="imgload" src="<?=build_url('/assets/images/loadpost.svg');?>" style="width: 30px;display: none;">Load More</button>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>     
                    </section> 
                <?php } // end if count > 1 ?> 
        <?php }else{
                if ($count_cate>1) {?>
                    <section id="postShowMore" class="section-default related-stories">
                        <div class="posts-box-default">
                            <div class="container">
                                <div class="main-title"><hr><h3 class="medium-title">Related Stories</h3></div>
                                <div class="col-12 text-center">
                                    <div id="loadPage" style="opacity: 0.5;">
                                        <img src="<?=build_url('/assets/images/loadpost.svg');?>">
                                    </div>
                                    <?php  if ($count_cate<=6) {
                                        $add_calss = 'nobtn';
                                    }else{
                                        $add_calss = '';
                                    }?>
                                    <div class="row wrap-posts-box <?=$add_calss?>">
                                        <script type="text/javascript">
                                            jQuery( document ).ready(function() {
                                                var category_js  = '<?php echo $cate_slug; ?>';
                                                var post_id_js   = <?php echo $post_id; ?>;
                                                var countallpost = <?php echo $count_cate; ?>;
                                                //category, post id current , show post , count all post , tag
                                                showpost(category_js,post_id_js,6,countallpost,''); 
                                                
                                                jQuery('#more_posts').click(function(){
                                                    //category, post id current ,  count all post , tag
                                                    more_post(category_js,post_id_js,countallpost,''); 
                                                    
                                                    jQuery("#more_posts").addClass("btn-loadmore");
                                                    jQuery(".imgload").fadeIn(500);
                                                });
                                            });
                                        </script>
                                    </div>
                                    <?php  if ($count_cate>6) {?>
                                        <button  id="more_posts" class="btn-shape btn-default " style="display: none;"><img class="imgload" src="<?=build_url('/assets/images/loadpost.svg');?>" style="width: 30px;display: none;">Load More</button>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>     
                    </section> 
                <?php } // end if count > 1?> 
        <?php } // end else ?>
    </article> 
<?php endwhile; ?>
