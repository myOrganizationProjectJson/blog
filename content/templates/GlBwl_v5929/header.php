<?php
/*
Template Name:孤狼自适应模板（v 5.9.29）
Description:孤狼GlBwl主题模板，黑色大气。
Version:5.9.29
Author:孤狼
Author Url:http://www.glbwl.com
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}
function chk_ie_browser() {
    $userbrowser = $_SERVER['HTTP_USER_AGENT'];
    if ( preg_match( '/MSIE/i', $userbrowser ) ) {
        $usingie = true;
    } else {
        $usingie = false;
    }
    return $usingie;
}
if(chk_ie_browser()){
    header("Location:code.html");
      exit();
    
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no"> -->
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" /><link rel="SHORTCUT ICON" href="favicon.ico"/>
<link href="<?php echo TEMPLATE_URL; ?>main.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"></script>
<style>
html,body{overflow-x: hidden;}
</style><div id='wx_pic' style='margin:0 auto;display:none;'><?php $rimg = !empty($img[1]) ? $img[1][0] : TEMPLATE_URL.'images/rand/'.rand(0,247).'.jpg';?><img src='<?php echo $rimg;?>' style='height:300px;width:300px;'/></div></head>
<body id='bodys'>
  <div id="dinbugudin">
  <div class="dinbugudin-01">
    <div class="tupian"><a href="<?php echo BLOG_URL; ?>" style='font-size:30px;;color: #FFF;'><!-- img src="<?php echo TEMPLATE_URL; ?>images/logo.png" alt="<?php echo $blogname; ?>" /> --> verytalk.cn</a></div>
    <div class="daohang"><?php blog_navi();?></div>
    </div><!-- end .dinbugudin-01-->
  </div><!-- end #dinbugudin--> 
<div id="menu">
       <?php blog_navi2();?>
  </div><!--menu-->
   <div class="daohang-01">
		            <a href="#" id="mobile-menu"><span class="icon-menu"></span><span class="icon-menu"></span><span class="icon-menu"></span></a>
		        </div>

<div id="wrap">
<div class="search2">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="input" type="text" placeholder="在这里输入文字，按回车搜索结果。" />
	</form>
	</div>
<div class="gonggao"><i class="fa fa-volume-up"></i> <?php global $CACHE;  $newtws = $CACHE->readCache('newtw'); echo subString(strip_tags($newtws[0]['content']),0,300); ?></div>
