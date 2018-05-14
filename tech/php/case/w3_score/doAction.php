<?php
	include "mysql_connect.php";
	
	switch($_GET['a']){
		
		case 'show':
			$c=$_GET['s'];
			
			//得到学生		
			$result=mysqli_query($link, "select id,name from students");
			
			if($result && mysqli_num_rows($result)>0){
				
				while($row=mysqli_fetch_assoc($result)){
					
					$arr[]=$row;
				}
			}
			
			foreach($arr as $v){
			
				//获取成绩
				$query="select score from score where user_id='{$v['id']}' and course_id='{$c}'";
				$res=mysqli_query($link,$query);	
				
				//添加成绩
				$v['score']=mysqli_fetch_assoc($res)['score'];
				$j_arr[]=$v;
			}
			echo json_encode($j_arr);
		break;
		
		
		case 'update':
			$id=$_GET['id'];
			$c=$_GET['c'];
			$s=$_GET['s'];
			$query="update score set score='{$s}' where user_id='{$id}' and course_id={$c}";
			$res=mysqli_query($link,$query);
			
			if($res && mysqli_affected_rows($link)>0){
				echo true;
			}else{
				//如果没有添加成功 则是插入数据
				$query="insert into score values(null,'{$id}','{$c}','{$s}')";
				var_dump($query);
				
				$res=mysqli_query($link,$query);
				
				if($res){
					echo true;
				}
			}
			
		break;
		
	}
	
	
	
	
?>