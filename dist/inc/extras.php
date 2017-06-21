<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function understrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'understrap_body_classes' );

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'adjust_body_class' );

if ( ! function_exists( 'adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'change_logo_class' );

if ( ! function_exists( 'change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-responsive img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"' , $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'understrap_post_nav' ) ) :

	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<div class="row">
			<div class="col-md-12">
				<nav class="navigation post-navigation">
					<h2 class="sr-only"><?php _e( 'Post navigation', 'understrap' ); ?></h2>
					<div class="nav-links row">
						<?php

							if ( get_previous_post_link() ) {
								previous_post_link( '<span class="nav-previous col-6"><em>Anterior</em> %link</span>', _x( '&#8592;&nbsp;%title', 'Previous post link', 'understrap' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<span class="nav-next text-right col-6"><em>Siguiente</em> %link</span>',     _x( '%title&nbsp;&#8594;', 'Next post link', 'understrap' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( '_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function _comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;

    if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
        <div class="comment-body">
            <?php _e( 'Pingback:', '_tk' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', '_tk' ), '<span class="edit-link">', '</span>' ); ?>
        </div>

    <?php else : ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
            <a class="pull-left mr-2" href="#">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </a>

            <div class="media-body">
                <div class="media-body-wrap panel panel-default">

                    <div class="panel-heading">
                        <h4 class="media-heading"><?php printf( __( '%s <span class="says"> dice...</span>', '_tk' ), sprintf( '%s', get_comment_author_link() ) ); ?></h4>
                        <div class="comment-meta">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', '_tk' ), get_comment_date(), get_comment_time() ); ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', '_tk' ), '<span class="edit-link">', '</span>' ); ?>
                        </div>
                    </div>

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', '_tk' ); ?></p>
                    <?php endif; ?>

                    <div class="comment-content">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->

                    <?php comment_reply_link(
                        array_merge(
                            $args, array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<footer class="reply comment-reply panel-footer">',
                                'after'     => '</footer><!-- .reply -->'
                            )
                        )
                    ); ?>

                </div>
            </div><!-- .media-body -->

        </article><!-- .comment-body -->

    <?php
    endif;
}

endif; // ends check for _tk_comment()
