<?php 
	//error_reporting(E_ALL);
    //ini_set("display_errors", 1);
?> 
<?php /* Template Name: Home Page */ ?>
<?php while (have_posts()) : the_post(); 
	$main_intro = get_field('main_introduction'); // header 
	$sub_intro  = get_field('sub_introduction'); // header
	$video_mp4  = get_field('video_mp4'); // Video (mp4)
	$video_webm = get_field('video_webm'); // Video (webm)
	$images_supported = get_field('supported_by'); // footer
?>
<section class="section-header-home" id="section-header-home">
	<?php if($video_mp4 || $video_webm){ ?>
		<div class="custom-header-media">
			<div class="overlay"></div>
			<video playsinline autoplay muted loop>
				<?php if($video_mp4){ ?>
					<source src="<?=$video_mp4?>" type="video/mp4">
				<?php }?>
				<?php if($video_webm){ ?>
					<source src="<?=$video_webm?>" type="video/webm">
				<?php }?>
			</video>
	<?php }else{ ?>
	 	<div class="custom-header-media image-media" style="background-image: url('<?=the_post_thumbnail_url()?>');">
			<div class="overlay"></div>
		</div>
	<?php }?>
	<div class="custom-header-content">
		<div class="container">
			<div class="d-fading-home">
				<div class="col-xl-6 col-lg-8 col-md-9">
					<div class="row" id="fading">
						<div class="fade">
							<div class="el">
								<p class="text-uppercase main-color">on trails</p>
							</div>
							<div class="el">
								<h2 class="white-color big-title"><?=$main_intro?></h2>
							</div>
							<div class="el">
								<p class="white-color p-body"><?=$sub_intro?></p>
							</div>
							<div class="el">
								<button class="btn-shape btn-main-color" data-fancybox="modal" data-src="#modal" href="javascript:;">Join Me</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</section>

<?php // Stories // ?>
<?php echo post_home('stories'); // function post_home => ../lib/func_post_home.php ?> 

<section class="section-default slider-home-default">
	<div class="container">
		<div class="main-title"><hr><h3 class="medium-title">Journeys</h3></div>
		<div class="col-12 text-center">
			<div class="row wrap-sliders-box">
				<div class="journeys-slider-home slider">
					<?php get_template_part('widgets/post', 'journeys'); ?>
				</div>
			</div>
			<a href="<?= esc_url(home_url('/journeys')); ?>" class="btn-shape btn-default">More Journeys</a>
		</div>
	</div>	
</section>

<?php // Learn // ?>
<?php echo post_home('learn'); // function post_home => ../lib/func_post_home.php ?>

<?php // Popup by fancybox ?>
<?php get_template_part('widgets/section', 'joinme'); ?>
<?php get_template_part('widgets/popup', 'joinme'); ?>

<?php // supported
	if( $images_supported ){ ?>
		<section class="section-supported">
			<div class="container">
				<p class="text-uppercase">supported by</p>
				<div class="row justify-content-center">
					<?php $count_img = count($images_supported);
						if ( $count_img <= 3 ) {
						$calss = 'col-lg-6 col-md-9 flex-sm-row'; 
					}elseif ($count_img == 4 ) {
						$calss = 'col-lg-9 col-md-9 flex-sm-row';
					}else{
						$calss = 'col-md-12 flex-md-row';
					} ?>
					<div class="<?=$calss?> flex-column d-flex align-items-center justify-content-center">
					<?php	foreach( $images_supported as $image ){ ?>
				    	<div class="d-flex align-items-center justify-content-center wrap-img">
				    		<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
				    	</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</section>
	<?php }
?>
<?php endwhile; ?>