<?php 

function color_customizer( $wp_customize ) {
$wp_customize->add_section(
        'example_section_one',
        array(
            'title' => 'Customize Colors',
            'description' => 'This is a settings section.',
            'priority' => 35,
        )
    );

/* Text */

$wp_customize->add_setting(
    'copyright_textbox',
    array(
        'default' => 'Welcome to my website',
    )
);

$wp_customize->add_control(
    'copyright_textbox',
    array(
        'label' => 'Copyright text',
        'section' => 'example_section_one',
        'type' => 'text',
    )
);

/* Header Color */

$wp_customize->add_setting(
    'header_color',
    array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'header_color',
        array(
            'label' => 'Header color',
            'section' => 'example_section_one',
            'settings' => 'header_color',
        )
    )
);


/* Link Color */

$wp_customize->add_setting(
    'link_color',
    array(
        'default' => '#16bcbc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'link_color',
        array(
            'label' => 'Link color',
            'section' => 'example_section_one',
            'settings' => 'link_color',
        )
    )
);


if ( $wp_customize->is_preview() && ! is_admin() ) {
    add_action( 'wp_footer', 'example_customize_preview', 21);
}

function example_customize_preview() {
    ?>
    <script type="text/javascript">
        ( function( $ ) {
        
            wp.customize('header_color',function( value ) {
                value.bind(function(to) {
                    $('.headboz').css('background-color', to );
                });
            });
            
            wp.customize('link_color',function( value ) {
                value.bind(function(to) {
                    $('.entry-meta a:link, .entry-meta a:visited').css('color', to );
                });
            });
            
    
            
        } )( jQuery )
    </script>
    <?php
}

}
add_action( 'customize_register', 'color_customizer' );


