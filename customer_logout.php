<?php session_start();
	//session_destroy();
	//$_SESSION['login']=0;
	unset($_SESSION['name']);
	unset($_SESSION['phone']);
	unset($_SESSION['payment']);
	unset($_SESSION['balance']);
	unset($_SESSION['login']);
	unset($_SESSION['account']);
	unset($_SESSION['credNum']);
	unset($_SESSION['account']);
	
	//header("refresh:4;url=customer_login.php");
	//echo"����ע�������Ե�...<br>������Զ���ת~~~";
	echo "<script defer type='text/javascript'> ";
	//echo "setTimeout('',1000*3)";
	echo "window.self.parent.top.location.href='online_business.php'";
    echo "</script>";

?>