<html>
<head>
	<title> 通信模拟管理 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<?php
	$con = mysql_connect("localhost","root","1qaz");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db ("db",$con);
	$result = mysql_query("select status from phonedetail where phoneNum = " . $_GET["number1"], $con);
	$row = mysql_fetch_array($result);
	$status = $row[0];
	if ($status == "紧急停机" || $status == "主动停机" || $status == "主动撤机")
	{
		echo "<p>您的号码因某些原因已停机，可能是由于您因欠费已停机，也可能是您主动要求的停机或您已经撤机</p>";
		echo "<p>如有问题请联系当地服务商</p>";
	}
	else if ($_GET["提交"] == "本地拨号")
	{
		$string="<p> 您的号码为: ".$_GET["number1"]."</p>";
		echo "$string";
		$string="<p> 对方号码为: ".$_GET["number2"]."</p>";
		echo "$string";
	
		$con = mysql_connect("localhost","root","1qaz");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		$result = mysql_query("select balance from phonedetail where phoneNum = " . $_GET["number1"], $con);
		$row = mysql_fetch_array($result);
		$balance = $row['balance'];
		if ($balance > 0)
		{
			$result = mysql_query("select localCost from package where packNum = ( select packNum from selection where phoneNum = " . $_GET["number1"] . ")", $con);
			$row = mysql_fetch_array($result);
			$package = $row[0];
			$fee = (($_GET["time"] - $_GET["time"] % 60) / 60 + 1) * $package;
			
			mysql_query("update phonedetail set balance = " . ($balance - $fee) . "where phoneNum = " . $_GET["number1"], $con);
			$date_time_array = getdate (time()); 
			$year = $date_time_array["year"]; 
			$month = $date_time_array["mon"];
			$day = $date_time_array["mday"];
			$hour = $date_time_array["hours"] + 8;
			$minute = $date_time_array["minutes"];
			$second = $date_time_array["seconds"];
			$timestamp_begin = mktime($hour, $minute, $second, $month, $day, $year);
			$timestamp_end = mktime($hour, $minute, $second + $_GET["time"], $month, $day, $year);
			
			$result = mysql_query("select count(*) from calldetail", $con);
			$row = mysql_fetch_array($result);
			$call_ID_old = $row[0];
			$call_ID =  ($row[0] + 1) % 999999999;
			

			$caller = $_GET["number1"];
			$reciever = $_GET["number2"];
			
			$call_date = $year . "-" . $month . "-" . $day;
			
			echo "<p> 拨号日期" . $call_date . "</p>";
			
			$start_time = $hour . ":" . $minute . ":" . $second;
			echo "<p> 拨号时间" . $start_time . "</p>";
			
			$date_time_array_new = getdate ($timestamp_end);
			$hour_new = $date_time_array_new["hours"];
			$minute_new = $date_time_array_new["minutes"];
			$second_new = $date_time_array_new["seconds"];
			
			$end_time = $hour_new . ":" . $minute_new . ":" . $second_new;
			mysql_query("insert into calldetail values (" . $call_ID . "," . "1,'" . $call_date . "'," . $caller . "," . $reciever . "," . $fee . ",'" . $start_time . "','" . $end_time . "'," . $caller . ")", $con);
			
			$result = mysql_query("select count(*) from calldetail", $con);
			$row = mysql_fetch_array($result);
			$call_ID_new = $row[0];
			if ($call_ID_new == $call_ID_old)
			{
				echo "<p> 通话失败 请检查对方号码是否正确</p>";
			}
			else
			{
				echo "<p>拨号成功</p>";
				if ($fee != 0)
				{
					$string = "本次通话花费为" . $fee . "元 余额" . ($balance - $fee) . "元";
				}
				else
				{
					$string = "本次通话免费";
				}
				echo $string;
				if (($balance - $fee) <= 0)
				{
					mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
					echo "<p>您的话费不足 已停机</p>";
				}
				$string="<p> 通话时间为: ".$_GET["time"]."</p>";
				echo "$string";
			}
		}
		else if (empty($balance))
		{
			echo "<p>您的号码是空号</p>";
		}
		else
		{
			mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
			echo "<p>您的账户余额不足</p>";
		}
	//根据号码select余额 若余额大于0则通话 写入通话时间和通话后余额
    }
    else if ($_GET["提交"] == "发送")
    {
		$string="<p> 您的号码为: ".$_GET["number1"]."</p>";
		echo "$string";
		$string="<p> 对方号码为: ".$_GET["number2"]."</p>";
		echo "$string";
	
		$con = mysql_connect("localhost","root","1qaz");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		$result = mysql_query("select balance from phonedetail where phoneNum = " . $_GET["number1"]);
		$row = mysql_fetch_array($result);
		$balance = $row[0];
		if ($balance > 0)
		{
			$result = mysql_query("select textCost from package where packNum = ( select packNum from selection where phoneNum = " . $_GET["number1"]. ")", $con);
			$row = mysql_fetch_array($result);
			$package = $row[0];
			$fee = $package;
			
			mysql_query("update phonedetail set balance = " . $balance - $fee . "where phoneNum = " . $_GET["number1"], $con);
			$date_time_array = getdate (time()); 
			$year = $date_time_array["year"]; 
			$month = $date_time_array["mon"];
			$day = $date_time_array["mday"];
			$hour = $date_time_array["hours"] + 8;
			$minute = $date_time_array["minutes"];
			$second = $date_time_array["seconds"];
			$timestamp_begin = mktime($hour, $minute, $second, $month, $day, $year);
			
			$result = mysql_query("select count(*) from textdetail", $con);
			$row = mysql_fetch_array($result);
			$send_ID_old = $row[0];
			$send_ID =  ($row[0] + 1) % 999999999;
			
			$sender = $_GET["number1"];
			$reciever = $_GET["number2"];
			
			$send_date = $year . "-" . $month . "-" . $day;
			
			$send_time = $hour . ":" . $minute . ":" . $second;
			
			echo "<p> 短信发送日期" . $send_date . "</p>";
			
			echo "<p> 短信发送时间" . $send_time . "</p>";
			
			mysql_query("insert into textdetail values (" . $send_ID . "," . $sender . "," . $reciever . ",'" . $send_time . "'," . $fee . ",'" . $send_date . "'," . $sender . ")", $con);
			
			$result = mysql_query("select count(*) from textdetail", $con);
			$row = mysql_fetch_array($result);
			$send_ID_new = $row[0];
			if ($send_ID_new == $send_ID_old)
			{
				echo "<p> 发送失败 请检查对方号码是否正确</p>";
			}
			else
			{
				echo "<p>短信发送成功</p>";
				if ($fee != 0)
				{
					$string = "本次短信发送花费" . $fee . "元 余额" . ($balance - $fee) . "元";
				}
				else
				{
					$string = "本次发送免费";
				}
				echo $string;
				if (($balance - $fee) <= 0)
				{
					mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
					echo "<p>您的话费不足 已停机</p>";
				}
			}
		}
		else if (empty($balance))
		{
			echo "<p>您的号码是空号</p>";
		}
		else
		{
			echo "<p>您的账户余额不足</p>";
			mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
		}
    }
	else if ($_GET["提交"] == "长途拨号")
	{
		$string="<p> 您的号码为: ".$_GET["number1"]."</p>";
		echo "$string";
		$string="<p> 对方号码为: ".$_GET["number2"]."</p>";
		echo "$string";
	
		$con = mysql_connect("localhost","root","1qaz");

		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		$result = mysql_query("select balance from phonedetail where phoneNum = " . $_GET["number1"], $con);
		$row = mysql_fetch_array($result);
		$balance = $row['balance'];
		if ($balance > 0)
		{
			$result = mysql_query("select longDisCost from package where packNum = ( select packNum from selection where phoneNum = " . $_GET["number1"] . ")", $con);
			$row = mysql_fetch_array($result);
			$package = $row[0];
			$fee = (($_GET["time"] - $_GET["time"] % 60) / 60 + 1) * $package;
			
			mysql_query("update phonedetail set balance = " . ($balance - $fee) . "where phoneNum = " . $_GET["number1"], $con);
			$date_time_array = getdate (time()); 
			$year = $date_time_array["year"]; 
			$month = $date_time_array["mon"];
			$day = $date_time_array["mday"];
			$hour = $date_time_array["hours"] + 8;
			$minute = $date_time_array["minutes"];
			$second = $date_time_array["seconds"];
			$timestamp_begin = mktime($hour, $minute, $second, $month, $day, $year);
			$timestamp_end = mktime($hour, $minute, $second + $_GET["time"], $month, $day, $year);
			
			$result = mysql_query("select count(*) from calldetail", $con);
			$row = mysql_fetch_array($result);
			$call_ID_old = $row[0];
			$call_ID =  ($row[0] + 1) % 999999999;

			$caller = $_GET["number1"];
			$reciever = $_GET["number2"];
			
			$call_date = $year . "-" . $month . "-" . $day;
			
			echo "<p> 拨号日期" . $call_date . "</p>";
			
			$start_time = $hour . ":" . $minute . ":" . $second;
			echo "<p> 拨号时间" . $start_time . "</p>";
			
			$date_time_array_new = getdate ($timestamp_end);
			$hour_new = $date_time_array_new["hours"];
			$minute_new = $date_time_array_new["minutes"];
			$second_new = $date_time_array_new["seconds"];
			
			$end_time = $hour_new . ":" . $minute_new . ":" . $second_new;
			mysql_query("insert into calldetail values (" . $call_ID . "," . "2,'" . $call_date . "'," . $caller . "," . $reciever . "," . $fee . ",'" . $start_time . "','" . $end_time . "'," . $caller . ")", $con);
			
			$result = mysql_query("select count(*) from calldetail", $con);
			$row = mysql_fetch_array($result);
			$call_ID_new =  $row[0];
			if ($call_ID_new == $call_ID_old)
			{
				echo "<p> 通话失败 请检查对方号码是否正确</p>";
			}
			else
			{
				echo "<p>拨号成功</p>";
				if ($fee != 0)
				{
					$string = "本次通话花费为" . $fee . "元 余额" . ($balance - $fee) . "元";
				}
				else
				{
					$string = "本次通话免费";
				}
				echo $string;
				if (($balance - $fee) <= 0)
				{
					mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
					echo "<p>您的话费不足 已停机</p>";
				}
				$string="<p> 通话时间为: ".$_GET["time"]."</p>";
	echo "$string";
			}
		}
		else if (empty($balance))
		{
			echo "<p>您的号码是空号</p>";
		}
		else
		{
			echo "<p>您的账户余额不足</p>";
			mysql_query("update phonedetail set status = 4 where phoneNum = " . $_GET["number1"], $con);
		}
	//根据号码select余额 若余额大于0则通话 写入通话时间和通话后余额
    }
?>
</body>
</html>