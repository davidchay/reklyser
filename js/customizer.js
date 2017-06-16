
/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @see https://codex.wordpress.org/Theme_Customization_API#Part_3:_Configure_Live_Preview_.28Optional.29
 */
( function( $ ) {
    // Update the site title in real time...
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            console.log(newval);
            $( '.navbar-header a' ).html( newval );
        } );
    } );
    // Custom Header Background Color
	wp.customize( 'primary_color', function( value ) {
		var chg_color_ele=".contact-head .content-header-info .box-header-info .box-icon"; 
        chg_color_ele+=", .contact-head .header-social a";
        chg_color_ele+=",.post .content-post-wrapper .entry-meta .entry_comment";
        chg_color_ele+=", .widget-area #recentcomments ul li a:hover, .widget-area #recentcomments ul li span:hover, .widget-area .widget ul li a:hover, .widget-area .widget ul li span:hover";

        var chg_bg_ele=".btn-primary,.blog .page-header .separator .inner"; 
	        chg_bg_ele+=",.page .page-header .separator .inner";
            chg_bg_ele+=",.post .content-post-wrapper .entry-meta .posted-on time";
            chg_bg_ele+=",.page-item.active .page-link";
	        chg_bg_ele+=",.page-item .page-link:hover";

        var chg_bcolor_ele=".btn-primary,.btn-primary:hover,.form-control:focus,.form-control:active";
            chg_bcolor_ele+=",.blog .page-header .separator,.page .page-header .separator";
            chg_bcolor_ele+=",.page-item.active .page-link,.page-item .page-link:hover";

        var chg_navlink_border=".navbar-collapse .navbar-nav .active .nav-link::after";
        
        value.bind( function( to ) {
             $( '.contact-head' ).css( {
				'border-bottom-color': to 
			});

            $( chg_color_ele ).css( {
				'color': to 
			});

            $( chg_bg_ele ).css( {
				'background': to 
			});

            $( chg_bcolor_ele ).css( {
				'border-color': to 
			});
            $( chg_navlink_border ).css( {
				'border' : '1px solid' + to +"!important"
			});
            
            console.log(chg_navlink_border);
            console.log({'border' : '1px solid' + to })
		} );
	} );
} )( jQuery );
