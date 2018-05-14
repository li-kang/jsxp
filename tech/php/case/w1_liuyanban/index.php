<!DOCTYPE html>
<html>
	<head>
		<title>在线留言板系统</title>
		<meta charset="utf-8"/>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<h1>在线留言板系统</h1>
		<hr/>
		<div class="main">
			<form action="doAction.php?a=insert" method="post">
				<p><label>标题：<input type="text" name="title" placeholder="请输入标题" /></label></p>
				<p><label>作者：<input type="text" name="author" value="" /></label></p>
				<p><label>内容：<textarea name="contents" cols="30" rows="5"></textarea></label></p>
				<input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
				<p>　　　<button type="submit">提交</button> <button type="reset">重置</button> <button type="button" onclick="window.location.href='show.php'">查看列表</button></p>
			</form>
		</div>
	</body>
</html>