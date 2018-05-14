<?php
	//hobby数组
	$h_arr=["足球","篮球","游戏","读书"];
	
	//var_dump($_GET);
	$_GET["h_arr"]=$h_arr;
	
	echo json_encode($_GET);
?>