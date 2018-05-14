<?php
		
	require "config.php";
	
	class Model{
		
		//成员属性
		public $tableName;		//表名
		private $link;			//连接成功的数据库对象资源
		private $all_fields;	//所有字段
		private $select_field;	//查询字段（若为空则代表 *）
		private $pri_key;		//主键
		private $where;			//存储查询时的条件信息
		private $order;			//存储查询时的排序信息
		private $limit;			//存储查询时的分页信息
		
		
		//构造方法--------------------------------------------
		public function __construct($tbl_name){
			//赋初值
			$this->tableName = $tbl_name;

			//1. 连接数据库服务器，并判断是否成功
			$this->link = mysqli_connect(HOST,USER,PASS) or die('数据库连接失败！');

			//2. 设置字符集
			mysqli_set_charset($this->link,CHARSET);

			//3. 选择数据库
			mysqli_select_db($this->link,DBNAME);

			//4. 构造方法执行时，自动获取表中所有字段信息
			//$this->getAllFields();
		}
		//前期准备--------------------------------------
		
		//获取表中所有字段  主键
		public function getAllFields(){
			//获取表中所有的字段信息
			$sql = "desc ".$this->tableName;
			$result = mysqli_query($this->link,$sql);

			//判断是否执行成功
			if($result!=false && mysqli_num_rows($result)>0){

				//存储主键信息的变量，存储其他字段的变量
				$pk = '';
				$fields = array();

				//遍历解析信息
				while($rows = mysqli_fetch_assoc($result)){

					//判断是不是主键
					if($rows['Key']=='PRI'){
						$pk = $rows['Field'];
					}else{
						$fields[] = $rows['Field'];
					}
				}
			}
			//将此方法获取到的主键以及其他字段信息放入成员属性
			$this->pri_key = $pk;
			$this->all_fields = $fields;
		}
		
		//过滤字段信息的方法
		public function filterData($data){
			//过滤字段信息方法
			foreach($data as $k=>$v){

				//判断下标是否存在于表字段中
				if(!in_array($k,$this->all_fields) && $this->pri_key!=$k){
					echo '<script>alert("抱歉，您所传递的信息当中含有非法字段！字段为：'.$k.'")</script>';	
					return false;
				}
			}
			//返回过滤完毕的信息
			return $data;
		}
		
		
		
		
		//错误报告
		public function error_report(){
			echo '<script>alert("'.mysqli_error($this->link).'")</script>';
		}
		
		
		//增------------------------------------------------
		public function add($data){
			
			//1.获取数组中的所有key
			$keys = array_keys($data);
			
			//2.将取出key按逗号进行拼装
			$key_sql = implode(',',$keys);
			
			//3.获取数组中的所有值
			$values = array_values($data);

			//4.将取出的值按都好进行拼装
			$val_sql = "'".implode("','",$values)."'";
			
			//5.发生sql请求
			//定义sql语句
			//"insert into tbl_name (a,b,c) values('val1','val2','val3')";
			
			$query="insert into ".$this->tableName." ({$key_sql}) values({$val_sql})";
			
			//var_dump($query);
			
			$res = mysqli_query($this->link, $query);

			//6.判断是否添加成功
			if($res!=false && mysqli_affected_rows($this->link)>0){
				//返回刚才添加成功信息的id号码
				return mysqli_insert_id($this->link);
			}else{
				//错误报告
				$this->error_report();
				return false;
			}
		}
		
		
		//删------------------------------------------------
		public function del($id){
			
			$res=mysqli_query($this->link, "delete from ".$this->tableName." where id={$id}");
			if($res!=false && mysqli_affected_rows($this->link)>0){
				return true;
			}else if(mysqli_affected_rows($this->link)==0){
				echo '<script>alert("删除0条记录,请检查id!")</script>';
			}else{
				//错误报告
				$this->error_report();
				return false;
			}
		}
		
		//改------------------------------------------------
		public function save($data,$id){
			$set = '';
			//1.遍历数组
			foreach($data as $k=>$v){
				$set.= $k."='".$v."',";
			}
			
			//2.将修改信息最后的逗号去除
			$set = rtrim($set,',');
			$res=mysqli_query($this->link, "update ".$this->tableName." set {$set} where id={$id}");
			var_dump("update ".$this->tableName." {$set} where id={$id}");
			
			if($res!=false && mysqli_affected_rows($this->link)>0){
				return true;
			}else{
				//错误报告
				$this->error_report();
				return false;
			}
		}
		
		//查------------------------------------------------
		public function select(){
			
			//1.判断是否限定了要查询的字段信息
			$f = '';
			if(empty($this->field)){
				$f = '*';
			}else{
				$f = $this->field;
			}

			//2.判断是否限定了要查询条件的信息
			$w = '';
			if(!empty($this->where)){
				$w = " where ".$this->where;
			}

			//3.判断是否设定了排序的信息
			$o = '';
			if(!empty($this->order)){
				$o = " order by ".$this->order;
			}

			//4.判断是否设定了分页的信息
			$l = '';
			if(!empty($this->limit)){
				$l = " limit ".$this->limit;
			}

			//5.定义查询多条并且指定条件的sql语句
			$sql = "select ".$f." from ".$this->tableName." ".$w." ".$o." ".$l;
			
			var_dump($sql);
			$result = mysqli_query($this->link, $sql);

			//清空检索条件
			$this->field = null;
			$this->where = null;
			$this->order = null;
			$this->limit = null;

			//6.判断
			if($result!=false && mysqli_num_rows($result)>0){
				//解析
				while($rows = mysqli_fetch_assoc($result)){
					$arr[] = $rows;
				}
				return $arr;
			}else{
				return false;
			}
			
		}
		//6.定义封装查询字段的信息
		public function field($field){
			$this->field = $field;
			return $this;
		}

		//7.定义封装查询条件的信息
		public function where($where){
			$this->where = $where;
			return $this;
		}

		//8.定义封装排序条件的信息
		public function order($order){
			$this->order = $order;
			return $this;
		}

		//9.定义封装分页条件的信息
		public function limit($limit){
			$this->limit = $limit;
			return $this;
		}
		
		//4.查询单条数据
		public function find($id){
			//定义查询单条数据的sql语句
			$sql = "select * from ".$this->tableName." where ".$this->pk."=".$id;
			$result = mysqli_query($this->link, $sql);
			
			//判断是否查询成功
			if($result!=false && mysqli_num_rows($result)>0){
				//解析结果集
				return mysqli_fetch_assoc($result);
			}else{
				return false;
			}
		}
			
				
		//统计条目
		public function count(){
			//定义统计条数的sql语句
			$result = mysqli_query($this->link,"select * from ".$this->tableName);
			//判断是否执行成功
			if($result!=false){
				return mysqli_num_rows($result);
			}else{
				//错误报告
				$this->error_report();
				return false;
			}
		}
		
		//发送原生语句的方法
		public function query($sql){
			//1.通过分割空格的方式，取出SQL语句的第一个单词
			$point = explode(' ',$sql)[0];
			
			//2.根据单词的含义，执行相应的操作
			switch($point){
				
				case "insert":
					$res = mysqli_query($this->link, $sql);
					//判断是否成功
					if($res!=false && mysqli_affected_rows($this->link)>0){
						return mysqli_insert_id($this->link);
					}else{
						return false;
					}
					break;

				case "delete":
					break;

				case "update":
					break;

				case "select":
					break;
			}
		}
		
		
		//析构函数-----------------------------------
		//关闭连接
		public function __destruct(){
			mysqli_close($this->link);
		}
		
	}
	
	
	
//测试--------------------------------------------------
	
	//增
//	$data = array(
//	 	'name'=>'333',
//	 	'sex'=>'m',
//	 	'birthday'=>'1995-10-03',
//	 	'tel'=>'13614562345',
//	 	'livecity'=>'2',
//	 	'hobby'=>'1,2,4'
//	);
//	$stu=new Model('students');
//	$res=$stu->add($data);
	
	//删------------------------------------------------
	//$stu=new Model('students');
	//$res=$stu->del(4);
	
	//改-------------------------------------------------
//	$stu = new Model('students');
//	$data = array(
//		'name'=>'ysdfs',
//		'livecity'=>2
//	);
//	$res = $stu->save($data,2);
	
	///*思考问题:
	//如果表中没用id字段,而是以其他字段作为primary key,如何操作??  如何自动识别primary key??
	
	//查---------------------------------------------
	
	//查询所有
	$stu = new Model('students');
	$res = $stu->select();
	var_dump($res);
	
	
	//条件查询
//	$stu = new Model('students');
//	$res = $stu->field('name,birthday')->where('id<10')->order('livecity')->limit('6,3')->select();
//	$res1 = $stu->where('id<5')->select();
//	var_dump($res,$res1);
	
	//统计总条目
//	$stu = new Model('students');
//	$res = $stu->count();
//	var_dump($res);
?>