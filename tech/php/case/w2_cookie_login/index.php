<?php 
	//判断用户是否登录
	if(!isset($_COOKIE['name'])){
		echo "<script>alert('抱歉，您还未登陆，请前去登录！');window.location.href='login.php'</script>";
		die;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>火星时代后台管理程序</title>
</head>
<body>
	<h2>欢迎来到火星时代后台管理程序</h2>
	<h3>欢迎你：<?= $_COOKIE['name'] ?></h3>
	<h3><a href='./doLogout.php'>退出</a></h3>
</body>
</html>