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
<div id="single" role="main">
	<article role="article">
		<header><h2 class="post-name"><?php echo $log_title; ?></h2></header>
		<address class="entry-meta">
			<?php if($author == 1): ?><i class="icon-male"></i> <?php else: ?><i class="icon-female"></i><?php endif; ?><?php blog_author($author); ?>创建于<?php echo date('Y年m月d日',$value['date']); ?>
		</address>
		<div class="post-context"><?php echo $log_content; ?></div>
	</article>
	<div id="comments">
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	<?php blog_comments($comments,$params); ?>
	</div>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>