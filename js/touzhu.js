﻿var touzhutype = 0; //交易类型,是单式还是串关,0是单式 1是串关
var cg_count = 0; //串关串数
var time_id = '';

$(document).ready(function () {

    $("#button_danshi").addClass("buttonred");
    $("#button_danshi").click(function () {
        touzhutype = 0;
        $("#touzhutype").val(touzhutype);
        quxiao_bet();

        //xiazhu();
        //$("div").toggle();
    });
    $("#button_chuanguan").click(function () {
        touzhutype = 1;
        $("#touzhutype").val(touzhutype);
        cg_count = 0;
        quxiao_bet();
        clear_input();


    });
    $("#button_chuanguan2,#button_chuanguan3").click(function () {
        touzhutype = 1;
        $("#touzhutype").val(touzhutype);
        cg_count = 0;
        quxiao_bet();
        clear_input();


    });
    $("#bet_money").keyup(function () {
        //输入金额，最高可赢跟着改变
        var bet_money = parseFloat($("#bet_money").val());
        // alert(bet_money);
        var user_money = $("#user_money").html();
        user_money = parseFloat(user_money.replace("RMB", " "));

        if (bet_money > user_money) {
            alert("您的账户余额不足");
            return false;
        }

        touzhutype = $("#touzhutype").val();
        if (touzhutype == 0) {//单式下注
            temp_point = parseFloat($("input[name='bet_point[]']").val()) + parseInt($("input[name='ben_add[]']").val(), 10);
            var win = (bet_money * temp_point).toFixed(2);
            $("#win_span").html(win);
            $("#win_span1").html(win);
            $("#bet_win").val(win);
            return false;
        }

        if (touzhutype == 1) {
            //串关下注,计算串关最多可以赢
            var temp_point = 1;
            for (var i = 0; i < cg_count; i++) {
                temp_point = (parseFloat($("input[name='bet_point[]']:eq(" + i + ")").val()) + parseFloat($("input[name='ben_add[]']:eq(" + i + ")").val())) * parseFloat(temp_point);
            }

            // var win=bet_money*temp_point;
            var win = (bet_money * temp_point).toFixed(2);
            $("#win_span").html(win);
            $("#win_span1").html(win);
            $("#bet_win").val(win);

        }
        return false;
    });
});

function quxiao_bet() {
    //取消，清空所有交易项目
    /* $("#maxmsg_div").fadeOut();
     $("#touzhudiv").fadeOut().html('');
     $("#bet_moneydiv").fadeOut();
     $("#istz").css("display","none");
     $("#bet_money").removeClass("read");
     $("#bet_money").addClass("edit");
     $("#bet_money").attr("readonly",false);*/
    //$("#touzhudiv").html("");
    //  clear_input();
    clear_input();
    $("#xp").fadeOut();
    $(".tz ul").children("li").removeClass("on").eq(0).addClass("on");
    $("#cg_msg").hide();
    $("#touzhudiv").html('');
    $(".tz_money").removeClass("cg");
    $("#kefu").fadeIn();
    if ($("#touzhutype").val() == 1) {
        $("#cg_01_bet").show();
        $("#ds_01_bet").hide();
        $("#cg_num").html('0');
        cg_count = 0;
    } else {
        $("#ds_01_bet").fadeIn();
        $("#cg_01_bet").hide();
    }
}

function clear_input() {
    $("#bet_money").val("");
    $("#win_span").html("0.00");
    $("#win_span1").html("0.00");
    $("#bet_win").val("0.00");
    $("#istz").css("display", "none");
    $("#bet_money").removeClass("read");
    $("#bet_money").addClass("edit");
    $("#bet_money").attr("readonly", false);
}

function del_bet(obj) {
    touzhutype = $("#touzhutype").val();
    if (touzhutype == 0) {
        quxiao_bet();
    } else {
        $(obj).parent().parent().remove();
        cg_count--;
        $("#cg_num").html(cg_count);
        if (cg_count == 1) {
            $("#bet_moneydiv").fadeOut();
            $(".match_info").removeClass("cg");
            $(".tz_money").removeClass("cg");
        }

        if (cg_count == 0) {
            quxiao_bet();
        }
    }
    clear_input();
}

function waite() {
    touzhutype = $("#touzhutype").val();
    if (touzhutype == 0) { //单式 10 秒不交易，取消交易
        time_id = window.setTimeout("quxiao_bet()", 10000);
    }
}

function bet(data) {
    //下注函数
    clear_input();

    touzhutype = $("#touzhutype").val();
    if (touzhutype == 0) {
        //quxiao_bet();
        // $("#maxmsg_div").show();
        // $("#bet_moneydiv").show();
        //$("#touzhudiv").hide();
        //$("#touzhudiv").html(data).fadeIn();
        $("#touzhudiv").hide();
        $("#touzhudiv").html(data).fadeIn();
        $("#bet_moneydiv").show();
        $("#cg_msg").hide();
        $("#xp").show();
        $(".tz ul").children("li").removeClass("on").eq(1).addClass("on");
        $("#ds_01_bet").hide();
        $("#ds_msg").show();
        $("#usersid").show();
        $('#bet_money').removeAttr("disabled");
        cg_count = 1;
    } else {
        if (cg_count > 7) {
            alert("串关最多允许8场赛事");
            return;
        }
        if (data.indexOf("滚球") >= 0) {
            alert("滚球未开放串关功能");
            return;
        }
        if (data.indexOf("半全场") >= 0) {
            alert("半全场未开放串关功能");
            return;
        }
        if (data.indexOf("角球數") >= 0) {
            alert("角球數未开放串关功能");
            return;
        }
        if (data.indexOf("先開球") >= 0) {
            alert("先開球未开放串关功能");
            return;
        }
        if (data.indexOf("入球数") >= 0) {
            alert("入球数未开放串关功能");
            return;
        }
        if (data.indexOf("波胆") >= 0) {
            alert("波胆未开放串关功能");
            return;
        }
        if (data.indexOf("网球") >= 0) {
            alert("网球未开放串关功能");
            return;
        }
        if (data.indexOf("排球") >= 0) {
            alert("排球未开放串关功能");
            return;
        }
        if (data.indexOf("棒球") >= 0) {
            alert("棒球未开放串关功能");
            return;
        }
        if (data.indexOf("金融") >= 0) {
            alert("金融未开放串关功能");
            return;
        }
        if (data.indexOf("冠军") >= 0) {
            alert("冠军未开放串关功能");
            return;
        }
        if (data.indexOf("主場") >= 0) {
            alert("同场赛事不能重复参与串关");
            return;
        }
        for (var i = 0; i < cg_count; i++) {
            var master_guest = $("input[name='master_guest[]']:eq(" + i + ")").val();
            var team = master_guest.split("VS");
            var team_a = team[0].split(" -");
            var team_b = team[1].split(" -");
            team_a = team_a[0].split("-");
            team_b = team_b[0].split("-");
            team_a = team_a[0].split("[");
            team_b = team_b[0].split("[");
            //alert(team_a[0]);
            //alert(team_b[0]);
            if ((data.indexOf(team_a[0]) >= 0) || (data.indexOf(team_b[0]) >= 0)) {
                alert("同场赛事不能重复参与串关");
                return;
            }
        }

        cg_count++;
        $("#cg_num").html(cg_count);
        $("#cg_msg").show();
        $("#touzhudiv").fadeIn().append(data);

        if (cg_count > 1) {
            $("#bet_moneydiv").show();
            $(".match_info").addClass("cg");
            $(".tz_money").addClass("cg");
        }
        $("#maxmsg_div").show();

        $("#xp").show();
        $(".tz ul").children("li").removeClass("on").eq(1).addClass("on");
        $("#cg_01_bet").show();
        $("#kefu").hide();
        $("#left_ids").hide();
        $("#usersid").hide();
    }
}

function isnum(obj) {
    v = obj.value;
    if (v != "") {
        if (v == (parseInt(v) * 1)) {
            num = v.indexOf(".");
            if (num == -1) return true;
            else {
                alert("交易金额只能为整数");
                return false;
            }
        } else {
            alert("交易金额只能为整数");
            return false;
        }
    }
}

function checknum() {
    var v = $("#bet_money").val();
    if (v == (parseInt(v) * 1)) {
        var num = v.indexOf(".");
        if (num == -1) return true;
        else {
            alert("交易金额只能为整数");
            return false;
        }
    } else {
        alert("交易金额只能为整数");
        return false;
    }
}

function check_bet() { //提交按钮，提交数据检查
    $("#submit_from").attr("disabled", true); //按钮失效
    if ($("#istz").css("display") == "block") {
        return true;
    } else {
        var min_ty = $("#min_ty").html();
        min_ty = min_ty * 1;
        var xe = $("#max_ds_point_span").html();
        xe = xe * 1;
        if (xe < 1) {
            alert("您已经退出系统或赛事已关闭\n如您还有疑问请联系在线客服");
            $("#submit_from").attr("disabled", false); //按钮有效
            return false;
        }
        var bet_money = parseFloat($("#bet_money").val());
        if (bet_money != (bet_money * 1)) bet_money = 0;

        if (bet_money < min_ty) { //最小10
            alert("交易金额最少为 " + min_ty + " RMB");
            $("#submit_from").attr("disabled", false); //按钮有效
            return false;
        }

        var user_money = $("#user_money").html();
        user_money = parseFloat(user_money.replace("RMB", " "));
        if (bet_money > user_money) {
            alert("您的账户余额不足,不能完成本次交易");
            $("#submit_from").attr("disabled", false); //按钮有效
            return false;
        }

        if (!checknum()) return false; //验证是否为正整数

        var touzhuxiang = $('input[name="touzhuxiang[]"]').val();
        var ball_sort = $('input[name="ball_sort[]"]').val();
        var bet_info = $('input[name="bet_info[]"]').val();
        if (touzhuxiang == "大小") {
            var match_dxgg = $('input[name="match_dxgg[]"]').val();
            if (ball_sort.indexOf("足球滚球") >= 0) {
                bet_info = bet_info.match(/-[小|大][0-9.\/]{0,}\(/);
                bet_info = bet_info + "-";
                bet_info = bet_info.substr(2, bet_info.length - 4);
            } else {
                bet_info = bet_info.match(/-[小|大][0-9.\/]{0,}@/);
                bet_info = bet_info + "-";
                bet_info = bet_info.substr(2, bet_info.length - 4);
            }
            if (bet_info != match_dxgg || match_dxgg == 176) {
                alert("当前盘口已经改变，请重新下单");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
        }
        if (touzhuxiang == "让球") {
            var match_dxgg = $('input[name="match_rgg[]"]').val();
            bet_info = bet_info.match(/-[主|客]让[0-9.\/]{0,}-/);
            bet_info = bet_info + "-";
            bet_info = bet_info.substr(3, bet_info.length - 5);
            if (bet_info != match_dxgg) {
                alert("当前盘口已经改变，请重新下单");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
        }

        var yinghuo = parseFloat($("#win_span").html());
        if (yinghuo != (yinghuo * 1)) yinghuo = 0;

        touzhutype = $("#touzhutype").val();
        if (touzhutype == 0) {
            var bet_point = parseFloat($("input[name='bet_point[]']").val()) * 1;
            if (bet_point == 0.01) {
                alert("赔率已改变，请重新下单");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
            bet_point = bet_point + parseInt($("input[name='ben_add[]']").val(), 10);
            bet_point = (bet_money * bet_point).toFixed(2);
            if (yinghuo != bet_point * 1) {
                alert("交易金额必须手动输入");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
            if (bet_money >= yinghuo) {
                alert("赔率已改变，请重新下单");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
            ball_sort = encodeURI(ball_sort);
            touzhuxiang = encodeURI(touzhuxiang);
            var match_id = $('input[name="match_id[]"]').val();
            $.getJSON(
                "checkxe.php?ball_sort=" + ball_sort + "&touzhuxiang=" + touzhuxiang + "&bet_money=" + bet_money + "&match_id=" + match_id,
                function (json) {
                    if (json.result == "ok") {
                        $("#istz").css("display", "block");
                        $("#bet_money").removeClass("edit");
                        $("#bet_money").addClass("read");
                        $("#bet_money").attr("readonly", true);
                        $("#submit_from").attr("disabled", false); //按钮有效
                        $("#submit_from").focus();
                        return false;
                    } else if (json.result == "wdl") {
                        window.location.href = "left.php";
                    } else {
                        alert(json.result);
                        $("#submit_from").attr("disabled", false); //按钮有效
                        return false;
                    }
                }
            );
            return false;
        } else {
            var bet_point = 1;
            for (var i = 0; i < cg_count; i++) {
                bet_point = (parseFloat($("input[name='bet_point[]']:eq(" + i + ")").val()) + parseFloat($("input[name='ben_add[]']:eq(" + i + ")").val())) * parseFloat(bet_point);
            }
            bet_point = (bet_money * bet_point).toFixed(2);
            if (yinghuo != bet_point * 1) {
                alert("交易金额必须手动输入");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
            if (bet_money >= yinghuo) {
                alert("赔率已改变，请重新下单");
                $("#submit_from").attr("disabled", false); //按钮有效
                return false;
            }
            $.getJSON(
                "checkcg.php?bet_money=" + bet_money,
                function (json) {
                    if (json.result == "ok") {
                        $("#istz").css("display", "block");
                        $("#bet_money").removeClass("edit");
                        $("#bet_money").addClass("read");
                        $("#bet_money").attr("readonly", true);
                        $("#submit_from").attr("disabled", false); //按钮有效
                        $("#submit_from").focus();
                        return false;
                    } else if (json.result == "wdl") {
                        window.location.href = "left.php";
                    } else {
                        alert(json.result);
                        $("#submit_from").attr("disabled", false); //按钮有效
                        return false;
                    }
                }
            );
            return false;
        }
    }
}