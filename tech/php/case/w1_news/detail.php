<!DOCTYPE html>
<html>
	<head>
		<title>新闻详情</title>
		<meta charset="utf-8"/>
		<style type="text/css">
			h2{ text-align:center}
			.main{ width:500px; margin:0 auto; }
			.news_detail{ border:1px solid #ddd; padding:20px}
			h3,h5{ text-align:center}
			p{ line-height:30px}
			.foot{ text-align:center; margin:50px 0}
		</style>
	</head>
	<body>
		<h2>新闻详情</h2>
		<hr>
		<div class="main">
			
			<div class="news_detail">
			
				<?php
					$index=$_GET['index'];
					//var_dump($index);
					
					$txt=file_get_contents('news.txt');
					
					$txt=rtrim($txt,"@@");
					
					$list=explode("@@", $txt);
					
					//数组反转
					$list= array_reverse($list); 
					
					//var_dump($list);
					$n_list=explode("##", $list[$index]);
										
				?>	
				<h3>题目：<?= $n_list[0] ?></h3>	
				<h5>作者：<?= $n_list[1] ?></h5>
				<p>内容详情：<br><?= $n_list[2] ?></p>
				
			</div>
		</div>
		<div class="foot">
			<button type="button"  onclick="window.location.href='list.php'">返回列表页</button>
			<button type="button"  onclick="window.location.href='publish.php'">我要发布</button>
		</div>
			
	</body>
</html>
