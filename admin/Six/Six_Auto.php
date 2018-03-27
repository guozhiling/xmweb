<?php
header("Content-type: text/html; charset=utf-8");
//ini_set('display_errors','yes');
//include_once("../common/login_check.php");
//check_quanxian("ssgl"); 
include_once("../include/pager.class.php");
include_once("../../include/mysqli.php");
include_once("auto_class.php");
include_once("year_sx.php");

//自动判断生肖 BY ZZJY 1063031748
$today = date("Y-m-d",time());
$lunar = new Lunar();
$nl = date("Y",$lunar->S2L($today));

if($nl!=$year['yaar']){
	
	$sxs = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
	$sx_arr=array();$sx_arr2=array();

	for($i=1;$i<=49;$i++){
		$dqsx=Get_ShengXiao($nl,$i%12);
		
		//echo $dqsx."===";
		$sx_arr[$dqsx]=$sx_arr[$dqsx].'<div class="ball_'.BuLing($i).'">'.BuLing($i).'</div>';
		$sx_arr2[$dqsx]=$sx_arr2[$dqsx].BuLing($i).',';
		
		//echo $sx_arr2[$dqsx]."<br>";
	}
	$code1=$code2="";
	$ii=1;
		
	foreach($sxs as $val){
	
		$code1.='$sx_'.BuLing($ii).'  = \''.$sx_arr[$val]."';\r\n";
		$code2.='$sx_'.BuLing($ii).'a = \''.rtrim($sx_arr2[$val], ",")."';\r\n";
		$ii++;
	}
	$code="<?php\r\n";
	$code .= $code1.$code2;
	$code .= "\r\n?>";
		
	///if(!write_file("../../Six/class/number_sx.php",$code)){ //写入缓存失败
		//echo	"缓存文件写入失败！请先设number_sx.php文件权限为：0777";
//	}
	
	$code="<?php\r\n";
	$code .= "\$year['year']		=	\"".$nl."\";\r\n";
	$code .= "\$year['sx']		=	\"".$sx."\";\r\n";
	$code .= "\r\n?>";
	//if(!write_file("year_sx.php",$code)){ //写入缓存失败
	///	echo	"缓存文件写入失败！请先设year_sx.php文件权限为：0777";
	//}
	///echo 'sfdgsdfgvsdf';
}
	
$id	=	0;
if($_GET['id'] > 0){
	$id	=	$_GET['id'];
}
if($_REQUEST['page']==''){
	$_REQUEST['page']=1;
}
if($_GET["action"]=="add" && $id==0){ 
	$qishu		=	$_POST["qishu"];
	$opentime	=	$_POST["opentime"];
	$endtime	=	$_POST["endtime"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$sql		=	"select qishu from c_auto_0 where qishu=".$qishu." limit 1";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	if($rs['qishu']){
	//	message("期数已经存在！","Six_Auto.php");
		echo "<script>alert('期数已经存在！');window.location.href='Six_Auto.php';</script>";
		exit;
	}
	$sql		=	"insert into c_auto_0(qishu,opentime,endtime,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7) values (".$qishu.",'".$opentime."','".$endtime."','".$datetime."',".$ball_1.",".$ball_2.",".$ball_3.",".$ball_4.",".$ball_5.",".$ball_6.",".$ball_7.")";
	$mysqli->query($sql);
	//message("开盘成功！","Six_Auto.php");
	echo "<script>alert('开盘成功');window.location.href='Six_Auto.php';</script>";
		exit;
	exit;
}elseif($_GET["action"]=="edit" && $id>0){
	$qishu		=	$_POST["qishu"];
	$opentime	=	$_POST["opentime"];
	$endtime	=	$_POST["endtime"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$sql		=	"update c_auto_0 set qishu=".$qishu.",opentime='".$opentime."',endtime='".$endtime."',datetime='".$datetime."',ball_1=".$ball_1.",ball_2=".$ball_2.",ball_3=".$ball_3.",ball_4=".$ball_4.",ball_5=".$ball_5.",ball_6=".$ball_6.",ball_7=".$ball_7." where id=".$id."";
	$mysqli->query($sql);
	//message("修改成功！","Six_Auto.php");
	echo "<script>alert('修改成功');window.location.href='Six_Auto.php';</script>";
	exit;
	

}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tools.js"></script>
<script type="text/javascript" src="../js/base.js"></script>
<style>td,th{font-size:12px;}</style>
<script language="javascript">
	function js(){  
    if(confirm("确认结算吗？请保证开奖号无误之后再确认结算")){  
        return true;  
    }  
    return false;  
 }   
function check_submit(){
	if($("#qishu").val()==""){
		message("请填写开奖期数");
		$("#qishu").focus();
		return false;
	}
	if($("#opentime").val()==""){
		message("请填写开盘时间");
		$("#opentime").focus();
		return false;
	}
	if($("#endtime").val()==""){
		message("请填写封盘时间");
		$("#endtime").focus();
		return false;
	}
	if($("#datetime").val()==""){
		message("请填写开奖时间");
		$("#datetime").focus();
		return false;
	}
	return true;
}
</script>
</head>
<iframe src="https://kj.1680api.com/sharehtml/live?setcode=4001" width="800" height="30" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
<body class="list">
	<div class="bar">
		六合彩开奖管理
	</div>

<div class="body">
<ul id="tab" class="tab">
	<li><input type="button" value="六合彩开奖" hidefocus class="current"/></li>
</ul>
<form name="form1" onSubmit="return check_submit();" method="post" action="?id=<?=$id?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>">
<?php
if($id>0 && !isset($_GET['action'])){
	$sql	=	"select * from c_auto_0 where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
//echo Get_ShengXiao("20");
?>
<table id="listTables" class="listTables" style="margin-bottom:5px;">
  <tr>
    <td width="110" height="40"  align="right" bgcolor="#F2F4F6">开奖期号：</td>
    <td  align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="qishu" type="text" id="qishu" value="<?=$rs['qishu']?>" size="20" maxlength="7" class="formText"/></td>
  </tr>
  <tr>
    <td height="40" align="right" bgcolor="#F2F4F6">开盘时间：</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="opentime" type="text" id="opentime" value="<?=$rs['opentime']?>" size="20" maxlength="19" class="formText"/></td>
    </tr>
  <tr>
    <td height="40" align="right" bgcolor="#F2F4F6">封盘时间：</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="endtime" type="text" id="endtime" value="<?=$rs['endtime']?>" size="20" maxlength="19" class="formText"/></td>
  </tr>
  <tr>
    <td height="40" align="right" bgcolor="#F2F4F6">开奖时间：</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="datetime" type="text" id="datetime" value="<?=$rs['datetime']?>" size="20" maxlength="19" class="formText"/></td>
  </tr>
  <tr>
    <td height="40" align="right" bgcolor="#F2F4F6">开奖号码：</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><select name="ball_1" id="ball_1">
      <option value="1" <?=$rs['ball_1']==1 ? 'selected' : ''?>>01</option>
      <option value="2" <?=$rs['ball_1']==2 ? 'selected' : ''?>>02</option>
      <option value="3" <?=$rs['ball_1']==3 ? 'selected' : ''?>>03</option>
      <option value="4" <?=$rs['ball_1']==4 ? 'selected' : ''?>>04</option>
      <option value="5" <?=$rs['ball_1']==5 ? 'selected' : ''?>>05</option>
      <option value="6" <?=$rs['ball_1']==6 ? 'selected' : ''?>>06</option>
      <option value="7" <?=$rs['ball_1']==7 ? 'selected' : ''?>>07</option>
      <option value="8" <?=$rs['ball_1']==8 ? 'selected' : ''?>>08</option>
      <option value="9" <?=$rs['ball_1']==9 ? 'selected' : ''?>>09</option>
      <option value="10" <?=$rs['ball_1']==10 ? 'selected' : ''?>>10</option>
      <option value="11" <?=$rs['ball_1']==11 ? 'selected' : ''?>>11</option>
      <option value="12" <?=$rs['ball_1']==12 ? 'selected' : ''?>>12</option>
      <option value="13" <?=$rs['ball_1']==13 ? 'selected' : ''?>>13</option>
      <option value="14" <?=$rs['ball_1']==14 ? 'selected' : ''?>>14</option>
      <option value="15" <?=$rs['ball_1']==15 ? 'selected' : ''?>>15</option>
      <option value="16" <?=$rs['ball_1']==16 ? 'selected' : ''?>>16</option>
      <option value="17" <?=$rs['ball_1']==17 ? 'selected' : ''?>>17</option>
      <option value="18" <?=$rs['ball_1']==18 ? 'selected' : ''?>>18</option>
      <option value="19" <?=$rs['ball_1']==19 ? 'selected' : ''?>>19</option>
      <option value="20" <?=$rs['ball_1']==20 ? 'selected' : ''?>>20</option>
      <option value="21" <?=$rs['ball_1']==21 ? 'selected' : ''?>>21</option>
      <option value="22" <?=$rs['ball_1']==22 ? 'selected' : ''?>>22</option>
      <option value="23" <?=$rs['ball_1']==23 ? 'selected' : ''?>>23</option>
      <option value="24" <?=$rs['ball_1']==24 ? 'selected' : ''?>>24</option>
      <option value="25" <?=$rs['ball_1']==25 ? 'selected' : ''?>>25</option>
      <option value="26" <?=$rs['ball_1']==26 ? 'selected' : ''?>>26</option>
      <option value="27" <?=$rs['ball_1']==27 ? 'selected' : ''?>>27</option>
      <option value="28" <?=$rs['ball_1']==28 ? 'selected' : ''?>>28</option>
      <option value="29" <?=$rs['ball_1']==29 ? 'selected' : ''?>>29</option>
      <option value="30" <?=$rs['ball_1']==30 ? 'selected' : ''?>>30</option>
      <option value="31" <?=$rs['ball_1']==31 ? 'selected' : ''?>>31</option>
      <option value="32" <?=$rs['ball_1']==32 ? 'selected' : ''?>>32</option>
      <option value="33" <?=$rs['ball_1']==33 ? 'selected' : ''?>>33</option>
      <option value="34" <?=$rs['ball_1']==34 ? 'selected' : ''?>>34</option>
      <option value="35" <?=$rs['ball_1']==35 ? 'selected' : ''?>>35</option>
      <option value="36" <?=$rs['ball_1']==36 ? 'selected' : ''?>>36</option>
      <option value="37" <?=$rs['ball_1']==37 ? 'selected' : ''?>>37</option>
      <option value="38" <?=$rs['ball_1']==38 ? 'selected' : ''?>>38</option>
      <option value="39" <?=$rs['ball_1']==39 ? 'selected' : ''?>>39</option>
      <option value="40" <?=$rs['ball_1']==40 ? 'selected' : ''?>>40</option>
      <option value="41" <?=$rs['ball_1']==41 ? 'selected' : ''?>>41</option>
      <option value="42" <?=$rs['ball_1']==42 ? 'selected' : ''?>>42</option>
      <option value="43" <?=$rs['ball_1']==43 ? 'selected' : ''?>>43</option>
      <option value="44" <?=$rs['ball_1']==44 ? 'selected' : ''?>>44</option>
      <option value="45" <?=$rs['ball_1']==45 ? 'selected' : ''?>>45</option>
      <option value="46" <?=$rs['ball_1']==46 ? 'selected' : ''?>>46</option>
      <option value="47" <?=$rs['ball_1']==47 ? 'selected' : ''?>>47</option>
      <option value="48" <?=$rs['ball_1']==48 ? 'selected' : ''?>>48</option>
      <option value="49" <?=$rs['ball_1']==49 ? 'selected' : ''?>>49</option>
      <option value="0" <?=$rs['ball_1']=='' || $rs['ball_1']=='0' ? 'selected' : ''?>>正一</option>
      </select>
      <select name="ball_2" id="ball_2">
        <option value="1" <?=$rs['ball_2']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_2']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_2']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_2']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_2']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_2']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_2']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_2']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_2']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_2']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_2']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_2']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_2']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_2']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_2']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_2']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_2']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_2']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_2']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_2']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_2']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_2']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_2']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_2']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_2']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_2']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_2']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_2']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_2']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_2']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_2']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_2']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_2']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_2']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_2']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_2']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_2']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_2']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_2']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_2']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_2']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_2']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_2']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_2']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_2']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_2']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_2']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_2']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_2']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_2']=='' || $rs['ball_2']=='0' ? 'selected' : ''?>>正二</option>
        </select>
      <select name="ball_3" id="ball_3">
        <option value="1" <?=$rs['ball_3']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_3']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_3']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_3']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_3']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_3']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_3']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_3']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_3']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_3']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_3']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_3']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_3']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_3']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_3']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_3']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_3']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_3']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_3']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_3']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_3']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_3']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_3']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_3']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_3']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_3']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_3']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_3']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_3']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_3']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_3']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_3']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_3']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_3']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_3']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_3']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_3']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_3']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_3']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_3']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_3']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_3']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_3']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_3']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_3']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_3']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_3']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_3']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_3']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_3']=='' || $rs['ball_3']=='0' ? 'selected' : ''?>>正三</option>
        </select>
      <select name="ball_4" id="ball_4">
        <option value="1" <?=$rs['ball_4']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_4']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_4']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_4']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_4']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_4']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_4']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_4']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_4']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_4']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_4']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_4']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_4']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_4']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_4']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_4']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_4']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_4']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_4']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_4']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_4']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_4']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_4']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_4']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_4']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_4']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_4']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_4']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_4']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_4']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_4']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_4']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_4']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_4']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_4']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_4']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_4']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_4']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_4']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_4']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_4']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_4']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_4']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_4']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_4']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_4']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_4']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_4']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_4']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_4']=='' || $rs['ball_4']=='0' ? 'selected' : ''?>>正四</option>
        </select>
      <select name="ball_5" id="ball_5">
        <option value="1" <?=$rs['ball_5']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_5']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_5']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_5']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_5']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_5']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_5']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_5']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_5']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_5']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_5']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_5']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_5']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_5']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_5']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_5']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_5']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_5']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_5']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_5']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_5']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_5']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_5']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_5']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_5']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_5']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_5']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_5']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_5']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_5']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_5']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_5']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_5']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_5']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_5']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_5']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_5']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_5']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_5']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_5']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_5']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_5']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_5']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_5']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_5']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_5']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_5']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_5']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_5']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_5']=='' || $rs['ball_5']=='0' ? 'selected' : ''?>>正五</option>
        </select>
      <select name="ball_6" id="ball_6">
        <option value="1" <?=$rs['ball_6']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_6']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_6']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_6']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_6']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_6']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_6']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_6']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_6']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_6']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_6']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_6']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_6']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_6']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_6']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_6']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_6']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_6']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_6']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_6']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_6']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_6']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_6']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_6']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_6']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_6']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_6']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_6']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_6']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_6']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_6']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_6']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_6']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_6']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_6']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_6']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_6']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_6']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_6']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_6']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_6']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_6']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_6']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_6']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_6']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_6']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_6']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_6']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_6']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_6']=='' || $rs['ball_6']=='0' ? 'selected' : ''?>>正六</option>
        </select>
      <select name="ball_7" id="ball_7">
        <option value="1" <?=$rs['ball_7']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_7']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_7']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_7']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_7']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_7']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_7']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_7']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_7']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_7']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_7']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_7']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_7']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_7']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_7']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_7']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_7']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_7']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_7']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_7']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_7']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_7']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_7']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_7']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_7']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_7']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_7']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_7']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_7']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_7']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_7']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_7']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_7']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_7']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_7']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_7']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_7']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_7']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_7']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_7']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_7']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_7']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_7']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_7']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_7']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_7']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_7']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_7']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_7']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_7']=='' || $rs['ball_7']=='0' ? 'selected' : ''?>>特码</option>
      </select></td>
  </tr>
  <tr>
    <td height="40" colspan="2" align="left" bgcolor="#F2F4F6"><input name="submit" type="submit" class="formButton" style="margin-left:110px;" value="确认发布"/></td>
    </tr>
</table>
</form>
<table id="listTables" class="listTables"> 
            <tr>
              <th align="center">彩票期号</th>
              <th align="center">开盘时间</th>
              <th align="center">封盘时间</th>
              <th align="center">正一</th>
              <th align="center">正二</th>
              <th align="center">正三</th>
              <th align="center">正四</th>
        <th height="25" align="center">正五</th>
        <th align="center">正六</th>
        <th align="center">特码</th>
        <th align="center">总和</th>
        <th align="center">开奖时间</th>
        <th align="center">结算</th>
        <th align="center">操作</th>
          </tr>
<?php
$sql		=	"select id from c_auto_0 order by qishu desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
$pagenum	=	50;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
$myPage=new pager($sum,intval($CurrentPage),$pagenum);
$pageStr= $myPage->GetPagerContent();

$id		=	'';
$i			=	1; //记录 uid 数
$start	=	($CurrentPage-1)*$pagenum+1;
$end	=	$CurrentPage*$pagenum;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($id){
	$id	=	rtrim($id,',');
	$sql	=	"select * from c_auto_0 where id in($id) order by qishu desc";
	$query	=	$mysqli->query($sql);
	$time	=	time();
	while($rows = $query->fetch_array()){
		$hm 		= array();
		$hm[]		= $rows['ball_1'];
		$hm[]		= $rows['ball_2'];
		$hm[]		= $rows['ball_3'];
		$hm[]		= $rows['ball_4'];
		$hm[]		= $rows['ball_5'];
		$hm[]		= $rows['ball_6'];
		$hm[]		= $rows['ball_7'];
		if($rows['ok']==1){
			$ok = '<font color="#FF0000">已结算</font>';
		}else{
			$ok = '<a href="Auto/Six.php?qi='.$rows['qishu'].'" onclick="return js();" ><font color="#0000FF">点击结算</font></a>';
		}
?>
      <tr>
        <td height="25" align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['opentime']?></td>
        <td align="center" valign="middle"><?=$rows['endtime']?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_1'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_2'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_3'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_4'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_5'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_6'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_7'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($hm,2)?></td>
        <td align="center"><?=$rows['datetime']?></td>
        <td align="center"><?=$ok?></td>
        <td align="center"><a href="?id=<?=$rows["id"]?>&page=<?=$_REQUEST['page']?>">编辑</a></td>
        </tr>
<?php
	}
}
?>
    </table>
<div class="pagerBar"><?php echo $pageStr;?></div>
</div>
</body>
</html>