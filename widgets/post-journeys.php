<?php 
	$args  = array(
	    'post_type'       => 'journey', 
	    'posts_per_page'  => -1,  
	    'post_status'     => 'publish',
	); 
	$loop   = new WP_Query($args); 

?>
<?php while( $loop->have_posts() ): $loop->the_post();
	$content = get_the_excerpt();
	if(strlen($content ) > 85) { 
		$content  = substr($content , 0, 85). '...'; 
	} 
	$live_button = get_field('live_button'); 
	$images = get_field('gallery'); 
?>
<div class="wrap-slider">
	<a href="<?=get_permalink()?>" >
		<?=the_post_thumbnail( 'medium_large', ['class' => 'img-fluid'] )?>
		<?php  if(!empty($live_button) ){
 			echo '<div class="live-journey">LIVE</div>';
		}?>
		<div class="content-slider d-flex justify-content-center align-items-end">
			<div class="slider-item item-default">
				<hr>
				<p class="time-cate small-text"><strong>journeys</strong></p>
				<h4 class="post-title"><?= get_the_title() ?></h4>
				<p class="post-content"><?=$content?></p>
			</div>
		</div>
		<?php 
			if( $images ){
				echo '<div class="slider-hover-box"><div class="slider-hover round-image">';
				foreach( $images as $image ){ ?>
				    <div><img class="img-fluid wp-post-image" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
				<?php }
				echo '</div></div>'; 
			}
		?>
	</a>
</div> 
<?php   endwhile; ?>