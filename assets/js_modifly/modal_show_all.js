var linkurl = function linkurl() {
	var url = "../index.php/URL";
    var Httpreq = new XMLHttpRequest();
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText;
}

var opendata = function opendata(e) {
	$(".overlay").show();
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	var rowred  = $(e).attr("rowred");
	$.ajax({
		url: urlresult.opendata,
		type: 'POST',
		data: {
			primary: primary,
			rowred: rowred
		},
		success: function(result) {
			$("#dispayopendata").html(result);
			$("#btnopendata").click();
			$(".overlay").hide();
		}
	});
}

var deletedata = function deletedata(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	$.ajax({
		url: urlresult.deletedata,
		type: 'POST',
		data: {primary: primary},
		success: function (callback) {
			if (callback == 'OK') {
				location.reload();
			}
		}
	});

}

var edit = function edit(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	location.href = urlresult.edit+primary;
}

var receive = function receive(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	location.href = urlresult.receive+primary;
}

var editprice = function editprice(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	location.href = urlresult.editprice+primary;
}

var btnprint = function btnprint(e) {
	$(".overlay").show();
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr("primary");
	$.ajax({
		url: urlresult.opendata,
		type: 'POST',
		data: {
			primary: primary
		},
		success: function(result) {
			var partimg = $(e).attr("primary");
			var imgWindow;
			imgWindow = window.open(urlresult.API_Print + partimg, "", "width=1000, height=600");
			$(".overlay").hide();
		}
	});
}

var approve = function approve(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $("#prapproveset").val();
	var approvedata = "Y";
	var rowid = $(e).attr('rowred');
	$.ajax({
		url: urlresult.approve,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata},
		success: function (callblack) {
			if ($.cookie('rowid')) {
			$.removeCookie('name');
			}
			$.cookie('rowid', rowid);
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var approvex = function approvex(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $("#prapproveset").val();
	var approvedata = "N";
	var rowid = $(e).attr('rowred');
	$.ajax({
		url: urlresult.approvex,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata, rowid: rowid},
		success: function (callblack) {
			if ($.cookie('rowid')) {
			$.removeCookie('name');
			}
			$.cookie('rowid', rowid);
			var alert = JSON.parse(callblack);
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var completedY = function completedY(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $("#prapproveset").val();
	var approvedata = "Y";
	$.ajax({
		url: urlresult.completedY,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata},
		success: function (callblack) {
			var alert = JSON.parse(callblack);
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var completedYA = function completedYA(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr('prno');
	var approvedata = "Y";
	$.ajax({
		url: urlresult.completedY,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata},
		success: function (callblack) {
			var alert = JSON.parse(callblack);
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var completedY_No_Po = function completedY_No_Po(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr('prno');
	var approvedata = "Y";
	$.ajax({
		url: urlresult.completedY_No_Po,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata},
		success: function (callblack) {
			var alert = JSON.parse(callblack);
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var completedModal = function completedModal(e) {
	var prno = $(e).attr('prno');
	$("#completedModal").modal('show');
	var DataHtml = '<div align="center"><button type="button" class="btn btn-success" onclick="completedY_No_Po(this);" prno="'+ prno +'">ยืนยันสั่งของ</button></div>';
	$("#completedModal_display").html(DataHtml);
}

var completedY_AC = function completedY_AC(e) {
	var urlresult = JSON.parse(linkurl());
	var primary = $(e).attr('prno');
	var approvedata = "Y";
	$.ajax({
		url: urlresult.completedY_AC,
		type: 'POST',
		data: {primary: primary, approvedata: approvedata},
		success: function (callblack) {
			setTimeout(function() {
			location.reload();
			}, 1000);
		}
	});
}

var openwindowimg = function openwindowimg(e) {
	var urlresult = JSON.parse(linkurl());
	var partimg = $(e).attr("imgdata");
	var imgWindow;
	imgWindow = window.open(urlresult.imgpra253 + partimg, "", "width=600, height=600");
	imgWindow.onload = function() {
		setTimeout(function() {
			$(imgWindow.document).find('html').append('<head><title>PO By Thitipong Inlom</title></head>');
		}, 3000);
	}
}

var printdata = function printdata(e) {
	var primary = $(e).attr("primary");
	var imgWindow;
	imgWindow = window.open(urlresult.API_Print + primary, "", "width=1000, height=600");
	$("#modelclose").click();
}

function printElement(elem) {
	var domClone = elem.cloneNode(true);

	var $printSection = document.getElementById("printSection");

	if (!$printSection) {
		var $printSection = document.createElement("div");
		$printSection.id = "printSection";
		document.body.appendChild($printSection);
	}
	$printSection.innerHTML = "";
	$printSection.appendChild(domClone);
	window.print();
}

var searchpr = function searchpr(e) {
	var datesearchstart = $("#hsearch").data('daterangepicker').startDate.format('YYYY-MM-DD');
	var datesearchend = $("#hsearch").data('daterangepicker').endDate.format('YYYY-MM-DD');
	window.location.href = 'show_all?datesearchstart='+datesearchstart+'&datesearchend='+datesearchend;
}

var searchcompletedtext = function searchcompletedtext(e) {
	var searchpraa = $("#searchpraa").val();
	window.location.href = 'show_completed?searchpraa='+searchpraa;
}

var searchapprove = function searchapprove(e) {
	var datesearchstart = $("#hsearch").data('daterangepicker').startDate.format('YYYY-MM-DD');
	var datesearchend = $("#hsearch").data('daterangepicker').endDate.format('YYYY-MM-DD');
	window.location.href = 'show_approve?datesearchstart='+datesearchstart+'&datesearchend='+datesearchend;
}

var searchcompleted = function searchcompleted(e) {
	var datesearchstart = $("#hsearch").data('daterangepicker').startDate.format('YYYY-MM-DD');
	var datesearchend = $("#hsearch").data('daterangepicker').endDate.format('YYYY-MM-DD');
	window.location.href = 'show_completed?datesearchstart='+datesearchstart+'&datesearchend='+datesearchend;
}

var searchreject = function searchreject(e) {
	var datesearchstart = $("#hsearch").data('daterangepicker').startDate.format('YYYY-MM-DD');
	var datesearchend = $("#hsearch").data('daterangepicker').endDate.format('YYYY-MM-DD');
	window.location.href = 'show_reject?datesearchstart='+datesearchstart+'&datesearchend='+datesearchend;
}

var searchprac = function searchprac(e) {
	var datesearchstart = $("#hsearch").data('daterangepicker').startDate.format('YYYY-MM-DD');
	var datesearchend = $("#hsearch").data('daterangepicker').endDate.format('YYYY-MM-DD');
	var geti = $("#Setvaluefordata").val();
	window.location.href = 'Show_accounting?i='+geti+'&datesearchstart='+datesearchstart+'&datesearchend='+datesearchend;
}

var blackupallpr = function blackupallpr(e) {
	var urlresult = JSON.parse(linkurl());
	window.location.href = urlresult.blackupallpr;
}

var blackupacpr = function blackupacpr(e) {
	var urlresult = JSON.parse(linkurl());
	window.location.href = urlresult.blackupacpr;
}

var blackupapprove = function blackupapprove(e) {
	var urlresult = JSON.parse(linkurl());
	window.location.href = urlresult.blackupapprove;
}

var blackupcompleted = function blackupcompleted(e) {
	var urlresult = JSON.parse(linkurl());
	window.location.href = urlresult.blackupcompleted;
}

var blackupreject = function blackupreject(e) {
	var urlresult = JSON.parse(linkurl());
	window.location.href = urlresult.blackupreject;
}

var Setvenderprmodel = function Setvenderprmodel(e) {
	var venderold = $(e).attr('venderold');
	$("#Setvenderprmodelshow").click();
	var prid = $(e).attr('prid');
	$("#headsetvender").text(prid);
	$("#headsetvenderinput").val(prid);
	console.log('แก้ไข Vendor'+prid);
}

var savesetvenderpr = function savesetvenderpr(e) {
	var urlresult = JSON.parse(linkurl());
	var prid = $("#headsetvenderinput").val();
	var vendorcode = $("#vendor").val();
	var vendorname = $("#vendorname").val();
	$.ajax({
		url: urlresult.savesetvenderpr,
		type: 'POST',
		data: {prid: prid,vendorcode: vendorcode,vendorname: vendorname},
		success: function (callback) {
				$("#closeSetvenderpr").click();
				if (callback=='OK') {
				alertify.set('notifier','position', 'อัพเดทเสร็จสิ้น');
        		alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
        		setTimeout(function() { location.reload();}, 1500);
				}
		}
	});
}

var rcok = function rcok(e) {
	var urlresult = JSON.parse(linkurl());
	var selected = new Array();
	  $("input:checkbox[name=RCcheckbox]:checked").each(function() {
       selected.push($(this).val());
  	});

	if (selected.length == 0) {
		alertify.set('notifier','position', 'เลือก PR ที่จะส่ง Fax');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
	}else{
		$.ajax({
			url: urlresult.RC_modal_opendata,
			type: 'POST',
			data: {prno: selected},
			success:function (callback) {
				$("#dispayopendatafax").html(callback);
				$("#btnopendatafax").click();
				$(".overlay").hide();

			$("#savefax").click(function(event) {
				$.ajax({
					url: urlresult.FAXSAVE,
					type: 'POST',
					data: {prno: selected},
					success: function (result) {
						if (result=='OK') {
						alertify.set('notifier','position', 'ส่งเรียบร้อย');
				        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
				        printElement(document.getElementById("dispayopendatafax"));
				        /*
				        setTimeout(function() {
						location.reload();
						}, 500);
						*/
						}
					}
				})
			});

			}
		});
	}
}

var ACappovecheck_submit = function ACappovecheck_submit() {
	var urlresult = JSON.parse(linkurl());
	var selected = new Array();
	  $("input:checkbox[name=RCcheckbox]:checked").each(function() {
       selected.push($(this).val());
  	});
	if (selected.length == 0) {
		alertify.set('notifier','position', 'เลือก PR ที่จะ อนุมัติ');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
	}else{
		$.ajax({
			url: urlresult.ACappovecheck_submit,
			type: 'POST',
			data: {selected},
			success:function (callback) {
				if (callback=='OK') {
				alertify.set('notifier','position', 'บันทึกเสร็จสิ้น');
				alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
				setTimeout(function() {
					location.reload();
				}, 500);
				}
			}
		});
	}
}
