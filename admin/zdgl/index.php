<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>滚球注单自动审核页面</title>
</head>
<body>
<table width="100%" height="130" border="0">
  <tr>
    <td width="100%" align="center"><iframe src="auto.php" name="autoFrame" id="autoFrame" title="autoFrame" frameborder=0 width="100%" scrolling=no height=260 ></iframe></td>
  </tr>
</table>
<script type="text/javascript" language="javascript">
var is_open	=	0; //是否已打开审核页面
var once	=	1; //第几次进入此页面

function check(){
	if(once > 1){ //不是第一次进入此页面
		if(is_open != 1){ //滚球注单自动审核页面可能已卡死，需要重新刷新
			window.autoFrame.location.href="auto.php";
		}
	}
	once	=	2; //已经执行过一次了，不是第一次进入这个页面
	is_open	=	0;
}

setInterval("check()",5000); //自动验证页面是否卡死时间，1秒=1000
</script>
</body>
</html>