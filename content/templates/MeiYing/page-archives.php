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
		<header><h2 class="post-name"><i class="icon-layers"></i><?php echo $log_title; ?></h2></header>
		<address class="entry-meta">
			<i class="icon-hotairballoon"></i> <?php blog_author($author); ?>创建于<?php echo date('Y年m月d日',$date); ?>
		</address>
			<?php
			function displayRecord(){
				global $CACHE; 
				$record_cache = $CACHE->readCache('record');
				$output = '';
				foreach($record_cache as $value){
					$output .= '<h4>'.$value['record'].'</h4>'.displayRecordItem($value['date']);
				}
				$output = '<div class="archives">'.$output.'</div>';
				return $output;
			}
			function displayRecordItem($record){
				if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
					$days = getMonthDayNum($match[2], $match[1]);
					$record_stime = emStrtotime($record . '01');
					$record_etime = $record_stime + 3600 * 24 * $days;
				} else {
					$record_stime = emStrtotime($record);
					$record_etime = $record_stime + 3600 * 24;
				}
				$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
				$result = archiver_db($sql);
				return $result;
			}
			function archiver_db($condition = ''){
				$DB = MySql::getInstance();
				$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
				$result = $DB->query($sql);
				$output = '';
				while ($row = $DB->fetch_array($result)) {
					$log_url = Url::log($row['gid']);
					if($row['views']>5000){$output .= '<li class="goodwork"><a title="热门文章" href="'.$log_url.'"><span>'.date('m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';}
					else{$output .= '<li><a href="'.$log_url.'"><span>'.date('m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';}
				}
				$output = empty($output) ? '<li>暂无文章</li>' : $output;
				$output = '<ul>'.$output.'</ul>';
				return $output;
			}
			echo displayRecord();
			?>
	</article>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>