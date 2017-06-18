<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );

$address1 = get_theme_mod( 'address_info_header' );
$address2 = get_theme_mod( 'address2_info_header' );
$tel1 = get_theme_mod( 'tel_info_header' );
$tel2 = get_theme_mod( 'tel2_info_header' );
$hor1 = get_theme_mod( 'horario_info_header' );
$hor2 = get_theme_mod( 'horario2_info_header' );
$fcb = get_theme_mod( 'fcb_info_header' );
$email = get_theme_mod( 'email_info_header' );

$contactinfo=$address1.$address2.$tel1.$tel2.$hor1.$hor2.$fcb.$email;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
		'understrap' ); ?></a>

		<div class="hidden-md-up">
			<?php if ( ! has_custom_logo() ) { ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<a class="" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			<?php } else {
				the_custom_logo();
			} ?><!-- end custom logo -->


		</div>


		<?php if(!empty($contactinfo)): ?>
		<div class="contact-head">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-md-8">
						<div class="row no-gutters content-header-info">
							<?php if(!empty($address1) || !empty($address2)): ?>					
							<div class="box-header-info col-12 col-md-4">
								<div class="box-icon">
									<i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
								</div>
								<div class="box-content">
									<?php echo $address1; ?>
									<span><?php echo $address2; ?></span>
								</div>
							</div>
							<?php endif; ?>
							<?php if(!empty($tel1) || !empty($tel2)): ?>
							<div class="box-header-info col-12 col-md-4">
								<div class="box-icon">
									<i class="fa fa-phone fa-2x" aria-hidden="true"></i>
								</div>
								<div class="box-content">
									<?php echo $tel1; ?>
									<span><?php echo $tel2; ?></span>
								</div>
							</div>
							<?php endif; ?>
							<?php if(!empty($hor1) || !empty($hor2)): ?>
							<div class="box-header-info col-12 col-md-4">
								<div class="box-icon">
									<i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>
								</div>
								<div class="box-content">
									<?php echo $hor1; ?>
									<span><?php echo $hor2; ?></span>
								</div>
							</div>
							<?php endif; ?>
						</div><!-- ./row -->
					</div>
					<div class="col-12 col-md-4 text-center text-md-right">
						<div class="row header-social">
							<?php 
							if(!empty($fcb) && !empty($email)) {
								$classFace="col-6 col-lg-3 offset-lg-6";
								$classMail="col-6 col-lg-3";
							}elseif(empty($fcb) && !empty($email)){
								$classFace="hidden-xl-down";
								$classMail="col-12 col-lg-3 offset-lg-9";
							}elseif(!empty($fcb) && empty($email)){
								$classFace="col-12 col-lg-3 offset-lg-9";
								$classMail="hidden-xl-down";
							}elseif(empty($fcb) && empty($email)){
								$classFace="hidden-xl-down";
								$classMail="hidden-xl-down";
							}

							
							?>
							<div class="<?php echo $classFace; ?>">
								<a href="<?php echo $fcb; ?>" target="_blank">
									<i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i>
								</a>
							</div>
							<div class="<?php echo $classMail; ?>">
								<a href="mailto:<?php echo $email; ?>">
									<i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>
								</a>
							</div>
							
						</div><!-- ./row -->
					</div>
				</div><!-- ./row -->
			</div>

		</div>
		<?php endif; ?>
		<nav class="navbar navbar-toggleable-md  navbar-light" style="background-color:#FFF;">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>


		<div class="hidden-sm-down">
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->
				</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				); ?>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- .wrapper-navbar end -->
