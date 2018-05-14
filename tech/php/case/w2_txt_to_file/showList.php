<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="main">
			<table>
		       <tr>
	            <th>文件名</th>
	            <th>文件类型</th>
	            <th>文件大小</th>
	            <th>创建时间</th>
	            <th>修改时间</th>
	            <th>内容</th>
	            <th>操作</th>
	        </tr>
	        <?php
	            
	            $path="./files";
				
				$path=rtrim($path,"/")."/";
								
				$res=opendir($path);
	    		
				//是否为空目录
				if(count(scandir($path))!=2){
					while($file=readdir($res)){
	                
		                if($file=="." || $file==".."){
		                    continue;
		                }
		                //$c_file=iconv("GBK", "UTF-8", $file);
		                
		                $filename=rtrim($path,'/').'/'.$file;
		                
		                echo "<tr>";
		                echo "<td>{$file}</td>";
		                echo '<td>'.filetype($filename).'</td>';
		                echo '<td>'.filesize($filename).'</td>';
		                echo '<td>'.filectime($filename).'</td>';
		                echo '<td>'.filemtime($filename).'</td>';
		                echo '<td>'.file_get_contents($filename).'</td>';
		                echo '<td><a href="doAction.php?a=drop&f='.$file.'">删除</a></td>';
		                echo '</tr>';
		            }
				}else{
					echo '<td colspan="7" align="center">没有文件</td>';
					
				}
	        ?>
	    </table>
	    <br>
	    <p style="text-align: center;"><a href="txt_save_file.php">添加文件</a></p>
			
		</div>
	    
	</body>
</html>
