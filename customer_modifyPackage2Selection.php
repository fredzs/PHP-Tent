<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>号码套餐选择界面</title>
<?php
	session_start();
	$_SESSION["phoneNum"] = $_POST["phoneNum"];
?>
</head>

<body>
<p>请在下拉列表中选择您想要的套餐编号（01、02、03、04、05）。</p>
<a href="policy.php" target="_blank">查看套餐介绍</a>
<p></p>
<form action="customer_modifyPackage3_new.php" name="form_modifyPackageSelection"  method="post" >
	<div class="item">套餐编号：
    <select name="packNum" id="packNum">
  		<option value="01" selected="selected" >01</option>
  		<option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
 	</select>
	</div>
    <p>
  	<input type="submit" name="submit" id="button_submit" value="确认" />
	</p>
</form>

</body>
</html>