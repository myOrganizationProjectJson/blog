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
		<header><h2 class="post-name"><i class="icon-heart"></i><?php echo $log_title; ?></h2></header>
		<address class="entry-meta">
			<i class="icon-hotairballoon"></i> <?php blog_author($author); ?>创建于<?php echo date('Y年m月d日',$date); ?>
		</address>
		<?php global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	foreach($link_cache as $value){
	$output.= '<li><a target="_blank" href="'.$value['url'].'" title="'.$value['des'].'">'.'<img src="http://g.soz.im/'.$value['url'].'">'.$value['link'].'</a><p>'.$value['des'].'</p></li>';
	}
	echo '<ul class="link-content">'.$output.'</ul>';?>
	</article>
	<div id="comments">
		<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		<?php blog_comments($comments,$params); ?>
	</div>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>