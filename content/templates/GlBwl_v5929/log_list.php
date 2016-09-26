<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
  <div class="content">
<?php doAction('index_loglist_top'); ?>
<?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
<div class="liebiao">
<div class="liebiao-tupian">
	<?php
		preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
		$imgsrc = !empty($img[1]) ? $img[1][0] : TEMPLATE_URL.'images/rand/'.rand(0,247).'.jpg';
		?>
		<div class="liebiao-tupian-01"><a href="<?php echo $value['log_url']; ?>"><p class="liebiao-tupian-01-a"><?php echo $value['log_title']; ?></p></div><img src="<?php echo $imgsrc; ?>" class="liebiao-tupian-01-i" alt="<?php echo $value['log_title']; ?>"/></a>
</div><!--end .liebiao-tupian-->
<h3 class="liebiao-bt"><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h3>
  <div class="liebiao-p"><?php echo subString(strip_tags($value['log_description']),0,150); ?></div>
  <div class="liebiao-xx">
	<span  class="pdate"><i class="fa fa-clock-o"></i> <?php echo gmdate('Y-n-j', $value['date']); ?> </span >
    <span  class="pcata"><i class="fa fa-th-list"></i> <?php blog_sort($value['logid']); ?></span>
	<span  class="pcomnum"><i class="fa fa-comment"></i> <a href="<?php echo $value['log_url']; ?>#comments" title="评论"><?php echo $value['comnum']; ?></a></span >
	<span  class="pviews"><i class="fa fa-eye"></i> <a href="<?php echo $value['log_url']; ?>" title="浏览"><?php echo $value['views']; ?></a></span >
	</div>
  </div><!-- end #liebiao-->
<?php 
endforeach;
else:
?>
	<h2>未找到</h2>
	<p>抱歉，没有符合您查询条件的结果。</p>
<?php endif;?>
<div style="clear:both;"></div>
<div id="pagenavi">
	<?php echo $page_url;?>
</div>
</div><!-- end .content-->
</div><!-- end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>