<?php session_start();?>
<html>
<head>
	<title> 综合营帐充值检测 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php 	
	@$user_phone=$_POST["user_phone"];
	@$payment=$_POST["payment"];
	@$code=$_POST["code"];
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db ("db",$con);		
	$found = 0;
	include("securimage/securimage.php");
	$img=new Securimage();
	unset($_SESSION['name']);
	if(!empty($_POST)&&($user_phone!="")&&($code!=""))
    {
		$valid=$img->check($code);//检查用户的输入是否正确
		if($valid==false)
		{
			$url = "recharge_home.php";
			echo "<script language=\"JavaScript\">
			alert('验证码输入错误，请重新输入！');
			window.location.href='$url';
			</script>";
		} 
		else
		{
			$result_phone= mysql_query("select phoneNum,balance  ,credNum ,credType  from phonedetail",$con);
			
			while($row = mysql_fetch_row($result_phone))
			{
				$phone=$row[0];
				if($user_phone==$phone)
				{
					$found=1;
					$balance=$row[1]+$payment;
					$credNum=$row[2];
					$credType=$row[3];
					if ($credType=="身份证")
						$credType=1;
					else if ($credType=="护照")
						$credType=2;
					else 
						$credType=3;
					$sql="update phonedetail set balance = '".$balance."' WHERE phoneNum = '".$user_phone."'";//构造查询语句
					$result_insert = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
					
					$result_pay= mysql_query("select count(*)  from paymentrecord",$con)or die("Invalid query: " . mysql_error());
					$row2=  mysql_fetch_row($result_pay);
					$count = $row2[0]+1;
					
					$sql2="INSERT INTO paymentrecord VALUES ('".$count."','".$user_phone."','".$credType."','".$payment."','".$credNum."','".$credType."')";//构造查询语句
					$result_pay= mysql_query($sql2,$con)or die("Invalid query: " . mysql_error());
					
					echo "<script language=\"JavaScript\">
					alert('号码缴费成功！');  
					</script>";
					$url = "recharge_success.php";
					$name=$row[0];
					$_SESSION['phone'] = $phone;
					$_SESSION['payment'] = $payment;
					$_SESSION['balance'] = $balance;
					if($balance > 0)
					{
						$sql="update phonedetail set status = '1' WHERE phoneNum = '".$user_phone."'";//构造查询语句
						$result_insert = mysql_query($sql,$con)or die("Invalid query: " . mysql_error());
					}
					echo "<script language='javascript' type='text/javascript'>";
					echo "window.location.href='$url'";
					echo "</script>";
				}
			}
			if($found==0)
			{
				$url = "recharge_home.php";
				echo "<script language=\"JavaScript\">
				alert('号码不存在，请重新输入！');  
				</script>";
				echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='$url'";
				echo "</script>";
			}
		}
	}
	mysql_close($con);
?>
</body>
</html>