<div id="sidebar">

     <!--微薄-->

     <div class="xinlan">
	     <wb:follow-button uid="3911525495" type="red_3" width="300" height="24" ></wb:follow-button>
	 </div>
	 
	  <!--crtl+d-->
	 
	 <div class="bannerbox">
          <img src="<?php bloginfo('template_directory'); ?>/images/box2.jpg"  alt"gardenmarket">
	  </div>
	  
	  <!--交流群-->
	  
      <div class="bannerbox">
            <img src="<?php bloginfo('template_directory'); ?>/images/qqqun.jpg"  alt"园艺交流群">
	  </div>
	  
	  <!--主题-->
	  
	  <div class="bannerbox">
           <a href="http://www.thegardentime.com/353"><img src="<?php bloginfo('template_directory'); ?>/images/theme.jpg"  alt"gardenmarket"></a>
	  </div>
	  
	  <!--二维码-->
    
	   <div class="bannerbox">
	         <img src="<?php bloginfo('template_directory'); ?>/images/erwei.png"  alt"gardenmarket">
	   </div>

       <!--最新文章-->
	   
       <div class="tnew">	   
            <div class="title">
	         Latest Articles
            </div>
            <ul>
         <?php
global $post;
$cats = wp_get_post_categories($post->ID);
if ($cats) {
    $args = array(
          'category__in' => array( $cats[0] ),
          'post__not_in' => array( $post->ID ),
          'showposts' => 10,
          'caller_get_posts' => 1
      );
  query_posts($args);
  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>
  <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><p>views:<?php post_views(' ', ' '); ?></p></li>
<?php
    }
  }
  else {
    echo '<li>This column is no latest articles</li>';
  }
  wp_reset_query();
}
else {
  echo '<li>This column is no latest articles</li>';
}
?>
            </ul>
            </div>
			
			<!--厨房文章-->

		 	<div class="picnew">
                <div class="title">
	                 G.life Top 5 Recipes 
	            </div>
                <ul>
<?php $recent = new WP_Query("cat=37&showposts=6"); while($recent->have_posts()) : $recent->the_post();?>
                    <li>
<a href="<?php the_permalink() ?>" class="pic"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(thumbnail); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?></a> 
<a href="<?php the_permalink() ?>" rel="bookmark" class="link">
<?php the_title(); ?>
</a>
<p><?php the_time('Y.m.d'); ?> - views:<?php post_views(' ', ' '); ?></p></li>
<?php endwhile; ?>
                </ul>
                </div>
		   
		   <!--随机文章-->
		   
		   <div class="random">
               <div class="title">
	                Random 7 article 
	          </div>
      <?php 
$pop = $wpdb->get_results("SELECT id, post_title
FROM {$wpdb->prefix}posts
WHERE post_type='post' AND post_status='publish' AND
post_password='' AND comment_count = 0
ORDER BY rand()
LIMIT 10"); ?>
             <ul>
<?php foreach($pop as $post) : ?>
                <li>
    <a href="<?php echo get_permalink($post->id); ?>">
      <?php echo $post->post_title; ?>
    </a> 
               </li>
<?php endforeach; ?>
            </ul> 
		    </div>
			
			 <!--百度广告-->
		   
		   	<div class="bannerbox">
              <script type="text/javascript">
/*主站右则*/
var cpro_id = "u1519234";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
	        </div>
                  
       </div><!--sidebar-->