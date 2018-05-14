<?php
	
	//引入上传模块
	require "fun.php";
	
		
	switch($_GET["a"]){
		
		
		//上传文件	
		case "upload":
		$path="./images";
		$file=$_FILES["fname"];
		$typeArr=array("image/jpeg","image/png","image/gif","");
		$maxSize=3000000;
		
		$res=upfile($path,$file,$typeArr,$maxSize);
		
		if($res["success"]){
			echo "<script>alert('保存成功!'); location.href='cut_pic.html'</script>";	
		}else{
			
			echo "<script>alert('{$res["info"]}'); location.href='{$_SERVER["HTTP_REFERER"]}'</script>";
		}
		
		
		//var_dump($res);	
		break;
		
		
		
		//裁切图片
		case "cut":
			
			$arr=explode(',',$_POST["cutData"]);
			
			
			
			//die;
				
			$getfile="./images/temp_head_pic.png";
		
			//源图像
			//3.获取图片详细信息
			$info = getimagesize($getfile);
			
			var_dump($arr,$info);
		
			//4.根据图像的类型，生成相应的画布
			switch($info[2]){
				case 1:		//gif
					$oldImg = imagecreatefromgif($getfile);
					break;
		
				case 2:		//jpeg
					$oldImg = imagecreatefromjpeg($getfile);
					break;
		
				case 3:		//png
					$oldImg = imagecreatefrompng($getfile);
					break;
			}
			
			//获取图片信息
					
			
			if($_POST["cutData"]==""){
				$arr[0]=0;
				$arr[1]=0;
				$arr[4]=$info[0];
				$arr[5]=$info[1];
			};
			
			
			//创建目标图像
			$dis_img = imagecreatetruecolor($arr[4], $arr[4]);
		
			//拷贝源图像左上角起始
			imagecopy( $dis_img, $oldImg, 0, 0, $arr[0], $arr[1], $arr[4], $arr[5] );
								
			//输出230像素图
			$pic230 = imagecreatetruecolor(230, 230);
			imagecopyresized($pic230, $oldImg, 0, 0, $arr[0],$arr[1], 230, 230,$arr[4], $arr[4] );
			imagepng($pic230,"images/pic230.png");
			
			//输出80像素图
			$pic80 = imagecreatetruecolor(80, 80);
			imagecopyresized($pic80, $oldImg, 0, 0, $arr[0],$arr[1], 80, 80, $arr[4], $arr[4]);
			imagepng($pic80,"images/pic80.png");
			
			//输出50像素图
			$pic50 = imagecreatetruecolor(50, 50);
			imagecopyresized($pic50, $oldImg, 0, 0, $arr[0],$arr[1], 50, 50, $arr[4], $arr[4]);
			imagepng($pic50,"images/pic50.png");
			
			//释放
			imagedestroy($dis_img);
			imagedestroy($oldImg);
			
			imagedestroy($pic230);
			imagedestroy($pic80);
			imagedestroy($pic50);
			
			//echo "<script>alert('保存成功!'); location.href='{$_SERVER["HTTP_REFERER"]}'</script>";	
			break;	
	}
		
	
	
	
	
	
	
	
	
	
	

?>