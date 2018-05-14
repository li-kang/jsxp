<?php
	
	//清除cookie信息即可
	setcookie('name','',time()-1);
	setcookie('pwd','',time()-1);

	echo "<script>alert('退出成功！');window.location.href='login.php'</script>";
