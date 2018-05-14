<?php
	
	include 'mysql_connect.php';
	
	switch($_GET['a']){
		
		//修改
		case 'update':
			
			//请求
			$query="update stu_ajax set name='{$_GET['name']}', age='{$_GET['age']}',city='{$_GET['city']}' where id={$_GET['id']}";
			
			if(mysqli_query($link, $query)){
				echo true;
			}
		break;
			
			
		//删除	
		case 'del':
			$query="delete from stu_ajax where id={$_GET['id']}";
			
			$res=mysqli_query($link, $query);
			
			//var_dump($result);
			if($res){
				echo $res;
			}
		break;			
	}

	mysql_close($link);
