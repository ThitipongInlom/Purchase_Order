var linkurl = function linkurl() {
  var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

var edit = function edit(e) {
  var urlresult = JSON.parse(linkurl());
  var primary = $(e).attr("primary");
  location.href = urlresult.edit + primary;
}

