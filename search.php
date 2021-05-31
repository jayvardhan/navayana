<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php if ( have_posts() ) : ?>	
				<h1 class="bottom-buffer-2x"><?php printf( __( 'Search Results for: %s', 'navayana' ), get_search_query() ); ?></h1>
				
				<?php
				while ( have_posts() ) : the_post(); ?>
					<div class="row bottom-buffer">
						<?php if(has_post_thumbnail()): ?>
						<div class="col-md-3 featured-img-cat">
							<?php
							the_post_thumbnail('category-thumb');
							?>
						</div>
						<div class="col-md-9">
							<div>
								<h2><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<br/>
								<span><?php the_date();?></span>
							</div>
							<p><a class="excerpt" href="<?php the_permalink(); ?>"><?php the_excerpt();?></a</p>
						</div>
						<?php else: ?>
						<div class="col-md-12">
							<div>
								<h2><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<br/>
								<span><?php the_date();?></span>
							</div>
							<p><a class="excerpt" href="<?php the_permalink(); ?>"><?php the_excerpt();?></a</p>
						</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
				<div class="bread-bar text-center" > <?php
					$navigator = get_the_posts_pagination( array(
						'screen_reader_text' => __( 'A', 'twentyfifteen' ),
						'mid_size'			=> 2,
						'prev_text'          => __( 'Previous', 'twentyfifteen' ),
						'next_text'          => __( 'Next', 'twentyfifteen' )
					) );
					$navigator = str_replace('<h2 class="screen-reader-text">A</h2>', '', $navigator);
					echo $navigator;
					?>
				</div>
			<?php else:?>
				<p>Sorry, no content matched your query. Please try something else!</p>
			<?php endif;?>
		</div>
		<div class="col-md-4 gray-bg-col">
			<?php if(is_active_sidebar('secondary')){ dynamic_sidebar('secondary');}?>
		</div>
	</div>	
</div>
<?php get_footer();?>
