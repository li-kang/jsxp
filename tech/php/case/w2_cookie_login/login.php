<?php 
	//判断用户是否登录
	if(isset($_COOKIE['name'])){
		echo "<script>alert('抱歉，您已登录，无需重复登录！');window.location.href='index.php'</script>";
		die;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
</head>
<body>
	<h2>请登录</h2>
	<form action="doLogin.php" method="post">
		账号：<input type="text" name="userName" value="" /><br/>
		密码：<input type="text" name="password" value="" /><br/>
		<input type="submit" value="登录" />
	</form>
</body>
</html>