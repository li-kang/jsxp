<?php
	//接收show.php传来的 index
	$index=$_GET["index"];
	
	//读取a.txt
	$txt=file_get_contents("a.txt");
	
	//清除右侧@@
	$txt=rtrim($txt,"@@");
	//拆成数组
	$stu_arr=explode("@@", $txt);
	
	//从数组中删除对应的条目
	unset($stu_arr[$index]);
	
	//重新拼装字符串(此处拼装字符串，与输入保存字符串后面单独添加@@是相同的效果)
	$a_txt=implode("@@", $stu_arr);
			
	//写回文件
	file_put_contents("a.txt", $a_txt."@@");
	
	echo "<script>alert('删除成功！！'); location.href='show.php'</script>"
?>