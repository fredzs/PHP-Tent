<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="zh-CN" />
		<title>list</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="javascripts/main.js"></script>
	</head>
	<body>
		<table border="1" class="list_style table_fixed" id="main_list">
			<colgroup><col><col><col>
			<thead>
				<tr class="tcat text_center">
					<td width="33%">管理员编号</td>
					<td width="*">管理员姓名</td>
					<td width="33%">管理员类型</td>
				</tr>
			</thead>
			<tbody>
				<tr class="alt1 text_center" onmouseover="highlight(this,'alt1');">
					<td>1</td>
					<td>2</td>
					<td>3</td>
				</tr>
				<tr class="alt1 text_center" onmouseover="highlight(this,'alt1');">
					<td>2</td>
					<td>3</td>
					<td>4</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript" src="javascripts/tablesort.js"></script>
	</body>
</html>