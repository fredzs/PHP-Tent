<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购买号码成功</title>
</head>

<body>
<!--这里应该改成，php处理完phonedetail的insert，
apprecord的insert；
然后再用php打印？-->
<?php 
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF-8'");
	mysql_select_db ("db",$con)or die("Invalid query: " . mysql_error());	
	$phoneNum=$_SESSION["phoneNum"];
	$package=$_POST["package"];
	$money=$_POST["money"];
	$date_time_array = getdate (time()); 
	$year = $date_time_array["year"]; 
	$month = $date_time_array["mon"];
	$day = $date_time_array["mday"];
	$hour = $date_time_array["hours"] + 8;
	$minute = $date_time_array["minutes"];
	$second = $date_time_array["seconds"];
	$timestamp_begin = mktime($hour, $minute, $second, $month, $day, $year);
	$appDate = $year . "-" . $month . "-" . $day;
	/*mysql_query("insert into textdetail values (" . $send_ID . "," . $sender . "," . $sender . "," . $send_time . "," . $fee . "," . $send_date . "," . $sender . ")", $con);*//*这段注释是参考*/
	$result = mysql_query("select count(*) from apprecord", $con);
	$row = mysql_fetch_array($result);
	$appNum =  ($row[0] + 1) % 99999999;
	$account = $_SESSION['account'];
	$sql = "select credNum from user where account = '".$account."'";
	
	$result = mysql_query($sql, $con);
	$row = mysql_fetch_array($result);
	$credNum = $row[0];
	$account = $_SESSION['account'];
	$sql = "select credType from user where account = '".$account."'";
	$result = mysql_query($sql, $con);
	$row = mysql_fetch_array($result);
	
	if ($row[0] == "身份证")
	{
		$credType = 1;
	}
	else if ($row[0] == "护照")
	{
		$credType = 2;
	}
	else
	{
		$credType = 3;
	}
	$sqlll ="insert into phonedetail values ('" . $phoneNum . "', 1," . $money . ",'" . $appDate . "','" . $credNum . "','" . $credType. "')";
	mysql_query($sqlll,$con)or die("Invalid query: " . mysql_error());
	$sqll ="insert into apprecord values (" . $appNum . " , '" . $appDate . "' , 1, " . $phoneNum . "," . $credNum . "," . $credType . ")";
	mysql_query($sqll,$con)or die("Invalid query: " . mysql_error());
	mysql_query("insert into selection values (" . $phoneNum . " , '" . $package  . "')",$con)or die("Invalid query: " . mysql_error());
	$sql = "select count(*) from paymentrecord";
	
	$result = mysql_query($sql, $con);
	$row = mysql_fetch_array($result);
	$count = ($row[0] + 1) % 99999999;
	mysql_query("insert into paymentrecord values (" . $count . " , '" . $phoneNum . "', 2, ". $money . "," . $credNum . "," . $credType .")",$con)or die("Invalid query: " . mysql_error());
	/*填写业务申请单，apprecord*/
  /*appNum,appDate,appType('开户'),phoneNum = $phoneNum, credNum, credType*/
	
	/*向phonedetail插入新的号码*/
	/*phoneNum = $phoneNum, status = '正常开通', balance = $money, openDate, credNum,credType*/
	mysql_close($con);
?>
<h3>恭喜！购买号码成功！</h3>
<p>尊敬的用户：</p>
<p>您的新号码为<?php echo $_SESSION["phoneNum"] ?>。</p>
<p>您选择的套餐为：
<?php
	switch ($package) 
	{
		case "01":
		{
			echo "包月市话套餐";
			break;
		}
		case "02":
		{
			echo "包月短信套餐";
			break;
		}
		case "03":
		{
			echo "市话五折套餐";
			break;
		}
		case "04":
		{
			echo "低价月租套餐";
			break;
		}
		case "05":
		{
			echo "长途五折套餐";
			break;
		}
	}
?>
</p>
<p>您预存的话费为：
<?php 
	switch ($money)
	{
		case 30:
		{
			echo "30元";
			$balance = 30;
			break;
		}
		case 50:
		{
			echo "50元";
			$balance = 50;
			break;
		}
		case 100:
		{
			echo "100元";
			$balance = 100;
			break;
		}
	}
?>
</p>
</body>
</html>