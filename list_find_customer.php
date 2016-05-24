
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
	$result = mysql_query("select * from user",$con);
	$sqlc="select count(*) from user";
	if( isset($_GET['find'])&&isset($_GET['select']) )
		$sqlc.=" where ".$_GET['select']." = '".$_GET['find']."'"	;	
	$count = mysql_query($sqlc,$con);
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
		$sql = "select * from user ";
		if( isset($_GET['find'])&&isset($_GET['select']) )
			$sql .= "where ".$_GET['select']."='".$_GET['find']."'"; 
		$sql .= " order by credNum asc limit ". ($page-1)*$page_size .", $page_size"; 
		$result3 = mysql_query($sql); 
		while ( $row = mysql_fetch_row($result3) )
		{ 
			$rowset[] = $row; 
		} 
	}else
	{ 
		$rowset = array(); 
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
        <option value="userNam"> 姓  名 </option>
        <option value="account">登录名</option>
        <option value ="credNum">证件号码</option>
        <option value ="credType">证件类型</option>
        <option value="gender"> 性  别 </option>
        <option value="email"> 邮  箱 </option>
        <option value="birthDate">出生年月</option>
        <option value="city"> 居住地 </option>
	</select>
    <input type="username" name="find" id="find" size="30" maxlength="40">
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

<colgroup><col><col><col><col><col><col><col><col><col>

  <thead>
  <tr class="tcat text_center">
  
    <td width="65">证件号码</td>
    <td width="65">证件类型</td>
    <td width="65">姓名</td>
    <td width="65">性别</td>
    <td width="65">登录名</td>
    <td width="65">登录密码</td>
    <td width="*">邮箱</td>
    <td width="65">出生年月</td>
    <td width="65">居住地</td>
  </tr>

  </thead>

  <tbody>
<?php   for ($i=0;$i<$page_size;$i++)
		{
			if(!empty($rowset[$i]))	
			{
		?>
        <tr class="alt1 text_center" onmouseover="highlight(this,'alt1');">
		
        	<?php for($j=0;$j<9;$j++)
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