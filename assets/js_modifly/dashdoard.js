var linkurl = function linkurl() {
  var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}
var urlresult = JSON.parse(linkurl());

