<html>
<head>
	<title> �ۺ�Ӫ���û���½ </title> 
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}
function check()
{
   if(G('user_name').value == '')
   {
	alert("�˺Ų���Ϊ�գ�");
	G('user_name').focus();
	return false;
   }
   if(G('user_password').value == '')
   {
	alert("���벻��Ϊ�գ�");
	G('user_password').focus();
	return false;
   }
   if(G('code').value == '')
   {
	alert("��֤�벻��Ϊ�գ�");
	G('code').focus();
	return false;
   }
}
</script>
</head>

<body>

<marquee direction="up" height="80" width="250" scrollamount="2" behavior="scroll"  style="border:solid 2px #F60" onMouseMove="this.stop()"     onmouseout="this.start()">
<p>�𾴵��û����ã���ӭʹ������Ӫҵ���������������˺��Լ��ͷ������½�����û���ѡ��ע�ᡣ </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</marquee>
<a href="customer_regist.php"> <img src="imgs/regist.jpg" width="200" height="50"></a>

<form action="customer_check.php" method="post" name="form1" onSubmit="return check()">
  <p>�û��˺ţ�
  <input type="text" name="user_name" size="30" maxlength="40" id="user_name">
</p>
<p> �ͷ����룺
  <input type="password" name="user_password" size="30" maxlength="40" id="user_password">
</p>
<p>��֤�� ��         
  <input type="text" name="code" size="30" maxlength="40"  id="code">
</p>
  <img id="siimage" width="160" height="85" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid(time()));?>">
<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="./imgs/refresh.png" alt="Reload Image" width="36" height="38" onclick="this.blur()" align="bottom" border="0"></a>

<p>
  <input type="submit" name="submit" id="button" value="��½" />
  <input type="reset" name="reset" id="button2" value="����" /> 
</p>
</form>

</body>
</html>