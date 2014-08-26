<?php
/**
 * Simple Catch Pro functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, simplecatch_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */


/**
 * Tell WordPress to run simplecatch_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'simplecatch_setup' );

if ( ! function_exists( 'simplecatch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses load_theme_textdomain() For localization support.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Simple Catch Pro 1.0
 */
function simplecatch_setup() {

	/* Simple Catch Pro is now available for translation.
	 * Add your files into /languages/ directory.
	 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	 */
	load_theme_textdomain( 'simplecatch', get_template_directory() . '/languages' );
	
	$locale = get_locale();
    $locale_file = get_template_directory().'/languages/$locale.php';
    if (is_readable( $locale_file))
		require_once( $locale_file);	

	// Load up theme options defaults
	require( get_template_directory() . '/functions/simplecatch_themeoptions_defaults.php' );
	
	// Load up our theme options page and related code.
	require( get_template_directory() . '/functions/panel/theme_options.php' );
	
	// Grab Simple Catch Pro's Custom Tags widgets.
	require( get_template_directory() . '/functions/widgets.php' );
	
	// Load up our Simple Catch Pro's Functions
	require( get_template_directory() . '/functions/simplecatch_functions.php' );
	
	// Load up our Simple Catch Pro's metabox
	require( get_template_directory() . '/functions/simplecatch_metabox.php' );
	
	/**
     * This feature enables Jetpack plugin Infinite Scroll
     */		
    add_theme_support( 'infinite-scroll', array(
		'type'          => 'click',										
        'container'     => 'primary',
		'render'    	=> 'simplecatch_infinite_scroll_render',
        'footer'        => 'page'
    ) );		
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );
	
	/* We'll be using post thumbnails for custom features images on posts under blog category.
	 * Larger images will be auto-cropped to fit.
	 */
	set_post_thumbnail_size( 210, 210 );
	
	// Add Simple Catch Pro's custom image sizes
	add_image_size( 'featured', 210, 210, true); // uses on homepage featured image
	add_image_size( 'slider', 976, 313, true); // uses on Featured Slider on Homepage Header
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' ); 
		
	// remove wordpress version from header for security concern
	remove_action( 'wp_head', 'wp_generator' );
 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'simplecatch' ) );
	
	// Add support for custom backgrounds	
	// WordPress 3.4+
	if ( function_exists( 'get_custom_header') ) {
		add_theme_support( 'custom-background' );
	} else {
		// Backward Compatibility for WordPress Version 3.3
		add_custom_background();
	}

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'video', 'audio' ) );
	
	/**
	 * Global content width.
	 */
	global $content_width, $simplecatch_options_settings;
	$options = $simplecatch_options_settings;
	$themeoption_layout = $options['sidebar_layout'];
	
	if ( $themeoption_layout != "no-sidebar-full-width" ) {
		$content_width = 642;
	}
	else {
		$content_width = 978;
	} 
	
	// Load the update notifier file.
	if ( $options[ 'disable_notifier' ] == '0' ) {
		require( get_template_directory() . '/functions/catchthemes-update-notifier.php' );	 
	}
	
	//Redirect to Theme Options Page on Activation
	global $pagenow;
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
		wp_redirect( 'themes.php?page=theme_options' );
	}	
	
} // simplecatch_setup
endif;


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/functions/custom-header.php' );


/**
 * Adds support for WooCommerce Plugin
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	/**
	 * Add Suport for WooCommerce Plugin
	 */
	add_theme_support( 'woocommerce' );	
	
	require( get_template_directory() . '/functions/simplecatch-woocommerce.php' );
	
}