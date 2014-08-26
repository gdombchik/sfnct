<?php 
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Blog Template
 *
   Template Name: Blog
 *
 * The template for Blog
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 2.1
 */
get_header();
global $more, $wp_query, $paged, $simplecatch_options_settings; 
$more = 0;
$options = $simplecatch_options_settings; 
$contentlayout = $options[ 'content_layout' ];
$moretag = $options[ 'more_tag_text' ];
	
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	}
	elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}
	else {
		$paged = 1;
	}
	
	$blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged ) );
	$temp_query = $wp_query;
	$wp_query = null;
	$wp_query = $blog_query;
	
	if ( $blog_query->have_posts() ) : ?>
	
		<header class="page-header">
        	<h1 class="page-title"><?php the_title(); ?></h1>
      	</header><!-- .page-header -->
        
        <?php /* Start the Loop */ ?>
		<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
        
        	<section <?php post_class(); ?> >
            	<?php 
				$format = get_post_format();		
				//If category has thumbnail it displays thumbnail and excerpt of content else excerpt only 
				if ( has_post_thumbnail() && $contentlayout == "excerpt" && ( false === $format ) ) : ?>
					<figure class="post-thumb no-margin-left">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'simplecatch' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'featured' ); ?></a>
					</figure> <!-- .post-thumb --> 
					<?php $postclass = "post-article";
				else :
					$postclass = "full-width";
				endif; ?>
						
                <article class="<?php echo $postclass; ?>">
                
                    <header class="entry-header">
                        <h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'simplecatch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" ><?php the_title(); ?></a></h1>
                        <div class="entry-meta">
                            <ul class="clearfix">
                                <li class="no-padding-left author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo esc_attr(get_the_author_meta( 'display_name' ) ); ?>" rel="author"><?php _e( 'By', 'simplecatch' ); ?>&nbsp;<?php the_author_meta( 'display_name' );?></a></li>
                                <li class="entry-date updated"><?php $simplecatch_date_format = get_option( 'date_format' ); the_time( $simplecatch_date_format ); ?></li>
                                <li class="last"><?php comments_popup_link( __( 'No Comments', 'simplecatch' ), __( '1 Comment', 'simplecatch' ), __( '% Comments', 'simplecatch' ) ); ?></li>
                            </ul>
                        </div> <!-- .entry-meta -->
                    </header> <!-- .entry-header -->
    
                    <?php $simplecatch_excerpt = get_the_excerpt();
                    if ( $contentlayout == "excerpt" && !empty( $simplecatch_excerpt ) && ( false === $format ) ) :
                        echo '<div class="entry-summary">';
                                the_excerpt();
                        echo '</div><!-- .entry-summary --> '; 
                    else :
                        echo '<div class="entry-content">';
                                the_content( $moretag );
                        echo '</div><!-- .entry-content --> '; 
                    endif; ?>

                </article><!-- .post-article -->  

            </section><!-- .post -->
                    
           	<hr />
                    
      	<?php endwhile;
                    
		// Checking WP Page Numbers plugin exist
		if ( function_exists('wp_pagenavi' ) ) : 
			wp_pagenavi();
		
		// Checking WP-PageNaviplugin exist
		elseif ( function_exists('wp_page_numbers' ) ) : 
			wp_page_numbers();
			   
		else: 
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : 
		?>
				<ul class="default-wp-page clearfix">
					<li class="previous"><?php next_posts_link( __( 'Previous', 'simplecatch' ) ); ?></li>
					<li class="next"><?php previous_posts_link( __( 'Next', 'simplecatch' ) ); ?></li>
				</ul>
			<?php endif;
		endif; 
		
	else : ?>
        <section <?php post_class(); ?>>	
            <article class="post">
                <header class="entry-header">
                    <h1><?php _e( 'Not found', 'simplecatch' ); ?></h1>
                </header>
                <div class="entry-content clearfix">
                    <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'simplecatch' ); ?></p>
                    <?php get_search_form(); ?>
                </div> <!-- .entry-content -->
            </article>   
            <div class="clear"></div>     
        </section><!-- .post -->   

    <?php endif; ?>
        
	</div><!-- #primary -->

    <?php
    /** 
     * simplecatch_below_primary hook
     */
    do_action( 'simplecatch_below_primary' ); 
    ?>    
            
	<?php get_sidebar(); ?>
            
        
<?php get_footer(); ?>