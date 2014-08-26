<?php
if ( ! function_exists( 'simplecatch_register_styles' ) ) :
/**
 * Register theme styles
 *
 * Registers stylesheets used by the theme.
 * Also offers integration with Google Web Fonts Directory
 * @uses wp_register_style() To register styles
 *
 * @since Catch Box Pro 1.0.
 */
function simplecatch_register_styles() {
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
	
	$fontbody = $options[ 'body_font' ];
	$fonttitle = $options[ 'title_font' ];
	$fonttagline = $options[ 'tagline_font' ];
	$fontheading = $options[ 'headings_font' ];
	$fontcontent = $options[ 'content_font' ];
	
	$web_fonts = array(
		'allan'					=> 'Allan',
		'allerta'				=> 'Allerta',
		'amaranth'				=> 'Amaranth',
		'bitter'				=> 'Bitter',
		'cabin'					=> 'Cabin',
		'cantarell'				=> 'Cantarell',
		'crimson-text'			=> 'Crimson+Text',
		'dancing-script'		=> 'Dancing+Script',
		'droid-sans'			=> 'Droid+Sans',
		'droid-serif'			=> 'Droid+Serif',
		'istok-web'				=> 'Istok+Web',
		'lato'					=> 'Lato',
		'lobster'				=> 'Lobster',
		'lora'					=> 'Lora',
		'nobile'				=> 'Nobile',
		'open-sans'				=> 'Open+Sans',
		'oswald'				=> 'Oswald',
		'patua-one'				=> 'Patua+One',
		'playfair-display'		=> 'Playfair+Display',
		'pt-sans'				=> 'PT+Sans',
		'pt-serif'				=> 'PT+Serif',
		'quattrocento-sans' 	=> 'Quattrocento+Sans',
		'ubuntu'				=> 'Ubuntu',
		'yanone-kaffeesatz' 	=> 'Yanone+Kaffeesatz'
	);	
	
	if ( empty( $options[ 'reset_typography' ] )  && ( array_key_exists( $fontbody, $web_fonts ) || array_key_exists( $fonttitle, $web_fonts ) || array_key_exists( $fonttagline, $web_fonts ) || array_key_exists( $fontheading, $web_fonts ) || array_key_exists( $fontcontent, $web_fonts ) ) ) {		
		
		$web_fonts_stylesheet = 'http' . ( is_ssl() ? 's' : '' ) . '://fonts.googleapis.com/css?family=';		
		
		if( array_key_exists( $fontbody, $web_fonts ) ) {
			$web_fonts_stylesheet .= $web_fonts[$fontbody] . ':300,300italic,regular,italic,600,600italic';
		}
		
		if( array_key_exists( $fonttitle, $web_fonts ) ) {
			if( array_key_exists( $fontbody, $web_fonts ) ) {
				$web_fonts_stylesheet .='|';
			}
			$web_fonts_stylesheet .= $web_fonts[$fonttitle] . ':300,300italic,regular,italic,600,600italic';
		}
		
		if( array_key_exists( $fonttagline, $web_fonts ) ) {
			if( array_key_exists( $fontbody, $web_fonts ) || array_key_exists( $fonttitle, $web_fonts ) ) {
				$web_fonts_stylesheet .='|';
			}
			$web_fonts_stylesheet .= $web_fonts[$fonttagline] . ':300,300italic,regular,italic,600,600italic';
		}
		
		if( array_key_exists( $fontheading, $web_fonts ) ) {
			if( array_key_exists( $fontbody, $web_fonts ) || array_key_exists( $fonttitle, $web_fonts ) || array_key_exists( $fonttagline, $web_fonts ) ) {
				$web_fonts_stylesheet .='|';
			}
			$web_fonts_stylesheet .= $web_fonts[$fontheading] . ':300,300italic,regular,italic,600,600italic';
		}
		
		if( array_key_exists( $fontcontent, $web_fonts ) ) {
			if( array_key_exists( $fontbody, $web_fonts ) || array_key_exists( $fonttitle, $web_fonts ) || array_key_exists( $fonttagline, $web_fonts ) || array_key_exists( $fontheading, $web_fonts ) ) {
				$web_fonts_stylesheet .='|';
			}
			$web_fonts_stylesheet .= $web_fonts[$fontcontent] . ':300,300italic,regular,italic,600,600italic';
		}

		$web_fonts_stylesheet .= '&subset=latin';
		
	} 
	else {
		$web_fonts_stylesheet = 'http' . ( is_ssl() ? 's' : '' ) . '://fonts.googleapis.com/css?family=';
		$web_fonts_stylesheet .= 'Lobster:300,300italic,regular,italic,600,600italic&#038;subset=latin';
	}
	wp_register_style( 'simplecatch-web-font', $web_fonts_stylesheet, false, null );
	
	wp_register_style( 'simplecatch', get_stylesheet_uri(), array( 'simplecatch-web-font' ), null );
	
} // simplecatch_register_styles
endif;
add_action( 'init', 'simplecatch_register_styles' );


if ( ! function_exists( 'simplecatch_scripts_method' ) ) :
/**
 * Register jquery scripts
 *
 * @register jquery cycle and custom-script
 * hooks action wp_enqueue_scripts
 */
function simplecatch_scripts_method() {	
	global $post, $wp_query, $simplecatch_options_settings;
   
   	// Get value from Theme Options Panel
	$options = $simplecatch_options_settings;
	$enableslider = $options[ 'enable_slider' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 
	
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	
	/**
	 * Loads up main stylesheet.
	 */
	wp_enqueue_style( 'simplecatch' );	
	
	/**
	 * Loads up Color Scheme
	 */
	$color_scheme = $options['color_scheme'];
	if ( 'dark' == $color_scheme ) {
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/css/dark.css', array(), null );	
	}
	elseif ( 'brown' == $color_scheme ) {
		wp_enqueue_style( 'brown', get_template_directory_uri() . '/css/brown.css', array(), null );	
	}	
		
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
	
	//Register JQuery circle all and JQuery set up as dependent on Jquery-cycle
	wp_register_script( 'jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );
		

	/**
	 * Adds Slider JavaScript to the page setup with slider only
	 */
	if ( ( $enableslider == 'enable-slider-allpage' ) || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enableslider == 'enable-slider-homepage' ) ) {
		wp_enqueue_script( 'simplecatch_slider', get_template_directory_uri() . '/js/simplecatch_slider.js', array( 'jquery-cycle' ), '1.0', true );
	}
	
	//Enqueue Search Script
	wp_enqueue_script ( 'simplecatch_search', get_template_directory_uri() . '/js/simplecatch_search.js', array( 'jquery' ), '1.0', true );
	
	//Responsive Menu and Style
	if ( $options[ 'disable_responsive' ] == '0' ) {
		wp_enqueue_style( 'simplecatch-responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_script('simplecatch-menu', get_template_directory_uri() . '/js/simplecatch-menu.min.js', array('jquery'), '20130324', true);
		wp_enqueue_script( 'simplecatch-fitvids', get_template_directory_uri() . '/js/simplecatch-fitvids.min.js', array( 'jquery' ), '20130324', true );
	}

	//Browser Specific Enqueue Script i.e. for IE 1-6
	$simplecatch_ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-6]/',$simplecatch_ua)) {
		wp_enqueue_script( 'pngfix', get_template_directory_uri() . '/js/pngfix.min.js' );	  
	}
	 if(preg_match('/(?i)msie [1-8]/',$simplecatch_ua)) {
		wp_enqueue_script( 'catchthemes-html5', get_template_directory_uri() . '/js/html5.min.js' );
		wp_enqueue_script( 'pie', get_template_directory_uri() . '/js/pie.js' );
		wp_enqueue_script( 'pie-setup', get_template_directory_uri() . '/js/pie-setup.js' );
	}
	
} // simplecatch_scripts_method
endif;
add_action( 'wp_enqueue_scripts', 'simplecatch_scripts_method' );


// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function simplecatch_add_menuclass($ulclass) {
	return preg_replace('/<ul>/', '<ul class="menu">', $ulclass, 1);
}
add_filter('wp_page_menu','simplecatch_add_menuclass');


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function catchbox_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'catchbox_page_menu_args' );


/**
 * Register script for admin section
 *
 * No scripts should be enqueued within this function.
 * jquery cookie used for remembering admin tabs, and potential future features... so let's register it early
 * @uses wp_register_script
 * @action admin_enqueue_scripts
 */
function simplecatch_register_js() {
	//jQuery Cookie
	wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.min.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'simplecatch_register_js' );


/**
 * Responsive Layout
 *
 * @get the data value of responsive layout from theme options
 * @display responsive meta tag 
 * @action wp_head
 */
function simplecatch_responsive() {
	//delete_transient( 'simplecatch_responsive' );	
	
	if ( !$simplecatch_responsive = get_transient( 'simplecatch_responsive' ) ) {
		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;

		if ( $options[ 'disable_responsive' ] == '0' ) {
			$simplecatch_responsive = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
		}
		else {
			$simplecatch_responsive = '<!-- Disable Responsive -->';
		}
		set_transient( 'simplecatch_responsive', $simplecatch_responsive, 86940 );										  
	}
	echo $simplecatch_responsive;
} // simplecatch_responsive
add_filter( 'wp_head', 'simplecatch_responsive', 1 );


if ( ! function_exists( 'simplecatch_wp_title' ) ) :
/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function simplecatch_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'simplecatch' ), max( $paged, $page ) );

	return $title;
}  // simplecatch_wp_title
endif;

add_filter( 'wp_title', 'simplecatch_wp_title', 10, 2 );


/**
 * Sets the post excerpt length to 30 words.
 *
 * function tied to the excerpt_length filter hook.
 * @uses filter excerpt_length
 */
function simplecatch_excerpt_length( $length ) {
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	return $options[ 'excerpt_length' ];
}
add_filter( 'excerpt_length', 'simplecatch_excerpt_length' );


/**
 * Returns a "Continue Reading" link for excerpts
 */
function simplecatch_continue_reading() {
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
    
	$more_tag_text = $options[ 'more_tag_text' ];
	return ' <a class="readmore" href="'. esc_url( get_permalink() ) . '">' . sprintf( __( '%s', 'simplecatch' ), esc_attr( $more_tag_text ) ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with simplecatch_continue_reading().
 *
 */
function simplecatch_excerpt_more( $more ) {
	return ' &hellip;' . simplecatch_continue_reading();
}
add_filter( 'excerpt_more', 'simplecatch_excerpt_more' );


/**
 * Adds Continue Reading link to post excerpts.
 *
 * function tied to the get_the_excerpt filter hook.
 */
function simplecatch_custom_excerpt( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= simplecatch_continue_reading();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'simplecatch_custom_excerpt' );


if ( ! function_exists( 'simplecatch_header_logo' ) ) :
/**
 * Get the header logo Image from theme options
 *
 * @uses header logo 
 * @get the data value of image from theme options
 * @display Header Image logo
 *
 * @uses default logo if logo field on theme options is empty
 *
 * @uses set_transient and delete_transient 
 */
function simplecatch_header_logo() {
	//delete_transient( 'simplecatch_header_logo' );	

	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;	
		
	if ( ( !$simplecatch_header_logo = get_transient( 'simplecatch_header_logo' ) ) && !empty( $options[ 'featured_logo_header' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_header_logo = '';

		if( empty( $options[ 'remove_header_logo' ] ) ) {
			
			$simplecatch_header_logo .= '<h1 id="site-logo">'.'<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">';
				if ( !empty( $options[ 'featured_logo_header' ] ) ):
					$simplecatch_header_logo .= '<img src="'.esc_url( $options['featured_logo_header'] ).'" alt="'.get_bloginfo( 'name' ).'" />';
				else:
					// if empty featured_logo_header on theme options, display default logo
					$simplecatch_header_logo .='<img src="'. get_template_directory_uri().'/images/logo.png" alt="logo" />';
				endif;
			$simplecatch_header_logo .= '</a></h1>';		
		}	
		set_transient( 'simplecatch_header_logo', $simplecatch_header_logo, 86940 );
	}
	echo $simplecatch_header_logo;	
} // simplecatch_header_logo
endif; 


if ( ! function_exists( 'simplecatch_header_title' ) ) :
/**
 * Get the Site Title and Tagline from Settings and theme options
 *
 * @uses set_transient and delete_transient 
 */
function simplecatch_header_title() {
	//delete_transient( 'simplecatch_header_title' );	

	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;	
		
	if ( ( !$simplecatch_header_title = get_transient( 'simplecatch_header_title' ) ) && ( empty( $options[ 'remove_site_title' ] ) || empty( $options[ 'remove_site_description' ] ) ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_header_title .= '<div id="site-details">';
			
		if( empty( $options[ 'remove_site_title' ] ) ) {
			$simplecatch_header_title .= '<h1 id="site-title"><span><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</a></span></h1>'; 
		}
		if( empty( $options[ 'remove_site_description' ] ) ) {
			$simplecatch_header_title .= '<h2 id="site-description">'.esc_attr( get_bloginfo( 'description' ) ).'</h2>';
		}
		$simplecatch_header_title .= '</div>';
			
		set_transient( 'simplecatch_header_title', $simplecatch_header_title, 86940 );
	}
	echo $simplecatch_header_title;	
} // simplecatch_header_title
endif;


if ( ! function_exists( 'simplecatch_headerdetails' ) ) :
/**
 * Diplaying Header Logo, Site Title and Tagline
 */
function simplecatch_headerdetails() {

	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;	
	
	echo '<hgroup class="logo-wrap clearfix">';

		if( empty( $options[ 'site_title_above' ] ) ) {
			simplecatch_header_logo();
			simplecatch_header_title();
		}
		else {
			simplecatch_header_title();
			simplecatch_header_logo();
		}
	
	echo '</hgroup>';
	
} // simplecatch_headerdetails
endif;
add_action( 'simplecatch_before_sidebartop', 'simplecatch_headerdetails', 10 );


if ( ! function_exists( 'simplecatch_footerlogo' ) ) :
/**
 * Get the footer logo Image from theme options
 *
 * @uses footer logo 
 * @get the data value of image from theme options
 * @display footer Image logo
 *
 * @uses default logo if logo field on theme options is empty
 *
 * @uses set_transient and delete_transient 
 */
function simplecatch_footerlogo() {
	//delete_transient('simplecatch_footerlogo');	
	
	if ( !$simplecatch_footerlogo = get_transient( 'simplecatch_footerlogo' ) ) {
		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;

		echo '<!-- refreshing cache -->';
		if ( $options[ 'remove_footer_logo' ] == "0" ) :
		
			// if not empty featured_logo_footer on theme options
			if ( !empty( $options[ 'featured_logo_footer' ] ) ) :
				$simplecatch_footerlogo = '<a href="'.esc_url( home_url( '/' ) ).'#branding" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"><img src="'.esc_url( $options[ 'featured_logo_footer' ] ).'" alt="'.get_bloginfo( 'name' ).'" /></a>';
			else:
				// if empty featured_logo_footer on theme options, display default fav icon
				$simplecatch_footerlogo = '<a href="'.esc_url( home_url( '/' ) ).'#branding" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"><img src="'. get_template_directory_uri().'/images/logo-foot.png" alt="footerlogo" /></a>';
			endif;
		endif;

		set_transient( 'simplecatch_footerlogo', $simplecatch_footerlogo, 86940 );										  
	}
	return $simplecatch_footerlogo;
} // simplecatch_footerlogo
endif;


/**
 * Get the favicon Image from theme options
 *
 * @uses favicon 
 * @get the data value of image from theme options
 * @display favicon
 *
 * @uses default favicon if favicon field on theme options is empty
 *
 * @uses set_transient and delete_transient 
 */
function simplecatch_favicon() {
	//delete_transient( 'simplecatch_favicon' );	
	
	if( ( !$simplecatch_favicon = get_transient( 'simplecatch_favicon' ) ) ) {
		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;
		
		echo '<!-- refreshing cache -->';
		if ( $options[ 'remove_favicon' ] == "0" ) :
			// if not empty fav_icon on theme options
			if ( !empty( $options[ 'fav_icon' ] ) ) :
				$simplecatch_favicon = '<link rel="shortcut icon" href="'.esc_url( $options[ 'fav_icon' ] ).'" type="image/x-icon" />'; 	
			else:
				// if empty fav_icon on theme options, display default fav icon
				$simplecatch_favicon = '<link rel="shortcut icon" href="'. get_template_directory_uri() .'/images/favicon.ico" type="image/x-icon" />';
			endif;
		endif;
		
		set_transient( 'simplecatch_favicon', $simplecatch_favicon, 86940 );	
	}	
	echo $simplecatch_favicon ;	
} // simplecatch_favicon

//Load Favicon in Header Section
add_action('wp_head', 'simplecatch_favicon');

//Load Favicon in Admin Section
add_action( 'admin_head', 'simplecatch_favicon' );


if ( ! function_exists( 'simplecatch_sliders' ) ) :
/**
 * This function to display featured posts on homepage header
 *
 * @get the data value from theme options
 * @displays on the homepage header
 *
 * @useage Featured Image, Title and Content of Post
 *
 * @uses set_transient and delete_transient
 */
function simplecatch_sliders() {	
	//delete_transient( 'simplecatch_sliders' );
		
	global $post, $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	$postperpage = $options[ 'slider_qty' ];
	$slidereffect = $options[ 'remove_noise_effect' ]; 
	
	if( ( !$simplecatch_sliders = get_transient( 'simplecatch_sliders' ) ) && !empty( $options[ 'featured_slider' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_sliders = '
		<div id="main-slider" class="post-slider">
			<section class="featured-slider">';
				$get_featured_posts = new WP_Query( array(
					'posts_per_page' => $postperpage,
					'post__in'		 => $options[ 'featured_slider' ],
					'orderby' 		 => 'post__in',
					'ignore_sticky_posts' => 1 // ignore sticky posts
				));
				
				$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
					$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
					$excerpt = get_the_excerpt();
					if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
					$simplecatch_sliders .= '
					<div class="'.$classes.'">
						<div class="featured-img">';
							if( has_post_thumbnail() ) {
		
								$simplecatch_sliders .= '<a href="' . get_permalink() . '" title="Permalink to '.the_title('','',false).'">';
		
								if( $slidereffect == "0" ) {
									$simplecatch_sliders .= '<span class="img-effect pngfix"></span>';
								}
		
								$simplecatch_sliders .= '<figure>'.get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'</figure></a>';
							}
							else {
								$simplecatch_sliders .= '<span class="img-effect pngfix"></span>';	
							}
							$simplecatch_sliders .= '
						</div> <!-- .featured-image -->
						<article class="featured-text">';
							if( $excerpt !='') {
								$simplecatch_sliders .= the_title( '<span class="slider-title">','</span>', false ).'<span class="slider-sep">: </span><span class="slider-content">'.$excerpt.'</span>';
							}
							$simplecatch_sliders .= '
						</article><!-- .featured-text -->
					</div> <!-- .slides -->';
				endwhile; wp_reset_query();
				
			$simplecatch_sliders .= '
			</section> <!-- .featured-slider -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div><!-- #main-slider -->';
			
		set_transient( 'simplecatch_sliders', $simplecatch_sliders, 86940 );
	}
	echo $simplecatch_sliders;	
} // simplecatch_sliders
endif; 


if ( ! function_exists( 'simplecatch_page_sliders' ) ) :
/**
 * This function to display featured page on homepage header
 *
 * @get the data value from theme options
 * @displays on the homepage header
 *
 * @useage Featured Image, Title and Content of Post
 *
 * @uses set_transient and delete_transient
 */
function simplecatch_page_sliders() {	
	//delete_transient( 'simplecatch_page_sliders' );
		
	global $post, $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	$postperpage = $options[ 'slider_qty' ];
	$slidereffect = $options[ 'remove_noise_effect' ]; 
	
	if( ( !$simplecatch_page_sliders = get_transient( 'simplecatch_page_sliders' ) ) && !empty( $options[ 'featured_slider_page' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_page_sliders = '
		<div id="main-slider" class="post-slider">
			<section class="featured-slider">';
				$get_featured_posts = new WP_Query( array(
					'posts_per_page'	=> $postperpage,
					'post_type'			=> 'page',
					'post__in'			=> $options[ 'featured_slider_page' ],
					'orderby' 			=> 'post__in'
				));
				
				$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
					$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
					$excerpt = get_the_excerpt();
					if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
					$simplecatch_page_sliders .= '
					<div class="'.$classes.'">
						<div class="featured-img">';
							if( has_post_thumbnail() ) {
		
								$simplecatch_page_sliders .= '<a href="' . get_permalink() . '" title="Permalink to '.the_title('','',false).'">';
		
								if( $slidereffect == "0" ) {
									$simplecatch_page_sliders .= '<span class="img-effect pngfix"></span>';
								}
		
								$simplecatch_page_sliders .= '<figure>'.get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'</figure></a>';
							}
							else {
								$simplecatch_page_sliders .= '<span class="img-effect pngfix"></span>';	
							}
							$simplecatch_page_sliders .= '
						</div> <!-- .featured-image -->
						<article class="featured-text">';
							if( $excerpt !='') {
								$simplecatch_page_sliders .= the_title( '<span class="slider-title">','</span>', false ).'<span class="slider-sep">: </span><span class="slider-content">'.$excerpt.'</span>';
							}
							$simplecatch_page_sliders .= '
						</article><!-- .featured-text -->
					</div> <!-- .slides -->';
				endwhile; wp_reset_query();
				
			$simplecatch_page_sliders .= '
			</section> <!-- .featured-slider -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div><!-- #main-slider -->';
			
		set_transient( 'simplecatch_page_sliders', $simplecatch_page_sliders, 86940 );
	}
	echo $simplecatch_page_sliders;	
} // simplecatch_page_sliders
endif;


if ( ! function_exists( 'simplecatch_category_sliders' ) ) :
/**
 * This function to display featured category on homepage header
 *
 * @get the data value from theme options
 * @displays on the homepage header
 *
 * @useage Featured Image, Title and Content of Post
 *
 * @uses set_transient and delete_transient
 */
function simplecatch_category_sliders() {	
	//delete_transient( 'simplecatch_category_sliders' );
		
	global $post, $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	$postperpage = $options[ 'slider_qty' ];
	$slidereffect = $options[ 'remove_noise_effect' ]; 
	$cats = $options[ 'slider_category' ];
	
	if( ( !$simplecatch_category_sliders = get_transient( 'simplecatch_category_sliders' ) )  && !in_array( '0', $cats ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_category_sliders = '
		<div id="main-slider" class="post-slider">
			<section class="featured-slider">';
				$get_featured_posts = new WP_Query( array(
					'posts_per_page'		=> $postperpage,
					'category__in'			=> $cats,
					'ignore_sticky_posts' 	=> 1 // ignore sticky posts
				));
				
				$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
					$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
					$excerpt = get_the_excerpt();
					if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
					$simplecatch_category_sliders .= '
					<div class="'.$classes.'">
						<div class="featured-img">';
							if( has_post_thumbnail() ) {
		
								$simplecatch_category_sliders .= '<a href="' . get_permalink() . '" title="Permalink to '.the_title('','',false).'">';
		
								if( $slidereffect == "0" ) {
									$simplecatch_category_sliders .= '<span class="img-effect pngfix"></span>';
								}
		
								$simplecatch_category_sliders .= '<figure>'.get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'</figure></a>';
							}
							else {
								$simplecatch_category_sliders .= '<span class="img-effect pngfix"></span>';	
							}
							$simplecatch_category_sliders .= '
						</div> <!-- .featured-image -->
						<article class="featured-text">';
							if( $excerpt !='') {
								$simplecatch_category_sliders .= the_title( '<span class="slider-title">','</span>', false ).'<span class="slider-sep">: </span><span class="slider-content">'.$excerpt.'</span>';
							}
							$simplecatch_category_sliders .= '
						</article><!-- .featured-text -->
					</div> <!-- .slides -->';
				endwhile; wp_reset_query();
				
			$simplecatch_category_sliders .= '
			</section> <!-- .featured-slider -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div><!-- #main-slider -->';
			
		set_transient( 'simplecatch_category_sliders', $simplecatch_category_sliders, 86940 );
	}
	echo $simplecatch_category_sliders;	
} // simplecatch_category_sliders
endif;


if ( ! function_exists( 'simplecatch_imagesliders' ) ) :
/**
 * This function to display featured posts on homepage header
 *
 * @get the data value from theme options
 * @displays on the homepage header
 *
 * @useage Featured Image, Title and Content of Post
 *
 * @uses set_transient and delete_transient
 */
function simplecatch_imagesliders() {	
	//delete_transient( 'simplecatch_imagesliders' );
		
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	$postperpage = $options[ 'slider_qty' ];
	$slidereffect = $options[ 'remove_noise_effect' ];
	$more_tag_text = sprintf( __( '%s', 'simplecatch' ) , $options[ 'more_tag_text' ] );
	
	if( ( !$simplecatch_imagesliders = get_transient( 'simplecatch_imagesliders' ) ) && !empty( $options[ 'featured_image_slider_image' ] ) ) {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_imagesliders = '
		<div id="main-slider" class="image-slider">
			<section class="featured-slider">';
			
				for ( $i=0; $i<=$options[ 'slider_qty' ]; $i++ ) {
					
					//Adding in Classes for Display blok and none
					if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
					
					//Check Image Not Empty to add in the slides
					if ( !empty ( $options[ 'featured_image_slider_image' ][ $i ] ) ) { 
					
						//Checking Link Target
						if ( !empty ( $options[ 'featured_image_slider_base' ][ $i ] ) ) {
							$target = '_blank';
						} else {
							$target = '_self';
						}
					
						//Checking Title
						if ( !empty ( $options[ 'featured_image_slider_title' ][ $i ] ) ) {
							$imagetitle = sprintf( __( '%s', 'simplecatch' ) , $options[ 'featured_image_slider_title' ][ $i ] );
							$title = '<span class="slider-title">' . $imagetitle . '</span>';
						}
						else {
							$imagetitle = '';
							$title = '';
						}
						
						//Checking Noise Effect
						if ( $slidereffect == 0 ) {
							$noise = '<span class="img-effect pngfix"></span>';
						}
						else {
							$noise = '';
						}
						
						//Checking Link
						if ( !empty ( $options[ 'featured_image_slider_link' ][ $i ] ) ) {
							$link = $options[ 'featured_image_slider_link' ][ $i ];
							$readmore = ' <a href="' . $link . '" class="readmore" target="' . $target . '">' . $more_tag_text . '</a>';
							$image = '<a href="' . $link . '" title="' . $imagetitle . '" target="' . $target . '">' . $noise . '<figure><img title="' . $imagetitle . '" alt="' . $imagetitle . '" class="pngfix wp-post-image" src="' . $options[ 'featured_image_slider_image' ][ $i ] . '" /></figure></a>';
						}
						else {
							$link = '';
							$readmore = '';
							$image = '<span>' . $noise . '<figure><img title="' . $imagetitle . '" alt="' . $imagetitle . '" class="pngfix wp-post-image" src="' . $options[ 'featured_image_slider_image' ][ $i ] . '" /></figure></span>';
						}
						
						//Checking Content
						if ( !empty ( $options[ 'featured_image_slider_content' ][ $i ] ) ) {
							$rawcontent = sprintf( __( '%s', 'simplecatch' ) , $options[ 'featured_image_slider_content' ][ $i ] );
							$content = '<span class="slider-sep">: </span><span class="slider-content">'.$rawcontent.'</span>';
						}
						else {
							$rawcontent = '';
							$content = '';
						}
						
						//Content Opening and Closing
						if ( !empty ( $options[ 'featured_image_slider_title' ][ $i ] ) || !empty ( $options[ 'featured_image_slider_content' ][ $i ] ) ) {
							$contentopening = '<article class="featured-text">';
							$contentclosing = '</article>';
						}
						else {
							$contentopening = '';
							$contentclosing = '';
						}
						
						$simplecatch_imagesliders .= '
						<div class="'.$classes.'">
							<div class="featured-img">'
								.$image.'
							</div>
							'.$contentopening.
								$title.$content.$readmore
							.$contentclosing.'
						</div> <!-- .slides -->';
					}
				}
				
			$simplecatch_imagesliders .= '
			</section> <!-- .featured-slider -->
			<div id="controllers">
			</div><!-- #controllers -->
		</div><!-- #main-slider -->';
			
		set_transient( 'simplecatch_imagesliders', $simplecatch_imagesliders, 86940 );
	}
	echo $simplecatch_imagesliders;	
} // simplecatch_imagesliders
endif;


if ( ! function_exists( 'simplecatch_slider_display' ) ) :
/**
 * Display slider
 */
function simplecatch_slider_display() {
	global $post, $wp_query, $simplecatch_options_settings;
    
	// get data value from theme options
	$options = $simplecatch_options_settings;
	$enableslider = $options[ 'enable_slider' ];
	$sliderselect = $options[ 'select_slider_type' ];
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 
	
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();	

	if ( ( $enableslider == 'enable-slider-allpage' ) || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enableslider == 'enable-slider-homepage' ) ) :
	
		// This function passes the value of slider effect to js file 
        if( function_exists( 'simplecatch_pass_slider_value' ) ) {
            simplecatch_pass_slider_value();
        }
		// Select Slider
		if ( $sliderselect =='image-slider' && function_exists( 'simplecatch_imagesliders' ) ) {
			simplecatch_imagesliders();
		}
		elseif ( $sliderselect == 'post-slider' && function_exists( 'simplecatch_sliders' ) ) {
			simplecatch_sliders();
		}
		elseif ( $sliderselect == 'page-slider' && function_exists( 'simplecatch_page_sliders' ) ) {
			simplecatch_page_sliders();
		}	
		elseif ( $sliderselect == 'category-slider' && function_exists( 'simplecatch_category_sliders' ) ) {
			simplecatch_category_sliders();
		}			
		
	endif;
	
} // simplecatch_slider_display
endif;

add_action( 'simplecatch_after_headercontent', 'simplecatch_slider_display', 20 );


if ( ! function_exists( 'simplecatch_breadcrumb_display' ) ) :
/**
 * Display breadcrumb on header
 */
function simplecatch_breadcrumb_display() {
	global $post, $wp_query;
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
		return false;
	}
	else {
		if ( function_exists( 'bcn_display_list' ) ) {
			echo 
			'<div class="breadcrumb">
				<ul>';
					bcn_display_list();
					echo '	
				</ul>
				<div class="row-end"></div>
			</div> <!-- .breadcrumb -->';	
		}
	}
	
} // simplecatch_breadcrumb_display
endif;

add_action( 'simplecatch_after_headercontent', 'simplecatch_breadcrumb_display', 25 );


if ( ! function_exists( 'simplecatch_headersocialnetworks' ) ) :
/**
 * This function for social links display on header
 *
 * @fetch links through Theme Options
 * @use in widget
 * @social links, Facebook, Twitter and RSS
  */
function simplecatch_headersocialnetworks() {
	//delete_transient( 'simplecatch_headersocialnetworks' );
	
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

    $elements = array();

	$elements = array( 	$options[ 'social_facebook' ], 
						$options[ 'social_twitter' ],
						$options[ 'social_googleplus' ],
						$options[ 'social_linkedin' ],
						$options[ 'social_pinterest' ],
						$options[ 'social_youtube' ],
						$options[ 'social_vimeo' ],
						$options[ 'social_slideshare' ],
						$options[ 'social_foursquare' ],
						$options[ 'social_flickr' ],
						$options[ 'social_tumblr' ],
						$options[ 'social_deviantart' ],
						$options[ 'social_dribbble' ],
						$options[ 'social_myspace' ],
						$options[ 'social_wordpress' ],
						$options[ 'social_rss' ],
						$options[ 'social_delicious' ],
						$options[ 'social_lastfm' ],
						$options[ 'social_instagram' ],
						$options[ 'social_github' ],
						$options[ 'social_vkontakte' ],
						$options[ 'social_myworld' ],
						$options[ 'social_odnoklassniki' ],
						$options[ 'social_goodreads' ],
						$options[ 'social_skype' ],
						$options[ 'social_soundcloud' ],
						$options[ 'social_email' ]
					);
	$flag = 0;
	if( !empty( $elements ) ) {
		foreach( $elements as $option) {
			if( !empty( $option ) ) {
				$flag = 1;
			}
			else {
				$flag = 0;
			}
			if( $flag == 1 ) {
				break;
			}
		}
	}	
	
	if ( ( !$simplecatch_headersocialnetworks = get_transient( 'simplecatch_headersocialnetworks' ) ) && ( $flag == 1 ) )  {
		echo '<!-- refreshing cache -->';
		
		$simplecatch_headersocialnetworks .='
		<ul class="social-profile">';
	
			//facebook
			if ( !empty( $options[ 'social_facebook' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="facebook"><a href="'.esc_url( $options[ 'social_facebook' ] ).'" title="'.sprintf( esc_attr__( '%s on Facebook', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Facebook </a></li>';
			}
			//Twitter
			if ( !empty( $options[ 'social_twitter' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="twitter"><a href="'.esc_url( $options[ 'social_twitter' ] ).'" title="'.sprintf( esc_attr__( '%s on Twitter', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Twitter </a></li>';
			}
			//Google+
			if ( !empty( $options[ 'social_googleplus' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="google-plus"><a href="'.esc_url( $options[ 'social_googleplus' ] ).'" title="'.sprintf( esc_attr__( '%s on Google+', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Google+ </a></li>';
			}
			//Linkedin
			if ( !empty( $options[ 'social_linkedin' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="linkedin"><a href="'.esc_url( $options[ 'social_linkedin' ] ).'" title="'.sprintf( esc_attr__( '%s on Linkedin', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Linkedin </a></li>';
			}
			//Pinterest
			if ( !empty( $options[ 'social_pinterest' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="pinterest"><a href="'.esc_url( $options[ 'social_pinterest' ] ).'" title="'.sprintf( esc_attr__( '%s on Pinterest', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Twitter </a></li>';
			}				
			//Youtube
			if ( !empty( $options[ 'social_youtube' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="you-tube"><a href="'.esc_url( $options[ 'social_youtube' ] ).'" title="'.sprintf( esc_attr__( '%s on YouTube', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' YouTube </a></li>';
			}
			//Vimeo
			if ( !empty( $options[ 'social_vimeo' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="viemo"><a href="'.esc_url( $options[ 'social_vimeo' ] ).'" title="'.sprintf( esc_attr__( '%s on Vimeo', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Vimeo </a></li>';
			}				
			//Slideshare
			if ( !empty( $options[ 'social_slideshare' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="slideshare"><a href="'.esc_url( $options[ 'social_slideshare' ] ).'" title="'.sprintf( esc_attr__( '%s on Slideshare', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Slideshare </a></li>';
			}				
			//Foursquare
			if ( !empty( $options[ 'social_foursquare' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="foursquare"><a href="'.esc_url( $options[ 'social_foursquare' ] ).'" title="'.sprintf( esc_attr__( '%s on Foursquare', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' foursquare </a></li>';
			}
			//Flickr
			if ( !empty( $options[ 'social_flickr' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="flickr"><a href="'.esc_url( $options[ 'social_flickr' ] ).'" title="'.sprintf( esc_attr__( '%s on Flickr', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Flickr </a></li>';
			}
			//Tumblr
			if ( !empty( $options[ 'social_tumblr' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="tumblr"><a href="'.esc_url( $options[ 'social_tumblr' ] ).'" title="'.sprintf( esc_attr__( '%s on Tumblr', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Tumblr </a></li>';
			}
			//deviantART
			if ( !empty( $options[ 'social_deviantart' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="deviantart"><a href="'.esc_url( $options[ 'social_deviantart' ] ).'" title="'.sprintf( esc_attr__( '%s on deviantART', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' deviantART </a></li>';
			}
			//Dribbble
			if ( !empty( $options[ 'social_dribbble' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="dribbble"><a href="'.esc_url( $options[ 'social_dribbble' ] ).'" title="'.sprintf( esc_attr__( '%s on Dribbble', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' Dribbble </a></li>';
			}
			//MySpace
			if ( !empty( $options[ 'social_myspace' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="myspace"><a href="'.esc_url( $options[ 'social_myspace' ] ).'" title="'.sprintf( esc_attr__( '%s on MySpace', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' MySpace </a></li>';
			}
			//WordPress
			if ( !empty( $options[ 'social_wordpress' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="wordpress"><a href="'.esc_url( $options[ 'social_wordpress' ] ).'" title="'.sprintf( esc_attr__( '%s on WordPress', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' WordPress </a></li>';
			}				
			//RSS
			if ( !empty( $options[ 'social_rss' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="rss"><a href="'.esc_url( $options[ 'social_rss' ] ).'" title="'.sprintf( esc_attr__( '%s on RSS', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' RSS </a></li>';
			}
			//Delicious
			if ( !empty( $options[ 'social_delicious' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="delicious"><a href="'.esc_url( $options[ 'social_delicious' ] ).'" title="'.sprintf( esc_attr__( '%s on Delicious', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' Delicious </a></li>';
			}				
			//Last.fm
			if ( !empty( $options[ 'social_lastfm' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="lastfm"><a href="'.esc_url( $options[ 'social_lastfm' ] ).'" title="'.sprintf( esc_attr__( '%s on Last.fm', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' Last.fm </a></li>';
			}	
			//Instagram
			if ( !empty( $options[ 'social_instagram' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="instagram"><a href="'.esc_url( $options[ 'social_instagram' ] ).'" title="'.sprintf( esc_attr__( '%s on Instagram', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' Instagram </a></li>';
			}
			//GitHub
			if ( !empty( $options[ 'social_github' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="github"><a href="'.esc_url( $options[ 'social_github' ] ).'" title="'.sprintf( esc_attr__( '%s on GitHub', 'simplecatch' ),get_bloginfo('name') ).'" target="_blank">'.get_bloginfo( 'name' ).' GitHub </a></li>';
			}			
			//Vkontakte
			if ( !empty( $options[ 'social_vkontakte' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="vkontakte"><a href="'.esc_url( $options[ 'social_vkontakte' ] ).'" title="'.sprintf( esc_attr__( '%s on Vkontakte', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Vkontakte </a></li>';
			}				
			//My World
			if ( !empty( $options[ 'social_myworld' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="myworld"><a href="'.esc_url( $options[ 'social_myworld' ] ).'" title="'.sprintf( esc_attr__( '%s on My World', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' My World </a></li>';
			}				
			//Odnoklassniki
			if ( !empty( $options[ 'social_odnoklassniki' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="odnoklassniki"><a href="'.esc_url( $options[ 'social_odnoklassniki' ] ).'" title="'.sprintf( esc_attr__( '%s on Odnoklassniki', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Odnoklassniki </a></li>';
			}
			//Goodreads
			if ( !empty( $options[ 'social_goodreads' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="goodreads"><a href="'.esc_url( $options[ 'social_goodreads' ] ).'" title="'.sprintf( esc_attr__( '%s on Goodreads', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Goodreads </a></li>';
			}	
			//Skype
			if ( !empty( $options[ 'social_skype' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="skype"><a href="'.esc_attr( $options[ 'social_skype' ] ).'" title="'.sprintf( esc_attr__( '%s on Skype', 'simplecatch' ),get_bloginfo( 'name' ) ).'">'.get_bloginfo( 'name' ).' Skype </a></li>';
			}	
			//Soundcloud
			if ( !empty( $options[ 'social_soundcloud' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="soundcloud"><a href="'.esc_url( $options[ 'social_soundcloud' ] ).'" title="'.sprintf( esc_attr__( '%s on Soundcloud', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Soundcloud </a></li>';
			}	
			//Email
			if ( !empty( $options[ 'social_email' ] ) && is_email($options[ 'social_email' ] ) ) {
				$simplecatch_headersocialnetworks .=
					'<li class="email"><a href="mailto:'.sanitize_email( $options[ 'social_email' ] ).'" title="'.sprintf( esc_attr__( '%s on Email', 'simplecatch' ),get_bloginfo( 'name' ) ).'" target="_blank">'.get_bloginfo( 'name' ).' Email </a></li>';
			}				
			$simplecatch_headersocialnetworks .='
		</ul><div class="clear"></div>';
		
		set_transient( 'simplecatch_headersocialnetworks', $simplecatch_headersocialnetworks, 86940 );	 
	}
	echo $simplecatch_headersocialnetworks;
} // simplecatch_headersocialnetworks
endif;


if ( ! function_exists( 'simplecatch_menu' ) ) :
/**
 * Access / Menu
 */
function simplecatch_menu() { ?>
     <nav id="access" class="menu-header-container clearfix" role="navigation">
        <h3 class="assistive-text"><?php _e( 'Primary menu', 'simplecatch' ); ?></h3>
        <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
        <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'simplecatch' ); ?>"><?php _e( 'Skip to primary content', 'simplecatch' ); ?></a></div>
        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */
        if( has_nav_menu( 'primary', 'simplecatch' ) ) { 
            wp_nav_menu( array( 
                'theme_location' 	=> 'primary', 
                'container' 		=> '' 
            ) );
        } else { 
            wp_page_menu( array( 
                'menu_class'  => 'menu-header-container' 
            ) );
        }
        ?>
    </nav> <!-- #access -->
	<?php
} // simplecatch_menu
endif;

add_action( 'simplecatch_after_headercontent', 'simplecatch_menu', 15 );


if ( ! function_exists( 'simplecatch_site_verification' ) ) :
/**
 * Site Verification  and Webmaster Tools
 *
 * If user sets the code we're going to display meta verification
 * @get the data value from theme options
 * @uses wp_head action to add the code in the header
 * @uses set_transient and delete_transient API for cache
 */
function simplecatch_site_verification() {
	//delete_transient( 'simplecatch_site_verification' );

	if ( ( !$simplecatch_site_verification = get_transient( 'simplecatch_site_verification' ) ) )  {

		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;
		echo '<!-- refreshing cache -->';	
		
		$simplecatch_site_verification = '';
		//google
		if ( !empty( $options['google_verification'] ) ) {
			$simplecatch_site_verification .= '<meta name="google-site-verification" content="' .  $options['google_verification'] . '" />' . "\n";
		}
		//bing
		if ( !empty( $options['bing_verification'] ) ) {
			$simplecatch_site_verification .= '<meta name="msvalidate.01" content="' .  $options['bing_verification']  . '" />' . "\n";
		}
		//yahoo
		 if ( !empty( $options['yahoo_verification'] ) ) {
			$simplecatch_site_verification .= '<meta name="y_key" content="' .  $options['yahoo_verification']  . '" />' . "\n";
		}
		//site stats, analytics header code
		if ( !empty( $options['analytic_header'] ) ) {
			$simplecatch_site_verification .=  $options[ 'analytic_header' ] ;
		}
		
		set_transient( 'simplecatch_site_verification', $simplecatch_site_verification, 86940 );
	}
	echo $simplecatch_site_verification;
} // simplecatch_site_verification
endif;

add_action('wp_head', 'simplecatch_site_verification');


if ( ! function_exists( 'simplecatch_footercode' ) ) :
/**
 * This function loads the Footer Code such as Add this code from the Theme Option
 *
 * @get the data value from theme options
 * @load on the footer ONLY
 * @uses wp_footer action to add the code in the footer
 * @uses set_transient and delete_transient
 */
function simplecatch_footercode() {
	//delete_transient( 'simplecatch_footercode' );	
	
	if ( ( !$simplecatch_footercode = get_transient( 'simplecatch_footercode' ) ) ) {

		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;
		echo '<!-- refreshing cache -->';	
		
		//site stats, analytics header code
		if ( !empty( $options['analytic_footer'] ) ) {
			$simplecatch_footercode =  $options[ 'analytic_footer' ] ;
		}
			
		set_transient( 'simplecatch_footercode', $simplecatch_footercode, 86940 );
	}
	echo $simplecatch_footercode;
} // simplecatch_footercode
endif;

add_action('wp_footer', 'simplecatch_footercode');


if ( ! function_exists( 'simplecatch_inline_css' ) ) :
/**
 * Hooks the Custom Inline CSS to head section
 *
 * @since Simple Catch Pro 1.2.3
 */
function simplecatch_inline_css() {
	//delete_transient( 'simplecatch_inline_css' );	
	
	if ( ( !$simplecatch_inline_css = get_transient( 'simplecatch_inline_css' ) ) ) {
		global $simplecatch_options_settings, $simplecatch_options_defaults;
        $options = $simplecatch_options_settings;
		$defaults = $simplecatch_options_defaults;
		
		$fonts = simplecatch_available_fonts();

        $simplecatch_inline_css = '';
		

		if( $options[ 'reset_color' ] == "0" || !empty( $options[ 'custom_css' ] ) || $options[ 'reset_typography' ] == "0" || $options[ 'reset_typography_font_size' ] == "0" ) {
	
			$simplecatch_inline_css	.= '<!-- '.get_bloginfo('name').' Custom CSS Styles -->' . "\n";
	        $simplecatch_inline_css .= '<style type="text/css" media="screen">' . "\n";
			
			
			//Color Options
			if( $options[ 'reset_color' ] == "0" ) {
						 
				if( $defaults[ 'header_top_background' ] != $options[ 'header_top_background' ] ) {
					$simplecatch_inline_css	.=  "#branding .top-bg { background: none ".  $options[ 'header_top_background' ] ."; }". "\n";	
				}			
				if( $defaults[ 'header_background' ] != $options[ 'header_background' ] ) {
					$simplecatch_inline_css	.=  "#branding { background: none ".  $options[ 'header_background' ] ."; }". "\n";	
				}	
				if( $defaults[ 'footer_background' ] != $options[ 'footer_background' ] ) {
					$simplecatch_inline_css	.=  "#site-generator { background: none ".  $options[ 'footer_background' ] ."; }". "\n";	
				}
				if( $defaults[ 'footer_sidebar_background' ] != $options[ 'footer_sidebar_background' ] ) {
					$simplecatch_inline_css	.=  "#footer-sidebar { background: none ".  $options[ 'footer_sidebar_background' ] ."; }". "\n";	
				}
				if( $defaults[ 'header_footer_border' ] != $options[ 'header_footer_border' ] ) {
					$simplecatch_inline_css	.=  "#branding .top-bg, #site-generator { border-color: ".  $options[ 'header_footer_border' ] ."; }". "\n";	
				}
				if( $defaults[ 'title_color' ] != $options[ 'title_color' ] ) {
					$simplecatch_inline_css	.=  "#site-title a { color: ".  $options[ 'title_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) {
					$simplecatch_inline_css	.=  "#site-description { color: ".  $options[ 'tagline_color' ] ."; }". "\n";	
				}	
				if( $defaults[ 'heading_color' ] != $options[ 'heading_color' ] ) {
					$simplecatch_inline_css	.=  "#main .entry-title, #main .entry-title a { color: ".  $options[ 'heading_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'meta_color' ] != $options[ 'meta_color' ] ) {
					$simplecatch_inline_css	.=  "#main .entry-meta, #main .entry-meta a { color: ".  $options[ 'meta_color' ] ."; }". "\n";	
				}			
				if( $defaults[ 'text_color' ] != $options[ 'text_color' ] ) {
					$simplecatch_inline_css	.=  "#main { color: ".  $options[ 'text_color' ] ."; }". "\n";	
				}	
				if( $defaults[ 'link_color' ] != $options[ 'link_color' ] ) {
					$simplecatch_inline_css	.=  "#main a { color: ".  $options[ 'link_color' ] ."; }". "\n";	
				}	
				if( $defaults[ 'widget_heading_color' ] != $options[ 'widget_heading_color' ] ) {
					$simplecatch_inline_css	.=  "#secondary .widget-title, #secondary .widget-title a, #supplementary .widget-title, #supplementary .widget-title a { color: ".  $options[ 'widget_heading_color' ] ."; }". "\n";	
				}	
				if( $defaults[ 'widget_text_color' ] != $options[ 'widget_text_color' ] ) {
					$simplecatch_inline_css	.=  "#secondary .widget,  #supplementary .widget { color: ".  $options[ 'widget_text_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'widget_link_color' ] != $options[ 'widget_link_color' ] ) {
					$simplecatch_inline_css	.=  "#secondary .widget a, #supplementary .widget a { color: ".  $options[ 'widget_link_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'menu_bg_color' ] != $options[ 'menu_bg_color' ] ) {
					$simplecatch_inline_css	.=  "#access { background-color: ".  $options[ 'menu_bg_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'menu_text_color' ] != $options[ 'menu_text_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li a { color: ".  $options[ 'menu_text_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'border_color' ] != $options[ 'border_color' ] ) {
					$simplecatch_inline_css	.=  "#access, #access ul li, #access ul li ul li { border-color: ".  $options[ 'border_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'hover_active_color' ] != $options[ 'hover_active_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li a:hover, #access ul li.current-menu-item a, #access ul li:hover > a { background-color: ".  $options[ 'hover_active_color' ] ."; box-shadow: none; }". "\n";	
				}
				if( $defaults[ 'hover_active_text_color' ] != $options[ 'hover_active_text_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li a:hover, #access ul li.current-menu-item a, #access ul li:hover > a { color: ".  $options[ 'hover_active_text_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'sub_menu_bg_color' ] != $options[ 'sub_menu_bg_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li ul, #access ul li.current-menu-item .sub-menu a, #access ul.sb-options { background-color: ".  $options[ 'sub_menu_bg_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'sub_menu_text_color' ] != $options[ 'sub_menu_text_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li ul li a, #access ul.sb-options { color: ".  $options[ 'sub_menu_text_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'sub_menu_hover_bg_color' ] != $options[ 'sub_menu_hover_bg_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li ul li a:hover, #access ul li ul li:hover > a, #access .sb-options a:hover, #access .sb-options a:focus, #access .sb-options a.sb-focus { background-color: ".  $options[ 'sub_menu_hover_bg_color' ] ."; }". "\n";	
				}
				if( $defaults[ 'sub_menu_hover_text_color' ] != $options[ 'sub_menu_hover_text_color' ] ) {
					$simplecatch_inline_css	.=  "#access ul li ul li a:hover, #access ul li ul li:hover > a, #access .sb-options a:hover, #access .sb-options a:focus, #access .sb-options a.sb-focus { color: ".  $options[ 'sub_menu_hover_text_color' ] ."; }". "\n";	
				}				
			}
			
			// Typography (Font Family) Options
			if( $options[ 'reset_typography' ] == "0" ) {
				if( $defaults[ 'body_font' ] != $options[ 'body_font' ] ) {
					$simplecatch_inline_css	.=  "body, input, textarea { font-family: ". $fonts [ $options[ 'body_font' ] ] ."; }". "\n";
				}	
				if( $defaults[ 'title_font' ] != $options[ 'title_font' ] ) {
					$simplecatch_inline_css	.=  "#site-title { font-family: ". $fonts [ $options[ 'title_font' ] ] ."; }". "\n";
				}
				if( $defaults[ 'tagline_font' ] != $options[ 'tagline_font' ] ) {
					$simplecatch_inline_css	.=  "#site-description { font-family: ". $fonts [ $options[ 'tagline_font' ] ] ."; }". "\n";
				}
				if( $defaults[ 'headings_font' ] != $options[ 'headings_font' ] ) {
					$simplecatch_inline_css	.=  "h1, h2, h3, h4, h5, h6 { font-family: ". $fonts [ $options[ 'headings_font' ] ] ."; }". "\n";
				}
				if( $defaults[ 'content_font' ] != $options[ 'content_font' ] ) {
					$simplecatch_inline_css	.=  ".entry-content, .entry-summary { font-family: ". $fonts [ $options[ 'content_font' ] ] ."; }". "\n";
				}	
			}
			
			// Typography (Font Size) Options
			if( $options[ 'reset_typography_font_size' ] == "0" ) {	
				//Body Font Size
				if( $defaults['body_font_size'] != $options[ 'body_font_size' ] ) {
					$simplecatch_inline_css	.=  "body, input, textarea { font-size: ". $options[ 'body_font_size' ] . $options[ 'body_font_size_unit' ] ."; line-height: ". $options[ 'body_line_height' ] . $options[ 'body_line_height_unit' ] .";  }". "\n";
				} elseif( $defaults['body_line_height'] != $options[ 'body_line_height' ] ) {
					$simplecatch_inline_css	.=  "body, input, textarea { line-height: ". $options[ 'body_line_height' ] . $options[ 'body_line_height_unit' ] .";  }". "\n";
				}
				//Site Title Font Size
				if( $defaults['site_title_font_size'] != $options[ 'site_title_font_size' ] ) {
					$simplecatch_inline_css	.=  "#site-title { font-size: ". $options[ 'site_title_font_size' ] . $options[ 'site_title_font_size_unit' ] ."; line-height: ". $options[ 'site_title_line_height' ] . $options[ 'site_title_line_height_unit' ] .";  }". "\n";
				} elseif( $defaults['site_title_line_height'] != $options[ 'site_title_line_height' ] ) {
					$simplecatch_inline_css	.=  "#site-title  { line-height: ". $options[ 'site_title_line_height' ] . $options[ 'site_title_line_height_unit' ] .";  }". "\n";
				}
				//Site Description Font Size
				if( $defaults['site_description_font_size'] != $options[ 'site_description_font_size' ] ) {
					$simplecatch_inline_css	.=  "#site-description { font-size: ". $options[ 'site_description_font_size' ] . $options[ 'site_description_font_size_unit' ] ."; line-height: ". $options[ 'site_description_line_height' ] . $options[ 'site_description_line_height_unit' ] .";  }". "\n";
				} elseif( $defaults['site_description_line_height'] != $options[ 'site_description_line_height' ] ) {
					$simplecatch_inline_css	.=  "#site-description { line-height: ". $options[ 'site_description_line_height' ] . $options[ 'site_description_line_height_unit' ] .";  }". "\n";
				}
				//Content Title Font Size
				if( $defaults['content_title_font_size'] != $options[ 'content_title_font_size' ] ) {
					$simplecatch_inline_css	.=  ".entry-title { font-size: ". $options[ 'content_title_font_size' ] . $options[ 'content_title_font_size_unit' ] ."; line-height: ". $options[ 'content_title_line_height' ] . $options[ 'content_title_line_height_unit' ] .";  }". "\n";
				} elseif( $defaults['content_title_line_height'] != $options[ 'content_title_line_height' ] ) {
					$simplecatch_inline_css	.=  ".entry-title  { line-height: ". $options[ 'content_title_line_height' ] . $options[ 'content_title_line_height_unit' ] .";  }". "\n";
				}							
				//H1 Font Size
				if( $defaults['h1_font_size'] != $options[ 'h1_font_size' ] ) {
					$simplecatch_inline_css	.=  "h1 { font-size: ".  $options[ 'h1_font_size' ] . $options[ 'h1_font_size_unit' ] ."; line-height: ". $options[ 'headings_line_height' ] . $options[ 'headings_line_height_unit' ] .";  }". "\n";
				} 
				//H2 Font Size
				if( $defaults['h2_font_size'] != $options[ 'h2_font_size' ] ) {
					$simplecatch_inline_css	.=  "h2 { font-size: ". $options[ 'h2_font_size' ] . $options[ 'h2_font_size_unit' ] ."; line-height: ". $options[ 'headings_line_height' ] . $options[ 'headings_line_height_unit' ] .";  }". "\n";
				} 
				//H3 Font Size
				if( $defaults['h3_font_size'] != $options[ 'h3_font_size' ] ) {
					$simplecatch_inline_css	.=  "h3 { font-size: ". $options[ 'h3_font_size' ] . $options[ 'h3_font_size_unit' ] ."; line-height: ". $options[ 'headings_line_height' ] . $options[ 'headings_line_height_unit' ] .";  }". "\n";
				} 
				//H4 Font Size
				if( $defaults['h4_font_size'] != $options[ 'h4_font_size' ] ) {
					$simplecatch_inline_css	.=  "h4 { font-size: ". $options[ 'h4_font_size' ] . $options[ 'h4_font_size_unit' ] ."; line-height: ". $options[ 'headings_line_height' ] . $options[ 'headings_line_height_unit' ] .";  }". "\n";
				} 
				//Content Font Size
				if( $defaults[ 'content_font_size' ] != $options[ 'content_font_size' ] ) {
					$simplecatch_inline_css	.=  ".entry-content, .entry-summary { font-size: ". $options[ 'content_font_size' ] . $options[ 'content_font_size_unit' ] ."; line-height: ". $options[ 'content_line_height' ] . $options[ 'content_line_height_unit' ] .";  }". "\n";
				}				
			}
						
			//Custom CSS Option
			if( !empty( $options[ 'custom_css' ] ) ) {
				$simplecatch_inline_css .=  $options['custom_css'] . "\n";
			}
			
		$simplecatch_inline_css .= '</style>' . "\n";	
			
		}
			
		set_transient( 'simplecatch_inline_css', $simplecatch_inline_css, 86940 );
		
	}
	echo $simplecatch_inline_css;
} // simplecatch_inline_css
endif;

add_action('wp_head', 'simplecatch_inline_css');


if ( ! function_exists( 'simplecatch_custom_tag_cloud' ) ) :
/*
 * Function for showing custom tag cloud
 */
function simplecatch_custom_tag_cloud() {
?>
	<div class="custom-tagcloud"><?php wp_tag_cloud('smallest=12&largest=12px&unit=px'); ?></div>
<?php	
} //simplecatch_custom_tag_cloud
endif;


if ( ! function_exists( 'simplecatch_footer_widget' ) ) :
/**
 * shows footer content
 */
function simplecatch_footer_widget() { 

	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with three columns of widgets.
	 */
	get_sidebar( 'footer' ); 
	
} // simplecatch_footercontent
endif;
add_action( 'simplecatch_footer', 'simplecatch_footer_widget', 10 );


if ( ! function_exists( 'simplecatch_footer_sidebar_class' ) ) :
/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function simplecatch_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one wrapper clearfix';
			break;
		case '2':
			$class = 'two wrapper clearfix';
			break;
		case '3':
			$class = 'three wrapper clearfix';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}
// simplecatch_footer_sidebar_class
endif;

if ( ! function_exists( 'simplecatch_footercontent' ) ) :
/**
 * shows footer content
 */
function simplecatch_footercontent() { 
	//delete_transient( 'simplecatch_footercontent' );	
	
	if ( ( !$simplecatch_footercontent = get_transient( 'simplecatch_footercontent' ) ) ) {
		echo '<!-- refreshing cache -->';
		
		// get the data value from theme options
		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;
		
        $simplecatch_footercontent = '<div id="site-generator"><div class="wrapper clearfix">'.$options[ 'footer_code' ].'</div></div><!-- .wrapper -->';
		
    	set_transient( 'simplecatch_footercontent', $simplecatch_footercontent, 86940 );
    }
	echo do_shortcode( $simplecatch_footercontent );
} // simplecatch_footercontent
endif;
add_action( 'simplecatch_footer', 'simplecatch_footercontent', 15 );


/**
 * Function to pass the slider value
 */
function simplecatch_pass_slider_value() {
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;

	$transition_effect = $options[ 'transition_effect' ];
	$transition_delay = $options[ 'transition_delay' ] * 1000;
	$transition_duration = $options[ 'transition_duration' ] * 1000;
	wp_localize_script( 
		'simplecatch_slider',
		'js_value',
		array(
			'transition_effect' => $transition_effect,
			'transition_delay' => $transition_delay,
			'transition_duration' => $transition_duration
		)
	);
}// simplecatch_pass_slider_value


/**
 * Alter the query for the main loop in home page
 * @uses pre_get_posts hook
 */
function simple_catch_alter_home( $query ){
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
	$cats = $options[ 'front_page_category' ];

    if ( $options[ 'exclude_slider_post'] != "0" && !empty( $options[ 'featured_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_slider' ];
		}
	}
	if ( !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $options[ 'front_page_category' ];
		}
	}
}
add_action( 'pre_get_posts','simple_catch_alter_home' );


if ( ! function_exists( 'simplecatch_class_names' ) ) :
/**
 * Add specific CSS class by filter
 * @uses body_class filter hook
 * @since Simple Catch Pro 1.3.2
 */  
function simplecatch_class_names($classes) { 
	global $post, $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
	
	//Content Layouts
	$content_layout = $options['content_layout'];
	if ( $content_layout == 'excerpt' ) {
		$classes[] = 'layout-excerpt';
	}
	
	//Default Layouts
	if( $post) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent,'simplecatch-sidebarlayout', true );
		} else {
			$layout = get_post_meta( $post->ID,'simplecatch-sidebarlayout', true ); 
		}
	}

	if( empty( $layout ) || ( !is_page() && !is_single() ) ) {
		$layout='default';
	}
	
	$themeoption_layout = $options['sidebar_layout'];
	if( ( $layout == 'no-sidebar' || ( $layout=='default' && $themeoption_layout == 'no-sidebar') ) ) {
		$classes[] = 'no-sidebar';
	}
	elseif( ( $layout == 'no-sidebar-one-column' || ( $layout=='default' && $themeoption_layout == 'no-sidebar-one-column') ) ){
		$classes[] = 'no-sidebar-one-column';
	}
	elseif( ( $layout == 'no-sidebar-full-width' || ( $layout=='default' && $themeoption_layout == 'no-sidebar-full-width') ) ){
		$classes[] = 'no-sidebar-full-width';
	}
	elseif( ( $layout == 'left-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar') ) ){
		$classes[] = 'left-sidebar';
	}
	elseif( ( $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'right-sidebar') ) ){
		$classes[] = 'right-sidebar';
	}			
	
	return $classes;
} //simplecatch_class_names
endif;

add_filter('body_class','simplecatch_class_names');


if ( ! function_exists( 'simplecatch_content' ) ) :
/**
 * Display the page/post content
 * @since Simple Catch Pro 1.0
 */
function simplecatch_content() {
	global $post;
	
	if ( is_attachment() ) { 
		$parent = $post->post_parent;
		$layout = get_post_meta( $parent,'simplecatch-sidebarlayout', true );
	} else {
		$layout = get_post_meta( $post->ID,'simplecatch-sidebarlayout', true ); 
	}
		
	if( empty( $layout ) )
		$layout='default';
		
	get_header(); 
	
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
	$themeoption_layout = $options['sidebar_layout'];
		
	while ( have_posts() ):the_post();
	
		if ( function_exists( 'simplecatch_loop') ) simplecatch_loop(); 
		
		comments_template(); 
		   
	endwhile; ?>
	
	</div><!-- #primary -->
    
    <?php
    /** 
     * simplecatch_below_primary hook
     */
    do_action( 'simplecatch_below_primary' ); 
    ?>
     	
	<?php 
    if ( $layout == 'left-sidebar' ||  $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'right-sidebar' ) ) {
    	get_sidebar(); 
    }  
	
	get_footer();

} // simplecatch_content
endif;
 

if ( ! function_exists( 'simplecatch_loop' ) ) :
/**
 * Display the page/post loop part
 * @since Simple Catch Pro 1.3.2
 */
function simplecatch_loop() {

	if ( is_page() ): ?>
    
		<section <?php post_class(); ?> >
        	<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h1>
            </header>
            <div class="entry-content clearfix">
				<?php the_content(); 
                // copy this <!--nextpage--> and paste at the post content where you want to break the page
                 wp_link_pages(array( 
                        'before'			=> '<div class="pagination">Pages: ',
                        'after' 			=> '</div>',
                        'link_before' 		=> '<span>',
                        'link_after'       	=> '</span>',
                        'pagelink' 			=> '%',
                        'echo' 				=> 1 
                ) ); ?>
           	</div>   
		</section><!-- .post -->
        
    <?php elseif ( is_single() ): ?>
    
		<section <?php post_class(); ?>>
        	<header class="entry-header">
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h1>
                <div class="entry-meta">
                    <ul class="clearfix">
                        <li class="no-padding-left author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo esc_attr(get_the_author_meta( 'display_name' ) ); ?>" rel="author"><?php _e( 'By', 'simplecatch' ); ?>&nbsp;<?php the_author_meta( 'display_name' );?></a></li>
                        <li class="entry-date updated"><?php $simplecatch_date_format = get_option( 'date_format' ); the_time( $simplecatch_date_format ); ?></li>
                        <li><?php comments_popup_link( __( 'No Comments', 'simplecatch' ), __( '1 Comment', 'simplecatch' ), __( '% Comments', 'simplecatch' ) ); ?></li>
                    </ul>
                </div>
           	</header>
            <div class="entry-content clearfix">
				<?php the_content();
                // copy this <!--nextpage--> and paste at the post content where you want to break the page
                 wp_link_pages(array( 
                        'before'			=> '<div class="pagination">Pages: ',
                        'after' 			=> '</div>',
                        'link_before' 		=> '<span>',
                        'link_after'       	=> '</span>',
                        'pagelink' 			=> '%',
                        'echo' 				=> 1 
                    ) );
                ?>
			</div>
            <footer class="entry-meta">
            	<?php 
                $tag = get_the_tags();
                if (! $tag ) { ?>
                    <div class='tags'><?php _e( 'Categories: ', 'simplecatch' ); ?> <?php the_category(', '); ?> </div>
                <?php } else { 
                   	the_tags( '<div class="tags"> ' . __('Tags', 'simplecatch') . ': ', ', ', '</div>'); 
                } ?>
           	</footer>
		</section> <!-- .post -->
            
	<?php endif;
} // simplecatch_loop
endif;


/**
 * Redirect WordPress Feeds To FeedBurner
 */
function simplecatch_rss_redirect() {
	global $simplecatch_options_settings;
    $options = $simplecatch_options_settings;
	
    if ($options['feed_url']) {
		$url = 'Location: '.$options['feed_url'];
		if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']))
		{
			header($url);
			header('HTTP/1.1 302 Temporary Redirect');
		}
	}
}
add_action('template_redirect', 'simplecatch_rss_redirect');


if ( ! function_exists( 'simplecatch_comment_form_fields' ) ) :
/**
 * Altering Comment Form Fields
 * @uses comment_form_default_fields filter
 */
function simplecatch_comment_form_fields( $fields ) {
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
    $fields['author'] = '<label for="author">' . __('Name','simplecatch') . '</label><input type="text" class="text" placeholder="'.esc_attr__( 'Name', 'simplecatch' ) .'&nbsp;'. ( $req ? esc_attr__( '( required )', 'simplecatch' ) : '' ) .'" name="author"'. $aria_req .' />';
	$fields['email'] = '<label for="email">' . __('Email','simplecatch') . '</label><input type="text" class="text" placeholder="'.esc_attr__( 'Email', 'simplecatch' ) .'&nbsp;'. ( $req ? esc_attr__( '( required )', 'simplecatch' ) : '' ) .'" name="email"'. $aria_req .' />';
	$fields['url'] = '<label for="url">' . __('Website','simplecatch') . '</label><input type="text" class="text" placeholder="'.esc_attr__( 'Website', 'simplecatch' ) .'" name="url"'. $aria_req .' />';

    return $fields;
} // simplecatch_comment_form_fields
endif;
add_filter( 'comment_form_default_fields', 'simplecatch_comment_form_fields' );


if ( ! function_exists( 'simplecatch_comment_form_defaults' ) ) :
/**
 * Altering Comment Form Defaults
 *
 * @uses comment_form_defaults filter
 */
function simplecatch_comment_form_defaults( $defaults ) {

	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';
	$defaults['title_reply'] = __( 'Leave a Comment', 'simplecatch' );

	return $defaults;
} // simplecatch_comment_form_defaults
endif;
add_filter( 'comment_form_defaults', 'simplecatch_comment_form_defaults' );


/**
 * Get the Web Clip Icon from theme options
 *
 * @uses web clip 
 * @get the data value of image from theme options
 * @display web clip
 *
 * @uses set_transient and delete_transient 
 */
function simplecatch_webclip() {
	//delete_transient( 'simplecatch_webclip' );	
	
	if( ( !$simplecatch_webclip = get_transient( 'simplecatch_webclip' ) ) ) {
		global $simplecatch_options_settings;
        $options = $simplecatch_options_settings;
		
		echo '<!-- refreshing cache -->';
		
		// if not empty fav_icon on theme options
		if ( !empty( $options[ 'web_clip' ] ) ) :
			$simplecatch_webclip = '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $options[ 'web_clip' ] ).'" />'; 	
		endif;
		
		set_transient( 'simplecatch_webclip', $simplecatch_webclip, 86940 );	
	}	
	echo $simplecatch_webclip ;	
} // simplecatch_webclip

//Load Web Clip Icon in Header Section
add_action('wp_head', 'simplecatch_webclip');


/**
 * Adds in post and Page ID when viewing lists of posts and pages
 * This will help the admin to add the post ID in featured slider
 * 
 * @param mixed $post_columns
 * @return post columns
 */
function simplecatch_post_id_column( $post_columns ) {
	$beginning = array_slice( $post_columns, 0 ,1 );
	$beginning[ 'postid' ] = __( 'ID', 'simplecatch'  );
	$ending = array_slice( $post_columns, 1 );
	$post_columns = array_merge( $beginning, $ending );
	return $post_columns;
}
add_filter( 'manage_posts_columns', 'simplecatch_post_id_column' );
add_filter( 'manage_pages_columns', 'simplecatch_post_id_column' );

function simplecatch_posts_id_column( $col, $val ) {
	if( $col == 'postid' ) echo $val;
}
add_action( 'manage_posts_custom_column', 'simplecatch_posts_id_column', 10, 2 );
add_action( 'manage_pages_custom_column', 'simplecatch_posts_id_column', 10, 2 );

function simplecatch_posts_id_column_css() {
	echo '<style type="text/css">#postid { width: 40px; }</style>';
}
add_action( 'admin_head-edit.php', 'simplecatch_posts_id_column_css' );



if ( ! function_exists( 'simplecatch_menu_alter' ) ) :
/**
* Add default navigation menu to nav menu
* Used while viewing on smaller screen
*/
function simplecatch_menu_alter( $items, $args ) {
	$items .= '<li class="default-menu"><a href="' . esc_url( home_url( '/' ) ) . '" title="Menu">'.__( 'Menu', 'simplecatch' ).'</a></li>';
	return $items;
}
endif; // simplecatch_menu_alter
add_filter( 'wp_nav_menu_items', 'simplecatch_menu_alter', 10, 2 );


if ( ! function_exists( 'simplecatch_pagemenu_alter' ) ) :
/**
 * Add default navigation menu to page menu
 * Used while viewing on smaller screen
 */
function simplecatch_pagemenu_alter( $output ) {
	$output .= '<li class="default-menu"><a href="' . esc_url( home_url( '/' ) ) . '" title="Menu">'.__( 'Menu', 'simplecatch' ).'</a></li>';
	return $output;
}
endif; // simplecatch_pagemenu_alter
add_filter( 'wp_list_pages', 'simplecatch_pagemenu_alter' );


if ( ! function_exists( 'simplecatch_pagemenu_filter' ) ) :
/**
 * @uses wp_page_menu filter hook
 */
function simplecatch_pagemenu_filter( $text ) {
	$replace = array(
		'current_page_item'	=> 'current-menu-item'
	);

	$text = str_replace( array_keys( $replace ), $replace, $text );
  	return $text;
	
}
endif; // simplecatch_pagemenu_filter
add_filter('wp_page_menu', 'simplecatch_pagemenu_filter');


if ( !function_exists( 'simplecatch_infinite_scroll_render' ) ):
/**
 * Set the code to be rendered on for calling posts,
 * hooked to template parts when possible.
 *
 * Note: must define a loop.
 */
function simplecatch_infinite_scroll_render() {
   get_template_part( 'content' );
} // simplecatch_infinite_scroll_render
endif;


if ( ! function_exists( 'simplecatch_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Catch Everest 1.0
 */
function simplecatch_content_nav( $nav_id ) {
	global $wp_query, $post;
	
	/**
	 * Check Jetpack Infinite Scroll
	 * if it's active then disable pagination
	 */
	if ( class_exists( 'Jetpack', false ) ) {
		$jetpack_active_modules = get_option('jetpack_active_modules');
		if ( $jetpack_active_modules && in_array( 'infinite-scroll', $jetpack_active_modules ) ) {
			return false;
		}
	}	
	
	// Checking WP Page Numbers plugin exist
	if ( function_exists('wp_pagenavi' ) ) : 
		wp_pagenavi();
	
	// Checking WP-PageNaviplugin exist
	elseif ( function_exists('wp_page_numbers' ) ) : 
		wp_page_numbers();
		   
	else: 
		if ( $wp_query->max_num_pages > 1 ) : 
	?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php next_posts_link( __( 'Previous', 'simplecatch' ) ); ?></li>
				<li class="next"><?php previous_posts_link( __( 'Next', 'simplecatch' ) ); ?></li>
			</ul>
		<?php endif;
	endif; 
}
endif; // simplecatch_content_nav