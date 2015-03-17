<?php
	error_reporting(E_ALL^E_NOTICE);
    
    $userid		= $_POST['userid'];
    $password	= $_POST['password'];
    $type 		= $_POST['type'];
    switch ($type) {
    	case 'old' :
    		$url_type = 'oldScore';
    		break;
    	case 'fail':
    		$url_type = 'failScore';
    	case 'now' :
    		$url_type = 'score';
    	default:
    		$url_type = 'score';
    		break;
    }
	$url 		= 'http://cj.ldustu.com/api/'.$url_type.'?userid='.
					 $userid.'&password='.
					 $password.'&from=ldsn&appid='.
					 $_SERVER["CJ_APPID"].'&secret='.
					 $_SERVER["CJ_SECRET"];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
	curl_exec($ch);
	curl_close($ch);