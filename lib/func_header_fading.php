<?php 
	function header_fading($class,$title,$intro){ ?>
		<div class="container">
			<div class="<?=$class?>" style="width: 100%;">
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
	<?php }
?>