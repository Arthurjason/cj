<?php

	include('./phpQuery/phpQuery.php');

        error_reporting(E_ALL^E_NOTICE);
        $URI = dirname(__FILE__).'/';
	$type = 001;
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
         //echo $re0;
         $i = 0;
         do{ 
               
                $table[$i] = pq("table:eq($i)");
                $i++;
         }while($table[$i-1] != '');
         //echo count($table);
        if(count($table) == 1){

                $content = array(
                        'error' => 8,
                        'data'  => 'no have list'
                );

                $json = json_encode($content);
                echo $json;
                return;
        }  
        //echo count($table);
        for($x =1; $x<count($table);$x++){
		$get = null;
            $re0 = '<html>'.$re0.'</html>';
            phpQuery::newDocumentHTML($re0);
                  $e =0;
                 do{    
                        
                        $count[$e] = pq("table:eq($e) tr");
                        $e++;
                 }while($count[$e-1] != '');
                //echo $count[$x-1];
                $num = count($count[$x-1]);
                for($a =1;$a < $num; $a++){
                        $last = array(
                        'kch'   =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(0)')->text()),
                        'kxh'   =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(1)')->text()),
                        'kcm'   =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(2)')->text()),
                        'ywkcm' =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(3)')->text()),
                        'xf'    =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(4)')->text()),
                        'kcsx'  =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(5)')->text()),
                        'cj'    =>trim($table[$x-1]->find('tr:eq('.$a.') td:eq(6)')->text()),
                        );
                        $get[$a-1] = $last;
        	  
	      }
                $data = '<html>'.$data.'</html>';
                phpQuery::newDocumentHTML($data);
		$c = $x-1;
                $title = pq("#tblHead:eq($c) b");
                $title = strip_tags((string)$title);
                $one[$x-1] = array(
                        'title'=>$title,
                        'score'=>$get,
                        );

        }
	$n1 = count($one)-1;
	for($aa = 0;$aa<$n1;$aa++){

		for($bb = 0;$bb<$n1;$bb++){
			if($aa == $bb){
			$b++;
			
			}else{

				if($one[$aa][title] == $one[$bb][title]){
					if($one[$aa]==null){
						array_splice($one,$aa,1);
					}		
					$one[$aa][score] = array_merge($one[$aa][score], $one[$bb][score]);
					array_splice($one, $bb, 1 );					
							
			}	
			}
		}
	}	
                   $content = array(
                        'error'=>0,
                        'data' =>$one,
                        );
                   $json = json_encode($content);
                   echo $json;
