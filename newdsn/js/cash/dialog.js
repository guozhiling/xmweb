var $jscomp={scope:{},findInternal:function(b,c,a){b instanceof String&&(b=String(b));for(var e=b.length,d=0;d<e;d++){var f=b[d];if(c.call(a,f,d,b))return{i:d,v:f}}return{i:-1,v:void 0}}};$jscomp.defineProperty="function"==typeof Object.defineProperties?Object.defineProperty:function(b,c,a){if(a.get||a.set)throw new TypeError("ES3 does not support getters and setters.");b!=Array.prototype&&b!=Object.prototype&&(b[c]=a.value)};
$jscomp.getGlobal=function(b){return"undefined"!=typeof window&&window===b?b:"undefined"!=typeof global&&null!=global?global:b};$jscomp.global=$jscomp.getGlobal(this);$jscomp.polyfill=function(b,c,a,e){if(c){a=$jscomp.global;b=b.split(".");for(e=0;e<b.length-1;e++){var d=b[e];d in a||(a[d]={});a=a[d]}b=b[b.length-1];e=a[b];c=c(e);c!=e&&null!=c&&$jscomp.defineProperty(a,b,{configurable:!0,writable:!0,value:c})}};
$jscomp.polyfill("Array.prototype.find",function(b){return b?b:function(b,a){return $jscomp.findInternal(this,b,a).v}},"es6-impl","es3");
var dialog={openned:!1,close:function(){"undefined"!==typeof window.IS_MOBILE?$("#dialog").dialog("close").remove():window.top.$("#dialog").dialog("close").remove();dialog.openned=!1},_getHTML:function(b){return b.join?"<div class='msg'><p>"+b.join("</p><p>")+"</p></div>":"<div class='msg'><p>"+b+"</p></div>"},_show:function(b,c,a){var e;a.each?(e={},a.each(function(){var a=$(this).attr("href");e[$(this).html()]=function(){window.location.href=a}})):e=a;a=$(".g-bigdiv");0<a.length&&a.hide();a=$(".g-tips-block2");
0<a.length&&a.hide();dialog.close();a=window.top.$('<div id="dialog"></div>');"undefined"!==typeof window.IS_MOBILE&&(a=$('<div id="dialog"></div>'));a.html('<div class="field-c">'+c+"</div>");a.dialog({resizable:!1,modal:!0,buttons:e,title:b,dialogClass:"dialog",minWidth:360,minHeight:200});dialog.openned=!0},load:function(b){null==b&&(b="");dialog._show("",'<div class="icon"><img src="/js/jquery-ui/styles/images/loading.gif"></img></div>'+dialog._getHTML(b),{})},info:function(b,c,a){null==c&&(c=
"");null==a&&(a={"\u786e\u5b9a":function(){dialog.close()}});dialog._show(b,dialog._getHTML(c),a)},open:function(b,c,a,e,d){null==c&&(c="");if(1!=d){null==d&&(d={"\u786e\u5b9a":function(){dialog.close()}});var f;d.each?(f={},d.each(function(){var a=$(this).attr("href");f[$(this).html()]=function(){window.location.href=a}})):f=d}d=$(".g-bigdiv");0<d.length&&d.hide();d=$(".g-tips-block2");0<d.length&&d.hide();dialog.close();c="<iframe src="+c+" width="+a+" height="+e+' frameborder="no" border="0" >';
d=window.top.$('<div id="dialog"></div>');"undefined"!==typeof window.IS_MOBILE&&(d=$('<div id="dialog"></div>'));d.html('<div class="field-c">'+c+"</div>");d.dialog({resizable:!1,modal:!0,buttons:f,title:b,dialogClass:"dialog",minWidth:360,minHeight:200,width:a+5,height:e+5});dialog.openned=!0},alert:function(b,c,a,e){null==c&&(c="");null==a&&(a={"\u786e\u5b9a":function(){dialog.close();""!=e&&void 0!=e&&(window.parent.document.getElementById("frame").src=e)}});dialog._show(b,'<div class="icon"><img src="/js/jquery-ui/styles/images/success.png"></img></div>'+
dialog._getHTML(c),a)},alert1:function(b,c,a,e){null==c&&(c="");null==a&&(a={"\u786e\u5b9a":function(){dialog.close();""!=e&&void 0!=e&&(window.location.href=e)}});dialog._show(b,'<div class="icon"><img src="/js/jquery-ui/styles/images/success.png"></img></div>'+dialog._getHTML(c),a)},error:function(b,c,a){null==c&&(c="");null==a&&(a={"\u786e\u5b9a":function(){dialog.close()}});dialog._show(b,'<div class="icon"><img src="/js/jquery-ui/styles/images/error.png" width="32px" height="32px"></img></div>'+
dialog._getHTML(c),a)},confirm:function(b,c,a){null==c&&(c="");null==a&&(a={"\u786e\u5b9a":function(){dialog.close()}});dialog._show(b,'<div class="icon"><img src="/js/jquery-ui/styles/images/prompt.png" width="32px" height="32px"></img></div>'+dialog._getHTML(c),a)},url:function(b,c,a,e){e="<iframe src="+e+" width="+c+" height="+a+' frameborder="no" border="0" >';var d=$("#paneliframe");0==d.length&&(d=$('<div id="paneliframe">'),d.dialog({autoOpen:!1,modal:!0,title:b,close:function(){$(this).find("iframe").attr("src",
"")}}));d.html('<div class="field-c">'+e+"</div>");d.dialog("option",{width:c+5,height:a+5});d.dialog("open")}};