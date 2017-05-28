<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		?>
		<div class="thumbnail-post" style="background-image:url(<?php the_post_thumbnail_url( 'large' ); ?>);">

		</div>
		<?php
			}
		?>
		<div class="content-post-wrapper">
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
					<?php understrap_entry_comment(get_the_ID()); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<div class="content-post">
		   		<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
				<?php
					the_content();
				?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Paginas:', 'understrap' ),
					'after'  => '</div>',
				) );
				?>
				</div><!-- .entry-content -->
				<footer class="entry-footer">
					<?php understrap_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</div><!-- ./content-post -->
	</div><!-- ./content-post-wrapper -->
</article><!-- #post-## -->
