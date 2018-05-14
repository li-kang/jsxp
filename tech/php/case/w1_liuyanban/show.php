<!DOCTYPE html>
<html>
	<head>
		<title>在线留言板系统</title>
		<meta charset="utf-8"/>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<h1>留言列表</h1>
		<hr/>
		<div class="main">
			<table>
				<tr>
					<th>ID</th>
					<th>标题</th>
					<th>作者</th>
					<th>内容</th>
					<th>留言者IP</th>
					<th>操作</th>
				</tr>
				<?php 
					//从liuyan.txt当中获取所有留言信息
					$contents = file_get_contents('liuyan.txt');
					
					//去除读取出来的字符串最右侧的两个@@
					$contents = rtrim($contents,'@@');
					
					//按@@来拆分所有的留言信息
					$list = explode('@@',$contents);
					
					//判断是否有留言数据
					if($list[0]!=''){
					
						//遍历再按##拆分
						foreach($list as $k=>$v){
							//拆分
							$info = explode('##',$v);
				
							echo '<tr align="center">';
							echo "<td>{$k}</td>";
							echo "<td>{$info[0]}</td>";
							echo "<td>{$info[1]}</td>";
							echo "<td>{$info[2]}</td>";
							echo "<td>{$info[3]}</td>";
							echo '<td> <a class="del" href="./doAction.php?a=delete&k='.$k.'">删除</a> <a href="./edit.php?k='.$k.'">修改</a></td>';
							echo "</tr>";
					}
					}else{
						echo "<tr align='center'>";
							echo "<td colspan='7'>抱歉，没有查询到任何信息！</td>";
						echo "</tr>";
					}
				?>
			</table>
			<br>
			<p style="text-align: center;"><a href='index.php'>我要留言</a></p>
		</div>
		
		<script>
			var delBtns=document.getElementsByClassName("del");
			for(var i=0; i<delBtns.length; i++){
				delBtns[i].onclick=function(ev){
					if(!confirm("确定要删除吗？？")){
						ev.preventDefault();
					}
				}
			}
			
		</script>
		
				
	</body>
</html>