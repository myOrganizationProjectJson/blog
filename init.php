<?php
/**
 * 全局项加载
 * @copyright (c) Emlog All Rights Reserved
 */

error_reporting(7);
ob_start();
header('Content-Type: text/html; charset=UTF-8');

define('EMLOG_ROOT', dirname(__FILE__));

require_once EMLOG_ROOT.'/config.php';
require_once EMLOG_ROOT.'/include/lib/function.base.php';
/** * 判断是否是手机 */function is_mobile_temp (){    //正则表达式,批配不同手机浏览器UA关键词。    $regex_match="/(nokia|iphone|ipad|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";    $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";    $regex_match.=")/i";    return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT'])); //如果UA中存在上面的关键词则返回真。}if(is_mobile_temp()){    $temps=array('MeiYing','MeiYing','iitboy','GlBwl_v5929','GlBwl_v5929');}else{    $temps=array('MeiYing','MeiYing','iitboy','default','GlBwl_v5929');}function getTemp($temps){        if($_COOKIE['verytalkTemp']==''){        $T=(is_mobile_temp())?'iitboy':Option::get('nonce_templet');    }else{        $verytalkTemp=$_COOKIE['verytalkTemp'];        $T=$temps[$verytalkTemp];    }    return $T;}
doStripslashes();

$CACHE = Cache::getInstance();

$userData = array();

define('ISLOGIN',	LoginAuth::isLogin());

//用户组:admin管理员, writer联合撰写人, visitor访客
define('ROLE_ADMIN', 'admin');
define('ROLE_WRITER', 'writer');
define('ROLE_VISITOR', 'visitor');
//用户角色
define('ROLE', ISLOGIN === true ? $userData['role'] : ROLE_VISITOR);
//用户ID
define('UID', ISLOGIN === true ? $userData['uid'] : '');
//站点固定地址
//define('BLOG_URL', Option::get('blogurl'));
define('BLOG_URL','//'.$_SERVER['HTTP_HOST'].'/');
//模板库地址
define('TPLS_URL', BLOG_URL.'content/templates/');
//模板库路径
define('TPLS_PATH', EMLOG_ROOT.'/content/templates/');
//解决前台多域名ajax跨域
define('DYNAMIC_BLOGURL', getBlogUrl());$T=getTemp($temps);//前台模板URL
define('TEMPLATE_URL', 	TPLS_URL.$T.'/');
$active_plugins = Option::get('active_plugins');
$emHooks = array();
if ($active_plugins && is_array($active_plugins)) {
	foreach($active_plugins as $plugin) {
		if(true === checkPlugin($plugin)) {
			include_once(EMLOG_ROOT . '/content/plugins/' . $plugin);
		}
	}
}
