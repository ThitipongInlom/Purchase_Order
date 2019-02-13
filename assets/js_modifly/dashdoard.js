var linkurl = function linkurl() {
  var url = "../../index.php/URL";
  var Httpreq = new XMLHttpRequest();
  Httpreq.open("GET", url, false);
  Httpreq.send(null);
  return Httpreq.responseText;
}

var AddDatavendor = function AddDatavendor() {
  $('#AddDatavendor').modal('show');
}

var AddDatawarehouse = function AddDatawarehouse() {
  $('#AddDatawarehouse').modal('show');
}

var AddDataproduct = function AddDataproduct() {
  var urlresult = JSON.parse(linkurl());
  $('#AddDataproduct').modal('show');
  // Select2
  $("#product_unit").select2({
    placeholder: "เลือกหน่วยนับ",
    width: "100%",
    ajax: {
      url: urlresult.Getunitproduct,
      dataType: 'json',
      data: function (params) {
        var queryParameters = {
          text: params.term
        }
        return queryParameters;
      }
    },
    cache: true,
    formatResult: format,
    formatSelection: format,
    dropdownParent: $("#AddDataproduct"),
    escapeMarkup: function (m) {
      return m;
    }
  });

  function format(x) {
    return x.text;
  }
}

var EditDatavendor = function EditDatavendor(e) {
  var urlresult = JSON.parse(linkurl());
  $('#EditDatavendor').modal('show');
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.EditGetvendor,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (callback) {
      var res = JSON.parse(callback);
      $("#EditvendorCode").val(res.vencode);
      $("#EditvendorName").val(res.venname1);
      $("#Editvendorphone").val(res.ventel);
      $("#Editvendorfax").val(res.venfax);
      $("#Editvendoremail").val(res.venemail);
      $("#Editvendoraddress").val(res.venadd1);
    }
  });
}

var EditDatawarehouse = function EditDatawarehouse(e) {
  var urlresult = JSON.parse(linkurl());
  $('#EditDatawarehouse').modal('show');
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.EditGetwarehouse,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (callback) {
      var res = JSON.parse(callback);
      $("#code_warehouse_hide").val(res.warecode);
      $("#edit_warehouse_name").val(res.waredesc1);
    }
  });
}

var SaveEditwarehouse = function SaveEditwarehouse() {
  var urlresult = JSON.parse(linkurl());
  var Code = $("#code_warehouse_hide").val();
  var Name = $("#edit_warehouse_name").val();
  var Data = new FormData();
  Data.append('code', Code);
  Data.append('name', Name);
  $.ajax({
    url: urlresult.SaveEditwarehouse,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (callback) {
      var res = JSON.parse(callback);
      if (res.Status == 'Error') {
        alert('ไม่มีการเปลี่ยนแปลงข้อมูล');
      } else {
        $('#EditDatawarehouse').modal('hide');
        alertify.set('notifier', 'position', 'บันทึกเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
      }
    }
  });
}

var SaveEditvendor = function SaveEditvendor() {
  var urlresult = JSON.parse(linkurl());
  var code = $("#EditvendorCode").val();
  var name = $("#EditvendorName").val();
  var Data = new FormData();
  Data.append('code', code);
  Data.append('name', name);
  Data.append('phone', $("#Editvendorphone").val());
  Data.append('fax', $("#Editvendorfax").val());
  Data.append('email', $("#Editvendoremail").val());
  Data.append('address', $("#Editvendoraddress").val());
  $.ajax({
    url: urlresult.SaveEditvendor,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (callback) {
      var res = JSON.parse(callback);
      if (res.Status == 'Error') {
        alert('ไม่มีการเปลี่ยนแปลงข้อมูล');
      } else {
        $('#EditDatavendor').modal('hide');
        alertify.set('notifier', 'position', 'บันทึกเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
      }
    }
  });
}

var SaveAddvendor = function SaveAddvendor() {
  var urlresult = JSON.parse(linkurl());
  var name = $("#vendorName").val();
  // Check Value Not Null
  if (name == '') {
    alert('กรุณากรอก Company Name');
    $("#vendorName").focus();
  } else {
    var Data = new FormData();
    Data.append('name', name);
    Data.append('phone', $("#vendorphone").val());
    Data.append('fax', $("#vendorfax").val());
    Data.append('email', $("#vendoremail").val());
    Data.append('address', $("#vendoraddress").val());
    $.ajax({
      url: urlresult.SaveAddvendor,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: Data,
      success: function (callback) {
        var res = JSON.parse(callback);
        if (res.Status == 'Error') {
          alert('Code ซ้ำกรุณาเปลี่ยน Code');
        } else {
          $('#AddDatavendor').modal('hide');
          alertify.set('notifier', 'position', 'บันทึกเสร็จสิ้น');
          alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        }
      }
    });
  }
}

var Deltevendor = function Deltevendor(e) {
  var urlresult = JSON.parse(linkurl());
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.Deletevendor,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (res) {
      if (res == 'Delete') {
        alertify.set('notifier', 'position', 'ลบข้อมูลเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        setTimeout(function () {
          location.reload();
        }, 500);
      }
    }
  });
}

var Deleteproduct = function Deleteproduct(e) {
  var urlresult = JSON.parse(linkurl());
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.Deleteproduct,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (res) {
      if (res == 'Delete') {
        alertify.set('notifier', 'position', 'ลบข้อมูลเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        setTimeout(function () {
          location.reload();
        }, 500);
      }
    }
  });
}

var Deletewarehouse = function Deletewarehouse(e) {
  var urlresult = JSON.parse(linkurl());
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.Deletewarehouse,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (res) {
      if (res == 'Delete') {
        alertify.set('notifier', 'position', 'ลบข้อมูลเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        setTimeout(function () {
          location.reload();
        }, 500);
      }
    }
  });
}

var SaveProduct = function SaveProduct() {
  var urlresult = JSON.parse(linkurl());
  var Name = $("#product_name").val();
  var Unit = $("#product_unit").val();
  if (Name == '') {
    alert('กรุณากรอก ชื่อสินค้า');
    $("#product_name").focus();
  } else if (Unit == null) {
    alert('กรุณาเลือกหน่วยนับ');
    $("#product_unit").focus();
  } else {
    var Data = new FormData();
    Data.append('Name', Name);
    Data.append('Unit', Unit);
    $.ajax({
      url: urlresult.SaveProduct,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: Data,
      success: function (res) {
        if (res == 'Insert') {
          $('#AddDataproduct').modal('hide');
          alertify.set('notifier', 'position', 'เพิ่มข้อมูลเสร็จสิ้น');
          alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        }else if (res == 'Error') {
          alert('Name Product ซ้ำที่มีอยู่');
        }
      }
    });
  }
}

var SaveWarehouse = function SaveWarehouse() {
  var urlresult = JSON.parse(linkurl());
  var Name = $("#warehouse_name").val();
  if (Name == '') {
    alert('กรุณากรอก Warehouse');
    $("#warehouse_name").focus();
  }else{
    var Data = new FormData();
    Data.append('Name', Name);
    $.ajax({
      url: urlresult.Savewarehouse,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: Data,
      success: function (res) {
        if (res == 'Insert') {
          $('#AddDatawarehouse').modal('hide');
          alertify.set('notifier', 'position', 'เพิ่มข้อมูลเสร็จสิ้น');
          alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        } else if (res == 'Error') {
          alert('Name Warehouse ซ้ำที่มีอยู่');
        }
      }
    });
  }
}

var EditDataproduct = function EditDataproduct(e) {
  var urlresult = JSON.parse(linkurl());
  $('#EditDataproduct').modal('show');
  var Code = $(e).attr('dataid');
  var Data = new FormData();
  Data.append('code', Code);
  $.ajax({
    url: urlresult.EditGetproduct,
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    data: Data,
    success: function (callback) {
      var res = JSON.parse(callback);
      $("#code_product_hide").val(res.stcode);
      $("#edit_product_name").val(res.stname1);
      var $option = $('<option selected><b>[' + res.stunit1 + '] ' + res.mdesc1 + '</b></option>').val(res.stunit1);

      $("#edit_product_unit").append($option).trigger('change');

      // Select2
      $("#edit_product_unit").select2({
        placeholder: "เลือกหน่วยนับ",
        width: "100%",
        ajax: {
          url: urlresult.Getunitproduct,
          dataType: 'json',
          data: function (params) {
            var queryParameters = {
              text: params.term
            }
            return queryParameters;
          }
        },
        cache: true,
        formatResult: format,
        formatSelection: format,
        dropdownParent: $("#EditDataproduct"),
        escapeMarkup: function (m) {
          return m;
        }
      });

      function format(x) {
        return x.text;
      }

    }
  }); 
}

var EditSaveProduct = function EditSaveProduct() {
    var urlresult = JSON.parse(linkurl());
    var Name = $("#edit_product_name").val();
    var Unit = $("#edit_product_unit").val();
    var Code = $("#code_product_hide").val();
    var Data = new FormData();
    Data.append('Name', Name);
    Data.append('Unit', Unit);
    Data.append('Code', Code);
    $.ajax({
      url: urlresult.EditSaveProduct,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: Data,
      success: function (callback) {
        var res = JSON.parse(callback);
        if (res.Status == 'Insert') {
          $('#EditDataproduct').modal('hide');
          alertify.set('notifier', 'position', 'แก้ไขข้อมูลเสร็จสิ้น');
          alertify.success('แจ้งเตือน : ' + alertify.get('notifier', 'position'));
        }else{
          alert('ไม่มีการเปลี่ยนแปลงข้อมูล');
        }
      }
    });
}