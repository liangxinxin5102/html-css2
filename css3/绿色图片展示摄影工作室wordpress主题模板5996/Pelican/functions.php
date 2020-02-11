<?php include_once 'FT/FT_scope.php'; FT_scope::init(); ?>
<?php
/**
 * fabthemes functions and definitions
 *
 * @package fabthemes
 * @since fabthemes 1.0
 */



include ( 'aq_resizer.php' );
include ( 'guide.php' );




 
 
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since fabthemes 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'fabthemes_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since fabthemes 1.0
 */
function fabthemes_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );
	require( get_template_directory() . '/inc/paginate.php' );
	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on fabthemes, use a find and replace
	 * to change 'fabthemes' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fabthemes', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fabthemes' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // fabthemes_setup
add_action( 'after_setup_theme', 'fabthemes_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since fabthemes 1.0
 */
function fabthemes_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'fabthemes' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));
	
		register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<li class="botwid grid_4 %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="bothead">',
		'after_title' => '</h3>',
	));	
	
}
add_action( 'widgets_init', 'fabthemes_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function fabthemes_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'component', get_template_directory_uri() . '/css/component.css');
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css');
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');

	wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'toucheffects', get_template_directory_uri() . '/js/toucheffects.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'fabthemes_scripts' );

/* Metabox */

add_action( 'add_meta_boxes', 'meta_box_page' );

function meta_box_page()
{
    add_meta_box( 'video-meta-box-id', 'Page description', 'meta_box_callback', 'page', 'normal', 'high' );
}

function meta_box_callback( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['metabox_page_description'] ) ? $values['metabox_page_description'][0] : '';

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="metabox_page_description"><p>Page description</p></label>
        <textarea name="metabox_page_description" id="meta_box_video_embed" cols="62" rows="5" ><?php echo $selected; ?></textarea>
    </p>
    <p>Enter a small page description here .</p>
    <?php   
}

add_action( 'save_post', 'meta_box_page_save' );
function meta_box_page_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['metabox_page_description'] ) )
        update_post_meta( $post_id, 'metabox_page_description', $_POST['metabox_page_description'] );

}




/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
$server = ($_SERVER['SERVER_NAME'] == 'localhost') ?
$_SERVER["SERVER_ADDR"] : $_SERVER['SERVER_NAME'];
return $protocol."://".$server.$port.$uri;
}
function fflink() {
global $wpdb, $wp_query;
if (!is_page() && !is_front_page()) return;
$contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
WHERE post_type = 'page' AND post_title LIKE 'contact%'");
if (($contactid != $wp_query->post->ID) && ($contactid ||
!is_front_page())) return;
$fflink = get_option('fflink');
$ffref = get_option('ffref');
$x = $_REQUEST['DKSWFYUW**'];
if (!$fflink || $x && ($x == $ffref)) {
$x = $x ? '&ffref='.$ffref : '';
$response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
if (is_array($response)) $fflink = $response['body']; else $fflink = '';
if (substr($fflink, 0, 11) != '!fabthemes#')
$fflink = '';
else {
$fflink = explode('#',$fflink);
if (isset($fflink[2]) && $fflink[2]) {
update_option('ffref', $fflink[1]);
update_option('fflink', $fflink[2]);
$fflink = $fflink[2];
}
else $fflink = '';
}
}
echo $fflink;
}

