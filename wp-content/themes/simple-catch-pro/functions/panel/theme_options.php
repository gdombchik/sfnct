<?php
/**
 * Simple Catch Pro Theme Options
 *
 * @package Catch Themes
 * @subpackage Simple_Catch_Pro
 * @since Simple Catch Pro 1.0
 */
add_action( 'admin_init', 'simplecatch_register_settings' );
add_action( 'admin_menu', 'simplecatch_options_menu' );


/**
 * Enqueue admin script and styles
 *
 * @uses wp_register_script, wp_enqueue_script and wp_enqueue_style
 * @Calling jquery, jquery-ui-tabs,jquery-cookie, jquery-ui-sortable, jquery-ui-draggable, media-upload, thickbox, farbtastic, colorpicker
 */
function simplecatch_admin_scripts() {
	//jquery-cookie registered in functions.php
	wp_enqueue_script( 'simplecatch_admin', get_template_directory_uri().'/functions/panel/admin.min.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
	wp_enqueue_script( 'simplecatch_upload', get_template_directory_uri().'/functions/panel/add_image_scripts.min.js', array( 'jquery','media-upload','thickbox' ) );
	wp_enqueue_script( 'simplecatch_color', get_template_directory_uri().'/functions/panel/color_picker.min.js', array( 'farbtastic' ) );
	
	wp_enqueue_style( 'simplecatch_admin_style',get_template_directory_uri().'/functions/panel/admin.min.css', array( 'farbtastic', 'thickbox' ), '1.0', 'screen' );
}
add_action('admin_print_styles-appearance_page_theme_options', 'simplecatch_admin_scripts');


/*
 * Create a function for Theme Options Page
 *
 * @uses add_menu_page
 * @add action admin_menu 
 */
function simplecatch_options_menu() {

	add_theme_page( 
        __( 'Theme Options', 'simplecatch' ),           // Name of page
        __( 'Theme Options', 'simplecatch' ),           // Label in menu
        'edit_theme_options',                           // Capability required
        'theme_options',                                // Menu slug, used to uniquely identify the page
        'simplecatch_theme_options_do_page'             // Function that renders the options page
    );	

}


/*
 * Register options and validation callbacks
 *
 * @uses register_setting
 * @action admin_init
 */
function simplecatch_register_settings(){
	register_setting( 'simplecatch_options', 'simplecatch_options', 'simplecatch_theme_options_validate' );
}


/*
 * Render Simple Catch Pro Theme Options page
 *
 * @uses settings_fields, get_option, bloginfo
 * @Settings Updated
 */
function simplecatch_theme_options_do_page() {
	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
	<div id="catchthemes" class="wrap">
    	
    	<form method="post" action="options.php">
			<?php
                settings_fields( 'simplecatch_options' );
                global $simplecatch_options_settings;
                $options = $simplecatch_options_settings;				
            ?>   
            <?php if (false !== $_REQUEST['settings-updated']) : ?>
            	<div class="updated fade"><p><strong><?php _e('Options Saved', 'simplecatch'); ?></strong></p></div>
            <?php endif; ?>            
            
			<div id="theme-option-header">
            
                <div id="theme-option-title">
                    <h2 class="title"><?php _e( 'Theme Options By', 'simplecatch' ); ?></h2>
                    <h2 class="logo">
                        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'simplecatch' ) ); ?>" title="<?php esc_attr_e( 'Catch Themes', 'simplecatch' ); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/functions/panel/images/catch-themes.png'; ?>" alt="<?php _e( 'Catch Themes', 'simplecatch' ); ?>" />
                        </a>
                    </h2>
                </div><!-- #theme-option-title -->
            
                <div id="theme-support">
                    <ul>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/support-forum/forum/simple-catch-pro-premium/','simplecatch')); ?>" title="<?php esc_attr_e('Support Forum', 'simplecatch'); ?>" target="_blank"><?php printf(__('Support Forum','simplecatch')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/theme-instructions/simple-catch-pro/','simplecatch')); ?>" title="<?php esc_attr_e('Theme Instruction', 'simplecatch'); ?>" target="_blank"><?php printf(__('Theme Instruction','simplecatch')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://www.facebook.com/catchthemes/','simplecatch')); ?>" title="<?php esc_attr_e('Like Catch Themes on Facebook', 'simplecatch'); ?>" target="_blank"><?php printf(__('Facebook','simplecatch')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://twitter.com/catchthemes/','simplecatch')); ?>" title="<?php esc_attr_e('Follow Catch Themes on Twitter', 'simplecatch'); ?>" target="_blank"><?php printf(__('Twitter','simplecatch')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://wordpress.org/support/view/theme-reviews/simple-catch','simplecatch')); ?>" title="<?php esc_attr_e('Rate us 5 Star on WordPress', 'simplecatch'); ?>" target="_blank"><?php printf(__('5 Star Rating','simplecatch')); ?></a></li>
                   	</ul>
                </div><!-- #theme-support --> 
                 
          	</div><!-- #theme-option-header -->              
 
            
            <div id="simplecatch_ad_tabs">
                <ul class="tabNavigation" id="mainNav">
                    <li><a href="#themeoptions"><?php _e( 'Theme Options', 'simplecatch' );?></a></li>
                    <li><a href="#slidersettings"><?php _e( 'Featured Slider', 'simplecatch' );?></a></li>
                    <li><a href="#sociallinks"><?php _e( 'Social Links', 'simplecatch' );?></a></li>
                    <li><a href="#webmaster"><?php _e( 'Webmaster Tools', 'simplecatch' );?></a></li>
                </ul><!-- .tabsNavigation #mainNav -->
                   
                   
                <!-- Option for Theme Options -->
                <div id="themeoptions">     
					<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Responsive Design', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Responsive Design?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[disable_responsive]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[disable_responsive]" value="1" <?php checked( '1', $options['disable_responsive'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>
                               	</tbody>
                          	</table>
                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Fav Icon Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Favicon?', 'simplecatch' ); ?></th>
                                         <input type='hidden' value='0' name='simplecatch_options[remove_favicon]'>
                                        <td><input type="checkbox" id="favicon" name="simplecatch_options[remove_favicon]" value="1" <?php checked( '1', $options['remove_favicon'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Fav Icon URL:', 'simplecatch' ); ?></th>
                                        <td><?php if ( !empty ( $options[ 'fav_icon' ] ) ) { ?>
                                                <input class="upload-url" size="65" type="text" name="simplecatch_options[fav_icon]" value="<?php echo esc_url( $options [ 'fav_icon' ] ); ?>" class="upload" />
                                            <?php } else { ?>
                                                <input size="65" type="text" name="simplecatch_options[fav_icon]" value="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" alt="fav" />
                                            <?php }  ?> 
                                            <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Fav Icon','simplecatch' );?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><?php _e( 'Preview: ', 'simplecatch' ); ?></th>
                                        <td> 
                                            <?php 
                                                if ( !empty( $options[ 'fav_icon' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'fav_icon' ] ).'" alt="fav" />';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/favicon.ico" alt="fav" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Web Clip Icon Option', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Web Clip Icon URL:', 'simplecatch' ); ?></th>
                                        <td>
                                        	<input class="upload-url" size="65" type="text" name="simplecatch_options[web_clip]" value="<?php echo esc_url( $options [ 'web_clip' ] ); ?>" class="upload" />
                                            <input id="web-clip-image" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Upload/Change Web Clip Icon','simplecatch' );?>" />
                                     	</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><?php _e( 'Preview: ', 'simplecatch' ); ?></th>
                                        <td> 
                                            <?php 
                                                if ( !empty( $options[ 'web_clip' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'web_clip' ] ).'" alt="Web Clip Icon" />';
                                                } else { ?>
                                                    <p><?php _e( 'No Web Clip Icon Found. Upload Web Clip Icon.', 'simplecatch' ); ?></p>
                                               <?php
											   }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                     
                                        
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Header Logo?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[remove_header_logo]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[remove_header_logo]" value="1" <?php checked( '1', $options['remove_header_logo'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Header logo url:', 'simplecatch' ); ?></th>
                                        <td>
                                            <?php  if ( !empty ( $options[ 'featured_logo_header' ] ) ) { ?>
                                             	<input  class="upload-url" size="65" type="text" name="simplecatch_options[featured_logo_header]" value="<?php echo esc_url ( $options [ 'featured_logo_header' ]); ?>" class="upload" />
                                                 <?php } else { ?>
                                                 <input size="65" type="text" name="simplecatch_options[featured_logo_header]" value="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo" />
                                                 <?php }  ?>
                                                
                                                <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Header Logo','simplecatch' ); ?>" />
                                        </td>
                                    </tr> 
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Preview:', 'simplecatch' ); ?></th>
                                        <td>              
                                            <?php 
                                                if ( !empty( $options[ 'featured_logo_header' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'featured_logo_header' ] ).'" alt="logo"/>';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/logo.png" alt="logo" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Site Title?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[remove_site_title]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[remove_site_title]" value="1" <?php checked( '1', $options['remove_site_title'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>  
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Site Description?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[remove_site_description]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[remove_site_description]" value="1" <?php checked( '1', $options['remove_site_description'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Move Site Title and Description', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[site_title_above]'>
                                        <td><input type="checkbox" id="favicon" name="simplecatch_options[site_title_above]" value="1" <?php checked( '1', $options['site_title_above'] ); ?> /> <?php _e('Check to move before the Header/Logo Image', 'simplecatch'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  

					<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Right Sidebar Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table"> 
                            	<tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Header Right Sidebar?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[disable_header_right_sidebar]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[disable_header_right_sidebar]" value="1" <?php checked( '1', $options['disable_header_right_sidebar'] ); ?> /> <?php _e('Check to Disable', 'simplecatch'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Header Right Sidebar', 'simplecatch' ); ?></th>
                                        <td><a class="button" href="<?php echo esc_url( admin_url( 'widgets.php' ) ) ; ?>" title="<?php esc_attr_e( 'Widgets', 'simplecatch' ); ?>"><?php _e( 'Click Here to Add/Replace Widgets', 'simplecatch' );?></a></td>
                                    </tr>
                         		</tbody>
                            </table>
                       	 	<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'simplecatch' ); ?>" /></p> 
						</div><!-- .option-content --> 
                 	</div><!-- .option-container -->  

            		<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Color Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">  
                                <tbody>
                               		<tr>
                                        <th scope="row"><label><?php _e( 'Default Color Scheme', 'catcheverest' ); ?></label></th>
                                        <td>
                                            <label title="color-light" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/default.jpg" alt="color-default" /><br />
                                            <input type="radio" name="simplecatch_options[color_scheme]" id="color-default" <?php checked($options['color_scheme'], 'default'); ?> value="default"  />
                                            <?php _e( 'Default', 'catcheverest' ); ?>
                                            </label>
                                            <label title="color-dark" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/dark.jpg" alt="color-dark" /><br />
                                            <input type="radio" name="simplecatch_options[color_scheme]" id="color-dark" <?php checked($options['color_scheme'], 'dark'); ?> value="dark"  />
                                            <?php _e( 'Dark', 'catcheverest' ); ?>
                                            </label>  
                                            <label title="color-brown" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/brown.jpg" alt="color-brown" /><br />
                                            <input type="radio" name="simplecatch_options[color_scheme]" id="color-brown" <?php checked($options['color_scheme'], 'brown'); ?> value="brown"  />
                                            <?php _e( 'Brown', 'catcheverest' ); ?>
                                            </label>                                                                                 
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_header_background">
                                                <?php _e( 'Header Top Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_header_top_background" name="simplecatch_options[header_top_background]" size="8" value="<?php echo ( isset( $options[ 'header_top_background' ] ) ) ? esc_attr( $options[ 'header_top_background' ] ) : 'transparent'; ?>"  />
                                            <div id="colorpicker_header_top_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>                                  
                                    <tr>
                                        <th>
                                            <label for="simplecatch_header_background">
                                                <?php _e( 'Header Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_header_background" name="simplecatch_options[header_background]" size="8" value="<?php echo ( isset( $options[ 'header_background' ] ) ) ? esc_attr( $options[ 'header_background' ] ) : 'transparent'; ?>"  />
                                            <div id="colorpicker_header_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_background">
                                                <?php _e( 'Content Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-background'); ?>">
                                            	<?php _e( 'Click Here to change Content Background Color/Image', 'simplecatch' ); ?>
                                           	</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_footer_background">
                                                <?php _e( 'Footer Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_footer_background" name="simplecatch_options[footer_background]" size="8" value="<?php echo ( isset( $options[ 'footer_background' ] ) ) ? esc_attr( $options[ 'footer_background' ] ) : 'transparent'; ?>"  />
                                            <div id="colorpicker_footer_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_footer_sidebar_background">
                                                <?php _e( 'Footer Sidebar Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_footer_sidebar_background" name="simplecatch_options[footer_sidebar_background]" size="8" value="<?php echo ( isset( $options[ 'footer_sidebar_background' ] ) ) ? esc_attr( $options[ 'footer_sidebar_background' ] ) : 'transparent'; ?>"  />
                                            <div id="colorpicker_footer_sidebar_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_header_footer_border">
                                                <?php _e( 'Header & Footer Border Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_header_footer_border" name="simplecatch_options[header_footer_border]" size="8" value="<?php echo ( isset( $options[ 'header_footer_border' ] ) ) ? esc_attr( $options[ 'header_footer_border' ] ) : '#ccc'; ?>"  />
                                            <div id="colorpicker_header_footer_border" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>    
                                    
                                    
                                    <tr>
                                        <th>
                                            <label for="simplecatch_title_color">
                                                <?php _e( 'Site Title Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_title_color" name="simplecatch_options[title_color]" size="8" value="<?php echo ( isset( $options[ 'title_color' ] ) ) ? esc_attr( $options[ 'title_color' ] ) : '#444'; ?>"  />
                                            <div id="colorpicker_title_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_tagline">
                                                <?php _e( 'Site Tagline/ Description Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_simplecatch_tagline" name="simplecatch_options[tagline_color]" size="8" value="<?php echo ( isset( $options[ 'tagline_color' ] ) ) ? esc_attr( $options[ 'tagline_color' ] ) : '#666'; ?>"  />
                                            <div id="colorpicker_tagline_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>                                                               
                                	<tr>
                                        <th>
                                            <label for="simplecatch_heading_color">
                                                <?php _e( 'Heading Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_heading_color" name="simplecatch_options[heading_color]" size="8" value="<?php echo ( isset( $options[ 'heading_color' ] ) ) ? esc_attr( $options[ 'heading_color' ] ) : '#444'; ?>"  />
                                            <div id="colorpicker_heading_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_meta_color">
                                                <?php _e( 'Meta Description Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_meta_color" name="simplecatch_options[meta_color]" size="8" value="<?php echo ( isset( $options[ 'meta_color' ] ) ) ? esc_attr( $options[ 'meta_color' ] ) : '#999'; ?>"  />
                                            <div id="colorpicker_meta_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_text_color">
                                                <?php _e( 'Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_text_color" name="simplecatch_options[text_color]" size="8" value="<?php echo ( isset( $options[ 'text_color' ] ) ) ? esc_attr( $options[ 'text_color' ] ) : '#555'; ?>"  />
                                            <div id="colorpicker_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_link_color">
                                                <?php _e( 'Link Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_link_color" name="simplecatch_options[link_color]" size="8" value="<?php echo ( isset( $options[ 'link_color' ] ) ) ? esc_attr( $options[ 'link_color' ] ) : '#000'; ?>"  />
                                            <div id="colorpicker_link_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
        							<tr>
                                        <th>
                                            <label for="simplecatch_widget_heading_color">
                                                <?php _e( 'Sidebar Widget Heading Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_widget_heading_color" name="simplecatch_options[widget_heading_color]" size="8" value="<?php echo ( isset( $options[ 'widget_heading_color' ] ) ) ? esc_attr( $options[ 'widget_heading_color' ] ) : '#666'; ?>"  />
                                            <div id="colorpicker_widget_heading_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_widget_text_color">
                                                <?php _e( 'Sidebar Widget Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_widget_text_color" name="simplecatch_options[widget_text_color]" size="8" value="<?php echo ( isset( $options[ 'widget_text_color' ] ) ) ? esc_attr( $options[ 'widget_text_color' ] ) : '#666'; ?>"  />
                                            <div id="colorpicker_widget_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_widget_link_color">
                                                <?php _e( 'Sidebar Widget Link Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_widget_link_color" name="simplecatch_options[widget_link_color]" size="8" value="<?php echo ( isset( $options[ 'widget_link_color' ] ) ) ? esc_attr( $options[ 'widget_link_color' ] ) : '#666'; ?>"  />
                                            <div id="colorpicker_widget_link_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_menu_bg_color">
                                                <?php _e( 'Menu Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_menu_bg_color" name="simplecatch_options[menu_bg_color]" size="8" value="<?php echo ( isset( $options[ 'menu_bg_color' ] ) ) ? esc_attr( $options[ 'menu_bg_color' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_menu_bg_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_menu_text_color">
                                                <?php _e( 'Menu Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_menu_text_color" name="simplecatch_options[menu_text_color]" size="8" value="<?php echo ( isset( $options[ 'menu_text_color' ] ) ) ? esc_attr( $options[ 'menu_text_color' ] ) : '#444'; ?>"  />
                                            <div id="colorpicker_menu_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_border_color">
                                                <?php _e( 'Menu Border Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_border_color" name="simplecatch_options[border_color]" size="8" value="<?php echo ( isset( $options[ 'border_color' ] ) ) ? esc_attr( $options[ 'border_color' ] ) : '#ccc'; ?>"  />
                                            <div id="colorpicker_border_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_hover_active_color">
                                                <?php _e( 'Menu Hover & Active Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_hover_active_color" name="simplecatch_options[hover_active_color]" size="8" value="<?php echo ( isset( $options[ 'hover_active_color' ] ) ) ? esc_attr( $options[ 'hover_active_color' ] ) : '#444'; ?>"  />
                                            <div id="colorpicker_hover_active_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_hover_active_text_color">
                                                <?php _e( 'Menu Hover & Active Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_hover_active_text_color" name="simplecatch_options[hover_active_text_color]" size="8" value="<?php echo ( isset( $options[ 'hover_active_text_color' ] ) ) ? esc_attr( $options[ 'hover_active_text_color' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_hover_active_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>
                                            <label for="simplecatch_sub_menu_bg_color">
                                                <?php _e( 'Sub-Menu Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_sub_menu_bg_color" name="simplecatch_options[sub_menu_bg_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_bg_color' ] ) ) ? esc_attr( $options[ 'sub_menu_bg_color' ] ) : '#444'; ?>"  />
                                            <div id="colorpicker_sub_menu_bg_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_sub_menu_text_color">
                                                <?php _e( 'Sub-Menu Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_sub_menu_text_color" name="simplecatch_options[sub_menu_text_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_text_color' ] ) ) ? esc_attr( $options[ 'sub_menu_text_color' ] ) : '#999'; ?>"  />
                                            <div id="colorpicker_sub_menu_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>                                  
                                    
                                    <tr>
                                        <th>
                                            <label for="simplecatch_sub_menu_hover_bg_color">
                                                <?php _e( 'Sub-Menu Hover Background Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_sub_menu_hover_bg_color" name="simplecatch_options[sub_menu_hover_bg_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_hover_bg_color' ] ) ) ? esc_attr( $options[ 'sub_menu_hover_bg_color' ] ) : '#333'; ?>"  />
                                            <div id="colorpicker_sub_menu_hover_bg_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_sub_menu_text_color">
                                                <?php _e( 'Sub-Menu Hover Text Color:', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="simplecatch_sub_menu_hover_text_color" name="simplecatch_options[sub_menu_hover_text_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_hover_text_color' ] ) ) ? esc_attr( $options[ 'sub_menu_hover_text_color' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_sub_menu_hover_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr> 
                                    
                                    <?php if( $options[ 'reset_color' ] == "1" ) { $options[ 'reset_color' ] = "0"; } ?>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Reset Color?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[reset_color]'>
                                        <td>
                                        	<input type="checkbox" id="headerlogo" name="simplecatch_options[reset_color]" value="1" <?php checked( '1', $options['reset_color'] ); ?> /> <?php _e('Check to reset', 'simplecatch'); ?>
                                       	</td>
                                    </tr>
                                </tbody>
                            </table>      
                      
                     		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p>	
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container --> 
            		
                    <?php
                    /**
                      * Renders the Font Family Option.
                      *
                      * @since Simple Catch Pro 1.0
                      */
					  
					  //Getting Font Available
					  $fonts = simplecatch_available_fonts();
					  
                    ?>
            		<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Font Family Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside"> 
                        	<table class="form-table">  
                                <tbody>
                                	<tr>
                                        <th>
                                            <label for="simplecatch_default_font_family">
                                                <?php _e( 'Default Font Family', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[body_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'body_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_title_font_family">
                                                <?php _e( 'Site Title Font Family', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[title_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'title_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>
                                            <label for="simplecatch_tagline_font_family">
                                                <?php _e( 'Site Tagline Font Family', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[tagline_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'tagline_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>
                                            <label for="simplecatch_headings_font_family">
                                                <?php _e( 'Headings Font Family', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[headings_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'headings_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_font_family">
                                                <?php _e( 'Content Font Family', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[content_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'content_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>                                 
                                    <?php if( $options[ 'reset_typography' ] == "1" ) { $options[ 'reset_typography' ] = "0"; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Reset Fonts?', 'simplecatch' ); ?></th>
                                            <input type='hidden' value='0' name='simplecatch_options[reset_typography]'>
                                            <td><input type="checkbox" id="reset_family" name="simplecatch_options[reset_typography]" value="1" <?php checked( '1', $options['reset_typography'] ); ?> /> <?php _e('Check to reset', 'simplecatch'); ?></td>
                                    </tr> 
                               	<tbody>                                 
                            </table>
                   			<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p>	
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->    
                     
                    <?php
                    /**
                      * Renders the Font Size Option.
                      *
                      * @since Simple Catch Pro 1.0
                      */
					  
					 	//Getting Units
						$units = array( 'px', 'pt', 'em', '%' ); 
                    ?>    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Font Size Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">  
                                <tbody>
                                	<tr>
                                        <th>
                                            <label for="simplecatch_default_font_size">
                                                <?php _e( 'Default Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[body_font_size]" type="text" value="<?php echo $options[ 'body_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[body_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'body_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_default_font_lineheight">
                                                <?php _e( 'Default Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[body_line_height]" type="text" value="<?php echo $options[ 'body_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[body_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'body_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_site_title_font_size">
                                                <?php _e( 'Site Title Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[site_title_font_size]" type="text" value="<?php echo $options[ 'site_title_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[site_title_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'site_title_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_site_title_lineheight">
                                                <?php _e( 'Site Title Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[site_title_line_height]" type="text" value="<?php echo $options[ 'site_title_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[site_title_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'site_title_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_site_description_font_size">
                                                <?php _e( 'Site Tagline Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[site_description_font_size]" type="text" value="<?php echo $options[ 'site_description_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[site_description_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'site_description_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_site_description_lineheight">
                                                <?php _e( 'Site Tagline Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[site_description_line_height]" type="text" value="<?php echo $options[ 'site_description_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[site_description_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'site_description_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_title_font_size">
                                                <?php _e( 'Content Title Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[content_title_font_size]" type="text" value="<?php echo $options[ 'content_title_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[content_title_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'content_title_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_title_lineheight">
                                                <?php _e( 'Content Title Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[content_title_line_height]" type="text" value="<?php echo $options[ 'content_title_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[content_title_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'content_title_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_hone_font_size">
                                                <?php _e( 'H1 Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[h1_font_size]" type="text" value="<?php echo $options[ 'h1_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[h1_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'h1_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="simplecatch_htwo_font_size">
                                                <?php _e( 'H2 Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[h2_font_size]" type="text" value="<?php echo $options[ 'h2_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[h2_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'h2_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_hthree_font_size">
                                                <?php _e( 'H3 Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[h3_font_size]" type="text" value="<?php echo $options[ 'h3_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[h3_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'h3_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_hfour_font_size">
                                                <?php _e( 'H4 Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[h4_font_size]" type="text" value="<?php echo $options[ 'h4_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[h4_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'h4_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_heading_font_lineheight">
                                                <?php _e( 'Headings Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[headings_line_height]" type="text" value="<?php echo $options[ 'headings_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[headings_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'headings_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_font_size">
                                                <?php _e( 'Content Font Size', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[content_font_size]" type="text" value="<?php echo $options[ 'content_font_size' ]; ?>" size="4" />
                                            <select name="simplecatch_options[content_font_size_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'content_font_size_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="simplecatch_content_font_lineheight">
                                                <?php _e( 'Content Line Height', 'simplecatch' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<input name="simplecatch_options[content_line_height]" type="text" value="<?php echo $options[ 'content_line_height' ]; ?>" size="4" />
                                            <select name="simplecatch_options[content_line_height_unit]">
												<?php foreach( $units as $unit ) : ?>
                                                    <option value="<?php echo $unit; ?>" <?php selected( $unit, $options[ 'content_line_height_unit' ] ); ?>><?php echo $unit; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>

                                    </tr>  
                                    
                                    <?php if( $options[ 'reset_typography_font_size' ] == "1" ) { $options[ 'reset_typography_font_size' ] = "0"; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Reset Font Size?', 'simplecatch' ); ?></th>
                                            <input type='hidden' value='0' name='simplecatch_options[reset_typography_font_size]'>
                                            <td><input type="checkbox" id="reset_family" name="simplecatch_options[reset_typography_font_size]" value="1" <?php checked( '1', $options['reset_typography_font_size'] ); ?> /> <?php _e('Check to reset', 'simplecatch'); ?></td>
                                    </tr> 
                               	<tbody>                                 
                            </table>
                        	<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p>	
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container --> 

                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Layout Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table content-layout">  
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Default Layout', 'simplecatch' ); ?></label></th>
                                        <td class="smallbox">
                                        	<label title="right-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/right-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="simplecatch_options[sidebar_layout]" id="right-sidebar" <?php checked($options['sidebar_layout'], 'right-sidebar') ?> value="right-sidebar"  />
                                            <?php _e( 'Right Sidebar', 'simplecatch' ); ?>
                                            </label> 
                                        	
                                            <label title="left-Sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/left-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="simplecatch_options[sidebar_layout]" id="left-sidebar" <?php checked($options['sidebar_layout'], 'left-sidebar') ?> value="left-sidebar"  />
                                            <?php _e( 'Left Sidebar', 'simplecatch' ); ?>
                                            </label>   
                                        
                                            <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/no-sidebar.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="simplecatch_options[sidebar_layout]" id="no-sidebar" <?php checked($options['sidebar_layout'], 'no-sidebar') ?> value="no-sidebar"  />
                                            <?php _e( 'No Sidebar', 'simplecatch' ); ?>
                                            </label>
                                            <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/no-sidebar-fullwidth.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="simplecatch_options[sidebar_layout]" id="no-sidebar-full-width" <?php checked($options['sidebar_layout'], 'no-sidebar-full-width') ?> value="no-sidebar-full-width"  />
                                            <?php _e( 'No Sidebar, Full Width', 'simplecatch' ); ?>
                                            </label>
                                            <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/images/one-column.png" alt="Content-Sidebar" /><br />
                                            <input type="radio" name="simplecatch_options[sidebar_layout]" id="no-sidebar-one-column" <?php checked($options['sidebar_layout'], 'no-sidebar-one-column') ?> value="no-sidebar-one-column"  />
                                            <?php _e( 'No Sidebar, One Column', 'simplecatch' ); ?>
                                            </label>                                          
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Content Layout', 'simplecatch' ); ?></label></th>
                                        <td>
                                        	<label title="content-excerpt" class="box"><input type="radio" name="simplecatch_options[content_layout]" id="content-excerpt" <?php checked($options['content_layout'], 'excerpt') ?> value="excerpt"  />
                                            <?php _e( 'Excerpt/Blog Display', 'simplecatch' ); ?>
                                            </label> 
                                            
                                        	<label title="content-full" class="box"><input type="radio" name="simplecatch_options[content_layout]" id="content-full" <?php checked($options['content_layout'], 'full') ?> value="full"  />
                                            <?php _e( 'Full Content Display', 'simplecatch' ); ?>
                                            </label>                                    
                                        </td>
                                    </tr>
                                    
                                    <?php if( $options[ 'reset_layout' ] == "1" ) { $options[ 'reset_layout' ] = "0"; } ?>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Reset Layout?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[reset_layout]'>
                                        <td>
                                            <input type="checkbox" id="headerlogo" name="simplecatch_options[reset_layout]" value="1" <?php checked( '1', $options['reset_layout'] ); ?> /> <?php _e('Check to reset', 'simplecatch'); ?>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   

                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage / Frontpage Category Setting', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <?php _e( 'Front page posts categories:', 'simplecatch' ); ?>
                                            <p>
                                                <small><?php _e( 'Only posts that belong to the categories selected here will be displayed on the front page.', 'simplecatch' ); ?></small>
                                            </p>
                                        </th>
                                        <td>
                                            <select name="simplecatch_options[front_page_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                                <option value="0" <?php if ( empty( $options['front_page_category'] ) ) { selected( true, true ); } ?>><?php _e( '--Disabled--', 'simplecatch' ); ?></option>
                                                <?php /* Get the list of categories */ 
                                                    if( empty( $options[ 'front_page_category' ] ) ) {
                                                        $options[ 'front_page_category' ] = array();
                                                    }
                                                    $categories = get_categories();
                                                    foreach ( $categories as $category) : ?>
                                                		<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['front_page_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select><br />
                                            <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'simplecatch' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Search Text Settings', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
                                    <tr> 
                                        <th scope="row"><label><?php _e( 'Default Display Text in Search', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[search_display_text]" value="<?php echo esc_attr( $options[ 'search_display_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Search Button\'s text', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[search_button_text]" value="<?php echo esc_attr( $options[ 'search_button_text' ] ); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Excerpt / More Tag Settings', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'More Tag Text', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[more_tag_text]" value="<?php echo esc_attr( $options[ 'more_tag_text' ] ); ?>" />
                                        </td>
                                    </tr>  
                                     <tr>
                                        <th scope="row"><?php _e( 'Excerpt length(words)', 'simplecatch' ); ?></th>
                                        <td><input type="text" size="3" name="simplecatch_options[excerpt_length]" value="<?php echo intval( $options[ 'excerpt_length' ] ); ?>" /></td>
                                    </tr>  
                              	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Feed Redirect', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'Feed Redirect URL', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="70" name="simplecatch_options[feed_url]" value="<?php echo esc_attr( $options[ 'feed_url' ] ); ?>" /> <?php _e( 'Add in the Feedburner URL', 'simplecatch' ); ?>
                                        </td>
                                    </tr>  
                               	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   
                    
					<div class="option-container">
						<h3 class="option-toggle"><a href="#"><?php _e( 'Footer Options', 'simplecatch' ); ?></a></h3>
						<div class="option-content inside">
							<table class="form-table">
                            	<tr>                            
                                    <th scope="row"><?php _e( 'Disable Footer Logo?', 'simplecatch' ); ?></th>
                                     <input type='hidden' value='0' name='simplecatch_options[remove_footer_logo]'>
                                    <td><input type="checkbox" id="headerlogo" name="simplecatch_options[remove_footer_logo]" value="1" <?php checked( '1', $options['remove_footer_logo'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                </tr>
                                <tr>   
                                    <th scope="row"><?php _e( 'Footer logo url: ', 'simplecatch' ); ?></th>
                                    <td>
                                        <?php  if ( !empty ( $options[ 'featured_logo_footer' ] ) ) { ?>
                                            <input class="upload-url" size="65" type="text" name="simplecatch_options[featured_logo_footer]" value="<?php echo esc_url( $options[ 'featured_logo_footer' ] ); ?>" class="upload" />
                                        <?php } else { ?>
                                            <input size="65" type="text" name="simplecatch_options[featured_logo_footer]" value="<?php echo get_template_directory_uri(); ?>/images/logo-foot.png" alt="logo" />
                                        <?php }  ?>                            
                                            <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Footer Logo','simplecatch' );?>" />  
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Preview: ', 'simplecatch' ); ?></th>
                                    <td>                     
                                        <?php 
                                            if ( !empty( $options[ 'featured_logo_footer' ] ) ) { 
                                                echo '<img src="'.esc_url( $options[ 'featured_logo_footer' ] ).'" alt="logo"/>';
                                            } else {
                                                echo '<img src="'. get_template_directory_uri().'/images/logo-foot.png" alt="logo" />';
                                            }
                                        ?>
                                     </td>
                                </tr>       	
								<tr>
									<th scope="row">
										<label for="footer-editor"><?php _e( 'Footer Editor', 'simplecatch' ); ?></label>
                                         <p>
											<small><?php _e( 'You can add custom <acronym title="Hypertext Markup Language">HTML</acronym> and/or shortcodes, which will be automatically inserted into your theme.<br />Some shorcodes: [footer-image], [the-year], [site-link], [wp-link] for current year, your site link, wordpress site link respectively.', 'simplecatch' ); ?></small>
										</p>
									</th>
									<td>
										<?php 
                                        $settings = array(
                                                'wpautop'				=> false,
                                                'media_buttons'			=> false,  // Don't show upload botton  
                                                'textarea_name'			=> 'simplecatch_options[footer_code]',
                                                'tinymce' 				=> false,  // Don't use TinyMCE in a meta box.
                                                'textarea_rows'			=> 3
                                            );
                                        wp_editor( esc_textarea( $options[ 'footer_code' ] ), 'simplecatch_options_footer_code', $settings ); ?> 
									</td>
								</tr>  
                                <?php if( $options[ 'reset_footer' ] == "1" ) { $options[ 'reset_footer' ] = "0"; } ?>
                                <tr>                            
                                    <th scope="row"><?php _e( 'Reset Footer?', 'simplecatch' ); ?></th>
                                    <input type='hidden' value='0' name='simplecatch_options[reset_footer]'>
                                    <td>
                                        <input type="checkbox" id="headerlogo" name="simplecatch_options[reset_footer]" value="1" <?php checked( '1', $options['reset_footer'] ); ?> /> <?php _e('Check to reset', 'simplecatch'); ?>
                                    </td>
                                </tr>                           
							</table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
						</div><!-- .option-content -->
          			</div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Custom CSS', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside"> 
                            <table class="form-table">  
                                <tbody>       
                                    <tr>
                                        <th scope="row"><?php _e( 'Enter your custom CSS styles.', 'simplecatch' ); ?></th>
                                        <td>
                                            <textarea name="simplecatch_options[custom_css]" id="custom-css" cols="90" rows="12"><?php echo esc_attr( $options[ 'custom_css' ] ); ?></textarea>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row"><?php _e( 'CSS Tutorial from W3Schools.', 'simplecatch' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo esc_url( __( 'http://www.w3schools.com/css/default.asp','simplecatch' ) ); ?>" title="<?php esc_attr_e( 'CSS Tutorial', 'simplecatch' ); ?>" target="_blank"><?php _e( 'Click Here to Read', 'simplecatch' );?></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                    
					<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Update Notifier', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Update Notifier?', 'simplecatch' ); ?></th>
                                        <input type='hidden' value='0' name='simplecatch_options[disable_notifier]'>
                                        <td><input type="checkbox" id="headerlogo" name="simplecatch_options[disable_notifier]" value="1" <?php checked( '1', $options['disable_notifier'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                    </tr>
                               	</tbody>
                          	</table>
                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                       
                                                                             
                </div><!-- #themeoptions --> 
                
                
                <!-- Options for Slider Settings -->
                <div id="slidersettings">
           			<div class="option-container">
                		<h3 class="option-toggle"><a href="#"><?php _e( 'Slider Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tr>
                                    <th scope="row"><label><?php _e( 'Select Slider Type', 'simplecatch' ); ?></label></th>
                                    <td>
                                        <label title="image-slider" class="box">
                                        <input type="radio" name="simplecatch_options[select_slider_type]" id="image-slider" <?php checked($options['select_slider_type'], 'image-slider') ?> value="image-slider"  />
                                        <?php _e( 'Featured Image Slider', 'simplecatch' ); ?>
                                        </label>
                                        
                                        <label title="post-slider" class="box">
                                        <input type="radio" name="simplecatch_options[select_slider_type]" id="post-slider" <?php checked($options['select_slider_type'], 'post-slider') ?> value="post-slider"  />
                                        <?php _e( 'Featured Post Slider', 'simplecatch' ); ?>
                                        </label>
                                        
                                        <label title="page-slider" class="box">
                                        <input type="radio" name="simplecatch_options[select_slider_type]" id="page-slider" <?php checked($options['select_slider_type'], 'page-slider') ?> value="page-slider"  />
                                        <?php _e( 'Featured Page Slider', 'simplecatch' ); ?>
                                        </label>
                                        
                                        <label title="category-slider" class="box">
                                        <input type="radio" name="simplecatch_options[select_slider_type]" id="category-slider" <?php checked($options['select_slider_type'], 'category-slider') ?> value="category-slider"  />
                                        <?php _e( 'Featured Category Slider', 'simplecatch' ); ?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label><?php _e( 'Enable Slider', 'simplecatch' ); ?></label></th>
                                    <td>
                                        <label title="enable-slider-homepager" class="box">
                                        <input type="radio" name="simplecatch_options[enable_slider]" id="enable-slider-homepage" <?php checked($options['enable_slider'], 'enable-slider-homepage') ?> value="enable-slider-homepage"  />
                                        <?php _e( 'Homepage / Frontpage', 'simplecatch' ); ?>
                                        </label>
                                        <label title="enable-slider-allpage" class="box">
                                        <input type="radio" name="simplecatch_options[enable_slider]" id="enable-slider-allpage" <?php checked($options['enable_slider'], 'enable-slider-allpage') ?> value="enable-slider-allpage"  />
                                         <?php _e( 'Entire Site', 'simplecatch' ); ?>
                                        </label>
                                        <label title="disable-slider" class="box">
                                        <input type="radio" name="simplecatch_options[enable_slider]" id="disable-slider" <?php checked($options['enable_slider'], 'disable-slider') ?> value="disable-slider"  />
                                         <?php _e( 'Disable', 'simplecatch' ); ?>
                                        </label>                                
                                    </td>
                                </tr>                        
                                <tr>
                                    <th scope="row"><?php _e( 'Number of Slides', 'simplecatch' ); ?></th>
                                    <td><input type="text" name="simplecatch_options[slider_qty]" value="<?php echo intval( $options[ 'slider_qty' ] ); ?>" size="2" /></td>
                                </tr> 
                                <tr>                            
                                    <th scope="row"><?php _e( 'Disable Slider Background Effect?', 'simplecatch' ); ?></th>
                                     <input type='hidden' value='0' name='simplecatch_options[remove_noise_effect]'>
                                    <td><input type="checkbox" id="headerlogo" name="simplecatch_options[remove_noise_effect]" value="1" <?php checked( '1', $options['remove_noise_effect'] ); ?> /> <?php _e('Check to disable', 'simplecatch'); ?></td>
                                </tr>
        
                                <tr>
                                    <th>
                                        <label for="simplecatch_cycle_style"><?php _e( 'Transition Effect:', 'simplecatch' ); ?></label>
                                    </th>
                                    <td>
                                        <select id="simplecatch_cycle_style" name="simplecatch_options[transition_effect]">
                                            <option value="fade" <?php selected('fade', $options['transition_effect']); ?>><?php _e( 'fade', 'simplecatch' ); ?></option>
                                            <option value="wipe" <?php selected('wipe', $options['transition_effect']); ?>><?php _e( 'wipe', 'simplecatch' ); ?></option>
                                            <option value="scrollUp" <?php selected('scrollUp', $options['transition_effect']); ?>><?php _e( 'scrollUp', 'simplecatch' ); ?></option>
                                            <option value="scrollDown" <?php selected('scrollDown', $options['transition_effect']); ?>><?php _e( 'scrollDown', 'simplecatch' ); ?></option>
                                            <option value="scrollLeft" <?php selected('scrollLeft', $options['transition_effect']); ?>><?php _e( 'scrollLeft', 'simplecatch' ); ?></option>
                                            <option value="scrollRight" <?php selected('scrollRight', $options['transition_effect']); ?>><?php _e( 'scrollRight', 'simplecatch' ); ?></option>
                                            <option value="blindX" <?php selected('blindX', $options['transition_effect']); ?>><?php _e( 'blindX', 'simplecatch' ); ?></option>
                                            <option value="blindY" <?php selected('blindY', $options['transition_effect']); ?>><?php _e( 'blindY', 'simplecatch' ); ?></option>
                                            <option value="blindZ" <?php selected('blindZ', $options['transition_effect']); ?>><?php _e( 'blindZ', 'simplecatch' ); ?></option>
                                            <option value="cover" <?php selected('cover', $options['transition_effect']); ?>><?php _e( 'cover', 'simplecatch' ); ?></option>
                                            <option value="shuffle" <?php selected('shuffle', $options['transition_effect']); ?>><?php _e( 'shuffle', 'simplecatch' ); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Delay', 'simplecatch' ); ?></th>
                                    <td>
                                        <input type="text" name="simplecatch_options[transition_delay]" value="<?php echo $options[ 'transition_delay' ]; ?>" size="2" />
                                       <span class="description"><?php _e( 'second(s)', 'simplecatch' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Length', 'simplecatch' ); ?></th>
                                    <td>
                                        <input type="text" name="simplecatch_options[transition_duration]" value="<?php echo $options[ 'transition_duration' ]; ?>" size="2" />
                                        <span class="description"><?php _e( 'second(s)', 'simplecatch' ); ?></span>
                                    </td>
                                </tr>                      
        
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
            		</div><!-- .option-container --> 
            
            		<div class="option-container image-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Image Slider Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <div id="featured-image-slider">
                                <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <div class="slides slides-<?php echo $i; ?>"> 
                                        <h3><?php _e( 'Featured Slide # ', 'simplecatch' ); ?><?php echo $i; ?></h3>      	
                                        <div class="row">
                                            <div class="col col1">
                                                Image
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" class="upload-url" name="simplecatch_options[featured_image_slider_image][<?php echo $i; ?>]" value="<?php if( array_key_exists( 'featured_image_slider_image', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_image' ] ) ) echo esc_url( $options[ 'featured_image_slider_image' ][ $i ] ); ?>" />
                                                <input id="st_upload_button" class="st_upload_button button" name="upload_button" type="button" value="<?php esc_attr_e( 'Upload','simplecatch' ); ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                <?php _e( 'Link', 'simplecatch' ); ?>
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" name="simplecatch_options[featured_image_slider_link][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_image_slider_link', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_link' ] ) ) echo esc_url( $options[ 'featured_image_slider_link' ][ $i ] ); ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                <?php _e( 'Target. Open Link in New Window?', 'simplecatch' ); ?>
                                                <input type='hidden' value='0' name='simplecatch_options[featured_image_slider_base][<?php echo absint( $i ); ?>]'> 
                                            </div>
                                            <div class="col col2">
                                                <input type="checkbox" name="simplecatch_options[featured_image_slider_base][<?php echo absint( $i ); ?>]" value="1" <?php if( array_key_exists( 'featured_image_slider_base', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_base' ] ) ) checked( '1', $options[ 'featured_image_slider_base' ][ $i ] ); ?> /> <?php _e( 'Check to open in new window', 'simplecatch' ); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                <?php _e( 'Title', 'simplecatch' ); ?>
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" name="simplecatch_options[featured_image_slider_title][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_image_slider_title', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_title' ] ) ) echo esc_attr( $options[ 'featured_image_slider_title' ][ $i ] ); ?>" />
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col col1">
                                                Content
                                            </div>
                                            <div class="col col2"><textarea name="simplecatch_options[featured_image_slider_content][<?php echo absint( $i ); ?>]" cols="100" rows="3"><?php if( array_key_exists( 'featured_image_slider_content', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_content' ] ) ) echo esc_html( $options[ 'featured_image_slider_content' ][ $i ] ); ?></textarea></div>
                                        </div> 
                                        <div class="clear"></div> 
                                    </div> <!-- .slides -->
                                <?php endfor; ?>
                            </div> <!-- .featured-image-slider -->
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->    
            
            		<div class="option-container post-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Post Slider Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tr>                            
                                    <th scope="row"><?php _e( 'Exclude Slider post from Homepage posts?', 'simplecatch' ); ?></th>
                                     <input type='hidden' value='0' name='simplecatch_options[exclude_slider_post]'>
                                    <td><input type="checkbox" id="headerlogo" name="simplecatch_options[exclude_slider_post]" value="1" <?php checked( '1', $options['exclude_slider_post'] ); ?> /> <?php _e('Check to exclude', 'simplecatch'); ?></td>
                                </tr>
                                <tbody class="sortable">
                                    <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <tr>
                                        <th scope="row"><label class="handle"><?php _e( 'Featured Slider Post #', 'simplecatch' ); ?><span class="count"><?php echo absint( $i ); ?></span></label></th>
                                        <td><input type="text" name="simplecatch_options[featured_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider', $options ) && array_key_exists( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>" />
                                        <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider', $options ) && array_key_exists ( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'simplecatch' ); ?></a>
                                        </td>
                                    </tr>                           
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here You can put your Post IDs which displays on Homepage as slider.', 'simplecatch' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
            		<div class="option-container page-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Page Slider Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody class="sortable">
                                    <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <tr>
                                        <th scope="row"><label class="handle"><?php _e( 'Featured Slider Page #', 'simplecatch' ); ?><span class="count"><?php echo absint( $i ); ?></span></label></th>
                                        <td><input type="text" name="simplecatch_options[featured_slider_page][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider_page', $options ) && array_key_exists( $i, $options[ 'featured_slider_page' ] ) ) echo absint( $options[ 'featured_slider_page' ][ $i ] ); ?>" />
                                        <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider_page', $options ) && array_key_exists ( $i, $options[ 'featured_slider_page' ] ) ) echo absint( $options[ 'featured_slider_page' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'simplecatch' ); ?></a>
                                        </td>
                                    </tr>                           
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here You can put your Page IDs which displays on Homepage as slider.', 'simplecatch' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   
                    
                    <div class="option-container category-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Category Slider Options', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>     	
                                    <tr>
                                        <th scope="row">
                                            <label for="layouts"><?php _e( 'Select Slider Categories', 'simplecatch' ); ?></label>
                                            <p><small><?php _e( 'Use this only is you want to display posts from Specific Categories in Featured Slider', 'simplecatch' ); ?></small></p>
                                        </th> 
                                        <td>
                                            <select name="simplecatch_options[slider_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                                <option value="0" <?php if ( empty( $options['slider_category'] ) ) { selected( true, true ); } ?>><?php _e( '--Disabled--', 'simplecatch' ); ?></option>
                                                <?php /* Get the list of categories */ 
                                                    if( empty( $options[ 'slider_category' ] ) ) {
                                                        $options[ 'slider_category' ] = array();
                                                    }
                                                    $categories = get_categories();
                                                    foreach ( $categories as $category) :
                                                ?>
                                                <option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['slider_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select><br />
                                            <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'simplecatch' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here you can select the categories from which latest posts will display on Featured Slider.', 'simplecatch' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                	</div><!-- .option-container -->                                          
                                     
				</div><!-- #slidersettings -->
                
                
                <!-- Options for Social Links -->
                <div id="sociallinks">
                	<div class="option-container">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Facebook', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_facebook]" value="<?php echo esc_url( $options[ 'social_facebook' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Twitter', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_twitter]" value="<?php echo esc_url( $options[ 'social_twitter'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Google+', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_googleplus]" value="<?php echo esc_url( $options[ 'social_googleplus'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Pinterest', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_pinterest]" value="<?php echo esc_url( $options[ 'social_pinterest'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Youtube', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_youtube]" value="<?php echo esc_url( $options[ 'social_youtube' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Vimeo', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_vimeo]" value="<?php echo esc_url( $options[ 'social_vimeo' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Linkedin', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_linkedin]" value="<?php echo esc_url( $options[ 'social_linkedin'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Slideshare', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_slideshare]" value="<?php echo esc_url( $options[ 'social_slideshare'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Foursquare', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_foursquare]" value="<?php echo esc_url( $options[ 'social_foursquare' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Flickr', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_flickr]" value="<?php echo esc_url( $options[ 'social_flickr' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Tumblr', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_tumblr]" value="<?php echo esc_url( $options[ 'social_tumblr' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'deviantART', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_deviantart]" value="<?php echo esc_url( $options[ 'social_deviantart' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Dribbble', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_dribbble]" value="<?php echo esc_url( $options[ 'social_dribbble' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'MySpace', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_myspace]" value="<?php echo esc_url( $options[ 'social_myspace' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'WordPress', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_wordpress]" value="<?php echo esc_url( $options[ 'social_wordpress' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'RSS', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_rss]" value="<?php echo esc_url( $options[ 'social_rss' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Delicious', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_delicious]" value="<?php echo esc_url( $options[ 'social_delicious' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Last.fm', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_lastfm]" value="<?php echo esc_url( $options[ 'social_lastfm' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Instagram', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_instagram]" value="<?php echo esc_url( $options[ 'social_instagram' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'GitHub', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_github]" value="<?php echo esc_url( $options[ 'social_github' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Vkontakte', 'simplecatch' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_vkontakte]" value="<?php echo esc_url( $options[ 'social_vkontakte'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'My World', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_myworld]" value="<?php echo esc_url( $options[ 'social_myworld' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Odnoklassniki', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_odnoklassniki]" value="<?php echo esc_url( $options[ 'social_odnoklassniki' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Goodreads', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_goodreads]" value="<?php echo esc_url( $options[ 'social_goodreads' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Skype', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_skype]" value="<?php echo esc_attr( $options[ 'social_skype' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Soundcloud', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_soundcloud]" value="<?php echo esc_url( $options[ 'social_soundcloud' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Email', 'simplecatch' ); ?></h4></th>
                                    <td><input type="text" size="45" name="simplecatch_options[social_email]" value="<?php echo sanitize_email( $options[ 'social_email' ] ); ?>" />
                                    </td>
                                </tr>                             
                            </tbody>
                        </table>                           
            			<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p>                    
                    </div><!-- .option-container -->
                </div><!-- #sociallinks -->
                
                
                <!-- Options for Webmaster Tools -->
                <div id="webmaster">
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Site Verification', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Google Site Verification ID', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[google_verification]" value="<?php echo esc_attr( $options[ 'google_verification' ] ); ?>" /> <?php _e('Enter your Google ID number only', 'simplecatch'); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr> 
                                        <th scope="row"><label><?php _e( 'Yahoo Site Verification ID', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[yahoo_verification]" value="<?php echo esc_attr( $options[ 'yahoo_verification'] ); ?>" /> <?php _e('Enter your Yahoo ID number only', 'simplecatch'); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Bing Site Verification ID', 'simplecatch' ); ?></label></th>
                                        <td><input type="text" size="45" name="simplecatch_options[bing_verification]" value="<?php echo esc_attr( $options[ 'bing_verification' ] ); ?>" /> <?php _e('Enter your Bing ID number only', 'simplecatch'); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header and Footer Codes', 'simplecatch' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>       
                                    <tr>
                                        <th scope="row"><?php _e( 'Code to display on Header', 'simplecatch' ); ?></th>
                                        <td>
                                        <textarea name="simplecatch_options[analytic_header]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_header' ] ); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td><?php _e('Note: Here you can put scripts from Google, Facebook etc. which will load on Header', 'simplecatch' ); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e('Code to display on Footer', 'simplecatch' ); ?></th>
                                        <td>
                                         <textarea name="simplecatch_options[analytic_footer]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_footer' ] ); ?></textarea>
                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td><?php _e( 'Note: Here you can put scripts from Google, Facebook, Add This etc. which will load on footer', 'simplecatch' ); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'simplecatch' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                </div><!-- #webmaster -->

            </div><!-- #simplecatch_ad_tabs -->
		</form>
	</div><!-- .wrap -->
<?php
}


/**
 * Validate content options
 * @param array $options
 * @uses esc_url_raw, absint, esc_textarea, sanitize_text_field, simplecatch_invalidate_caches
 * @return array
 */
function simplecatch_theme_options_validate( $options ) {
	
	
	global $simplecatch_options_settings;
    $input_validated = $simplecatch_options_settings;
	
	global $simplecatch_options_defaults;
	$defaults = $simplecatch_options_defaults;	
	
	$fonts = simplecatch_available_fonts();
	$units = array( 'px', 'pt', 'em', '%' );
		
    $input = array();
    $input = $options;
	
	
	// data validation for responsive layout
	if ( isset( $input['disable_responsive'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_responsive' ] = $input[ 'disable_responsive' ];
	}
	
	// data validation for update notifier
	if ( isset( $input['disable_notifier'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_notifier' ] = $input[ 'disable_notifier' ];
	}
	
	// data validation for logo
	if ( isset( $input[ 'featured_logo_header' ] ) ) {
		$input_validated[ 'featured_logo_header' ] = esc_url_raw( $input[ 'featured_logo_header' ] );
	}
	if ( isset( $input['remove_header_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_header_logo' ] = $input[ 'remove_header_logo' ];
	}
	if ( isset( $input['remove_site_title'] ) ) {
        // Our checkbox value is either 0 or 1 
        $input_validated[ 'remove_site_title' ] = $input[ 'remove_site_title' ];
    }
    if ( isset( $input['remove_site_description'] ) ) {
        // Our checkbox value is either 0 or 1 
        $input_validated[ 'remove_site_description' ] = $input[ 'remove_site_description' ];
    }
	if ( isset( $input[ 'featured_logo_footer' ] ) ) {
		$input_validated[ 'featured_logo_footer' ] = esc_url_raw( $input[ 'featured_logo_footer' ] );
	}
	if ( isset( $input['remove_footer_logo'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_footer_logo' ] = $input[ 'remove_footer_logo' ];
	}
		
	if ( isset( $input[ 'fav_icon' ] ) ) {
		$input_validated[ 'fav_icon' ] = esc_url_raw( $input[ 'fav_icon' ] );
	}
	if ( isset( $input['remove_favicon'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_favicon' ] = $input[ 'remove_favicon' ];
	}
	//Web Clip Icon URL
	if ( isset( $input[ 'web_clip' ] ) ) {
		$input_validated[ 'web_clip' ] = esc_url_raw( $input[ 'web_clip' ] );
	}	
	
	// Data Validation for Header Sidebar	
	if ( isset( $input[ 'disable_header_right_sidebar' ] ) ) {
		$input_validated[ 'disable_header_right_sidebar' ] = $input[ 'disable_header_right_sidebar' ];
	}	
	
	// Data validation for Move Site Title above Header Image
	if ( isset( $input['site_title_above'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'site_title_above' ] = $input[ 'site_title_above' ];
	}	
	
	// Data validation for Color Scheme
	if ( isset( $input['color_scheme'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'color_scheme' ] = $input[ 'color_scheme' ];
	}	
	
	// Data validation for Color Options
	if( isset( $input[ 'header_top_background' ] ) ) {
		$input_validated[ 'header_top_background' ] = wp_filter_nohtml_kses( $input[ 'header_top_background' ] );
	}
	if( isset( $input[ 'header_background' ] ) ) {
		$input_validated[ 'header_background' ] = wp_filter_nohtml_kses( $input[ 'header_background' ] );
	}
	if( isset( $input[ 'footer_background' ] ) ) {
		$input_validated[ 'footer_background' ] = wp_filter_nohtml_kses( $input[ 'footer_background' ] );
	}
	if( isset( $input[ 'footer_sidebar_background' ] ) ) {
		$input_validated[ 'footer_sidebar_background' ] = wp_filter_nohtml_kses( $input[ 'footer_sidebar_background' ] );
	}	
	if( isset( $input[ 'header_footer_border' ] ) ) {
		$input_validated[ 'header_footer_border' ] = wp_filter_nohtml_kses( $input[ 'header_footer_border' ] );
	}	
	if( isset( $input[ 'title_color' ] ) ) {
		$input_validated[ 'title_color' ] = wp_filter_nohtml_kses( $input[ 'title_color' ] );
	}		
	if( isset( $input[ 'tagline_color' ] ) ) {
		$input_validated[ 'tagline_color' ] = wp_filter_nohtml_kses( $input[ 'tagline_color' ] );
	}			
	if( isset( $input[ 'heading_color' ] ) ) {
		$input_validated[ 'heading_color' ] = wp_filter_nohtml_kses( $input[ 'heading_color' ] );
	}
	if( isset( $input[ 'meta_color' ] ) ) {
		$input_validated[ 'meta_color' ] = wp_filter_nohtml_kses( $input[ 'meta_color' ] );
	}
	if( isset( $input[ 'text_color' ] ) ) {
		$input_validated[ 'text_color' ] = wp_filter_nohtml_kses( $input[ 'text_color' ] );
	}
	if( isset( $input[ 'link_color' ] ) ) {
		$input_validated[ 'link_color' ] = wp_filter_nohtml_kses( $input[ 'link_color' ] );
	}
	if( isset( $input[ 'widget_heading_color' ] ) ) {
		$input_validated[ 'widget_heading_color' ] = wp_filter_nohtml_kses( $input[ 'widget_heading_color' ] );
	}
	if( isset( $input[ 'widget_text_color' ] ) ) {
		$input_validated[ 'widget_text_color' ] = wp_filter_nohtml_kses( $input[ 'widget_text_color' ] );
	}	
	if( isset( $input[ 'widget_link_color' ] ) ) {
		$input_validated[ 'widget_link_color' ] = wp_filter_nohtml_kses( $input[ 'widget_link_color' ] );
	}	

	if( isset( $input[ 'menu_bg_color' ] ) ) {
		$input_validated[ 'menu_bg_color' ] = wp_filter_nohtml_kses( $input[ 'menu_bg_color' ] );
	}	
	if( isset( $input[ 'menu_text_color' ] ) ) {
		$input_validated[ 'menu_text_color' ] = wp_filter_nohtml_kses( $input[ 'menu_text_color' ] );
	}		
	if( isset( $input[ 'border_color' ] ) ) {
		$input_validated[ 'border_color' ] = wp_filter_nohtml_kses( $input[ 'border_color' ] );
	}	
	if( isset( $input[ 'hover_active_color' ] ) ) {
		$input_validated[ 'hover_active_color' ] = wp_filter_nohtml_kses( $input[ 'hover_active_color' ] );
	}	
	if( isset( $input[ 'hover_active_text_color' ] ) ) {
		$input_validated[ 'hover_active_text_color' ] = wp_filter_nohtml_kses( $input[ 'hover_active_text_color' ] );
	}	
	if( isset( $input[ 'sub_menu_bg_color' ] ) ) {
		$input_validated[ 'sub_menu_bg_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_bg_color' ] );
	}	
	if( isset( $input[ 'sub_menu_text_color' ] ) ) {
		$input_validated[ 'sub_menu_text_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_text_color' ] );
	}		
	if( isset( $input[ 'sub_menu_hover_bg_color' ] ) ) {
		$input_validated[ 'sub_menu_hover_bg_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_hover_bg_color' ] );
	}	
	if( isset( $input[ 'sub_menu_hover_text_color' ] ) ) {
		$input_validated[ 'sub_menu_hover_text_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_hover_text_color' ] );
	}
	
	if ( isset( $input['reset_color'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_color' ] = $input[ 'reset_color' ];
	}	

	//Reset Color Options
	if( $input[ 'reset_color' ] == 1 ) {
		$input_validated[ 'color_scheme' ] = $defaults[ 'color_scheme' ];
		$input_validated[ 'header_top_background' ] = $defaults[ 'header_top_background' ];
		$input_validated[ 'header_background' ] = $defaults[ 'header_background' ];
		$input_validated[ 'footer_background' ] = $defaults[ 'footer_background' ];
		$input_validated[ 'footer_sidebar_background' ] = $defaults[ 'footer_sidebar_background' ];
		$input_validated[ 'header_footer_border' ] = $defaults[ 'header_footer_border' ];
		$input_validated[ 'heading_color' ] = $defaults[ 'heading_color' ];
		$input_validated[ 'title_color' ] = $defaults[ 'title_color' ];
		$input_validated[ 'tagline_color' ] = $defaults[ 'tagline_color' ];
		$input_validated[ 'meta_color' ] = $defaults[ 'meta_color' ];
		$input_validated[ 'text_color' ] = $defaults[ 'text_color' ];
		$input_validated[ 'link_color' ] = $defaults[ 'link_color' ];
		$input_validated[ 'widget_heading_color' ] = $defaults[ 'widget_heading_color' ]; 
		$input_validated[ 'widget_text_color' ] = $defaults[ 'widget_text_color' ];
		$input_validated[ 'widget_link_color' ] = $defaults[ 'widget_link_color' ];
		$input_validated[ 'menu_bg_color' ] = $defaults[ 'menu_bg_color' ]; 
		$input_validated[ 'menu_text_color' ] = $defaults[ 'menu_text_color' ]; 
		$input_validated[ 'border_color' ] = $defaults[ 'border_color' ]; 
		$input_validated[ 'hover_active_color' ] = $defaults[ 'hover_active_color' ]; 
		$input_validated[ 'hover_active_text_color' ] = $defaults[ 'hover_active_text_color' ]; 
		$input_validated[ 'sub_menu_bg_color' ] = $defaults[ 'sub_menu_bg_color' ]; 
		$input_validated[ 'sub_menu_text_color' ] = $defaults[ 'sub_menu_text_color' ];
		$input_validated[ 'sub_menu_hover_bg_color' ] = $defaults[ 'sub_menu_hover_bg_color' ]; 
		$input_validated[ 'sub_menu_hover_text_color' ] = $defaults[ 'sub_menu_hover_text_color' ];
	}

	// data validation for Font Family Options
	if( isset( $input[ 'reset_typography'] ) ) {  
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_typography' ] = $input[ 'reset_typography' ];
		$input_validated['body_font'] = ( array_key_exists( $input['body_font'], $fonts ) ? $input['body_font'] : $defaults[ 'body_font' ] );
		$input_validated['title_font'] = ( array_key_exists( $input['title_font'], $fonts ) ? $input['title_font'] : $defaults[ 'title_font' ] );
		$input_validated['tagline_font'] = ( array_key_exists( $input['title_font'], $fonts ) ? $input['tagline_font'] : $defaults[ 'tagline_font' ] );
		$input_validated['headings_font'] = ( array_key_exists( $input['headings_font'], $fonts ) ? $input['headings_font'] : $defaults[ 'headings_font' ] );
		$input_validated['content_font'] = ( array_key_exists( $input['content_font'], $fonts ) ? $input['content_font'] : $defaults[ 'content_font' ] );
		
		if( $input[ 'reset_typography'] == '1' ) {
			$input_validated['body_font'] = $defaults[ 'body_font' ];
			$input_validated['title_font'] = $defaults[ 'title_font' ];
			$input_validated['tagline_font'] = $defaults[ 'tagline_font' ];
			$input_validated['headings_font'] = $defaults[ 'headings_font' ];		
			$input_validated['content_font'] = $defaults[ 'content_font' ];
		}
	}
	
	// data validation for Font Size Options
	if( isset( $input[ 'reset_typography_font_size'] ) ) {  
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_typography_font_size' ] = $input[ 'reset_typography_font_size' ];
		
$input_validated['body_font_size'] = number_format( floatval( $input['body_font_size'] ), 2, '.', '' );
		$input_validated['body_font_size_unit'] = ( in_array( $input['body_font_size_unit'], $units ) ? $input['body_font_size_unit'] : $defaults[ 'body_font_size_unit' ] );
		
		$input_validated['body_line_height'] = number_format( floatval( $input['body_line_height'] ), 2, '.', '' );
		$input_validated['body_line_height_unit'] = ( in_array( $input['body_line_height_unit'], $units ) ? $input['body_line_height_unit'] : $defaults[ 'body_line_height_unit' ] );
		
		$input_validated['site_title_font_size'] = number_format( floatval( $input['site_title_font_size'] ), 2, '.', '' );
		$input_validated['site_title_font_size_unit'] = ( in_array( $input['site_title_font_size_unit'], $units ) ? $input['site_title_font_size_unit'] : $defaults[ 'site_title_font_size_unit' ] );
		
		$input_validated['site_title_line_height'] = number_format( floatval( $input['site_title_line_height'] ), 2, '.', '' );
		$input_validated['site_title_line_height_unit'] = ( in_array( $input['site_title_line_height_unit'], $units ) ? $input['site_title_line_height_unit'] : $defaults[ 'site_title_line_height_unit' ] );
		
		$input_validated['site_description_font_size'] = number_format( floatval( $input['site_description_font_size'] ), 2, '.', '' );
		$input_validated['site_description_font_size_unit'] = ( in_array( $input['site_description_font_size_unit'], $units ) ? $input['site_description_font_size_unit'] : $defaults[ 'site_description_font_size_unit' ] );
		
		$input_validated['site_description_line_height'] = number_format( floatval( $input['site_description_line_height'] ), 2, '.', '' );
		$input_validated['site_description_line_height_unit'] = ( in_array( $input['site_description_line_height_unit'], $units ) ? $input['site_description_line_height_unit'] : $defaults[ 'site_description_line_height_unit' ] );
		
		$input_validated['content_title_font_size'] = number_format( floatval( $input['content_title_font_size'] ), 2, '.', '' );
		$input_validated['content_title_font_size_unit'] = ( in_array( $input['content_title_font_size_unit'], $units ) ? $input['content_title_font_size_unit'] : $defaults[ 'content_title_font_size_unit' ] );
		
		$input_validated['content_title_line_height'] = number_format( floatval( $input['content_title_line_height'] ), 2, '.', '' );
		$input_validated['content_title_line_height_unit'] = ( in_array( $input['content_title_line_height_unit'], $units ) ? $input['content_title_line_height_unit'] : $defaults[ 'content_title_line_height_unit' ] );		
		
		$input_validated['h1_font_size'] = number_format( floatval( $input['h1_font_size'] ), 2, '.', '' );
		$input_validated['h1_font_size_unit'] = ( in_array( $input['h1_font_size_unit'], $units ) ? $input['h1_font_size_unit'] : $defaults[ 'h1_font_size_unit' ] );
		
		$input_validated['h2_font_size'] = number_format( floatval( $input['h2_font_size'] ), 2, '.', '' );
		$input_validated['h2_font_size_unit'] = ( in_array( $input['h2_font_size_unit'], $units ) ? $input['h2_font_size_unit'] : $defaults[ 'h2_font_size_unit' ] );
		
		$input_validated['h3_font_size'] = number_format( floatval( $input['h3_font_size'] ), 2, '.', '' );
		$input_validated['h3_font_size_unit'] = ( in_array( $input['h3_font_size_unit'], $units ) ? $input['h3_font_size_unit'] : $defaults[ 'h3_font_size_unit' ] );
		
		$input_validated['h4_font_size'] = number_format( floatval( $input['h4_font_size'] ), 2, '.', '' );
		$input_validated['h4_font_size_unit'] = ( in_array( $input['h4_font_size_unit'], $units ) ? $input['h4_font_size_unit'] : $defaults[ 'h4_font_size_unit' ] );
		
		$input_validated['headings_line_height'] = number_format( floatval( $input['headings_line_height'] ), 2, '.', '' );
		$input_validated['headings_line_height_unit'] = ( in_array( $input['headings_line_height_unit'], $units ) ? $input['headings_line_height_unit'] : $defaults[ 'headings_line_height_unit' ] );	
		
		$input_validated['content_font_size'] = number_format( floatval( $input['content_font_size'] ), 2, '.', '' );
		$input_validated['content_font_size_unit'] = ( in_array( $input['content_font_size_unit'], $units ) ? $input['content_font_size_unit'] : $defaults[ 'content_font_size_unit' ] );
		
		$input_validated['content_line_height'] =  number_format( floatval( $input['content_line_height'] ), 2, '.', '' );
		$input_validated['content_line_height_unit'] = ( in_array( $input['content_line_height_unit'], $units ) ? $input['content_line_height_unit'] : $defaults[ 'content_line_height_unit' ] );	
		
		if( $input[ 'reset_typography_font_size'] == '1' )	{
			$input_validated['body_font_size'] = $defaults[ 'body_font_size' ];
			$input_validated['body_font_size_unit'] = $defaults[ 'body_font_size_unit' ];
			$input_validated['body_line_height'] = $defaults[ 'body_line_height' ];		
			$input_validated['body_line_height_unit'] = $defaults[ 'body_line_height_unit' ];
			$input_validated['site_title_font_size'] = $defaults[ 'site_title_font_size' ];
			$input_validated['site_title_font_size_unit'] = $defaults[ 'site_title_font_size_unit' ];
			$input_validated['site_title_line_height'] = $defaults[ 'site_title_line_height' ];		
			$input_validated['site_title_line_height_unit'] = $defaults[ 'site_title_line_height_unit' ];
			$input_validated['site_description_font_size'] = $defaults[ 'site_description_font_size' ];
			$input_validated['site_description_font_size_unit'] = $defaults[ 'site_description_font_size_unit' ];
			$input_validated['site_description_line_height'] = $defaults[ 'site_description_line_height' ];		
			$input_validated['site_description_line_height_unit'] = $defaults[ 'site_description_line_height_unit' ];
			
			$input_validated['content_title_font_size'] = $defaults[ 'content_title_font_size' ];
			$input_validated['content_title_font_size_unit'] = $defaults[ 'content_title_font_size_unit' ];
			$input_validated['content_title_line_height'] = $defaults[ 'content_title_line_height' ];		
			$input_validated['content_title_line_height_unit'] = $defaults[ 'content_title_line_height_unit' ];
			
			$input_validated['h1_font_size'] = $defaults[ 'h1_font_size' ];
			$input_validated['h1_font_size_unit'] = $defaults[ 'h1_font_size_unit' ];
			$input_validated['h2_font_size'] = $defaults[ 'h2_font_size' ];		
			$input_validated['h2_font_size_unit'] = $defaults[ 'h2_font_size_unit' ];
			$input_validated['h3_font_size'] = $defaults[ 'h3_font_size' ];
			$input_validated['h3_font_size_unit'] = $defaults[ 'h3_font_size_unit' ];
			$input_validated['h4_font_size'] = $defaults[ 'h4_font_size' ];		
			$input_validated['h4_font_size_unit'] = $defaults[ 'h4_font_size_unit' ];
			$input_validated['headings_line_height'] = $defaults[ 'headings_line_height' ];
			$input_validated['headings_line_height_unit'] = $defaults[ 'headings_line_height_unit' ];		
			$input_validated['content_font_size'] = $defaults[ 'content_font_size' ];
			$input_validated['content_font_size_unit'] = $defaults[ 'content_font_size_unit' ];
			$input_validated['content_line_height'] = $defaults[ 'content_line_height' ];
			$input_validated['content_line_height_unit'] = $defaults[ 'content_line_height_unit' ];		
		}
	}	
	
    if ( isset( $input['exclude_slider_post'] ) ) {
        // Our checkbox value is either 0 or 1 
   		$input_validated[ 'exclude_slider_post' ] = $input[ 'exclude_slider_post' ];	
	
    }
	// Front page posts categories
    if( isset( $input['front_page_category' ] ) ) {
		$input_validated['front_page_category'] = $input['front_page_category'];
    }
	
	// data validation Slider Options
	// data validation for Slider Type
	if( isset( $input[ 'select_slider_type' ] ) ) {
		$input_validated[ 'select_slider_type' ] = $input[ 'select_slider_type' ];
	}
	// data validation for Enable Slider
	if( isset( $input[ 'enable_slider' ] ) ) {
		$input_validated[ 'enable_slider' ] = $input[ 'enable_slider' ];
	}	
    // data validation for number of slides
	if ( isset( $input[ 'slider_qty' ] ) ) {
		$input_validated[ 'slider_qty' ] = absint( $input[ 'slider_qty' ] ) ? $input [ 'slider_qty' ] : 4;
	}	
    if ( isset( $input['remove_noise_effect'] ) ) {
        // Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_noise_effect' ] = $input[ 'remove_noise_effect' ];
    }
    // data validation for transition effect
    if( isset( $input[ 'transition_effect' ] ) ) {
        $input_validated['transition_effect'] = wp_filter_nohtml_kses( $input['transition_effect'] );
    }
    // data validation for transition delay
    if ( isset( $input[ 'transition_delay' ] ) && is_numeric( $input[ 'transition_delay' ] ) ) {
        $input_validated[ 'transition_delay' ] = $input[ 'transition_delay' ];
    }
    // data validation for transition length
    if ( isset( $input[ 'transition_duration' ] ) && is_numeric( $input[ 'transition_duration' ] ) ) {
        $input_validated[ 'transition_duration' ] = $input[ 'transition_duration' ];
    }	
	
	// data validation for Featured Post and Page Slider
	if ( isset( $input[ 'featured_slider' ] ) ) {
		$input_validated[ 'featured_slider' ] = array();
	}
	if ( isset( $input[ 'featured_slider_page' ] ) ) {
		$input_validated[ 'featured_slider_page' ] = array();
	}	
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_slider' ][ $i ] ) && intval( $input[ 'featured_slider' ][ $i ] ) ) {
				$input_validated[ 'featured_slider' ][ $i ] = absint($input[ 'featured_slider' ][ $i ] );
			}
			if ( !empty( $input[ 'featured_slider_page' ][ $i ] ) && intval( $input[ 'featured_slider_page' ][ $i ] ) ) {
				$input_validated[ 'featured_slider_page' ][ $i ] = absint($input[ 'featured_slider_page' ][ $i ] );
			}			
		}
	}	
	
	// data validation for Featured Image SLider 
	if ( isset( $input[ 'featured_image_slider_image' ] ) ) {
		$input_validated[ 'featured_image_slider_image' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_link' ] ) ) {
		$input_validated[ 'featured_image_slider_link' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_base' ] ) ) {
		$input_validated[ 'featured_image_slider_base' ] = array();
	}		
	if ( isset( $input[ 'featured_image_slider_title' ] ) ) {
		$input_validated[ 'featured_image_slider_title' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_content' ] ) ) {
		$input_validated[ 'featured_image_slider_content' ] = array();
	}	
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_image_slider_image' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_image' ][ $i ] = esc_url_raw($input[ 'featured_image_slider_image' ][ $i ] );
			}
			if ( !empty( $input[ 'featured_image_slider_link' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_link'][ $i ] = esc_url_raw($input[ 'featured_image_slider_link'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_base' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_base'][ $i ] = $input[ 'featured_image_slider_base'][ $i ];
			}
			if ( !empty( $input[ 'featured_image_slider_title' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_title'][ $i ] = sanitize_text_field($input[ 'featured_image_slider_title'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_content' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_content'][ $i ] = wp_kses_stripslashes($input[ 'featured_image_slider_content'][ $i ]);
			}			
		}
	}	
	//Featured Catgory Slider
	if ( isset( $input['slider_category'] ) ) {
		$input_validated[ 'slider_category' ] = $input[ 'slider_category' ];
	}		
	
	// data validation for Social Icons
	if( isset( $input[ 'social_facebook' ] ) ) {
		$input_validated[ 'social_facebook' ] = esc_url_raw( $input[ 'social_facebook' ] );
	}
	if( isset( $input[ 'social_twitter' ] ) ) {
		$input_validated[ 'social_twitter' ] = esc_url_raw( $input[ 'social_twitter' ] );
	}
	if( isset( $input[ 'social_googleplus' ] ) ) {
		$input_validated[ 'social_googleplus' ] = esc_url_raw( $input[ 'social_googleplus' ] );
	}
	if( isset( $input[ 'social_pinterest' ] ) ) {
		$input_validated[ 'social_pinterest' ] = esc_url_raw( $input[ 'social_pinterest' ] );
	}	
	if( isset( $input[ 'social_youtube' ] ) ) {
		$input_validated[ 'social_youtube' ] = esc_url_raw( $input[ 'social_youtube' ] );
	}
	if( isset( $input[ 'social_vimeo' ] ) ) {
		$input_validated[ 'social_vimeo' ] = esc_url_raw( $input[ 'social_vimeo' ] );
	}	
	if( isset( $input[ 'social_linkedin' ] ) ) {
		$input_validated[ 'social_linkedin' ] = esc_url_raw( $input[ 'social_linkedin' ] );
	}
	if( isset( $input[ 'social_slideshare' ] ) ) {
		$input_validated[ 'social_slideshare' ] = esc_url_raw( $input[ 'social_slideshare' ] );
	}	
	if( isset( $input[ 'social_foursquare' ] ) ) {
		$input_validated[ 'social_foursquare' ] = esc_url_raw( $input[ 'social_foursquare' ] );
	}
	if( isset( $input[ 'social_flickr' ] ) ) {
		$input_validated[ 'social_flickr' ] = esc_url_raw( $input[ 'social_flickr' ] );
	}
	if( isset( $input[ 'social_tumblr' ] ) ) {
		$input_validated[ 'social_tumblr' ] = esc_url_raw( $input[ 'social_tumblr' ] );
	}	
	if( isset( $input[ 'social_deviantart' ] ) ) {
		$input_validated[ 'social_deviantart' ] = esc_url_raw( $input[ 'social_deviantart' ] );
	}
	if( isset( $input[ 'social_dribbble' ] ) ) {
		$input_validated[ 'social_dribbble' ] = esc_url_raw( $input[ 'social_dribbble' ] );
	}	
	if( isset( $input[ 'social_myspace' ] ) ) {
		$input_validated[ 'social_myspace' ] = esc_url_raw( $input[ 'social_myspace' ] );
	}
	if( isset( $input[ 'social_wordpress' ] ) ) {
		$input_validated[ 'social_wordpress' ] = esc_url_raw( $input[ 'social_wordpress' ] );
	}	
	if( isset( $input[ 'social_rss' ] ) ) {
		$input_validated[ 'social_rss' ] = esc_url_raw( $input[ 'social_rss' ] );
	}
	if( isset( $input[ 'social_delicious' ] ) ) {
		$input_validated[ 'social_delicious' ] = esc_url_raw( $input[ 'social_delicious' ] );
	}	
	if( isset( $input[ 'social_lastfm' ] ) ) {
		$input_validated[ 'social_lastfm' ] = esc_url_raw( $input[ 'social_lastfm' ] );
	}	
	if( isset( $input[ 'social_instagram' ] ) ) {
		$input_validated[ 'social_instagram' ] = esc_url_raw( $input[ 'social_instagram' ] );
	}	
	if( isset( $input[ 'social_github' ] ) ) {
		$input_validated[ 'social_github' ] = esc_url_raw( $input[ 'social_github' ] );
	}
	if( isset( $input[ 'social_vkontakte' ] ) ) {
		$input_validated[ 'social_vkontakte' ] = esc_url_raw( $input[ 'social_vkontakte' ] );
	}	
	if( isset( $input[ 'social_myworld' ] ) ) {
		$input_validated[ 'social_myworld' ] = esc_url_raw( $input[ 'social_myworld' ] );
	}
	if( isset( $input[ 'social_odnoklassniki' ] ) ) {
		$input_validated[ 'social_odnoklassniki' ] = esc_url_raw( $input[ 'social_odnoklassniki' ] );
	}	
	if( isset( $input[ 'social_goodreads' ] ) ) {
		$input_validated[ 'social_goodreads' ] = esc_url_raw( $input[ 'social_goodreads' ] );
	}		
	if( isset( $input[ 'social_skype' ] ) ) {
		$input_validated[ 'social_skype' ] = sanitize_text_field( $input[ 'social_skype' ] );
	}	
	if( isset( $input[ 'social_soundcloud' ] ) ) {
		$input_validated[ 'social_soundcloud' ] = esc_url_raw( $input[ 'social_soundcloud' ] );
	}	
	if( isset( $input[ 'social_email' ] ) ) {
		$input_validated[ 'social_email' ] = sanitize_email( $input[ 'social_email' ] );
	}		
	
	//Custom CSS Style Validation
	if ( isset( $input['custom_css'] ) ) {
		$input_validated['custom_css'] = wp_kses_stripslashes($input['custom_css']);
	}
		
	//Webmaster Tool Verification
	if( isset( $input[ 'google_verification' ] ) ) {
		$input_validated[ 'google_verification' ] = wp_filter_post_kses( $input[ 'google_verification' ] );
	}
	if( isset( $input[ 'yahoo_verification' ] ) ) {
		$input_validated[ 'yahoo_verification' ] = wp_filter_post_kses( $input[ 'yahoo_verification' ] );
	}
	if( isset( $input[ 'bing_verification' ] ) ) {
		$input_validated[ 'bing_verification' ] = wp_filter_post_kses( $input[ 'bing_verification' ] );
	}	
	if( isset( $input[ 'analytic_header' ] ) ) {
		$input_validated[ 'analytic_header' ] = wp_kses_stripslashes( $input[ 'analytic_header' ] );
	}
	if( isset( $input[ 'analytic_footer' ] ) ) {
		$input_validated[ 'analytic_footer' ] = wp_kses_stripslashes( $input[ 'analytic_footer' ] );	
	}		
	
    // Layout settings verification
	if( isset( $input[ 'sidebar_layout' ] ) ) {
		$input_validated[ 'sidebar_layout' ] = $input[ 'sidebar_layout' ];
	}
	if( isset( $input[ 'content_layout' ] ) ) {
		$input_validated[ 'content_layout' ] = $input[ 'content_layout' ];
	}	
    if( isset( $input[ 'more_tag_text' ] ) ) {
        $input_validated[ 'more_tag_text' ] = htmlentities( sanitize_text_field ( $input[ 'more_tag_text' ] ), ENT_QUOTES, 'UTF-8' );
    }   
    if( isset( $input[ 'search_display_text' ] ) ) {
        $input_validated[ 'search_display_text' ] = sanitize_text_field( $input[ 'search_display_text' ] );
    }
    if( isset( $input[ 'search_button_text' ] ) ) {
        $input_validated[ 'search_button_text' ] = sanitize_text_field( $input[ 'search_button_text' ] );    
    }   
	if ( isset( $input['reset_layout'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_layout' ] = $input[ 'reset_layout' ];
	}	
	
	//Reset Color Options
	if( $input[ 'reset_layout' ] == 1 ) {
		$input_validated[ 'sidebar_layout' ] = $defaults[ 'sidebar_layout' ];
		$input_validated[ 'content_layout' ] = $defaults[ 'content_layout' ];
	}		
	
    //data validation for excerpt length
    if ( isset( $input[ 'excerpt_length' ] ) ) {
        $input_validated[ 'excerpt_length' ] = absint( $input[ 'excerpt_length' ] ) ? $input [ 'excerpt_length' ] : 30;
    }

	//Feed Redirect
	if ( isset( $input[ 'feed_url' ] ) ) {
		$input_validated['feed_url'] = esc_url_raw($input['feed_url']);
	}
	
	//footer text	
	if( isset( $input[ 'footer_code' ] ) ) {
		$input_validated['footer_code'] =  stripslashes( wp_filter_post_kses( addslashes ( $input['footer_code'] ) ) );	
	}
	if ( isset( $input['reset_footer'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_footer' ] = $input[ 'reset_footer' ];
	}	
	
	//Reset Color Options
	if( $input[ 'reset_footer' ] == 1 ) {
		$input_validated[ 'featured_logo_footer' ] = $defaults[ 'featured_logo_footer' ];
		$input_validated[ 'footer_code' ] = $defaults[ 'footer_code' ];
	}	
	
	//Clearing the theme option cache
	if( function_exists( 'simplecatch_themeoption_invalidate_caches' ) ) simplecatch_themeoption_invalidate_caches();
	
	return $input_validated;
}


/*
 * Clearing the cache if any changes in Admin Theme Option
 */
function simplecatch_themeoption_invalidate_caches(){
	delete_transient( 'simplecatch_responsive' ); // Disable responsive layout
	delete_transient( 'simplecatch_header_logo' ); 	// header logo on header
	delete_transient( 'simplecatch_header_title' ); // Site Title and Tagline on Header
	delete_transient( 'simplecatch_footerlogo' );  // footer logo on footer
	delete_transient( 'simplecatch_favicon' );	  // favicon on cpanel/ backend and frontend
	delete_transient( 'simplecatch_sliders' ); // featured post slider
	delete_transient( 'simplecatch_page_sliders' ); // featured page slider
	delete_transient( 'simplecatch_category_sliders' ); // featured category slider 
	delete_transient( 'simplecatch_imagesliders' ); // featured image slider
	delete_transient( 'simplecatch_headersocialnetworks' );  // Social links on header
	delete_transient( 'simplecatch_site_verification' ); // scripts which loads on header	
	delete_transient( 'simplecatch_footercode' ); // scripts which loads on footer
	delete_transient( 'simplecatch_inline_css' ); // Custom Inline CSS
	delete_transient( 'simplecatch_footercontent' ); // Footer content 
}


/*
 * Clears caching for header title and description
 */
function simplecatch_header_caching() {
	delete_transient( 'simplecatch_header_title' );
}
add_action('update_option_blogname','simplecatch_header_caching');
add_action('update_option_blogdescription','simplecatch_header_caching');


/*
 * Clearing the cache if any changes in post or page
 */
function simplecatch_post_invalidate_caches(){
	delete_transient( 'simplecatch_sliders' ); // featured post slider
	delete_transient( 'simplecatch_page_sliders' ); // featured page slider
	delete_transient( 'simplecatch_category_sliders' ); // featured category slider 
}
//Add action hook here save post
add_action( 'save_post', 'simplecatch_post_invalidate_caches' );


/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode() 
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function simplecatch_add_shortcodes() {
	/* Add theme-specific shortcodes. */
	add_shortcode( 'footer-image', 'simplecatch_footer_image_shortcode' );
	add_shortcode( 'the-year', 'simplecatch_the_year_shortcode' );
	add_shortcode( 'site-link', 'simplecatch_site_link_shortcode' );
	add_shortcode( 'wp-link', 'simplecatch_wp_link_shortcode' );
	add_shortcode( 'theme-link', 'simplecatch_theme_link_shortcode' );
	
}
/* Register shortcodes. */
add_action( 'init', 'simplecatch_add_shortcodes' );


/**
 * Shortcode to display Footer Image.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function simplecatch_footer_image_shortcode() {
	if( function_exists( 'simplecatch_footerlogo' ) ) :
    	return simplecatch_footerlogo(); 
    endif;
}


/**
 * Shortcode to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function simplecatch_the_year_shortcode() {
	return date( __( 'Y', 'simplecatch' ) );
}


/**
 * Shortcode to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function simplecatch_site_link_shortcode() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}


/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function simplecatch_wp_link_shortcode() {
	return '<a href="http://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'simplecatch' ) . '"><span>' . __( 'WordPress', 'simplecatch' ) . '</span></a>';
}


/**
 * Shortcode to display a link to Theme Link.
 *
 * @return string
 */
function simplecatch_theme_link_shortcode() {
	return '<a href="http://catchthemes.com/themes/simple-catch-pro" target="_blank" title="' . esc_attr__( 'Simple Catch Pro', 'simplecatch' ) . '"><span>' . __( 'Simple Catch Pro', 'simplecatch' ) . '</span></a>';
}