<?php get_header(); ?>

		<div id="content">
            <div class="posts">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class('post'); ?>>
					<div class="box-wrap">
						<div class="box">
							<header>
								<div class="date-title"><?php echo get_the_date(); ?> <span class="date-space">/</span> <a class="lower-jump" href="<?php the_permalink(); ?>#lower-jump"><i class="icon-comment-alt"></i> <?php comments_number(__('0','okay'),__('1','okay'),__( '%','okay') );?></a></div>
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</header>

							<!-- post content -->
							<div class="post-content">
								<!-- grab the featured image -->
								<?php if ( has_post_thumbnail() ) { ?>
									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured-image' ); ?></a>
								<?php } ?>

								<?php the_content(__( 'Read More','okay')); ?>

								<div class="pagelink">
									<?php wp_link_pages(); ?>
								</div>

								<!-- next and previous page links -->
								<div class="next-prev">
									<div class="prev-post">
										<?php  previous_post_link('%link', '%title'); ?>
									</div>
				
									<div class="next-post">
										<?php next_post_link('%link', '%title'); ?>
									</div>
								</div><!-- next prev -->

							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post -->

				<?php endwhile; ?>
				<?php endif; ?>

			</div><!-- posts -->	      
		</div><!-- content -->

		<div id="lower-jump" class="lower clearfix">
			<div class="lower-inside">
				<ul class="meta-list clearfix">
					
					<li>
						<div class="meta-title"><?php _e('Author','okay'); ?></div>
						<?php the_author_posts_link(); ?>
					</li>

					<li>
						<div class="meta-title"><?php _e('Category','okay'); ?></div>
						<?php the_category('<br/>'); ?>
					</li>

					<?php $posttags = get_the_tags(); if ($posttags) { ?>
						<li>
							<div class="meta-title"><?php _e('Tags','okay'); ?></div>
							<?php the_tags('', '<br/>', ''); ?>
						</li>
					<?php } ?>

					<li class"share">
						<div class="meta-title"><?php _e('Share','okay'); ?></div>

						<!-- twitter -->
						<a class="share-twitter" onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank"><?php _e('Twitter','okay'); ?></a><br />

						<!-- facebook -->
						<a class="share-facebook" onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>"  target="blank"><?php _e('Facebook','okay'); ?></a> <br />

						<!-- google plus -->
						<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><?php _e('Google+','okay'); ?></a>
					</li>
				</ul><!-- meta list -->

				<!-- comments -->
		        <?php if ('open' == $post->comment_status) { ?>
			        <div id="comment-jump" class="comments">
			         	<?php $withcomments = 1; comments_template(); ?>
			        </div>
		        <?php } ?>
	    	</div><!-- lower inside -->
        </div><!-- lower -->

		</div><!-- main -->

		<!-- footer -->
		<?php get_footer(); ?>