<?php

require_once 'init.php';if($_COOKIE['verytalkTemp']){     $contTemp=count($temps);     ($_COOKIE['verytalkTemp'] < $contTemp-1 && $I=$_COOKIE['verytalkTemp'])?$I++:$I=1 ;}else{    $I=1 ;}//echo $I;($I>=1)&&setcookie('verytalkTemp', $I, time () + (3600*24*365), '/');header("Location:index.php"); exit();

