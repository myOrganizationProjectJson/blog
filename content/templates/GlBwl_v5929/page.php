<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
 <div class="content">
	<h2><?php echo $log_title; ?></h2>
	<div class="content-bt"><img src="<?php echo TEMPLATE_URL; ?>images/bt.png" width="100%" height="2px"/></div>
	<div class="log-content">
	<?php echo $log_content; ?>
	</div>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	<div style="clear:both;"></div>
	</div><!--end .content-->
</div><!--end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>
