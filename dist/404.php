<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();
?>
<div class="wrapper" id="404-wrapper">

	<div class="container" id="content">

		<div class="row">

			<div class="content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( 'Oops! No se puede encontrar esa página.',
							'understrap' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php esc_html_e( 'Parece que no se encontró nada en este lugar. Pruebe uno de los siguientes enlaces o tal vez ¿una búsqueda?',
							'understrap' ); ?></p>

							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php if ( understrap_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

								<div class="widget widget_categories">

									<h2 class="widget-title"><?php esc_html_e( 'Categorias más populares', 'understrap' ); ?></h2>

									<ul>
										<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
										?>
									</ul>

								</div><!-- .widget -->

							<?php endif; ?>

							<?php
							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( __( 'Trate de buscar en los archivos mensuales. %1$s',
							'understrap' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
