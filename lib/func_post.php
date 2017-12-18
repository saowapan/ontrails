<?php function call_post($category){
    // check post : for button "Load More"
    $args  = array(
        'post_type'       => 'post', 
        'posts_per_page'  => -1,  
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
    ?>
    <section id="postShowMore" class="section-default posts-box-default">
		<div class="container">
			<div class="col-12 text-center">
				<div id="loadPage">
	                <img src="<?=build_url('/assets/images/loadpost.svg');?>">
	            </div>
	            <div class="row wrap-posts-box">
					<script type="text/javascript">
	                    jQuery( document ).ready(function() {
	                        var countallpost = <?php echo $count; ?>;
	                        var cate_js = '<?php echo $category; ?>';
	                        // function showpost => ../assets/scripts/loadPost.js
	                        showpost(cate_js,'',6,countallpost); //showpost(category, post id current , show post , count all post) 

	                        jQuery('#more_posts').click(function(){
	                        	// function more_post => ../assets/scripts/loadPost.js
	                            more_post(cate_js,'',countallpost);  //more_post(category, post id current , count all post)
	                        });
	                    });
	                </script>
				</div>
				<?php  if ($count>6) { // show button if post have > 6 ?>
	                <button  id="more_posts" class="btn-shape btn-default"><img class="imgload" src="<?=build_url('/assets/images/loadpost.svg');?>">Load More</button>
	            <?php } ?> 
			</div>	
		</div>
	</section>
<?php }?>