<?php

/* ------- Adding a custom menu ------- */
require( get_template_directory() . '/settings/dusky-options.php' );

if (!is_admin()){
	add_action('wp_enqueue_scripts', 'dusky_script_loader');
}    

   function dusky_script_loader() {	
	 wp_enqueue_script('jquery');
		wp_enqueue_script('dusky_custom', get_template_directory_uri().'/libs/jquery.us.js');
		wp_enqueue_script('dusky_time', get_template_directory_uri().'/libs/jquery.timeout.js');	
	wp_enqueue_script( 'jquery_masonry', get_stylesheet_directory_uri().'/libs/jquery.masonry.min.js' );	
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );	
	
    }


add_action('template_redirect', 'dusky_js_head_load');

function dusky_js_head_load(){

	wp_enqueue_script('dusky-scr', get_stylesheet_directory_uri().'/js/dusky-scr.js', array('jquery'));
	wp_enqueue_script('scripts', get_stylesheet_directory_uri().'/js/scripts.js', array('jquery', 'dusky-scr'));

}


function dusky_register_my_menus() {
	register_nav_menus(
		array(
			'menu-1' => __( 'Menu 1', 'dusky' ),
				)
	);
}
add_action( 'init', 'dusky_register_my_menus' );

add_action( 'after_setup_theme', 'dusky_setup' );

 if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : 
 if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
	endif; 



function dusky_setup() {
global $dusky_content_width, $dusky_favicon_url;
if ( ! isset( $content_width ) )
	$content_width = 700;
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_image_size('mini-thumb', 147, 100, true);
	add_image_size( 'homepage-thumb', 220, 150, true );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'video' ) );
	load_theme_textdomain( 'dusky', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory(). "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		require_once(get_template_directory()  . '/includes/additional_functions.php');

}

if ( ! function_exists( 'dusky_filter_wp_title' ) ) :	
function dusky_filter_wp_title( $title ) {
	global $page, $paged;
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
      return $filtered_title;
	  $site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'dusky' ), max( $paged, $page ) ); 
}
endif; 
add_filter( 'wp_title', 'dusky_filter_wp_title' );

/* ------- Register sidebar ------- */
function dusky_widgets_init() {
    register_sidebars(1);
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}
 add_action('widgets_init', 'dusky_widgets_init');

if ( ! function_exists( 'dusky_comment' ) ) :	
  function dusky_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>			
			<?php printf( __( '%s', 'dusky' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dusky' ); ?></em>
			<br />
		<?php endif; ?>

<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', 'dusky'), get_comment_date('F j, Y g:i a')) ?></a>

</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php sanitize_text_field(comment_text()); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'dusky' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'dusky' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
  };
  endif; 




function dusky_wp_head() { ?>
<?php }
add_action('wp_head', 'dusky_wp_head');



