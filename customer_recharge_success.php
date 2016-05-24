<?php session_start();?>
<html>
<head>
	<title> 综合营帐充值检测 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php 	
	echo "号码".$_SESSION['phone']."成功缴费".$_SESSION['payment']."元，号码余额为：".$_SESSION['balance']."元。";
	echo"请继续选择业务进行办理。";
	echo $_SESSION['phone'];
	echo $_SESSION['name'];
?>
<?php /*?><script type="text/javascript"> window.location.href='recharge_home.php'</script><?php */?>

</body>
</html>