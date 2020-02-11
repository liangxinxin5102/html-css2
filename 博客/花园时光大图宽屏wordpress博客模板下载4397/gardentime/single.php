<?php get_header(); ?>

<!--当前位置-->

<div class="crumb"><a href="http://mohuansenlin.com">Home</a> &gt; <?php $categorys=get_the_category(); $category=$categorys[0]; echo(
get_category_parents($category->term_id,true,' &gt; ') ); ?><span><?php the_title(); ?></span>
</div>

<div id="ami">
<div id="all">
<!--Container-->
<div id="container">
	<!--Content-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>
	<div class="content_text">
	   	<div class="title">
			    <a href="<?php the_author_meta('user_url'); ?>" class="avatar"><?php echo get_avatar( get_the_author_meta('user_email'), '43', '' ); ?><span><?php echo get_avatar( get_the_author_meta('user_email'), '43', '' ); ?></span></a> 
        <i class="line_h"></i> 
				<h3>
					 <a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>
				<p><?php the_author_posts_link(); ?> - <?php the_category(',') ?> - <?php the_time('Y.m.d'); ?>
				</p> 
		   <span><?php comments_popup_link('0', '1', '%', 'up'); ?></span>	
		</div><!--title-->
		<?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
		<div class="banner">
		<?php the_content(); ?>
		</div>	<!--content_text-->
		<div class="article-tag">
<?php the_tags('  ', ' , ' , ''); ?>
　　　　　　</div><!--tag-->

	     <div class="textbottom">
		 <!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_mshare"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_t163"></a>
<a class="bds_qzone"></a>
<a class="bds_kaixin001"></a>
<a class="bds_renren"></a>
<a class="bds_douban"></a>
<a class="bds_diandian"></a>
<a class="bds_taobao"></a>
<a class="bds_xg"></a>
<a class="bds_sqq"></a>
<a class="bds_bdhome"></a>
<a class="bds_hi"></a>
<span class="bds_more"></span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1&amp;uid=6765434" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
            <div class="floatleft">Front : <?php previous_post_link('%link'); ?></div>
            <div class="floatright">Next : <?php next_post_link('%link '); ?></div>
		   
		</div><!--textbottom -->
	</div><!--content_text-->
	
	<?php endwhile;?><?php endif; ?>
	
	<!--相关文章-->
	<div class="xianguan">
	<div class="title">你喜欢下面的文章吗！Do you like the following articles?</div>
<ul>
<?php
$post_num = 4;
$exclude_id = $post->ID;
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
	$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
	$args = array(
		'post_status' => 'publish',
		'tag__in' => explode(',', $tags),
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'comment_date',
		'posts_per_page' => $post_num,
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
		<li><a href="<?php the_permalink() ?>" class="pic"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(thumbnail); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?></a> <a rel="bookmark" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  class="link"><?php the_title(); ?></a></li>
	<?php
		$exclude_id .= ',' . $post->ID; $i ++;
	} wp_reset_query();
}
if ( $i < $post_num ) {
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
		'category__in' => explode(',', $cats),
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'comment_date',
		'posts_per_page' => $post_num - $i
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
		<li><a href="<?php the_permalink() ?>" class="pic"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(thumbnail); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?></a> <a rel="bookmark" href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>"  class="link"><?php the_title(); ?></a></li>
	<?php $i++;
	} wp_reset_query();
}
if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
?>
</ul>
</div>
<!--相关文章-->

 <div id="comments" class="comment"><?php comments_template('', true); ?></div><!--comments-->

</div><!--Container-->
</div><!--all-->
<?php get_sidebar(); ?>
</div><!--ami-->
<?php get_footer(); ?>