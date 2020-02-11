<?php


  function phb_options_admin_menu() 
  {	    
	$phb_theme_page = add_theme_page(__("Photo Book Options", 'photobook'), __("Photo Book Options", 'photobook'), 
	  'edit_theme_options', 'phb_general_options_page', 'phb_general_options_page');	
  };

  
  add_action('admin_menu', 'phb_options_admin_menu');
  
  $phb_options = get_option( 'phb_options' );	
$phb_options = array(
	'phb_favicon_url' => '',
);
  
  add_action('wp_head', 'phb_head');
    if ( ! function_exists( 'phb_head' ) ) :
  function phb_head()
  {  
    if (!is_admin())
	{
	  global $phb_favicon_url;
?>	
<link rel="shortcut icon" href="<?php echo sanitize_text_field(phb_get_option('phb_favicon_url', $phb_favicon_url)); ?>" type="image/x-icon" />
<?php	
	  $background = get_theme_mod('background_image', false);
	  $bgcolor = get_theme_mod('background_color', false);
?>

<?php	  
	};
  };
    endif;
	 function phb_options_update() 
   {
     global $_POST, $phb_favicon_url;
		
	 if ($_POST['phb_favicon_url'] != '')
	 {
	   update_option('phb_favicon_url', $_POST['phb_favicon_url']);
	 } else 
	 {
	   update_option('phb_favicon_url', $phb_favicon_url);	  
	 };
		
		  };
		  
 function phb_options_validate ( $phb_options) {  
    $output = array();  
    foreach( $phb_options as $key => $value ) {  
        if( isset( $phb_options[$key] ) ) {  
            $output[$key] = strip_tags( stripslashes( $phb_options[ $key ] ) );        
        }          
    }  
    return apply_filters( 'phb_options_validate', $output, $phb_options );    
}  

  

	
function phb_general_options_input() {  
register_setting('phb_general_options_page','phb_general_options_page','phb_options_validate'); 
register_setting( 'phb_general_options_page', 'phb_favicon_url' ); 
}

add_action( 'admin_init', 'phb_general_options_input' );  		  
 
   

  function phb_general_options_page()
  {
    global  $_POST, $phb_favicon_url; 
	
 if ( isset($_POST['update_options']) && $_POST['update_options'] == 'true' )
?>	
	    <div class="wrap">
		<div id="icon-options-general" class="icon32"><br /></div>
      		<h2><?php _e('Photo Book General Options', 'photobook'); ?></h2>

        <form method="post" action="options.php">
		<?php 
 wp_nonce_field('update-options'); ?>

			
            <table class="form-table">

 <tr valign="top">
                    <th scope="row"><label for="phb_favicon_url"><?php _e('Favicon:', 'photobook'); ?></label></th>
                    <td><input type="text" name="phb_favicon_url" size="95" 
					  value="<?php echo sanitize_text_field(phb_get_option('phb_favicon_url', $phb_favicon_url)); ?>"/>
					<br/>
					<span class="description"> 
					<?php printf(__('<a href="%s" target="_blank">Upload your favicon</a> using WordPress Media Library and insert its URL here', 
					  'photobook'), esc_url(home_url().'/wp-admin/media-new.php')); ?>
					</span><br/><br/>
					<img src="<?php echo sanitize_text_field(phb_get_option('phb_favicon_url', $phb_favicon_url)); ?>" alt=""/>
					</td>
                </tr>	  		
			    										
					
            </table>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="phb_favicon_url" />
     			<p><?php submit_button( $text=null, $type='submit', $name = 'submit', $wrap = true, $other_attributes = null) ?></p>
        </form>
		
    </div>
	<?php

if ( !empty($_POST) && check_admin_referer( 'update-options') ) {
}

  };

