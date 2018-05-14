<!DOCTYPE html>
<html>
	<head>
		<title>在线留言板系统</title>
		<meta charset="utf-8"/>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<h1>编辑内容</h1>
		<hr/>
		<?php 
			//获取修改人的下标
			$k = $_GET['k'];
			
			//从liuyan.txt当中获取所有留言信息
			$contents = file_get_contents('liuyan.txt');
			
			//去除读取出来的字符串最右侧的两个@@
			$contents = rtrim($contents,'@@');
			
			//按@@来拆分所有的留言信息
			$list = explode('@@',$contents);
			
			//获取要修改人的信息
			$info = explode('##',$list[$k]);
			
		?>
		<div class="main">
			<form action="doAction.php?a=update&k=<?= $k ?>" method="post">
				<p><label>标题：<input type="text" name="title" value="<?=$info[0]?>" /></label></p>
				<p><label>作者：<input type="text" name="author" value="<?=$info[1]?>" /></label></p>
				<p><label>内容：<textarea name="contents" cols="30" rows="5"><?=$info[2]?></textarea></label></p>
				<input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
				<p>　　　<button type="submit">提交</button> <button type="reset">重置</button> <button type="button" onclick="window.location.href='show.php'">返回列表</button></p>
			</form>
		</div>
	</body>
</html>