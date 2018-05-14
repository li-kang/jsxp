<?php
	include "upfile.fn.php";
	include "mysql_connect.php";
	
	$path="./upload";
	
	switch($_GET['a']){
		
		//上传		
		case "upload":
			
			//文件名
			$upfile=$_FILES["fname"];
			
			//文件类型
			$typeArr=array("image/jpeg","image/png","image/gif");
			//---------------------------------------	
			//调用上传函数
			$r_arr=upfile($path,$upfile,$typeArr);
			
						
			//判断是否成功
			if($r_arr["success"]){
				
				$size=FileSizeConvert($upfile["size"]);			
				//拼字符串
				$query="insert into my_images values(null,'{$r_arr['up_name']}','{$size}','{$path}/{$r_arr['new_name']}','{$_SERVER["REMOTE_ADDR"]}')";
				//保存到数据库
				$res=mysqli_query($link, $query);
				
				if($res){
					//提示跳转
					echo '<script>alert("上传成功！");window.location.href="show.php"</script>';
				}
			}else{
					echo '<script>alert("'.$r_arr['info'].'");window.location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';
			}
			break;	
		
		//删除---------------------------------------------------------------
		case "del":
			$query="delete from my_images where id={$_GET["index"]}";
			$res=mysqli_query($link, $query);
			
			//删除图片  //删除数据
			if(unlink($_GET["image"]) && $res!=false && mysqli_affected_rows($link)>0){
				//提示并跳转	
				echo '<script>alert("删除成功！"); window.location.href="'.$_SERVER['HTTP_REFERER'] .'"</script>';
			}else{
				echo '<script>alert("删除失败！")</script>';
			}
			break;
		
	}
	
	
	
	
	
	
	
	
		

?>