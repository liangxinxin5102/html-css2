<?php
function loom_theme_options_init() {
	wp_enqueue_style( 'loom-theme-options-style', get_template_directory_uri() . '/settings/options.css' );
}
add_action( 'admin_init', 'loom_theme_options_init' );

global $loom_options;
$settings = get_option( 'loom_options', $loom_options );
$shortname = "loom";


$loom_options = array(
	'loom_favicon_url' => '',
	'loom_feat_cat1' => '',
	'ad468_code' => '',
	'ad125_code' => '', 
);


function loom_validate_options( $input ) {
	global $loom_options;	

	$settings = get_option( 'loom_options', $loom_options );
	
	if ( ! isset( $input['loom_favicon_url'] ) )
	$input['loom_favicon_url'] = null;
	$input['loom_favicon_url'] = esc_url_raw( $input['loom_favicon_url'] );
	
	if ( ! isset( $input['ad468_code'] ) )
	$input['ad468_code'] = null;
	$input['ad468_code'] = wp_kses_stripslashes($input['ad468_code']);

	if ( ! isset( $input['ad125_code'] ) )
	$input['ad125_code'] = null;
	$input['ad125_code'] = wp_kses_stripslashes($input['ad125_code']);
	
	return $input;
}


if ( is_admin() ) : 

//register settings and call sanitation functions
function loom_register_settings() {
	register_setting( 'loom_theme_options', 'loom_options', 'loom_validate_options' );
}
add_action( 'admin_init', 'loom_register_settings' );

function loom_theme_options() {
	add_theme_page('looming'.__('Theme Options','looming'), 'Looming '.__('Theme Options','looming'), 'edit_theme_options', 'theme-options', 'loom_theme_options_page' );
}
add_action( 'admin_menu', 'loom_theme_options' );

//default options
function loom_default_options() {
     global $loom_options;
     $loom_options_temp = $loom_options;
     $options = get_option( 'loom_options', $loom_options );
	foreach ( $loom_options as $loom_option_key => $loom_option_value ) {
		if ( isset($options[$loom_option_key])) {
			$loom_options[$loom_option_key] = $options[$loom_option_key];
		}
	}     
     update_option( 'loom_options', $loom_options );
}
add_action( 'init', 'loom_default_options' );

//generate options page
function loom_theme_options_page() {
	global $loom_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) 
		delete_option( 'loom_options' );
?>

	<div id="admin" class="wrap">
	
	
	
	<div class="options-form">
	
	<?php screen_icon(); echo "<h2>" . __( 'Theme Options' ,'looming' ) . "</h2>"; ?>
	<?php if ( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) : ?>
	<div class="updated_status fade"><?php _e( 'Options reset successfully. Remember to save the default settings!','looming' ); ?></div>
	<?php elseif ( $_REQUEST['settings-updated'] ) : ?>
	<div class="updated_status fade"><?php _e( 'Options saved successfully!','looming' ); ?></div>
	<?php endif;?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'loom_options', $loom_options ); ?>	
	<?php settings_fields( 'loom_theme_options' ); ?>
		
		
	<div class="field">
		<label><?php _e( 'Favicon URL','looming' ); ?></label>
       	<input class="input" id="loom_favicon_url" name="loom_options[loom_favicon_url]" type="text" value="<?php echo sanitize_text_field($settings['loom_favicon_url']); ?>" />
		<span><?php _e( 'Enter full URL for favicon starting with <strong>http:// </strong>.','looming' ); ?></span>
	</div>
		
	<div class="field">
		<label><?php _e( 'Featured Category','looming' ); ?></label>
		<?php 
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );  ?>
		<select id="loom_feat_cat1" name="loom_options[loom_feat_cat1]">
		<option <?php selected( 0 == $settings['loom_feat_cat1'] ); ?> value="0"><?php _e( '--none--', 'looming' ); ?></option>
		<?php foreach( $categories as $category ) : ?>
			<option <?php selected( $category->term_id == $settings['loom_feat_cat1'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
		<?php endforeach; ?>
		</select>
			</div>

	<div class="field">
		<label><?php _e( 'Header ad code 468x60','looming' ); ?></label>
       	<textarea class="textarea" id="ad468_code" name="loom_options[ad468_code]" ><?php echo stripslashes($settings['ad468_code']); ?></textarea>
			<span><?php _e( 'Enter full <strong>html code</strong> for the 468x60px header ad', 'looming' ); ?></span>
	</div>	
	
	<div class="field">
		<label><?php _e( 'Sidebar Advertising','looming' ); ?></label>
       	<textarea class="textarea" id="ad125_code" name="loom_options[ad125_code]" ><?php echo stripslashes($settings['ad125_code']); ?></textarea>
			<span><?php _e( 'Enter <strong>html code</strong> for the 125x125px sidebar ad', 'looming' ); ?></span>
	</div>		
	
	
	</div> <!-- /loom_options -->
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