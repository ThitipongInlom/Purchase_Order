$("#loginicon").hide();
$(document).ready(function() {
	$('#username').focus();
});

var linkurl = function linkurl() {
	var url = "index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

function login(e) {
	var urlresult = JSON.parse(linkurl());
	var username = $("#username").val();
	var password = $("#password").val();
	var datasrting = 'username=' + username + '&password=' + password;
	$('#loginicon').show();
	$.ajax({
		type: "POST",
		url: urlresult.login,
		data: datasrting,
		cache: false,
		success: function(result) {
			if (result == 1) {
				setTimeout("window.location.href = 'index.php/Dashboard/UserRoute';", 500);
			}
			if (result == 0) {
				document.getElementById("formlogin").reset();
				$('#username').focus();
				$('#loginicon').hide();
				alertify.defaults.theme.ok = "btn btn-primary";
				alertify.defaults.theme.cancel = "btn btn-danger";
				alertify.alert('แจ้งเตือน', 'Username หรือ Password ไม่ถูกต้อง');
			}
		}
	});
}
$('#login').click(function(e) {
	if (document.formlogin.username.value == '') {
		$('#username').focus();
		alertify.defaults.theme.ok = "btn btn-danger";
		alertify.defaults.theme.cancel = "btn btn-danger";
		alertify.alert('แจ้งเตือน', 'กรุณากรอก Username');
	} else if (document.formlogin.password.value == '') {
		$('#password').focus();
		alertify.defaults.theme.ok = "btn btn-danger";
		alertify.defaults.theme.cancel = "btn btn-danger";
		alertify.alert('แจ้งเตือน', 'กรุณากรอก Password');
		return false;
	} else {
		login(e);
	}
});
$(document).keypress(function(e) {
	if (e.keyCode == 13) {
		if (document.formlogin.username.value == '') {
			$('#username').focus();
			alertify.defaults.theme.ok = "btn btn-danger";
			alertify.defaults.theme.cancel = "btn btn-danger";
			alertify.alert('แจ้งเตือน', 'กรุณากรอก Username');
			return false;
		} else if (document.formlogin.password.value == '') {
			$('#password').focus();
			alertify.defaults.theme.ok = "btn btn-danger";
			alertify.defaults.theme.cancel = "btn btn-danger";
			alertify.alert('แจ้งเตือน', 'กรุณากรอก Password');
			return false;
		} else {
			login(e);
		}
	}
});