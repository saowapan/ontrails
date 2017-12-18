<?php 
  if (!is_page('home')) {
    get_template_part('widgets/section', 'joinme');
    get_template_part('widgets/popup', 'joinme');
  }
?>
<footer class="content-info section-footer">
  <div class="container">
  	<div class="top-footer">
  		<div class="row">
	  		<div class="col-xl-6 col-lg-4 left-footer">
          <div class="align-items-center d-flex logo-footer">
	  			  <a  href="<?= esc_url(home_url('/'));?>">
              <img src="<?= build_url('/assets/images/logo-ontrails-footer.png');?>" alt="On Trails">
            </a>
            <h3 class="text-uppercase"><a  href="<?= esc_url(home_url('/'));?>">on trails </a></h3>
          </div>
          <p class="hidden-md-down">@ ON TRAILS 2017</p>  
	  		</div>
	    	<div class="col-xl-6 col-lg-8 right-footer">
          <div class="d-flex">
	    		<?php dynamic_sidebar('sidebar-footer'); ?>
          </div>
	    	</div>	
    	</div>
    </div>
    <div class="bottom-footer">
      <hr class="hidden-sm-down">
    	<p class="hidden-lg-up">© ON TRAILS 2017</p>
    </div>
  </div>
</footer>
