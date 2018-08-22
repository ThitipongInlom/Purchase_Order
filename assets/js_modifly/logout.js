var linkurl = function linkurl() {
	var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}
$("#logouticon").hide();
$("#logout").click(function(e) {
	$("#logouticon").show();
	var urlresult = JSON.parse(linkurl());
	$.ajax({
		url: urlresult.logout,
		type: 'POST',
		data: {
			data: 'logout'
		},
		success: function(result) {
			$.removeCookie('rowid');
			setTimeout("window.location.href = urlresult.urlweb;", 200);
		}
	});
});