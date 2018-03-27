function dateGetTotalReportDayOG(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getTotailRepotTotailDayOG();
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getTotailRepotTotailDayOG();
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getTotailRepotTotailDayOG();
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getTotailRepotTotailDayOG();
	});
	
}

function getTotailRepotTotailDayOG(){
	$("#returnBg").html("");
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	var platform = $("#platform").val();
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), $("#from_hour").val()
			+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), $(
			"#to_hour").val()
			+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
//		parentId : "" + id,
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
		platform : $("#platform").val(),
//		tableId : "0",
//		shoeId : "",
//		gameId : "",
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getTotailRepotTotailDay?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/index.jsp'>"+l_report['BACK']+"</a>");
				},
				success : function(data) {
					if (data) {
						if(data.success == false){
							$("#progressBar").hide();
							if(data.message == 'MemberReport_or_MemberLevelTypeId_errors') {
								JqueryShowMessageReload(l_basic['member_LevelTypeId_errors']);
							} else if(data.message == 'SESSION_EXPIRED') {
								JqueryShowMessageHome(l_basic['sessionExpired']);
							} else if(data.message == 'TRY_AGAIN') {
								JqueryShowMessage(l_basic['TryAgain']);
							}else {
								JqueryShowMessage(l_basic['Parameters_error']);
							}
						}else{
							$("#total_table tbody").html("");
							$("#total_table_day tbody").html("");
							$("#noRecord").hide();
							
							if(data.liveMemberReportTotalDaysList.length > 0){
								var totBetCount = 0;
								var totStakeAmount = 0;
								var totValidStake = 0;
								var totWinLoss = 0;
								var totMemberCommAmount = 0;
								var tt=0;
								var joinWhatPage = "";
								var joinWhatPage = "";
								joinWhatPage = "liveOGWinLoss";
								for(var i= 0;i < data.liveMemberReportTotalDaysList.length;i++){
									trHtml = "";
									trHtml = "<tr>"
										+ "<td class='F_bold c_game_type' style='padding:5px !important;'><a href='http://juyou1989.com/cscpLoginWeb/app/" + joinWhatPage + "?fTe="+data.liveMemberReportTotalDaysList[i].reportDate+"' data-ajax='false'>"+data.liveMemberReportTotalDaysList[i].reportDate+"</a></td>"
										+ "<td class='F_bold'>"+ data.liveMemberReportTotalDaysList[i].betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.liveMemberReportTotalDaysList[i].validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].winLoss,2)+ "</td>"
										/*+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].memberCommAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.liveMemberReportTotalDaysList[i].total,2) + "</td>" */
										+ "</tr>";
										$("#total_table tbody").append(trHtml);
										
										 totBetCount = totBetCount + data.liveMemberReportTotalDaysList[i].betCount;
										 totStakeAmount = totStakeAmount + data.liveMemberReportTotalDaysList[i].stakeAmount;
										 totValidStake = totValidStake + data.liveMemberReportTotalDaysList[i].validStake;
										 totWinLoss = totWinLoss + data.liveMemberReportTotalDaysList[i].winLoss;
										 totMemberCommAmount =totMemberCommAmount + data.liveMemberReportTotalDaysList[i].memberCommAmount;
										 tt = tt + data.liveMemberReportTotalDaysList[i].total;
								}
								
								trHtml = "<tr>"
									+ "<td class='F_bold'>"+ totBetCount+ "</td>"
									+ "<td class='F_bold '>"+ formatNumber(totStakeAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumber(totValidStake,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(totWinLoss,2)+ "</td>"
									/*+ "<td class='F_bold '>"+ formatNumberWinLoss(totMemberCommAmount,2)+ "</td>"
									+ "<td class='F_bold '>"+ formatNumberWinLoss(tt,2) + "</td>" */
									+ "</tr>";
									$("#total_table_day tbody").append(trHtml);
								
							}else{
								var noRecordString = "";
								noRecordString = "<td colspan='5'>您当前没有讯息</td>";
								trHtml = "<tr id='noRecord' align='center'>"
									+ noRecordString
								+ "</tr>";
									
								$("#total_table tbody").append(trHtml);
							}
						$("#progressBar").hide();
						}
						
						$("#total_table tbody tr").addClass("tr_background");
						
						$("#total_table tbody tr").mousemove(function() {
							tr_move(this);
						});
						$("#total_table tbody tr").mouseout(function() {
							tr_out(this);
						});
						
					} else {
						$("#progressBar").hide();
						JqueryShowMessage("服务器繁忙, 请稍后再试!");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage("网络繁忙, 请稍后再试!");
				},
				complete : function() {
				}
			});
}


function dateGetLiveBetDetailOG(){
	$("#Yesterday").click(function() {
		$("#BeginDate").val($("#YBeginDate").val());
		$("#EndDate").val($("#YEndDate").val());
		getLiveBetDetailOG('1');
	});
	$("#Today").click(function() {
		$("#BeginDate").val($("#TBeginDate").val());
		$("#EndDate").val($("#TEndDate").val());
		getLiveBetDetailOG('1');
	});
	$("#ThisWeek").click(function() {
		$("#BeginDate").val($("#TWBeginDate").val());
		$("#EndDate").val($("#TWEndDate").val());
		getLiveBetDetailOG('1');
	});
	$("#LastWeek").click(function() {
		$("#BeginDate").val($("#LWBeginDate").val());
		$("#EndDate").val($("#LWEndDate").val());
		getLiveBetDetailOG('1');
	});
	
}

function getLiveBetDetailOG(pageNumber){
	$("#pageNext").unbind();
	$("#pagePrev").unbind();
	var fromDateObj = $("#BeginDate");
	var toDateObj = $("#EndDate");
	var platform = $("#platform").val();
	if (!checkEndTime(fromDateObj.val(), toDateObj.val(), $("#from_hour").val()
			+ ":" + $("#from_minute").val() + ":" + $("#from_second").val(), $(
			"#to_hour").val()
			+ ":" + $("#to_minute").val() + ":" + $("#to_second").val())) {
		JqueryShowMessage(l_basic['dateError']);
		return;
	}
	var o = {
		// queryStr : queryStrObj.val(),
//		parentId : "" + id,
		platform : $("#platform").val(),
		fromDate : fromDateObj.val(),
		toDate : toDateObj.val(),
		fromHour : $("#from_hour").val(),
		fromMinute : $("#from_minute").val(),
		fromSecond : $("#from_second").val(),
		toHour : $("#to_hour").val(),
		toMinute : $("#to_minute").val(),
		toSecond : $("#to_second").val(),
		tableId : "0",
		shoeId : "",
		gameId : "",
		liveType : $("#LiveType").val(),
//		hall:$("#Hall").val(),
		pageNumber : pageNumber + "", 
		RecordsPage : 10 + ""
		
	};
	var jsonuserinfo = $.toJSON(o);
	 $.ajax({
				type : "post",
				url : $("#path").val() + "/app/getLiveBetDetailOG?" + Math.random()*10000,
				data : jsonuserinfo,
				contentType : 'application/json',
				dataType : "json",
				async : true,
//				timeout : 200000,
				beforeSend : function() {
					$("#progressBar").show();
					var joinWhatPage = "";
					if(platform == "OGLIVE") {
						joinWhatPage = "liveOGWinLossDay";
					} 
					$("#returnBg").html("<a style='color: #000;' href='http://juyou1989.com/cscpLoginWeb/app/" + joinWhatPage + "?fTe="+fromDateObj.val()+"&tTe="+toDateObj.val()+"'>"+l_report['BACK']+"</a>");
				},
				success : function(data) {
					if (data) {
						if (data.success == false) {
							alert("123");
							$("#progressBar").hide();
								if(data.message == 'MemberReport_or_MemberLevelTypeId_errors') {
									JqueryShowMessageReload(l_basic['member_LevelTypeId_errors']);
								} else if(data.message == 'SESSION_EXPIRED') {
									JqueryShowMessageHome(l_basic['sessionExpired']);
								} else if(data.message == 'TRY_AGAIN') {
									JqueryShowMessage(l_basic['TryAgain']);
								}else {
									JqueryShowMessage(l_basic['Parameters_error']);
								}
						} else {
							$("#result_table tbody").html("");
							$("#total_table tbody").html("");
							if (data.resultList.length > 0) {
								var cardIcons = {
									CLUB : '\u2663',
									DIAMOND : '\u2666',
									SPADE : '\u2660',
									HEART : '\u2665'
								};
								var playerCards = "";
								var bestCards = "";
								var communityCards = "";

								var trHtml = "";
								var betCount = 0;
								var stake = 0;
								var validStake = 0;
								var winLoss = 0;
								var memberCommAmount = 0;

								for ( var i = 0; i < data.resultList.length; i++) {
									var gameResult = "";
									var sbGameResult = "";
									var gameBettingContent = data.resultList[i].gameBettingContent.substring(0,data.resultList[i].gameBettingContent.length-1);
									var gameType = data.resultList[i].gameNameId;
									if (gameType == "11") { //百家乐
										gameResult = l_ogLiveBaccaratGR[data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult];
									} else if (gameType == "12") { //龙虎
										gameResult = l_ogLiveDTGR[data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult];
									} else if (gameType == "13") { //轮盘
										gameResult = "<img src='../images/all/report/roulette/r_- + data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/roulette/r_" + data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult + ".png*//>";
									} else if (gameType == "14") { //骰宝
										sbGameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
										gameResult = "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(0,1) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(0,1) + ".png*//>"
											+ "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(1,2) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(1,2) + ".png*//>"
											+ "<img src='../images/all/report/sicbo/so_- + sbGameResult.substring(2) + -.png'/*tpa=http://juyou1989.com/cscpLoginWeb/images/all/report/sicbo/so_" + sbGameResult.substring(2) + ".png*//>";
									} else if (gameType == "15") { //德州扑克
										gameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
									} else if (gameType == "16") { //番摊
										gameResult = data.ogLiveResultMap[data.resultList[i].gameRecordId].gameResult;
									}
									trHtml = "<tr>";
									if(platform == "OGLIVE") {
										trHtml += "<td>"+ (i + 1)+ "</td>"
											+ "<td>"+"OG娱乐城"+"</td>"
											+ "<td>"+l_ogLiveGameType[gameType]+"</td>"
											+ "<td>"+ data.resultList[i].orderNumber + "<br/>" +
											data.resultList[i].tableId+ " / "+ data.resultList[i].stage+ " / "+ data.resultList[i].inning+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].bettingAmount,2)+ "</td>"
											+ "<td class='F_bold f_right'>"+ formatNumber(data.resultList[i].validAmount,2)+ "</td>"
											+ "<td class='F_bold f_right font_r'>"+ gameResult + "</td>"
											+ "<td class='F_bold f_right'>" + formatNumberWinLoss(data.resultList[i].winLossAmount,2)
											+ "<a onclick='openOgDetail(\""+gameBettingContent+"\")'><span style='display:inline-block; cursor: pointer;' class='ui-icon ui-helper-clearfix ui-icon-grip-diagonal-se'>&nbsp;&nbsp;&nbsp;</span></a>"
											+"</td>"
											+ "<td>"+ formartTime(data.resultList[i].addTime,1) + "</td>"  
											+ "</tr>";

										$("#result_table tbody").append(trHtml);
										
										betCount = betCount + 1;
										stake = stake+ data.resultList[i].bettingAmount;
										validStake = validStake+ data.resultList[i].validAmount;
										winLoss = winLoss+ data.resultList[i].winLossAmount;
										memberCommAmount = memberCommAmount+ data.resultList[i].comm;
										
										var pageNum = data.pageNumber;
										var pageAllNumber = data.pageAllNumber;

										$("#allPageNum").html(pageNum);
										if (pageNum == 1) {
											if (pageAllNumber != 1) {
												$("#pageNext").click(function() {
													getLiveBetDetailOG(1);(pageNum + 1);
												});
											}
										} else if (pageNum == pageAllNumber) {
											$("#pagePrev").click(function() {
												getLiveBetDetailOG(1);(pageNum - 1);
											});
										} else {
											$("#pageNext").click(function() {
												getLiveBetDetailOG(1);(pageNum + 1);
											});
											$("#pagePrev").click(function() {
												getLiveBetDetailOG(1);(pageNum - 1);
											});
										}
									}
								}

								$("#result_table tr").addClass("tr_background");

								$("#result_table tr").mousemove(function() {
									tr_move(this);
								});
								$("#result_table tr").mouseout(function() {
									tr_out(this);
								});

								trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>当前页</td>"
										+ "<td class='F_bold'>"+ betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(stake, 2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(validStake, 2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(winLoss, 2)+ "</td>"
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								trHtml = "<tr>"
										+ "<td class='F_bold' style='padding:5px !important;'>全部页</td>"
										+ "<td class='F_bold'>"+ data.pokerMemberReportTotal.betCount+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.stakeAmount,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumber(data.pokerMemberReportTotal.validStake,2)+ "</td>"
										+ "<td class='F_bold '>"+ formatNumberWinLoss(data.pokerMemberReportTotal.winLoss,2)+ "</td>"
										+ "</tr>";
								$("#total_table tbody").append(trHtml);

								$("#total_table").show();
								$("#noRecord").hide();
								$("#pageMember").show();
								$("#currMemberNum").html(data.MemberListTotal);

								
								var pageNumHtml = "";
								var forEnd;
								var forBegin;
								if (pageAllNumber > 10) {
									if (pageNum > 5) {
										if (pageAllNumber - pageNum > 5) {
											forEnd = pageNum + 5;
											forBegin = pageNum - 4;
										} else {
											forEnd = pageAllNumber;
											forBegin = pageAllNumber - 9;
										}
									} else {
										forEnd = 10;
										forBegin = 1;
									}
								} else {
									forEnd = pageAllNumber;
									forBegin = 1;
								}
								for ( var j = forBegin; j <= forEnd; j++) {
									if (j != pageNum) {
										pageNumHtml += "<a onclick=\"getLiveBetDetailOG("+ j+ ");\" style='color:#000;cursor: pointer;'>"+ j+ "</a>&nbsp;";
									} else {
										pageNumHtml += "<font class='F_bold currPageNumber'>"+ j + "</font>&nbsp;";
									}
								}
								$("#currPageNum").html(pageNumHtml);
								$("#progressBar").hide();
							} else {
								$("#progressBar").hide();
								$("#pageMember").hide();
								var noRecordString = "";
								noRecordString = "<td colspan='9'>您当前没有讯息</td>";
								trHtml = "<tr id='noRecord' align='center'>"
									+ noRecordString
								+ "</tr>";
									
								$("#result_table tbody").append(trHtml);
							}
							$("#dialog").dialog({
								width : 550,
								height : 320,
								autoOpen : false,
								modal : true,
								show : {
									effect : "clip",
									duration : 200
								},
								hide : {
									effect : "clip",
									duration : 200
								}
							});
							$("#dialog_img").dialog({
								width : 490,
								height : 360,
								autoOpen : false,
								modal : true,
								show : {
									effect : "clip",
									duration : 200
								},
								hide : {
									effect : "clip",
									duration : 200
								}
							});
						}
					} else {
						$("#progressBar").hide();
						JqueryShowMessage("服务器繁忙, 请稍后再试!");
					}
				},
				error : function(xmlhttprequest, error) {
					$("#progressBar").hide();
					JqueryShowMessage("网络繁忙, 请稍后再试!");
				},
				complete : function() {
				}
			});
}

function openOgDetail(gameBettingContent) {
	$("#dialog").dialog("option", "title", "详细");
	$("#dialog").dialog("open");
	var trHtml = "";
	var gbcArrs = gameBettingContent.split(",");
    for ( var i = 0; i < gbcArrs.length; i++) {
    	var gbcArr = gbcArrs[i].split("^");
		trHtml += "<tr>"
			+ "<td class='f_left'>"+ l_ogLiveBettingType[gbcArr[0]] + "</td>"
			+ "<td class='F_bold f_right'>" + formatNumber(gbcArr[1],2)+ "</td>"
			+ "<td class='F_bold f_right'>" + formatNumberWinLoss(gbcArr[2],2) + "</td>"
			+ "</tr>";
	}
    $("#dialog tbody").html(trHtml);
}

function addliveOgCainoType(){
	var o = {
	};
	var jsonuserinfo = $.toJSON(o);
	$.ajax({
		type : "post",
		url : $("#path").val() + "/app/addliveOgCainoType?" + Math.random()*10000,
		data : jsonuserinfo,
		contentType : 'application/json',
		dataType : "json",
		async:true, 
		timeout : 50000,
		beforeSend : function(xmlhttprequest) {
		},
		success : function(data) {
			if(data){
				if(data.success){
					for ( var i = 0; i < data.liveCasinoTypes.length; i++) {
						$("#LiveType").append( "<option value='" + data.liveCasinoTypes[i] + "'>" + l_LiveOgCasinoType[data.liveCasinoTypes[i]] + "</option>");
					}
				}
			}
		},
		error : function(xmlhttprequest, error) {
		},
		complete : function() {
		}
	});
}