<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="before_single">
	<div class="container ">
	<?php
		/**
		 * woocommerce_before_single_product hook.
		 *
		 * @hooked wc_print_notices - 10
		 */
		 do_action( 'woocommerce_before_single_product' );

		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }
	?>
	</div>
</div>
<section class="section-header-default">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 col-md-10 text-center">
				<div class="white-title"><hr><h3 class="big-title"><?=get_the_title();?></h3></div>
				<small class="text-uppercase cate">
				<?php global $product; ?>
				<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
				<div class="absolute"></div>
				</small>
			</div>
		</div>
	</div>
</section>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="section-single-product">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<img class="img-fluid single-image" src="<?=get_img_src_bypostid($post->ID, 'full');?>">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						//do_action( 'woocommerce_before_single_product_summary' );
					?>
					<div class="detail-product-woocommerce">
						
							<?php
								/**
								 * woocommerce_single_product_summary hook.
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 * @hooked WC_Structured_Data::generate_product_data() - 60
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
						
					</div>
					<div class="content-product row align-items-center content-half">
						<div class="col-lg-6 left">
							<h2 class="col-lg-10 big-title-content">A short and impactful word about the product</h2>
						</div>
						<div class="col-lg-6 right">
							<?php wc_get_template( 'single-product/short-description.php' ); ?> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php //do_action( 'woocommerce_after_single_product' ); ?>
