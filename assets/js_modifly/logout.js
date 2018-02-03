$("#logouticon").hide();
$("#logout").click(function(e) {
	$("#logouticon").show();
	$.ajax({
		url: 'http://172.16.1.253/PO/index.php/Welcome/logout',
		type: 'POST',
		data: {
			data: 'logout'
		},
		success: function(result) {
			setTimeout("window.location.href = 'http://172.16.1.253/PO';", 1500);
		}
	});
});