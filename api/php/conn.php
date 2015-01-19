<?php
$con = mysql_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWD']);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cj", $con);

$result = mysql_query("SELECT * FROM site where `from` = '".$from."'");
$row = mysql_fetch_array($result);
	$siteData = array(
			'from'=>$row['from'],
			'appid'=>$row['appid'],
			'secret'=>$row['secret'],
			'status'=>$row['status'],
			'host'=>$row['host']
	);

