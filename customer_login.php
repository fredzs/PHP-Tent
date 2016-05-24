<html>
<head>
	<title> 综合营帐用户登陆 </title> 
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}
function check()
{
   if(G('user_name').value == '')
   {
	alert("账号不能为空！");
	G('user_name').focus();
	return false;
   }
   if(G('user_password').value == '')
   {
	alert("密码不能为空！");
	G('user_password').focus();
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

<marquee direction="up" height="80" width="250" scrollamount="2" behavior="scroll"  style="border:solid 2px #F60" onMouseMove="this.stop()"     onmouseout="this.start()">
<p>尊敬的用户您好，欢迎使用网上营业厅，请输入您的账号以及客服密码登陆。新用户请选择注册。 </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</marquee>
<a href="customer_regist.php"> <img src="imgs/regist.jpg" width="200" height="50"></a>

<form action="customer_check.php" method="post" name="form1" onSubmit="return check()">
  <p>用户账号：
  <input type="text" name="user_name" size="30" maxlength="40" id="user_name">
</p>
<p> 客服密码：
  <input type="password" name="user_password" size="30" maxlength="40" id="user_password">
</p>
<p>验证码 ：         
  <input type="text" name="code" size="30" maxlength="40"  id="code">
</p>
  <img id="siimage" width="160" height="85" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid(time()));?>">
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="./imgs/refresh.png" alt="Reload Image" width="36" height="38" onclick="this.blur()" align="bottom" border="0"></a>

<p>
  <input type="submit" name="submit" id="button" value="登陆" />
  <input type="reset" name="reset" id="button2" value="重置" /> 
</p>
</form>

</body>
</html>