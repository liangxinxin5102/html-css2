<!--Footer-->
<div id="footer">
       <div class="fmi">
	    
            
		    <?php bloginfo( 'name' ); ?> <a href="http://mohuansenlin.com/?page_id=2"><font color="#2b8109">Power by Mohuan 8.0</font></a> 
			 <script src="http://s17.cnzz.com/stat.php?id=5163382&web_id=5163382" language="JavaScript"></script>   <a href="http://www.miitbeian.gov.cn/">粤ICP备13063893号-2	</a> 
             		 
		   </div><!--fmi-->	   
</div>
	<div class="scroll" id="scroll" style="display:none;">
		回到顶部
	</div>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		showScroll();
		function showScroll(){
			$(window).scroll( function() { 
				var scrollValue=$(window).scrollTop();
				scrollValue > 100 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
			} );	
			$('#scroll').click(function(){
				$("html,body").animate({scrollTop:0},200);	
			});	
		}
	})
	</script>
	
<!--Footer End-->
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=5&amp;pos=right&amp;uid=6765434" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"bdTop":225};
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->
<?php wp_footer(); ?>
</body>
</html>