<?php
	include "mysql_connect.php";
	
	$result=mysqli_query($link, 'select * from students where id='.$_GET['id']);
	
	//一条记录	
	$rows=mysqli_fetch_assoc($result);
	
	//日期数组
	$date_arr=explode('-', $rows["birthday"]);
	
	//var_dump($rows);
	
	//释放结果集
	mysqli_free_result($result);
	//关闭连接
	mysqli_close($link);
	
		
	//select标记	
	function selected($d,$index){
		global $rows;
		global $date_arr;
		if($date_arr[$index]==$d){return "selected";};
	}
	
	//checked标记
	function checked($index){
		global $rows;
		$hobby_arr=explode(',',$rows["hobby"]);
		foreach($hobby_arr as $v){
			if($v==$index){
				echo 'checked';
			};
		};	
	}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			*{margin:0; padding:0}
			p{margin-bottom: 20px;}
			input{vertical-align: middle;}
			input[type=text],input[type=tel],input[type=password],input[type=email]{ height: 26px; padding: 0 5px;}
			select{height:26px}
			label{ margin-right: 10px;}
			h1{ text-align: center; height: 80px; line-height: 80px; }
			.main{width:500px; margin:0 auto; padding: 50px 0;}
			button{ height: 30px; width: 80px; border: 1px solid #ccc;}
		</style>
	</head>
	<body>
	    <h1>编辑信息</h1>
	    <hr />
	    <div class="main">
	        <form action="doAction.php?a=edit&id=<?= $_GET['id'] ?>" method="post" >
                <p><label>用户名：<input type="text" name="username" value="<?=$rows['name'] ?>" /></label></p>
                <p>性　别：<label><input type="radio" name="sex" value="m" <? if($rows['sex']=='m') echo 'checked' ?> />男</label><label><input type="radio" name="sex" value="w" <? if($rows['sex']=='w') echo 'checked' ?>/>女</label></p>
                
                <p>
                    <label>出　生：</label><select name="year">
                    	<?php
                    	for($i=1980; $i<=1990; $i++){
								echo '<option value="'.$i.'" '.selected($i,0).'>'.$i.'</option>';
                    		}	
                    	?>
                       <!--<option value="1980" selected>1980</option>-->
                    </select>
                    <select name="month">
                    	<?php
                    		for($i=1; $i<=12; $i++){
                    			
								echo '<option value="'.$i.'" '.selected($i,1).'>'.$i.'</option>';
                    		}
                    	?>                    	
                       <!--<option value="1" selected>1</option>-->
                      
                    </select>
                    <select name="day">
                    	<?php
                    		for($i=1; $i<=31; $i++){
								echo '<option value="'.$i.'"'.selected($i,2).'>'.$i.'</option>';
                    		}
                    	?> 
                       <!--<option value="1" selected>1</option>-->
                    </select>
                
                </p>
                <p><label>电　话：<input type="tel" name="tel" value="<?=$rows['tel'] ?>" /></label></p>
                <p><label>城　市：</label>
                	<select name="city">
                       <option value="1" <? if($rows['livecity']=='1') echo 'selected' ?>>北京</option>
                       <option value="2" <? if($rows['livecity']=='2') echo 'selected' ?>>上海</option>
                       <option value="3" <? if($rows['livecity']=='3') echo 'selected' ?>>杭州</option>
                       <option value="4" <? if($rows['livecity']=='4') echo 'selected' ?>>深圳</option>
                    </select>
                </p>
                <p>爱　好：
                    <label><input type="checkbox" name="hobby[]" value="1" <? checked(1)?> />篮球</label>
                    <label><input type="checkbox" name="hobby[]" value="2" <? checked(2)?>  />足球</label>
                    <label><input type="checkbox" name="hobby[]" value="3" <? checked(3)?> />游戏</label>
                    <label><input type="checkbox" name="hobby[]" value="4" <? checked(4)?> />读书</label>
                </p>
                <p>　　　　<button>提交</button> <button type="reset">重置</button></p>
            </form>
	        
	    </div>
	    
	    
	</body>
</html>
