<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>动态修改配置文件</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<h1>动态修改配置文件</h1>
	<div class="main">
		<form action="doAction.php" method="post">
			<?php 
				//1.获取 config.php 中所有的配置信息
				$contents = file_get_contents('config.php');

				//2.使用正则匹配配置信息的名称和值
				preg_match_all("/define\('(.*?)','(.*?)'\);/",$contents,$res);

				//3.提取配置名
				$config_name = $res[1];

				//4.提取配置值
				$config_values = $res[2];

				//5.开始遍历
				foreach($res[0] as $k=>$v){
			?>
				<p><label><?= $config_name[$k] ?></label> <input type="text" name="<?= $config_name[$k] ?>" value="<?= $config_values[$k] ?>" /></p>
			<?php 
				}
			?>
				<p><label></label> <button>修改</button>
	</form>
	</div>
	
</body>
</html>