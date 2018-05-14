
<?php
	
	//当前月
	$year=date("Y");  //Y:fullyear
	$month=date("m");//月
	
	//判断是否有切换
	if(isset($_GET["a"])){
		//重新计算年 月
		$month=date("m",mktime(0, 0, 0, $_GET["m"],1,$_GET["y"]) );
		$year=date("Y",mktime(0, 0, 0, $_GET["m"],1,$_GET["y"]) );	
	}
			
	$today=date('d');//今天
	$allDay=date("t",mktime(0, 0, 0, $month, 1, $year));//总天数
	$w=date("w",mktime(0, 0, 0, $month, 1, $year));//本月第一天是星期几
		
	
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
*{margin:0;padding:0}
#calendar{width:210px;margin:100px auto; overflow:hidden;border:1px solid #000; padding:20px; position:relative}
#calendar h4{ text-align:center; margin-bottom:10px}
#calendar .a1{ position:absolute;top:20px;left:20px;}
#calendar .a2{ position:absolute;top:20px;right:20px;}
#calendar .week{height:30px; line-height:20px;border-bottom:1px solid #000; margin-bottom:10px}
#calendar .week li{ float:left;width:30px;height:30px; text-align:center; list-style:none;}
#calendar .dateList{ overflow:hidden; clear:both}
#calendar .dateList li{float:left;width:30px;height:30px; text-align:center; line-height:30px;list-style:none;}
#calendar .dateList .ccc{ color:#ccc;}
#calendar .dateList .red{ background:#F90; color:#fff;}
#calendar .dateList .sun{ color:#f00;}
</style>

</head>

<body>
<div id="calendar">
       <h4><?= $year?>年<?= $month?>月</h4>
       <a href="carlendar.php?a=prev&m=<?= $month-1 ?>&y=<?= $year ?>" class="a1">上月</a>
       <a href="carlendar.php?a=next&m=<?= $month+1 ?>&y=<?= $year ?>" class="a2">下月</a>
    <ul class="week">
    	<li>日</li>
    	<li>一</li>
    	<li>二</li>
    	<li>三</li>
    	<li>四</li>
    	<li>五</li>
    	<li>六</li>
    </ul>
    <ul class="dateList">
    	
    	<?php 
    		//插入空白
    		for($i=0; $i<$w; $i++){		
				echo "<li></li>";
    	 	}
    	    
			//插入本月	 
    		for($j=1; $j<=$allDay; $j++){
    			
				//小于今日	
    			if($j<$today){
					echo '<li class="ccc">'.$j.'</li>';
				//今日	
				}else if($j==$today){
					echo '<li class="red">'.$j.'</li>';
				
				//大于今日
				}else{
					//标记周六日	
					//ul 中的所有 li
					$fullDay=$w+$j-1;				
					if($fullDay%7==0 || $fullDay%7==6){
						echo '<li class="sun">'.$j.'</li>';	
					}else{
						echo '<li>'.$j.'</li>';	
					}
				}	
    		}
    	?>
    </ul>
</div>
</body>
</html>
