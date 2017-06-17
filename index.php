<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero', 'none' ); ?>
<?php endif; ?>

<div class="wrapper" id="wrapper-index">
<?php
	if(is_home()):
		$cover_image = get_option( 'image_cover_header' );
		$bg_cover 	 = get_theme_mod('background_cover_header');

		$style='';
		if(!empty($cover_image)){
			$style="background-image:url(".$cover_image.");";
		}
		if(!empty($bg_cover)){
			$style.="background-color:#".$bg_cover.";";
		}
?>
	<section>
		<header class="page-header" style="<?php echo $style; ?>">
			<div class="container">
	    	<div class="row">
					<div class="col-12">
								<h1>Blog</h1>
								<div class="breadcrumb">
									<a href="http://localhost/wordpress" rel="v:url" property="v:title">Inicio</a>
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<span class="active">Blog</span>
								</div>
								<span class="separator">
									<span class="inner"></span>
								</span>
	        </div> <!-- content-header-post  -->
	    	</div><!-- .row -->
			</div><!-- .container -->
		</header><!-- .entry-header -->
	</section>
<?php endif; ?>
	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php _tk_pagination(); ?>
		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
