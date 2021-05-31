<?php 
	get_header();
 	global $post;
?>
<div class="container">
	<div class="row post-body">
		<?php 
			if(have_posts()): while ( have_posts() ) : the_post();?> 
				<?php if (has_post_thumbnail( $post->ID ) ): ?>		
					<div class="col-md-4">		
					  	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
							<div class="text-center bottom-buffer">
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo $image[0]; ?>" alt="" align="center" >
								</a>
							</div>
					</div>
					<div class="col-md-8">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
							<?php the_title(); ?></a>
						</h2>	
						<?php the_content(); ?>
						<hr class="bottom-buffer">
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
 						//if ( comments_open() || get_comments_number() ) :
     						//comments_template();
 						//endif; ?>
 						<hr class="bottom-buffer">
						<div class="col-md-12">
							<?php get_template_part( 'partials/single', 'post-navigation' ); ?>
						</div>											
		    		</div>	
				<?php else: ?>
				<div class="col-md-offset-2 col-md-8 col-md-offset-2">
					<h2 class="post-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title(); ?></a>
					</h2>	
					<?php the_content(); ?>
					<hr class="bottom-buffer">
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
 						//if ( comments_open() || get_comments_number() ) :
     						//comments_template();
 						//endif; ?>
 						<hr class="bottom-buffer">
						<div class="col-md-12">
							<?php get_template_part( 'partials/single', 'post-navigation' ); ?>
						</div>		
	    		</div>
	    	<?php endif; ?>	
	    <?php endwhile; endif;?>
	</div>	
</div>
<?php get_footer();?>
