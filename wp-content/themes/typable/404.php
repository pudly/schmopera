<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
				<!-- grab the posts -->
				<article class="post">
					<div class="box-wrap">
						<div class="box">
							<header>
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">404 &mdash; <?php _e('Page Not Found','okay'); ?></a></h1>
							</header>
							
							<!-- post content -->
							<div class="post-content">
								<p><?php _e('Dang! The page you are looking for has moved or no longer exists. Please use the menu above or check out the archives to locate the content you were looking for. Sorry about that.','okay'); ?></p>
								<p><b>&mdash; <?php _e('Management','okay'); ?></b></p>
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->	
			</div><!-- posts -->
		</div><!-- content -->
	
		<!-- footer -->
		<?php get_footer(); ?>