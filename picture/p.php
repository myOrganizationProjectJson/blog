<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>picture</title>
<style>
html,body{overflow-x: hidden;    background-color: #9a9da2 !important;}
.pic img{height:100%;width:100%; }
.picr{height:200px;width:99%;margin:5px 0px;}
#content{width:101%;background: #292C33;}
.pic{margin:0 3px;}
</style>
</head>
<body>
<div id='content'>
<div class='pic'>
<?php for($i=0;$i<10;$i++){ ?>
<div class='picr'>
<img src='../content/templates/GlBwl_v5929/images/rand/<?php echo rand(0,247);?>.jpg' />
</div>
<?php } ?>
</div>
</div>
</body>
</html>


