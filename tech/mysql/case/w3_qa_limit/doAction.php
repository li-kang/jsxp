<?php
	
	include "mysql_connect.php";
	
	switch($_GET['a']){
		
		//顶
		case "ding":
			//获取id
			$id=$_GET['id'];
			$res=mysqli_query($link, "update qa_list set star=star+1 where id={$id}");
			
			// 修改成功
			if($res){
				echo $res;
			}
		break;
		
		//插入数据
		case "insert":
			$title=$_GET['cont'];
			$insert=mysqli_query($link, "insert into qa_list(title) values('{$title}')");
			
			//提交成功			
			if($insert){
				echo mysqli_insert_id($link);
			}
		break;
		
		
		//分页
		case "page":
			
			$start=($_GET['p']-1)*3;
							
			$res=mysqli_query($link, "select * from qa_list limit {$start},3");
						
			if($res!=false && mysqli_num_rows($res)>0){
				while($rows=mysqli_fetch_assoc($res)){
					$arr[]=$rows;
				}
				echo json_encode($arr);
			}
		break;
	}
	
	//释放资源
	mysqli_close($link);
	
	

?>