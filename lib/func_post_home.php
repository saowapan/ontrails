<?php 
	//error_reporting(E_ALL);
    //ini_set("display_errors", 1);
	function post_home($category){
		$args  = array(
	        'post_type'       => 'post', 
	        'posts_per_page'  => 4,  
	        'post_status'     => 'publish',
	        'tax_query'       => array(
	            array(
	                'taxonomy' => 'category',
	                'field'    => 'slug',
	                'terms'    => $category,
	            ),
	        ),
	    );
	    $loop   = new WP_Query($args); 
	    $count  = $loop->post_count; 
	    $count_add_calss  = 0; 

 		if ($count > 0) { ?>
			<section class="section-default posts-home-default">
				<div class="container">
				<?php if ($category == 'stories') { ?>
				    <div class="main-title"><hr><h3 class="medium-title">Travel Stories</h3></div>
				<?php }elseif ($category == 'learn') { ?>
				    <div class="main-title"><hr><h3 class="medium-title">Learn</h3></div>
				<?php }?>
					<div class="col-12 text-center">
	        			<div class="row wrap-posts-box">
							<?php while( $loop->have_posts() ): $loop->the_post(); 

								$count_add_calss = $count_add_calss + 1;
								if ($count == 3 && $count_add_calss == 3 ) {
						            $add_calss = 'end two_column';
						        }elseif($count_add_calss == 3 ){
						            $add_calss = 'end';
						        }else{
						        	$add_calss = '';
						        }

							    $content = get_the_excerpt();
							    if(strlen($content ) > 85) { 
							        $content  = substr($content , 0, 85). '...'; 
							    }?>
								    <div class="col-lg-4 col-sm-6 wrap-post wrap-post-flex <?=$add_calss?>">
								        <div class="post-image image-default">
								            <a href="<?=get_permalink()?>">
								                <?=the_post_thumbnail( 'medium_large' );?>
								                <span class="post-image-overlay"></span>
								            </a>
								        </div>  
								        <div class="post-item item-default item-default-flex">
								            <hr>
								            <p class="time-cate small-text"><strong><?= $category ?></strong> / <?= get_the_date('d M Y') ?></p>
								            <h4 class="post-title"><a href="<?=get_permalink()?>"><?= get_the_title() ?></a></h4>
								            <p class="post-content"><?= $content ?></p>
								        </div>  
								    </div>
							<?php  endwhile; ?>
						</div>
						<?php if ($category == 'stories') { ?>
						    <a href="<?= esc_url(home_url('/stories')); ?>" class="btn-shape btn-default">More Stories</a>
						<?php }elseif ($category == 'learn') { ?>
						    <a href="<?= esc_url(home_url('/learns')); ?>" class="btn-shape btn-default">More Articles</a>
						<?php }?>
					</div>	
				</div>
			</section>
		<?php } // count 
	} // function
?>