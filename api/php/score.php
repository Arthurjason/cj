<?php
	error_reporting(E_ALL^E_NOTICE);
        $URI = dirname(__FILE__).'/';

        $from = $_REQUEST['from'];
        $host = $_SERVER["REMOTE_ADDR"];

        if(!$from){
                $content = array(
                        'error'=> 1,
                        'data'=> 'no from'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }

        include('./conn.php');

        if(!$siteData['from']){
                $content = array(
                        'error'=> 2,
                        'data'=> 'from error'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }else{
                $appid = $_REQUEST['appid'];
                $secret = $_REQUEST['secret'];
                if($appid != $siteData['appid']){
                        $content = array(
                                'error'=> 4,
                                'data'=> 'appid error'
                        );
                        $json = json_encode($content);
                        echo $json;
                        return;
                }else if($secret != $siteData['secret']){
                        $content = array(
                                'error'=> 5,
                                'data'=> 'secret error'
                        );
                        $json = json_encode($content);
                        echo $json;
                        return;
                }
                if($siteData['status'] != 1){
                        $content = array(
                                'error'=> 3,
                                'data'=> 'appid close'
                        );

                        $json = json_encode($content);
                        echo $json;
                        return;
                }
                
                if($siteData['host'] != $host){
                        $content = array(
                                'error'=> 6,
                                'data'=> 'host error'
                        );

                        $json = json_encode($content);
                        echo $json;
                        return;
                }

        }
	
	mysql_query("UPDATE site SET count=count+1 where `from` = '".$from."'");
	mysql_close($con);
        
        include($URI.'phpQuery/phpQuery.php');

        $zjh=$_REQUEST['userid'];
        $mm=$_REQUEST['password'];

        if(!$zjh || !$mm){
                $content = array(
                        'error'=> 2,
                        'data'=> 'empty userid or password'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }

        $url='http://202.194.48.11:9004/loginAction.do';
        $post="zjh=$zjh&mm=$mm";
        $cookie_file=tempnam('./tmp','cookie');
        $ch = curl_init($url) ;
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ;
        curl_setopt($ch, CURLOPT_POST,1) ;
        curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_exec($ch);
        curl_close($ch);


        $url='http://202.194.48.11:9004/bxqcjcxAction.do';
        $ch = curl_init() ;
        curl_setopt($ch, CURLOPT_URL,$url) ;
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
        $data=curl_exec($ch);

        $data = iconv('gbk', 'utf-8',$data);
        
	$nodata="/\/img\/icon\/alert.gif/";
	if (preg_match($nodata, $data)) {
        	$content = array(
                        'error'=> 7,
                        'data'=> 'password error or server error'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }
        phpQuery::newDocumentHTML($data);
        $i = 0;
        do {
                $i ++;
                $tr[$i] = pq('table:eq(6) tr:eq(' . $i . ')');
        }while($tr[$i] != '');


        if(count($tr) == 1){

                $content = array(
                        'error'=> 8,
                        'data'=> 'no have list'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }

        $i = 1;
        for ($i; $i < count($tr); $i ++){
                $item = array(
                        'kch'=>trim($tr[$i]->find('td:eq(0)')->text()),
                        'kxh'=>trim($tr[$i]->find('td:eq(1)')->text()),
                        'kcm'=>trim($tr[$i]->find('td:eq(2)')->text()),
                        'ywkcm'=>trim($tr[$i]->find('td:eq(3)')->text()),
                        'xf'=>trim($tr[$i]->find('td:eq(4)')->text()),
                        'kcsx'=>trim($tr[$i]->find('td:eq(5)')->text()),
                        'cj'=>trim($tr[$i]->find('td:eq(6)')->text()),
                );
                $score[$i-1] = $item;
        }

        $content = array(
                'error'=> 0,
                'score'=> $score
        );

        $json = json_encode($content);
        echo $json;
