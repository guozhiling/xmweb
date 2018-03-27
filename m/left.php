<?php 
session_start();
include_once("include/config.php");
include_once("common/login_check.php");
include_once("cache/website.php");
$_SESSION["check_action"]=''; //检测用户是否用软件打水标识
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title><?=$web_site['web_title']?></title>
<link rel="stylesheet" href="/css/bootstrap_s.min.css">
<link rel="stylesheet" href="/css/font-awesome_s.min.css">
<link rel="stylesheet" href="/styles/ucenter.css">
<script src="/assets/jquery.js"></script>
<script src="/js/bootstrap_s.min.js"></script>
<script language="javascript" type="text/javascript" src="script/easing.js"></script>
<script language="javascript" type="text/javascript" src="script/js.js"></script>
<script language="javascript" type="text/javascript" src="script/fun.js"></script>
<script language="javascript" type="text/javascript" src="script/form.js"></script>
<script language="JavaScript">
<!--
window.onerror=function(){return true;}

if(self==top){
	top.location='/';
}

function urlOnclick(url){
	window.open(url,"mainFrame");  
}
function url(url){

	window.open("/help/guize_"+url+'.html');  
}

function refresh_money(){
$.ajax({
	cache: false,
	url: "/get_money.php",
	success:function(data){
		if(data != "") {
		 $("#user_money").html(data);
		}
	}
}); 
window.setTimeout("refresh_money();", 15000); 
}
refresh_money();

function changeMove(obj,type,k)
{
	if(type)
	{
		$(obj).addClass(k+"_1");
	}
	else
	{
		if ($("#"+k+"_01_bet").css("display")=="none")
			$(obj).removeClass(k+"_1");
	}
}

-->
</script>
</head>

<body>
<div class="sports">
	<div class="container1">
		<div class="row1">
			<div role="tabpanel">

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs nav-justified" role="tablist">
			    <li role="presentation" class="active"><a id="button_danshi" href="#single" aria-controls="single" role="tab" data-toggle="tab">单式投注</a></li>
			    <li role="presentation"><a id="button_chuanguan" href="#complex" aria-controls="complex" role="tab" data-toggle="tab">串关投注</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="single">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
	  <a class="ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a1" aria-expanded="true" aria-controls="a1">
	    <i class="icon icon-football"></i> 足球<span id="s_zq" class="badge">0</span>
	  </a>
	  <div id="a1" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_zq_ds" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_gunqiu.html"><i class="fa fa-angle-right"></i>滚球<span id="s_zq_gq" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_ruqiushu.html"><i class="fa fa-angle-right"></i>单双&总入球 <span id="s_zq_rqs" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_banquanchang.html"><i class="fa fa-angle-right"></i>半场&全场<span id="s_zq_bqc" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_bodan.html"><i class="fa fa-angle-right"></i>波胆<span id="s_zq_bd" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="result/bet_match.php"><i class="fa fa-angle-right"></i>足球结果<span id="s_zq_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a2" aria-expanded="false" aria-controls="a2">
	    <i class="icon icon-football"></i> 足球早餐<span id="s_zqzc" class="badge">0</span>
	  </a>
	  <div id="a2" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ftz_danshi.html"><i class="fa fa-angle-right"></i>单式 <span id="s_zqzc_ds" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ftz_ruqiushu.html"><i class="fa fa-angle-right"></i>单双&总入球<span id="s_zqzc_rqs" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ftz_banquanchang.html"><i class="fa fa-angle-right"></i>半场 & 全场<span id="s_zqzc_bqc" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ftz_bodan.html"><i class="fa fa-angle-right"></i>波胆<span id="s_zqzc_bd" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a3" aria-expanded="false" aria-controls="a3">
	    <i class="icon icon-basketball"></i> 篮球<span id="s_lm" class="badge">0</span>
	  </a>
	  <div id="a3" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bk_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_lm_ds" class="badge">0</span></a>
	      <!-- <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bk_danjie.html">单节<span id="s_lm_dj" class="badge">0</span></a> -->
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bk_gunqiu.html"><i class="fa fa-angle-right"></i>滚球<span id="s_lm_gq" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="result/lq_match.php"><i class="fa fa-angle-right"></i>篮球结果<span id="s_lm_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a4" aria-expanded="false" aria-controls="a4">
	    <i class="icon icon-basketball"></i> 篮球早餐<span id="s_lmzc" class="badge">0</span>
	  </a>
	  <div id="a4" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bkz_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_lmzc_ds" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a5" aria-expanded="false" aria-controls="a5">
	    <i class="icon icon-tennis"></i> 网球<span id="s_wq" class="badge">0</span>
	  </a>
	  <div id="a5" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/tennis_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_wq_ds" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="result/tennis_match.php"><i class="fa fa-angle-right"></i>网球结果<span id="s_wq_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a6" aria-expanded="false" aria-controls="a6">
	    <i class="icon icon-volleyball"></i> 排球<span id="s_pq" class="badge">0</span>
	  </a>
	  <div id="a6" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/volleyball_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_pq_ds" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="result/volleyball_match.php"><i class="fa fa-angle-right"></i>排球结果<span id="s_pq_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a7" aria-expanded="false" aria-controls="a7">
	    <i class="icon icon-baseball"></i> 棒球<span id="s_bq" class="badge">0</span>
	  </a>
	  <div id="a7" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/baseball_danshi.html"><i class="fa fa-angle-right"></i>单式<span id="s_bq_ds" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="result/baseball_match.php"><i class="fa fa-angle-right"></i>棒球结果<span id="s_bq_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<!--<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion" data-toggle="collapse" href="#a8" aria-expanded="false" aria-controls="a8">
	    <i class="icon icon-champion"></i> 冠军<span id="s_gj" class="badge">0</span>
	  </a>
	  <div id="a8" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/guanjun.html"><i class="fa fa-angle-right"></i>冠军<span id="s_gj_gj" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/guanjun_result.php"><i class="fa fa-angle-right"></i>冠军结果<span id="s_gj_jg" class="badge">0</span></a>
	    </div>
	  </div>
	</div>-->

</div>

			    </div>
			    <div role="tabpanel" class="tab-pane" id="complex">
			    	

<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
	  <a class="ach list-group-item" data-parent="#accordion1" data-toggle="collapse" href="#b1" aria-expanded="false" aria-controls="b1">
	    <i class="icon icon-football"></i> 今日赛事<span id="cg_f" class="badge">0</span>
	  </a>
	  <div id="b1" class="panel-collapse collapse in" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ft_danshi.html?touzhutype=1"><i class="fa fa-angle-right"></i>足球单式<span id="cg_f_0" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bk_danshi.html?touzhutype=1"><i class="fa fa-angle-right"></i>篮球单式<span id="cg_f_2" class="badge">0</span></a>
	    </div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <a class="collapsed ach list-group-item" data-parent="#accordion1" data-toggle="collapse" href="#b2" aria-expanded="false" aria-controls="b2">
	    <i class="icon icon-football"></i> 早餐赛事<span id="cg_f1" class="badge">0</span>
	  </a>
	  <div id="b2" class="panel-collapse collapse in" role="tabpanel" aria-expanded="false">
	    <div class="list-group">
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/ftz_danshi.html?touzhutype=1"><i class="fa fa-angle-right"></i>足球单式<span id="cg_f1_0" class="badge">0</span></a>
	      <a href="#" class="list-group-item" data-iframe="J_SportsIFrame" data-url="show/bkz_danshi.html?touzhutype=1"><i class="fa fa-angle-right"></i>篮球单式<span id="cg_f1_2" class="badge">0</span></a>
	    </div>
	  </div>
	</div>


</div>


			    </div>
			  </div>

			</div>


		</div>
	</div>
</div>

<?php include_once("scripts.php"); ?> 
 <script type="text/javascript" language="javascript" src="js/ifsports.js"></script>
<script type="text/javascript" language="javascript" src="js/left.js"></script>
<script type="text/javascript" language="javascript" src="js/touzhu.js?v=5"></script>
<script language="javascript">
function ResumeError() {
    return true;
}
$(document).ready(function() {
	<?php if(isset($_GET['touzhutype'])&&$_GET['touzhutype']==1){?>
	//$('#button_chuanguan').trigger('click');
	$('#button_chuanguan').parent().addClass('active').siblings('li').removeClass('active');
	$('#complex').addClass('active');
	$('#single').removeClass('active');
	<?php }else{?>
	$('#button_danshi').trigger('click');
	<?php }?>
});
window.onerror = ResumeError; 
</script>
</body>
</html>