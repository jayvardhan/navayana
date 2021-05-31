<!--div class="pre-footer top-buffer">
	<div class="container">
		<div class="row">
			<a href="/dalit-history-fellowship-2021/"><img src="https://navayana.org/wp-content/uploads/2021/04/dalit-history-month-banner-01-01-scaled.jpg" style="max-width:100%"></a>
		</div>
	</div>
</div-->
<footer class="top-buffer">
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<ul class="list-inline share-icons">
				<li>
					<a href="https://www.facebook.com/Navayana/" target="_blank">
					<i class="fa fa-facebook-official fa-2x"></i>
					</a>
				</li>
				<!--li>
					<a href="https://twitter.com/buffaloeskissin" target="_blank">
					<i class="fa fa-twitter fa-2x"></i>
					</a>
				</li-->
				<li>
					<a href="https://www.google.co.in/maps/place/Navayana/@28.5475585,77.2152373,15z/data=!4m5!3m4!1s0x0:0x2adcc820693604c2!8m2!3d28.5475585!4d77.2152373" target="_blank"><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row"> <!-- FOOTER MENU -->
		<div class="col-sm-12 col-md-offset-1 col-md-10">
		<hr>
			<div class="footer-nav text-center">
				<?php

					wp_nav_menu( array(
						'menu' 				=> 'footer',
						'theme_location' 	=> 'footer',
						'depth' 			=> 1,
						'container' 		=> false,
						'menu_class' 		=> 'nav navbar-nav',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker())

					);

				?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p class="copyright text-center top-buffer">Copyright Navayana Publishing Pvt. Ltd. 2021 | Developed on <a href="http://wordpress.org" target="_blank">Wordpress</a> by <a href="https://sputznik.com" target="_blank">Sputznik</a></p>
		</div>
	</div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
