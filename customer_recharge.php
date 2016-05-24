<?php session_start();?>
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
   if(G('payment').value == '')
   {
	alert("充值金额不能为空！");
	G('payment').focus();
	return false;
   }
}
</script>
</head>

<body>

<form action="customer_recharge_check.php" method="post" name="form1" onSubmit="return check()">
  <p>&nbsp;</p>

<?php 	
	@$credNum=$_SESSION['credNum'];
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db ("db",$con);	
	$ssql= "select phoneNum from phonedetail where credNum=".$_SESSION['credNum'];
	$tr2 = mysql_query($ssql,$con)or die("Invalid query: " . mysql_error());	
	while ( $prow = mysql_fetch_row($tr2) )
	{ 
		$numset[] = $prow;
	}
?>
<p>用户号码：&nbsp;
  <select name="user_phone">
<?php 
	foreach($numset as $numr)
	{
		echo "<option value='$numr[0]'>$numr[0]</option>";
	} 
?>
</select>
</p>
<p> 充值金额：
  <input type="text" name="payment" size="30" maxlength="40" id="payment">
</p>
<p>
  <input type="submit" name="submit" id="button" value="充值" />
  <input type="reset" name="reset" id="button2" value="重置" /> 
</p>
</form>

</body>
</html>