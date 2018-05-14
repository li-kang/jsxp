<?php
		

	include "mysql_connect.php";
	
	
	//业务逻辑判断
	switch($_GET['a']){
		
		//保存数据
		case 'save':
			//定义sql语句
			$query="insert into dsj (title,time,content) values('{$_POST['title']}','{$_POST['year']}-{$_POST['month']}-{$_POST['day']}','{$_POST['contents']}') ";
			$res=mysqli_query($link, $query);
			
			//插入成功
			if($res){
				echo "<script>alert('添加成功！！！'); window.location.href='show.html'</script>";
			}
			break;
		
		//读取数据
		case 'get':
			
			//查询数据
			//@argum $str	string	sql语句
			
			function sq($str){
				global $link;
				$res=mysqli_query($link, $str);
				$arr=[];
				if( $res!=false && mysqli_num_rows($res)>0 ){
					//循环读取
					while($rows=mysqli_fetch_assoc($res)){
						array_push($arr,$rows);
					}; 
				}else{
					die("执行sql语句失败");
				}
				return $arr;
				mysqli_close($link);
			}
			
			//遍历年 distinct去重
			$query="select distinct year(time) as year from dsj order by year ;";
			
			$tree_arr=sq($query);
			foreach($tree_arr as $k=>$v){
				//年
				$y=$v["year"];
				
				//定义月数组
				$tree_arr[$k]['month_arr']=[];
				
				//根据 年 查询 月
				$query="select distinct month(time) as month from dsj where year(time)={$y} order by month";
				
				//遍历月
				$m=sq($query);
				foreach($m as $mk=>$mv){
					$tree_arr[$k]['month_arr'][$mk]=$mv;
					$tree_arr[$k]['month_arr'][$mk]['day_arr']=[];
					
					//根据年、月 查询 日
					$query="select day(time) as day,content,title from dsj where year(time)={$y} and month(time)={$mv['month']} order by day";
					
					//遍历日
					$d=sq($query);
					foreach($d as $dk=>$dv){
						$tree_arr[$k]['month_arr'][$mk]['day_arr'][$dk]=$dv;
					}
				}
			}
			
			//var_dump($tree_arr);
			
			//输出json
			echo json_encode($tree_arr) ;			
			break;
		
	}



?>