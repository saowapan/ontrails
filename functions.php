<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/shortcode.php', // Shortcode
  'lib/ajaxPost.php', // Ajax Call Post (PHP)
  'lib/set_post_types.php', 
  'lib/func_post.php', // show post
  'lib/func_post_home.php', // show post home
  'lib/func_header_fading.php', // header fading
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }
 
  require_once $filepath;
}
unset($file, $filepath);


// Menu
function wpb_custom_new_menu() {
  register_nav_menu('link_social_media',__( 'Social Media Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

// URL 
function build_url($path = '', $image = false, $return = false, $page = false) {
    $url = home_url();
    if ($path != '' && $page == false) {
      $url = get_stylesheet_directory_uri() . $path;
    }

    if ($page == true) {
      $url = $url . $path;
    }

    if ($return === true) {
      return $url;
    } else {
      echo $url;
    }
}

// Img
function get_img_src_bypostid($post_id, $image_size = 'thumbnail') {
  $post_thumbnail_id = get_post_thumbnail_id($post_id);
  $image = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
  $image_src = $image[0];
  return $image_src;
}