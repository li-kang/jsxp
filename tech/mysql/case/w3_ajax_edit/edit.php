<?php
	include "mysql_connect.php";
	
	$query="select * from stu_ajax";
	
	//sql请求
	$result=mysqli_query($link, $query);

?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
*{ margin:0; padding:0; font-size:14px}
#box{ width:500px; margin:100px auto}
table,th,td{ border:1px solid #000; border-collapse:collapse}
td,th{ width:100px; height:30px; padding:10px}
input{ display:none; height:24px; width:60px; border:1px solid #ccc;}
.editBtn{ color:#666}
.delBtn{ color:red}
.okBtn,.cancelBtn{ display:none}

.edit span{ display:none}
.edit input{ display:inline-block}
.edit .editBtn,.edit .delBtn{ display:none}
.edit .okBtn,.edit .cancelBtn{ display:inline}
</style>

</head>

<body>
<div id="box">
	<table>
        <tr>
            <th>姓名</th>
            <th>年龄</th>
            <th>城市</th>
            <th>编辑</th>
        </tr>
        <?php
            
			if($result && mysqli_num_rows($result)>0){
					
				//解析结果
				while($res=mysqli_fetch_assoc($result)){
					echo '<tr>';
					echo '<td><span>'.$res['name'].'</span><input class="name" type="text"></td>';
					echo '<td><span>'.$res['age'].'</span><input class="age" type="text"></td>';
            		echo '<td><span>'.$res['city'].'</span><input class="city" type="text"></td>';
            		echo '<td>';
            		echo '<a href="javascript:;" class="editBtn">编辑</a> ';
            		echo '<a href="javascript:;" class="okBtn" data-id="'.$res['id'].'">确定</a> ';
					echo '<a href="javascript:;" class="cancelBtn">取消</a> ';
            		echo '<a href="javascript:;" class="delBtn" data-id="'.$res['id'].'">删除</a></td>';
            		echo '</tr>';
				}
			}
			
            
        ?>   
        <!--<tr>
            <td><span>张三</span><input type="text"></td>
            <td><span>18</span><input type="text"></td>
            <td><span>北京</span><input type="text"></td>
            <td><a href="javascript:;" class="editBtn">编辑</a><a href="javascript:;" class="okBtn">确定</a> <a href="javascript:;" class="cancelBtn">取消</a><a href="javascript:;" class="delBtn">删除</a></td>
        </tr>-->
        
    
    </table>

</div>
</body>
</html>
<script src="jquery-1.11.3.min.js"></script>
<script>
$('table').on('click','.editBtn,.okBtn,.cancelBtn,.delBtn',function(){
	
	var p_tr=$(this).parents('tr');	//找到所在“行”
	var aTd=p_tr.children();//所有的td
	
	function toggleVal(b_exchange){//是否交互数据
		for(var j=0; j<aTd.length-1; j++){//排除最后一个
			var span=aTd.eq(j).children('span');
			var input=aTd.eq(j).children('input');
			b_exchange ? input.val(span.text()) : span.text(input.val());
		};
	};
	
	switch( $(this).prop("class") ){
		
		//编辑
		case "editBtn":
		toggleVal(true);
		p_tr.addClass("edit");
		break;
		
		//确定修改
		case "okBtn":
		var id=$(this).attr("data-id");
		var name=p_tr.find('.name').val();
		var age=p_tr.find('.age').val();
		var city=p_tr.find('.city').val();
				
		//发送修改请求
		$.get('doAction.php?a=update',{"id":id,"name":name,"age":age,"city":city},function(data){
			//$(document.body).append(data);
			if(data){
				alert('修改成功');
				toggleVal();
				p_tr.removeClass();
			}else{
				alert('修改错误,请检测数据!!');
				toggleVal(true);
			}
		})
		break;
		
		//取消
		case "cancelBtn":
			p_tr.removeClass();
		break;
		
		
		//删除
		case "delBtn":
		if(confirm("确定要删除本行吗?")){
			var id=$(this).attr("data-id");
			
			//发送删除请求
			$.get('doAction.php?a=del',{"id":id},function(data){
				//$(document.body).append(data);
				if(data){
					p_tr.remove();//tbody 内删除
					alert("删除成功!");
				}else{
					alert("删除失败!");
				}
			})
		}
		break;
		
		default:
		return;
	};
	
	

});

</script>
