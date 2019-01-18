var linkurl = function linkurl() {
    var url = "../../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

var showwindowsmodalprview = function showwindowsmodalprview(e) {
  var urlresult = JSON.parse(linkurl());
  var primary = $(e).attr('dataprno');
  var Showprview;
  Showprview = window.open(urlresult.showwindowsmodelprview + primary, "", "width=800, height=600");
}

var openwindowimg = function openwindowimg(e) {
  var urlresult = JSON.parse(linkurl());
  var partimg = $(e).attr("imgdata");
  var imgWindow;
  imgWindow = window.open(urlresult.imgpra253 + partimg, "", "width=600, height=600");
  imgWindow.onload = function () {
    setTimeout(function () {
      $(imgWindow.document).find('html').append('<head><title>PO By Thitipong Inlom</title></head>');
    }, 3000);
  }
}