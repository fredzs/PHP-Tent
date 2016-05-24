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
<!--phoneNum 怎么办 不会怎么传回去-->
<?php
	
?>
	<h3 align="center">号码使用协议</h3>
    <p>尊敬的用户：</p>
    <p>您好！请您在继续下一步操作之前，仔细阅读以下协议：</p>
    <p>1.该号码使用权在协议签订之后，归用户所有。
    </p>
    <p>2.本公司有权对该号码的使用，按照网站上给出的方案收取费用，只要用户同意该协议，即同意本公司的此项权利。
    </p>
    <p>3.所有解释权归本公司所有。</p>
<form action="#" method="get" name="formSelectPhoneNum" title="我同意" onclick="window.location.href='4_newPhoneNum.php'">

    <input type="button" name="submit" id="AgreeButton" value="我同意">
  
   </form>
   
<form action="#" method="get" name="formSelectPhoneNum" title="我不同意" onclick="window.location.href='policy.php'">
<input type="button" name="submit" id="NotAgreeButton" value="我不同意">
</form> <!--不同意的话就跳回到初始页面-->
</body>
</html>
