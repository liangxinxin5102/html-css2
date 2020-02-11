<?php
function fancier_theme_options_init() {
	wp_enqueue_style( 'fan-theme-options-style', get_template_directory_uri() . '/settings/options.css' );
}
add_action( 'admin_init', 'fancier_theme_options_init' );

global $fancier_options;
$settings = get_option( 'fancier_options', $fancier_options );
$shortname = "fan";


$fancier_options = array(
	'fancier_favicon_url' => '',
);


function fancier_validate_options( $input ) {
	global $fancier_options;	

	$settings = get_option( 'fancier_options', $fancier_options );
	
	if ( ! isset( $input['fancier_favicon_url'] ) )
	$input['fancier_favicon_url'] = null;
	$input['fancier_favicon_url'] = esc_url_raw( $input['fancier_favicon_url'] );

	return $input;
}


if ( is_admin() ) : 

//register settings and call sanitation functions
function fancier_register_settings() {
	register_setting( 'fancier_theme_options', 'fancier_options', 'fancier_validate_options' );
}
add_action( 'admin_init', 'fancier_register_settings' );

function fancier_theme_options() {
	add_theme_page('fancier'.__('Theme Options','fancier'), 'Fancier '.__('Theme Options','fancier'), 'edit_theme_options', 'theme-options', 'fancier_theme_options_page' );
}
add_action( 'admin_menu', 'fancier_theme_options' );

//default options
function fancier_default_options() {
     global $fancier_options;
     $fancier_options_temp = $fancier_options;
     $options = get_option( 'fancier_options', $fancier_options );
	foreach ( $fancier_options as $fancier_option_key => $fancier_option_value ) {
		if ( isset($options[$fancier_option_key])) {
			$fancier_options[$fancier_option_key] = $options[$fancier_option_key];
		}
	}     
     update_option( 'fancier_options', $fancier_options );
}
add_action( 'init', 'fancier_default_options' );

//generate options page
function fancier_theme_options_page() {
	global $fancier_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) 
		delete_option( 'fancier_options' );
?>

	<div id="admin" class="wrap">
	
	
	
	<div class="options-form">
	
	<?php screen_icon(); echo "<h2>" . __( 'Theme Options' ,'fancier' ) . "</h2>"; ?>
	<?php if ( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) : ?>
	<div class="updated_status fade"><?php _e( 'Options reset successfully. Remember to save the default settings!','fancier' ); ?></div>
	<?php elseif ( $_REQUEST['settings-updated'] ) : ?>
	<div class="updated_status fade"><?php _e( 'Options saved successfully!','fancier' ); ?></div>
	<?php endif;?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'fancier_options', $fancier_options ); ?>	
	<?php settings_fields( 'fancier_theme_options' ); ?>
		
		
	<div class="field">
		<label><?php _e( 'Favicon URL','fancier' ); ?></label>
       	<input class="input" id="fancier_favicon_url" name="fancier_options[fancier_favicon_url]" type="text" value="<?php echo sanitize_text_field($settings['fancier_favicon_url']); ?>" />
		<span><?php _e( 'Enter full URL for favicon starting with <strong>http:// </strong>.','fancier' ); ?></span>
	</div>	
	
	
	</div> <!-- /fancier_options -->
	<!---- /form fields ---->
	
	
	<p class="submit"><input type="submit" class="button-primary" value="Save Settings" /></p>
	</form>
	
	<form method="post">
		<p class="submit">
			<input class="button" name="reset" type="submit" value="Reset All Settings" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>

	</div>

	<?php
}

endif;  // EndIf is_admin()