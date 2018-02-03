var opendata = function opendata(e) {
	$(".overlay").show();
	var primary = $(e).attr("primary");
	$.ajax({
		url: 'http://172.16.1.253/PO/index.php/Show_data/modal_opendata',
		type: 'POST',
		data: {
			primary: primary
		},
		success: function(result) {
			$("#dispayopendata").html(result);
			$("#btnopendata").click();
			$(".overlay").hide();
		}
	});
}

var btnprint = function btnprint(e) {
	$(".overlay").show();
	var primary = $(e).attr("primary");
	$.ajax({
		url: 'http://172.16.1.253/PO/index.php/Show_data/modal_opendata',
		type: 'POST',
		data: {
			primary: primary
		},
		success: function(result) {
			$("#dispayopendata").html(result);
			setTimeout(function() {
				$(".overlay").hide();
				printElement(document.getElementById("dispayopendata"));
			}, 1500);
		}
	});
}

var openwindowimg = function openwindowimg(e) {
	var partimg = $(e).attr("imgdata");
	var imgWindow;
	imgWindow = window.open("../../assets/photo_storage/" + partimg, "", "width=600, height=600");
	imgWindow.onload = function() {
		setTimeout(function() {
			$(imgWindow.document).find('html').append('<head><title>PO By Thitipong Inlom</title></head>');
		}, 3000);
	}
}

var printdata = function printdata(e) {
	printElement(document.getElementById("dispayopendata"));
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