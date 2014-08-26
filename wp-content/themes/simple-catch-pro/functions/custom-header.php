<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Catch Themes
 * @subpackage Simple Catch Pro
 * @since Catch Catch Pro 3.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses simplecatch_header_style()
 * @uses simplecatch_admin_header_style()
 * @uses simplecatch_admin_header_image()
 *
 * @package Simple Catch Pro
 */
function simplecatch_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '444',
		
		// Set height and width, with a maximum value for the width.
		'height'                 => 200,
		'width'                  => 978,
		
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
			
		// Random image rotation off by default.
		'random-default'         => false,	
			
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'simplecatch_header_style',
		'admin-head-callback'    => 'simplecatch_admin_header_style',
		'admin-preview-callback' => 'simplecatch_admin_header_image',
	);

	$args = apply_filters( 'simplecatch_custom_header_args', $args );
	
	/*
	 * This theme supports custom header for logo
	 * 
	 */	
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'simplecatch_custom_header_setup' );


if ( ! function_exists( 'simplecatch_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Simple Catch 2.7
 */
function simplecatch_header_style() {

	$text_color = get_header_textcolor();
	
	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-details {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php 
	
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // simplecatch_header_style


if ( ! function_exists( 'simplecatch_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Simple Catch 2.7
 */
function simplecatch_admin_header_style() {
	
			$color = get_header_textcolor();
?>
	<style type="text/css">
		/* Logo Tile */
		#header .logo-wrap {
			padding-left:20px;
			float:left;
			margin-top:54px;
			min-width: 610px;
		}
		#site-logo {
			display: inline-block;
			float: left;
			margin: 0;
			padding-bottom: 0;
		}
		#site-logo a img {
			float: left;
			height: auto;
			max-width: 958px;
			padding-right: 20px;
		}
		#site-details {
			display: inline-block;
			float: left;
			max-width: 958px;
			padding-right: 20px;
		}
		#site-title {
			font-size: 45px;
			font-family: 'Lobster';
			font-weight: normal;
			line-height: 54px;
			margin: 0;
			padding-bottom:0px;
		}
		#site-title a {
			color: #444444;
			text-decoration: none;
		}
		#site-title a:hover {
			color: #444444;
		}
		#site-description {
			font:14px Arial, Helvetica, sans-serif;
			color:#666;
			padding:8px 0 0 0;
		}
		<?php
		$text_color = get_header_textcolor();
		// Has the text been hidden?
		if ( 'blank' == $text_color ) : ?>
			#site-details {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php elseif ( $text_color != HEADER_TEXTCOLOR ) : ?>
			#site-title a,
			#site-description {
				color: #<?php echo get_header_textcolor(); ?>;
			}
		<?php endif; ?>

		.appearance_page_custom-header #headimg {
			border: none;
			clear: both;
			overflow: hidden;
			width: 70%;
		}
		#headimg img {
			height: auto;
			padding-top: 20px;
			max-width: 100%;
		}
	</style>
<?php
}
endif; // simplecatch_admin_header_style


if ( ! function_exists( 'simplecatch_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
*
 * @since Simple Catch 2.7
 */
function simplecatch_admin_header_image() { 

	if ( function_exists( 'simplecatch_headerdetails' ) ):
		simplecatch_headerdetails();
	endif;

	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
        <div id="headimg">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php echo esc_url( $header_image ); ?>" alt="" />
            </a>
        </div><!-- #headimg -->
	<?php endif;
}
endif; // simplecatch_admin_header_image


if ( ! function_exists( 'simplecatch_custom_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Simple Catch 2.7
 */
function simplecatch_custom_header_image() { 
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
        <div id="headimg">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php echo esc_url( $header_image ); ?>" alt="" />
            </a>
        </div><!-- #headimg -->
	<?php endif;

}
endif; // simplecatch_custom_header_image

add_action( 'simplecatch_after_headercontent', 'simplecatch_custom_header_image', 10 );