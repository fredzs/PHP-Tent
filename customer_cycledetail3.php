<?php session_start(); ?>
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
	$amount=0;
	$tq1 = mysql_query("select credNum from user where account='".$_SESSION['account']."'",$con)or die("Invalid query: " . mysql_error()); 
	$tr1 = mysql_fetch_row($tq1);
	$userid = $tr1[0];
	$tr2 = mysql_query("select phoneNum from phonedetail where credNum='$userid'",$con)or die("Invalid query: " . mysql_error()); 
	while ( $prow = mysql_fetch_row($tr2) )
	{ 
		$numset[] = $prow;
	} 
	if(isset($_POST['detailquery'])&&empty($numset[])){
	if($_POST['usernum']=="all"){
		foreach($numset as $numr){
		$sql = "select cycleNum,date,localCost,longDisCost,textCost,monthCost,totalCost,phoneNum from cycledetail where phoneNum='$numr[0]' AND date >= '".$_POST['startdate']."-01' AND date <= '".$_POST['enddate']."-01' order by cycleNum asc"; 
		$result3 = mysql_query($sql); 
		while ( $row = mysql_fetch_row($result3) )
		{ 
			$rowset[] = $row; 
			$amount++;
		} 
		}
	}else{
		$sql = "select cycleNum,date,localCost,longDisCost,textCost,monthCost,totalCost,phoneNum from cycledetail where phoneNum='".$_POST['usernum']."' AND date >= '".$_POST['startdate']."-01' AND date <= '".$_POST['enddate']."-01' order by cycleNum asc"; 
		$result3 = mysql_query($sql); 
		while ( $row = mysql_fetch_row($result3) )
		{ 
			$rowset[] = $row; 
			$amount++;
		} 
	}
	} 
		
	
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
	$page_string .= '<a href=?page=1>首页</a>|<a href=?page='.($page-1).'>上一页</a>| '; 
	} 
	for($k=1;$k<=$page_count;$k++)
	{
		if($k==$page)
			$page_string .= $k.' ';
		else
			$page_string .= '<a href=?page='.$k.'>'.$k.' '.'</a>';
	}
	if( ($page == $page_count) || ($page_count == 0) )
	{ 
		$page_string .= '下一页|尾页'; 
	} 
	else
	{ 
		$page_string .= '<a href=?page='.($page+1).'>下一页</a>|<a href=?page='.$page_count.'>尾页</a>'; 
	}
	//echo "$page_string"; 
// 获取数据，以二维数组格式返回结果 
	if( $amount )
	{ 
		$start=($page-1)*$page_size;
		$end=$start+$page_size;
	}else
	{ 
		$rowset = array(); 
		$start=$end=0;
	} 
?>
</head>

<body>

<!-- 2012-09-08 12:23:53 -->

<div class="bg">
<div class="main">
<p><?php echo $_SESSION['name'];?>你好。请选择查询范围:</p>
<div class="clear">
<form action="" method="POST">
开始月份：<input type="month" name="startdate" value="<?php echo date('Y-m', strtotime(date('Y/m/d'))); ?>" />
结束月份：<input type="month" name="enddate" value="<?php echo date('Y-m', strtotime(date('Y/m/d'))); ?>" />
用户号码：<select name="usernum">
<?php foreach($numset as $numr){
echo "<option value='$numr[0]'>$numr[0]</option>";
} ?>
<option value="all">所有号码</option>
</select>
<input type="hidden" name="detailquery" value=1 />
<input type="submit" value="提交" />
</form>
</div>
<?php if(isset($_POST['detailquery'])&&empty($numset[])){ ?>
<hr>
<p>查询结果：</p>
<div class="table clear">

<div class="nav_title">

<div class="left">
	<span class="multipage">
    <span ><?php echo $page_string; ?></span>
</span>&nbsp;</div>

</div>

<div class="clear">
<table width="100%" border="1" cellpadding="0" cellspacing="0" frame="void" class="list_style table_fixed" id="main_list">

<colgroup><col><col><col><col><col><col><col><col>

  <thead>
  <tr class="tcat text_center">
  
    <td width="65">账单编号</td>
    <td width="110">账单月份</td>
    <td width="60">本地费用</td>
    <td width="60">长途费用</td>
    <td width="60">短信费用</td>
    <td width="60">月租费</td>
    <td width="*">总计</td>
    <td width="95">用户号码</td>
  </tr>

  </thead>

  <tbody>
<?php   for ($i=$start;$i<$end;$i++)
		{
			if(!empty($rowset[$i]))	
			{
		?>
        <tr class="alt1 text_center" onmouseover="highlight(this,'alt1');">
		
        	<?php for($j=0;$j<8;$j++)
            { 
                echo "<td>"; 
		if ($j==1) echo substr($rowset[$i][$j],0,7);
		else echo $rowset[$i][$j];
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
<?php } ?>

<script type="text/javascript" src="javascripts/tablesort.js"></script></div>
</div>

<!-- BTMaster.cn -->
<div style="text-align:center;font:11px arial;color:#AAA;clear:both;">by LQ</div></body></html>
