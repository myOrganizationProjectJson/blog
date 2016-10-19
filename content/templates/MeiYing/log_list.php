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
<div id="content" role="main">
	<?php doAction('index_loglist_top'); ?>
	<?php if (!empty($logs)):foreach($logs as $value):?>
	<article class="post-list" role="article">
		<header class="post-header">
			<h2 class="post-title"><a rel="bookmark" title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a><?php topflg($value['top']); ?><?php if(((date('Ymd',time())-date('Ymd',$value['date']))<=2)&&($value['top']=='n')){echo "<i class='new'>最新</i>";}else if(($value['views']>=5000)&&($value['top']=='n')){echo "<i class='hot'>热门</i>";};?></h2>
		</header>
		<div class="post-content">
			<?php preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);$imgsrc = $img[1][0];if(!empty($img[1])):$image_size=getimagesize($imgsrc);if($image_size[0]>=100): ?>
			<div class="post-thumbnail">
				<a href="<?php echo $value['log_url']; ?>"><img src="<?php echo $imgsrc; ?>" alt="<?php echo $value['log_title']; ?>"/></a>
			</div>
			<?php endif;endif; ?>
			<div class="post-excerpt">
				<?php echo subString(clean($value['log_description']),0,250); ?>
			</div>
			<div class="clear"></div>
			<div class="post-meta">
				<span class="ptime"><i class="icon-calendar"></i><?php echo date('Y年m月d日',$value['date']); ?></span>
				<span class="pcomm"><i class="icon-heart"></i><?php echo "热度：".$value['views']; ?></span>
				<span class="pview"><i class="icon-chat"></i><?php if($value['comnum']=="0"){ echo '<a title="抢沙发" href="'.$value['log_url'].'#respond">抢沙发</a>'; }else{ echo  '<a title="《'.$value['log_title'].'》上的评论" href="'.$value['log_url'].'#comments">'.$value['comnum'].'条评论</a>'; } ?></span>
			</div>
			<div class="post-more">
				<a href="<?php echo $value['log_url']; ?>"><i class="icon-hotairballoon"></i> 阅读全文</a>
			</div>
		</div>
		<div class="clear"></div>
	</article>
    <?php endforeach;else: ?>
    <h2><i class="icon-hotairballoon"></i> Nothing Found!</h2>
	<p>对不起，没有搜索到“<?php echo urldecode($params[2]);?>”任何相关信息！<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></p>
    <?php endif; ?>
    <div class="pagenavi"><?php if($page>1): ?><a title="上一页" href="<?php echo BLOG_URL; ?>?page=<?php echo $page-1; ?>"><i class="icon-triangle-left"></i></a>
	<?php endif; ?>
	<?php echo $page_url; ?><?php if($page<ceil($lognum/$index_lognum)): ?><a title="下一页" href="<?php echo BLOG_URL; ?>?page=<?php echo $page+1; ?>"><i class="icon-triangle-right"></i></a>
	<?php endif; ?>
	</div>
</div>
<?php
include View::getView('side');
include View::getView('footer');
?>