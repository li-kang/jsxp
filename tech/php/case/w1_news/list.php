<!DOCTYPE html>
<html>
	<head>
		<title>新闻列表</title>
		<meta charset="utf-8"/>
		<style type="text/css">
			body{ font-size:14px}
			h2{ text-align:center}
			ul{list-style:none}
			.main{ width:500px; margin:0 auto; }
			.news_list{ border:1px solid #ddd; padding:20px}
			.news_list li{ margin-bottom:20px}
			.news_list li a{ display:inline-block;  margin-right:20px;width:300px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis; word-wrap: normal}
			.news_list li span{ font-size:12px; color:#CCC}
			.ellipsis{overflow:hidden;white-space:nowrap;text-overflow:ellipsis; word-wrap: normal}
			h3,h5{ text-align:center}
			.foot{ text-align:center; margin:50px 0}
		</style>
	</head>
	<body>
		<h2>新闻列表</h2>
		<hr>
		<div class="main">
			
			<ul class="news_list">
				<?php 
					$cont=file_get_contents('news.txt');
					
										
					//去掉结尾@@
					$cont=rtrim($cont,"@@");
					
					//按@@来拆分所有的信息
					$list=explode("@@", $cont);
					
					//var_dump($list);
					
					//颠倒顺序，让最新发表的新闻在最前面
					$list= array_reverse($list); 
					
					foreach($list as $k=>$v){
						//var_dump($k);
						$n_list=explode("##",$v);
																	
						echo '<li><a href="detail.php?index='.$k.'">'.$n_list[0].'</a><span>'.$n_list[3].'</span></li>';
					}
//				echo '<li><a href=detail.php?index='.$k.' title=".$n_list[0].">'.$n_list[0].'</a><span> '.$n_list[3].'</span></li>';
				
				?>
			</ul>
			
		</div>
		<div class="foot">
			<button type="button"  onclick="window.location.href='publish.php'">我要发布</button>
		</div>	
			
	</body>
</html>