<?php
	/*
	 * $path	string	路径
	 * $file	string	文件名
	 * $typeArr	array	文件类型    array("image/jpeg","image/png","image/gif");
	 * $maxSize	integer	文件大小
	 * return	array	$res	返回一个数组：info：错误信息 name：文件名  success：成功布尔值 
	 */	

	function upfile($path,$file,$typeArr=array(),$maxSize=0){
		
		//格式路径
		$path=rtrim($path,'/')."/";
		
		//设置时区
		date_default_timezone_set("PRC");
		
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
		
				
		//随机重命名文件-----------------------------------------------------
		//判断文件是否存在
		do	{
			//随机名字	
			$n_name=date("YmdGis").rand(1,99999999).".".$ext;
			
		}while(file_exists($path.$n_name));
		
		//保存图片	
		if(is_uploaded_file($file["tmp_name"])){
			if(move_uploaded_file($file["tmp_name"], $path.$n_name)){
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


	//文件大小字节转换--------------------------------------------------------------------
	
	function FileSizeConvert($bytes) {
	    $bytes = floatval($bytes);
	        $arBytes = array(
	            0 => array(
	                "UNIT" => "TB",
	                "VALUE" => pow(1024, 4)
	            ),
		        1 => array(
		            "UNIT" => "GB",
		            "VALUE" => pow(1024, 3)
		        ),
		         2 => array(
		            "UNIT" => "MB",
		            "VALUE" => pow(1024, 2)
		         ),
		         3 => array(
		            "UNIT" => "KB",
		            "VALUE" => 1024
		         ),
		         4 => array(
		            "UNIT" => "B",
		            "VALUE" => 1
		         ),
		     );
		foreach($arBytes as $arItem) {
		    if($bytes >= $arItem["VALUE"]){
	        	$result = $bytes / $arItem["VALUE"];
	        	$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
	            break;
	        }
	    }
		return $result;
	}
	
?>