jQuery(document).ready(function($){
	var meta_image_frame_1;
    $('.pic_img_btn_1').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_1 ) {
            meta_image_frame_1.open();
            return;
        }
        meta_image_frame_1 = wp.media.frames.meta_image_frame_1 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_1.on('select', function(){
            var media_attachment = meta_image_frame_1.state().get('selection').first().toJSON();
           	$('.pic_name_show_1').val(media_attachment.url);
            $('.pic_img_show_1').replaceWith('<div><img class="pic_img_show_1" src="'+media_attachment.url+'" style="width: 400px;" /></div>');
        });
        meta_image_frame_1.open();
    });

    $('.Remove_img').click(function(e){ 
    	$('.pic_name_show_1').val('');
    	$('.pic_img_show_1').replaceWith('<span class="pic_img_show_1"><span>');
    });
});