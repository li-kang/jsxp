<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			img{ max-width:80px}
		</style>
	</head>
	<body>
	    <h1>图片列表</h1>
	    <div class="main">
	    	<table border=1>
		    	<tr>
		    		<th>图片名称</th>
		    		<th>大小</th>
		    		<th>缩略图</th>
		    		<th>上传ip</th>
		    		<th>操作</th>
		    	</tr>
		    	<?php 
		    		//读取文件
		    		$cont=file_get_contents("data.txt");
										
					//判断字符串是否为空
					if(!empty($cont)){
						
						$cont=rtrim($cont,"@@");
						$list=explode("@@",$cont);
					
						
						foreach($list as $k=>$v){
							
							//拆分字符串
							$item=explode("##",$v);
							echo '<tr>';
							
							//插入信息
							foreach($item as $ik=>$iv){
								
								//索引2是图片地址，需拼接img标签	
								if($ik==2){
									echo '<td><a href="'.$iv.'" target="_blank"><img src="'.$iv.'"></a></td>';
								}else{
									echo "<td>{$iv}</td>";
								}
				    		}
							echo '<td  align="center"><a class="del" href="up_load.php?a=del&index='.$k.'">删除</a></td>';
				    		echo "</tr>";
						} 
					}else{
						echo '<tr align="center"><td colspan="5">没有图片</td>';
			    		echo "</tr>";
					}
				?>
		    </table>
		    <p style="text-align: center;"><a href="up_file.html">上传图片</a></p>	
	    </div>
	    <script>
	    	var delBtn=document.getElementsByClassName("del");
	    	
	    	for(var i=0; i<delBtn.length; i++){
	    		
	    		delBtn[i].onclick=function(){
	    			
	    			if(!confirm("你确定要删除图片吗？")){
	    				//阻止默认事件
	    				return false;
	    			}
	    		}
	    	}
	    	
	    	
	    </script>
	    
	</body>
</html>