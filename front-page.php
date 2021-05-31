<?php get_header(); global $feat_prod;?>
<div class="container">
	<div class="row">
		<div class="col-md-6 bottom-buffer">
			<i><small class="text-muted">Featured title</small></i>
			<?php 
			$meta_query  = WC()->query->get_meta_query();
			$tax_query   = WC()->query->get_tax_query();
			$tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);

			$args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 0,
				'posts_per_page'      => 1,
				'order'               => 'desc',
				'meta_query'          => $meta_query,
				'tax_query'           => $tax_query,
			);

			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); $feat_prod = get_the_ID(); ?>
			<div class="row" style="margin-top:10px">
				<div class="col-md-5 col-sm-4">
					<?php if (has_post_thumbnail()):?>
					<?php 
					  	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
					  	?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $image[0]; ?>" class="img-210">
						</a><?php 
					 endif; ?>
				</div>
				<div class="col-md-7 col-sm-8">
					<h4> <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>">
						<strong><?php echo get_the_title(); ?></strong></a> 
					</h4>
					<div class="author-list">
						<p><?php echo wpautop($product->get_short_description()); ?></p>
					</div>
					<div class="top-buffer">
						<p><?php echo $product->get_price_html(); ?></p>
						<?php woocommerce_template_loop_add_to_cart( $product ); ?>
					</div>
				</div>
			</div>
		 	<?php
		    endwhile;
		    wp_reset_query(); ?>
		</div>
		<div class="col-md-6 bottom-buffer">
			<i><small class="text-muted">Highlight</small></i>
			<?php
				$args = array(
					'posts_per_page' => 1,
					'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$query = new WP_Query( $args );
			?>
			<?php if($query->have_posts()):while ( $query->have_posts() ) : $query->the_post();?>
				<div class="row" style="margin-top:10px;">
				<?php if (has_post_thumbnail() ): ?>
					<div class="col-md-5 col-sm-4">
						<?php 
					  	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
					  	?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $image[0]; ?>" class="img-210">
						</a>
					</div>
					<div class="col-md-7 col-sm-8">
						<h4><a href="<?php the_permalink(); ?>">
							<strong><?php the_title(); ?></strong></a>
						</h4>
						<div class="author-list top-buffer">
							<p><?php the_excerpt(); ?></p>
						</div>
						<div class="top-buffer">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-sticky-note"></i> Read More</a>
						</div>	
					</div>
				<?php else:?>
					<div class="col-md-12">
						<h4><a href="<?php the_permalink(); ?>">
							<strong><?php the_title(); ?></strong></a>
						</h4>
						<div class="author-list top-buffer">
							<p><?php the_excerpt(); ?></p>
						</div>
						<div class="top-buffer">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-sticky-note"></i> Read More</a>
						</div>	
					</div>
				<?php endif; ?>	
				</div>
			<?php endwhile;endif;wp_reset_query(); ?>
		</div>
	</div>

	<!-- **************End of top row *************** -->


	<div class="row">
		<div class="<col-md-12 text-center top-buffer bottom-buffer">
			<h2><?php bloginfo('description');?></h2>
			<img src="wp-content/themes/navayana/images/placeholder-web.jpg" style="width:100%;"/>
		</div>
	</div>



	<div class="row">
		<!-- *********** Product Section ******** -->
		<div class="col-md-8">
			<!--div>
				<p class="top-buffer"><i><small class="text-muted">Recently Published</small></i></p>
			</div-->
			<div class="row">
				<?php
				$tax_query[] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				);

				$args = array( 
					'post_type'			=>	'product',
					'posts_per_page' 		=>	6,
					'post__not_in'			=>	array($feat_prod),
					'orderby'			=> 	'rand',
					'tax_query'			=>	$tax_query
				);

				$loop = new WP_Query( $args );
				$i=0;
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="col-md-6 bottom-buffer">
						<div class="row">
							<div class="col-md-5 col-sm-4">
							<?php if (has_post_thumbnail()): ?>
							  <?php 
							  	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
							  	?>
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo $image[0]; ?>" class="img-155">
								</a>
							<?php endif; ?>
							</div>
							<div class="col-md-7 col-sm-8">
								<h4 ><strong><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></strong></h4>
							<div class="author-list top-buffer">
								<p><?php echo wpautop($product->get_short_description()); ?></p>
							</div>
							<div class="top-buffer">
								<p><?php echo $product->get_price_html(); ?></p>
								<?php woocommerce_template_loop_add_to_cart( $product ); ?>
							</div>
							</div>
						</div>
					</div>	<?php
				$i++;
				if($i % 2 == 0){
					echo "</div><div class='row'>";
				}
				endwhile;
				wp_reset_query(); ?>
				<div class="col-md-12 text-center">
					<h4><a href="products/" class="btn btn-default top-buffer black-button bottom-buffer"><strong><i class="fa fa-sign-in"></i> Browse More</strong></a></h4>
				</div>
			</div>
		</div>

		<!-- *********** Blog Section *********** -->
		<div class="col-md-4 gray-bg-col">

			<p class="top-buffer"><b><i><small class="text-muted">Blogroll</small></i></b></p>
			<?php if(is_active_sidebar('primary')){ dynamic_sidebar('primary');}?>

			<div class="col-md-12 text-center">
				<h4><a href="<?php echo get_category_link( get_cat_ID( "Blog" ) ); ?> " class="btn btn-default bottom-buffer black-button"><strong><i class="fa fa-clipboard"></i> View Blog</strong></a></h4>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

