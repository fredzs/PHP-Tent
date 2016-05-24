<?php session_start();?>

<html>
<head>
<title> 综合营帐网上营业厅菜单 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">
body {
	background-color: #FFF;
}
</style>

<script type="text/javascript" src="javascripts/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<title>Growing Menu</title>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".nav_bar li").mouseover(function() {
				$(this).stop().animate({
					width : '200px'
				}, 500);
			});

			$(".nav_bar li").mouseout(function() {
				$(this).stop().animate({
					width : '100px'
				}, 500);
			});
		});
	</script>
</head>


<body>

<?php

	if(isset($_SESSION['login'])&&($_SESSION['login']==1))
	{	
		echo "<p>用户".$_SESSION['name']."您好。</p>";
		echo "欢迎来到无线综合营帐网上营业厅。<br/>";
		echo "请选择服务类别。";
?>
	离开时请<a href="customer_logout.php" >注销</a>.

<div class="nav_bar">
			<ul>
			  <li >
					<span>话费服务</span>
                    <div class="whole">
                      <ul class="l3">
                            <li>
                                <a href="customer_cycledetail.php" target="mainwindow">账单明细</a>
                            </li>
                            <li>
                                <a href="customer_recharge.php" target="mainwindow">号码充值</a>
                            </li>
                            <li>
                                <a href="customer_paymentRecord.php" target="mainwindow">缴费记录</a>
                            </li>
                        </ul>
                    </div>
			  </li>
			  <li>
					<span>使用明细</span>
					<div class="whole">
                        <ul class="l2">
                            <li >
                                <a href="customer_calldetail.php" target="mainwindow">通话明细</a>
                            </li>
                            <li>
                                <a href="customer_textdetail.php" target="mainwindow">短信明细</a>
                            </li>
                        </ul>
                    </div>
			  </li>
			  <li>
					<span>套餐管理</span>
					<div class="whole">
                        <ul class="l3">
                        	<li >
                                <a href="policy.php" target="mainwindow">全部套餐</a>
                            </li>
                            <li >
                                <a href="customer_all_packageDetail.php" target="mainwindow">当前套餐</a>
                            </li>
                            <li>
                                <a href="customer_modifyPackage1Window.php" target="mainwindow">套餐变更</a>
                            </li>
                        </ul>
                    </div>
			  </li>
              <li>
					<span>用户资料</span>
					<div class="whole">
                        <ul class="l2">
                            <li >
                                <a href="customer_userinfo.php" target="mainwindow">详细资料</a>
                            </li>
                            <li>
                                <a href="customer_modifyUserInfo1Window.php" target="mainwindow">资料变更</a>
                            </li>
                        </ul>
                    </div>
			  </li>
               <li>
					<span>号码管理</span>
					<div class="whole">
                        <ul class="l3">
                            <li >
                                <a href="customer_userStop1Window.php" target="mainwindow">申请停机</a>
                            </li>
                            <li>
                                <a href="customer_cancelUserStop1Window.php" target="mainwindow">取消停机</a>
                            </li>
                            <li>
                                <a href="customer_userCancel1Window.php" target="mainwindow">申请撤机</a>
                            </li>
                        </ul>
                    </div>
				</li>
                <li>
					<span>新装受理</span>
                    <div class="whole">
                    	<ul class="l1">
                            <li >
                                <a href="1_newPhoneNumApply.php" target="mainwindow">购买号码</a>
                            </li>
                        </ul>
                     </div>
				</li>

  </ul>
</div>
<?php 
	}
	else
	{
		echo "对不起，请先登录系统。";
	}
?>
</body>
</html>