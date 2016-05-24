<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户资料变更界面</title>
<?php
	@$userName = $_SESSION["name"];//待修改：传递的会话变量
	//$userName = "傅荣蓉";
	//$_SESSION["name"] = $userName;
?>
<?php
function getGender($userName)
{
	$userName = $_SESSION["name"];
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
			 alert('设置字符集失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	$query = "select gender 
	          from user 
			  where user.userNam = '".$userName."' ";
	$result = mysql_query($query, $con) or die("Invalid query: " . mysql_error());
	if(!$result)
	{
		echo "<script language=\"JavaScript\">
			 alert('查询原用户性别失败！');  
			 </script>";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
		return;
	}
	while($row = mysql_fetch_row($result))
	{
		$gender = $row[0];
	}
	mysql_close($con);
	//echo "gender: ".$gender;
	return $gender;
}
$gender = getGender($_SESSION["name"]);
?>
</head>

<body>
<p>
<?php
	echo $_SESSION["name"];
?>
，您好！
</p>
<div class="index_title">
<!--<div>是块级元素，和段落元素<p>相似;不同的是两个<div>元素之间不会产生两个<p>元素之间的空行-->
<h3>基本信息<span class="W_textb"><i class="CH">(</i>&nbsp;<i class="CH" style="color:red;">*</i>&nbsp;为不可更改项，未填写为不更改项&nbsp;<i class="CH">)</i></span></h3>
<h4>以下信息将显示在<a href="转到查询客户资料的页面？？？">个人资料页</a>，方便大家了解你。</h4>
</div>

<form action="customer_modifyUserInfo2.php" method="post" name="form_modifyUserInfo">
<table>
<tr>
		<th class="gray6">*姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</th>
		<td class="font_12" colspan="2">
			<em><?php echo $userName ?></em>
		</td>

</tr>
</table>
<p>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：
	<input type="password" name="password" id="password" size="30" maxlength="40">
  	（最多6个非中文字符）
</p>
<p>*性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：
<?php
	echo $gender;
?>
</p>
<p>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：
  	<input type="email" name="email" id="email" size="30" maxlength="40">
    （请输入合法邮箱名）
</p>
<p>出生年月：
	<input type="date" name="birthDate" id="birthDate" size="30" maxlength="40">
    （示例：1990-07-17）
</p>
<p>居&nbsp;&nbsp;住&nbsp;&nbsp;地：
	<input type="text" name="city" id="city" size="30" maxlength="40">
    
</p>
<p>
  <input type="submit" name="submit" id="button_submit" value="确认" />
  <input type="reset" name="reset" id="button_reset" value="重置" /> 
</p>
</form>

</body>
</html>