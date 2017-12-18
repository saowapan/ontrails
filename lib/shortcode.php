<?php 
function intro_function( $atts,$content = null) {
	return '<p class="col-lg-9"><em>'.$content.'</em></p>';
}
add_shortcode('intro', 'intro_function');

function content_function( $atts,$content = null) {
	return '<p class="col-lg-9">'.$content.'</p>';
	
}
add_shortcode('content', 'content_function');

function customText_function($atts,$content = null){
	$atts = shortcode_atts( array(
		'size' 		=> '',
		'align' 	=> '',
		'family' 	=> '',
		'color' 	=> '',
		'class' 	=> '',
		'content' 	=> ''
	), $atts );

	$size   = $atts['size'];
	$align  = $atts['align'];
	$family = $atts['family'];
	$color  = $atts['color'];
	$class  = $atts['class'];
	$content = $atts['content'];

	if ($class) {
		$class = $class;
	}else{
		$class = 'col-lg-9';
	}

	$style  = 'text-align:'.$align.'; font-size:'.$size.'; font-family:'.$family.'; color:'.$color.';';

	return '<p class="'.$class.'" style="'.$style.'">'.$content.'</p>';
}
add_shortcode('custom-text', 'customText_function');

function image_function( $atts,$content = null) {
	$atts = shortcode_atts( array(
		'url' => '',
		'caption' => ''
	), $atts );
	$url = $atts['url'];
	$caption = $atts['caption'];
	return '<div class="col-12 image-post"><img class="img-fluid" src="'.$url.'" alt="'.$caption.'"/></div><p class="col-lg-9 caption">'.$caption.'</p>';
}
add_shortcode('image', 'image_function');