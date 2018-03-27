<?php
function getGameType($gameType) {
	switch ($gameType) {
		case "BAC":
			return "百家乐";
		case "CBAC":
			return "包桌百家乐";
		case "LINK":
			return "连环百家乐";
		case "DT":
			return "龙虎";
		case "SHB":
			return "骰宝";
		case "ROU":
			return "轮盘";
		case "FT":
			return "番摊";
		default:
			return $gameType;
	}
}

function getOrderFlag($flag) {
	switch ($flag) {
		case "1":
			return "已结算";
		case "0":
			return "未结算";
		case "-1":
			return "重置试玩额度";
		case "-2":
			return "注单被篡改";
		case "-8":
			return "取消指定局注单";
		case "-9":
			return "取消注单";
		default:
			return $flag;
	}
}

function getPlayType($playType) {
	switch ($playType) {
		case "1":
			return "庄";
		case "2":
			return "闲";
		case "3":
			return "和";
		case "4":
			return "庄对";
		case "5":
			return "闲对";
		case "6":
			return "大";
		case "7":
			return "小";
		case "8":
			return "散客区庄";
		case "9":
			return "散客区闲";
		case "11":
			return "庄免佣";
		case "21":
			return "龙";
		case "22":
			return "虎";
		case "23":
			return "和";
		case "41":
			return "大";
		case "42":
			return "小";
		case "43":
			return "单";
		case "44":
			return "双";
		case "45":
			return "全围";
		case "46":
			return "围1";
		case "47":
			return "围2";
		case "48":
			return "围3";
		case "49":
			return "围4";
		case "50":
			return "围5";
		case "51":
			return "围6";
		case "52":
			return "单点1";
		case "53":
			return "单点2";
		case "54":
			return "单点3";
		case "55":
			return "单点4";
		case "56":
			return "单点5";
		case "57":
			return "单点6";
		case "58":
			return "对子1";
		case "59":
			return "对子2";
		case "60":
			return "对子3";
		case "61":
			return "对子4";
		case "62":
			return "对子5";
		case "63":
			return "对子6";
		case "64":
			return "组合12";
		case "65":
			return "组合13";
		case "66":
			return "组合14";
		case "67":
			return "组合15";
		case "68":
			return "组合16";
		case "69":
			return "组合23";
		case "70":
			return "组合24";
		case "71":
			return "组合25";
		case "72":
			return "组合26";
		case "73":
			return "组合34";
		case "74":
			return "组合35";
		case "75":
			return "组合36";
		case "76":
			return "组合45";
		case "77":
			return "组合46";
		case "78":
			return "组合56";
		case "79":
			return "和值4";
		case "80":
			return "和值5";
		case "81":
			return "和值6";
		case "82":
			return "和值7";
		case "83":
			return "和值8";
		case "84":
			return "和值9";
		case "85":
			return "和值10";
		case "86":
			return "和值11";
		case "87":
			return "和值12";
		case "88":
			return "和值13";
		case "89":
			return "和值14";
		case "90":
			return "和值15";
		case "91":
			return "和值16";
		case "92":
			return "和值17";
		case "101":
			return "直接注";
		case "102":
			return "分注";
		case "103":
			return "街注";
		case "104":
			return "三数";
		case "105":
			return "角注";
		case "106":
			return "4个号码";
		case "107":
			return "列注(列1)";
		case "108":
			return "列注(列2)";
		case "109":
			return "列注(列3)";
		case "110":
			return "线注";
		case "111":
			return "打一";
		case "112":
			return "打二";
		case "113":
			return "打三";
		case "114":
			return "红";
		case "115":
			return "黑";
		case "116":
			return "大";
		case "117":
			return "小";
		case "118":
			return "单";
		case "119":
			return "双";
		case "130":
			return "1番";
		case "131":
			return "2番";
		case "132":
			return "3番";
		case "133":
			return "4番";
		case "134":
			return "1念2";
		case "135":
			return "1念3";
		case "136":
			return "1念4";
		case "137":
			return "2念1";
		case "138":
			return "2念3";
		case "139":
			return "2念4";
		case "140":
			return "3念1";
		case "141":
			return "3念2";
		case "142":
			return "3念4";
		case "143":
			return "4念1";
		case "144":
			return "4念2";
		case "145":
			return "4念3";
		case "146":
			return "角(1,2)";
		case "147":
			return "单";
		case "148":
			return "角(1,4)";
		case "149":
			return "角(2,3)";
		case "150":
			return "双";
		case "151":
			return "角(3,4)";
		case "152":
			return "1,2四通";
		case "153":
			return "1,2三通";
		case "154":
			return "1,3四通";
		case "155":
			return "1,3二通";
		case "156":
			return "1,4三通";
		case "157":
			return "1,4二通";
		case "158":
			return "2,3四通";
		case "159":
			return "2,3一通";
		case "160":
			return "2,4三通";
		case "161":
			return "2,4一通";
		case "162":
			return "3,4二通";
		case "163":
			return "3,4一通";
		case "164":
			return "三门(3,2,1)";
		case "165":
			return "三门(2,1,4)";
		case "166":
			return "三门(1,4,3)";
		case "167":
			return "三门(4,3,2)";
		default:
			return $playType;
	}
}

function getTransferType($transferType) {
	switch ($transferType) {
		case "OUT":
			return "转出额度";
		case "IN":
			return "转入额度";
		case "RECALC":
			return "重新派彩";
		case "GBED":
			return "代理修改额度";
		case "RECKON":
			return "派彩";
		case "BET":
			return "下注";
		case "RECALC_ERR":
			return "重新派彩时扣款失败";
		case "CHANGE_CUS_BALANCE":
			return "修改玩家账户额度";
		case "CHANGE_CUS_CREDIT":
			return "修改玩家信用额度";
		case "RESET_CUS_CREDIT":
			return "重置玩家信用额度";
		case "DONATEFEE":
			return "玩家小费";
		case "CANCEL_BET":
			return "系统取消下注";
		default:
			return $transferType;
	}
}
?>