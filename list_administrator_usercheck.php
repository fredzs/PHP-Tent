<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">


<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Language" content="zh-CN" />

<title>list</title>

<style type="text/css">

body{width:55%;}

body{min-width:740px;width:expression(bodyResize(860));}

.bt_intro img{max-width:700px;max-height:700px;imgs:expression(imgResize(this,700));}

</style>

<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="javascripts/main.js"></script>
<?php
	$con=mysql_connect("localhost","root","1qaz");
	mysql_query("SET NAMES 'UTF8'");
	mysql_select_db ("db",$con);
	@$a=$_GET['select'];
	@$b=$_SESSION['type'];
	@$find1 = $_GET['find1'];
	@$find2 = $_GET['find2'];
	@$name = $_GET['name'];
	if ($a == "textdetail" || $b == "textdetail" && $a != "calldetail")
	{
		if ($b != "textdetail")
		{
			$_SESSION['type'] = $a;
		}
		
		$result = mysql_query("select * from textdetail",$con);
		$sqlc="select count(*) from textdetail";
		if( !empty($find1) && !empty($find2) &&!empty($name))
		{
			$sqlc .= " where sendDate > '".$find1."' AND sendDate < '".$find2 . "' AND phoneNum in (select phoneNum from phonedetail where credNum = '" . $name . "')";
		}

		$count = mysql_query($sqlc,$con) or die("Invalid query: " . mysql_error());
		if( isset($_GET['page']) )
		{
			$page = intval($_GET['page']);
		} 
		else
		{ 
			$page = 1;
		} 
	// 每页数量 
		$page_size = 8; 
	// 获取总数据量 
		$row = mysql_fetch_row($count); 
		$amount = $row[0]; 
	// 记算总共有多少页 
		if( $amount )
		{ 
			if( $amount < $page_size )//如果总数据量小于$PageSize，那么只有一页
			{ 
				$page_count = 1; 
			} 
			if( $amount % $page_size )//取总数据量除以每页数的余数 
			{
				$page_count = (int)($amount / $page_size) + 1;//如果有余数，则页数等于总数据量除以每页数的结果取整再加一
			}
			else
			{
				$page_count = $amount / $page_size;//如果没有余数，则页数等于总数据量除以每页数的结果 
			} 
		} 
		else
		{
			$page_count = 0; 
		} 
// 翻页链接 
		$page_string = ''; 
		$page_string.='第('.$page.'/'.$page_count.')页 ';
		if( $page == 1 )
		{ 
			$page_string .= '首页|上一页|'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page=1&find1='.$find1.'&find2='.$find2.'&name='.$name.'>首页</a>|<a href=?page='.($page-1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>上一页</a>| '; 
		} 
		for($k=1;$k<=$page_count;$k++)
		{
			if($k==$page)
			{
				$page_string .= $k.' ';
			}
			else
			{
				$page_string .= '<a href=?page='.$k.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>'.$k.' '.'</a>';
			}
		}
		if( ($page == $page_count) || ($page_count == 0) )
		{ 
			$page_string .= '下一页|尾页'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page='.($page+1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>下一页</a>|<a href=?page='.$page_count.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>尾页</a>'; 
		}
// 获取数据，以二维数组格式返回结果 
		if( $amount )
		{ 
			$sql = "select * from textdetail";
			if( !empty($find1) && !empty($find2) && !empty($name))
			{
				$sql .= " where sendDate > '".$find1."' AND sendDate < '".$find2 . "' AND phoneNum in ( select phoneNum from phonedetail where credNum = '" . $name . "')";
			}
			$sql .= " order by textDetailNum asc limit ". ($page-1)*$page_size .", $page_size"; 
			$result3 = mysql_query($sql, $con); 
			while ( $row = mysql_fetch_row($result3) )
			{ 
				$rowset[] = $row; 
			} 
		}
		else
		{ 
			$rowset = array(); 
		} 
	}
	else if ($a == "calldetail" || $b == "calldetail")
	{
		if ($b != "calldetail")
		{
			$_SESSION['type'] = $a;
		}
		
		$result = mysql_query("select * from calldetail",$con);
		$sqlc="select count(*) from calldetail";
		if( !empty($find1) && !empty($find2) && !empty($name))
		{ 
			$sqlc .= " where callDate > '".$find1."' AND callDate < '".$find2 . "' AND phoneNum in ( select phoneNum from phonedetail where credNum ='" . $name . "')";
		}
		
		$count = mysql_query($sqlc,$con) or die("Invalid query: " . mysql_error());
		if( isset($_GET['page']) )
		{
			$page = intval($_GET['page']);
		} 
		else
		{ 
			$page = 1;
		} 
	// 每页数量 
		$page_size = 8; 
	// 获取总数据量 
		$row = mysql_fetch_row($count); 
		$amount = $row[0]; 
	// 记算总共有多少页 
		if( $amount )
		{ 
			if( $amount < $page_size )//如果总数据量小于$PageSize，那么只有一页
			{ 
				$page_count = 1; 
			} 
			if( $amount % $page_size )//取总数据量除以每页数的余数 
			{
				$page_count = (int)($amount / $page_size) + 1;//如果有余数，则页数等于总数据量除以每页数的结果取整再加一
			}
			else
			{
				$page_count = $amount / $page_size;//如果没有余数，则页数等于总数据量除以每页数的结果 
			}
		} 
		else
		{
			$page_count = 0; 
		} 
// 翻页链接 
		$page_string = ''; 
		$page_string.='第('.$page.'/'.$page_count.')页 ';
		if( $page == 1 )
		{ 
			$page_string .= '首页|上一页|'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page=1'.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>首页</a>|<a href=?page='.($page-1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>上一页</a>| '; 
		} 
		for($k=1;$k<=$page_count;$k++)
		{
			if($k==$page)
			{
				$page_string .= $k.' ';
			}
			else
			{
				$page_string .= '<a href=?page='.$k.'>'.$k.' '.'</a>';
			}
		}
		if( ($page == $page_count) || ($page_count == 0) )
		{ 
			$page_string .= '下一页|尾页'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page='.($page+1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>下一页</a>|<a href=?page='.$page_count.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>尾页</a>'; 
		}
// 获取数据，以二维数组格式返回结果 
		if( $amount )
		{ 
			$sql = "select * from calldetail";
			if( !empty($find1) && !empty($find2) && !empty($name))
			{
				$sql .= " where callDate > '".$find1."' AND callDate < '".$find2 . "' AND phoneNum in ( select phoneNum from phonedetail where credNum = '" . $name . "')";
			}
			$sql .= " order by callDetailNum asc limit ". ($page-1)*$page_size .", $page_size"; 
			$result3 = mysql_query($sql, $con) or die("Invalid query: " . mysql_error()); 
			while ( $row = mysql_fetch_row($result3) )
			{ 
				$rowset[] = $row; 
			} 
		}
		else
		{ 
			$rowset = array(); 
		} 
	}
	else
	{
		$page = 1;
	// 每页数量 
		$page_size = 8; 
	// 获取总数据量 
		$amount = 0; 
	// 记算总共有多少页 
		if( $amount )
		{ 
			if( $amount < $page_size )//如果总数据量小于$PageSize，那么只有一页
			{ 
				$page_count = 1; 
			} 
			if( $amount % $page_size )//取总数据量除以每页数的余数 
			{
				$page_count = (int)($amount / $page_size) + 1;//如果有余数，则页数等于总数据量除以每页数的结果取整再加一
			}
			else
			{
				$page_count = $amount / $page_size;//如果没有余数，则页数等于总数据量除以每页数的结果 
			} 
		} 
		else
		{
			$page_count = 0; 
		} 
// 翻页链接 
		$page_string = ''; 
		$page_string.='第('.$page.'/'.$page_count.')页 ';
		if( $page == 1 )
		{ 
			$page_string .= '首页|上一页|'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page=1'.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>首页</a>|<a href=?page='.($page-1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>上一页</a>| '; 
		} 
		for($k=1;$k<=$page_count;$k++)
		{
			if($k==$page)
			{
				$page_string .= $k.' ';
			}
			else
			{
				$page_string .= '<a href=?page='.$k.'>'.$k.' '.'</a>';
			}
		}
		if( ($page == $page_count) || ($page_count == 0) )
		{ 
			$page_string .= '下一页|尾页'; 
		} 
		else
		{ 
			$page_string .= '<a href=?page='.($page+1).'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>下一页</a>|<a href=?page='.$page_count.'&find1='.$find1.'&find2='.$find2.'&name='.$name.'>尾页</a>'; 
		}
// 获取数据，以二维数组格式返回结果 
		if( $amount )
		{ 
			$sql = "select * from calldetail";
			if( isset($_GET['find']) )
				$sql .= "where callDate callDate > '".$find1."' AND callDate < '".$find2 . "'"; 
			$sql .= " order by callDetailNum asc limit ". ($page-1)*$page_size .", $page_size"; 
			$result3 = mysql_query($sql); 
			while ( $row = mysql_fetch_row($result3) )
			{ 
				$rowset[] = $row; 
			} 
		}
		else
		{ 
			$rowset = array(); 
		}
	}
			
?>
</head>

<body>

<!-- 2012-09-08 12:23:53 -->

<div class="bg">
<div class="main">
<div class="table clear">
<form action="#" method="get" name="form_find_cus">
<input type="hidden" name="haha" />
<script language="javascript" type="text/javascript">
function getindex()
{
	form.haha.value=select.selectedIndex;
}</script>
	通过

    <select name="select" onchange="getindex();">
        <option value="calldetail">查询通话记录</option>
        <option value="textdetail">查询短信记录</option>
	</select>
    <p> "用户证件号码" 
    <input type="text" name="name" id="name" size="30" maxlength="40"></p>
    <p> "起点日期yyyy-mm-dd“
    <input type="text" name="find1" id="find1" size="30" maxlength="40"></p>
    <p> "终点日期yyyy-mm-dd“
    <input name="find2" type="text" class="bts_3" id="find2" size="30" maxlength="40"></p>
    <input type="submit" name="submit" id="button" value="查找" />
    <input type="reset" name="reset" id="button2" value="重置" /> 
    查找用户。
    
</form>
<div class="nav_title">

<div class="left">
	<span class="multipage">
    <span ><?php echo $page_string; ?></span>
	</span>&nbsp;</div>

</div>

<div class="clear">

<table width="100%" border="1" cellpadding="0" cellspacing="0" frame="void" class="list_style table_fixed" id="main_list">

<?php 
@$a = $_SESSION['type'];
if($a == "calldetail")
{
?>
<colgroup><col><col><col><col><col><col><col><col><col>

  <thead>
  <tr class="tcat text_center">
  
  	<td width="50">话单号</td>
    <td width="50">通话类型</td>
    <td width="85">通话日期</td>
    <td width="85">主叫</td>
    <td width="85">被叫</td>
    <td width="40">通信费</td>
    <td width="65">开始时间</td>
    <td width="65">结束时间</td>
    <td width="*">号码</td>

  </tr>

  </thead>
<?php 
}
?>

<?php 
@$a = $_SESSION['type'];
if($a == "textdetail")
{
?>
<colgroup><col><col><col><col><col><col><col>
  <thead>
  <tr class="tcat text_center">
  
    <td width="65">短信详单号</td>
    <td width="85">发送方</td>
    <td width="85">接收方</td>
    <td width="85">发送时间</td>
    <td width="65">通信费</td>
    <td width="85">通信日期</td>
    <td width="*">号码</td>
  </tr>

  </thead>
<?php
}
?>

?>
<?php
if(@$_GET['select'] != "textdetail" && @$_GET['select'] == "calldetail")
{
?>
  <thead>

  </thead>
<?php
}
?>
  <tbody>
<?php   for ($i=0;$i<$page_size;$i++)
		{
			if(!empty($rowset[$i]))	
			{
?>
        <tr class="alt1 text_center" onmouseover="highlight(this,'alt1');">
		
        	<?php 
			if ($_SESSION['type'] == "calldetail")
			{
				$num = 9;
			}
			else if ($_SESSION['type'] == "textdetail")
			{
				$num = 7;
			}
			else
			{
				$num = 0;
			}
			
			for($j=0;$j<$num;$j++)
            { 
                echo "<td>"; 
				echo $rowset[$i][$j];
                echo "</td>";
             
			} 
        echo "</tr>"; 
			}
			
		}?>
  </tbody>

</table>

</div>

<div class="nav_title clear">
    <span class="multipage">
    	<span >
			<?php echo $page_string; ?>
        </span>
    </span>
</div>

</div>

<script type="text/javascript" src="javascripts/tablesort.js"></script></div>
</div>

<!-- BTMaster.cn -->
<div style="text-align:center;font:11px arial;color:#AAA;clear:both;">Powered by Fred Zhang&nbsp;Version:1.0</div></body></html>