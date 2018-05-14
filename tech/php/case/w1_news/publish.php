<!DOCTYPE html>
<html>
	<head>
		<title>发布新闻</title>
		<meta charset="utf-8"/>
		<style>
			h2{ text-align:center}
			form{ width:500px; margin:50px auto}
			input{ height:30px; width:300px; padding:0 5px}
			textarea{height:200px; width:300px; vertical-align:top; padding:5px}
		</style>
	</head>
	<body>
		
		<h2>发布新闻</h2>
		<hr/>
		<form action="doAction.php" method="post">
		
			<input type="text" name="title"  placeholder="新闻标题" /><br><br>
			<input type="text" name="author" value="" placeholder="作者" /><br><br>
			<textarea name="contents" placeholder="新闻内容" ></textarea><br><br>
			
			<? date_default_timezone_set("PRC") ?>	
			
			<input type="hidden" name="time" value="<?= date('Y-m-d H:i:s',time()) ?>" />
			<input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
			<button  type="submit">提交</button>
			<button  type="reset">重置</button>
			<button type="button" onclick="window.location.href='list.php'">查看新闻列表</button>
		</form>
		
		
	</body>
</html>