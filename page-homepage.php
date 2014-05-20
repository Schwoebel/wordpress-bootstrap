<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
						<header>

							<?php 
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
							?>

							
								<div class="page-header">
									<h1><?php echo get_post_meta($post->ID, 'custom_tagline' , true);?></h1>
								</div>				
								
							
						
						</header>
						
						<section class="row post_content top_blocks">
						
							<div class="col-sm-12">
						
								<?php the_content(); ?>
								
							</div>
							
							<?php //get_sidebar('sidebar2'); // sidebar 2 ?>
														
						</section> <!-- end article header -->
						<section class="col-lg-12 mid_start_slideshow" style="padding:0; background-color: white;">
						
							<div id="carousel">
								<div class="col-lg-6 overlay">
									<div class="col-lg-9 inner-overlay">
										<h2>Vi är proffs på att bygga arkitektritade och unika hus</h2>
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
										<ul class="front-page-bullet-list">
											<li>Bygger Passivhus och energisnäla</li>
											<li>Funnits sedan 2002</li>
											<li>Byggt över 50 dokumenterade hus</li>
										</ul>
									</div>
								</div>
								<?php the_post_thumbnail( 'wpbs-featured-carousel-big');?>
								
							</div>
							
							<?php //get_sidebar('sidebar2'); // sidebar 2 ?>
														
						</section> <!-- end article header -->
						<section class="col-lg-12 project_grid" style="background-color: white;">
							<h1>Se några tidigare referenser vy har byggt</h1>
								<?php 
									project_grid();
								?>
						</section>
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>