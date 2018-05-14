<?php
	$index=$_GET["index"];

	//读取a.txt
	$txt=file_get_contents("a.txt");
	//拆成数组
	$stu_arr=explode("@@", $txt);
	
	//拆解数组
	$list=explode("##",$stu_arr[$index]);
	
	//hobby数组
	if($list[7]!=""){
		$hobby_arr=explode(",",$list[7]);
	}else{
		$hobby_arr=[];
	}
	//var_dump($list);
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<h1>编辑信息</h1>
		<div class="main">
			<form id="myform" action="save.php?index=<?=$index?>" method="post">
			
				<p><label>用户名：<input type="text" name="username" value=<?= $list[0]?>></label></p>
				<p>性　别：<label><input type="radio" name="sex" value="m" <?= $list[1]=="m"? "checked":"" ?>  >男</label><label><input type="radio" name="sex" value="w" <?= $list[1]=="w"? "checked":"" ?>>女</label></p>
				<p>出　生：<select name="year">
					<option value="2017" <?= $list[2]=="2017" ? "selected":"" ?> >2017</option>
					<option value="2018" <?= $list[2]=="2018" ? "selected":"" ?> >2018</option>
				</select> 年
				<select name="month">
					<?php
						for($i=1; $i<=12; $i++){
							echo "<option value='{$i}'".($list[3]==$i? "selected":"").">".($i<10? "0".$i:$i)."</option>";
						}
					?>
				</select> 月
				<select name="day">
					<?php
						for($i=1; $i<=31; $i++){
							echo "<option value='{$i}'".($list[4]==$i? "selected":"").">".($i<10? "0".$i:$i)."</option>";
						}
					?>
				</select> 日
				</p>
				<p><label>电　话：<input type="tel" name="tel" value="<?= $list[5]?>" /></label></p>
                <p><label>城　市：</label>
                    <select name="city">
                       <option value="0" <?= $list[6]==0? "selected":""  ?> >北京</option>
                       <option value="1" <?= $list[6]==1? "selected":""  ?> >上海</option>
                       <option value="2" <?= $list[6]==2? "selected":""  ?> >杭州</option>
                       <option value="3" <?= $list[6]==3? "selected":""  ?> >深圳</option>
                    </select>
                </p>
				
				<p>爱　好：<label><input type="checkbox" name="hobby[]" value="0"<?= in_array(0, $hobby_arr) ? "checked":"" ?>>篮球</label> 
					<label><input type="checkbox" name="hobby[]" value="1" <?= in_array(1, $hobby_arr) ? "checked":"" ?>>足球</label> 
					<label><input type="checkbox" name="hobby[]" value="2" <?= in_array(2, $hobby_arr) ? "checked":"" ?>>游戏</label>
					<label><input type="checkbox" name="hobby[]" value="3" <?= in_array(3, $hobby_arr) ? "checked":"" ?>>读书</label>
				</p>
				<p>	　　　　<button type="submit">保存提交</button> </p>
			</form>
			
		</div>
		
		
		
		
	</body>
</html>