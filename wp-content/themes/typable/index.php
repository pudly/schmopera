<?php get_header(); ?>

		<div id="content">
            <div class="posts">

				<!-- titles -->
				<?php if(is_tag()) { ?>
					<h2 class="archive-title"><i class="icon-tag"></i> <?php single_tag_title(); ?></h2>
				<?php } else if(is_day()) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php _e('Archive:','okay'); ?> <?php echo get_the_date(); ?></h2>
				<?php } else if(is_month()) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date('F Y'); ?></h2>
				<?php } else if(is_year()) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date('Y'); ?></h2>
				<?php } else if(is_404()) { ?>
					<h2 class="archive-title"><i class="icon-warning-sign"></i> <?php _e('Page Not Found!','okay'); ?></h2>
				<?php } else if(is_category()) { ?>
					<h2 class="archive-title"><i class="icon-file-alt"></i> <?php single_cat_title(); ?></h2>
				<?php } else if(is_author()) { ?>
					<h2 class="archive-title"><i class="icon-file-alt"></i> <?php
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo $curauth->display_name; ?></h2>
				<?php } else if(is_search()) { ?>
				<h2 class="archive-title"><i class="icon-search"></i> <?php $allsearch = &new WP_Query("s=$s&showposts=-1"); $count = $allsearch->post_count; echo $count . ' '; wp_reset_query(); ?> <?php _e('results for','okay'); ?> "<?php the_search_query() ?>"</h2>
				<?php } ?>
				
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class('post'); ?>>
					<div class="box-wrap">
						<div class="box">
							
							<header>
								<div class="date-title"><?php echo get_the_date(); ?> <span class="date-space">&mdash;</span> <a class="lower-jump" href="<?php the_permalink(); ?>#lower-jump"><i class="icon-comment-alt"></i> <?php comments_number(__('0','okay'),__('1','okay'),__( '%','okay') );?></a></div>
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</header>

							<!-- grab the featured image -->
							<?php if ( has_post_thumbnail() ) { ?>
								<a class="featured-image <?php if ( get_option('okay_theme_customizer_enable_bw') == 'enabled' ) { echo 'featured-image-bw'; } ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured-image' ); ?></a>
							<?php } ?>

							<!-- post content -->
							<div class="post-content">
								<!-- show excerpt on search, archive, homepage -->
								<?php if(is_search() || is_archive() || is_home()) { ?>
									<div class="excerpt-more">
										<?php the_excerpt(); ?>
										<a class="excerpt-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Read More','okay'); ?></a>
									</div>
								<?php } else { ?>
									<!-- otherwise show all content -->
									<?php the_content(); ?>
								<?php } ?>
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post -->

				<?php endwhile; ?>
				<?php endif; ?>

			</div><!-- posts -->	      
		</div><!-- content -->

		<!-- post navigation -->
		<?php if( okay_page_has_nav() ) : ?>
			<div class="post-nav">
				<div class="post-nav-inside">
					<div class="post-nav-right"><?php previous_posts_link(__('Newer Posts', 'okay')) ?></div>
					<div class="post-nav-left"><?php next_posts_link(__('Older Posts', 'okay')) ?></div>
				</div>
			</div>
		<?php endif; ?>

		<!-- footer -->
		<?php get_footer(); ?>