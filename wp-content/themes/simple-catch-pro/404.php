<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
get_header(); ?>

	<section class="error-404">
    	<header class="entry-header">
        	<h1 class="entry-title"><?php _e( 'Error 404 - Page Not Found.', 'simplecatch' ); ?></h1>
       	</header>
        <div class="entry-content clearfix">
            <p><?php _e( 'We&rsquo;re sorry! This page is not available.', 'simplecatch' ); ?></p>
            <h4><?php _e( 'This might be because:', 'simplecatch' ); ?></h4>
            <p><?php _e( 'You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'simplecatch' ); ?></p>
            <h4><?php _e( 'Please try the following options instead:', 'simplecatch' ); ?></h4>
            <p><?php _e( 'Check for a mis-typed URL error, then press the refresh button on your browser or Use the search box below.', 'simplecatch' ); ?></p>
            <?php  
            // get search form
            get_search_form();
            ?>
      	</div>
	</section>
    
</div><!-- #primary -->

<?php
/** 
 * simplecatch_below_primary hook
 */
do_action( 'simplecatch_below_primary' ); 
?>
    
<?php get_footer(); ?>