<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package deLighted
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses delighted_header_style()
 * @uses delighted_admin_header_style()
 * @uses delighted_admin_header_image()
 *
 * @package deLighted
 * @since 1.0
 */
 
add_action( 'after_setup_theme', 'delighted_custom_header_setup' );

function delighted_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'delighted_custom_header_args', array(
		'default-image'          => get_stylesheet_directory_uri() . '/img/bg-header.jpg',
		'default-text-color'     => '#fff',
		'width'                  => 1100,
		'height'                 => 500,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'delighted_header_style',
		'admin-head-callback'    => 'delighted_admin_header_style',
		'admin-preview-callback' => 'delighted_admin_header_image',
	) ) );

}


/**
 * Styles the header image and text displayed on the blog
 *
 * @see delighted_custom_header_setup()
 * @since 1.0
 */

if ( ! function_exists( 'delighted_header_style' ) ) {

	function delighted_header_style() {
	?>
		<style type="text/css">
	    <?php if ( get_header_image() ) : ?>
	        .site-subheader {
	            background: url(<?php header_image(); ?>);
	        }
		<?php endif; // End header image check. ?>
		</style>
	
	    <?php $header_text_color = get_header_textcolor();
	
		// If no custom options for text are set, let's bail
		// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
		if ( HEADER_TEXTCOLOR == $header_text_color )
			return;
	
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
	    <?php if ( get_header_image() ) : ?>
	        .site-subheader {
	            background-image: url(<?php header_image(); ?>);
	        }
		<?php endif; // End header image check. ?>
		<?php
			// Has the text been hidden?
			if ( 'blank' == $header_text_color ) :
		?>
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
			.site-description {
				color: #<?php echo $header_text_color; ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}

} // endif delighted_header_style


/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see delighted_custom_header_setup()
 * @since 1.0
 */

if ( ! function_exists( 'delighted_admin_header_style' ) ) {
 
	function delighted_admin_header_style() {
	?>
		<style type="text/css">
			.appearance_page_custom-header #headimg {
				border: none;
			}
		</style>
	<?php
	}

} // endif delighted_admin_header_style


/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see delighted_custom_header_setup()
 * @since 1.0
 */

if ( ! function_exists( 'delighted_admin_header_image' ) ) {

	function delighted_admin_header_image() {
	?>
		<div id="headimg">
			<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
			<?php endif; ?>
		</div>
	<?php
	}

} // endif delighted_admin_header_image
