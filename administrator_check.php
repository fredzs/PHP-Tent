<?php session_start();?>
<html>
<head>
	<title> 综合营帐管理员登陆检测 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php 	
	@$admin_name=$_POST["admin_name"];
	@$admin_password=$_POST["admin_password"];
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db ("db",$con);
	//echo $_POST["admin_name"]."    ".$_POST["admin_password"];
	$found = 0;
	if(!empty($_POST)&&($admin_password!="")&&($admin_name!=""))
    {
		$result = mysql_query("select *  from administrator",$con);
		while($row = mysql_fetch_row($result))
		{
			$name=$row[0];
			$word=$row[1];
			$n=$row[2];
			$t=$row[3];
			if($admin_name==$name)
			{
				if($admin_password==$word)
				{
					$found=1;
					$_SESSION['$admin_num'] = $admin_name;
					$_SESSION['$admin_name'] = $n;
					$_SESSION['$admin_type'] = $t;
					$_SESSION['$login'] = 1;
					echo "<script language=\"JavaScript\">
					alert('管理员登录成功！');  
					</script>";
					$url = "administrator_index.php";
					echo "<script language='javascript' type='text/javascript'>";
					echo "parent.location.replace('administrator_index.php')";

					echo "</script>";
				}
				else 
				{
					$found=2;
					$url = "administrator_login.php";
					echo "<script language=\"JavaScript\">
					alert('密码错误！');  
					</script>";
					echo "<script language='javascript' type='text/javascript'>";
					echo "window.location.href='$url'";
					echo "</script>";
				}
			}
		}
		if($found==0)
		{
			$url = "administrator_login.php";
			echo "<script language=\"JavaScript\">
			alert('账号不存在！');  
			</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
		}
	}
	mysql_close($con);
?>
</body>
</html>