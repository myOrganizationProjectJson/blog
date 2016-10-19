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
	<div class="post-related">
		<h3><i class="icon-aperture"></i>暧昧贴</h3>
		<ul>
			<?php $date = time() - 3600 * 24 * 360;$Log_Model = new Log_Model();$viewslogs = $Log_Model->getLogsForHome("AND date > {$date} ORDER BY views DESC,date DESC", 1, 6);?>
			<?php foreach($viewslogs as $value): ?>
			<li><a rel="bookmark" href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>" target="_blank">
				<div class="thumb"></div>
				<div class="title"><?php echo $value['log_title']; ?></div>
				<div class="modified"><?php if($value['comnum']>70){ echo '<span class="icon-star5"></span>'; }else if($value['comnum']>50){ echo '<span class="icon-star4"></span>'; }else if($value['comnum']>30){ echo '<span class="icon-star3"></span>'; }else if($value['comnum']>10){ echo '<span class="icon-star2"></span>'; }else{ echo '<i class="icon-star1"></i>'; }; ?></div></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clear"></div>
	</div>
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