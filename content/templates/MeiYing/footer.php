<?php
/*
Template Name:魅影
Description:Designed For Emlog
Version:1.0
Author:麦特佐罗
Author Url:http://hc123.site/zorro
Sidebar Amount:1
ForEmlog:5.3.0
*/
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
</div>
<div class="clear"></div>
<div id="circle"></div>
<div id="circletext"></div>
<div id="circle1"></div>
<nav id="mmenu" role="navigation"><?php blog_navi2();?></nav>
</div>
<footer id="footer" role="contentinfo">
	<address>©&nbsp;<?php echo $blogname; ?>|Powered by <a rel="license" title=" <?php echo Option::EMLOG_VERSION;?>" href="//verytalk.cn" target="_blank">verytalk</a> 
		<div class="copyright">
			<a href="//verytalk.cn" target="_blank"><?php echo $icp; ?></a><?php echo $footer_info; ?><?php doAction('index_footer'); ?>
		</div>
	</address>
</footer>
<script type="text/javascript">
$(function() {          
$("img").not("#sidebar img").lazyload({
effect:"fadeIn"
});
});
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/lazyload.js"></script>
</body>
</html>