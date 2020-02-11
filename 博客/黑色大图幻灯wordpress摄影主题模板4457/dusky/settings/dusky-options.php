<?php
function dusky_theme_options_init() {
	wp_enqueue_style( 'dusky-theme-options-style', get_template_directory_uri() . '/settings/options.css' );
}
add_action( 'admin_init', 'dusky_theme_options_init' );

global $dusky_options;
$settings = get_option( 'dusky_options', $dusky_options );
$shortname = "dusky";


$dusky_options = array(
	'dusky_favicon_url' => '',
	'dusky_feat_cat1' => '',
	'dusky_show_video_posts' => true,
);


function dusky_validate_options( $input ) {
	global $dusky_options;	

	$settings = get_option( 'dusky_options', $dusky_options );
	
	if ( ! isset( $input['dusky_favicon_url'] ) )
	$input['dusky_favicon_url'] = null;
	$input['dusky_favicon_url'] = esc_url_raw( $input['dusky_favicon_url'] );
	
	if ( ! isset( $input['dusky_show_video_posts'] ) )
	$input['dusky_show_video_posts'] = null;
	$input['dusky_show_video_posts'] = ( $input['dusky_show_video_posts'] == 1 ? 1 : 0 );
	
	return $input;
}


if ( is_admin() ) : 

//register settings and call sanitation functions
function dusky_register_settings() {
	register_setting( 'dusky_theme_options', 'dusky_options', 'dusky_validate_options' );
}
add_action( 'admin_init', 'dusky_register_settings' );

function dusky_theme_options() {
	add_theme_page('dusky'.__('Theme Options','dusky'), 'Dusky '.__('Theme Options','dusky'), 'edit_theme_options', 'theme-options', 'dusky_theme_options_page' );
}
add_action( 'admin_menu', 'dusky_theme_options' );

//default options
function dusky_default_options() {
     global $dusky_options;
     $dusky_options_temp = $dusky_options;
     $options = get_option( 'dusky_options', $dusky_options );
	foreach ( $dusky_options as $dusky_option_key => $dusky_option_value ) {
		if ( isset($options[$dusky_option_key])) {
			$dusky_options[$dusky_option_key] = $options[$dusky_option_key];
		}
	}     
     update_option( 'dusky_options', $dusky_options );
}
add_action( 'init', 'dusky_default_options' );

//generate options page
function dusky_theme_options_page() {
	global $dusky_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) 
		delete_option( 'dusky_options' );
?>

	<div id="admin" class="wrap">
	
	
	
	<div class="options-form">
	
	<?php screen_icon(); echo "<h2>" . __( 'Theme Options' ,'dusky' ) . "</h2>"; ?>
	<?php if ( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) : ?>
	<div class="updated_status fade"><?php _e( 'Options reset successfully. Remember to save the default settings!','dusky' ); ?></div>
	<?php elseif ( $_REQUEST['settings-updated'] ) : ?>
	<div class="updated_status fade"><?php _e( 'Options saved successfully!','dusky' ); ?></div>
	<?php endif;?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'dusky_options', $dusky_options ); ?>	
	<?php settings_fields( 'dusky_theme_options' ); ?>
		
		
	<div class="field">
		<label><?php _e( 'Favicon URL','dusky' ); ?></label>
       	<input class="input" id="dusky_favicon_url" name="dusky_options[dusky_favicon_url]" type="text" value="<?php echo sanitize_text_field($settings['dusky_favicon_url']); ?>" />
		<span><?php _e( 'Enter full URL for favicon starting with <strong>http:// </strong>.','dusky' ); ?></span>
	</div>
		
	<div class="field">
		<label><?php _e( 'Featured Category','dusky' ); ?></label>
		<?php 
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );  ?>
		<select id="dusky_feat_cat1" name="dusky_options[dusky_feat_cat1]">
		<option <?php selected( 0 == $settings['dusky_feat_cat1'] ); ?> value="0"><?php _e( '--none--', 'dusky' ); ?></option>
		<?php foreach( $categories as $category ) : ?>
			<option <?php selected( $category->term_id == $settings['dusky_feat_cat1'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
		<?php endforeach; ?>
		</select>
			</div>
			
	<div class="field">
		<label><?php _e( 'Show video posts','dusky' ); ?></label>
       	<input class="checkbox" type="checkbox" id="dusky_show_video_posts" name="dusky_options[dusky_show_video_posts]" value="1" <?php checked( true, $settings['dusky_show_video_posts'] ); ?> />
	</div>		
	
	</div> <!-- /dusky_options -->
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