<?php session_start();?>
<html>
<head>
	<title> 综合营帐充值检测 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php 	
	echo "号码".$_SESSION['phone']."成功缴费".$_SESSION['payment']."元，号码余额为：".$_SESSION['balance']."元。";
	header("refresh:5;url=recharge_home.php");
	echo"正在打印收据，请稍等...<br>五秒后自动跳转~~~";
?>
<?php /*?><script type="text/javascript"> window.location.href='recharge_home.php'</script><?php */?>

</body>
</html>