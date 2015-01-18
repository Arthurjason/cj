<?php

	include('phpQuery/phpQuery.php');

//	$data = file_get_contents('data.txt');
//	print_r($data);
	phpQuery::newDocumentHTML($data);
	
	echo pq('body');

