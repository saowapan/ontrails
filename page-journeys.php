<section class="section-header-default">
	<?php $intro = get_field('introduction_header'); ?>
    <?php echo header_fading('d-fading','Journeys' ,$intro);?>
</section>
<section class="section-default slider-box-default">
	<div class="container">
		<div class="col-12 text-center">
			<div class="row wrap-sliders-box">
				<div class="journeys-slider slider">
					<?php get_template_part('widgets/post', 'journeys'); ?>
				</div>
			</div>
		</div>
	</div>	
</section>