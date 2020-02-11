<?php 

/* Meta boxes */

function dusky_settings(){
	add_meta_box("dusky_post_meta", "Dusky Settings", "dusky_display_options", "post", "normal", "high");
}
add_action("admin_init", "dusky_settings");

function dusky_display_options($callback_args) {
	global $post;
			
	$dusky_fs_video = get_post_meta( $post->ID, '_et_dusky_video_url', true );
?>
	
	<?php wp_nonce_field( basename( __FILE__ ), 'dusky_settings_nonce' ); ?>
	
	<div id="dusky_custom_settings" style="margin: 13px 0 17px 4px;">				
		
		<h4 style="font-size: 13px;"><?php esc_html_e('Video Post Format Settings: ','dusky'); ?></h4>
		
		<div class="dusky_fs_setting" style="margin: 13px 0 26px 4px;">
			<label for="dusky_fs_video" style="color: #000; font-weight: bold;"> <?php esc_html_e('Video url:','dusky'); ?> </label>
			<input type="text" style="width: 30em;" value="<?php echo esc_url($dusky_fs_video); ?>" id="dusky_fs_video" name="dusky_fs_video" size="67" />
			<br />
			
		</div>
		
		
		
		
		
	</div> 
		
	<?php
}

add_action( 'save_post', 'dusky_save_details', 10, 2 );
function dusky_save_details( $post_id, $post ){
	global $pagenow;
	if ( 'post.php' != $pagenow ) return $post_id;
		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
		
	if ( !isset( $_POST['dusky_settings_nonce'] ) || !wp_verify_nonce( $_POST['dusky_settings_nonce'], basename( __FILE__ ) ) )
        return $post_id;
		
	if ( isset($_POST["dusky_fs_video"]) ) update_post_meta( $post_id, "_et_dusky_video_url", esc_url_raw( $_POST["dusky_fs_video"] ) );

} ?>