<?php
	
	//var_dump($_GET);
	
	//hobby数组
	$h_arr=["足球","篮球","游戏","读书"];
		
	//整理数据
	
	$hobby_str="";
	foreach($_GET["hobby"] as $v){
		$hobby_str.=$h_arr[$v]." ";
	}
	
	$user_arr=[
		"name"=>$_GET["username"],
		"sex"=>$_GET["sex"]=="m" ? "男":"女",
		"age"=>$_GET["year"]."年".$_GET["month"]."月".$_GET["day"]."日",
		"hobby"=>$hobby_str
	];
	//var_dump($user_arr);
	
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style>
			*{margin:0; padding: 0;}
			table{ border: 1px solid #ccc; border-collapse: collapse;}
			th,td{ border: 1px solid #ccc; padding:5px 10px;}
		</style>
	</head>
	<body>
		
		<h1>用户信息表</h1>
		<?php
			echo "<table>";
				
			echo "<tr><th>姓名</th><th>性别</th><th>出生</th><th>爱好</th></tr>";	
				
			echo "<tr><td>{$user_arr["name"]}</td><td>{$user_arr["sex"]}</td><td>{$user_arr["age"]}</td><td>{$user_arr["hobby"]}</td></tr>"	;
				
				
			echo "</table>";
		
		
		
		?>
		
		
		
		
	</body>
</html>