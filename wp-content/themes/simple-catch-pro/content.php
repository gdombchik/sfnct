<?php
/**
 * This is the template that displays content for index and archive page
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
 
//Getting data from Theme Options panel
global $simplecatch_options_settings;
$options = $simplecatch_options_settings; 
$contentlayout = $options[ 'content_layout' ];
$moretag = $options[ 'more_tag_text' ];
?>

			<?php if ( have_posts() ) : ?>
            	<?php if ( !is_home() || !is_front_page() ) { ?>
                    <header class="page-header">
                        <h1 class="page-title">
                            <?php if ( is_day() ) : ?>
                                <?php printf( __( 'Daily Archives: %s', 'simplecatch' ), '<span>' . get_the_date() . '</span>' ); ?>
                            <?php elseif ( is_month() ) : ?>
                                <?php printf( __( 'Monthly Archives: %s', 'simplecatch' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'simplecatch' ) ) . '</span>' ); ?>
                            <?php elseif ( is_year() ) : ?>
                                <?php printf( __( 'Yearly Archives: %s', 'simplecatch' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'simplecatch' ) ) . '</span>' ); ?>
                            <?php elseif ( is_category() ) : ?>
                                <?php printf( __( 'Category Archives: %s', 'simplecatch' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>  
                             <?php elseif ( is_tag() ) : ?>
                                <?php printf( __( 'Tag Archives: %s', 'simplecatch' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>       
                            <?php else : ?>
                                <?php _e( 'Blog Archives', 'simplecatch' ); ?>
                            <?php endif; ?>
                        </h1>
                    </header>
               	<?php 
				} ?>
        
                <?php while( have_posts() ):the_post(); ?>	
            
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
                    
          			<?php endwhile; ?>
                    
                    <?php simplecatch_content_nav( 'nav-below' ); ?>
                    			
			<?php else : ?>
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