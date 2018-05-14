<?php
	//连接数据库
	$link=mysqli_connect('localhost','root', '1234') or die('连接失败');
	//设定字符集
	mysqli_set_charset($link, 'utf8');
	//选择数据库
	mysqli_select_db($link, 'hxsd');
	
	
?>