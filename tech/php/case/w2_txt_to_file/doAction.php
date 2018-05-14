<?php
	$path="./files";
	$path=rtrim($path,'/')."/";	
	
	if(isset($_GET["a"])){
		switch($_GET["a"]){
				
			//创建文件
			case "create":
				if(isset($_POST["fname"]) ){
					
					if($_POST["fname"]==""){
						echo "<script>alert('不能为空!'); window.location.href='{$_SERVER["HTTP_REFERER"]}'</script>";
						die;
					}
					
					$file=$path.$_POST["fname"].".txt";
					
					//解决中文名称乱码
					//$file = iconv("UTF-8", "GBk", $file); 
					
					if(is_file($file)){
						echo "<script>alert('文件已存在!'); window.location.href='{$_SERVER["HTTP_REFERER"]}'</script>";
						die;
					}else{
						$res=fopen($file,"x");
						//写入内容
						fwrite($res, $_POST["cont"]);
						fclose($res)	;
						echo "<script>alert('成功!'); window.location.href='showList.php'</script>";
					}
				}
				break;
			
			//删除文件
			case "drop":
				$d_file=$_GET["f"];
				unlink($path.$d_file);
				echo "<script>alert('成功!'); window.location.href='showList.php'</script>";
				break;
			
		}
	}
?>
