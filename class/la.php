<?php
class la{
	static function ip_la(){
	
		global $mysqlio;
		$ip		=	$_SERVER["REMOTE_ADDR"];
		$sql	=	"select id from ip_la where ip='$ip' and today like('".date('Y-m-d')."%') limit 1";
		$query	=	$mysqlio->query($sql);
		$rows	=	$query->fetch_array();
		if($rows['id'] > 0){
			$sql=	"update ip_la set his=his+1 where id=".$rows['id'];
		}else{
			include_once("../ip.php");
			$ClientSity =	iconv("GB2312","UTF-8",convertip($ip,'../'));   //取出客户端IP所在城市
			$browser	=	$_SERVER["HTTP_USER_AGENT"];
			if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")) $browser			=	'Internet Explorer 8.0';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")) $browser	=	'Internet Explorer 7.0';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0")) $browser	=	'Internet Explorer 6.0';  
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox/3")) $browser	=	'Firefox 3';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox/2")) $browser	=	'Firefox 2';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"Chrome")) $browser		=	'Google Chrome';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari")) $browser		=	'Safari';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"Opera")) $browser		=	'Opera';
			else if(strpos($_SERVER["HTTP_USER_AGENT"],"TheWorld")) $browser	=	'TheWorld';

			include_once("../cache/conf.php");
			$sql		=	"insert into `ip_la` (ip,ip_address,website,today,browser) VALUES ('$ip','$ClientSity','$conf_www',now(),'$browser')";
		}
		$mysqlio->query($sql);
	}
}
?>