<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$cover_image = get_option( 'image_cover_header' );
$bg_cover 	 = get_theme_mod('background_cover_header');
if(has_post_thumbnail())
	$cover_image = get_the_post_thumbnail_url( $post->ID, 'full' );

$style='';
if(!empty($cover_image)){
	$style="background-image:url(".$cover_image.");";
}
if(!empty($bg_cover)){
	$style.="background-color:#".$bg_cover.";";
}
?>

<div class="wrapper" id="page-wrapper">
	<section>
		<header class="page-header" style="<?php echo $style; ?>">
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

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar( 'right' ); ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
