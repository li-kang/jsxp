<?php
	include "mysql_connect.php";
	
	//getdata 读取数据库记录
	//@argum $limit	string		mysql limit参数
	
	
	function getdata($limit,$onload=false){
		//引入全局$link变量	
		global $link;
		
		$res_arr=[];
		
		//页面加载
		if($onload){
			$re1=mysql_fn("select count(*) as count from shuoshuo");
			$re2=mysql_fn("select * from shuoshuo order by time desc {$limit}");
			
			$res_arr["count"]=$re1[0]['count']; //总条数
			$res_arr["res"]=$re2; //记录
		}else{
			$re=mysql_fn("select * from shuoshuo order by time desc {$limit}");
			$res_arr["res"]=$re; //记录
		}
		echo json_encode($res_arr); 
	}
	
	
	
	
	switch($_GET['a']){
		
		//页面首次加载-------------------------------	
		case 'onload':
			getdata("limit 0,3",true);
			
		break;
		
		//添加记录-----------------------------------	
		case 'insert':
			$query="insert into shuoshuo values(null,'{$_GET['cont']}','0','0',now())";
			$res=mysql_fn($query);
			
			//添加记录后 重新返回所有记录
			if($res){
				getdata("limit 0,3",true);
			}
		break;
		
		//分页------------------------------------------
		case 'page':
			//得到分页号
			$n=($_GET['cont']-1)*3;
			
			//发送limit的查询
			getdata("limit {$n},3");
		break;
		
		//顶踩------------------------------------------------
		case 'dingcai':
			$field=$_GET['field'];
			$id=$_GET['id'];
			$res=mysql_fn("update shuoshuo set {$field}={$field}+1 where id={$id}");
			echo $res;
		break;	
	}
	
	
?>