<?php
/**
 * 前端页面加载
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';
  $T=getTemp($temps);define('TEMPLATE_PATH', TPLS_PATH.$T.'/');//前台模板路径
$emDispatcher = Dispatcher::getInstance();
$emDispatcher->dispatch();
View::output();
