<?php  
//Enqueue Ajax Scripts
function enqueue_infohub_ajax_scripts() {
    wp_register_script( 'infohub-ajax-js', get_bloginfo('template_url') . '/assets/scripts/loadPost.js', array( 'jquery' ), '', true );
    wp_localize_script( 'infohub-ajax-js', 'ajax_infohub_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'infohub-ajax-js' );
}
add_action('wp_enqueue_scripts', 'enqueue_infohub_ajax_scripts');

//Add Ajax Actions : Post Show
add_action('wp_ajax_show_post', 'ajax_show_post');
add_action('wp_ajax_nopriv_show_post', 'ajax_show_post');
function ajax_show_post()
{
    display_post();
}

//Add Ajax Actions : More Post Show
add_action('wp_ajax_more_showpost', 'ajax_more_showpost');
add_action('wp_ajax_nopriv_more_showpost', 'ajax_more_showpost');
function ajax_more_showpost()
{
    display_post();
}
function display_post(){
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
    $query_data     = $_POST;
    $tag_id  = (isset($query_data['tag']) ) ? $query_data['tag'] : '';
    $cate_term = (isset($query_data['cate']) ) ? $query_data['cate'] : '';
    $post_id   = (isset($query_data['post_id']) ) ? $query_data['post_id'] : '';
    $ppp    = (isset($query_data["ppp"])) ? $query_data["ppp"] : 6;
    $page   = (isset($query_data['pageNumber'])) ? $query_data['pageNumber'] : 0;
    $count_all_post = (isset($query_data['countall'])) ? $query_data['countall'] : '';

    header("Content-Type: text/html");
    wp_reset_query();

    if ($tag_id) {
       $args = array(
            'post_type'         => 'post', 
            'posts_per_page'    => $ppp, 
            'paged'             => $page, 
            'post_status'       => 'publish',
            'tag_id'            => $tag_id,
            'post__not_in'      => array($post_id) ,
        );
    }else{
        $args = array(
            'post_type'         => 'post', 
            'posts_per_page'    => $ppp, 
            'paged'             => $page, 
            'post_status'       => 'publish',
            'post__not_in'      => array($post_id) ,
            'tax_query'         => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $cate_term,
                ),
            ),
        );
    }
    $loop = new WP_Query($args);
    $count_add_calss  = 0; 
    if( $loop->have_posts() ):?>
    	<?php while( $loop->have_posts() ): $loop->the_post(); ?>
            <?php                 
                $count_add_calss = $count_add_calss + 1;
                $sum = (($page-1)*6)+$count_add_calss;
                if ($count_add_calss == 3 ||$count_add_calss == 6 ||$sum == $count_all_post) {
                    $add_calss = 'end';
                }else{
                    $add_calss = '';
                }
 
                $content = get_the_excerpt();
                if(strlen($content ) > 85) { 
                    $content  = substr($content , 0, 85). '...'; 
                } 
                $categories = get_the_category();
                $cate_name  = $categories[0]->name; 

                $audio = get_field('audio');
                $video = get_field('video'); 
            ?>
    		<div class="col-lg-4 col-sm-6 wrap-post wrap-post-flex <?=$add_calss?> fade-<?=$count_add_calss?>">
				<?php if ($audio) { ?>
                    <div class="post-audio">
                        <audio controls  preload='none'>
                            <source src="<?php echo $audio; ?>" type="audio/mpeg">Your browser does not support the audio element.
                        </audio> 
                            
                    </div>
                <?php }elseif($video){ 
                    $id_name_vdo = 'vidwrap_'.$count_add_calss.'';
                    ?>
                    <div class="post-image image-default post-video">
                        <a id="<?=$id_name_vdo?>">
                            <div class="video-play" style="background-image: url(<?= build_url('/assets/images/play-rounded-button.png')?>);"></div>
                            <?=the_post_thumbnail( 'medium' );?>
                        </a>
                    </div>
                    <script type="text/javascript">
                        jQuery('#<?php echo $id_name_vdo; ?>').click(function(){
                            document.getElementById('<?php echo $id_name_vdo; ?>').innerHTML = '<iframe width="100%" height="100%" src="<?php echo $video;?>?autoplay=1"></iframe>';
                        });
                    </script>
                <?php }else{ ?> 
                    <div class="post-image image-default">
    					<a href="<?=get_permalink()?>">
                            <?=the_post_thumbnail( 'medium' );?>
    					</a>
    				</div>	
                <?php } ?>
				<div class="post-item item-default item-default-flex">
					<hr>
					<p class="time-cate small-text"><strong><?= $cate_name ?></strong> / <?= get_the_date('d M Y') ?></p>
					<h4 class="post-title"><a href="<?=get_permalink()?>"><?= get_the_title() ?></a></h4>
					<p class="post-content"><?= $content ?></p>
				</div>	
			</div>

		<?php  endwhile; ?>
        <?php 
            if ($sum == $count_all_post) { 
               echo '<div id="no_more_post"></div>';
            }
        ?>
    <?php else: ?>	
    	<div id="no_more_post"></div>
    <?php endif;
    die();
}
?>