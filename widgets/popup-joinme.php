<section id="modal" class="popup-joinme" style="display: none;">
	<div class="row justify-content-center align-items-center">
		<div class="col-xl-6 col-lg-7 col-md-9">
			<div class="white-title"><hr><h3 class="big-title">Join me</h3></div>
			<p class="p-body">I’m Alex, a designer and photographer who is not so keen on flying. But I have never let that stop me from travelling the world to take photos of stunning places and share stories of my adventures.</p>
			<?php //echo do_shortcode('[contact-form-7 id="1300" title="subscribed"]');  ?>
			<!-- Begin MailChimp Signup Form -->
				<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
				<div id="mc_embed_signup">
					<form action="https://alexontrails.us9.list-manage.com/subscribe/post?u=917798e8f37cee78558be15ea&amp;id=ddc66deae8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">

							<div class="mc-field-group input-form">
								<input type="text" value="" name="NAME" class="required" id="mce-NAME" placeholder="NAME">
							</div>
							<div class="mc-field-group input-form">
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="EMAIL">
							</div>
						    <div style="position: absolute; left: -5000px;" aria-hidden="true">
						    	<input type="text" name="b_917798e8f37cee78558be15ea_ddc66deae8" tabindex="-1" value="">
						    </div>
						    <div class="clear button-submit">
						    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						    </div>
						    <div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div><!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						</div>
					</form>
				</div>
				<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
				<script type='text/javascript'>
					(function($) {
						window.fnames = new Array(); 
						window.ftypes = new Array();
						fnames[1]='NAME';
						ftypes[1]='text';
						fnames[0]='EMAIL';
						ftypes[0]='email';
					}(jQuery));
					var $mcj = jQuery.noConflict(true);
				</script>
			<!--End mc_embed_signup-->
			
	       	<div class="follow-us">
	       		<p>FOLLOW ME ON</p>
	       		<?php 
		            if (has_nav_menu('link_social_media')) {
		                wp_nav_menu(['theme_location' => 'link_social_media', 'menu_class' => 'nav social-button flex-column']);
		            } 
	        	?>
	       	</div>
	    </div>
	</div>
</section>