<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/config.php");
if($_SESSION["uid"]==""){
	echo "<script>alert(\"请登录后再进行存款和提款操作\");location.href='zhuce.php';</script>";
	exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>转账信息提交</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/styles/ucenter.css">
<script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>

    <script language="javascript" type="text/javascript">
  
        function next_checkNum_img(){
			document.getElementById("checkNum_img").src = "yzm.php?"+Math.random();
			return false;
		}
        
        //数字验证 过滤非法字符
        function clearNoNum(obj){
	        //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/[^\d.]/g,"");
	        //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/^\./g,"");
	        //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(/\.{2,}/g,".");
	        //保证.只出现一次，而不能出现两次以上
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	        if(obj.value != ''){
	        var re=/^\d+\.{0,1}\d{0,2}$/;
                  if(!re.test(obj.value))   
                  {   
			          obj.value = obj.value.substring(0,obj.value.length-1);
			          return false;
                  } 
	        }
        }
        
        function showTypeTxt(t){
            if(t==1){
                $('#v_type').hide();
            }else{
                $('#v_type').show();
            }
        }
        
        function showType(){
            if($('#InType').val()=='0'){
                $('#v_type').show();
                $('#tr_v').hide();
            }else if($('#InType').val()=='网银转账' || $('#InType').val()=='支付宝转账'){
                $('#tr_v').show();
                $('#v_Name').val('请输入持卡人姓名');
                $('#v_type').hide();
                $('#IntoType').val($('#InType').val());
            }else{
                $('#v_type').hide();
                $('#IntoType').val($('InType').val());
                $('#tr_v').hide();
            }
        }
        
		function showType1(){
            if($('#IntoBank').val()=='支付宝'){
				 $('#InType').val('支付宝转账');
				showType();
            }
        }
		
     function SubInfo(){
			var hk	=	$('#v_amount').val();
            if(hk==''){
                alert('请输入转账金额');
                $('#v_amount').focus();
                return false;
            }else{
      				hk = hk*1;
      				if(hk<100){
      					alert('转账金额最底为：100元');
      					$('#v_amount').select();
      					return false;
      				}
      			}
            if($('#IntoBank').val()==''){
                alert('为了更快确认您的转账,请选择转入银行');
                $('#IntoBank').focus();
                return false;
            }
            if($('#cn_date').val()==''){
                alert('请选择汇款日期');
                return false;
            }
  
            if($('#InType').val()==''){
                alert('为了更快确认您的转账,请选择汇款方式');
                $('#InType').focus();
	             return false;
            }
            if($('#InType').val()=='0'){
                if($('#v_type').val()!= '' && $('#v_type').val()!='请输入其它汇款方式'){
                    $('#IntoType').val($('#v_type').val());
                }else{
                    alert('请输入其它汇款方式');
                    $('#v_type').focus();
                    return false;
                }
            }
            if($('#InType').val()=='网银转账'){
                if($('#v_Name').val()!=''&& $('#v_Name').val()!='请输入持卡人姓名' && $('#v_Name').val().length>1 && $('#v_Name').val().length<20){
                    var tName =$('#v_Name').val();
                    var yy = tName.length;
                    for(var xx=0;xx<yy; xx++){
                        var zz = tName.substring(xx,xx+1);
                        if(zz!='·'){
                            if(!isChinese(zz)){
                                alert('请输入中文持卡人姓名,如有其他疑问,请联系在线客服');
                                $('#v_Name').focus();
	                            return false;
                            }
                        }
                    }
                }else{
                    alert('为了更快确认您的转账,网银转账请输入持卡人姓名');
                    $('#v_Name').focus();
                    return false;
                }
            }
            if($('#v_site').val()==''){
                alert('请填写汇款地点');
                $('#v_site').focus();
                return false;
            }
            if($('#v_site').val().length>49){
                alert('汇款地点不要超过50个中文字符');
                $('#v_site').focus();
                return false;
            }
            if($('#vlcodes').val()==''){
                alert('请输入验证码');
                $('#vlcodes').focus();
                return false;
            }
            return true;
            //$('#form1').submit(); 
        }
        
        function alertMsg(i){
            if(i==1){
                alert('阁下,您好:\n您已经成功提交一笔 汇款信息 未处理,请等待处理后再提交新的汇款信息! ');
                LoadValImg();
            }
            if(i==2){
                alert('汇款信息提交成功，请等待处理');
                window.location.href='ScanTrans.aspx';
            }
        }
        //是否是中文
    function isChinese(str){
	    return /[\u4E00-\u9FA0]/.test(str);
    }
	
	function url(u){
		window.location.href=u;
	}
    </script>
	<style type="text/css">
	.dv{ line-height:25px;}
	.body2{
		width: 737px;
		height: auto;
		padding: 10px 0 0 12px;
		margin-left:10px;
		margin-right:10px;
		float:left;
	}
	.tds {
		line-height:25px;
	}
	.STYLE1 {font-weight: bold}
    .STYLE2 {color: #0000FF}
	.STYLE12{ color:#F00}
    </style>
</head>

<body>
<div class="h10"></div>
<script type="text/javascript" src="js/calendar.js"></script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>公司入款</h3>
  </div>
   <div class="panel-body">
          <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="100%" height="61" align="left" colspan="3">
			    <p style="font-size:13px;"><strong>温馨提示:</strong></p>
			    <p style="line-height:22px;">
                &nbsp;一、请在金额转出之后务必填写网页下方的汇款信息表格，以便我们财务人员能及时为您确认添加金额到您的会员账户。<br>
                &nbsp;二、本公司最低汇款金额为100元。<br>
                &nbsp;三、本公司不支持跨行转账方式进行汇款。<br>
                </p>
		          <span><br />
	              <span class="STYLE7"><b>汇款转账详细账户资料：</b></span></span><br />
		        </p>
                  <table class="table table-bordered">
<?php
include_once("cache/bank.php");
foreach($bank[$_SESSION["gid"]] as $k=>$arr){
?>
 <tr>
                      <td>
					  <span style="color:#00925f;"><?=$arr['card_bankName']?>：<?=$arr['card_ID']?></span><br/>
                      <span style="color:#00b8ff;">开户名：<?=$arr['card_userName']?></span> ; 
                      <span style="color:#fa5d72;">开户地区：<?=$arr['card_address']?></span>
                      </td>
                    </tr>
<?php
}
?>
                  </table>
			      </p>
				<hr width="100%" size="1" noshade="noshade"/>
			  <div style="margin-top:10px;margin:10px 0 10px 0;"><span class="STYLE1"><strong>汇款信息提交</strong></span>&nbsp;&nbsp;<a class="len" onclick="url('user/cha_huikuan.php?s_time=<?=date("Y-m-d",time()-1123200)?>&e_time=<?=date("Y-m-d",time())?>')" style="color:#00F;text-decoration: underline;">汇款信息回查</a></div>
              
              <form id="form1" name="form1" action="huikuanDao.php?into=true" method="post" onsubmit="return SubInfo();">
    <table class="table table-bordered">
                    <tr>
                        <td align="right"> 用户帐号:</td>
                        <td align="left"><span class="STYLE5">
                        <?=$_SESSION['username'];?>
                        </span></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="STYLE12">*</span> 存款金额:</td>
                        <td align="left"><input name="v_amount" type="text" id="v_amount" class="form-control" onkeyup="clearNoNum(this);" size="15"/></td>
                    </tr>
                    <tr>
                        <td align="right">
                        <span class="STYLE12">* </span>汇款银行:</td>
                        <td align="left">
                          <select id="IntoBank" name="IntoBank" class="form-control" onchange="showType1();">
                            <option value="" selected="selected">请选择转入银行</option>
<?php
foreach($bank[$_SESSION["gid"]] as $k=>$arr){
?>
                            	<option value="<?=$arr['card_bankName']?>"><?=$arr['card_bankName']?></option>
<?php
}
?>
                          </select>
                        </span> </td>
                    </tr>
                    <tr>
                        <td align="right">
                        <span class="STYLE12">* </span>汇款日期:</td>
                      <td align="left" class="font-black"><input name="cn_date" type="text" id="cn_date" onclick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly value="<?=date("Y-m-d",time())?>" class="form-control"/> <br><select name="s_h" id="s_h" class="form-control" style="display:inline-block;width:70px;">
                            <option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                          </select>
                        时
                        <select name="s_i" id="s_i" class="form-control" style="display:inline-block;width:70px;">
                          <option value="00">00</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                          <option value="32">32</option>
                          <option value="33">33</option>
                          <option value="34">34</option>
                          <option value="35">35</option>
                          <option value="36">36</option>
                          <option value="37">37</option>
                          <option value="38">38</option>
                          <option value="39">39</option>
                          <option value="40">40</option>
                          <option value="41">41</option>
                          <option value="42">42</option>
                          <option value="43">43</option>
                          <option value="44">44</option>
                          <option value="45">45</option>
                          <option value="46">46</option>
                          <option value="47">47</option>
                          <option value="48">48</option>
                          <option value="49">49</option>
                          <option value="50">50</option>
                          <option value="51">51</option>
                          <option value="52">52</option>
                          <option value="53">53</option>
                          <option value="54">54</option>
                          <option value="55">55</option>
                          <option value="56">56</option>
                          <option value="57">57</option>
                          <option value="58">58</option>
                          <option value="59">59</option>
                        </select>
                        分
                        <select name="s_s" id="s_s" class="form-control" style="display:inline-block;width:70px;">
                          <option value="00">00</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                          <option value="32">32</option>
                          <option value="33">33</option>
                          <option value="34">34</option>
                          <option value="35">35</option>
                          <option value="36">36</option>
                          <option value="37">37</option>
                          <option value="38">38</option>
                          <option value="39">39</option>
                          <option value="40">40</option>
                          <option value="41">41</option>
                          <option value="42">42</option>
                          <option value="43">43</option>
                          <option value="44">44</option>
                          <option value="45">45</option>
                          <option value="46">46</option>
                          <option value="47">47</option>
                          <option value="48">48</option>
                          <option value="49">49</option>
                          <option value="50">50</option>
                          <option value="51">51</option>
                          <option value="52">52</option>
                          <option value="53">53</option>
                          <option value="54">54</option>
                          <option value="55">55</option>
                          <option value="56">56</option>
                          <option value="57">57</option>
                          <option value="58">58</option>
                          <option value="59">59</option>
                        </select>秒</td>
                    </tr>
                    <tr>

                        <td align="right">
                        <span class="STYLE12">*</span> 汇款方式:</td>
                        <td align="left">
                        <div class="row">
                            <div class="col-sm-6">
                            <select id="InType" name="InType" onchange="showType();" class="form-control">
                              <option value="">请选择汇款方式</option>
                              <option value="银行柜台">银行柜台</option>  
                              <option value="ATM现金">ATM现金</option>
                              <option value="ATM卡转">ATM卡转</option>
                              <option value="网银转账">网银转账</option>
                              <option value="支付宝转账">支付宝转账</option>
                              <option value="0">其它[手动输入]</option>
                            </select>
                            </div>
                            <div class="col-sm-6">
                            
                            <input id="v_type" name="v_type" type="text" size="19" value="请输入其它汇款方式" onfocus="javascript:$('v_type').select();" class="form-control" style=" display:none;" />
                            <input type="hidden" id="IntoType" name="IntoType" value="" class="form-control" /> 
                            </div></div>  </td>
                    </tr>
                    <tr id="tr_v" style="display:none;">
                        <td align="right">
                        <span class="STYLE12">*</span>汇款方持卡人姓名:</td>
                        <td align="left"> <input name="v_Name" type="text" id="v_Name" class="form-control" onfocus="javascript:this.select();" size="34" /></td>
                    </tr>
                     <tr>
                        <td align="right">
                        <span class="STYLE12">*</span> 汇款地点:</td>
                        <td align="left"><span style="color: #999999">
                        
                        <input id="v_site" name="v_site" type="text" size="34" class="form-control" />
                      <span class="STYLE2" style="color: #333">(您汇款的所在地区)</span></span></td>
                    </tr>
                    
                    <tr>

                        <td height="35" align="right">
                        <span class="STYLE12">* </span>验 证 码:</td>
                        <td align="left" valign="middle"><table width="135">
                              <tr><td class="STYLE5"><input name="vlcodes" type="text" id="vlcodes" size="10" maxlength="4" onfocus="next_checkNum_img()" onkeyup="clearNoNum(this);" class="form-control"/></td><td>&nbsp;</td><td>
                                <img src="yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="cursor:pointer; top:3px;" onclick="next_checkNum_img()" />

                          </td></tr></table>                        </td>
                    </tr>
					<tr><td height="35" align="right">&nbsp;</td>
					<td height="40" align="left" valign="middle">
                       <input name="SubTran" type="submit" class="btn btn-success btn-lg btn-block" id="SubTran" value="提交信息" />					</td>
					</tr>
                </table>
              </form>
              </td>
            </tr>
            
            <tr>
              <td colspan="3" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr >
                  <td align="left" style="padding-top:10px;"><strong class="STYLE1">汇款信息提交说明：</strong></td>
                </tr>
                <tr>

                  <td align="left">
                  <span class="font-hblack"><span >
                  <div style=" line-height:22px; font-size:12px;">
                  (1).请按表格填写准确的汇款转账信息,确认提交后相关财务人员会即时为您查询入款情况!                  </div>
                  <div style=" line-height:22px;font-size:12px;">
                  (2).请您在转账金额后面加个尾数,例如:转账金额 1000.66 或 1000.88 等,以便相关财务人员更快确认您的转账金额并充值!                  </div>
                  <div style=" line-height:22px;font-size:12px;">
                  (3).如有任何疑问,您可以联系 在线客服,为您提供365天×24小时不间断的友善和专业客户咨询服务!                 </div>
                  </span>                   </span>                  </td>
   
                </tr>
              </table>
			 
			  </td>
            </tr>
      </table>
  </div>
</div>  

<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>