<?php session_start();?>
<html>
<head>
	<title> 综合营帐用户登陆检测 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php 	
	@$user_name=$_POST["user_name"];
	@$user_password=$_POST["user_password"];
	@$code=$_POST["code"];
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db ("db",$con);		
	$found = 0;
	include("securimage/securimage.php");
	$img=new Securimage();
	unset($_SESSION['name']);
	if(!empty($_POST)&&($user_name!="")&&($user_password!="")&&($code!=""))
    {
		$valid=$img->check($code);//检查用户的输入是否正确
		if($valid==false)
		{
			$url = "customer_login.php";
			echo "<script language=\"JavaScript\">
			alert('验证码输入错误，请重新输入！');
			window.location.href='$url';
			</script>";
		} 
		else
		{
			$result = mysql_query("select userNam , account ,password ,credNum from user",$con);
			//echo $result[0];
			$login = 0;
			while($row = mysql_fetch_row($result))
			{
				$account=$row[1];
				$word=$row[2];
				
				if($user_name==$account)
				{
					if($user_password==$word)
					{
						$found=1;
						echo "<script language=\"JavaScript\">
						alert('用户登录成功！');  
						</script>";
						$url = "customer_index.php";
						$name=$row[0];
						$_SESSION['name'] = $name;
						$login = 1;
						$_SESSION['login'] = $login;
						$_SESSION['account'] = $account;
						$credNum=$row[3];
						$_SESSION['credNum'] = $credNum;
						echo "<script language='javascript' type='text/javascript'>";
						echo "window.location.href='$url'";
						echo "</script>";
					}
					else 
					{
						$found=2;
						$url = "customer_login.php";
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
				$url = "customer_login.php";
				echo "<script language=\"JavaScript\">
				alert('账号不存在！');  
				</script>";
				echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='$url'";
				echo "</script>";
			}
		}
	}
	mysql_close($con);
?>
</body>
</html>