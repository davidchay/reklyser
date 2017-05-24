<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package understrap
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area mt-5" id="comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-center">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						/* translators: %s: post title */
						esc_html_x( 'Un comentario', 'comments title', 'understrap' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: number of comments, 2: post title */
						esc_html( _nx(
							'%1$s Comentario',
							'%1$s Comentarios',
							$comments_number,
							'comments title',
							'understrap'
						) ),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation row mt-5 mb-5" id="comment-nav-above">
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous col-6 text-right"><?php previous_comments_link( __( '&larr; Anteriores',
					'understrap' ) ); ?></div>
				<?php }
if ( get_next_comments_link() ) { ?>
					<div class="nav-next col-6 text-left"><?php next_comments_link( __( 'Recientes &rarr;',
					'understrap' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation. ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				//'style'      => 'ol',
				//'avatar_size' => 96,
				//'short_ping' => true,
				'callback' => '_comment', 
				'avatar_size' => 96, 
				 
			) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation row mt-5 mb-5" id="comment-nav-below">
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous col-6 text-right"><?php previous_comments_link( __( '&larr; Anteriores',
					'understrap' ) ); ?></div>
				<?php }
if ( get_next_comments_link() ) { ?>
					<div class="nav-next col-6 text-left"><?php next_comments_link( __( 'Recientes &rarr;',
					'understrap' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'understrap' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
