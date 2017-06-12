<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">
	<section>
		<header class="page-header" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>);">
			<div class="container">
	    	<div class="row">
					<div class="col-12">
								<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
								<?php if(function_exists('pietergoosen_breadcrumbs')) 	pietergoosen_breadcrumbs(); ?>
								<span class="separator">
									<span class="inner"></span>
								</span>
	        </div> <!-- content-header-post  -->
	    	</div><!-- .row -->
			</div><!-- .container -->
		</header><!-- .entry-header -->
	</section>
	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page-fullwidth' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :

							comments_template();

						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
