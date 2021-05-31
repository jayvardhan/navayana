<?php

	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');
	require_once('customize-theme.php');

	register_nav_menus( array(
	        'primary' => __( 'Primary Menu', 'THEMENAME' ),
		'footer' => __( 'Footer', 'THEMENAME' )
	) );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	    add_image_size( 'category-thumb', 200, 150, true);
	}


	/* load javascript */
	function load_js() {

		wp_deregister_script('jquery');

		wp_register_script('jquery', get_template_directory_uri() . '/js/jquery_3.2.1.min.js', array(), null, true);

		wp_enqueue_script( 'boostrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);

		wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);

		//enqueue style
		wp_enqueue_style('nvy-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', false, '1.0.0' );
		wp_enqueue_style('nvy-font-awesome', get_template_directory_uri().'/css/font-awesome-4.7.0/css/font-awesome.min.css', false, '1.1.0' );
		wp_enqueue_style('nvy-google-fonts', 'https://fonts.googleapis.com/css?family=Merriweather', false );
		wp_enqueue_style( 'main-style', get_template_directory_uri() .'/style.css', false, filemtime(get_stylesheet_directory() . '/style.css') );
	}
	add_action('wp_enqueue_scripts', 'load_js');



	//Woocommerce Remove Action
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


	//woocommerce add action
	add_action( 'woocommerce_single_product_summary', 'back_to_shop', 32);
	add_action( 'woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 34);



	// EXCERPTS
	add_filter( 'excerpt_length', function( $length ){
		return 20;
	}, 999 );

	add_filter('excerpt_more', function($more){
		return '...';
	});



	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +
	function woo_custom_product_add_to_cart_text() {
	    return __( 'Buy', 'woocommerce' );
	}


	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment'); 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
		<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				$count = WC()->cart->cart_contents_count;
				?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php 
				if ( $count > 0 ) {
				?>
				<strong class="cart-contents-count rounded"><?php echo esc_html( $count ); ?></strong>
				<?php
				}
				?></a>
				<?php } ?>
		<?php

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	}



	function wpb_widgets_init() {

		register_sidebar(
			array(
				'name' =>__( 'Front page sidebar', 'wpb'),
				'id' => 'primary',
				'description' => __( 'Appears on the static front page template', 'wpb' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name' => __('Secondary sidebar', 'wpb'),
				'id' => 'secondary',
				'description' => __( 'Appears on page and category template', 'wpb' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside><hr>',
				'before_title' => '<h4 class="widget-title">',
                                'after_title' => '</h4>',
			)
		);
	}
	add_action( 'widgets_init', 'wpb_widgets_init' );

	// RECENT POSTS SHORTCODE
	function my_recent_post(){
		$args = array(
			'order'			=> 'desc',
			'posts_per_page' 	=> 4,
			'ignore_sticky_posts' 	=> 1,
			'cat' => 35
		);
		$the_query = new WP_Query( $args );
		echo '<ul class="list-unstyled blog-list">';
		if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

		echo '<li class="top-buffer">';?>
			<div class="row">
			<?php //if ( has_post_thumbnail() ): ?>
				<!--div class="col-md-5 text-center"> <?php
					//$image = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->get_the_ID() ), 'single-post-thumbnail' );
					//echo '<a href="'. get_permalink() .'"><img src="'.$image[0].'" class="img-155"></a>'; ?>	
				</div>
				<div class="col-md-7">
					<h4>
						<a href="<?php //the_permalink()?>">
							<strong><?php //the_title();?></strong>
						</a>
					</h4>
					<span class="blog-date"><?php //the_time('F j, Y');?></span>
					<?php //the_excerpt();?>
					<a href="<?php //the_permalink();?>">
						<strong><i class="fa fa-file-text"></i> Read More</strong>
					</a>
				</div -->
			<?php //else:?>
				<div class="col-md-12">
					<h4>
						<a href="<?php the_permalink()?>">
							<strong><?php the_title();?></strong>
						</a>
					</h4>
					<span class="blog-date"><?php the_date();?></span>
					<p><?php the_excerpt();?></p>
					<a href="<?php the_permalink();?>">
						<strong><i class="fa fa-file-text"></i> Read More</strong>
					</a>
				</div>
			<?php //endif;?>
			</div>
		<?php echo '<hr></li>';
		endwhile;
		wp_reset_postdata();endif;
		echo "</ul>"; 
	}
	add_shortcode( 'recent-posts', 'my_recent_post' );


	add_filter('widget_text','do_shortcode');



	function woocommerce_product_loop_start() { 
		//echo '<div class="products row-eq-height pull-left top-buffer">';
		echo '<div class="row equal pull-left">'; 
	}


	function woocommerce_product_loop_end() {
		echo '</div>';
	}


	// Display Fields
	add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
	function woo_add_custom_general_fields() {
		global $woocommerce, $post;
	  	echo '<div class="options_group">';

		// Text Field
		woocommerce_wp_text_input( 
			array( 
				'id'          => '_wc_Price_In_Dollar', 
				'label'       => __( 'Price in USD', 'woocommerce' ), 
				'placeholder' => '',
				'description' => __( 'Enter Price in USD $', 'woocommerce' ) 
			)
		);

		// Textarea
		woocommerce_wp_textarea_input( 
			array( 
				'id'          => '_wc_Quotes', 
				'label'       => __( 'Quotes', 'woocommerce' ), 
				'placeholder' => '', 
				'description' => __( 'Enter Quotes here.', 'woocommerce' ) 
			)
		);
	  	echo '</div>';
	}

	// Save Fields
	add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
	function woo_add_custom_general_fields_save( $post_id ){
		
		// Text Field
		$woocommerce_text_field = $_POST['_wc_Price_In_Dollar'];
		if( !empty( $woocommerce_text_field ) )
			update_post_meta( $post_id, '_wc_Price_In_Dollar', esc_attr( $woocommerce_text_field ) );		

		// Textarea
		$woocommerce_textarea = $_POST['_wc_Quotes'];
		if( !empty( $woocommerce_textarea ) )
			update_post_meta( $post_id, '_wc_Quotes', $woocommerce_textarea );
	}


	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
	function woo_remove_product_tabs( $tabs ) {
	    unset( $tabs['reviews'] );
		unset( $tabs['additional_information'] ); 
	    return $tabs;

	}


	add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
	function woo_new_product_tab( $tabs ) {

		$tabs['test_tab'] = array(
			'title' 	=> __( 'Quotes', 'woocommerce' ),
			'priority' 	=> 50,
			'callback' 	=> 'woo_new_product_tab_content'
		);

		return $tabs;

	}


	function navayana_get_price_in_dollar() {
		if(get_post_meta( get_the_ID(), '_wc_Price_In_Dollar', true )){
			echo '$ '. get_post_meta( get_the_ID(), '_wc_Price_In_Dollar', true );	
		}
	}


	function woo_new_product_tab_content() {

		//echo '<h2>Quotes</h2>';
		echo do_shortcode(wpautop(get_post_meta( get_the_ID(), '_wc_Quotes', true )));

	}


	add_filter('woocommerce_product_description_heading', '__return_null');

	function navayana_highlight_shortcode( $atts, $content = null ) {
		return '<span class="highlight">' . $content . '</span>';
	}
	add_shortcode( 'highlight', 'navayana_highlight_shortcode' );


	//Show all products
	add_filter( 'loop_shop_per_page', 'navayana_loop_shop_per_page', 20 );
	function navayana_loop_shop_per_page( $cols ) {
	  $cols = -1;
	  return $cols;
	}


	function back_to_shop() {
		$product_page_url = get_permalink( wc_get_page_id ( 'shop' ) );

		$link = '<div class="bottom-buffer-2x"><a href="'. $product_page_url .'"><i class="fa fa-arrow-left" aria-hidden="true"></i> To Shop</a></div>';

		_e($link);
	}


