<?php
/**
 * The template used for displaying hero content
 *
 * @package Reklyser
 */
?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="reklyser-hero">
		<?php the_post_thumbnail( 'reklyser-hero' ); ?>
	</div>
<?php endif; ?>
