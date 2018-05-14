<?php

	//执行修改动作
	
	//1.获取修改之后的数据
	$data = $_POST;

	//2.读取 config.php 的所有信息
	$contents = file_get_contents('config.php');

	//3.执行遍历替换
	foreach($data as $k=>$v){

		//使用 preg_replace(正则模式匹配要修改的内容，修改之后的内容，要对谁进行修改) 函数执行遍历替换
		$contents = preg_replace("/define\('{$k}','.*?'\);/", "define('{$k}','{$v}');", $contents);
		// var_dump($contents);
	}

	//4.将修改完毕之后的字符串信息覆盖写回 config.php 当中
	file_put_contents("config.php", $contents);

	//5.提示信息
	echo "<script>alert('恭喜，修改成功！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";