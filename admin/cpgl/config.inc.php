<?php
/*�Զ��幥������*/
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');

$dbhost                                = "127.0.0.1";                 // ���ݿ�������
$dbuser                                = "root";                 // ���ݿ��û���
$dbpass                                = "@@##qqaa8520";                         // ���ݿ�����
$dbname                                = "3dy1_db";                 // ���ݿ���
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
?>