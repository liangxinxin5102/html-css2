<?php
/*
Template Name: tag
*/
?><?php get_header(); ?>
<div id="ami">

<?php wp_tag_cloud('smallest=9&largest=9&number=400&format=list&orderby=count'); ?>

</div>

<?php get_footer(); ?>