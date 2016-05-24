<html>
<head>
	<title> 通信模拟 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<p> 本地通话 </p>
<form action="./simulate_process.php" method="get">
  <p>本机号码: <input type="text" name="number1" /> 对方号码：<input type="text" name="number2"/></p>
  <p>通话时间（s）: <input type="text" name="time" /><input type="submit" value="本地拨号" name="提交"/></p>
</form>

<p> 发送短信 </p>
<form action="./simulate_process.php" method="get">
  <p>本机号码: <input type="text" name="number1" /> 对方号码：<input type="text" name="number2"/></p>
  <input type="submit" value="发送" name="提交"/>
</form>

<p> 国内长途通话 </p>
<form action="./simulate_process.php" method="get">
  <p>本机号码: <input type="text" name="number1" /> 对方号码：<input type="text" name="number2"/></p>
  <p>通话时间（s）: <input type="text" name="time" /><input type="submit" value="长途拨号" name="提交"/></p>
  
</form>

</body>
</html>