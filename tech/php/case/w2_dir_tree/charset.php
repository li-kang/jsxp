<?php
	
	
	$dir=opendir("d:");
	
	while($file=readdir($dir)){
		
		$file=iconv("CP936","UTF-8",$file);
		
		//$e=mb_detect_encoding($file,array('GB2312'));//EUC-CN
		//$e=mb_detect_encoding($file,array('GBK'));//CP936
		//$e=mb_detect_encoding($file,array('UTF-8'));//utf-8
		
		$e=mb_detect_encoding($file,array('ASCII','GB2312','GBK','UTF-8'));
		
		var_dump($file." ------:".$e);
		
		/*
		 *EUC-CN:GB2312
		 * 
		 *CP936:GBK   IBM在发明Code Page的时候将GBK放在第936页，所以叫CP936
		 * 
		 * */
		
		
	}
	
		
		
	
	
	
?>