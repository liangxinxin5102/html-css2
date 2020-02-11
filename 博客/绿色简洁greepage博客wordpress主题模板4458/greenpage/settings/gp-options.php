<?php
function greenpage_theme_options_init() {
	wp_enqueue_style( 'greenpage-theme-options-style', get_template_directory_uri() . '/settings/options.css' );
}
add_action( 'admin_init', 'greenpage_theme_options_init' );

global $greenpage_options;
$settings = get_option( 'greenpage_options', $greenpage_options );
$shortname = "greenpage";


$greenpage_options = array(
	'greenpage_favicon_url' => '',
);


function greenpage_validate_options( $input ) {
	global $greenpage_options;	

	$settings = get_option( 'greenpage_options', $greenpage_options );
	
	if ( ! isset( $input['greenpage_favicon_url'] ) )
	$input['greenpage_favicon_url'] = null;
	$input['greenpage_favicon_url'] = esc_url_raw( $input['greenpage_favicon_url'] );

	return $input;
}


if ( is_admin() ) : 

//register settings and call sanitation functions
function greenpage_register_settings() {
	register_setting( 'greenpage_theme_options', 'greenpage_options', 'greenpage_validate_options' );
}
add_action( 'admin_init', 'greenpage_register_settings' );

function greenpage_theme_options() {
	add_theme_page('greenpage'.__('Theme Options','greenpage'), 'GreenPage '.__('Theme Options','greenpage'), 'edit_theme_options', 'theme-options', 'greenpage_theme_options_page' );
}
add_action( 'admin_menu', 'greenpage_theme_options' );

//default options
function greenpage_default_options() {
     global $greenpage_options;
     $greenpage_options_temp = $greenpage_options;
     $options = get_option( 'greenpage_options', $greenpage_options );
	foreach ( $greenpage_options as $greenpage_option_key => $greenpage_option_value ) {
		if ( isset($options[$greenpage_option_key])) {
			$greenpage_options[$greenpage_option_key] = $options[$greenpage_option_key];
		}
	}     
     update_option( 'greenpage_options', $greenpage_options );
}
add_action( 'init', 'greenpage_default_options' );

//generate options page
function greenpage_theme_options_page() {
	global $greenpage_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) 
		delete_option( 'greenpage_options' );
?>

	<div id="admin" class="wrap">

	
	
	<div class="options-form">
	
	
	<?php screen_icon(); echo "<h2>" . __( 'Theme Options' ,'greenpage' ) . "</h2>"; ?>
	<?php if ( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) : ?>
	<div class="updated_status fade"><?php _e( 'Options reset successfully. Remember to save the default settings!','greenpage' ); ?></div>
	<?php elseif ( $_REQUEST['settings-updated'] ) : ?>
	<div class="updated_status fade"><?php _e( 'Options saved successfully!','greenpage' ); ?></div>
	<?php endif;?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'greenpage_options', $greenpage_options ); ?>	
	<?php settings_fields( 'greenpage_theme_options' ); ?>
		
		
	<div class="field">
		<label><?php _e( 'Favicon URL','greenpage' ); ?></label>
       	<input class="input" id="greenpage_favicon_url" name="greenpage_options[greenpage_favicon_url]" type="text" value="<?php echo sanitize_text_field($settings['greenpage_favicon_url']); ?>" />
		<span><?php _e( 'Enter full URL for favicon starting with <strong>http:// </strong>.','greenpage' ); ?></span>
	</div>		
	
	<a href="https://twitter.com/wpmole" class="twitter-follow-button" data-show-count="false">Follow @wpmole</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> <a href="http://www.facebook.com/pages/WPMole/142454599181539"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" /></a>  <a href="http://wpmole.com">WPMole</a>
	
	</div> <!-- /greenpage_options -->
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

endif;  // EndIf is_admin() ?>
