<?php
	//hobby数组
	$h_arr=["篮球","足球","游戏","读书"];
	$city_arr=["北京","上海","杭州","深圳"];
	
	
	//读取文件内容
	$str=file_get_contents("a.txt");
	
	//清除右侧@@
	$str=rtrim($str,"@@");
	
	//拆分字符串为数组
	$stu_arr=explode("@@",$str);
	
	//var_dump($stu_arr);
	
	
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<h1>用户信息表</h1>
		<div class="main">
			
			<?php
				echo "<table>";
					
				echo "<tr><th>姓名</th><th>性别</th><th>出生</th><th>电话</th><th>城市</th><th>爱好</th><th>操作</th></tr>";	
				
				if($stu_arr[0]!=""){
					//插入行
					foreach($stu_arr as $k=>$v){
						echo "<tr>";
							
						//继续拆解更多信息	
						$list=explode("##",$v);
						//var_dump($list);
						
						$name=$list[0];
						
						//判断sex
						$sex=$list[1]=="m" ? "男":"女";
						
						//生日
						$birthday="{$list[2]}年{$list[3]}月{$list[4]}日";
						
						//电话
						$tel=$list[5];
						
						//城市索引
						$city_index=$list[6];
						
						//判断hobby
						$h_txt="";
						if($list[7]!=""){
							$hobby_arr=explode(",",$list[7]);
							foreach($hobby_arr as $hv){
								$h_txt.=$h_arr[$hv]." ";
							}
						}
												
						echo "<td>{$name}</td><td>{$sex}</td><td>$birthday</td><td>{$tel}</td><td>{$city_arr[$city_index]}</td><td>{$h_txt}</td><td><a class='delBtn' href='del.php?index={$k}'>删除</a> <a href='edit.php?index={$k}'>编辑</a></td>";
						
						echo "</tr>";
					}
				}else{
					//清空文件里的@@
					file_put_contents("a.txt", "");
					echo "<tr><td colspan='5' align='center'>没有数据</td></tr>";
				}
				echo "</table>";
				echo "<p style='text-align:center'><a href='index.html'>添加数据</a></p>"
			?>
			
		</div>
		
		
		<script>
			var del=document.getElementsByClassName('delBtn');
			for(var i=0; i<del.length; i++){
				del[i].onclick=function(){
					
					if(!confirm("确定要删除吗？")){
						return false;
					}
					
				}
				
			}
			
			
		</script>
		
		
		
	</body>
</html>