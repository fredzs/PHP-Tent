<?php session_start();?>
<html>
<head>
	<title> 用户注册模块 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<p> 用户注册 </p>

<form action="customer_regist.php" method="get">
  <p>欢迎！</p>
  <p>请输入您的用户名: <input type="text" name="acc" /> </p>
  <p>请输入您的密码: <input type="password" name="password1" /> </p>
  <p>请再次输入密码: <input type="password" name="password2" /> </p>
  <p></p>
  <p>请填写您的姓名: <input type="text" name="userNam" /> </p>
  <p>请填写您的有效证件号: <input type="text" name="credNum" /> </p>
  <p>请选择您的有效证件类型: <select name="credType" onChange="getindex();">
        						<option value="1">身份证</option>
       				 			<option value="2">护照</option>
                                <option value="2">军官证</option>
						</select> </p>
  <p>请选择您的性别:<select name="gender" onChange="getindex();">
        				<option value="1">男</option>
       				 	<option value="2">女</option>
				</select></p>
  <p>请输入您的电子邮箱地址:<input type="text" name="Email" /></p>
  <p>请输入您的出生日期<input type="text" name="BirthDate" /></p>
  <p>建议格式：yyyy-mm-dd</p>
  <p>请填写您的地址：<input type="text" name="city" /></p>
  <p>注：以上条目皆为必填</p>
  <p><input type="submit" value="确认" name="提交"/></p>
</form>

<?php
		
		$con = mysql_connect("localhost","root","1qaz");
		mysql_query("SET NAMES 'UTF8'");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		if (!empty($_GET['acc']))
		{
			$sql = "select account from user";
			$result = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
			$found = false;
			while ($row = mysql_fetch_row($result))
			{
				if ($row[0] == $_GET['acc'])
				{
					$found = true;
					break;
				}
			}
			if ($found == true)
			{
				echo "<script language=\"JavaScript\">
				alert('您选择的账号已存在');  
				</script>";
			}
			else
			{
				if ($_GET['password1'] != $_GET['password2'])
				{
					echo "<script language=\"JavaScript\">
					alert('两次的密码不相符');  
					</script>";
				}
				else
				{
					if ($_GET['password1']=="")
					{
						echo "<script language=\"JavaScript\">
						alert('密码不能为空');  
						</script>";
					}
					else
					{
						if (isset($_GET['acc'])&&isset($_GET['password1'])&&isset($_GET['credNum'])&&isset($_GET['userNam'])&&isset($_GET['credType'])&&isset($_GET['Email'])&&isset($_GET['city'])&&isset($_GET['gender']))
						{
							$sql = "insert into user values( '".$_GET['credNum']."','".$_GET['credType']."','".$_GET['userNam']."','".$_GET['gender']."','".$_GET['acc']."','".$_GET['password1']."','".$_GET['Email']."','".$_GET['BirthDate']."','".$_GET['city']."')";
							mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
			
							$_SESSION['account'] = $_GET['acc'];
							$_SESSION['name'] = $_GET['userNam'];
							$login = 1;
							$_SESSION['login'] = $login;
							$_SESSION['credNum'] = $_GET['credNum'];
							echo $_SESSION['login'];
							$url = "customer_index.php";
							echo "<script language=\"JavaScript\">
							alert('注册成功');
							</script>";
							echo "<script language='javascript' type='text/javascript'>";
							echo "window.location.href='$url'";
							echo "</script>";
							
	
					}
				}
			}
		}
		
	}
		

?>

</body>
</html>