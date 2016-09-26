<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div><!--end #wrap-->
<div style="clear:both;"></div>
<div id="footerbar">
    <div class="dibubanquan">
  <?php echo $footer_info; ?> <a href="http://www.verytalk" target="_blank"><?php echo $icp; ?> </a>  Powered by <a href="http://www.verytalk.cn" target="_blank" title="VeryTalk">VeryTalk</a> 
	<?php doAction('index_footer'); ?>
<div id="back-to-top"></div>
	</div>
	
 <a href="http://www.verytalk.cn" target="_blank" title="VeryTalk">VeryTalk</a> </div><!--end #footerbar-->
<script src="<?php echo TEMPLATE_URL; ?>js/glbwl.js" type="text/javascript"></script>
<script>prettyPrint();</script>
</body>
</html>