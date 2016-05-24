<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新号有效性检测</title>
</head>

<body>
<?php
	@$phoneNum = $_GET["phoneNum"];
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'GBK'");
	mysql_select_db ("db",$con);
	if (empty($phoneNum))
	{
		echo "<script language=\"JavaScript\">
			alert('手机号不能为空，请再次输入，谢谢~！');
			</script>";
	}
	else
	{
		$sql = "select phoneNum from phonedetail where phoneNum = ". $phoneNum;
		$result = mysql_query($sql,$con) or die(mysql_error());
		$count = mysql_num_rows($result);
	//寻找有没有重复的号码
		if ($count != 0)
		{
			echo "<script language=\"JavaScript\">
				alert('手机号已经注册，请重新选择，谢谢~！');
				</script>";
				$url = "1_newPhoneNumApply.php";
							echo "<script language='javascript' type='text/javascript'>";
							echo "window.location.href='$url'";
							echo "</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">
				alert('该手机号可以申请，请等待进入下一页面。');
				</script>";
				$_SESSION['phoneNum'] = $_GET["phoneNum"];
				$url = "3_newPhoneNumPolicy.php";
							echo "<script language='javascript' type='text/javascript'>";
							echo "window.location.href='$url'";
							echo "</script>";
		}	
		mysql_close($con);
	}
?>

<!--<a href="3_newPhoneNumPolicy.php?value=<?php //echo $phoneNum ?>">连接</a> 这块有问题-->
</body>
</html>