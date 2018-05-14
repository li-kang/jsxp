<?php
	//根据用户的动作，执行相应的操作页面
	
	//判断用户的动作
	switch($_GET['a']){
		case "insert":		//执行留言的添加
			
			//获取用户提交的所有信息
			$data = $_POST;
			
			//判断是否提交了空数据
			
			//var_dump($data);
			
			if(empty($data['title']) || empty($data['author']) || empty($data['contents'])){
				if(!$data['title'] || !$data['author']|| !$data['contents']){
					echo "<script>alert('不能提交空信息！请检查！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
					die;
				}
			}
			//判断是否在结果中包含了html或其他代码
			$data['title'] = htmlspecialchars($data['title']);
			$data['author'] = htmlspecialchars($data['author']);
			$data['contents'] = htmlspecialchars($data['contents']);
			
			//将用户提交的信息拼装成字符串
			$contents = implode('##',$data).'@@';
			//var_dump($contents);
			
			//将用户留言的信息直接追加写入liuyan.txt中
			file_put_contents('liuyan.txt',$contents,FILE_APPEND);
			
			//提示用户，添加成功，并且将当前页面跳转到查看留言页面
			echo "<script>alert('恭喜，留言成功！');window.location.href='show.php'</script>";
			
			break;
			
		case "delete":		//执行留言的删除
			
			//获取要删除数据的下标
			$k = $_GET['k'];
			
			//从liuyan.txt中获取所有的留言信息
			$contents = file_get_contents('liuyan.txt');
			
			//去除最右侧的两个@@
			$contents = rtrim($contents,'@@');
			
			//按@@拆分出每一条留言
			$list = explode('@@',$contents);
			
			//删除指定下标的数据
			//unset($list[$k]);
			
			array_splice($list,$k,1);
			
			
			//删除最后一条以后，会留下@@，需要如下判断
			if(empty($list)){
				$contents="";
			}else{
				//将删除之后的数组拼装回字符串
				$contents = implode('@@',$list).'@@';
			}
			
			//将拼装好之后的字符串覆盖写会到liuyan.txt中
			file_put_contents('liuyan.txt', $contents);
			
			//提示用户删除成功
			echo "<script>alert('恭喜，删除成功！');window.location.href='show.php'</script>";
			
			break;
			
		case "update":		//执行留言的修改
		
			//获取要修改人的下标
			$k = $_GET['k'];
			
			//将修改人的修改信息拼装成字符串
			$nlist = implode('##',$_POST);
			
			//从liuyan.txt中将所有信息提取过来
			$contents = file_get_contents('liuyan.txt');
			
			//按@@拆分每一条留言
			$olist = explode('@@',$contents);
			
			//进行替换
			$olist[$k] = $nlist;
			
			//将修改之后的list拼装回字符串
			$contents = implode('@@',$olist);
			
			//将修改之后的数据覆盖写回到liuyan.txt
			file_put_contents('liuyan.txt',$contents);
			
			var_dump($_SERVER['HTTP_REFERER']);
						
			
			//修改成功 跳转到列表页 注意：不使用$_SERVER['HTTP_REFERER']
			echo "<script>alert('恭喜，修改成功！');window.location.href='show.php'</script>";
			echo $contents;
			
			break;
			
		default:
			die('你执行了一个不存在的动作！请检查！');
	}