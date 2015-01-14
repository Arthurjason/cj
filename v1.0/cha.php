<?
error_reporting(E_ALL^E_NOTICE);
$parse_url=parse_url($_SERVER[HTTP_REFERER]);
$url_from=$parse_url[host];
if($url_from!='www.ldustu.com'){
echo "<script>location.href='index.php'</script>";
return;
}
if(!$_POST){
$data="mima";
}
$zjh=$_POST['zjh'];
$mm=$_POST['mm'];
$url='http://202.194.48.11:9004/loginAction.do';
$post="zjh=$zjh&mm=$mm";

$cookie_file=$_GET['ck'];
$type=$_GET['type'];

if($cookie_file==''){
$cookie_file=tempnam('./tmp','cookie');
$ch = curl_init($url) ;
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ;
curl_setopt($ch, CURLOPT_POST,1) ; 
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post); 
curl_exec($ch);
curl_close($ch);
}

if($type=='all'){
		$url='http://202.194.48.11:9004/gradeLnAllAction.do?type=ln&oper=qbinfo';
		$ch = curl_init() ;  
		curl_setopt($ch, CURLOPT_URL,$url) ; 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
		$data=curl_exec($ch);
		$nodata="/\/img\/icon\/alert.gif/";
		if (preg_match($nodata, $data)) {
			$data="mima";
		}
		
		curl_close($ch); 
}else if($type=='gk'){
		$url='http://202.194.48.11:9004/gradeLnAllAction.do?type=ln&oper=bjg';
		$ch = curl_init() ;  
		curl_setopt($ch, CURLOPT_URL,$url) ; 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
		$data=curl_exec($ch);
		$nodata="/\/img\/icon\/alert.gif/";
		if (preg_match($nodata, $data)) {
			$data="mima";
		}
		$patterns="/width\=\"350\"/";
		$replacements='width="350" style="display:none;"';
		$date=$data=preg_replace($patterns, $replacements, $data);
		$patterns="/id\=\"tblHead\"/";
		$replacements='id="tblHead" style="display:none;"';
		$date=$data=preg_replace($patterns, $replacements, $data);
		
		curl_close($ch);
		
		}else{
		$url='http://202.194.48.11:9004/bxqcjcxAction.do';
		$ch = curl_init() ;  
		curl_setopt($ch, CURLOPT_URL,$url) ; 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
		$data=curl_exec($ch);
		$nodata="/\/img\/icon\/alert.gif/";
		if (preg_match($nodata, $data)) {
			$data="mima";
		}
		$patterns="/\t/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/\n/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/\<div\salign\=\"right\"\>/";
		$replacements="<div style='display:none;'>";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/\&nbsp\;\<b\>/";
		$replacements="<b style='display:none;'>";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/onMouseOut\=\"this.className\=\'even\'\;\"\sonMouseOver\=\"this\.className\=\'evenfocus\'\;\"/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/class\=\"\w*\"/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/id\=\"\w*\"/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data);
		$patterns="/\<table\swidth\=\"100\%\"\sborder\=\"0\"\scellpadding\=\"0\"\scellspacing\=\"0\"\s>/";
		$replacements="";
		$data=preg_replace($patterns, $replacements, $data,1);
		curl_close($ch); 
}


include('tpl.html');
?>