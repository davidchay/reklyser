<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function understrap_posted_on() {
	echo '';
		echo '';
  		echo '';
	$time_string = '<time class="entry-date published" datetime="%1$s"><span class="fa-stack fa-lg"><i class="fa fa-calendar-o fa-stack-2x"></i><span class="day">%2$s</span></span><span class="month">%3$s</span></time>';
	$time_string = sprintf( $time_string,
		//esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('j') ),
		esc_html( get_the_date('M') )
		//esc_attr( get_the_month_title() ),
		//esc_html( get_the_month_title() )
		
	
	);
	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'understrap' ),
		 $time_string 
	);
	/*$byline = sprintf(
		esc_html_x( 'por %s', 'post author', 'understrap' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);*/
	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'understrap_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function understrap_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
		if ( $categories_list && understrap_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Publicado en %1$s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Etiquetas %1$s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
	
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Editar %s', 'understrap' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if(!function_exists('understrap_entry_comment')):
function understrap_entry_comment ($id){

if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		$comments=wp_count_comments($id);
		echo '<span class="entry_comment">';
		echo '<span class="fa-stack fa-lg">';
  		echo '<i class="fa fa-comment-o fa-stack-2x"></i>';
		echo $comments->approved;
  //<i class="fa fa-twitter fa-stack-1x"></i>
echo '</span>';
		//comments_popup_link( esc_html__( 'Comenta', 'understrap' ), esc_html__( '1 Comentario', 'understrap' ), esc_html__( '% Comentarios', 'understrap' ) );
		//echo '</span>';
	}
}
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function understrap_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'understrap_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'understrap_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so components_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so components_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in understrap_categorized_blog.
 */
function understrap_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'understrap_categories' );
}
add_action( 'edit_category', 'understrap_category_transient_flusher' );
add_action( 'save_post',     'understrap_category_transient_flusher' );

