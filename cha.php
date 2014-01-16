<?
$parse_url=parse_url($_SERVER[HTTP_REFERER]);
$url_from=$parse_url[host];
if($url_from!='www.ldustu.com'){
echo "<script>location.href='index.html'</script>";
return;
}

if(!$_POST){
$data="<b style='color: red;font-size: 22px;'>请输入账号密码进行查询。<a href='index.html'>点击返回上一页</a></b>";
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
    $data="<b style='color: red;font-size: 22px;'>密码输入错误或服务器繁忙，请稍后再试！<a href='index.html'>点击返回上一页</a></b>";
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
<title>本学期成绩单-鲁东大学校外成绩查询系统--鲁大学生网</title>
<meta name="keywords" content="鲁东大学校外查成绩,鲁东大学成绩,鲁大校外查成绩" />
<meta name="description" content="鲁东大学校外成绩查询系统,是鲁大学生网为更好的服务鲁大师生而开发的校外成绩查询系统,用户可使用非校内网络查询成绩。" />
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
          <h1>鲁大学生网</h1>
        </div>
        <div class="s">
		<form name="formsearch" action="/plus/search.php" >
          <div class="search">
            <input type="text" name="q" placeholder="输入要搜索的内容"  class="srch">
          </div>
          <div class="search_sub">
            <input type="submit" value="搜索"  class="srch_sub">
          </div>
		  </form>
        </div>
      </div>
    </div>
    <div class="nav">
		  <ul class="nav_list">
        <li class="index_link"><sup style="background-color:#40acff"></sup><a target="_blank" href="http://www.ldustu.com" class="鲁东大学学生网入口">首页</a></li>
        <li class="info_link"><sup style="background-color:#008cd7"></sup><a target="_blank" href="http://www.ldustu.com/a/news" title="鲁东大学资讯入口">资讯</a><!--<ul class="info_list"><li class="info_item"><a target="_blank" href="#">鲁大新闻</a></li><li class="info_item"><a target="_blank" href="#">活动新闻</a></li><li class="info_item"><a target="_blank" href="#">第一视角</a></li></ul>--></li>
        <li class="yung_link"><sup style="background-color:#aecd00"></sup><a target="_blank" href="http://www.ldustu.com/a/qingchun" title="鲁东大学青春频道入口">青春</a><!--<ul class="info_list"><li class="info_item"><a target="_blank" href="#">文苑清风</a></li><li class="info_item"><a target="_blank" href="#">人物专访</a></li><li class="info_item"><a target="_blank" href="#">缤纷生活</a></li></ul>--></li>
        <li class="union_link"><sup style="background-color:#ff8400"></sup><a target="_blank" href="http://www.ldustu.com/a/xuexi" title="鲁东大学学习入口">学习</a></li>
        <li class="fun_link"><sup style="background-color:#fe3f63"></sup><a target="_blank" href="http://www.ldustu.com/a/yule" title="鲁东大学娱乐入口">娱乐</a></li>
      </ul>
    </div>
  </div>
 <!-- <img src="./http://www.ldustu.com/templets/sailboat/images/youth.png" class="banner">-->
 </div>
<div class="content">
  <div class="article wc" >
    <div class="typename wt">当前位置： <a href='http://www.ldustu.com/'>主页</a> > <a href='http://www.ldustu.com/cj/'>校外成绩查询</a> > <a href='http://www.ldustu.com/cj/'>成绩查看</a>   </div>
    <div class="arc_content">
      <div class="arc_top">
        <div class="arc_title">
          <h2>本学期成绩单</h2>
        </div>
        <div class="arc_info">
          <p class="arc_from">来源：教务信息网&nbsp;&nbsp;&nbsp;&nbsp;<?echo date('Y-m-d H:i:s',time())?>&nbsp;&nbsp;&nbsp;&nbsp;作者：Admin | <!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
	<a target="_blank" href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" >我要分享</a>
	<a target="_blank" class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=undefined" charset="utf-8"></script>
<!-- JiaThis Button END --></p>
          <div class="icomment"><a href="#comment" onclick="">我要评论</a></div>
        </div>
      </div>
      <div class="arc_body"> 
 <? echo $data ?> 
 <p class="research"><a href="http://www.ldustu.com">进入学生网首页</a> | <a href="./index.html">再次查询</a></p>
	  </div>
    </div>
	<!--

    <div class="arc_comment">
      <div class="wt co_top">
        <div class="co_t"><i class="dot"></i>发表评论</div>
        <p class="co_sum"><span>120</span>条评论</p>
      </div>
      <div class="co_content">
        <div class="co_text">
          <textarea cols="98" placeholder="看完文章，记得评论哦~" maxlength="300"></textarea>
        </div>
        <div class="co_do">
          <div class="co_name">添加昵称：
            <input type="text" placeholder="输入昵称">
          </div>
        </div>
        <div class="co_sub">
          <input type="submit" value="发表评论">
        </div>
      </div>
      <div class="co_list">
        <div class="co_info"><img src="http://www.ldustu.com/templets/sailboat/images/co_img.jpg"  class="co_img">
          <div class="co_wrap">
            <p class="co_user">马导</p>
            <p class="co_speak">少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣少放辣</p>
            <p class="co_time">昨天&nbsp;&nbsp;&nbsp;20:20:20</p>
          </div>
        </div>
        <div class="co_info"> <img src="http://www.ldustu.com/templets/sailboat/images/co_img.jpg" class="co_img">
          <div class="co_wrap">
            <p class="co_user">马导</p>
            <p class="co_speak">辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了辣死了</p>
            <p class="co_time">昨天&nbsp;&nbsp;&nbsp;20:20:20</p>
          </div>
        </div>
      </div>
    </div>
-->	<a target="_blank" name="comment"></a>
	<!-- Duoshuo Comment BEGIN -->
  <div class="ds-thread" data-thread-key="3769" data-title="成绩单" ></div>
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
      <div class="rec_top wt"><i class="dot"></i>最新文章 </div>
    
        <ul class="rec_content">
		<script src='http://www.ldustu.com/plus/mytag_js.php?aid=9018' language='javascript'></script>

        </ul>
    </div>
	<div class="join br"><p class="doubi"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></p><p>鲁大学生网<br>一个<span>梦想</span>开始的地方<br>你是否想加入我们？<br><i>二次纳新</i>正式启动！<br><a href="http://sailboat.ldustu.com/about-us/">点这了解鲁大学生网</a></p>
	</div>
	<div class="follow br">
	<p class="also">当然你也可以</p>
	<img src="./images/erweima.jpg" class="erweima">
	<p class="gz">扫一扫，关注我们的微信</p>
	 <iframe src="http://open.qzone.qq.com/like?url=http%3A%2F%2Fuser.qzone.qq.com%2F1307183747&type=button_num&width=400&height=30&style=2" allowtransparency="true" scrolling="no" border="0" frameborder="0" style="width:100px;height:22px;border:none;overflow:hidden;float:left;margin: 7px 9px;"></iframe>
        <div style="width:115px;height:24px;float:left;margin: 6px 7px;">
          <html xmlns:wb=“http://open.weibo.com/wb”>
          <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
          <wb:follow-button uid="2291846285" type="red_2" width="115" height="24"></wb:follow-button>
        </div>
        <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://widget.renren.com/plugin/followbutton?page_id=601129214&color=0&model=0" style="width:77px;height:24px;float:left;margin: 3px 8px;" ></iframe>
        <iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=ludongstudent&style=3&t=1384433895804&f=0" frameborder="0" scrolling="auto" width="125" height="20" marginwidth="0" marginheight="0" allowtransparency="true" style="float: left;
margin: 4px 1px;width:94px;margin-left:35px;"></iframe>

	<p class="gz">点一下，关注我们的社交平台</p>
	</div>
   </div>
</div>
<div class="footer">
  <div class="flink">
    <h3>友情链接：</h3>
    <a target="_blank" href="http://www.ldu.edu.cn" >鲁东大学</a> <a target="_blank" href="http://sailboat.ldustu.com" >团队博客</a> <a target="_blank" href="http://121.ldustu.com" >学生之家</a> <a target="_blank" href="http://swzl.ldustu.com" >失物招领</a> <a target="_blank" href="http://stbk.ldustu.com" >社团百科</a> <a target="_blank" href="http://tieba.baidu.com/f?kw=%C2%B3%B6%AB%B4%F3%D1%A7" >百度鲁东大学吧</a> </div>
  <div class="copyright"> &copy; 2013 LDSN.鲁大学生网,All rights reserved.鲁ICP备13008791号 <div style="display:none"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5796710'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/stat.php%3Fid%3D5796710' type='text/javascript'%3E%3C/script%3E"));</script></div>
  </div>
</div>
</body>
<script src="http://www.ldustu.com/templets/sailboat/js/toactive.js" type="text/javascript"></script>
</html>

