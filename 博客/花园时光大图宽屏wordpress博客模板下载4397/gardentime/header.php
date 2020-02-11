<?php
/**
 * The Header for our theme.
 *
 * @since thegardentime.com
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'CDC' ), max( $paged, $page ) );

	?></title>	
<meta name="description" content="<?php bloginfo( 'description' ); ?>">	
<meta name="keywords" content="<?php bloginfo( 'name' ); ?>">
<link rel="shortcut icon" href="favicon.ico"/>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/global.css" />
<?php wp_head(); ?>
</head>
<body>
<!--Header-->	
 <div id="head">
		 <div id="top">
      <div id="nav">
	  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"> <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" title="<?php bloginfo( 'name' ); ?>"></a>
        <div id="menu">	
         <ul>
		      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页<span>Home</span></a></li>
		     <li><a href="http://www.thegardentime.com/archives/category/garden-tour">游花园<span>Y.Tour</span></a></li>
			 <li><a href="http://www.thegardentime.com/archives/category/garden-recipe">园食谱<span>G.life</span></a></li>
			 <li><a href="http://www.thegardentime.com/archives/category/small-bike">植百科<span>P.baike</span></a></li>
		 </ul>
		</div>
		
		 <script type="text/javascript" language="javascript">
     var nav = document.getElementById("menu");
     var links = nav.getElementsByTagName("li"); 
     var lilen = nav.getElementsByTagName("a"); 
     var currenturl = document.location.href; 
     var last = 0;
     for (var i=0;i<links.length;i++)
      {
        var linkurl = lilen[i].getAttribute("href");
              if(currenturl.indexOf(linkurl)!=-1)
                  {
                  last = i;
                  }
      }
      links[last].className = "navon"; 
</script> 

		 <div class="rss">
	   <a href="http://www.thegardentime.com/biao" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="rss"></a>
	   </div>
	     <div class="search"><form method="get" class="search-form" action="http://www.thegardentime.com" >
			<input class="search-input" name="s" type="text" placeholder="<?php bloginfo( 'name' ); ?>"><input class="search-submit" type="submit" value="">
		</form>
	   </div>
   </div>
   </div>
<!--nav End-->
</div>
		<!--Header End-->