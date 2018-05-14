<?php

				
	//获取用户提交的所有信息
	$data = $_POST;
	
	//判断是否提交了空数据
	
	//var_dump($data);
	
	if(!$data['title'] || !$data['author']|| !$data['contents']){
		echo "<script>alert('不能提交空信息！请检查！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
		die;
	}
	
	//判断是否在结果中包含了html或其他代码
	$data['title'] = htmlspecialchars($data['title']);
	$data['author'] = htmlspecialchars($data['author']);
	$data['contents'] = htmlspecialchars($data['contents']);
	
	//将用户提交的信息拼装成字符串
	$contents = implode('##',$data).'@@';
	var_dump($contents);
	
	//将新闻信息直接追加写入liuyan.txt中
	file_put_contents('news.txt',$contents,FILE_APPEND);
	
	//提示用户，添加成功，并且将当前页面跳转到新闻列表页面
	echo "<script>alert('恭喜，留言成功！');window.location.href='list.php'</script>";
			
		