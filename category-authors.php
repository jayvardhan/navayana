<?php
get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
			<?php
				$letters = range('A', 'Z');
				$flag = false;

				$args = array( 
					'category_name' => 'authors',
					'posts_per_page' => -1, 
					'orderby'=> 'title', 
					'order' => 'ASC' 
				);

				$query = new WP_Query( $args );

				while ( $query->have_posts() ) : $query->the_post(); 
			 		$str = get_the_title();
			 		if(in_array($str[0],$letters)) { 
						if($flag){
							echo '</ul></div>';
						} ?>

						<div class="col-sm-6 bottom-buffer">
							<?php echo $str[0];?>
							<ul class="list-unstyled">	 
			 			<?php
			 			$flag = true;
			 			unset($letters[array_search($str[0],$letters)]);
			 		} 

					?>
					<li><a href="<?php the_permalink(); ?>"><span style="color: #2770ba;"><?php the_title(); ?></span></a></li>
				<?php 
				endwhile; 
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<div class="col-md-4 gray-bg-col">
                        <?php dynamic_sidebar('secondary'); ?>
        </div>

</div>
</div>
</div>
<?php
get_footer();
?>
