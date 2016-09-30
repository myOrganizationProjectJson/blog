<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php 
function glbwl_getGravatar($email, $s = 40, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</ul>
</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div class="sidebar-01 sidebar-02">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a></li>
	<?php if (!empty($value['children'])): ?>
		
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li><a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a></li>
		<?php endforeach; ?>
		
	<?php endif; ?>
	
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	  <li><div class="avatar"><a href="<?php echo $url; ?>" ><img src="./content/templates/GlBwl_v5929/images/avatar.png" /></a></div>
	   <div class="current1"> <span><?php echo $value['name']; ?></span>  说：</br>
      <a href="<?php echo $url; ?>" ><?php echo $value['content']; ?></a></div></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
	<?php foreach($newLogs_cache as $value): ?>
	<li class="sidebar-06"><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div id="scroll">
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php $db = MySql::getInstance();$db = MySql::getInstance();
$time = time();
$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog inner join ".DB_PREFIX."sort WHERE hide='n' AND type='blog' AND date > $time - 300*24*60*60 AND top='n' AND sortid=sid order by `views` DESC limit 0,$index_hotlognum");
while($row = $db->fetch_array($sql)){ $logpost = !empty($row['excerpt']) ? $row['excerpt'] :''.$row['content'].''; if (!empty($row['excerpt'])){preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i",$row['excerpt'],$match);if(empty($match[1][0])){
preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i",$row['content'],$match);}}else{preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $row['content'],$match);}
$img = isset($match[0][0]) ? $match[0][0]:'<img src="'.TEMPLATE_URL.'images/rand/'.rand(0,247).'.jpg" />';//无图片时显示
$date = gmdate('Y年m月d日', $row['date']);
$content = strip_tags($logpost,'');
$content = mb_substr($content,0,100,'utf-8');//摘要字数修改本代码中的100这个即可
$comment = ($row['comnum'] != 0) ? ''.$row['comnum'].'' : '0';
$gid = $row['gid'];?>
    <div class="sidebar-03">
	  <div class="thumb"><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>"><?php echo $img;?></a></div>
	  <div class="sidebar-04"><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" /><?php echo $row['title'];?></a></div>
	  <div class="sidebar-05"><i class="fa fa-clock-o"></i> <?php echo gmdate('Y-m-d', $row['date']);?></div>
    </div>
	<?php }?>
	</ul>
	</div>
	</div>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li class="sidebar-06"><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logsearch">
	<div class="search">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="input" type="text" placeholder="在这里输入文字，按回车搜索结果。" />
	</form>
	</div>
	</ul>
	</div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="sidebar-01">
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<div class="sidebar-01 sidebar-02">
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php foreach($link_cache as $value): ?>
	<li class="sidebar-li"><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="bar">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="item <?php echo $current_tab;?>">
			<a href="<?php echo Url::sort($value['typeId']);//$value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="sub-nav">
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul class="sub-nav">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：导航
function blog_navi2(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="bar">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="item <?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul id="sub-nav">
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul id="sub-nav">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag = '';
		echo 	'<span class="tag-'.rand(1, 5).'"><a href="'.Url::tag($value['tagurl']).'" rel="tag">'.$value['tagname'].'</a></span>';
		}
			echo $tag;
	}
	else {$tag = '<span class="tag-'.rand(1, 5).'">没有标签！</span>';
	    echo $tag;}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<div class="xlwz-s">
	上一篇：<a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	</div>
	<?php endif;?>
	<?php if($nextLog):?>
	<div class="xlwz-x">
	下一篇：<a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>
	</div>
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
	<h3>评论</h3>
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="comment-xf">
		<?php if($isGravatar == 'y'): ?><div class="author"><img src="<?php echo glbwl_getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<div class="comment-info">
			<span class="comment-author"><?php echo $comment['poster']; ?></span>
			<span><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\""); ?></span>
			<span class="comment-time"><?php echo $comment['date']; ?></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div></br>
		</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php endforeach; ?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?><div class="children">
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="comment-xf">
		<?php if($isGravatar == 'y'): ?><div class="author"><img src="<?php echo glbwl_getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<div class="comment-info">
			<span class="comment-author"><?php echo $comment['poster']; ?></span>
			<span><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\""); ?></span>
			<span class="comment-time"><?php echo $comment['date']; ?></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div></br>
		</div>
		</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
		<h3>发表评论</h3>	<a name="respond"></a>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform" class="comment-form">
		<div id="comment-form-info">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == 'visitor'): ?>
			<div class="form-group">
					
					<input type="text" id="comname" name="comname" class="input" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1" placeholder="昵称" required />
		  </div>
				<div class="form-group">
					
					<input type="email" id="commail" name="commail" class="input" maxlength="128" value="<?php echo $ckmail; ?>" size="22" tabindex="2" placeholder="邮箱" required />
				</div>
				<div class="form-group">
					<input type="text" id="comurl" name="comurl" class="input" maxlength="128" value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="www.verytalk.cn" pattern="((http|https)://|)+([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?"/>
				</div>
			<?php endif; ?>
		  </div>
			<div class="comment-form-comment">
			<textarea name="comment" id="comment" rows="5" class="input-01" data-ajax-empty="评论内容不能为空" tabindex="4" placeholder="任何广告行为都会被封杀的哦~" required></textarea>
			<p id="error" style="color:red"></p>
			</div>
			
			<div class="comment-form-submit">
			<?php echo $verifyCode; ?><input type="submit" id="comment_submit"  class="input-02" value="发表评论" tabindex="6" />
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			</div>
		</form>
	</div>
</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>

<?php
//comment：输出评论人等级
function echo_levels($comment_author_email,$comment_author_url){
  $DB = MySql::getInstance();
  global $CACHE;$user_cache = $CACHE->readCache('user'); 
  $adminEmail = '"'.$user_cache[1]['mail'].'"';
  if($comment_author_email==$adminEmail)
  {
    echo '<a class="vip" href="mailto:'.$user_cache[1]['mail'].'" title="管理员认证"></a><a class="vip7" title="特别认证"></a>';
  }
  $sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail = $comment_author_email and hide ='n'";
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
   if($author_count>=1 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '<a class="vip1" title="路过酱油 LV.1"></a>';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '<a class="vip2" title="偶尔光临 LV.2"></a>';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '<a class="vip3" title="常驻人口 LV.3"></a>';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '<a class="vip4" title="以博为家 LV.4"></a>';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '<a class="vip5" title="情牵小博 LV.5"></a>';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '<a class="vip6" title="为博终老 LV.6"></a>';
  else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
    echo '<a class="vip7" title="三世情牵 LV.7"></a>';
}
?>
