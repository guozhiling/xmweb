<?php 
include_once("mysqli.php");
include_once("mysqlis.php");
include_once("mysqlio.php");
include_once("get_point.php");
include_once("../../class/bet.php");

session_start();
if(intval(date('H'))<5)
{
	if($_SESSION["lqauto"]=="0")
	{
		$date=date('Y-m-d',time());
		$mDate=date('m-d',time());
		$_SESSION["lqauto"]="-1";
	}
	else
	{
		$date=date('Y-m-d',time()-24*3600);
		$mDate=date('m-d',time()-24*3600);
		$_SESSION["lqauto"]="0";
	}
}
else
{
	$date=date('Y-m-d',time());
	$mDate=date('m-d',time());
}

$sql="select MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR,Match_Master,match_name,Match_Guest,Match_ID from lq_match where `Match_Date` ='$mDate' and (MB_Inball>=0 or (MB_Inball='-1' and TG_Inball='-1')) and match_js!='1' order by ID";

	$query			=	$mysqlis->query($sql);
	 while($rows	=	$query->fetch_array()){
		//print_r($rows);
		$mids[$rows['Match_ID']]=$rows['Match_ID'];
		$MB_Inball_HR=$rows['MB_Inball_HR'];
		$TG_Inball_HR=$rows['TG_Inball_HR'];
		$MB_Inball=$rows['MB_Inball'];
		$TG_Inball=$rows['TG_Inball'];
	 	/*//保存所有上半场单式注单比分
		$sql="update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where lose_ok=1 and (point_column in ('match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl') or point_column like 'match_hr_bd%') and status=0 and match_id='".$rows['Match_ID']."'";
		//echo $sql."<br>";
		$mysqli->query($sql);
		//保存所上半场有串关注单比分
		$sql="update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where status=0 and match_id='".$rows['Match_ID']."' and (ball_sort like('%上半场%') or bet_info like('%上半场%'))";
		$mysqli->query($sql);*/
		//保存所有全场单式注单比分
		$sql="update k_bet set MB_Inball='$MB_Inball',TG_Inball='$TG_Inball' where lose_ok=1 and status=0 and match_id='".$rows['Match_ID']."'";
		$mysqli->query($sql);
		//保存全场有串关注单比分
		$sql="update k_bet_cg set mb_inball='$MB_Inball',tg_inball='$TG_Inball' where status=0 and match_id='".$rows['Match_ID']."'";
		$mysqli->query($sql);
	 }

$mid=@implode(",",$mids);

//自动结算开始
$m=	count($mids);
$bool	=	true;	
if(count($mids)>0){


$sql   		=	"select k_bet.*,k_user.username from k_bet left join k_user on k_bet.uid=k_user.uid where k_bet.lose_ok=1 and k_bet.status=0 and k_bet.match_id in($mid)  and k_bet.check=0 order by k_bet.bid desc ";
$result		=	$mysqli->query($sql); //单式
while($rows = $result->fetch_array()){
			  $all_bet_money+=$rows["bet_money"];
			  $column=$rows["point_column"];
			  $t=make_point($column,$rows['MB_Inball'],$rows['TG_Inball'],$MB_Inball_HR,$TG_Inball_HR,$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
			  $bid=intval($rows['bid']);
		      $status=intval($t['status']);
			  $mb_inball=$rows['MB_Inball'];
			  $tg_inball=$rows['TG_Inball'];				
			  $bool	=	bet::set($bid,$status,$mb_inball,$tg_inball);
			  if(!$bool) break;
			  $bids[$rows['bid']]=$rows['bid'];
}

$sql   		=	"select k_bet_cg.*,k_user.username from k_bet_cg left join k_user on k_bet_cg.uid=k_user.uid where status=0 and match_id in($mid) and k_bet_cg.check=0 order by k_bet_cg.bid desc";
$result_cg	=	$mysqli->query($sql); //串关
while ($rows = $result_cg->fetch_array()) {
			  $all_bet_money+=$rows["bet_money"];
			  $column=$rows["point_column"];
			  $t=make_point(strtolower($column),$rows['MB_Inball'],$rows['TG_Inball'],$MB_Inball_HR,$TG_Inball_HR,$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
			  $bid=intval($rows['bid']);
		      $status=intval($t['status']);
			  $mb_inball=$rows['MB_Inball'];
			  $tg_inball=$rows['TG_Inball'];			  
			  $bool	=	bet::set_cg($bid,$status,$mb_inball,$tg_inball);
			  if(!$bool) break;
			  $cg_bids[$rows['bid']]=$rows['bid'];		  
}

if(count($bids)>0){
$mysqli->query("update k_bet set check=1 where bid in(".implode(",",$bids).")");
}
if(count($cg_bids)>0){
$mysqli->query("update k_bet_cg set check=1 where bid in(".implode(",",$cg_bids).")");
}
if($bool){
	$mysqlis->query("update lq_match set match_js='1' where match_id in($mid)");
	include_once("../../class/admin.php");
	admin::insert_log($_SESSION["adminid"],"批量审核了篮球赛事".$mid."注单");
	$m=count($mids);
}else{
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
  <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>
</head>
<script>
<!--
var limit="80"
if (document.images){
	var parselimit=limit
}
function beginrefresh(){
if (!document.images)
	return
if (parselimit==1)
	self.location.reload()
else{
	parselimit-=1
	curmin=Math.floor(parselimit)
	if (curmin!=0)
		curtime=curmin+"秒后获取数据！"
	else
		curtime=cursec+"秒后获取数据！"

		timeinfo.innerText=curtime
		setTimeout("beginrefresh()",1000)
	}
}

window.onload=beginrefresh

</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.reload()">
    <?=$m?> 条篮球结算！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>