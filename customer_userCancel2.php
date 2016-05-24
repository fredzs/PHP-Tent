<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主动撤机办理</title>
</head>

<body>

<?php
function checkUserStop($phoneNum)
{
	$con = mysql_connect("localhost", "root", "1qaz");
	if(!$con)
	{
		echo "<script language=\"JavaScript\">
			 alert('数据库连接失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}	
	$result = mysql_select_db ("db",$con);
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('选择数据库失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$result = mysql_query("SET NAMES 'utf8'");//！！！数据库中的字符集设置为gb2312，源代码中设置为utf8（把数据库中取出的中文正确显示，并且与源代码中的中文进行比较），两边才能正确转换中文！！！
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('设置字符集失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$query = "select status
			  from phonedetail
			  where phonedetail.phoneNum = '$phoneNum' ";
	$result = mysql_query($query, $con);
	if($result) 
	{
		echo "<script language=\"JavaScript\">
			 alert('查询号码原状态成功！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";		
	} else {
		echo "<script language=\"JavaScript\">
			 alert('查询号码原状态失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$oldState = "正常开通";
	while($row = mysql_fetch_row($result))
	{
		$oldState = $row[0];
	}
	if($oldState == "主动撤机") {
		//echo "yes";
		return true;
	} else {
		//echo "no";
		return false;
	}
	mysql_close($con);
}
function userCancel($phoneNum)
{
	$oldStatus = checkUserStop($phoneNum);
	if($oldStatus)
	{
		echo "<script language=\"JavaScript\">
			 alert('该号码原状态已是主动撤机，您不必办理该业务！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='customer_userCancel1Window.php'";
		echo "</script>";
		return;
	}
	$con = mysql_connect("localhost", "root", "1qaz");
	if(!$con)
	{
		echo "<script language=\"JavaScript\">
			 alert('数据库连接失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}	
	$result = mysql_select_db ("db",$con);
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('选择数据库失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$result = mysql_query("SET NAMES 'utf8'");
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('设置字符集失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$query = "update phonedetail
			  set status = \"主动撤机\"
			  where phonedetail.phoneNum = '$phoneNum' ";
	$result = mysql_query($query, $con);
	if($result) 
	{
		echo "<script language=\"JavaScript\">
			 alert('主动撤机办理成功！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	} else {
		echo "<script language=\"JavaScript\">
			 alert('主动撤机办理失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	mysql_close($con);
}

//userCancel("15801116820");
userCancel($_POST["phoneNum"]);

?>

</body>
</html>