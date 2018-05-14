<?php
	
	//hobby转字符串
	$hobby_str="";
	if(isset($_GET["hobby"])){
		$hobby_str=implode(",",$_GET["hobby"]);
		//删除数组中元素
		unset($_GET["hobby"]);
	}
	$str=implode("##",$_GET);
	
	//连接hobby 添加结尾的@@     保存到文件
	file_put_contents("a.txt", $str."##".$hobby_str."@@",FILE_APPEND );
	
	echo "<script>alert('保存成功!'); location.href='show.php'</script>";
	
	
	
	
?>