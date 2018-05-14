<?php
	include "mysql_connect.php";
	
	$query="select b.id,a.title, a.cont,a.time,b.name,b.school,b.headpic from weibo as a,weibo_user as b where a.user=b.id";
	
	$res=mysqli_query($link, $query);
	
	if($res!=false && mysqli_num_rows($res)>0){
		while($rows=mysqli_fetch_assoc($res)){
			
			$arr[]=$rows;
			
		}
		
		echo json_encode($arr);
		
	}
	
?>