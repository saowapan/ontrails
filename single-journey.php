<?php 
	//error_reporting(E_ALL);
    //ini_set("display_errors", 1);
	$title 	= get_the_title();
	$journey_title = get_field('custom_title');
	$id_tag = get_field('name_tag');
	$intro 	= get_field('introduction_header');
	$map 	= get_field('map_image');
	$start_date = get_field('start_date');
	$end_date 	= get_field('end_date');
	// count post
	$args  	= array(
	    'post_type'       => 'post', 
	    'posts_per_page'  => -1,  
	    'post_status'     => 'publish',
	    'tag_id'          => $id_tag,
	    'order'   => 'ASC',
	); 
	$loop   = new WP_Query($args); 
	$count  = $loop->post_count;	
	$count_add_calss  = 0; 
?>
<section class="section-header-journey">
	<div class="parallax" style="background-image: url(<?=$map?>);">
		<div class="header-journey-content">
			<div class="container">
				<div class="d-fading-home">
					<div class="row justify-content-center" id="fading">
						<div class="col-xl-6 col-lg-8 col-md-10 text-center">
							<div class="fade">
								<div class="el">
									<div class="white-title">
										<hr>
										<h3 class="big-title"><?=$title?></h3>
									</div>
								</div>
								<div class="el white-color">
									<?=$intro?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-detail-journey">
	<div class="container">
		<div class="detail-journey d-flex default-detail-box">
			<div class="box-detail post">
				<span class="small-text">POSTS</span>
				<p><?=$count?> posts</p>
			</div>
			<?php 
				$fields = get_field_objects();
				if( $fields ){
					foreach( $fields as $field_name => $field ){
						if ( ($field_name != 'gallery') && ($field_name != 'introduction_header')  && ($field_name != 'map_image') && ($field_name != 'end_date') && ($field_name != 'start_date') && ($field_name != 'name_tag') && ($field_name != 'custom_title') && ($field_name != 'articles_id') && ($field_name != 'live_button')){
		
							echo '<div class="box-detail '.$field_name.'">';
							echo '<span class="small-text">' . $field['label'] . '</span>';
							echo '<p>'.$field['value'].' '.$field['append'].'</p>';
							echo '</div>';	
						}
					}
				}
			?>
		</div>
	</div>
</section>
<section class="content-single-journey section-default">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="row align-items-center content-half">
					<div class="col-lg-6 left">
						<h2 class="col-lg-10 big-title-content"><?= $journey_title; ?></h2>
						<small class="small-text"><strong>JOURNEYS</strong> / <?= get_the_date('Y'); ?></small>
					</div>
					<div class="col-lg-6 right">
						<?=apply_filters('the_content', $post->post_content);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php  if ($count > 0) { ?>
<section class="show-articles-journey">
	<div class="container">
		<div class="start_date"><p class="small-text"><strong>START</strong> / <?=$start_date?></p></div>
		<div id="mySVG"></div>
		<div class="row-articles-journey">
			<div id="circle_o_1"><i class="fa fa-circle-o start_pont"></i></div>
			<div class="container-articles">
			<?php if( $loop->have_posts() ):?>
		    	<?php while( $loop->have_posts() ): $loop->the_post(); ?>
		    		<?php   
		    			$count_add_calss = $count_add_calss + 1;              
		                $content = get_the_excerpt();
		                if(strlen($content ) > 85) { 
		                    $content  = substr($content , 0, 85). '...'; 
		                } 
		                $categories = get_the_category();
		                $cate_name  = $categories[0]->name; 
		                $location = get_field('location');
		                $audio = get_field('audio');
		                $video = get_field('video');
		            ?>
		            <div class="row box-articles"> 
			    		<div class="col-sm-6 box-articles-half">
			    			<div class="col-md-11 box-articles-journey">
			    				<?php if ($audio) { ?>
			    					<div class="audio-articles-journey">
				    					<div class="bg-audio d-flex align-items-center justify-content-center">
					    					<audio controls class="" preload='none' >
		                                       	<source src="<?php echo $audio; ?>" type="audio/mpeg">Your browser does not support the audio element.
											</audio> 
										</div>
									</div>
								<?php }elseif($video){ 
									$id_name_vdo = 'vidwrap_'.$count_add_calss.''; ?>
									<div id="<?php echo $id_name_vdo; ?>" class="vidwrap" style="background-image: url(<?= build_url('/assets/images/play-rounded-button.png')?>),url(<?=the_post_thumbnail_url()?>);">
										<script type="text/javascript">
										    jQuery('#<?php echo $id_name_vdo; ?>').click(function(){
										        document.getElementById('<?php echo $id_name_vdo; ?>').innerHTML = '<iframe width="100%" height="100%" src="<?php echo $video;?>?autoplay=1" style="background-color:#212121;"></iframe>';
										        jQuery("#<?php echo $id_name_vdo; ?>").addClass("iframe-vdo");
										    });
										</script>
									</div>
			    				<?php }else{ ?>
			    					<div class="image-articles-journey">
										<a href="<?=get_permalink()?>"><?=the_post_thumbnail( 'medium' );?></a>
									</div>
			    				<?php } ?>
								<div class="item-default">
									<hr>
									<p class="time-cate small-text"><strong><?= $cate_name ?></strong> / <?= get_the_date('d M Y') ?></p>
									<h4 class="post-title"><a href="<?=get_permalink()?>"><?= get_the_title() ?></a></h4>
									<p class="post-content"><?= $content ?></p>
								</div>
							</div>		
						</div>
						<?php if($location){
							$cass_have_location = 'have_location';
						}else{
							$cass_have_location = 'not_have_location';
						}
						?>
						<div class="col-sm-6 item-default box-articles-location d-flex align-items-center <?=$cass_have_location; ?>">
							<i id="circle_location_<?= $count_add_calss;?>" class="fa fa-circle"></i>
							<p id="text_location_<?= $count_add_calss;?>" class="small-text"><?=$location?></p>
						</div>
					</div>
		    	<?php  endwhile; ?>	
		    <?php endif; ?>
		    </div>
		    <div id="circle_o_2"><i class="fa fa-circle-o end_pont"></i></div>
		</div>
		<div class="end_date"><p class="small-text"><strong>END</strong> / <?=$end_date?></p></div>
	</div>
</section>
<script type="text/javascript">

	jQuery( document ).ready(function() {
		/* SVG line shape */ 
		jQuery('#mySVG').replaceWith('<svg id="mySVG"><path fill="none" stroke="#feca2e" stroke-width="2" id="line_shape" d="M1 2 L1 '+window.innerHeight+'" />Sorry, your browser does not support inline SVG.</svg>');

		var line_shape = document.getElementById("line_shape"); 
		var length = line_shape.getTotalLength(); 

		line_shape.style.strokeDasharray  = length;  
		line_shape.style.strokeDashoffset = length;  

		window.addEventListener("scroll", myFunction); 

		function myFunction() {
			var WindowScrollTop = jQuery(this).scrollTop();
			var Window_height 	= jQuery(this).outerHeight(true);
			var scrollpercent = (document.body.scrollTop + document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight) ;
	  		var draw = (length * scrollpercent);
	  		line_shape.style.strokeDashoffset = (length - draw); 
	  		// Check color Circle
	  		var link_to_SVG_lineshape = length - (length - draw); 
	  		for (var j = 1; j <= 2; j++) {
	  			var Div_top = jQuery('#circle_o_'+j+'').offset().top; 
	  			if( (WindowScrollTop + 70) >= ((Div_top-link_to_SVG_lineshape)+ 70) ){
			       jQuery('#circle_o_'+j+' i').css('color' , '#feca2e');
			    }else{
			       jQuery('#circle_o_'+j+' i').css('color' , '#ececec');
			    }
	  		}
		    // Location
		    var count_js = <?=$count?>;
		    for (var i = 1; i <= count_js; i++) {
		    	var IDlocation = jQuery('#circle_location_'+i+'').offset().top;
		    	if ( (WindowScrollTop + 70 ) >= ((IDlocation-link_to_SVG_lineshape))+ 70 ){
			       jQuery('#circle_location_'+i+'').css('color' , '#feca2e');
			       jQuery('#text_location_'+i+'').css('color' , '#696969');
			    }else{
			       jQuery('#circle_location_'+i+'').css('color' , '#ececec');
			       jQuery('#text_location_'+i+'').css('color' , '#d7d7d7');
			    }
		    }
		}
	});
</script>
<?php  } ?>
<section class="section-default slider-home-default">
	<div class="container">
		<div class="main-title"><hr><h3 class="medium-title">More Journeys</h3></div>
		<div class="col-12 text-center">
			<div class="row wrap-sliders-box" style="padding-bottom: 0;">
				<div class="journeys-slider-home slider">
					<?php get_template_part('widgets/post', 'journeys'); ?>
				</div>
			</div>
		</div>
	</div>	
</section>