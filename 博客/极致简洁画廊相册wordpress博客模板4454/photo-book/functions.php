<?php
  function phb_get_option($Aoption_name, $default = null)
  {
    return stripslashes(get_option($Aoption_name, $default));
  };
require_once ( get_stylesheet_directory() . '/theme-options.php' );
if (!is_admin()){
	add_action('wp_enqueue_scripts', 'phb_script_loader');
}    

   function phb_script_loader() {	
	 wp_enqueue_script('jquery');
		wp_enqueue_script('phb_custom', get_template_directory_uri().'/libs/jquery.us.js');
		wp_enqueue_script('phb_time', get_template_directory_uri().'/libs/jquery.timeout.js');	
	wp_enqueue_script( 'jquery_masonry', get_bloginfo('stylesheet_directory').'/libs/jquery.masonry.min.js' );	
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );	
	
    }


add_action('template_redirect', 'phb_js_head_load');

function phb_js_head_load(){

	wp_enqueue_script('phb-scr', get_bloginfo('stylesheet_directory').'/js/phb-scr.js', array('jquery'));
	wp_enqueue_script('scripts', get_bloginfo('stylesheet_directory').'/js/scripts.js', array('jquery', 'phb-scr'));

}



function phb_filter_wp_title( $title ) {
	global $page, $paged;
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
      return $filtered_title;
	  $site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'photobook' ), max( $paged, $page ) ); 
}

add_filter( 'wp_title', 'phb_filter_wp_title' );


add_action( 'after_setup_theme', 'phb_setup' );



function phb_setup() {
global $phb_content_width, $phb_favicon_url;
if ( ! isset( $content_width ) )
	$content_width = 700;
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_image_size('squareThumb', 220, 220, true);
	add_image_size('featured-slideshow',976,550,true);
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'photobook', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory(). "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
		
function phb_register_my_menus()
{
register_nav_menus
(
array( 'header-menu' => 'header-menu1','cat-menu' => 'cat-menu2')
);
}
	add_action( 'init', 'phb_register_my_menus' );		

}


	function phb_widgets_init() {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		));
	}
  add_action('widgets_init', 'phb_widgets_init');


function phb_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'phb_excerpt_length' );


function phb_auto_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'phb_auto_excerpt_more' );



	

  function phb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'photobook' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'photobook' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo sanitize_text_field(esc_url( get_comment_link( $comment->comment_ID ) )); ?>">
			<?php printf(__('<p class="comment-date">%s</p>'), get_comment_date('M j, Y')) ?></a><?php edit_comment_link( __( '(Edit)', 'photobook' ), ' ' );
			?>
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
		<p><?php _e( 'Pingback:', 'photobook' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'photobook' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
  };

 
  



?>