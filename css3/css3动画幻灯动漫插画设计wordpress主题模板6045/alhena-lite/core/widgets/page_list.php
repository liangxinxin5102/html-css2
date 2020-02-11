<?php 

/*-----------------------------------------------------------------------------------*/
/* START PAGE WIDGET
/*-----------------------------------------------------------------------------------*/    
    
class alhenalite_page_widget extends WP_Widget
{
	public function __construct() 
    {
		parent::WP_Widget( "wip_page_widget", "Wip Page Widget", array("description" => "Wip Page Widget"));
	}
	
	public function form( $instance )
	{
		
		global $positions;
        /* Impostazioni di default del widget */
		$defaults = array( 
			'title' => 'Pages Site',
			'esclude' => NULL,
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
			<label for="<?php echo $this->get_field_id( 'esclude' ); ?>"> 
				<?php _e( "Exclude","wip"); ?>:
            </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'esclude' ); ?>" name="<?php echo $this->get_field_name( 'esclude' ); ?>" value="<?php echo $instance['esclude']; ?>" />
			<small><?php _e( "ID pages, separated by comma.","wip"); ?>:</small>
		</p>

		<?php
	}
	
	public function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['esclude'] = strip_tags( $new_instance['esclude'] );
		
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
        
        <ul class="widget-category">
			<?php 
				$esclude = $instance['esclude'];
				if (isset($esclude)) $esclude = "exclude=$esclude";
  				$pages = get_pages($esclude); 
  					foreach ( $pages as $page ) 
					{
  						echo "<li><a href='".get_page_link( $page->ID )."' >".$page->post_title."</a></li>";
					}
			?>
		</ul>
        <?php
		echo $after_widget;
	}
	
                 

	}
function add_alhenalite_page_widget()
{
	register_widget( 'alhenalite_page_widget' );
}
add_action( 'widgets_init', 'add_alhenalite_page_widget' );

/*-----------------------------------------------------------------------------------*/
/* END PAGE
/*-----------------------------------------------------------------------------------*/    

?>