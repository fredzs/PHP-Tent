<html>
<head>
	<title> 综合营帐主页充值 </title> 
    <meta charset="utf-8">
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}
function check()
{
   if(G('user_phone').value == '')
   {
	alert("号码不能为空！");
	G('user_phone').focus();
	return false;
   }
   if(G('user_phone2').value == '')
   {
	alert("号码不能为空！");
	G('user_phone2').focus();
	return false;
   }
    if(G('user_phone').value != G('user_phone2').value)
   {
	alert("两次输入号码不相同！");
	G('user_phone').focus();
	return false;
   }
   if(G('payment').value == '')
   {
	alert("号码不能为空！");
	G('payment').focus();
	return false;
   }
   if(G('code').value == '')
   {
	alert("验证码不能为空！");
	G('code').focus();
	return false;
   }
}
</script>
</head>

<body>

<form action="recharge_check.php" method="post" name="form1" onSubmit="return check()">
  <p>充值号码：
  <input type="text" name="user_phone" size="30" maxlength="40" id="user_phone">
</p>
<p> 重复号码：
  <input type="text" name="user_phone2" size="30" maxlength="40" id="user_phone2">
</p>
<p> 充值金额：
  <input type="text" name="payment" size="30" maxlength="40" id="payment">
</p>
<p>验证码 ：         
  <input type="text" name="code" size="30" maxlength="40"  id="code">
</p>
  <img id="siimage" width="160" height="85" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid(time()));?>">
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="./imgs/refresh.png" alt="Reload Image" width="36" height="38" onClick="this.blur()" align="bottom" border="0"></a>

<p>
  <input type="submit" name="submit" id="button" value="充值" />
  <input type="reset" name="reset" id="button2" value="重置" /> 
</p>
</form>

</body>
</html>