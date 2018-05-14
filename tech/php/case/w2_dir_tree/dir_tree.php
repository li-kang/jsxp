<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>目录树</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<h1>目录树</h1>
		<div class="main">
			<form action="">
				<input type="text" name="path" value=""> <button>查询</button>
			</form>
		
			<div id="objTree">
			<?php
				//搜索函数
				function search_dir($path){
					
					//修正目录格式
					$path=rtrim($path,'/')."/";
					
										
					//打开目录
					$res = opendir($path);
										
					//判断 空目录
					//if( count(  scandir($path)  )>2   ){
							
						echo '<ul>';
					
						//遍历目录
						while($file = readdir($res)){
							
							//跳过
							if($file=="." || $file==".."){
								continue;
							}
							
							//判断是否是目录
							if( is_dir($path.$file)  ){
								//GBK → UTF-8
								$file=iconv("CP936","UTF-8",$file);
								echo '<li><a href="###" class="ellipsis" title="'.$file.'">'.$file.'</a>';						
								
								//递归调用
								$file=iconv("UTF-8","CP936",$file);
								search_dir($path.$file);
								
								echo "</li>";
								
							}else{
								//GBK → UTF-8
								$file=iconv("CP936","UTF-8",$file);
								echo '<li><a href="###"  class="ellipsis" title="'.$file.'">'.$file.'</a></li>';
							}
						}
						echo "</ul>";
						//关闭目录
						closedir($res);
					//};
				}
//-------------------------------------------------------------------------------				
				
				
				if(isset(  $_GET["path"])  ){
					
					$path=$_GET["path"];
					
					$encode = mb_detect_encoding( $path, array("ASCII","GB2312","GBK","UTF-8"));
					var_dump($encode);
					
					//判断输入的目录名是否为中文
					if($encode =="CP936"){
						$path=iconv("UTF-8", "CP936", $path);
					}
					//递归
					search_dir($path);
				}
			?>
			</div>
		</div>
	</body>
	<script src="jquery-1.11.3.min.js"></script>
	<script>
		$(function(){
			
			
			$('li').each(function(index, element) {
		        var _this=$(this);
				var subMenu=_this.children('ul');
				if(subMenu.size()){
					subMenu.addClass('subMenu');
					_this.addClass('hasSub');
				};
				_this.click(function(){
					if($(this).hasClass('hasSub')){
						$(this).toggleClass('showSubmenu');
					};
					$('#objTree a').removeClass('ac');
					$(this).children('a').addClass('ac');
					return false;
				});
		    });
		});
	</script>
	
	
</html>

