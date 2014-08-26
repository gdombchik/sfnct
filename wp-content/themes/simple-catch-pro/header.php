<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="primary">
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/** 
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<body <?php body_class(); ?>>

<?php 
/** 
 * simplecatch_before hook
 */
do_action( 'simplecatch_before' );
?>

<?php do_action( 'simplecatch_before_header' ); ?>

<header id="branding">

	<div class="top-bg"></div>
    
    <div class="wrapper clearfix">
    	<?php 
		/** 
		 * simplecatch_before_headercontent hook
		 */
		do_action( 'simplecatch_before_headercontent' );
		?>
    
    	<div id="header-content" class="clearfix">
			<?php 
                /** 
                 * simplecatch_before_sidebartop hook
                 *
                 * @hooked simplecatch_headerdetails - 10
                 */
                do_action( 'simplecatch_before_sidebartop' );
            ?>
              
            <?php get_sidebar( 'sidebartop' );  ?>        
            
 			<?php 
                /** 
                 * simplecatch_after_sidebartop hook
				 *
                 */
                do_action( 'simplecatch_after_sidebartop' );
            ?>           
                        
      	</div> <!-- #header-content -->
 
    	<?php 
		/** 
		 * simplecatch_after_headercontent hook
		 *
		 * @hooked simplecatch_custom_header_image - 10
         * @hooked simplecatch_menu - 15
		 * @hooked simplecatch_slider_display - 20
		 * @hooked simplecatch_breadcrumb_display - 25
		 */
		do_action( 'simplecatch_after_headercontent' );
		?>        
        
    </div><!-- .wrapper-->
    
    <div class="bottom-bg"></div>
    
</header><!-- #branding -->

<?php do_action( 'simplecatch_after_header' ); ?>

<?php 
/** 
 * simplecatch_before_main hook
 */
do_action( 'simplecatch_before_main' ); 
?>

<div id="main" class="wrapper clearfix">

	<?php
    /** 
     * simplecatch_above_primary hook
     */
    do_action( 'simplecatch_above_primary' ); 
    ?>

	<div id="primary">