<?php
/*
Template Name:魅影
Description:Designed For Emlog
Version:1.1
Author:麦特佐罗
Author Url:http://hc123.site/zorro
Sidebar Amount:1
ForEmlog:5.3.0
*/
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href="<?php echo TEMPLATE_URL; ?>images/icon.png" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>style.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>font.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/common.js"></script>
<?php doAction('index_head'); ?>
</head>
<body>		
<div id="wrapper">
	<header id="header" role="banner">
		<div class="box">
			<div class="logo">
				<a title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><img alt="<?php echo $blogname; ?>" src="<?php echo TEMPLATE_URL; ?>images/logo.png"></a>
			</div>
			<h1><a title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
			<div class="text"><?php if(empty($bloginfo)){ echo "求知若饥，虚心若愚。";}else{ echo $bloginfo; }?></div>
			<div class="openmenu" onclick="mmenu()"><i class="icon-plus"></i></div>
		</div>
		<ul class="m-nav">
			<li><a title="归档" rel="nofollow" href="<?php echo BLOG_URL; ?>archivers">归档</a></li><li><li><a title="留言" rel="nofollow" href="<?php echo BLOG_URL; ?>guestbook">留言</a></li><li><a title="RSS" rel="nofollow" href="<?php echo BLOG_URL; ?>rss.php">RSS</a></li><li class="m-sch">
				<a id="hsch" title="搜索" href="#">搜索</a>
				<form id="hschform" class="form" name="keyform" action="<?php echo BLOG_URL; ?>index.php" method="get">
					<input class="txt" type="text" name="keyword"></input>
				</form>
			</li>
		</ul>
		<div class="clear"></div>
		<nav id="nav" role="navigation">
			<ul>
				<?php blog_navi();?>
			</ul>
			<div class="clear"></div>
		</nav>
	</header>
	<div id="container">