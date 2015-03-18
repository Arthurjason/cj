<?php
	error_reporting(E_ALL^E_NOTICE);
    
    $userid		= $_POST['zjh'];
    $password	= $_POST['mm'];
    $type 		= $_POST['type'];
    switch ($type) {
    	case '001' :
    		$url_type = 'oldScore';
    		break;
    	case '002':
    		$url_type = 'failScore';
            break;
    	case '003' :
    		$url_type = 'score';
            break;
    	default:
    		$url_type = 'score';
    		break;
    }
	$url 		= 'http://cj.ldustu.com/test1/cj/api/php/'.$url_type.'.php?userid='.
					 $userid.'&password='.
					 $password.'&from=ldsn&appid='.
					 $_SERVER["CJ_APPID"].'&secret='.
					 $_SERVER["CJ_SECRET"].'&type='.$type;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
	curl_exec($ch);
	curl_close($ch);
