<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
 ?>

<?php 
/** 
 * simplecatch_above_secondary hook
 */
do_action( 'simplecatch_above_secondary' );
?>
 
	<?php
	//Getting Ready to load data from Theme Options Panel
	global $post, $wp_query, $simplecatch_options_settings;
	$options = $simplecatch_options_settings;
	$themeoption_layout = $options['sidebar_layout'];	
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();		
	
	if( $post) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'simplecatch-sidebarlayout', true );
			$sidebaroptions = get_post_meta( $parent, 'simplecatch-sidebar-options', true );
		} else {
			$layout = get_post_meta( $post->ID,'simplecatch-sidebarlayout', true ); 
			$sidebaroptions = get_post_meta( $post->ID, 'simplecatch-sidebar-options', true );
		}
	}
	
	if( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout = 'default';
		$parent = '';
		$sidebaroptions  = '';
	}
	
	if ( ( $layout == 'left-sidebar' || $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar') || ( $layout=='default' && $themeoption_layout == 'right-sidebar') ) ) {
    	echo '<div id="secondary">';
		
		/** 
		 * simplecatch_before_widget_start hook
		 */
		do_action( 'simplecatch_before_widget_start' );		
		
		if ( is_active_sidebar( 'homepage-sidebar' ) && ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) ) {
			dynamic_sidebar( 'homepage-sidebar' ); 
		}
		elseif ( ( is_archive() || ( is_home() && $page_for_posts == $page_id ) ) && is_active_sidebar( 'archive-sidebar' ) ) {
			dynamic_sidebar( 'archive-sidebar' ); 
		}				
		elseif ( is_active_sidebar( 'optional-sidebar-one' ) && $sidebaroptions == 'optional-sidebar-one' ) {
            dynamic_sidebar( 'optional-sidebar-one' ); 
        }
		elseif ( is_active_sidebar( 'optional-sidebar-two' ) && $sidebaroptions == 'optional-sidebar-two' ) {
            dynamic_sidebar( 'optional-sidebar-two' ); 
        }
		elseif ( is_active_sidebar( 'optional-sidebar-three' ) && $sidebaroptions == 'optional-sidebar-three' ) {
            dynamic_sidebar( 'optional-sidebar-three' ); 
        }	
		elseif ( is_page_template( 'page-blog.php' ) && is_active_sidebar( 'archive-sidebar' ) ) {
			dynamic_sidebar( 'archive-sidebar' ); 
		}			
		elseif ( is_page() && is_active_sidebar( 'page-sidebar' ) ) {
            dynamic_sidebar( 'page-sidebar' ); 
        }	
		elseif ( is_single() && is_active_sidebar( 'post-sidebar' ) ) {
            dynamic_sidebar( 'post-sidebar' ); 
        }			
		elseif ( is_active_sidebar( 'sidebar' ) ) {
            dynamic_sidebar( 'sidebar' ); 
       	}	
		else { ?>
			<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
			</aside>
		
			<aside id="archives" class="widget">
                <h1 class="widget-title"><?php _e( 'Archives', 'simplecatch' ); ?></h1>
                <ul>
                    <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                </ul>
            </aside>	
		<?php }
		
		/** 
		 * simplecatch_after_widget_ends hook
		 */
		do_action( 'simplecatch_after_widget_ends' ); 	
		
		echo '</div><!-- #secondary -->';
	}
	?>

<?php 
/** 
 * simplecatch_below_secondary hook
 */
do_action( 'simplecatch_below_secondary' );
?>    
