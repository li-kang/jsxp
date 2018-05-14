<?php
	include "upfile.fn.php";
	include "mysql_connect.php";
	
	switch($_GET['a']){
		
		case "upfile":
			//文件保存到硬盘---------------------------------
		
			//接收post请求
			$files=$_FILES['fname'];
			//var_dump($files);
			
			//格式转换
			$new_files=[];
			foreach($files as $k=>$v){
				for($j=0; $j<count($v);$j++){
					$new_files[$j][$k]=$v[$j];
				}
			}
			//var_dump($new_files);
			
			//定义upfile参数
			$path='./images';
			$typeArr=array("image/jpeg","image/png","image/gif");
			$maxSize=1024*1024*4; //4M
			
			$res=[];
			
			for($k=0; $k<count($new_files);$k++){
				$file=$new_files[$k];
				$res[]=upfile($path,$file,$typeArr,$maxSize);
			}
			//var_dump($res);
			
			//保存到数据库-----------------------------------------
			$query="insert into flow_img values";
			for($i=0; $i<count($res);$i++){
				$query.="(null,'{$res[$i]["up_name"]}','{$res[$i]["new_name"]}'),";
			}
			$query=rtrim($query,',');
			
			$result=mysqli_query($link, $query);
			
			if($result){
				echo "保存成功";
			}
		break;
		
		
		case 'get':
		$p=($_GET['p']-1)*10;
		
		$limit="limit {$p},10";	
		
		//var_dump($limit);
			
		$result=mysqli_query($link, "select * from flow_img {$limit}");
		
		if($result && mysqli_num_rows($result)>0){
			while($rows=mysqli_fetch_assoc($result)){
				$arr[]=$rows;
			}
			echo json_encode($arr);	
		}else{
			echo false;
		}
		break;
	
		
		
		
	}
	
	
	
	
	


?>