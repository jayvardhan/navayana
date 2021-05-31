<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico"  type="image/x-icon"/>
		<title>
			<?php //bloginfo( 'name' ); 
				wp_title("", true, 'left');
			?>
		</title>
		<?php wp_head();?>
	</head>
<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="DPWDvSZD"></script>
	
	<nav class="navbar">
		<div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle top-buffer" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
		      	<span class="sr-only">Toggle navigation</span><i class="fa fa-bars fa-2x"></i> 
		      </button>
		      <a class="navbar-brand" href="<?php bloginfo('url');?>"> <img src="<?php echo get_theme_mod( 'm1_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		            </a>
		    </div>

	       	<!-- Collect the nav links, forms, and other content for toggling -->
		    <?php
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'primary',
	                'depth'             => 2,
	                'container'         => 'div',
	                'container_class'   => 'collapse navbar-collapse',
			'container_id'      => 'bs-example-navbar-collapse-1',
	                'menu_class'        => 'dropdown nav navbar-nav navbar-right',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'walker'            => new wp_bootstrap_navwalker())
	            );
		    ?>
		</div>
	</nav>


	<div class="container bread-bar">
		<div class="dash-sep"></div>	
		<div class="row">
			<div class="col-sm-9">
				<?php
					//bootstrap_breadcrumb('<i class="fa fa-home"></i> ');
					woocommerce_breadcrumb();
				?>
			</div>
			<div class="col-sm-3">
				<ul class="nav navbar-nav pull-right">
					<li>
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
					</li>
					<li>
						<a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
					</li>
				</ul>
			</div>
		</div>

		<div class="row ">
			<div class="col-md-offset2 col-md-8 col-md-offset-2 searchform bottom-buffer-1x">	
				<form method="GET" action="<?php bloginfo('url');?>" class="input-group input-group-md">
					
					<input name="s" type="text" class="form-control" placeholder="Search Navayana" value="<?php echo get_search_query();?>">
					
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Search</button>
					</span>
				</form>
			</div>
		</div>
	<div class="dash-sep"></div>
	</div>
