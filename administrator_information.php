<?php session_start();?>
<html>
<head>
	<title> 综合营帐管理员登陆 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}
function check()
{
   if(G('admin_password').value == '')
   {
	alert("密码不能为空！");
	G('admin_password').focus();
	return false;
   }
   if(G('admin_name').value == '')
   {
	alert("姓名不能为空！");
	G('admin_name').focus();
	return false;
   }
}
function check2()
{
   if(G('admin_num_new').value == '')
   {
	alert("账号不能为空！");
	G('admin_num_new').focus();
	return false;
   }
   if(G('admin_password_new').value == '')
   {
	alert("密码不能为空！");
	G('admin_password_new').focus();
	return false;
   }
   if(G('admin_name_new').value == '')
   {
	alert("姓名不能为空！");
	G('admin_name_new').focus();
	return false;
   }
}
</script>
</head>

<body>

<?php 
	echo "<u>";
	echo $_SESSION['$admin_name'];
	echo " </u>您好，您的身份是";
	echo "<u> ";
	echo $_SESSION['$admin_type'];
	echo " </u>";
?> <br>请输入您的新资料:
<div  style=border-style:ridge >
<form action="#" method="post" name="form_infor" onSubmit="return check()">

<p align="center">管理员账号(不可更改)：
  <input type="username" readonly value="<?php echo $_SESSION['$admin_num']; ?>" name="admin_num" id="admin_num" size="20" maxlength="20">
</p>
<p align="center"> 新密码：
  <input type="password" name="admin_password" id="admin_password" size="20" maxlength="20">
</p>
<p align="center"> 管理员姓名：
  <input type="username" name="admin_name" id="admin_name" size="20" maxlength="20">

<br> 管理员类型：
	<select name="admin_type" onChange="getindex();">
        <option value="1"> 经  理 </option>
        <option value="2">前台员工</option>
        <option value ="3"> 网  管 </option>
	</select>
</br></p>
<p align="center">
  <input type="submit" name="submit" id="button" value="确认" />
  <input type="reset" name="reset" id="button2" value="重置" /> 
</p>
</form>
</div>
<?php  
	@$admin_password=$_POST["admin_password"];//接受表单数据
	@$admin_name=$_POST["admin_name"];//接受表单数据
	@$admin_type=$_POST["admin_type"];//接受表单数据
	$con=mysql_connect("localhost","root","1qaz");//连接MySQL
	mysql_query("SET NAMES 'UTF8'");//设置字符集
	mysql_select_db ("db",$con);	//选择数据库
	if(!empty($_POST)&&($admin_password!="")&&($admin_name!=""))//判断是否有传值
	{
		$sql="update administrator set admin_password = '".$admin_password."' WHERE admin_num = '".$_SESSION['$admin_num']."'";//构造查询语句
		$result = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());//进行查询
		$sql="update administrator set admin_name = '".$admin_name."' WHERE admin_num = '".$_SESSION['$admin_num']."'";
		$result = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
		$sql="update administrator set admin_type = '".$admin_type."' WHERE admin_num = '".$_SESSION['$admin_num']."'";
		$result = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
		$_SESSION['$admin_name']=$admin_name;
		echo "<script language=\"JavaScript\">
		alert('管理员资料修改成功！'); </script>";
		$url = "administrator_information.php"; 
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
	if($_SESSION['$admin_type']=="经理")
	{
		$countr = mysql_query("select count(*) from administrator",$con);
		$row = mysql_fetch_row($countr); 
		$amount = $row[0]+1; 
?>
或添加新的管理员：
<div  style=border-style:ridge >
<form action="#" method="post" name="form_new" onSubmit="return check2()">
<p align="center">管理员账号：
  <input type="username" readonly value="<?php echo $amount; ?>" name="admin_num_new" id="admin_num_new" size="20" maxlength="20">
</p>
<p align="center"> 新密码：
  <input type="password" name="admin_password_new" id="admin_password_new" size="20" maxlength="20">
</p>
<p align="center"> 管理员姓名：
  <input type="username" name="admin_name_new" id="admin_name_new" size="20" maxlength="20">
<br>管理员类型：
	<select name="admin_type_new" onChange="getindex();">
    	<option value="1"> 经  理 </option>
        <option value="2">前台员工</option>
        <option value ="3"> 网  管 </option>
	</select>
</p>
<p align="center">
  <input type="submit" name="submit_new" id="button3" value="确认" />
  <input type="reset" name="reset_new" id="button4" value="重置" /> 
  </p>
</form>
</div>
<?php
		@$admin_password_new=$_POST["admin_password_new"];
		@$admin_name_new=$_POST["admin_name_new"];
		@$admin_type_new=$_POST["admin_type_new"];
		$admin_num_new=$amount;
		if(!empty($_POST)&&($admin_num_new!="")&&($admin_password_new!="")&&($admin_name_new!=""))
		{
			$sql="INSERT INTO administrator VALUES ('".$amount."','".$admin_password_new."','".$admin_name_new."','".$admin_type_new."')";
			$result = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
			echo "<script language=\"JavaScript\">
			alert('管理员添加成功！');  
			</script>";
		}
	
	}
	
?>

</body>
</html>