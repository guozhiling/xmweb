$(function(){function h(){var a=$(".clearfix input[name=username]").val();if(""==a)dialog.error("\u6d88\u606f","\u8bf7\u8f93\u5165\u8d26\u53f7\u540d\u79f0\uff01");else{var g=$("#aff-key").val();if(""==g)dialog.error("\u6d88\u606f","\u8bf7\u8f93\u5165\u9080\u8bf7\u7801\uff01");else{var b=$(".clearfix input[name=mobile]").val(),c=/^[0-9]*$/;if(void 0===b||""!=b&&c.test(b))if(c=$(".clearfix input[name=wechat]").val(),""==c)dialog.error("\u6d88\u606f","\u8bf7\u8f93\u5165\u5fae\u4fe1\u53f7\uff01");else{var d=
$(".clearfix input[name=password]").val(),e=$(".clearfix input[name=password1]").val();if(""==d)dialog.error("\u6d88\u606f","\u8bf7\u8f93\u5165\u5bc6\u7801\uff01");else if(d!=e)dialog.error("\u6d88\u606f","\u8f93\u5165\u7684\u5bc6\u7801\u4e0d\u4e00\u81f4\uff0c\u8bf7\u91cd\u65b0\u8f93\u5165\uff01");else if(e=$("#code").val(),""==e)dialog.error("\u6d88\u606f","\u8bf7\u8f93\u5165\u9a8c\u8bc1\u7801\uff01");else{var f=getQueryString("aff");if(""==f||null==f)f=LIBS.cookie("affid");$("#btnRegister").attr("disabled",
"disabled");$("#btnRegister").val("\u63d0\u4ea4\u4e2d\uff0c\u8bf7\u7b49\u5f85...");$.post("reg",{username:a,password:d,parent:f,wechat:c,mobile:b,affKey:g,code:e},function(b){b.success?($("#aff-key-login").val(g),dialog.alert1("\u6d88\u606f","\u606d\u559c\uff0c\u6ce8\u518c\u6210\u529f\uff01",{"\u9a6c\u4e0a\u767b\u5f55":function(){doLogin(a,d)}},"/index")):(dialog.error("\u6d88\u606f",b.message),$(".capcha img").click());$("#btnRegister").removeAttr("disabled");$("#btnRegister").val("\u521b\u5efa\u5e10\u53f7")})}}else dialog.error("\u6d88\u606f",
"\u8bf7\u8f93\u5165\u6b63\u786e\u768411\u4f4d\u6570\u5b57\u624b\u673a\u53f7\u7801\uff01")}}}$(".capcha img").click(function(){$(this).attr("src","code?_="+(new Date).getTime())});$("input[name=username]").change(function(){var a=$(this).val();""!=a&&(4>a.length?dialog.error("\u6d88\u606f","\u5e10\u6237\u540d\u75314-10\u4e2a\u5b57\u7b26\u7ec4\u6210\uff01"):$.get("check",{username:$(this).val()},function(a){a?$("#nameTips").html("\uff0a\u8be5\u8d26\u53f7\u5df2\u88ab\u6ce8\u518c\uff0c\u4e0d\u53ef\u7528").css("color",
"red"):$("#nameTips").html("\uff0a\u8be5\u8d26\u53f7\u53ef\u7528").css("color","blue")}))});$("#btnRegister").click(function(){h()})});
