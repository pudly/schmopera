<?php
/**
 * @package schmopera
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sch_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sch' ), __( '1 Comment', 'sch' ), __( '% Comments', 'sch' ) ); ?></span>
			<?php endif; ?>			
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<a href="<?php the_permalink(); ?>"><img src="
		<?php  
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'offset' => 0,
				'orderby' => 'menu_order',
				'order' => 'asc',
				'post_status' => null,
				'post_parent' => $post->ID,
				);
			$attachments = get_posts($args);
			if ($attachments) {
				foreach ($attachments as $attachment) {
					if(wp_attachment_is_image( $attachment->ID )) {
						$image = wp_get_attachment_image_src($attachment->ID, false);
						echo $image[0];
						break;
					}
				}
			};
		?>"></a>								  
		<?php echo wp_trim_words( get_the_content(), 100 ); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sch' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'sch' ) );
				if ( $categories_list && sch_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'sch' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'sch' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'sch' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sch' ), __( '1 Comment', 'sch' ), __( '% Comments', 'sch' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'sch' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
