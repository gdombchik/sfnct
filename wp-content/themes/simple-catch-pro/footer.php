<?php
/**
 * The template for displaying the footer.
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
?>

</div> <!-- #main -->
<?php 
/** 
 * catchthemes_after_main hook
 */
do_action( 'simplecatch_after_main' ); 
?>

<footer id="colophon">
 
       <?php 
       /** 
         * simplecatch_footer hook
         *
         * @hooked simplecatch_footercontent - 15
         */
       do_action( 'simplecatch_footer' ); ?> 

</footer><!-- #colophon -->  

<?php 
/** 
 * simplecatch_after hook
 */
do_action( 'simplecatch_after' );
?>
    
<?php wp_footer(); ?>

</body>
</html>