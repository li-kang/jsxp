<?php
	include "fun.php";
	
	switch($_GET['a']){
		
		//上传		
		case "upload":
			$path="./upload";
			
			//文件名
			$upfile=$_FILES["fname"];
			
			
			//文件类型
			$typeArr=array("image/jpeg","image/png","image/gif");
			//---------------------------------------	
			//调用上传函数
			$r_arr=upfile($path,$upfile,$typeArr);
			
			//判断是否成功
			if($r_arr["success"]){
								
				//拼字符串
				$str=$r_arr['up_name'].'##'.FileSizeConvert($upfile["size"]).'##'.$path.'/'.$r_arr['new_name'].'##'.$_SERVER["REMOTE_ADDR"];
				
				//存入文件		
				file_put_contents("data.txt", $str.'@@',FILE_APPEND);
				
				//提示跳转
				echo '<script>alert("上传成功！");window.location.href="show.php?nf='.$r_arr['new_name'].'&uf='.$r_arr['up_name'].'"</script>';
				
			}else{
				echo '<script>alert("'.$r_arr['info'].'");window.location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';
				
			}
			break;	
		
		//删除---------------------------------------------------------------
		case "del":
			//var_dump($_GET["index"]);
			
			//读取文件
			$cont=file_get_contents("data.txt");
			$cont=rtrim($cont,"@@");
			$list=explode("@@",$cont);
			
				
			//得到文件名
			$n_name=explode("##", $list[$_GET["index"]])[2];
						
						
			//删除文件
			unlink($n_name);
			
			//删除对应的图片
			unset($list[$_GET["index"]]);
					
			//重新拼字符串
			$str=implode("@@",$list);
			
			//写回文件		
			file_put_contents("data.txt",$str);
			
			//提示并跳转	
			echo '<script>alert("删除成功！"); window.location.href="'.$_SERVER['HTTP_REFERER'] .'"</script>';
			break;
		
	}
	
	
	
	
	
	
	
	
		

?>