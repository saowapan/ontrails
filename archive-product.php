<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>
<section class="section-header-default">
    <div class="container">
		<div class="<?=$class?>" style="width: 100%;">
			<div class="row justify-content-center" id="fading">
				<div class="col-xl-6 col-lg-8 col-md-10 text-center">
					<div class="fade">
						<div class="el">
							<div class="white-title">
								<hr>
								<h3 class="big-title">Store</h3>
							</div>
						</div>
						<div class="el white-color">
							<?php do_action( 'woocommerce_archive_description' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="prints"></div>
</section>
<section class="section-stores section-default">
	<div class="container">
		<?php if ( have_posts() ) :
			$parentid = get_queried_object_id();     
			$args_terms = array( 'parent' => $parentid);
			$terms = get_terms( 'product_cat' ,$args_terms);
			if ( $terms ) {
	      		foreach ( $terms as $term ) {  
	      			echo '<div id="'.$term->slug.'" class="col-12 text-center wrapstores">'; //wrapstores
	      			echo '<div class="main-title"><hr><h3 class="medium-title">'.$term->name.'s</h3></div>';                   
					woocommerce_product_loop_start(); 
						echo '<div class="wrap-stores-box">';
						$args = array(
							'post_type' => 'product',
							'posts_per_page'  => -1,
							'post_status'     => 'publish',
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $term->name,
								),
							),
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); 
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product' );
						endwhile;
						echo '</div>';// wrap-stores-box
					woocommerce_product_loop_end();
					echo '</div>'; // wrapstores
				}
			}else{
				echo '<div class="col-12 wrapstores">';//wrapstores
					woocommerce_product_loop_start(); 
						echo '<div class="wrap-stores-box">';
						$args = array(
							'post_type' => 'product',
							'posts_per_page'  => -1,
							'post_status'     => 'publish',
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); 
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product' ); 
						endwhile; 
						echo '</div>';// wrap-stores-box
					woocommerce_product_loop_end();
				echo '</div>';// wrapstores
			}
			do_action( 'woocommerce_after_shop_loop' );
		?>
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : 
				do_action( 'woocommerce_no_products_found' );
		endif; ?>
	</div>
</section>