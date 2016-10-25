<?php 
/**
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--end #content-->
</div><div></div>
<div id="footerbar-out" style="/*clear:both; width: 1200px;margin: 0 auto;padding: 0;*/">
<div id="footerbar">
	<a onclick="goTop();" href="javascript:void(0);">返回顶部</a> &nbsp;&nbsp;
	<a href="/">首页</a> &nbsp;&nbsp;
<a href="<?php echo BLOG_URL; ?>m/" title="手机版本" target="_blank">手机版本</a> &nbsp;&nbsp;

	<br>版权所有：<a href="<?php echo BLOG_URL; ?>" class="chaffle" data-lang="zh"><?php echo $blogname; ?></a>&nbsp;&nbsp;&nbsp;
站长：<span class="chaffle" data-lang="zh">
<?php
if (!empty($tws)):
    echo $author; //微语;
elseif (isset($logid)):
    blog_author($author); //日志＋自建页面;
else:
    blog_author($value['author']); //列表页
endif;
?>
</span>&nbsp;&nbsp;&nbsp;
<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>&nbsp;&nbsp;<?php echo $footer_info; ?>&nbsp;&nbsp;
	<?php doAction('index_footer'); ?>
</div>
<div id="dening">
<div id="shangxia" class="animated bounceInUp">
<div id="shang" title0="回到顶部"></div>
<div id="comt"><a id="ds-reset" title0="随便看看评论喽~"><img src="<?php echo TEMPLATE_URL; ?>images/kongbai.png"></a></div>
<div id="xia" title0="直下底部"></div>
</div>
<script>function fuckyou(){window.close(),window.location="about:blank"}function ck(){return console.profile(),console.profileEnd(),console.clear&&console.clear(),"object"==typeof console.profiles?console.profiles.length>0:void 0}function hehe(){(window.console&&(console.firebug||console.table&&/firebug/i.test(console.table()))||"object"==typeof opera&&"function"==typeof opera.postError&&console.profile.length>0)&&fuckyou(),"object"==typeof console.profiles&&console.profiles.length>0&&fuckyou()}hehe(),window.onresize=function(){window.outerHeight-window.innerHeight>200&&fuckyou()};</script>
<script data-no-instant="">function stop(){return false}document.oncontextmenu=stop;</script>
<script src="<?php echo TEMPLATE_URL; ?>js/iitboy.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/swfobject_modified.js" type="text/javascript"></script>
<script>
	
</script>
</div></div>
<div class="loading">
  <div class="loading2">
    <div class="block"></div>
    <div class="block"></div>
    <div class="block"></div>
    <div class="block"></div>
  </div>
</div>
<script type="text/javascript">

<?php doAction('Fw_iitboy'); ?>
</body>
</html>