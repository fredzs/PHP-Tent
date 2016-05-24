<?php session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主动停机界面</title>
<script type="text/javascript">
function G(id){
   return document.getElementById(id);	
}

function checkPhoneNumNotNull()
{
   if(G('phoneNum').value == '')
   {
	alert("手机号码不能为空！");
	G('phoneNum').focus();
	return false;
   } 
}
</script>

<?php
	
	@$username = $_SESSION["name"];
	$con = mysql_connect("localhost", "root", "1qaz");
	if(!$con)
	{
		echo "<script language=\"JavaScript\">
			 alert('数据库连接失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}	
	$result = mysql_select_db ("db",$con);
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('选择数据库失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$result = mysql_query("SET NAMES 'utf8'");
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('设置utf8字符集失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$query = "select credType, credNum
			  from user
			  where user.userNam = '$username' ";
	$result = mysql_query($query, $con);
	while($row = mysql_fetch_row($result))
	{
		$credType = $row[0];
		$credNum = $row[1];
	}
	//echo $credType, $credNum, "<br>";
	
	$query2 = "select phoneNum
			   from phonedetail
			   where phonedetail.credType = '$credType' and
			         phonedetail.credNum = '$credNum' ";
	$result = mysql_query($query2, $con);
	while($row = mysql_fetch_row($result))
	{
		$allPhones[] = $row;
	}
	//echo "allPhones[]: ", $allPhones[0][0], " ", $allPhones[1][0],  " ", $allPhones[2][0], "<br>";	
	mysql_close($con);
?>
</head>

<body>
<P><?php echo $_SESSION["name"]; ?>，您好！请在下拉列表中选择您办理主动停机的用户号码：</P>
<form action="customer_userStop2.php" name="form_userStopWindow"	method="post" onSubmit="return checkPhoneNumNotNull()">
	<!--<div class="item">手机号码：
	<input type="text" value="" class="text" name="phoneNum" id="phoneNum"/>-->
    用户号码：
    <select name="phoneNum" id="phoneNum">
    <?php
    	foreach($allPhones as $phoneNum)
		{
			echo "<option value='$phoneNum[0]'>$phoneNum[0]</option>";
		}
	?>
    </select>
	<!--</div>-->
    <p>
  	<input type="submit" name="submit" id="button_submit" value="确认" />
	</p>
</form>

</body>
</html>