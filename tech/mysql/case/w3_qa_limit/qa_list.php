<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			*{ margin: 0; padding: 0;}
			a{ text-decoration: none;}
			ul{ list-style: none;}
			.wrap{ width: 500px; margin: 50px auto;}
			h1,h2,h4{ margin-bottom: 5px;}
			.qa_list li{ background: #efefef; margin-bottom: 20px; padding:10px 20px;}
			textarea{ width: 500px; height:50px; resize: none; margin-bottom: 10px;}
			p{ margin-bottom:5px;}
			button{ width: 80px; height: 30px;}
			.ding_btn{ width: 26px; height: 26px;}
			.page{ text-align: center;}
			.page a{ display: inline-block; width: 30px; height: 30px; text-align: center; border:1px solid #ccc; line-height: 30px; margin-right: 10px;}
			.page .ac{ background: red; color: #FFF;}
		</style>
	</head>
	<body>
	    <div class="wrap">
	        <h1>问题列表 </h1>
            <ul class="qa_list">
                <?php
                    //连接数据库
                    include "mysql_connect.php";
					
					//发送请求
                    $list=mysqli_query($link, 'select * from qa_list');
					
					//遍历数据
					if($list!=false && mysqli_num_rows($list)>0){
						$s=0;
						while($s++ <3 && $rows = mysqli_fetch_assoc($list) ){
							echo "<li>";
							echo "<h4>{$rows["title"]}</h4>";
							echo "<p>";
	                    	for($i=0; $i<$rows['star'];$i++){
	                    		echo "★ ";
	                    	};
							echo "</p>";
	                    	echo '<button class="ding_btn" id="'.$rows['id'].'" type="button">顶</button>';
							echo "</li>";
							
							//$s++;
						}
					}
                ?>
                <!--<li>
                    <h4>函数返回值</h4>
                    <p>★</p>
                    <button class="ding_btn" id="1" type="button">顶</button>
                </li>-->
            </ul>
            <p class="page">
            	<?php
            		//deil向上取整
            		$nums=ceil(mysqli_num_rows($list)/3);
					
					//var_dump(mysqli_num_rows($list));
					
					for($i=1; $i<=$nums; $i++){
						echo '<a class="'.($i==1? "ac":"").'" href="###">'.$i.'</a>';
					}
	            	//释放结果集
					mysqli_free_result($list);
	
					//释放资源
					mysqli_close($link);
            	?>
           	</p>
            
            <h2>我要提问</h2>
            <div>
                <textarea id="cont" name="qa_cont"></textarea>
                <button  type="button" id="insertBtn">我要提问</button>
            </div>
	    </div>
	    
	    <script src="jquery-1.11.3.min.js"></script>
	    <script>
	        
	        //顶
	        $(".qa_list").on("click",".ding_btn",function(){
	        	var id=$(this).attr("id");
	        	var _this=$(this);
	        	$.get("doAction.php",{"a":"ding","id":id},function(data){
	        		//$(document.body).append(data);
	        		var star=_this.prev("p").html();
	        		_this.prev("p").html(star+"★ ");
	        	})
	        });
	        
	        
	        
	        //提问
	        $('#insertBtn').click(function(){
	            var txt=$("textarea").val();
	            
	            if(txt!=""){
	            	$.get("doAction.php?a=insert",{"cont":txt},function(data){
		                //$(document.body).append(data);
		                console.log(data);
		                if(data){
//		                	var html='<li>'+
//		                    '<h4>'+txt+'</h4>'+
//		                    '<p>★ </p>'+
//		                    '<button class="ding_btn" id="'+data+'" type="button">顶</button>'+
//		                '</li>';
//		                $(".qa_list").append(html);
		                
		                window.location.reload();
		                }
		            })
	            }else{
	            	alert("内容不能为空!");
	            }
	        })
	        
	        //分页
	        $(".page a").click(function(){
	        	var _this=$(this);
	        	var n=_this.text();
	        	$.get("doAction.php?a=page",{"p":n},function(data){
	        		//$(document.body).append(data);
	        		
	        		_this.addClass('ac').siblings().removeClass('ac');
	        		
	        		data=JSON.parse(data);
	        			        		
	        		var html='';
	        		for(var i=0; i<data.length; i++){
	        			html+='<li>'+
                    		'<h4>'+data[i].title+'</h4>'+
                    		'<p>';
                    		for(var j=0; j<data[i].star;j++){
                    			html+='★ ';
                    		}
                    		html+='</p>'+
                    		'<button class="ding_btn" id="'+data[i].id+'" type="button">顶</button>'+
                		'</li>';
	        		}
	        		
	        		//清空ul
	        		$(".qa_list").empty().html(html);
	        		
	        		
	        		//拼字符串	
	        	});	
	        	return false;
	        });
	        
	        
	        
	    </script>
	    
	</body>
</html>
