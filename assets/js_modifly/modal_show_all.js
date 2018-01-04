var opendata = function opendata(e) {
	$(".overlay").show();
	var primary = $(e).attr("primary");
	$.ajax({
		url: 'http://172.16.1.253/PO/index.php/Show_data/modal_opendata',
		type: 'POST',
		data: {primary: primary},
		success: function (result) {
			$("#dispayopendata").html(result);
			$("#btnopendata").click();
			$(".overlay").hide();
		}
	});


}