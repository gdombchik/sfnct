<?php
/**
 * The Footer widget areas.
 *
 * @package Catch Themes
 * @subpackage Catch_Responsive
 * @since Catch Responsive 1.0
 */
// Getting data from Theme Options
global $simplecatch_options_settings;
$options = $simplecatch_options_settings;

if ( $options[ 'disable_header_right_sidebar' ] == "0" ) {	?>
	<div id="sidebar-top" class="clearfix widget-area">
		<?php if ( is_active_sidebar( 'sidebartop' ) ) :
        	dynamic_sidebar( 'sidebartop' ); 
		else : ?>
        	<?php if ( function_exists( 'simplecatch_headersocialnetworks' ) ) { ?>
                <aside class="widget widget_simplecatch_social_widget">
                    <?php simplecatch_headersocialnetworks(); ?>
                </aside>
            <?php
            } ?>
            <aside class="widget widget_search" id="search-header-right">	
            	<?php echo get_search_form(); ?>
			</aside>
		<?php endif; ?>
    </div><!-- #sidebar-top .widget-area -->
<?php 
}?>