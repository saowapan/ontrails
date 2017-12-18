var pageNumber = 1;
//var ppp = 6;
var number_click = 0;
// showpost
function showpost(category,post_id,show_post_js,countallpost,tag_js) {
	var ajax_url = ajax_infohub_params.ajax_url;
	var start_pageNumber = 0;
	 
	if(number_click > 0) {
		pageNumber = 1;
	}
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'show_post',// ../lib/ajaxPost.php 
			cate: category,
			post_id : post_id,
			tag: tag_js,
			ppp: show_post_js,
			pageNumber: start_pageNumber,
			countall: countallpost
		},
		beforeSend: function ()
		{	
		},
		success: function(data)
		{
			jQuery("#loadPage").show(0).delay(300).hide(0); // image about loadPage
			jQuery('#postShowMore .wrap-posts-box').html(data).hide(0).delay(300).show(0); // show post 

			number_click++ ;
			if (jQuery('#no_more_post').length){
				jQuery("#more_posts").hide(); 
				jQuery('#postShowMore .wrap-posts-box').addClass(' nobtn')
			} else {
				jQuery("#more_posts").hide(0).delay(500).show(0);
			}
		},
		error: function()
		{
			jQuery('#postShowMore .wrap-posts-box').html('<p>There has been an error</p>');
		}
	});		
}
// more_post
function more_post(category,post_id,countallpost,tag_js) {
	pageNumber = pageNumber+1;
	var ajax_url = ajax_infohub_params.ajax_url;
	
	jQuery.ajax({
		type : 'post',
		url: ajax_url,
		data: {
			action: 'more_showpost',// ../lib/ajaxPost.php 
			cate:  category,
			post_id : post_id,
			tag: tag_js,
			ppp: 6,
			pageNumber: pageNumber,
			countall: countallpost
		},
		beforeSend: function ()
		{ 
			jQuery('.fade-1').removeClass('fade-1');
			jQuery('.fade-2').removeClass('fade-2');
			jQuery('.fade-3').removeClass('fade-3');
			jQuery('.fade-4').removeClass('fade-4 setfade');
			jQuery('.fade-5').removeClass('fade-5 setfade');
			jQuery('.fade-6').removeClass('fade-6 setfade');
			//jQuery('.autoClickLoad').removeClass(' autoClickLoad');
		},
		success: function(data)
		{	
			jQuery(window).scroll(function() {
			  	var autoShow = jQuery('.fade-1').offset().top;
			  	// var autoClickLoad = jQuery('.autoClickLoad').offset().top;
				if(jQuery(window).scrollTop() > autoShow) { 
				    jQuery('.fade-4,.fade-5,.fade-6').addClass(' setfade');
				}

				/*if(jQuery(window).scrollTop() > autoClickLoad) { 
				    jQuery("#more_posts").click();  
				    //jQuery('.autoClickLoad').removeClass(' autoClickLoad');
				}*/
			});
			jQuery('#postShowMore .wrap-posts-box').append(data);

			if (jQuery('#no_more_post').length){
				jQuery("#more_posts").hide(); 
				jQuery('#postShowMore .wrap-posts-box').addClass(' nobtn')
			} else {
				jQuery("#more_posts").show();
			}

			jQuery(".imgload").hide(); 
   			jQuery("#more_posts").removeClass("btn-loadmore");	

		},
		error: function()
		{
			jQuery('#postShowMore .wrap-posts-box').html('<p>There has been an error</p>');
		}
	});		
}

  	jQuery('#more_posts').click(function(){
  		jQuery("#more_posts").addClass("btn-loadmore");
	    jQuery(".imgload").fadeIn(500);
	   // jQuery('.autoload').removeClass(' autoload'); Auto click 
	});