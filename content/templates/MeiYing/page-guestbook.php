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
<div id="single" class="page" role="main">
	<article role="article">
		<header><h2 class="post-name"><i class="icon-chat"></i><?php echo $log_title; ?></h2></header>
		<address class="entry-meta">
			<i class="icon-hotairballoon"></i> <?php blog_author($author); ?>创建于<?php echo date('Y年m月d日',$date); ?>
		</address>
		<ul id="guestbook">
			<?php
			global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
			$DB = MySql :: getInstance();
			$time_side = strtotime('this month',strtotime(date('m/01/y')));
			$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date > $time_side and poster != '".$name."' and  poster !='匿名' and hide ='n' group by mail order by comment_nums DESC limit 0,10";
			$result = $DB -> query( $sql );
			while( $row = $DB -> fetch_array( $result ) )
			{$img = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\"><img  alt=\"avatar\"  src=\"" . SB_getGravatar($row['mail'],80) . "\" class=\"avatar\"><span class=\"wall_name\">" . $row[ 'poster' ] ."</span></a></li>";
			 if( $row[ 'url' ] )
			{$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\" ><img  alt=\"avatar\"  src=\"" . SB_getGravatar($row['mail'],80) . "\" class=\"avatar\"><span class=\"wall_name\">" . $row[ 'poster' ] ."</span></a></li>";
			}
			else
			{$tmp = $img;}
			$output .= $tmp;
			}
			$output = ''. $output .'';
			echo $output ;
			 ?>
		</ul>
		<div class="post-context"><?php echo $log_content; ?></div>
	</article>
	<div id="comments">
		<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		<?php blog_comments($comments,$params); ?>
	</div>
</div>
<?php include View::getView('side'); ?>
<?php include View::getView('footer'); ?>