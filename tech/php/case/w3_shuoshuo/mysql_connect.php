<?php
	//连接数据库
	$link=mysqli_connect('localhost','root','1234') or die('连接失败');
	//设定字符集
	mysqli_set_charset($link, 'utf8');
	//选择数据库
	mysqli_select_db($link, 'hxsd');
	
	
	function mysql_fn($query){
		
		global $link;
		$method=explode(' ', $query)[0];
		
		switch($method){
			
			//增
			case 'insert':
				$result=mysqli_query($link, $query);
				return $result;	
			break;
			
			//删	
			case 'delete':
				$result=mysqli_query($link, $query);
				if($result && mysqli_affected_rows($link)>0){
					return true;
				}else{
					return false;
				}
			break;
			
			//改	
			case 'update':
				$result=mysqli_query($link, $query);
				if($result && mysqli_affected_rows($link)>0){
					return true;
				}else{
					return false;
				}
			break;
			
			//查
			case 'select':
				$result=mysqli_query($link, $query);
				if($result && mysqli_num_rows($result)>0){
					while($rows=mysqli_fetch_assoc($result)){
						$arr[]=$rows;
					}
					return $arr;
				}else{
					return false;
				}
				//释放资源
				mysqli_free_result($result);
			break;
						
		}
		//关闭连接
		mysqli_close($link);
	}

