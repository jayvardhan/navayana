<?php
/*
Template Name: Full-Width Page
*/
get_header(); ?>

<div class="container">
<div class="row">
        <div class="col-sm-12">
        <?php if(have_posts()):while ( have_posts() ) : the_post();?> 
                <h2 class="post-title top-buffer"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <div class="text-center bottom-buffer"><img src="<?php echo $image[0]; ?>" alt="" align="center" ></div>
                <?php endif; ?>
                </a>
                <?php the_content(); ?>
                <hr class="bottom-buffer">
    <?php endwhile;endif;?>
	</div>
</div>
</div>

<?php get_footer();
?>
