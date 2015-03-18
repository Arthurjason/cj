<?php
	error_reporting(E_ALL^E_NOTICE);
    
    $userid		= $_POST['zjh'];
    $password	= $_POST['mm'];
    $type 		= $_POST['type'];
	$url 		= 'http://cj.ldustu.com/test1/cj/api/php/'.$type.'.php?userid='.
					 $userid.'&password='.
					 $password.'&from=ldsn&appid='.
					 $_SERVER["CJ_APPID"].'&secret='.
					 $_SERVER["CJ_SECRET"];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
	curl_exec($ch);
	curl_close($ch);
