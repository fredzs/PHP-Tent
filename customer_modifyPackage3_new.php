<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>号码套餐变更</title>
</head>

<?php
function modifyPackage($phoneNum, $newPackNum)
{
	//$phoneNum = "15801116820";//////////////////////
	//echo "全局session变量：", $phoneNum, "<br>";
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
			 alert('设置utf8字符集失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	
	$query = "select count(*)
			  from nextselection
			  where nextselection.phoneNum = '$phoneNum' ";
	$result = mysql_query($query, $con);
	if($result) 
	{
		echo "<script language=\"JavaScript\">
			 alert('查询该号码是否存在成功！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	} else {
		echo "<script language=\"JavaScript\">
			 alert('查询该号码是否存在失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$count = -1;//要初始化！
	while($row = mysql_fetch_row($result))
	{
		$count = $row[0];
	}
	//echo "count = ", $count;
	if($count == 0)//count = 0
	{
		echo "<script language=\"JavaScript\">
			 alert('该号码本月还未修改过套餐，现在系统将更新您的选择！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		
		$query = "insert into nextselection
			      select '$phoneNum', '$newPackNum' ";
		//$query = "insert into nextselection
//			  	  values('$phoneNum', '$newPackNum')";
		$result = mysql_query($query, $con);
		//日期时间：
		//echo date("Y-m-d H:i:s"), "<br>";
		//日期：
		//$nowTime = date("Y-m-d");
		//echo $nowTime, "<br>";
		
		if($result) 
		{
			echo "<script language=\"JavaScript\">
			 	alert('号码套餐修改成功！');  
			 	</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
		} else {
			echo "<script language=\"JavaScript\">
			 	alert('号码套餐修改失败！');  
			 	</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
			return;
		}
	}
	else//count > 0
	{
		echo "<script language=\"JavaScript\">
			 alert('该号码本月已修改过套餐且未生效，现在系统将更新您的选择！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		
		$query = "update nextselection
			      set packNum = '$newPackNum'
			      where nextselection.phoneNum = '$phoneNum' ";
		$result = mysql_query($query, $con);
		//日期时间：
		//echo date("Y-m-d H:i:s"), "<br>";
		//日期：
		//$nowTime = date("Y-m-d");
		//echo $nowTime, "<br>";
		if($result) 
		{
			echo "<script language=\"JavaScript\">
			 	alert('号码套餐修改成功！');  
			 	</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
		} else {
			echo "<script language=\"JavaScript\">
			 	alert('号码套餐修改失败！');  
			 	</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
			return;
		}
	}

	
	mysql_close($con);
}
//modifyPackage("15801116820", $_POST["packNum"]);
session_start();
modifyPackage($_SESSION["phoneNum"], $_POST["packNum"]);
?> 


<body>
</body>
</html>