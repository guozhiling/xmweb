<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");


//开始读取期数
$sql		= "select * from c_auto_26 where ok=1  order by qishu desc limit 5 ";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
$datas=array();
while ($rows= $query->fetch_array()) {
$datas[]=array(
'expect'=>$rows['qishu'],
'opencode'=>$rows['ball_1'].','.$rows['ball_2'].','.$rows['ball_3'].','.$rows['ball_4'],
'opentime'=>$rows['datetime'],
		 );
}
$arr['rows']=5;
$arr['code']='jspcdd';
$arr['data']=$datas;

echo json_encode($arr);
?> 