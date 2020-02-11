<?php
/**
* Front End Theme Customizer Settings
* @since 1.1
*/
add_action( 'customize_register', 'ATT_customize_register' );
function ATT_customize_register($wp_customize) {
	
	//Extends the theme_customizer <= Textarea
	class ATT_Customize_Textarea_Control extends WP_Customize_Control {
		
		//Type of customize control being rendered.
		public $type = 'textarea';

		//Displays the textarea on the customize screen.
		public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}
		
		
	// Add Theme tab
	$wp_customize->add_section( 'att_custom_logo', array(
		'title' => __( 'Custom Logo', 'att' ),
		'priority' => 200
	) );


	// Custom Logo
	$wp_customize->add_setting( 'att_options[custom_logo]', array(
		'type'	=> 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'att_options[custom_logo]', array(
		'label'		=> __('Custom Logo', 'att'),
		'section'	=> 'att_custom_logo',
		'settings'	=> 'att_options[custom_logo]'
	) ) );
	
	
	// Add Theme tab
	$wp_customize->add_section( 'att_theme_customizer', array(
		'title' => __( 'Theme Settings', 'att' ),
		'priority' => 201
	) );
	
	// Header Add
	$wp_customize->add_setting( 'att_options[header_ad]', array(
		'default'	=> '<a href="http://www.authenticthemes.com"><img src="http://authenticthemes.s3.amazonaws.com/ads/set3/468x80.png" alt="Gain Access to all of the Authentic Themes WordPress Themes for only $40" title="Gain Access to all of the Authentic Themes WordPress Themes for only $40" /></a>',
		'type'		=> 'option'
	) );
	$wp_customize->add_control( new ATT_Customize_Textarea_Control( $wp_customize, 'att_options[header_ad]', array(
		'label'		=> __('Header Ad', 'att'),
		'section'	=> 'att_theme_customizer',
		'settings'	=> 'att_options[header_ad]',
		'type'		=> 'textarea'
	) ) );
	
	
	// Copyright
	$wp_customize->add_setting( 'att_options[custom_copyright]', array(
		'default'	=> '',
		'type'		=> 'option'
	) );
	$wp_customize->add_control( new ATT_Customize_Textarea_Control( $wp_customize, 'att_options[custom_copyright]', array(
		'label'		=> __('Custom Copyright', 'att'),
		'section'	=> 'att_theme_customizer',
		'settings'	=> 'att_options[custom_copyright]',
		'type'		=> 'textarea'
	) ) );
		
	
	// Site Description Toggle
	$wp_customize->add_setting( 'att_options[site_description]', array(
			'default'	=> '1',
			'type'		=> 'option'
	));
	$wp_customize->add_control( 'att_options[site_description]', array(
		'label'		=>  __('Toggle: Site Description', 'att'),
		'section'	=> 'att_theme_customizer',
		'settings' => 'att_options[site_description]',
		'type'		=> 'checkbox',
	));
	
	// Single Blog Images
	$wp_customize->add_setting( 'att_options[blog_single_thumbnail]', array(
		'default'	=> '1',
		'type'		=> 'option'
	));
	$wp_customize->add_control( 'att_options[blog_single_thumbnail]', array(
		'label'		=>  __('Toggle: Featured Images on Single Blog Posts', 'att'),
		'section'	=> 'att_theme_customizer',
		'settings' => 'att_options[blog_single_thumbnail]',
		'type'		=> 'checkbox',
	));
		
	
	// Enable Social
	$wp_customize->add_setting( 'att_options[social]', array(
		'default'	=> '1',
		'type'		=> 'option'
	));
	
	$wp_customize->add_control( 'att_options[social]', array(
		'label'		=>  __('Toggle: Header Social Links', 'att'),
		'section'	=> 'att_theme_customizer',
		'settings' => 'att_options[social]',
		'type'		=> 'checkbox',
	));
	
	
	// Social Settings
	$wp_customize->add_section( 'att_social', array(
		'title' => __( 'Social Links', 'att' ),
		'priority' => 202
	) );


	// Social Links	
	$social_links = att_social_links(); // Get social links array
		
	// Loop through each social option and create a theme option
	foreach($social_links as $social_link) {
		
		$social_link_label = ucfirst($social_link);
		
		$wp_customize->add_setting( 'att_options['. $social_link .']', array(
			'default'	=> '',
			'type'		=> 'option'
		));
		
		$wp_customize->add_control( 'att_options['. $social_link .']', array(
			'label'		=>  $social_link_label,
			'section'	=> 'att_social',
			'settings' => 'att_options['. $social_link .']',
			'type'		=> 'text',
		));
		
	} // End foreach social_links 
		
} // End ATT_customize_register