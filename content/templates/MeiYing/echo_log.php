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
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="single" role="main">
	<article role="article">
		<header class="post-header">
			<h2><?php echo $log_title; ?><?php topflg($top); ?><?php if(((date('Ymd',time())-date('Ymd',$date))<=2)&&($top=='n')){echo "<i class='new'>最新</i>";}else if(($views>=5000)&&($top=='n')){echo "<i class='hot'>热门</i>";};?></h2>
		</header>
		<address class="entry-meta">
			<i class="icon-hotairballoon"></i> <?php blog_author($author); ?>于<?php echo date('Y年m月d日',$date); ?>发布
			<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
			<ul>
				<li><i class="icon-edit"></i> <?php editflg($logid,$author); ?></li>
				<li><i class="icon-hotairballoon"></i> <a title="返回首页" rel="nofollow" href="<?php echo BLOG_URL; ?>">返回首页</a></li>
			</ul>
			<?php endif; ?>
			<?php share(); ?>
		</address>
		<div class="post-context">
			<i class="icon-quote"></i><?php echo $log_content; ?>
		</div>
		<footer>
			<i class="icon-flag"></i> 分类：<div class="post-tags"><?php blog_sort($logid); ?></div>标签：<div class="post-tags"><?php blog_tag($logid);?></div>
			<div class="cutline"></div>
		</footer>
	</article>
	<?php doAction('log_related', $logData); ?>
	<?php $CACHE = Cache::getInstance();$sta_cache = $CACHE->readCache('sta');if($sta_cache['lognum']>=6):?>
	<?php endif;?>
	<div class="post-navigation">
		<?php neighbor_log($neighborLog); ?>
	</div>
	<div id="comments">
		<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		<?php blog_comments($comments,$params); ?>
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>