<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php 
		$classes[] = 'col-md-6 top-buffer bottom-buffer'; 
		post_class( $classes );
	?> >

	<div class="row">
		<div class="col-sm-6">
			<a href="<?php echo get_the_permalink()?>">
				<?php if ( has_post_thumbnail() ): ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			 	<img src="<?php echo $image[0]?>" alt="">
			 	<?php endif; ?>
			 </a>			
		</div>
		<div class="col-sm-6">
			<h4>
				<strong>
					<a href="<?php echo get_the_permalink()?>">
						<?php echo get_the_title(); ?>
					</a>
				</strong>
			</h4>
			<div class="author-list top-buffer">
				<?php echo wpautop($product->get_short_description()); ?>
			</div>
			<p>
				<p class="price"><?php echo $product->get_price_html(); ?></p>
				<?php woocommerce_template_loop_add_to_cart( $product ); ?>
			</p>
		</div>
	</div>
</div>

