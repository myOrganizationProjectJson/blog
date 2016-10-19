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
<?php
//判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return false;
    }
}
?>
<?php
//纯字符串
function clean( $string ){
	$string = trim( $string ); 
	$string = strip_tags( $string );
	$string = htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
	$string = str_replace( "\n", "", $string );
	$string = trim( $string );
	return $string;
}
?>
<?php
//评论内容
function comcontent($sb) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<blockquote>$1</blockquote>','<img alt="表情" src="'.TEMPLATE_URL.'images/face/$1.gif" />'); 
	$sb=preg_replace($patterns, $replace, $sb);
	return $sb;
}
?>
<?php
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
?>
<?php
//头像缓存
function SB_getGravatar($email, $s = 80, $d = 'mm', $r = 'g') {
	$f = md5($email);
	$a = TEMPLATE_URL.'images/avatar/'.$f.'.jpg';
	$e = EMLOG_ROOT.'/content/templates/MeiYing/images/avatar/'.$f.'.jpg';
	$sb=array("default.png"=>"01");
	$t = 1296000;
	if (empty($email)) $a = TEMPLATE_URL.'images/'.array_rand($sb);
	if (!is_file($e) || (time() - filemtime($e)) > $t ) {
	$g = sprintf("http://%d.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f.'?s='.$s.'&d='.$d.'&r='.$r;copy($g,$e); $a=$g;
    }
	if (filesize($e) < 500) copy($d,$e);
	return $a;
}?>
<?php
//文章分享
function share() {
	echo '
<div title="分享文章" class="open" onclick="share()">
	<i class="icon-plus"></i>
	<div class="share">
		<ul>
			<li title="分享到QQ空间"><a class="share1"></a></li>
			<li title="分享到新浪微博"><a class="share2"></a></li>
			<li title="分享到腾讯微博"><a class="share3"></a></li>
			<li title="分享到人人网"><a class="share4"></a></li>
			<li title="分享到Facebook"><a class="share5"></a></li>
			<li title="分享到twitter"><a class="share6"></a></li>
		</ul>
	</div>
</div>
';
} ?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;?>
<section>
	<h3><i class="icon-profile-male"></i><?php echo $title; ?></h3>
	<ul id="bloggerinfo">
		<a title="我的主题" href="#">我的主题</a>
		<a title="赞助博主" href="#">赞助博主</a>
		<a title="邮件联系" href="#">邮件联系</a>
		<a title="广而告之" href="#">广而告之</a>
	</ul>
</section>
<?php }?>
<?php
//widget：侧边搜索
function widget_search($title){ ?>
<section>
	<h3><i class="icon-magnifying-glass"></i><?php echo $title; ?></h3>
	<div id="logsearch">
		<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
			<input type="text" name="keyword" placeholder="搜索从这里开始" x-webkit-speech />
			<input type="submit" name="submit" value="搜索" />
		</form>
	</div>
	<div class="clear"></div>
</section>
<?php } ?>
<?php
//widget：侧边日历
function widget_calendar($title){ ?>
<section>
	<h3><i class="icon-calendar"></i><?php echo $title; ?></h3>
	<ul id="calendar"></ul>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
</section>
<?php }?>
<?php
//widget：标签
function widget_tag($title){global $CACHE;$tag_cache = $CACHE->readCache('tags');?>
<section>
	<h3><i class="icon-pricetags"></i><?php echo $title; ?></h3>
	<ul id="blogtags">
		<li>
			<?php shuffle ($tag_cache);
			$tag_cache = array_slice($tag_cache,0,25);foreach($tag_cache as $value):?><a rel="tag" href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?>篇文章"><?php if(empty($value['tagname'])){ echo "暂无标签";}else{echo $value['tagname'];}?></a>
			<?php endforeach; ?>
		</li>
	</ul>
</section>
<?php }?>
<?php
//widget：分类
function widget_sort($title){global $CACHE;$sort_cache = $CACHE->readCache('sort'); ?>
<section>
	<h3><i class="icon-puzzle"></i><?php echo $title; ?></h3>
	<ul id="blogsort">
	<?php foreach($sort_cache as $value):if ($value['pid'] != 0) continue;?>
		<li><i class="icon-stop"></i>
			<a title="<?php if(empty($value['lognum'])){ echo "还没写文章";}else{echo $value['lognum']."篇文章";}?>" href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?></a>
			<?php if (!empty($value['children'])): ?>
			(<?php $children = $value['children'];foreach ($children as $key):$value = $sort_cache[$key];?>
				<a title="<?php if(empty($value['lognum'])){ echo "还没写文章";}else{echo $value['lognum']."篇文章";}?>" href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?></a>
			<?php endforeach; ?>)
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php }?>
<?php
//widget：归档
function widget_archive($title){global $CACHE; $record_cache = $CACHE->readCache('record');?>
<section>
	<h3><i class="icon-layers"></i><?php echo $title; ?></h3>
	<ul id="record">
		<?php foreach($record_cache as $value): ?>
		<li>
			<i class="icon-stop"></i><a title="<?php echo $value['lognum']; ?>篇文章" href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php } ?>
<?php
//widget：友情链接
function widget_link($title){global $CACHE; $link_cache = $CACHE->readCache('link');if (!blog_tool_ishome()) return;?>
<section>
	<h3><i class="icon-attachment"></i><?php echo $title; ?></h3>
	<ul id="link">
		<?php foreach($link_cache as $value): ?>
		<li>
			<i class="icon-stop"></i><a rel="friend" href="<?php echo $value['url']; ?>" title="<?php if(empty($value['des'])){ echo $value['link'];}else{echo $value['des'];} ?>" target="_blank"><?php echo $value['link']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php }?>
<?php
//widget：站点统计
function widget_twitter($title){global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];$sta_cache = Cache::getInstance()->readCache('sta');?>
<section>
	<h3><i class="icon-ribbon"></i><?php if($title=="最新微语") {echo '站点统计';}else {echo $title;} ?></h3>
	<ul id="statistics">
		<li><i class="icon-stop"></i>文章数量：<?php echo $sta_cache['lognum'];?>篇</li>
		<li><i class="icon-stop"></i>评论数量：<?php echo $sta_cache['comnum_all'];?>条</li>
		<li><i class="icon-stop"></i>建站日期：2013年5月1号</li> 
		<li><i class="icon-stop"></i>存活时间：<?php echo floor((time()-strtotime("2013-5-1"))/86400); ?>天</li>
	</ul>
</section>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){global $CACHE;$com_cache = $CACHE->readCache('comment');?>
<h3><i class="icon-trophy"></i><?php echo $title; ?></h3>
<ul id="newcomment">
	<?php foreach($com_cache as $value):$url = Url::comment($value['gid'], $value['page'], $value['cid']);?>
	<li>
		<img alt="avatar" class="avatar" src="<?php echo SB_getGravatar($value['mail'])?>"/> <a title="<?php echo $value['name']; ?> 少侠" href="<?php echo $url; ?>"><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="表情" class="comface" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$value['content']); ?></a>
	</li>
	<?php endforeach; ?>
</ul>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){global $CACHE;$newLogs_cache = $CACHE->readCache('newlog');?>
<section>
	<h3><i class="icon-bargraph"></i><?php echo $title; ?></h3>
	<ul id="newlog">
		<?php foreach($newLogs_cache as $value){?>
		<li><i class="icon-stop"></i><a rel="bookmark" title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
		<?php } ?>
	</ul>
</section>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){$index_hotlognum = Option::get('index_hotlognum');$Log_Model = new Log_Model();$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
<section>
	<h3><i class="icon-bargraph"></i><?php echo $title; ?></h3>
	<ul id="hotlog">
		<?php foreach($randLogs as $value){?>
		<li><i class="icon-stop"></i><a rel="bookmark" title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
		<?php } ?>
	</ul>
</section>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){$index_randlognum = Option::get('index_randlognum');$Log_Model = new Log_Model();$randLogs = $Log_Model->getRandLog($index_randlognum);?>
<section>
	<h3><i class="icon-bargraph"></i><?php echo $title; ?></h3>
	<ul id="randlog">
		<?php foreach($randLogs as $value){?>
		<li><i class="icon-stop"></i><a rel="bookmark" title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
		<?php } ?>
	</ul>
</section>
<?php }?>
<?php
//widget：自定义
function widget_custom_text($title, $content){ ?>
<section>
	<h3><i class="icon-paperplane"></i><?php echo $title; ?></h3>
	<ul>
		<?php echo $content; ?>
	</ul>
</section>
<?php } ?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE;
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php foreach($navi_cache as $value):
	
	if ($value['pid'] != 0) {
	    continue;
	}
	
	if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):?>
	<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/">管理</a></li>
	<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
	<?php continue;endif;$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : ''; $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';?>
	<?php if (!empty($value['children'])) :?>
	<li class="item <?php echo $current_tab;?>">
		<a class="catbtns" href="//<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?><i class="arrow"></i></a>
		<ul class="sub-menu">
			<?php foreach ($value['children'] as $row){
					echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
			}?>
		</ul>
	</li>
	<?php elseif (!empty($value['childnavi'])) :?>
	<li class="item <?php echo $current_tab;?>">
		<a class="catbtns" href="//<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?><i class="arrow"></i></a>
		<ul class="sub-nav">
			<?php foreach ($value['childnavi'] as $row){
					$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
					echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
			}?>
		</ul>
	</li>
	<?php else:?>
	<li class="item <?php echo $current_tab;?>">
		<a href="//<?php echo $value['url']; ?>" <?php echo $newtab;?>>
		<?php echo $value['naviname']; ?>
		</a>
	</li>
	<?php endif;?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：导航2
function blog_navi2(){
	global $CACHE;
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul><span class="nav-arrow"><span></span></span>
		<li>
			<div class="msearch">
				<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
					<input type="text" name="keyword" placeholder="搜索从这里开始" />
					<input type="submit" name="submit" value="搜索" />
				</form>
			</div>
		</li>
		<?php foreach($navi_cache as $value):if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):?>
		<li class="item common"><i class="icon-stop"></i><a href="<?php echo BLOG_URL; ?>admin/">管理</a></li>
		<li class="item common"><i class="icon-stop"></i><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
		<?php continue;endif;$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : ''; $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';?>
		<?php if (!empty($value['children'])) :?>
		<li>
			<i class="icon-stop"></i><a href="<?php Url::sort($row['sid']) ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<ul>
				<?php foreach($value['children'] as $row){echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';}?>
			</ul>
		</li>
		<?php else: ?>
		<li class="<?php echo $current_tab;?>">
			<i class="icon-stop"></i><a href="//<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
		</li>
		<?php endif;?>
		<?php endforeach; ?>
		<li>
			<i class="icon-stop"></i><a href="javascript:">分类目录</a>
		</li>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<i class=\"top\">置顶</i> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<i class=\"top\">分类置顶</i> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">编辑</a>' : '';
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
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else: ?>
	<?php echo "未分类"; ?>
	<?php endif;?>
<?php }?>
<?php
//blog：日志标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a rel=\"tag\" href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag; }
	else {$tag = '<a rel=\"tag\">暂无标签</a>';
		echo $tag;}
}
?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = Cache::getInstance()->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	if($author!==($user_cache[1]['name'])){ $title = !empty($author) || !empty($des) ? "title=\"特邀作者\"" : '';}else{$title = !empty($author) || !empty($des) ? "title=\"丐帮帮主\"" : '';}
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){extract($neighborLog);?>
<?php if($prevLog):?>
<div class="post-prev"><a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></div>
<?php else:?>
<div class="post-prev"><a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>">木有了</a></div>
<?php endif;?>
<?php if($nextLog && $prevLog):?>
<?php endif;?>
<?php if($nextLog):?>
<div class="post-next"><a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a></div>
<?php else:?>
<div class="post-next"><a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>">木有了</a></div>
<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments,$params){
    extract($comments);$comnum = count($comments);
	if($commentStacks):?>
	<ol class="commentlist">
	<?php echo"<h3><i class='icon-beaker'></i>已有".$comnum."条评论</h3>"; ?>
	<?php endif; ?>
	<?php
    $count_comments = count($comments);
    $count_floors = $count_comments;
    foreach($comments as $value){
        if($value['pid'] != 0){ $count_floors--; }
    }
    $page = isset($params[5])?intval($params[5]):1;
    $i= $count_floors - ($page - 1)*Option::get('comment_pnum');
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="nofollow">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment-body" id="comment-<?php echo $comment['cid']; ?>">
		<div class="comment-head">
			<?php if($isGravatar == 'y'): ?>
			<img src="<?php echo SB_getGravatar($comment['mail']);?>" alt="avatar" class="avatar" /><?php endif; ?>
			<?php if(strip_tags($comment['poster'])==$name){echo "<span class='sbname'>".$name."</span>";}else{echo "<span class='name'>".$comment['poster']."</span>";} ?><span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span><span class="floor"><?php if($i>4) echo '#'.$i.'';elseif($i==4) echo '#Corner';elseif($i==3) echo '#Floor';elseif($i==2) echo '#Bench';elseif($i==1)echo '#Sofa'; ?></span>
		</div>
		<div class="comment-content">
			<span class="content"><?php echo comcontent($comment['content']); ?></span><span class="reply"><?php echo $comment['date']; ?><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="icon-reply"></i>回复</a></span><?php if(strip_tags($comment['poster'])==$name) echo '<span class="sign"><i class="icon-pencil"></i>求知若饥，虚心若愚。</span>';elseif($i==1) echo '<span class="sign"><i class="icon-pencil"></i>我是沙发！</span>';elseif($i==2) echo '<span class="sign"><i class="icon-pencil"></i>我是板凳！</span>';elseif($i==3) echo '<span class="sign"><i class="icon-pencil"></i>我是地板！</span>'; ?>
		</div>
		<ol class="children"><?php blog_comments_children($comments, $comment['children']); $ii=0;?></ol>
	</li>
	<?php $i--;endforeach; ?>
	</ol>
    <div class="commentnav">
		<?php echo $commentPageUrl;?>
		<?php if($commentPageUrl): ?>
		<?php endif; ?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="nofollow">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment-body-children" id="comment-<?php echo $comment['cid']; ?>">
		<div class="comment-head">
			<?php if($isGravatar == 'y'): ?>
			<img src="<?php echo SB_getGravatar($comment['mail'],35);?>" alt="avatar" class="avatar" /><?php endif; ?><?php if(strip_tags($comment['poster'])==$name){echo "<span class='sbname'>".$name."</span>";}else{echo "<span class='name'>".$comment['poster']."</span>";} ?><span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span>
		</div>
		<div class="comment-content">
			<span class="content"><?php echo comcontent($comment['content']); ?></span>
			<span class="reply"><?php echo $comment['date']; ?><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="icon-reply"></i>回复</a></span>
			<?php if(strip_tags($comment['poster'])==$name): ?><span class="sign"><i class="icon-pencil"></i><?php echo "求知若饥，虚心若愚。";?></span><?php endif; ?>
		</div>
		<?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</li>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()"><i class="icon-forward"></i>取消回复</a></div>
		<h3><i class="icon-chat"></i>发表评论<a name="respond"></a></h3>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<p>
				<input type="text" name="comname" maxlength="20" list="nickname" value="<?php echo $ckname; ?>" size="22" tabindex="1" required="required" placeholder="必填项" /><label for="author">昵称*</label>
			</p>
			<p>
				<input type="email" name="commail" id="email" maxlength="30" value="<?php echo $ckmail; ?>" size="22" tabindex="2" required="required" placeholder="必填项" /><label for="email">邮箱*</label>
				<ul class="emaillist"></ul>
			</p>
			<p>
				<input type="url" name="comurl" maxlength="30" value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="选填项" /><label for="url">网址</label>
			</p>
			<?php else: ?>
			<i class="icon-profile-male"></i>  管理员登录
			<?php endif; ?>
			<div class="textarea">
				<textarea name="comment" id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" rows="10" maxlength="500" tabindex="4" placeholder="你也要来一发吗？"></textarea>
			</div>
			<div class="opensmile" onclick="embedSmiley()" title="表情"><i class="icon-happy"></i></div>
			<div class="smile"><span class="copy-arrow"><span></span></span><?php include View::getView('smile');?></div>
			<p><?php echo $verifyCode; ?><button type="submit" id="submit" tabindex="6">发布</button></p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>