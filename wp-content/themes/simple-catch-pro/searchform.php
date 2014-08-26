<?php
/**
 * The template for displaying search forms in Simple Catch Pro
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
global $simplecatch_options_settings;
$options = $simplecatch_options_settings;

$simplecatch_search_display_text = $options[ 'search_display_text' ];
$simplecatch_search_button_text = $options[ 'search_button_text' ];
?>
    <form method="get" class="searchform clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<div class="search-box">
    		<input type="text" class="search" value="<?php echo esc_attr( $simplecatch_search_display_text ); ?>" name="s" id="s" title="<?php echo esc_attr( $simplecatch_search_display_text ); ?>" />
       	</div>
        <button><?php printf( __( '%s', 'simplecatch' ), esc_attr( $simplecatch_search_button_text ) ); ?></button>
    </form>