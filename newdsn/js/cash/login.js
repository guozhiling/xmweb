var msg="\u6e38\u5ba2\u76d8\u53e3\u53ea\u4f9b\u8bd5\u73a9\uff0c\u4e0e\u6b63\u5f0f\u4f1a\u5458\u76d8\u53e3\u65e0\u5173!";
$(function(){checklogin("");$("#guestLogin").click(function(){alert(msg);doLogin("!guest!","!guest!")});$(".login input").keypress(function(a){if(13==a.keyCode)return $("#btnlogin").click(),!1});$("#btn-register").click(function(){location.href="/register"});$("#btnlogin").click(function(){var a=$("#username").val(),b=$("#password").val();""==a?dialog.error("\u6d88\u606f","\u7528\u6237\u540d\u548c\u5bc6\u7801\u90fd\u4e0d\u80fd\u4e3a\u7a7a"):""==b?dialog.error("\u6d88\u606f","\u7528\u6237\u540d\u548c\u5bc6\u7801\u90fd\u4e0d\u80fd\u4e3a\u7a7a"):
doLogin(a,b)})});
function doLogin(a,b){dialog.load("\u6b63\u5728\u767b\u5f55\uff0c\u8bf7\u7b49\u5f85...");postUrl="/cashlogin";"undefined"!==typeof window.IS_MOBILE&&(postUrl="/mobile/cashlogin");$.ajax({url:postUrl,type:"POST",dataType:"JSON",data:{account:a,password:b,affKey:$("#aff-key-login").val()},success:function(a){dialog.close();a.success?window.IS_MOBILE?checklogin(a.message):location.href="/member/agreement?"+a.message:a.message?dialog.error("\u6d88\u606f",a.message):dialog.error("\u6d88\u606f","\u62b1\u6b49\uff0c\u767b\u5f55\u5931\u8d25!")},
error:function(a,b,c){alert(a.responseText)}})}
function checklogin(a){a=a?"/member/checklogin?"+a:"/member/checklogin?client="+Math.random();"undefined"!==typeof window.IS_MOBILE&&(a="/mobile"+a);$.ajax({url:a,type:"POST",dataType:"JSON",success:function(a){a.success?("undefined"!==typeof window.IS_MOBILE&&(window.location="/mobile/member/lobby"),$(".header-links").css("display","block"),$(".login").css("display","none"),$(".username").text(a.data.userName),1==a.data.tesing?($(".header-center").css("display","none"),$(".header-payment").css("display",
"none")):($(".header-center").css("display","block"),$(".header-payment").css("display","block"))):($(".login").css("display","block"),$(".header-links").css("display","none"),$(".username").text(""),$(".header-center").css("display","block"),$(".header-payment").css("display","block"))}})};
