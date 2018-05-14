<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		
		
		
		
		
	</head>
	<body>
		<h1>成绩表</h1>
		
		<div class="main">
			<div class="left">
				<p>
				<select id="sel">
					<option value="1">数学</option>
					<option value="2">语文</option>
					<option value="3">英语</option>
					<option value="4">物理</option>
				</select>
			</p>
			<p style="color: red;" >双击"分数"修改成绩</p>
			<table id="scoreTable">
		    	<thead>
		    		<tr>
			    	    <th style="width: 150px;">姓名</th>
			    	    <th>成绩</th>
			    	</tr>
		    	</thead>
		    	<tbody>
		    	</tbody>
		    </table>
			</div>
			<div class="right">
				<h4 style="text-align: center;">成绩分布</h4>
				<div id="pie" style=" width: 400px; height: 400px;"></div>
				
				<p><a id="refresh" href="###">修改成绩后刷新</a></p>
			</div>
			
			
		</div>
		<script src="js/jquery-1.11.3.min.js"></script>
	    <script src="js/echarts.common.min.js"></script>
	    <script src="js/main.js"></script>
	</body>
</html>
