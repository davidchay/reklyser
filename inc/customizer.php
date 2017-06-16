<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		/**
		* Custom Customizer Customizations
		*/
		// create header background color setting
		$wp_customize->add_setting('primary_color', array(
			'default' => '#3D9398',
			'type'	=> 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));

		//Add control
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color', array(
					'label' => _('Color primario',  'understrap'),
					'description' => __( "Selecciona el color primario. Sugerencias. #3D9398 - #C71910 - #9B9A98 - ", 'understrap' ),
					'section' => 'colors'
				)
			)
		);
	

	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'understrap_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'understrap' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'understrap_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => '10',
				)
			) );

		$wp_customize->add_setting( 'understrap_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'understrap' ),
					'description' => __( "Set sidebar's default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.",
					'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'    => '20',
				)
			) );

	}
} // endif function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script( 'understrap_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );

//darken and lighten color php
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}
// function conver hex to rgb
function hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        //return array( 'red' => $r, 'green' => $g, 'blue' => $b );
		return $r.','.$g.','.$b;
} 
// injectar CSS desde customizer
function understrap_customizer_css(){
	$primary_color= get_theme_mod('primary_color');
	$primary_color_light=colourBrightness($primary_color,0.80);
	$primary_color_rgb = hex2rgb( $primary_color );
	//var_dump($primary_color_rgb);
	?>
	<style type="text/css">
	a{
		color:<?php echo $primary_color; ?>;
	}
	a:focus, a:hover{
		color:<?php echo $primary_color_light; ?>;
	}
	.btn-primary{
		background:<?php echo $primary_color; ?>;
		border-color:<?php echo $primary_color; ?>;
	}
	.btn-primary:hover{
		background:<?php echo $primary_color_light; ?>;
		border-color:<?php echo $primary_color_light; ?>;
	}
	.form-control:focus,
	.form-control:active{
		border-color:<?php echo $primary_color_light; ?>;
	}
	.contact-head{
		border-bottom-color:<?php echo $primary_color; ?>;
	}
	.contact-head .content-header-info .box-header-info .box-icon{
		color:<?php echo $primary_color; ?>;
	}
	.contact-head .header-social a{
		color:<?php echo $primary_color; ?>;
	}
	.contact-head .header-social a:hover{
		color:<?php echo $primary_color_light; ?>;
	}
	
	.navbar-collapse .navbar-nav .menu-item .nav-link:hover:after, 
	.navbar-collapse .navbar-nav .menu-item.active .nav-link:after{
		border:1px solid <?php echo $primary_color; ?>;
	}

	.blog .page-header .separator, 
	.page .page-header .separator{
		border-color:<?php echo $primary_color; ?>;
	}
	.blog .page-header .separator .inner, 
	.page .page-header .separator .inner{
		background:<?php echo $primary_color; ?>;
	}
	.post .thumbnail-post a{
		background:rgba(<?php echo $primary_color_rgb;  ?>,.5);
	}

	
	.post .content-post-wrapper .entry-meta .posted-on time{
		background:<?php echo $primary_color; ?>;
	}
	.post .content-post-wrapper .entry-meta .entry_comment{
		color:<?php echo $primary_color; ?>;
	}
	.page-item.active .page-link,
	.page-item .page-link:hover{
		background-color:<?php echo $primary_color; ?>;
		border-color:<?php echo $primary_color; ?>;
	}
	.widget-area #recentcomments ul li a:hover, 
	.widget-area #recentcomments ul li span:hover, 
	.widget-area .widget ul li a:hover, 
	.widget-area .widget ul li span:hover{
		color:<?php echo $primary_color; ?>;
	}
	.nav-links .nav-next a, 
	.nav-links .nav-previous a{
		outline: 1px solid <?php echo $primary_color; ?>
	}
	.nav-links .nav-next a:hover, 
	.nav-links .nav-previous a:hover{
		background: <?php echo $primary_color; ?>
	}
	</style>
	<?php
}
add_action('wp_head','understrap_customizer_css');