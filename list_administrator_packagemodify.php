<html>
<head>
	<title> 套餐修改管理 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<?php
	if ($_GET["提交"] == "修改项目")
	{
		$string="<p> 套餐号: ".$_GET["number1"]."</p>";
		echo "$string";
		$string="<p> 月租: ".$_GET["number2"]."</p>";
		echo "$string";
		$string="<p> 本地话费: ".$_GET["number3"]."</p>";
		echo "$string";
		$string="<p> 短信费: ".$_GET["number4"]."</p>";
		echo "$string";
		$string="<p> 长途话费: ".$_GET["number5"]."</p>";
		echo "$string";
	
		$con = mysql_connect("localhost","root","1qaz");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		mysql_query("update package set monthCost = ". $_GET["number2"], $con) or die("Invalid query: " . mysql_error());
		mysql_query("update package set localCost = " . $_GET["number3"], $con) or die("Invalid query: " . mysql_error()); 
		mysql_query("update package set textCost = " . $_GET["number4"], $con) or die("Invalid query: " . mysql_error()); 
		mysql_query("update package set longDisCost = " . $_GET["number5"], $con) or die("Invalid query: " . mysql_error()); 
		echo "<p> 修改成功! </p>";
	}
    else if ($_GET["提交"] == "增加项目")
    {
		$string="<p> 套餐号: ".$_GET["number1"]."</p>";
		echo "$string";
		$string="<p> 月租: ".$_GET["number2"]."</p>";
		echo "$string";
		$string="<p> 本地话费: ".$_GET["number3"]."</p>";
		echo "$string";
		$string="<p> 短信费: ".$_GET["number4"]."</p>";
		echo "$string";
		$string="<p> 长途话费: ".$_GET["number5"]."</p>";
		echo "$string";
	
		$con = mysql_connect("localhost","root","1qaz");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db ("db",$con);
		mysql_query("insert into package values (". $_GET["number1"] . "," . $_GET["number2"] . ","  . $_GET["number3"] . "," . $_GET["number4"] . "," . $_GET["number5"] . ")", $con) or die("Invalid query: " . mysql_error());
			
		echo "<p>增添成功！</p>";
    }
?>
</body>
</html>