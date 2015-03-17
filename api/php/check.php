<?php
    $from = $_REQUEST['from'];
    $host = $_SERVER["REMOTE_ADDR"];

    if(!$from){
            $content = array(
                    'error'	=> 1,
                    'data'	=> 'no from'
            );

            $json = json_encode($content);
            echo $json;
            return;
    }

    include('./conn.php');

	if(!$siteData['from']){
            $content = array(
                    'error'	=> 2,
                    'data'	=> 'from error'
            );

            $json = json_encode($content);
            echo $json;
            return;
    }else{
            $appid 	= $_REQUEST['appid'];
            $secret = $_REQUEST['secret'];

            if($appid != $siteData['appid']){
                    $content = array(
                            'error'	=> 4,
                            'data'	=> 'appid error'
                    );
                    $json = json_encode($content);
                    echo $json;
                    return;

            }else if($secret != $siteData['secret']){
                    $content = array(
                            'error'	=> 5,
                            'data'	=> 'secret error'
                    );
                    $json = json_encode($content);
                    echo $json;
                    return;
            }

            if($siteData['status'] != 1){
                    $content = array(
                            'error'	=> 3,
                            'data'	=> 'appid close'
                    );
                    $json = json_encode($content);
                    echo $json;
                    return;
            }
            
            if($siteData['host'] != $host){
                    $content = array(
                            'error'	=> 6,
                            'data'	=> 'host error'
                    );

                    $json = json_encode($content);
                    echo $json;
                    return;
            }
            if($siteData['power'] != 1){
            		$content = array(
            				'error'	=> 9,
            				'data'	=> 'low power',
            			);
            		$json = json_encode($content);
            		echo $json;
            		return;
            }            

    }