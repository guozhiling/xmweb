<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
include_once("../../include/mysqli.php");

$bid	=	intval($_GET["bid"]);
$status	=	intval($_GET["status"]);
$sql	=	"select match_id,master_guest,match_name from k_bet where bid=$bid limit 1";
$query	=	$mysqli->query($sql);
$t		=	$query->fetch_array();
$sql	=	"select MB_Inball,TG_Inball from k_bet where MB_Inball is not null and match_id=".$t['match_id']." limit 1";
$query	=	$mysqli->query($sql);
$m		=	$query->fetch_array();
if(strpos($t['master_guest'],'VS.')) $master_guest	=	explode('VS.',$t['master_guest']);
else $master_guest	=	explode('VS',$t['master_guest']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置比分</title>
<script language="javascript">
function thisclose(){
	window.close();
}

function check_sub(){
	var mb_inball=document.getElementById("MB_Inabll").value;
	var tb_inball=document.getElementById("TG_Inabll").value;
	
	if(mb_inball==''){
		alert('请填主队进球');
		return false;
	}
	if(tg_inball==''){
		alert('请填客队进球');
		return false;
	}
}
</script>
</head>
<body bgcolor="#EAFFD7">
<form onsubmit="return  check_sub();" action="set_bet.php" method="get" name="form1">
<input type="hidden" name="bid" value="<?=$bid?>" />
<input type="hidden" name="status" value="<?=$status?>" />
<table width="400"  border="1" align="center" cellpadding="4" cellspacing="0" bgcolor="#E8DCC4">
  <tr align="center">
    <td colspan="2" style="background:#986032; color: #FFFFFF;font-weight: bold;">设置结算比分</td>
  </tr>
  <tr style="background: #C0AB58; color: #9C4945;font-weight: bold;">
    <td colspan="2" align="center"><?=$t["match_name"]?></td>
    </tr>
  <tr style="font-size:14px; text-align:center">
    <td width="189" align="center"><?=$master_guest[0]?></td>
    <td width="189" align="center"><?=$master_guest[1]?></td>
  </tr>
  <tr style="font-size:14px; text-align:center">
    <td align="center"><input  name="MB_Inball" type="text"  id="MB_Inball" value="<?=@$m["MB_Inball"]?>" size="10" maxlength="10"/></td>
    <td align="center"><input  name="TG_Inball" type="text" id="TG_Inball" value="<?=@$m["TG_Inball"]?>" size="10" maxlength="10"/></td>
  </tr>
  <tr align="center">
    <td colspan="2"><input type="submit" value="提交" />&nbsp;&nbsp; 
       <input type="button" onclick="javascript:thisclose();" value="关闭" /></td>
  </tr>
</table>
</form>
</body>
</html>