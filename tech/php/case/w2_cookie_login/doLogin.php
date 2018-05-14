<?php

	//获取账号和密码
	$name = $_POST['userName'];
	$pwd = $_POST['password'];
	
		
	//读取database里面的文件
	$txt=file_get_contents("database.txt");
	
	$userInfo=json_decode($txt,true);
	var_dump($userInfo,$name,$pwd);
	
	//判断成功 
	if($userInfo["name"]==$name && $userInfo["pwd"]==$pwd){
		//设置cookie
		setcookie('name',$userInfo["name"],time()+120);  //120秒以后过期
		setcookie('pwd',$userInfo["pwd"],time()+120);
		echo "<script>window.location.href='index.php'</script>";
	}else{
		echo "<script>alert('登录失败！用户名或密码错误，或用户存在！');window.location.href='login.php'</script>";
		die;
	}


