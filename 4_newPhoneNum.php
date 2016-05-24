<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>号码新装</title>
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>
<?php $phoneNum = $_SESSION["phoneNum"]; ?>
<h2 align="center">号码新装</h2>
<p>尊敬的用户：</p><!--这里最好将用户名输出出来-->
<p>您将开通的号码为 <?php echo $phoneNum ?></p>
<p>请在此填好信息以及开户预付金额: </p>
<p>
<form action="5_newPhoneNum_success.php" method="post" >
<p>套餐选择 &nbsp;  <select name="package">
<option value="01">包月市话套餐</option>
<option value="02">包月短信套餐</option>
<option value="03">市话五折套餐</option>
<option value="04">低价月租套餐</option>
<option value="05">长途五折套餐</option>
</select></p>
<p>预存话费 &nbsp; <select name="money">
<option value=30>30元</option>
<option value=50>50元</option>
<option value=100>100元</option>
</select></p>
<input type="submit" name="submit" id="submitButton" value="提交" onclick="window.location.href='5_newPhoneNum_success.php'">
</form>
</p>

</body>
</html>
