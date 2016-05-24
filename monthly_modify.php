<html>
<head>
	<title> 每月扣费模拟 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<form action="#" method="get">
<p> 本页面主要模拟的是每月扣费的过程 以免在测试中看不到月底扣费的过程 </p>
  <p><input type="submit" value="月底 收租！" name="submit"/></p>
  
</form>

<?php
if (!empty($_GET['submit']))
{
	$con = mysql_connect("localhost","root","1qaz");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db ("db",$con);
	$sql = "update phonedetail set balance = balance - (select package.monthCost from package,selection where (phonedetail.phoneNum = selection.phoneNum and selection.packNum = package.packNum))";
	mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
	echo "月租扣费完成！";
	$sql = "select phoneNum from phonedetail where status = '正常开通' and balance < 0";
	$result = mysql_query($sql,$con);
	while($row = mysql_fetch_array($result))
	{
		mysql_query("update phonedetail set status = 4 where phoneNum = " . $row[0] ,$con)or die("Invalid query: " . mysql_error());
	}
	$sql = "select * from nextselection";
	$result = mysql_query($sql,$con);
	while($row = mysql_fetch_array($result))
	{
		mysql_query("update selection set packNum = '" . $row[1]. "' where phoneNum = " . $row[0] ,$con)or die("Invalid query: " . mysql_error());
		mysql_query("delete from nextselection where phoneNum = " . $row[0] ,$con)or die("Invalid query: " . mysql_error());
	}
	$date_time_array = getdate (time()); 
	$year = $date_time_array["year"]; 
	$month = $date_time_array["mon"];
	$day = $date_time_array["mday"];
	$hour = $date_time_array["hours"] + 8;
	$minute = $date_time_array["minutes"];
	$second = $date_time_array["seconds"];
	$timestamp_begin = mktime($hour, $minute, $second, $month, 0, $year);
	$timestamp_end = mktime($hour, $minute, $second, $month, $day, $year);
	$result = mysql_query("select count(*) from cycledetail" ,$con)or die("Invalid query: " . mysql_error());
	$row = mysql_fetch_array($result);
	$count = $row[0];
	$result = mysql_query("select phoneNum from phonedetail" ,$con)or die("Invalid query: " . mysql_error());
	$date = $year."-".$month."-".$day;
	
	$date_time_array = getdate ($timestamp_begin); 
	$year1 = $date_time_array["year"]; 
	$month1 = $date_time_array["mon"];
	$day1 = $date_time_array["mday"];
	
	$date_time_array = getdate ($timestamp_end); 
	$year2 = $date_time_array["year"]; 
	$month2 = $date_time_array["mon"];
	$day2 = $date_time_array["mday"];
	
	$date1 = $year1."-".$month1."-".$day1;
	$date2 = $year2."-".$month2."-".$day2;
	while($row = mysql_fetch_array($result))
	{
		$count = ($count + 1) % 99999999;
		$sql = "select sum(cost) as longDisTotalCost from calldetail where callType = '长话' and callDate >= '".$date1."' and callDate <=  '".$date2."' and phoneNum = ".$row[0];
		
		$a = mysql_query($sql, $con);
		$b = mysql_fetch_array($a);
		$longCost = $b[0];
		if ($longCost == "")
		{
			$longCost = 0;
		}
		$sql = "select sum(cost) as localTotalCost from calldetail where callType = '市话' and callDate >=  '".$date1."' and callDate <= '".$date2."' and phoneNum = ".$row[0];
		echo $sql;
		$a = mysql_query($sql, $con);
		$b = mysql_fetch_array($a);
		$localCost = $b[0];
		if ($localCost == "")
		{
			$localCost = 0;
		}
		$sql = "select sum(cost) as textTotalCost from textdetail where sendDate >= '".$date1."' and sendDate <=  '".$date2."' and phoneNum = ".$row[0];
		$a = mysql_query($sql, $con);
		$b = mysql_fetch_array($a);
		$textCost = $b[0];
		if ($textCost == "")
		{
			$textCost = 0;
		}
		$sql = "select monthCost from package, selection where package.packNum=selection.packNum and phoneNum = ".$row[0];
		$a = mysql_query($sql, $con);
		$b = mysql_fetch_array($a);
		$monthCost = $b[0];
		if ($monthCost == "")
		{
			$monthCost = 0;
		}
		$totalCost = $localCost + $longCost + $textCost + $monthCost;
		$sql = "insert into cycledetail values( ".$count.",'".$date."',". $localCost .",". $longCost.",".$textCost.",".$monthCost.",".$totalCost.",".$row[0].")";
		mysql_query($sql, $con)or die("Invalid query: " . mysql_error());
	}
}
?>
</body>
</html>