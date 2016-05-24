<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户资料变更</title>
</head>

<?php
function modifyUserInfo($userName) 
{
	//echo "session变量：", $_SESSION["name"], "<br>";
	//echo "form:   ", $_POST["password"], " ", $_POST["email"], " ", $_POST["birthDate"], " ", $_POST["city"], "<br>";
	
	@$password = $_POST["password"];
	@$email = $_POST["email"];
	@$birthDate = $_POST["birthDate"];
	@$city = $_POST["city"];
	
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
	$query = "select password, email, birthDate, city 
	          from user 
			  where user.userNam = '".$userName."' ";
	//echo $query;
	$result = mysql_query($query, $con)or die("Invalid query: " . mysql_error());
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('查询原用户信息失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	
	$newPassword = $password;
	$newEmail = $email;
	$newbirthDate = $birthDate;
	$newCity = $city;
	while($row = mysql_fetch_row($result))
	{
		echo "用户原信息为： ", $row[0], " ", $row[1], " ", $row[2], " ", $row[3], "<br>";
		$oidPassword = $row[0];
		if(($oidPassword != @$password) && (!empty($_POST["password"])))
		{
			$newPassword = @$password;
		} else {
			$newPassword = $oidPassword;
		}
		
		$oidEmail = $row[1];
		if(($oidEmail != @$email) &&  (!empty($_POST["email"])))
		{
			$newEmail = @$email;
		} else {
			$newEmail = $oidEmail;
		}
		
		$oidbirthDate = $row[2];
		if(($oidbirthDate != @$birthDate) && (!empty($_POST["birthDate"])))
		{
			$newbirthDate = @$birthDate;
		} else {
			$newbirthDate = $oidbirthDate;
		}
		
		$oidCity = $row[3];
		if(($oidCity != @$city) && (!empty($_POST["city"])))
		{
			$newCity = @$city;
		} else {
			$newCity = $oidCity;
		}
	}
	
	echo "待更新信息为： ", $newPassword, "  ", $newEmail, "  ", $newbirthDate, "  ", $newCity, "<br>";
	
	$result = mysql_query("update user 
						   set user.password = '$newPassword'
						   where user.userNam= '".$userName."' ", $con)
			  or die("Invalid query: " . mysql_error());
	$result = mysql_query("update user
	                       set user.email = '$newEmail'
						   where user.userNam = '$userName' ")
			  or die("Invalid query: " . mysql_error());
	$result = mysql_query("update user
	                       set user.birthDate = '$newbirthDate'
						   where user.userNam = '$userName' ")
			  or die("Invalid query: " . mysql_error());
	$result = mysql_query("update user
	                       set user.city = '$newCity'
						   where user.userNam = '$userName' ")
			  or die("Invalid query: " . mysql_error());
	/////////////////////////////////////////////////////
	if($result) 
	{
		echo "<script language=\"JavaScript\">
			 alert('用户信息修改成功！');  
			 </script>";
		echo "<scripst language='javascript' type='text/javascript'>";
		//echo "window.location.href='$url'";
		echo "</script>";
	} else {
		echo "用户信息修改失败".mysql_error();
		echo "<script language=\"JavaScript\">
			 alert('用户信息修改失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		//echo "window.location.href='$url'";
		echo "</script>";
	}
	
	mysql_close($con);
}

modifyUserInfo($_SESSION["name"]);
?>

<body>
</body>
</html>