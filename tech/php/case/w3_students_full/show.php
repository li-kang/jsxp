<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			*{ margin: 0; padding: 0;}
			h1{ text-align: center; height: 60px; line-height: 60px; }
			p{ text-align: center;padding-bottom: 20px;}
			.main{width: 1000px; margin:50px auto; }
			table{ border: 1px solid #ccc; border-collapse:collapse; width: 100%;}
			td,th{border: 1px solid #ccc; padding: 10px;}
		</style>
	</head>
	<body>
		<h1>用户信息表</h1>
		
		<div class="main">
			<p><a href="index.html">添加用户</a></p>
			<table>
	    	<tr>
	    	    <th>姓名</th>
	    	    <th>性别</th>
	    	    <th>出生</th>
	    	    <th>电话</th>
	    	    <th>城市</th>
	    	    <th>爱好</th>
	    	    <th>操作</th>
	    	</tr>
	    	<?php
				include "mysql_connect.php";
				
				
				//读取"爱好表"
//				$hobby=mysqli_query($link, 'select * from hobby');
//				$arr=[];
//				if($hobby!=false && mysqli_num_rows($hobby)>0){
//					while($rows = mysqli_fetch_assoc($hobby)){
//						array_push($arr,$rows['name']);
//					}
//				}
				
				$h_table=mysql_fn('select * from hobby');
				
				//var_dump($h_table);

				
				//获取所有信息	
				$query="select a.id,a.name,a.sex,a.birthday,a.tel,b.name as city,a.hobby from students as a,city as b where a.livecity=b.id;";
				
				//提交,得到数据集
				$result=mysqli_query($link, $query);
				//var_dump($result);
				
				//$result资源正确，记录大于0
				if($result && mysqli_num_rows($result)>0){
					
					//解析结果
					while($rows=mysqli_fetch_assoc($result)){
						echo '<tr>';
						echo "<td>{$rows["name"]}</td>";
						echo "<td>".($rows["sex"]=="m"? "男":"女")."</td>";
						echo "<td>{$rows["birthday"]}</td>";
						echo "<td>{$rows["tel"]}</td>";
						echo "<td>{$rows["city"]}</td>";
						
						//hobby显示的文字
						$h_txt="";
						if($rows["hobby"]!=""){
							$h_arr=explode(',', $rows["hobby"]);
							foreach($h_arr as $v){
								//$h_table的索引是0开始， $h_arr爱好的值是1开始
								$h_txt.=$h_table[$v-1]['name'].' , ';
							}
							$h_txt=rtrim($h_txt,' ,');
						}
						
						echo "<td>{$h_txt}</td>";
						echo '<td><a href="doAction.php?a=del&id='.$rows["id"].'">删除</a> <a href="edit.php?id='.$rows["id"].'">编辑</a></td>';
						echo '</tr>';
					}
				}
				mysqli_free_result($result);
				mysqli_close($link);
			?>
	    </table>
		</div>
	    
	</body>
</html>
