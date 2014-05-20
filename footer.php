			</div> <!-- end #container -->
			<footer class="panel-footer" role="contentinfo">
			
				<div id="inner-footer" class="clearfix container">
					<a class="navbar-brand col-lg-3" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img title="<?php bloginfo('name'); ?>" src="<?= get_bloginfo( 'template_url' ) . '/images/logo_light.png' ?>"/></a>
		     		<h3 class="col-lg-6"><?= get_bloginfo( 'description' ); ?> </h3>
		     		<p class="col-lg-3"><?= do_shortcode('[button type="success" size="medium" text="Be om prisförslag/offert" url="/kontakt-oss"] '); ?></p>
		          <div id="spacer" class="clearfix row"></div>
					<nav class="col-lg-3">
						<?php $args = array('theme_location' => 'our_projects',
											'items_wrap' => '<ul><li id="item-id"><h4>Se tidigare byggen</h4></li>%3$s</ul>'); ?>
						<?php wp_nav_menu( $args ); ?>
					</nav>
					<nav class="col-lg-3">
						<?php $args = array('theme_location' => 'about_us_footer',
											'items_wrap' => '<ul><li id="item-id"><h4>As Construction</h4></li>%3$s</ul>'); ?>
						<?php wp_nav_menu( $args ); ?>
					</nav>
					<nav class="col-lg-3">
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
					
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>