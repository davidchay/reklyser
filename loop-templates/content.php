<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		?>
		<div class="thumbnail-post">
			<?php the_post_thumbnail( 'large' ); ?>
			<a href="<?php echo get_permalink(); ?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-link fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</div>
		<?php
			}
		?>
		<div class="content-post-wrapper">
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
					<?php understrap_entry_comment(get_the_ID()) ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<div class="content-post">
		   		<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
				<?php
					the_excerpt();
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
