<?php 

/*-----------------------------------------------------------------------------------*/
/* START FACEBOOK WIDGET
/*-----------------------------------------------------------------------------------*/    
    
class alhenalite_facebook_widget extends WP_Widget
{
	public function __construct() 
    {
		parent::WP_Widget( "wip_facebook_widget", "Wip Facebook Box", array("description" => "Wip Facebook Box"));
	}
	
	public function form( $instance )
	{
		global $positions, $numbersdisplay;
        /* Impostazioni di default del widget */
		$defaults = array( 
			'title' => 'Follow on Facebook',
            'wip_account' => 'WPinProgress',
            'show_faces' => 'true',
            'show_stream' => 'true',
            'show_border' => 'true',
            'show_header' => 'true',
            'language' => 'en_GB',

        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$options = array('true' => 'Yes', 'false' => 'No');	

		?>
        
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( "Title","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			
		</p>  

		<p>
			<label for="<?php echo $this->get_field_id( 'wipaccount' ); ?>">
				<?php _e( "Your Facebook page","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'wip_account' ); ?>" name="<?php echo $this->get_field_name( 'wip_account' ); ?>" value="<?php echo $instance['wip_account']; ?>" />
			
		</p>  

		<p>
			
            <label for="<?php echo $this->get_field_id( 'show_faces' ); ?>">
				<?php _e( "Show Faces","wip"); ?>:
			</label>
            
            <select class="widefat" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" id="<?php echo $this->get_field_id( 'show_faces' ); ?>">
           
            <?php
            foreach ($options as $value => $name)
                {
                    if ($value == $instance['show_faces'] ) 
                            { echo "<option value='".$value."' selected='selected' >".$name."</option>"; } else
                            { echo "<option value='".$value."'>".$name."</option>"; };
                }
            ?>
            
            </select>
            
		</p> 
        
		<p>
			
            <label for="<?php echo $this->get_field_id( 'show_stream' ); ?>">
				<?php _e( "Show Stream","wip"); ?>:
			</label>
            
            <select class="widefat" name="<?php echo $this->get_field_name( 'show_stream' ); ?>" id="<?php echo $this->get_field_id( 'show_stream' ); ?>">
           
            <?php
            foreach ($options as $value => $name)
                {
                    if ($value == $instance['show_stream'] ) 
                            { echo "<option value='".$value."' selected='selected' >".$name."</option>"; } else
                            { echo "<option value='".$value."'>".$name."</option>"; };
                }
            ?>
            
            </select>
            
		</p> 

		<p>
			
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">
				<?php _e( "Show Border","wip"); ?>:
			</label>
            
            <select class="widefat" name="<?php echo $this->get_field_name( 'show_border' ); ?>" id="<?php echo $this->get_field_id( 'show_border' ); ?>">
           
            <?php
            foreach ($options as $value => $name)
                {
                    if ($value == $instance['show_border'] ) 
                            { echo "<option value='".$value."' selected='selected' >".$name."</option>"; } else
                            { echo "<option value='".$value."'>".$name."</option>"; };
                }
            ?>
            
            </select>
            
		</p> 

		<p>
			
            <label for="<?php echo $this->get_field_id( 'show_header' ); ?>">
				<?php _e( "Show Header","wip"); ?>:
			</label>
            
            <select class="widefat" name="<?php echo $this->get_field_name( 'show_header' ); ?>" id="<?php echo $this->get_field_id( 'show_header' ); ?>">
           
            <?php
            foreach ($options as $value => $name)
                {
                    if ($value == $instance['show_header'] ) 
                            { echo "<option value='".$value."' selected='selected' >".$name."</option>"; } else
                            { echo "<option value='".$value."'>".$name."</option>"; };
                }
            ?>
            
            </select>
            
		</p> 
        
		<p>
			<label for="<?php echo $this->get_field_id( 'language' ); ?>">
				<?php _e( "Language","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>" value="<?php echo $instance['language']; ?>" />
			
		</p>  

		<?php
	}
	
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['wip_account'] = strip_tags( $new_instance['wip_account'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_faces'] = strip_tags( $new_instance['show_faces'] );
		$instance['show_stream'] = strip_tags( $new_instance['show_stream'] );
		$instance['show_border'] = strip_tags( $new_instance['show_border'] );
		$instance['show_header'] = strip_tags( $new_instance['show_header'] );
		$instance['language'] = strip_tags( $new_instance['language'] );

		return $instance;
	}                     
	
		public function widget( $args, $instance )
	{
		extract( $args );

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) { echo $before_title.$title.$after_title; }

		?>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/<?php echo $instance['language'];?>/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <div class="fb-like-box" data-href="https://www.facebook.com/<?php echo $instance['wip_account'];?>" data-width="240" data-show-faces="<?php echo $instance['show_faces'];?>" data-stream="<?php echo $instance['show_stream'];?>" data-show-border="<?php echo $instance['show_border'];?>" data-header="<?php echo $instance['show_header'];?>"></div>

		<?php
		
		echo $after_widget;
	}
	
	}
function add_alhenalite_facebook_widget()
{
	register_widget( 'alhenalite_facebook_widget' );
}
add_action( 'widgets_init', 'add_alhenalite_facebook_widget' );

/*-----------------------------------------------------------------------------------*/
/* END FACEBOOK WIDGET
/*-----------------------------------------------------------------------------------*/    

?>