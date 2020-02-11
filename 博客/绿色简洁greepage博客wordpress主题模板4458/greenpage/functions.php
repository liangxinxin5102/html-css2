<?php

require( get_template_directory() . '/settings/gp-options.php' );

function greenpage_filter_wp_title( $title ) {
	global $page, $paged;
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
      return $filtered_title;
	  $site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'greenpage' ), max( $paged, $page ) ); 
}
add_filter( 'wp_title', 'greenpage_filter_wp_title' );

if (!is_admin()){
	add_action('wp_enqueue_scripts', 'greenpage_script_loader');
}    

   function greenpage_script_loader() {	
	 wp_enqueue_script('jquery');
		wp_enqueue_script('gp_custom', get_template_directory_uri().'/libs/jquery.us.js');
		wp_enqueue_script('gp_time', get_template_directory_uri().'/libs/jquery.timeout.js');	
	wp_enqueue_script( 'jquery_masonry', get_stylesheet_directory_uri().'/libs/jquery.masonry.min.js' );	
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );	
	
    }

add_action('template_redirect', 'greenpage_js_head_load');

function greenpage_js_head_load(){

	wp_enqueue_script('greenpage-scr', get_stylesheet_directory_uri().'/js/gp-scr.js', array('jquery'));
	wp_enqueue_script('scripts', get_stylesheet_directory_uri().'/js/scripts.js', array('jquery', 'greenpage-scr'));

}


function greenpage_register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu', 'greenpage' ),
      'sidebar-menu' => __( 'Sidebar Menu', 'greenpage' )
    )
  );
}
add_action( 'after_setup_theme', 'greenpage_register_my_menus' );

add_action( 'after_setup_theme', 'greenpage_setup' );
function greenpage_setup() {
global $greenpage_content_width, $greenpage_favicon_url;
if ( ! isset( $content_width ) )
	$content_width = 700;
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_image_size('squareThumb', 206, 154, true);
	add_image_size( 'homepage-thumb', 660, 260, true );
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'greenpage', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory(). "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

}

/* ------- Register sidebar ------- */
function greenpage_widgets_init() {
    register_sidebars(1);
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}
 add_action('widgets_init', 'greenpage_widgets_init');

 if ( ! function_exists( 'greenpage_comment' ) ) :	
  function greenpage_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>			
			<?php printf( __( '%s', 'greenpage' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'greenpage' ); ?></em>
			<br />
		<?php endif; ?>

<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', 'greenpage'), get_comment_date('F j, Y g:i a')) ?></a>

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
		<p><?php _e( 'Pingback:', 'greenpage' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'greenpage' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
  };
  endif; 



function greenpage_wp_head() { ?>
<?php }
add_action('wp_head', 'greenpage_wp_head');



