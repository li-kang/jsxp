<?php
	
	$index=$_GET["index"];
	
	//删除数组中元素
	$hobby_str="";
	if(isset($_POST["hobby"])){
		$hobby_str=implode(",",$_POST["hobby"]);
		unset($_POST["hobby"]);
	}
	$new_str=implode("##",$_POST)."##".$hobby_str;
	
	//--------------------------------
	//读取文件内容
	$str=file_get_contents("a.txt");
	//清除右侧@@
	$str=rtrim($str,"@@");
	//拆分字符串为数组
	$stu_arr=explode("@@",$str);
	
	//替换字符串
	$stu_arr[$index]=$new_str;
	
	//重组字符串	
	$save_txt=implode("@@", $stu_arr);

	//保存到文件
	file_put_contents("a.txt", $save_txt."@@");

	echo "<script>alert('保存成功!'); location.href='show.php'</script>";
?>