<?php /* Template Name: About Page */ ?>
<?php while (have_posts()) : the_post(); ?>
<section class="section-header-default">
	<?php $intro = get_field('introduction_header'); ?>
	<?php echo header_fading('d-fading','About' ,$intro); // function header_fading => ../lib/func_header_fadding.php ?>
</section>
<section class="section-about">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="row align-items-center content-half">
					<div class="col-lg-6 left">
						<h2 class="col-lg-10 big-title-content">Photographing the world without flying</h2>
					</div>
					<div class="col-lg-6 right">
						<?php echo apply_filters('the_content', $post->post_content); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="contact"></div>
</section>
<section class="section-default section-contact">
	<div class="container">
		<div class="main-title"><hr><h3 class="medium-title">Get in touch</h3></div>
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-9 contact-form">
				<?php echo do_shortcode('[contact-form-7 id="39" title="Contact"]');  ?>
			</div>
		</div>
	</div>
</section>	
<?php endwhile; ?>