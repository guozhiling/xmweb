<?php
header("Content-type:text/html; charset=gb2312"); 
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("../config.php");
//----------------------------------------------------
//  ��������
//  Receive the data
//----------------------------------------------------
$billno = $_GET['billno'];
$amount = $_GET['amount'];
$mydate = $_GET['date'];
$succ = $_GET['succ'];
$msg = $_GET['msg'];
$attach = $_GET['attach'];
$ipsbillno = $_GET['ipsbillno'];
$retEncodeType = $_GET['retencodetype'];
$currency_type = $_GET['Currency_type'];
$signature = $_GET['signature'];

//'----------------------------------------------------
//'   Md5ժҪ��֤
//'   verify  md5
//'----------------------------------------------------

//RetEncodeType����Ϊ17��MD5ժҪ����ǩ����ʽ��
//���׷��ؽӿ�MD5ժҪ��֤��������Ϣ���£�
//billno+��������š�+currencytype+�����֡�+amount+��������+date+���������ڡ�+succ+���ɹ���־��+ipsbillno+��IPS������š�+retencodetype +�����׷���ǩ����ʽ��+���̻��ڲ�֤�顿
//��:(billno000001000123currencytypeRMBamount13.45date20031205succYipsbillnoNT2012082781196443retencodetype17GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ)

//���ز����Ĵ���Ϊ��
//billno + mercode + amount + date + succ + msg + ipsbillno + Currecny_type + retencodetype + attach + signature + bankbillno
//ע2����RetEncodeType=17ʱ��ժҪ������ȫת��Сд�ַ���������֤��ʱ�������ɵ�Md5ժҪ��ת��Сд�������Ƚ�
$content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;
//���ڸ��ֶ��з����̻���½merchant.ips.com.cn���ص�֤��
$cert = $pay_mkey;
$signature_1ocal = md5($content . $cert);

if ($signature_1ocal == $signature)
{
	//----------------------------------------------------
	//  �жϽ����Ƿ�ɹ�
	//  See the successful flag of this transaction
	//----------------------------------------------------
	if ($succ == 'Y')
	{
		/**----------------------------------------------------
		*�ȽϷ��صĶ����źͽ���������ݿ��еĽ���Ƿ����
		*compare the billno and amount from ips with the data recorded in your datebase
		*----------------------------------------------------
		
		if(����)
			echo "��IPS���ص����ݺͱ��ؼ�¼�Ĳ����ϣ�ʧ�ܣ�"
			exit
		else
			'----------------------------------------------------
			'���׳ɹ��������������ݿ�
			'The transaction is successful. update your database.
			'----------------------------------------------------
		end if
		**/
		echo '���׳ɹ�';
        
        /* ��Ա��� ��ʼ */
        $sql="select uid,username,money from k_user where username='$attach' limit 1";
		$query	=	$mysqli->query($sql);
		$rows   =	$query->fetch_array();
		$cou	=	$query->num_rows;
		if($cou<=0){
			echo "������Ϣ����!";
	    	exit;
		}
		$assets	 =	$rows['money'];
		$uid	 =	$rows['uid'];
		$username=	$rows['username'];
        echo "֧���ɹ�".'<br>';
        echo "������=".$billno.'<br>';
        echo "���=".$amount.'<br>';
        echo "����=".$currency_type.'<br>';
        $sql="select * from k_money where m_order = '".$billno."'";
        $query	=	$mysqli->query($sql);
        $cou	=	$query->num_rows;
        if ($cou==0){
            $sql	=	"insert into k_money(uid,m_value,m_order,status,assets,balance,type) values($uid,$amount,'$billno',2,$assets,$assets+$amount,1)";
            $mysqli->query($sql);
            $m_id = $mysqli->insert_id;
            $sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='�ö������߳�ֵ�����ɹ�',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
            $mysqli->query($sql);
			echo "֧���ɹ�";
        }
        /* ��Ա��� ���� */
	}
	else
	{
		echo '����ʧ�ܣ�';
		exit;
	}
}
else
{
	echo 'ǩ������ȷ��';
	exit;
}
?>