<?php session_start();?>

<html>
<head>
<title> 综合营帐管理员菜单 </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css">
body {
	background-color: #FFF;
}
</style>

<script type="text/javascript" src="javascripts/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/admin_style.css" />
	<title>Growing Menu</title>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".nav_bar li").mouseover(function() {
				$(this).stop().animate({
					width : '250px'
				}, 500);
			});

			$(".nav_bar li").mouseout(function() {
				$(this).stop().animate({
					width : '120px'
				}, 500);
			});
		});
	</script>
</head>


<body>
<?php

	if(isset($_SESSION['login'])&&($_SESSION['login']==1))
	{	
?>
<div class="nav_bar">
			<ul>
			  <li >
					<span>管理员资料</span>
                    <div class="whole">
                      <ul class="l2">
                            <li>
                                <a href="list_administrator.php" target="mainwindow">详细资料</a>
                            </li>
                            <li>
                                <a href="administrator_information.php" target="mainwindow">资料变更</a>
                            </li>

                        </ul>
                    </div>
			  </li>
			  <li>
					<span>   话费统计</span>
					<div class="whole">
                        <ul class="l2">
                            <li >
                                <a href="list_administrator_cycledetailcheck.php" target="mainwindow">周期话费</a>
                            </li>
                            <li>
                                <a href="adminisitrator_increace.php" target="mainwindow">增长统计</a>
                            </li>
                        </ul>
                    </div>
			  </li>
			  <li>
					<span>话单查看</span>
					<div class="whole">
                        <ul class="l4">
                            <li >
                                <a href="list_administrator_numbercheckall.php" target="mainwindow">号码查看</a>
                            </li>
                            <li>
                                <a href="list_administrator_usercheckall.php" target="mainwindow">用户查看</a>
                            </li>
                            <li >
                                <a href="list_administrator_numbercheck.php" target="mainwindow">号码时间段查看</a>
                            </li>
                            <li>
                                <a href="list_administrator_usercheck.php" target="mainwindow">用户时间段查看</a>
                            </li>
                        </ul>
                    </div>
			  </li>
              <li>
					<span>号码状态</span>
					<div class="whole">
                        <ul class="l1">
                            <li >
                                <a href="list_phone.php" target="mainwindow">详细资料</a>
                            </li>
                        </ul>
                    </div>
			  </li>
               <li>
					<span>用户列表</span>
					<div class="whole">
                        <ul class="l2">
                            <li >
                                <a href="list_customer.php" target="mainwindow">全部用户</a>
                            </li>
                            <li >
                                <a href="list_find_customer.php" target="mainwindow">查找用户</a>
                            </li>
                        </ul>
                    </div>
				</li>
                <li class="">
					<span>套餐管理</span>
                    <div class="whole">
                    	<ul class="l3">
                            <li >
                                <a href="list_administrator_packagedisplay.php" target="mainwindow">查看套餐</a>
                            </li>
                            <li >
                                <a href="list_administrator_packagemod.php" target="mainwindow">修改套餐</a>
                            </li>
                            <li >
                                <a href="adminisitrator_increace.php" target="mainwindow">查看优惠</a>
                            </li>
                        </ul>
                     </div>
				</li>
                 <li class="">
					<span>月底扣费</span>
                    <div class="whole">
                    	<ul class="l1">
                            <li >
                                <a href="monthly_modify.php" target="mainwindow">扣除月租</a>
                            </li>

                        </ul>
                     </div>
				</li>

  </ul>
</div>
<?php }
	else 
	echo "请登录。";?>
</body>
</html>