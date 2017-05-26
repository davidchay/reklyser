<?php
/**
 * Pagination layout.
 *
 * @package understrap
 */

/**
 * Custom Pagination with numbers
 * Credits to http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 */

if ( ! function_exists( 'understrap_pagination' ) ) :
function understrap_pagination() {
	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**    Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/**    Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav aria-label="Page navigation"><ul class="pagination ">' . "\n";

	/**    Link to first page, plus ellipses if necessary */
	//if (  in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active page-item"' : ' class="page-item"';

		printf( '<li %s><a class="page-link" href="%s"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>' . "\n",
		$class, esc_url( get_pagenum_link( 1 ) ), '1' );

		/**    Previous Post Link */
		if ( get_previous_posts_link() ) {
			printf( '<li class="page-item"><span class="page-link">%1$s</span></li> ' . "\n",
			get_previous_posts_link( '<span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span><span class="sr-only">Previous page</span>' ) );
			
		}

		if ( ! in_array( 2, $links ) ) {
			echo '<li class="page-item"></li>';
		}
	//}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active page-item"' : ' class="page-item"';
		printf( '<li %s><a href="%s" class="page-link">%s</a></li>' . "\n", $class,
			esc_url( get_pagenum_link( $link ) ), $link );
	}

	// Next Post Link.
	if ( get_next_posts_link() ) {
		printf( '<li class="page-item"><span class="page-link">%s</span></li>' . "\n",
			get_next_posts_link( '<span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span><span class="sr-only">Next page</span>' ) );
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li class="page-item"></li>' . "\n";
		}

		$class = $paged == $max ? ' class="active "' : ' class="page-item"';
		printf( '<li %s><a class="page-link" href="%s" aria-label="Next"><span aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span><span class="sr-only">%s</span></a></li>' . "\n",
		$class . '', esc_url( get_pagenum_link( esc_html( $max ) ) ), esc_html( $max ) );
	}

	echo '</ul></nav>' . "\n";
	

	
}

endif;




function _tk_pagination() {
    global $paged, $wp_query;

    if (empty($paged)) {
        $paged = 1;
    }

    $pages = $wp_query->max_num_pages;
    if (!$pages) {
        $pages = 1;
    }

    if (1 != $pages):

        $input_width = strlen((string)$pages) + 3;
?>
<div class="text-center m-auto">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item disabled hidden-xs">
                <span class="page-link">
                    <span aria-hidden="true"><?php _e('Pagina', '_tk'); ?> <?php echo $paged; ?> <?php _e('de', '_tk'); ?> <?php echo $pages; ?></span>
                </span>
            </li>
            <li class="page-item hidden-xs"><a class="page-link" href="<?php echo get_pagenum_link(1); ?>" aria-label="First"><i class="fa fa-step-backward"></i></a></li>

            <?php if ($paged == 1): ?>
            <li class="page-item disabled"><a class="page-link" href="<?php echo get_pagenum_link($paged-1); ?>" aria-label="Previous"><i class="fa fa-chevron-left"></i></a></li>
            <?php else: ?>
                <li class="page-item hidden-xs"><a class="page-link" href="<?php echo get_pagenum_link($paged-1); ?>" aria-label="Previous"><i class="fa fa-chevron-left"></i></a></li>
            <?php endif; ?>

            <?php $start_page = min(max($paged - 2, 1), max($pages - 4, 1)); ?>
            <?php $end_page   = min(max($paged + 2, 5), $pages); ?>

            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <?php if ($paged == $i): ?>
                    <li class="active page-item"><span class="page-link"><?php echo $i; ?><span class="sr-only">(current)</span></span></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($paged == $pages): ?>
                <li class="disabled page-item"><span class="page-link"><span class="hidden-xs aria-hidden"><i class="fa fa-chevron-right"></i></span></span></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="<?php echo get_pagenum_link($paged+1); ?>" aria-label="Next"><span class="hidden-xs"><i class="fa fa-chevron-right"></i></span></a></li>
            <?php endif; ?>

            <li class="page-item"><a class="page-link" href="<?php echo get_pagenum_link($pages); ?>" aria-label='Last'><span class='hidden-xs'><i class="fa fa-step-forward" aria-hidden="true"></i> </span></a></li>
            
        </ul>
    </nav>
</div>
<?php
    endif;
}
