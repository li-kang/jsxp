<?php
	
	include "mysql_connect.php";
	
	
	switch($_GET['a']){
		
		//用户验证
		case 'validate':
			$name=$_GET['username'];
			echo mysql_fn("select name from students where name='{$name}'");
		break;
		
		//插入数据
		case 'insert':
			//接受post
			$username=$_POST["username"];
			$sex=$_POST["sex"];
			$year=$_POST["year"];
			$month=$_POST["month"];
			$day=$_POST["day"];
			$tel=$_POST['tel'];
			$city=$_POST['city'];
			$hobby=$_POST['hobby'];
			
			//checkbox为一个数组，需要转换成字符串
			$hobby=implode(',',$hobby);
			
			//定义sql语句并发送
			$query="insert into students values(null,'{$username}','{$sex}','{$year}-{$month}-{$day}','{$tel}','{$city}','{$hobby}')";
			
			if( mysql_fn($query) ){
				echo '<script>alert("添加成功"); window.location.href="show.php?a=select"</script>';	
			}else{
				echo '添加失败! 错误信息：'.mysqli_error($link);
			}
			break;
					
		case 'del':
			$query="delete from students where id={$_GET['id']}";
			
			if(mysql_fn($query)){
				echo '<script>alert("删除成功！！"); window.location.href="show.php"</script>';
			}else{
				echo '删除失败！错误：'.mysqli_error($link);
			}
			break;
		
		//保存修改	
		case 'edit':
			//接受post
			$username=$_POST["username"];
			$sex=$_POST["sex"];
			$year=$_POST["year"];
			$month=$_POST["month"];
			$day=$_POST["day"];
			$tel=$_POST['tel'];
			$city=$_POST['city'];
			$hobby=$_POST['hobby'];
			//var_dump($_POST);
			
			//checkbox为一个数组，需要转换成字符串
			$hobby=implode(',',$hobby);
			
			$query="update students set name='{$username}',sex='{$sex}',birthday='{$year}-{$month}-{$day}',tel='{$tel}',livecity='{$city}',hobby='{$hobby}' where id={$_GET['id']}";
						
			if( mysql_fn($query) ){
				echo '<script>alert("修改成功！！"); window.location.href="show.php"</script>';
			}else{
				echo '<script>alert("没有数据更新！！"); window.location.href="show.php"</script>';
			}
			break;
	}

?>