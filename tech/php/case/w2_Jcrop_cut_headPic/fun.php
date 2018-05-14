<?php
	/*
	 * $path	string	路径
	 * $file	string	文件名
	 * $typeArr	array	文件类型
	 * $maxSize	integer	文件大小
	 * return	array	$res	返回一个数组：info：错误信息 name：文件名  success：成功布尔值 
	 */	

	function upfile($path,$file,$typeArr=array(),$maxSize=0){
		
		//格式路径
		$path=rtrim($path,'/')."/";
				
		//返回值
		$res=array(
			"info"=>"",  //上传成功信息
			"up_name"=>"",
			"new_name"=>"",
			"success"=>false //成功与否
		);
		
		//错误判断-------------------------------------------	
		
		if($file["error"]!=0){
			switch($file["error"]){
				case 1:
					$err_info="上传的文件超出";
					break;
				case 2:
					$err_info="上传文件大小超出隐藏域指定大小";
					break;
				case 3:
					$err_info="文件只有部分上传";
					break;
				case 4:
					$err_info="没有上传任何文件";
					break;
				case 6:
					$err_info="找不到临时目录";
					break;
				case 7:
				$err_info="文件上传失败";
					break;
			}
			//函数返回值			
			$res["info"]="文件上传失败！原因：".$err_info;
		}
		
		//验证上传文件类型-------------------------------------------------------
		//获取后缀名
		$ext=pathinfo($file["name"],PATHINFO_EXTENSION);//后缀名
		
		if($typeArr && count($typeArr)!=0){
			if(!in_array($file["type"], $typeArr)){
				$res["info"]="文件上传失败！原因：也许不是真正 {$ext} 格式文件";
				return $res;
			}
		}else{
			$res["info"]="文件上传失败！原因：未指定允许上传文件列表";
			return $res;
		}
		
		//判断文件大小-------------------------------------------------
		if($maxSize>0 && $file["size"]>$maxSize){
			$res["info"]="文件上传失败！原因：上传文件超出指定大小";
			return $res;
		}
				
		//固定文件名-----------------------------------------------------
		$n_name="head_pic".".".$ext;
		
		//判断文件是否存在	
		if(file_exists($n_name)){
			unlink($path.$n_name);
		}
		
		//保存图片	
		if(is_uploaded_file($file["tmp_name"])){
			if(move_uploaded_file($file["tmp_name"], $path.$n_name)){
				
				//原图缩小到600px
				zoom("./images",$n_name,600,600);
				
				$res["info"]="文件上传成功！";
				$res["up_name"]=$file["name"];
				$res["new_name"]="$n_name";
				$res["success"]=true;
				return $res;
			}
		}else{
			$res["info"]="文件上传失败！原因：该文件不是post方式提交的，请检测";
			return $res;
		}
	}
//-------------------------------------------------------------------------------------

	//按比例缩放图片
	function zoom($path,$picname,$maxw,$maxh){
		//2.将路径格式化
		$path = rtrim($path,'/').'/';
	
		//3.获取图片详细信息
		$info = getimagesize($path.$picname);
	
		//4.根据图像的类型，生成相应的画布
//		switch($info[2]){
//			case 1:		//gif
//				$oldImg = imagecreatefromgif($path.$picname);
//				break;
//			case 2:		//jpeg
//				$oldImg = imagecreatefromjpeg($path.$picname);
//				break;
//			case 3:		//png
//				$oldImg = imagecreatefrompng($path.$picname);
//				break;
//		}
		
		//使用字符串方式生成画布,不用判断类型
		$oldImg=imagecreatefromstring(file_get_contents($path.$picname));

	
		//5.获取要进行缩放的图像的宽高
		$oldw = imagesx($oldImg);
		$oldh = imagesy($oldImg);
	
		//6.判断比较长的边
		if($oldw > $oldh){
	
			//拿宽度进行比例计算
			$b = $oldw / $maxw;	//求得比例
			//求得缩放后图像的宽高
			$neww = $oldw / $b;
			$newh = $oldh / $b;
		}else{
			//拿高度进行比例计算
			$b = $oldh / $maxh;
			//求得缩放后的图像的宽高
			$neww = $oldw / $b;
			$newh = $oldh / $b;
		}
	
		//6.创建存放缩小之后图像的画布
		$newImg = imagecreatetruecolor($neww, $newh);
	
		//7.执行缩放
		imagecopyresized($newImg, $oldImg, 0,0,0,0, $neww,$newh,$oldw,$oldh);
	
		//8.输出图像
		imagepng($newImg,$path."temp_head_pic.png");
		
		imagedestroy($newImg);
		imagedestroy($oldImg);
		

	}
	
?>