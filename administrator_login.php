<html>
<head>
	<title> 综合营帐管理员登陆 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}
function check()
{
   if(G('admin_name').value == '')
   {
	alert("账号不能为空！");
	G('admin_name').focus();
	return false;
   }
   if(G('admin_password').value == '')
   {
	alert("密码不能为空！");
	G('admin_password').focus();
	return false;
   }
}
</script>
</head>

<body>
<form action="administrator_check.php" method="post" name="form1" onSubmit="return check()">

<p align="center">&nbsp;</p>
<p align="center">管理员账号：
  <input type="username" name="admin_name" id="admin_name" size="30" maxlength="40">
</p>
<p align="center"> 管理员密码：
  <input type="password" name="admin_password" id="admin_password" size="30" maxlength="40">
</p>
<p align="center">
  <input type="submit" name="submit" id="button" value="登陆" />
  <input type="reset" name="reset" id="button2" value="重置" /> 
</p>
</form>



</body>
</html>