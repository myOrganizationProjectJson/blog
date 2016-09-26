<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
  <div class="content">
  <h2><?php topflg($top); ?><?php echo $log_title; ?></h2>
  <div class="content-bt"><img src="<?php echo TEMPLATE_URL; ?>images/bt.png" width="100%" height="2px"/></div>
  <div class="liebiao-xx">
	<span class="pauthor"><i class="fa fa-user"></i> <?php blog_author($author); ?></span>
		<span class="ptime"><i class="fa fa-clock-o"></i> <?php echo gmdate('Y-n-j', $date); ?></span>
		<span class="pcata"><i class="fa fa-th-list"></i> <?php blog_sort($logid); ?></span>
		<span class="pcomm"><i class="fa fa-comment"></i> <?php if($comnum=="0"){ echo '<a href="#respond">评论</a>'; }else{ echo '<a href="#comments">'.$comnum.'条评论</a>'; } ?></span>
		<span class="pview"><i class="fa fa-eye"></i> <?php echo $views." 次"; ?></span>
		<span><?php editflg($logid,$author); ?></span>
	</div>
	<div class="log-content">
	<?php echo $log_content; ?>
	</div>
  </div><!--end .content-->
  <div class="tag">
  <i class="fa fa-tag"></i> <?php blog_tag($logid); ?>
  </div><!--end .tag-->
<div class="log-copyright">
 <div class="log_rb">
        <div class="rwm">
	<img src="http://qr.liantu.com/api.php?&bg=ffffff&w=100&m=6&fg=000000&text=<?php $url_this =  "http://".$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI'];echo $url_this; ?>" alt="二维码加载中..." title="请用手机扫一扫此二维码分享给你的朋友！"></div>
    <div class="bqqm">
      <p>版权属于：<a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;本文作者：<?php blog_author($author); ?></p>
						<p>	原文地址： <a href="<?php echo Url::log($logid); ?>"><?php echo Url::log($logid); ?></a></p>
						<p><b>版权声明：</b>转载时必须以链接形式注明原始出处及本声明。</p></div>
						</div>
</div><!--end .log_copyright-->
  <?php doAction('log_related', $logData); ?>
	<div class="nextlog"><?php neighbor_log($neighborLog); ?></div>
	<div id="comments" class="comments">
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div><!--end #comments-->
</div><!--end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>