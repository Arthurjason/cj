<?php
$con = mysql_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWD']);
if (!$con){
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("cj", $con);

$sql = sprintf(
    "SELECT * FROM %s where `from` = '%s'",
    mysql_real_escape_string('site'),
    mysql_real_escape_string($from)
);

$result = mysql_query($sql);

$row = mysql_fetch_array($result);

$siteData = array(
	'from'     =>$row['from'],
	'appid'    =>$row['appid'],
	'secret'   =>$row['secret'],
	'status'   =>$row['status'],
	'host'     =>$row['host'],
  'func_num' =>$row['func_num']
);