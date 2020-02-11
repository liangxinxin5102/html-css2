<?php 

/*-----------------------------------------------------------------------------------*/
/* START CATEGORY
/*-----------------------------------------------------------------------------------*/    
    
class alhenalite_contact_info_widget extends WP_Widget
{
	public function __construct() 
    {
		parent::WP_Widget( "wip_contact_info_widget", "Wip Contact Info Widget", array("description" => "Wip Contact Info Widget"));
	}
	
	public function form( $instance )
	{
		global $positions;

		$defaults = array( 
			'title' => 'Contact Info',
			'address' => NULL,
			'phone' => NULL,
			'mobile' => NULL,
			'fax' => NULL,
			'email' => NULL,
			'skype' => NULL,
        );
		
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		?>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( "Title","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			
		</p>  

		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>">
				<?php _e( "Address","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" />
			
		</p>  
        
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>">
				<?php _e( "Phone","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" />
			
		</p>  
        
		<p>
			<label for="<?php echo $this->get_field_id( 'mobile' ); ?>">
				<?php _e( "Mobile","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="<?php echo $instance['mobile']; ?>" />
			
		</p>  
        
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>">
				<?php _e( "Fax","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" />
			
		</p>  
        
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>">
				<?php _e( "Email","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
			
		</p>  

		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>">
				<?php _e( "Skype","wip"); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" />
			
		</p>  

		<?php
	}
	
	public function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['mobile'] = strip_tags( $new_instance['mobile'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		
		return $instance;
	}                     
	
		public function widget( $args, $instance )
	{
		extract( $args );

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title.$title.$after_title;
		}
		?>
        
        <ul class="contact-info">
        
        	<?php if (!empty($instance['address'])) echo '<li><i class="icon-map-marker"></i>'.$instance['address'].'</li>'; ?>
        	<?php if (!empty($instance['phone'])) echo '<li><i class="icon-phone"></i>'.$instance['phone'].'</li>'; ?>
        	<?php if (!empty($instance['mobile'])) echo '<li><i class="icon-mobile-phone"></i>'.$instance['mobile'].'</li>'; ?>
        	<?php if (!empty($instance['fax'])) echo '<li><i class="icon-print"></i>'.$instance['fax'].'</li>'; ?>
        	<?php if (!empty($instance['email'])) echo '<li><i class="icon-envelope-alt"></i>'.$instance['email'].'</li>'; ?>
        	<?php if (!empty($instance['skype'])) echo '<li><i class="icon-skype"></i>'.$instance['skype'].'</li>'; ?>

		</ul>
        
        <?php
		
		echo $after_widget;
	}
	
                 

	}
function add_alhenalite_contact_info_widget()
{
	register_widget( 'alhenalite_contact_info_widget' );
}
add_action( 'widgets_init', 'add_alhenalite_contact_info_widget' );

/*-----------------------------------------------------------------------------------*/
/* END WIDGET
/*-----------------------------------------------------------------------------------*/    

?>