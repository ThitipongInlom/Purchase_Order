$(document).ready(function() {
	var UsernameSwitch = $("#usernameSwitch").val();
	var usernameSession = $("#usernameSession").val();
	if (UsernameSwitch == usernameSession) {
	$("#switchhide").click();	
	$("#SQLAddprSwitch").bootstrapSwitch(); 
	$("#AddprsetSwitch").bootstrapSwitch(); 
	$("#Show_allSwitch").bootstrapSwitch(); 
	$("#Show_allnewSwitch").bootstrapSwitch();
	$("#Show_approveSwitch").bootstrapSwitch();
	$("#Show_completedSwitch").bootstrapSwitch();
	$("#Show_accountingSwitch").bootstrapSwitch();
	$("#Show_rejectSwitch").bootstrapSwitch();
	$("#SettinguserSwitch").bootstrapSwitch();
	SQLAddprSwitch();
	AddprsetSwitch();
	Show_allSwitch();
	Show_allnewSwitch();
	Show_approveSwitch();
	Show_completedSwitch();
	Show_accountingSwitch();
	Show_rejectSwitch();
	SettinguserSwitch();
	}
});

var linkurl = function linkurl() {
	var url = "../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

$(document).keypress(function(e) {
	if (e.keyCode == 13) {
	var urlresult = JSON.parse(linkurl());
	var old  = $("#oldpassword").val();
	var new1 = $("#newpassword1").val();
	var new2 = $("#newpassword2").val();
	if (old=='') {
	$("#oldpassword").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านเก่า');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new1=='') {
	$("#newpassword1").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านใหม่');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new2=='') {
	$("#newpassword2").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านใหม่');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new1!=new2) {
	$("#newpassword2").focus();	
	alertify.set('notifier','position', 'กรุรากรอกให้ตรงกัน');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    $("#formnewpassword2").addClass("has-error");
    return false;
	}else{
		callbackpassword(old,new1,new2);
	}
	}
});

var checkpassword = function checkpassword() {
	var urlresult = JSON.parse(linkurl());
	var old  = $("#oldpassword").val();
	var new1 = $("#newpassword1").val();
	var new2 = $("#newpassword2").val();
	if (old=='') {
	$("#oldpassword").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านเก่า');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new1=='') {
	$("#newpassword1").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านใหม่');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new2=='') {
	$("#newpassword2").focus();	
	alertify.set('notifier','position', 'กรุณากรอกรหัสผ่านใหม่');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    return false;
	}else if (new1!=new2) {
	$("#newpassword2").focus();	
	alertify.set('notifier','position', 'กรุรากรอกให้ตรงกัน');
    alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
    $("#formnewpassword2").addClass("has-error");
    return false;
	}else{
		callbackpassword(old,new1,new2);
	}
}

var callbackpassword = function callbackpassword(old,new1,new2) {
	var urlresult = JSON.parse(linkurl());
	$("#btnpasswordsave").attr('disabled', '');
	$.ajax({
		url: urlresult.Chanepassword,
		type: 'POST',
		data: {old: old,new1: new1,new2: new2},
		success:function (result) {
			var Newresult = JSON.parse(result);
			console.log(Newresult);
			if (Newresult.status == 'Notsame') {
				alertify.defaults.theme.ok = "btn btn-primary";
				alertify.defaults.theme.cancel = "btn btn-danger";
				alertify.alert('แจ้งเตือน', 'รหัสผ่านเก่าไม่ถูกต้อง').set({ onclosing:function(){ $("#formoldpassword").addClass("has-error")}});
				$("#btnpasswordsave").removeAttr('disabled');
				$("#oldpassword").val(''); 
				$("#newpassword1").val(''); 
				$("#newpassword2").val(''); 
			}else if (Newresult.status == 'OK') {
				$("#btnpasswordsave").removeAttr('disabled');
				$("#oldpassword").val(''); 
				$("#newpassword1").val(''); 
				$("#newpassword2").val(''); 
				$("#formoldpassword").removeClass("has-error");
				$("#formnewpassword2").removeClass("has-error");
				alertify.set('notifier','position', 'เปลี่ยนรหัสผ่านเสร็จเรียบร้อย');
    			alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));				
			}
		}
	});
}

var SQLAddprSwitch = function SQLAddprSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.SQLAddprSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.SQLAddprSwitch == 0) {
				$("#SQLAddprSwitch").click();
			}
		}
	});	
}

var AddprsetSwitch = function AddprsetSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.AddprsetSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.AddprsetSwitch == 0) {
				$("#AddprsetSwitch").click();
			}
		}
	});	
}

var Show_allSwitch = function Show_allSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_allSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_allSwitch == 0) {
				$("#Show_allSwitch").click();
			}
		}
	});	
}

var Show_allnewSwitch = function Show_allnewSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_allnewSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_allnewSwitch == 0) {
				$("#Show_allnewSwitch").click();
			}
		}
	});
}

var Show_approveSwitch = function Show_approveSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_approveSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_approveSwitch == 0) {
				$("#Show_approveSwitch").click();
			}
		}
	});
}

var Show_completedSwitch = function Show_completedSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_completedSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_completedSwitch == 0) {
				$("#Show_completedSwitch").click();
			}
		}
	});
}

var Show_accountingSwitch = function Show_accountingSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_accountingSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_accountingSwitch == 0) {
				$("#Show_accountingSwitch").click();
			}
		}
	});
}

var Show_rejectSwitch = function Show_rejectSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.Show_rejectSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.Show_rejectSwitch == 0) {
				$("#Show_rejectSwitch").click();
			}
		}
	});
}

var SettinguserSwitch = function SettinguserSwitch(e) {
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.SettinguserSwitchCheck,
		success: function (callback) {
			New_data = JSON.parse(callback);
			if (New_data.SettinguserSwitch == 0) {
				$("#SettinguserSwitch").click();
			}
		}
	});
}

$("#SQLAddprSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateSQLAddprSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateSQLAddprSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#AddprsetSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateAddprsetSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateAddprsetSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_allSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_allSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_allSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_allnewSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_allnewSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_allnewSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_approveSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_approveSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_approveSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_completedSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_completedSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_completedSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_accountingSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_accountingSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_accountingSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#Show_rejectSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateShow_rejectSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateShow_rejectSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});

$("#SettinguserSwitch").on('switchChange.bootstrapSwitch', function(event, state){
	var urlresult = JSON.parse(linkurl());
	if (state==false) {
		$.ajax({
			url: urlresult.UpdateSettinguserSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});	
	}
	if (state==true) {
		$.ajax({
			url: urlresult.UpdateSettinguserSwitch,
			type: 'POST',
			data: {state: state},
			success: function (result) {
				console.log(result);
			}
		});			
	}
});