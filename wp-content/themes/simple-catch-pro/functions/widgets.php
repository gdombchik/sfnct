<?php
/**
 * Register Sidebar and widgets.
 *
 * @since Simple Catch Pro 1.0
 */
function simplecatch_widgets_init() {
	
	//Register Widgets
	register_widget( 'simplecatch_tagcloud_widget' );
	register_widget( 'simplecatch_ads_widget' );
	register_widget( 'simplecatch_social_widget' );
	
	/* Register Sidebar */
	//Main Sidebar
	register_sidebar( array( 
		'name'          => __( 'Main Sidebar', 'simplecatch' ),
		'id'            => 'sidebar',
		'description'   => __( 'This is main sideabar', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) ); 
	//Header Right Sidebar
	register_sidebar( array( 
		'name'          => __( 'Header Right Sidebar', 'simplecatch' ),
		'id'            => 'sidebartop',
		'description'   => __( 'This is header right sideabar', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>' 
	) ); 	
	//Hompeage Sidebar
	register_sidebar( array( 
		'name'          => __( 'Homepage Sidebar', 'simplecatch' ),
		'id'            => 'homepage-sidebar',
		'description'   => __( 'This is Homepage Sidebar which will show in Homepage', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) ); 
	//Archieve Sidebar
	register_sidebar( array( 
		'name'          => __( 'Archive Sidebar', 'simplecatch' ),
		'id'            => 'archive-sidebar',
		'description'   => __( 'This is Archive Sidebar which will show in Archives', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Page Sidebar
	register_sidebar( array( 
		'name'          => __( 'Page Sidebar', 'simplecatch' ),
		'id'            => 'page-sidebar',
		'description'   => __( 'This is Page Sidebar which will show in Page', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Post Sidebar
	register_sidebar( array( 
		'name'          => __( 'Post Sidebar', 'simplecatch' ),
		'id'            => 'post-sidebar',
		'description'   => __( 'This is Post Sidebar which will show in Post', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );	
	//Optional Sidebar One
	register_sidebar( array( 
		'name'          => __( 'Optional Sidebar One', 'simplecatch' ),
		'id'            => 'optional-sidebar-one',
		'description'   => __( 'This is Optional Sidebar One which you can select it from your post and page editor.', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Optional Sidebar One
	register_sidebar( array( 
		'name'          => __( 'Optional Sidebar Two', 'simplecatch' ),
		'id'            => 'optional-sidebar-two',
		'description'   => __( 'This is Optional Sidebar Two which you can select it from your post and page editor.', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Optional Sidebar One
	register_sidebar( array( 
		'name'          => __( 'Optional Sidebar Three', 'simplecatch' ),
		'id'            => 'optional-sidebar-three',
		'description'   => __( 'This is Optional Sidebar Three which you can select it from your post and page editor.', 'simplecatch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );	
	//Footer One Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'simplecatch' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Footer Two Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'simplecatch' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );
	//Footer Three Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'simplecatch' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr/>' 
	) );		
}
add_action( 'widgets_init', 'simplecatch_widgets_init' );


/** 
 * Simple Catch Custom Tag Cloud Widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class simplecatch_tagcloud_widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/	
	function simplecatch_tagcloud_widget() {
		$widget_ops = array('description' => __( 'Displays Custom Tag Cloud', 'simplecatch' ) );
		$control_ops = array('width' => 400, 'height' => 500);
		parent::WP_Widget(false,$name='1_Simple Catch: Custom Tag Cloud',$widget_ops,$control_ops);
	}
			
	/** Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
		
		
		echo $before_widget;
		
		if($title != '')
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		
		if ( function_exists( 'simplecatch_custom_tag_cloud' ) ):
			simplecatch_custom_tag_cloud();
		endif;
		
		echo $after_widget;
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
	
		return $instance;
	}	
	
	/**
	 * Creates the form for the widget in the back-end which includes the Title 
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
	
		$title = esc_attr($instance['title']);
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','simplecatch'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<?php		
	}
		
}// end simplecatch_tagcloud_widget class


/** 
 * Simple Catch Custom Adspace Widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class simplecatch_ads_widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function simplecatch_ads_widget() {
		$widget_ops = array( 'classname' => 'widget_simplecatch_ads_widget', 'description' => __( 'Use this widget to add any type of Ad as a widget.', 'simplecatch' ) );
		$this->WP_Widget( 'widget_simplecatch_ads_widget', __( '2_Simple Catch: Adspace Widget', 'simplecatch' ), $widget_ops );
		$this->alt_option_name = 'widget_simplecatch_ads_widget';
	}

	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
		$adcode = !empty( $instance['adcode'] ) ? $instance[ 'adcode' ] : '';
		$image = !empty( $instance['image'] ) ? $instance[ 'image' ] : '';
		$href = !empty( $instance['href'] ) ? $instance[ 'href' ] : '';
		$target = !empty( $instance[ 'target' ] ) ? 'true' : 'false';
		$alt = !empty( $instance['alt'] ) ? $instance[ 'alt' ] : '';

		if ( $target == "true" ) :
			$base = '_blank'; 	
		else:
			$base = '_self'; 	
		endif;	
		
		echo $before_widget;
		
		if ( $title != '' ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		}
		
		if ( $adcode != '' ) {
			echo $adcode;
		}
		elseif ( $image != '' ) {
        	echo '<a href="'.$href.'" target="'.$base.'"><img src="'. $image.'" alt="'.$alt.'" /></a>';
		}
		else {
			_e( 'Add Advertisement Code or Image URL', 'simplecatch' );
		}
		
		echo $after_widget;
		
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adcode'] = wp_kses_stripslashes($new_instance['adcode']);
		$instance['image'] = esc_url_raw($new_instance['image']);
		$instance['href'] = esc_url_raw($new_instance['href']);
		$instance[ 'target' ] = isset( $new_instance[ 'target' ] ) ? 1 : 0;
		$instance['alt'] = sanitize_text_field($new_instance['alt']);
		
		return $instance;
	}		

	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'adcode' => '', 'image' => '', 'href' => '', 'target' => '0', 'alt' => '' ) );
		$title = esc_attr($instance['title']);
		$adcode = esc_textarea( $instance[ 'adcode' ] );
		$image = esc_url( $instance[ 'image' ] );
		$href = esc_url( $instance[ 'href' ] );
		$target = $instance['target'] ? 'checked="checked"' : '';
		$alt = esc_attr( $instance[ 'alt' ] );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','simplecatch'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <?php if ( current_user_can( 'unfiltered_html' ) ) : // Only show it to users who can edit it ?>
            <p>
                <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','simplecatch'); ?></label>
                <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
            </p>
            <p><strong>or</strong></p>
        <?php endif; ?>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','simplecatch'); ?></label>
       	 	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','simplecatch'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
			<input class="checkbox" type="checkbox" <?php echo $target; ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" /> 				
            <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Open Link in New Window', 'catcheverest' ); ?></label>
		</p> 
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','simplecatch'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
} 


/** 
 * Extends class wp_widget
 * 
 * Creates a function simplecatch_social_widget
 * $widget_ops option array passed to wp_register_sidebar_widget().
 * $control_ops option array passed to wp_register_widget_control().
 * $name, Name for this widget which appear on widget bar.
 */
class simplecatch_social_widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function simplecatch_social_widget() {
		$widget_ops = array( 'classname' => 'simplecatch_social_widget', 'description' => __( 'Displays Social Icons added from Theme Options Panel.', 'simplecatch' ) );
		$this->WP_Widget( 'simplecatch_social_widget', __( '3_Simple Catch: Social Icons', 'simplecatch' ), $widget_ops );
		$this->alt_option_name = 'simplecatch_social_widget';
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
	
		echo $before_widget;
		
		if ( $title != '' ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} 
		
		if ( function_exists( 'simplecatch_headersocialnetworks' ) ):
			simplecatch_headersocialnetworks();
		endif;
		
		echo $after_widget;
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}	
		
	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title'=>'' ) );
		$title = esc_attr( $instance[ 'title' ] );
		
		/**
		 * Constructs title attributes  for use in form() field
		 * @return string Name attribute for $field_name
		 */
		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . 'Title:' . '</label><input class="widefat" id="' . 
		$this->get_field_id( 'title' ) . '" name="' .       $this->get_field_name( 'title' ) . '" type="text" value="' . $title . '" /> </p>';
				
	}
}// end simplecatch_social_widget class
?>