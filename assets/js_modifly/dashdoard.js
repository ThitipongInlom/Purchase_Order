var linkurl = function linkurl() {
    var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

var AddDataWarehouse = function AddDataWarehouse() {
    var urlresult = JSON.parse(linkurl());
    console.log('Show AddDataWarehouse Modal');
    $('#AddDataWarehouse').modal('show');
}
$('#AddDataWarehouse').on('hidden.bs.modal', function (e) {
    $("#CodeWarehouse").val('');
    $("#WarehouseName").val('');
})

var SaveAddWarehouse = function SaveAddWarehouse() {
    var urlresult = JSON.parse(linkurl());
    console.log('Save AddWarehouse');
    var code = $("#CodeWarehouse").val();
    var name = $("#WarehouseName").val();
    // Check Value Not Null
    if(code == ''){
      console.log('Code Null');  
      alert('กรุณากรอก Code');
      $("#CodeWarehouse").focus();
    } else if (name == '') {
      console.log('Name Null');
      alert('กรุณากรอก Name Code');
      $("#WarehouseName").focus();
    }else {
      var Data = new FormData();
      Data.append('code', code);
      Data.append('name', name);
        $.ajax({
          url: urlresult.SaveAddWarehouse,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          data: Data,
          success: function (res) {
            console.log(res);
          }
        });
    }
}

