!function(g){var p=null,r=0,h,c,n,t=0,e=g("#red_pocket_div"),q=g("#red_pocket_list"),j=g(".window_shade_div"),m=function(){var u=g(this);if(u.hasClass("disabled")){return false}u.hide();q.empty().html('<div style="top:100px" action="red_pocket" class="dis_txt_high red_pocket bg1 shake"><div class="before"><div class="content"></div></div></div>');u.parent().addClass("shake");setTimeout(l,1000)},f=function(){j.hide();q.hide();return},s=function(){--h;var u,x,v,w="";u=Math.floor(h/86400);x=Math.floor((h%86400)/3600);v=Math.floor((h%3600)/60);w=h%60;if(u){c.text(u+"天"+x+"小时"+v+"分钟")}else{if(x){c.text(x+"小时"+v+"分钟"+w+"秒")}else{if(v){c.text(v+"分钟"+w+"秒")}else{if(w){c.text(w+"秒")}else{clearInterval(n);b()}}}}},d=function(u){var v="";if(u.msg=="actstart"||(u.msg=="actbefore"&&u.lefttime>0)){v='<div style="top:100px;" action="red_pocket" class="dis_txt_high red_pocket bg1" index='+(u.datas.serial_id||"")+">";v+='<div class="close sprite" title="关闭" style="display:inline-block;"></div><div class="red_act_tit">AG 红包</div>';v+='<div class="red_act_btn"><a href="javascript:;"'+(u.msg=="actstart"?"":' class="disabled"')+">抢红包</a></div>";if(u.msg!="actstart"){v+='<div class="red_act_timer">距活动还有 <span id="redpocket_timer">---</span></div>'}v+='<div class="before">';v+='<div class="fetch_ul_name">牛人红包榜:</div><ul class="fetch_ul">';if(u.datas){g.each(u.datas,function(w,x){if(w<6){v+="<li>"+x.uname+'<span style="float:right">'+x.money+" 元</span></li>"}})}v+="</ul></div>";v+="</div>"}else{if(u.msg=="notlogin"||u.msg=="notphone"||u.msg=="notbank"||u.msg=="actdone"||u.msg=="actempty"){v='<div style="top:100px" action="red_pocket" class="dis_txt_high red_pocket bg1">';v+='<div class="after" style="display:block;">';v+='<div class="close sprite" title="关闭" style="display:inline-block;"></div>';v+='<div class="bonus"></div>';v+='<div class="off"><div class="content"><div class="tit" style="font-size:18px;line-height:36px;">';if(u.msg=="notlogin"){v+='没有登录无法参加活动哦~<br/>马上去 <a href="/Index/login" style="color:#F3E41E;text-decoration: underline;">登录</a> / <a href="/Index/regist" style="color:#F3E41E;text-decoration: underline;">注册</a> ?'}else{if(u.msg=="notphone"){v+='您还没有绑定手机号码?<br/>马上去 <a href="/Service/setmobile" style="color:#F3E41E;text-decoration: underline;">绑定手机号</a> ?'}else{if(u.msg=="notbank"){v+='您还没有绑定银行卡?<br/>马上去 <a href="/Service/bindcard" style="color:#F3E41E;text-decoration: underline;">绑定银行卡</a> ?'}else{if(u.msg=="actdone"){v+="当前活动已经结束了<br/>请多多留意 AG 活动公告~"}else{if(u.msg=="actempty"){v+="您来晚了,本轮红包被抢光了~"}}}}}v+='</div><div class="fetch_ul_name">牛人红包榜:</div><ul class="fetch_ul">';if(u.datas){g.each(u.datas,function(w,x){if(w<5||(w==5&&u.msg=="actempty")){v+="<li>"+x.uname+'<span style="float:right">'+x.money+" 元</span></li>"}})}v+="</ul></div></div>";v+="</div>";v+="</div>"}else{if(u.status=="ok"&&u.msg=="redpocket"){v='<div style="top:100px" action="red_pocket" class="dis_txt_high red_pocket bg1">';v+='<div class="close sprite" title="关闭" style="display:inline-block;"></div><div class="open_btn sprite"></div>';v+='<div class="before">';v+='<div class="content">'+(u.content||"")+"</div>";v+="</div>";v+="</div>"}else{if(u.msg=="getpocket"){var v='<div style="top:100px" action="red_pocket" class="dis_txt_high red_pocket bg1">';v+='<div class="after" style="display:block;">';v+='<div class="close sprite" title="关闭"></div>';v+='<div class="bonus"></div>';v+="<div class='on' style='top:0px;'>";v+="<div class='title'>恭喜您获得</div>";v+="<div class='money'>"+(u.money||0)+" 元</div>";v+="<div class='bottom'>红包已经自动发放到您的账户</div>";v+="<div class='content'>";v+="<div class='tit'"+(u.isactivity?' style="position:relative;top:-16px;"':"")+">已领取 "+u.name+" 1 个 , 共 "+(u.money||0)+" 元.</div>";if(u.isactivity){v+="<div class='red_act_btn'><a href='javascript:;'>再抢一个</a></div>"}v+="<div class='fetch_ul_name'>牛人红包榜:</div><ul class='fetch_ul'>";if(u.datas){g.each(u.datas,function(w,x){if(w<5||(w<7&&(!u.isactivity))){v+="<li>"+x.uname+'<span style="float:right">'+x.money+" 元</span></li>"}})}v+="</ul>";v+="</div>";v+="</div>";v+="</div>";v+="</div>";q.empty().html(v);q.find(".close").off().on("click",f);q.find(".red_act_btn a").off().on("click",m);q.find(".after .on").stop().animate({top:"-51px"},600,function(){q.find(".after .close").show()});return}}}}if(v!=""){q.empty().html(v);q.find(".open_btn").off().on("click",m);q.find(".close").off().on("click",f);q.find(".red_act_btn a").off().on("click",m);if(u.msg=="actbefore"&&u.lefttime){h=u.lefttime;c=g("#redpocket_timer");if(!c.length){c=null}else{n=setInterval(s,1000)}}}},a=function(){if(g(this).hasClass("disabled")){return false}g(this).addClass("disabled");b()},l=function(){g.ajax({url:"/Special/newyear01?act=getpocket&redid="+t,dataType:"json",type:"get",cache:false,timeout:9000,success:d,error:k})},k=function(){setTimeout(l,8000)},b=function(){g.ajax({url:"/Special/newyear01?act=getcount",dataType:"json",type:"get",cache:false,timeout:9000,success:d,error:i})},i=function(){setTimeout(b,8000)};var o=function(){j.show();q.show()};e.find("div[class!='close']").click(o);e.find("div.close").click(function(){e.hide();q.hide()});b();window.OpenRedpocket=o}(jQuery);
