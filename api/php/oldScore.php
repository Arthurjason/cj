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


        $url='http://202.194.48.11:9004/gradeLnAllAction.do?type=ln&oper=qbinfo';
        $ch = curl_init() ;
        curl_setopt($ch, CURLOPT_URL,$url) ;
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
        $data=curl_exec($ch);
        $data = iconv("GB2312","UTF-8",$data);
        
        if($data == ''){
                $content = array(
                        'error' => 7,
                        'data'  => 'password error or server error'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }

        $data = '<html>'.$data.'</html>';
        phpQuery::newDocumentHTML($data);

        $re0 = pq(".displayTag");
        $re0 = '<html>'.$re0.'</html>';
        phpQuery::newDocumentHTML($re0);
         
         $i = 0;
         do{ 
                $i++;
                $j = $i-1;
                $table[$i] = pq("table:eq($j)");
                
         }while($table[$i] != '');
         
        if(count($table) == 1){

                $content = array(
                        'error' => 8,
                        'data'  => 'no have list'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }  
        
        for($x =1; $x<count($table);$x++){
                //echo $table[$x];
                  $k =  0;
                  $e = $x-1;
                 do{    
                        $k++;
                        $count = pq("table:eq($e) tr");
                 }while($count[$k] != '');

                $num = count($count);
                for($a =1;$a < $num; $a++){
                        $last = array(
                        'kch'   =>trim($table[$x]->find('tr:eq('.$a.') td:eq(0)')->text()),
                        'kxh'   =>trim($table[$x]->find('tr:eq('.$a.') td:eq(1)')->text()),
                        'kcm'   =>trim($table[$x]->find('tr:eq('.$a.') td:eq(2)')->text()),
                        'ywkcm' =>trim($table[$x]->find('tr:eq('.$a.') td:eq(3)')->text()),
                        'xf'    =>trim($table[$x]->find('tr:eq('.$a.') td:eq(4)')->text()),
                        'kcsx'  =>trim($table[$x]->find('tr:eq('.$a.') td:eq(5)')->text()),
                        'cj'    =>trim($table[$x]->find('tr:eq('.$a.') td:eq(6)')->text()),
                        );
                        $get[$a-1] = $last;
                }
                $data = '<html>'.$data.'</html>';
                phpQuery::newDocumentHTML($data);
                $title = pq("#tblHead:eq($e) b");
                $title = strip_tags((string)$title);
                $one[$x-1] = array(
                        'title'=>$title,
                        'score'=>$get,
                        );

        }

                   $content = array(
                        'error'=>0,
                        'data' =>$one,
                        );
                   $json = json_encode($content);
                   echo $json;