﻿<? header("content-Type: text/html; charset=utf-8");?> 
<?php
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("../config.php");
// 公共函数定义
function HexToStr($hex)
{
	$string="";
	for ($i=0;$i<strlen($hex)-1;$i+=2)
		$string.=chr(hexdec($hex[$i].$hex[$i+1]));
	return $string;
} 

//=========================== 把商家的相关信息返回去 =======================				
$m_id		= 	'';			 //商家号	
$m_orderid	= 	'';			//商家订单号
$m_oamount	= 	'';			//支付金额
$m_ocurrency= 	'';			//币种		
$m_language	= 	'';			//语言选择
$s_name		= 	'';			//消费者姓名
$s_addr		= 	'';			//消费者住址
$s_postcode	= 	''; 		//邮政编码
$s_tel		= 	'';			//消费者联系电话
$s_eml		= 	'';			//消费者邮件地址
$r_name		= 	'';			//消费者姓名
$r_addr		= 	'';			//收货人住址
$r_postcode	= 	''; 		//收货人邮政编码
$r_tel		= 	'';			//收货人联系电话
$r_eml		= 	'';			//收货人电子地址
$m_ocomment	= 	''; 		//备注
$modate		=	'';			//返回日期
$State		=	'';			//支付状态2成功,3失败
	
//接收组件的加密
$OrderInfo	=	$_POST['OrderMessage'];			//订单加密信息

$signMsg 	=	$_POST['Digest'];				//密匙
//接收新的md5加密认证

//检查签名
$key = $pay_mkey;   //<--支付密钥--> 注:此处密钥必须与商家后台里的密钥一致
//$digest = $MD5Digest->encrypt($OrderInfo.$key);
$digest = strtoupper(md5($OrderInfo.$key));
?>
<?php
if ($digest == $signMsg)
{
	//解密
	//$decode = $DES->Descrypt($OrderInfo, $key);
	$OrderInfo = HexToStr($OrderInfo);
	//=========================== 分解字符串 ====================================
	$parm=explode("|", $OrderInfo);

	$m_id		= 	$parm[0];				
	$m_orderid	= 	$parm[1];		
	$m_oamount	= 	$parm[2];			
	$m_ocurrency= 	$parm[3];				
	$m_language	= 	$parm[4];			
	$s_name		= 	$parm[5];				
	$s_addr		= 	$parm[6];				
	$s_postcode	= 	$parm[7];		
	$s_tel		= 	$parm[8];			
	$s_eml		= 	$parm[9];			
	$r_name		= 	$parm[10];			
	$r_addr		= 	$parm[11];				
	$r_postcode	= 	$parm[12];			
	$r_tel		= 	$parm[13];			
	$r_eml		= 	$parm[14];			
	$m_ocomment	= 	$parm[15];
	$modate		=	$parm[16];
	$State		=	$parm[17];
		
	if ($State == 2)
	{
		$sql="select uid,username,money from k_user where username='$s_name' limit 1";
		$query	=	$mysqli->query($sql);
		$rows	=	$query->fetch_array();
		$cou	=	$query->num_rows;
		if($cou<=0){
			echo "返回信息错误!";
			exit;
		}
		$assets	 =	$rows['money'];
		$uid	 =	$rows['uid'];
		$username=	$rows['username'];
		echo "支付成功".'<br>';
		echo "订单号=".$m_orderid.'<br>';
		echo "金额=".$m_oamount.'<br>';
		echo "币种=".$m_ocurrency.'<br>';
		$sql="select * from k_money where m_order = '".$m_orderid."'";
		$query	=	$mysqli->query($sql);
		$cou	=	$query->num_rows;
		if ($cou==0){
			$sql	=	"insert into k_money(uid,m_value,m_order,status,assets,balance,type) values($uid,$m_oamount,'$m_orderid',2,$assets,$assets+$m_oamount,1)";
			$mysqli->query($sql);
			$m_id 	=	$mysqli->insert_id;
			$sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
			$mysqli->query($sql);
			echo "支付成功";
		}
	}
	else 
	{
		echo "支付失败";
	}
?>
<?php
}else{
	echo "失败，信息可能被篡改";
}
?>
<!--
对于使用dinpay实时反馈接口的商户请注意：
    为了从根本上解决订单支付成功而商户收不到反馈信息的问题(简称掉单).
我公司决定在信息反馈方面实行服务器端对服务器端的反馈方式.即客户支付过后.
我们系统会对商户的网站进行两次支付信息的反馈(即对同一笔订单信息进行两次反馈).
第一次是服务器端对服务器端的反馈.第二次是以页面的形式反馈.两次反馈的时延差在10秒之内.
    请商户那边做好对我们反馈信息的处理. 对我们系统反馈相同的订单信息您那边只
    做一次处理就可以了.以确保消费者的每一笔订单信息在您那边只得到一次相应的服务!!
-->