<?
$parse_url=parse_url($_SERVER[HTTP_REFERER]);
$url_from=$parse_url[host];
if($url_from!='www.ldustu.com'){
echo "<script>location.href='index.html'</script>";
return;
}

if(!$_POST){
$data="<b style='color: red;font-size: 22px;'>�������˺�������в�ѯ��<a href='index.html'>���������һҳ</a></b>";
}
$zjh=$_POST['zjh'];
$mm=$_POST['mm'];
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
$nodata="/\/img\/icon\/alert.gif/";
if (preg_match($nodata, $data)) {
    $data="<b style='color: red;font-size: 22px;'>�������������������æ�����Ժ����ԣ�<a href='index.html'>���������һҳ</a></b>";
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

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��ѧ�ڳɼ���-³����ѧУ��ɼ���ѯϵͳ--³��ѧ����</title>
<meta name="keywords" content="³����ѧУ���ɼ�,³����ѧ�ɼ�,³��У���ɼ�" />
<meta name="description" content="³����ѧУ��ɼ���ѯϵͳ,��³��ѧ����Ϊ���õķ���³��ʦ����������У��ɼ���ѯϵͳ,�û���ʹ�÷�У�������ѯ�ɼ���" />
<!--[if IE]> <link href="http://www.ldustu.com/templets/sailboat/css/style.css" rel="stylesheet" type="text/css"> <![endif]-->
<link rel="stylesheet" type="text/css" media="only screen and (min-width:761px),only screen and (min-device-width:761px)" href="http://www.ldustu.com/templets/sailboat/css/style.css"/>
<link rel="stylesheet" type="text/css" media="only screen and (max-width:760px),only screen and (max-device-width:760px)" href="http://www.ldustu.com/templets/sailboat/css/max760.css"/>
<link rel="stylesheet" type="text/css" href="./css/css.css">
<script src="http://www.ldustu.com/templets/sailboat/js/jquery.js" type="text/javascript"></script>
</head>

<body class="cha">
<div class="pic">
</div>
<div class="header">
  <div class="top">
    <div class="title"> <img src="http://www.ldustu.com/templets/sailboat/images/wz_03.png" class="cha_logo">
      <div class="t_s">
        <div class="t">
          <h1>³��ѧ����</h1>
        </div>
        <div class="s">
		<form name="formsearch" action="/plus/search.php" >
          <div class="search">
            <input type="text" name="q" placeholder="����Ҫ����������"  class="srch">
          </div>
          <div class="search_sub">
            <input type="submit" value="����"  class="srch_sub">
          </div>
		  </form>
        </div>
      </div>
    </div>
    <div class="nav">
		  <ul class="nav_list">
        <li class="index_link"><sup style="background-color:#40acff"></sup><a target="_blank" href="http://www.ldustu.com" class="³����ѧѧ�������">��ҳ</a></li>
        <li class="info_link"><sup style="background-color:#008cd7"></sup><a target="_blank" href="http://www.ldustu.com/a/news" title="³����ѧ��Ѷ���">��Ѷ</a><!--<ul class="info_list"><li class="info_item"><a target="_blank" href="#">³������</a></li><li class="info_item"><a target="_blank" href="#">�����</a></li><li class="info_item"><a target="_blank" href="#">��һ�ӽ�</a></li></ul>--></li>
        <li class="yung_link"><sup style="background-color:#aecd00"></sup><a target="_blank" href="http://www.ldustu.com/a/qingchun" title="³����ѧ�ഺƵ�����">�ഺ</a><!--<ul class="info_list"><li class="info_item"><a target="_blank" href="#">��Է���</a></li><li class="info_item"><a target="_blank" href="#">����ר��</a></li><li class="info_item"><a target="_blank" href="#">�ͷ�����</a></li></ul>--></li>
        <li class="union_link"><sup style="background-color:#ff8400"></sup><a target="_blank" href="http://www.ldustu.com/a/xuexi" title="³����ѧѧϰ���">ѧϰ</a></li>
        <li class="fun_link"><sup style="background-color:#fe3f63"></sup><a target="_blank" href="http://www.ldustu.com/a/yule" title="³����ѧ�������">����</a></li>
      </ul>
    </div>
  </div>
 <!-- <img src="./http://www.ldustu.com/templets/sailboat/images/youth.png" class="banner">-->
 </div>
<div class="content">
  <div class="article wc" >
    <div class="typename wt">��ǰλ�ã� <a href='http://www.ldustu.com/'>��ҳ</a> > <a href='http://www.ldustu.com/cj/'>У��ɼ���ѯ</a> > <a href='http://www.ldustu.com/cj/'>�ɼ��鿴</a>   </div>
    <div class="arc_content">
      <div class="arc_top">
        <div class="arc_title">
          <h2>��ѧ�ڳɼ���</h2>
        </div>
        <div class="arc_info">
          <p class="arc_from">��Դ��������Ϣ��&nbsp;&nbsp;&nbsp;&nbsp;<?echo date('Y-m-d H:i:s',time())?>&nbsp;&nbsp;&nbsp;&nbsp;���ߣ�Admin | <!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
	<a target="_blank" href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" >��Ҫ����</a>
	<a target="_blank" class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=undefined" charset="utf-8"></script>
<!-- JiaThis Button END --></p>
          <div class="icomment"><a href="#comment" onclick="">��Ҫ����</a></div>
        </div>
      </div>
      <div class="arc_body"> 
 <? echo $data ?> 
 <p class="research"><a href="http://www.ldustu.com">����ѧ������ҳ</a> | <a href="./index.html">�ٴβ�ѯ</a></p>
	  </div>
    </div>
	<!--

    <div class="arc_comment">
      <div class="wt co_top">
        <div class="co_t"><i class="dot"></i>��������</div>
        <p class="co_sum"><span>120</span>������</p>
      </div>
      <div class="co_content">
        <div class="co_text">
          <textarea cols="98" placeholder="�������£��ǵ�����Ŷ~" maxlength="300"></textarea>
        </div>
        <div class="co_do">
          <div class="co_name">����ǳƣ�
            <input type="text" placeholder="�����ǳ�">
          </div>
        </div>
        <div class="co_sub">
          <input type="submit" value="��������">
        </div>
      </div>
      <div class="co_list">
        <div class="co_info"><img src="http://www.ldustu.com/templets/sailboat/images/co_img.jpg"  class="co_img">
          <div class="co_wrap">
            <p class="co_user">��</p>
            <p class="co_speak">�ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ����ٷ���</p>
            <p class="co_time">����&nbsp;&nbsp;&nbsp;20:20:20</p>
          </div>
        </div>
        <div class="co_info"> <img src="http://www.ldustu.com/templets/sailboat/images/co_img.jpg" class="co_img">
          <div class="co_wrap">
            <p class="co_user">��</p>
            <p class="co_speak">������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������</p>
            <p class="co_time">����&nbsp;&nbsp;&nbsp;20:20:20</p>
          </div>
        </div>
      </div>
    </div>
-->	<a target="_blank" name="comment"></a>
	<!-- Duoshuo Comment BEGIN -->
  <div class="ds-thread" data-thread-key="3769" data-title="�ɼ���" ></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"ldu"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = 'http://static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		|| document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- Duoshuo Comment END -->
  </div>
 <div class="aside" style="">

    <div class="recommend wc br">
      <div class="rec_top wt"><i class="dot"></i>�������� </div>
    
        <ul class="rec_content">
		<script src='http://www.ldustu.com/plus/mytag_js.php?aid=9018' language='javascript'></script>

        </ul>
    </div>
	<div class="join br"><p class="doubi"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></p><p>³��ѧ����<br>һ��<span>����</span>��ʼ�ĵط�<br>���Ƿ���������ǣ�<br><i>��������</i>��ʽ������<br><a href="http://sailboat.ldustu.com/about-us/">�����˽�³��ѧ����</a></p>
	</div>
	<div class="follow br">
	<p class="also">��Ȼ��Ҳ����</p>
	<img src="./images/erweima.jpg" class="erweima">
	<p class="gz">ɨһɨ����ע���ǵ�΢��</p>
	 <iframe src="http://open.qzone.qq.com/like?url=http%3A%2F%2Fuser.qzone.qq.com%2F1307183747&type=button_num&width=400&height=30&style=2" allowtransparency="true" scrolling="no" border="0" frameborder="0" style="width:100px;height:22px;border:none;overflow:hidden;float:left;margin: 7px 9px;"></iframe>
        <div style="width:115px;height:24px;float:left;margin: 6px 7px;">
          <html xmlns:wb=��http://open.weibo.com/wb��>
          <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
          <wb:follow-button uid="2291846285" type="red_2" width="115" height="24"></wb:follow-button>
        </div>
        <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://widget.renren.com/plugin/followbutton?page_id=601129214&color=0&model=0" style="width:77px;height:24px;float:left;margin: 3px 8px;" ></iframe>
        <iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=ludongstudent&style=3&t=1384433895804&f=0" frameborder="0" scrolling="auto" width="125" height="20" marginwidth="0" marginheight="0" allowtransparency="true" style="float: left;
margin: 4px 1px;width:94px;margin-left:35px;"></iframe>

	<p class="gz">��һ�£���ע���ǵ��罻ƽ̨</p>
	</div>
   </div>
</div>
<div class="footer">
  <div class="flink">
    <h3>�������ӣ�</h3>
    <a target="_blank" href="http://www.ldu.edu.cn" >³����ѧ</a> <a target="_blank" href="http://sailboat.ldustu.com" >�ŶӲ���</a> <a target="_blank" href="http://121.ldustu.com" >ѧ��֮��</a> <a target="_blank" href="http://swzl.ldustu.com" >ʧ������</a> <a target="_blank" href="http://stbk.ldustu.com" >���Űٿ�</a> <a target="_blank" href="http://tieba.baidu.com/f?kw=%C2%B3%B6%AB%B4%F3%D1%A7" >�ٶ�³����ѧ��</a> </div>
  <div class="copyright"> &copy; 2013 LDSN.³��ѧ����,All rights reserved.³ICP��13008791�� <div style="display:none"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5796710'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/stat.php%3Fid%3D5796710' type='text/javascript'%3E%3C/script%3E"));</script></div>
  </div>
</div>
</body>
<script src="http://www.ldustu.com/templets/sailboat/js/toactive.js" type="text/javascript"></script>
</html>

