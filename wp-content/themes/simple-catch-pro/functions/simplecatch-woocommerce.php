<?php
/**
 * Adding support for WooCommerce Plugin
 * 
 * uses remove_action to remove the WooCommerce Wrapper and add_action to add Simple Catch Wrapper
 *
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'simplecatch_child_woocommerce_start', 15);
function simplecatch_child_woocommerce_start() {
	echo '<section class="page woocommerce">';
}

add_action('woocommerce_after_main_content', 'simplecatch_child_woocommerce_end', 15);
function simplecatch_child_woocommerce_end() {
	echo '</section></div>';
}

//Remove the WooCommerce Sidebar
//remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);