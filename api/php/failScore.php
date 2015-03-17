<?php
		include('./phpQuery/phpQuery.php');

        error_reporting(E_ALL^E_NOTICE);
        $URI = dirname(__FILE__).'/';

        include('./check.php');
		mysql_query("UPDATE site SET count=count+1 where `from` = '".$from."'");
		mysql_close($con);

		$zjh=$_REQUEST['userid'];
        $mm=$_REQUEST['password'];

        header("Content-Type:text/html; charset= utf-8");
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
        $url='http://202.194.48.11:9004/gradeLnAllAction.do?type=ln&oper=bjg';
        $ch = curl_init() ;
        curl_setopt($ch, CURLOPT_URL,$url) ;
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
        $data=curl_exec($ch);
       
        $data = iconv("GBK","UTF-8",$data);
    	$data = preg_replace("/content\=\"text\/html\;\scharset\=GBK\"/", "", $data);

    	if($data == ''){
    			$content = array(
                        'error' => 7,
                        'data'  => 'password error or server error'
                );

                $json = json_encode($content);
                echo $json;
                return;
    	}

     	phpQuery::newDocumentHTML($data);
		$one = pq('.titleTop2:eq(0)');
		$i = 0;
		do{
			$i++;
			$tr[$i] = pq('.titleTop2:eq(0) tr:eq('.$i.')');
		}while($tr[$i] != '');
		$num = count($tr);


        if($num == 1){

                $content = array(
                        'error' => 8,
                        'data'  => 'no have list'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }

		for($x =2;$x <$num; $x++){
                $last = array(
	                'kch'   =>trim($tr[$x]->find('td:eq(0)')->text()),
	                'kxh'   =>trim($tr[$x]->find('td:eq(1)')->text()),
	                'kcm'   =>trim($tr[$x]->find('td:eq(2)')->text()),
	                'ywkcm' =>trim($tr[$x]->find('td:eq(3)')->text()),
	                'xf'    =>trim($tr[$x]->find('td:eq(4)')->text()),
	                'kcsx'  =>trim($tr[$x]->find('td:eq(5)')->text()),
	                'cj'    =>trim($tr[$x]->find('td:eq(6)')->text()),
                	);
                $score[$x-1] = $last;
                }

        $content = array(
        	'error'=>0,
        	'data' =>$score,
        	);        
        $json = json_encode($content);
        echo $json;