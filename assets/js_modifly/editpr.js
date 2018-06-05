var linkurl = function linkurl() {
  var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
}

$("#savepr").click(function(e) {
    var urlresult = JSON.parse(linkurl());
    var prno = $("#prno").val();
    var div = $("#divisioncode").val();
    var remark = $("#remark").val();
    var warecode = $("#warecode").val();
    var dc = $("#dc").val();
    var dc_a = $("#dc_a").val();
    var vat = document.getElementsByName('r2');
    for (var i = 0, length = vat.length; i < length; i++) {
    if (vat[i].checked) {
        var newvat = vat[i].value;
      }
    }
    var vendor = $("#vendor").val();
    var vendorname = $("#vendorname").val();
    var depname = $("#depname").val();
    var depcode = $("#depcode").val();
    var gmremark = $("#gmremark").val();
    var efcremark = $("#efcremark").val();
    var form_data = new FormData();
    form_data.append('prno', prno);
    form_data.append('div', div);
    form_data.append('remark', remark);
    form_data.append('warecode', warecode);
    form_data.append('dc', dc);
    form_data.append('dc_a', dc_a);
    form_data.append('vat', newvat);
    form_data.append('vendor', vendor);
    form_data.append('vendorname', vendorname);
    form_data.append('depname', depname);
    form_data.append('depcode', depcode);
    form_data.append('gmremark', gmremark);
    form_data.append('efcremark', efcremark);
    $.ajax({
      url: urlresult.editupper,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success: function (callback) {
        var msg = JSON.parse(callback);
      if (msg.Code =='1') {
        alertify.set('notifier','position', msg.Data);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      if (msg.Code =='2') {
        alertify.set('notifier','position', msg.Data);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      setTimeout(function() {window.history.back();}, 500);
      }
    });
});

$("#saveprx").click(function(e) {
    var urlresult = JSON.parse(linkurl());
    var prno = $("#prno").val();
    var div = $("#divisioncode").val();
    var remark = $("#remark").val();
    var warecode = $("#warecode").val();
    var dc = $("#dc").val();
    var dc_a = $("#dc_a").val();
    var vat = document.getElementsByName('r2');
    for (var i = 0, length = vat.length; i < length; i++) {
    if (vat[i].checked) {
        var newvat = vat[i].value;
      }
    }
    var vendor = $("#vendor").val();
    var vendorname = $("#vendorname").val();
    var depname = $("#depname").val();
    var depcode = $("#depcode").val();
    var gmremark = $("#gmremark").val();
    var efcremark = $("#efcremark").val();
    var form_data = new FormData();
    form_data.append('prno', prno);
    form_data.append('div', div);
    form_data.append('remark', remark);
    form_data.append('warecode', warecode);
    form_data.append('dc', dc);
    form_data.append('dc_a', dc_a);
    form_data.append('vat', newvat);
    form_data.append('vendor', vendor);
    form_data.append('vendorname', vendorname);
    form_data.append('depname', depname);
    form_data.append('depcode', depcode);
    form_data.append('gmremark', gmremark);
    form_data.append('efcremark', efcremark);
    $.ajax({
      url: urlresult.editupper2,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success: function (callback) {
        var msg = JSON.parse(callback);
      if (msg.Code =='1') {
        alertify.set('notifier','position', msg.Data);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      if (msg.Code =='2') {
        alertify.set('notifier','position', msg.Data);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      setTimeout(function() {window.history.back();}, 500);
      }
    });
});

$("#saveprreceive").click(function(e) {
    var urlresult = JSON.parse(linkurl());
    var prno = $("#prno").val();
    var div = $("#divisioncode").val();
    var remark = $("#remark").val();
    var warecode = $("#warecode").val();
    var dc = $("#dc").val();
    var dc_a = $("#dc_a").val();
    var vat = document.getElementsByName('r2');
    for (var i = 0, length = vat.length; i < length; i++) {
    if (vat[i].checked) {
        var newvat = vat[i].value;
      }
    }
    var vendor = $("#vendor").val();
    var vendorname = $("#vendorname").val();
    var depname = $("#depname").val();
    var depcode = $("#depcode").val();
    var gmremark = $("#gmremark").val();
    var efcremark = $("#efcremark").val();
    var form_data = new FormData();
    form_data.append('prno', prno);
    form_data.append('div', div);
    form_data.append('remark', remark);
    form_data.append('warecode', warecode);
    form_data.append('dc', dc);
    form_data.append('dc_a', dc_a);
    form_data.append('vat', newvat);
    form_data.append('vendor', vendor);
    form_data.append('vendorname', vendorname);
    form_data.append('depname', depname);
    form_data.append('depcode', depcode);
    form_data.append('gmremark', gmremark);
    form_data.append('efcremark', efcremark);
    $.ajax({
      url: urlresult.receiveupper,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success: function (callback) {
        var msg = JSON.parse(callback);
      if (msg.Code =='1') {
        alertify.set('notifier','position', msg.Data);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      if (msg.Code =='2') {
        alertify.set('notifier','position', msg.Data);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      setTimeout(function() {window.history.back();}, 500);
      }
    });
});

var trunback = function trunback() {
    window.history.back();
}

$("#colseupdate").click(function (e) {
    document.getElementById("formadditem").reset(); 
    $(".trinfo").removeClass('info');
    checkitemid();
    $("#updataitem").hide();
    $("#colseupdate").hide();
    $("#additem").show();
    $("#updataitem").removeAttr('seq');
    $("#updataitem").removeAttr('prdcode');
});

var updataitem = function updataitem(e) {
   var urlresult = JSON.parse(linkurl());
   var seq = $(e).attr('seq');
   var prdcodeold = $(e).attr('prdcode');
   var itemifileupd = $("#itemifileupd").prop('files')[0];
   var itemiremark  = $("#itemiremark").val();
   var itemusedate  = $("#itemusedate").val();
   var itemprprice  = $("#itemprprice").val();
   var itemprpriceold = $("#itemprpriceold").val();
   var itemlastpurdate = $("#itemlastpurdate").val();
   var itemprqty = $("#itemprqty").val();
   var itemproductcode = $("#productcode").val();
   var itemseq = $("#itemprno").val();
   var itemprno = $("#prno").val();
   var form_data = new FormData();
   form_data.append('seqold', seq);
   form_data.append('prdcodeold', prdcodeold);
   form_data.append('prno', itemprno);
   form_data.append('seq', itemseq);
   form_data.append('productcode', itemproductcode);
   form_data.append('prqty', itemprqty);
   form_data.append('prpriceold', itemprpriceold);
   form_data.append('lastpurdate', itemlastpurdate);
   form_data.append('prprice', itemprprice);
   form_data.append('usedate', itemusedate);
   form_data.append('iremark', itemiremark);
   form_data.append('file', itemifileupd);
   $.ajax({
     url: urlresult.updataitem,
     dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success: function (callback) {
      checkitemid();
      showtabledataitem();
        // MSG Callback  
        var msg = JSON.parse(callback);
        if (msg.ImgCode =='0') {
        alertify.set('notifier','position', msg.DataSave);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
        document.getElementById("formadditem").reset();
        }
        if (msg.ImgCode =='1') {
        alertify.set('notifier','position', msg.ImgSave);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        // SET RETURN 0
        document.getElementById("formadditem").reset(); 
        }
        if (msg.ImgCode =='2') {
        alertify.set('notifier','position', msg.ImgSave);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        // SET RETURN 0
        document.getElementById("formadditem").reset(); 
        }
        if (msg.ImgCode =='3') {
        alertify.set('notifier','position', msg.DataSave);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
        }
        $("#updataitem").hide();
        $("#colseupdate").hide();
        $("#additem").show();
        $(".trinfo").removeClass('info');
        document.getElementById("formadditem").reset();
        $("#updataitem").removeAttr('seq');
        $("#updataitem").removeAttr('prdcode');
      }
   });  
}

var windowsdata = function windowsdata(e) {
    var urlresult = JSON.parse(linkurl());
    var sendid = $(e).attr('sendid');
    var viewhistory;
    viewhistory = window.open(urlresult.windowsdata + sendid, "", "width=800, height=600");
}

var openwindowimg = function openwindowimg(e) {
  var urlresult = JSON.parse(linkurl());
  var partimg = $(e).attr("imgdata");
  var imgWindow;
  imgWindow = window.open(urlresult.imgpra253 + partimg, "", "width=600, height=600");
}

var openwindowimgitem = function openwindowimgitem(e) {
  var urlresult = JSON.parse(linkurl());
  var partimg = $(e).attr("imgdata");
  var imgWindow;
  imgWindow = window.open(urlresult.imgpra253 + partimg, "", "width=600, height=600");
}

var ajaxopenproduct = function ajaxopenproduct(e) {
  var urlresult = JSON.parse(linkurl());
  alertify.set('notifier','position', 'โปรดรอซักครู่');
  alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
  $.ajax({
    url: urlresult.ajaxopenproduct,
    type: 'POST',
    data: {Senddata: 'OK'},
    success: function (callback) {
    $("#showlistitem").html(callback);  
    $("#openproduct").click();
    $("#inputgolist").focus();
    }
  }); 
}

var openedititem = function openedititem(e) {
  var urlresult = JSON.parse(linkurl());
  var prno = $(e).attr("prno");
  var seq = $(e).attr("seq");
  $.ajax({
    url: urlresult.openedititem,
    type: 'POST',
    data: {prno: prno, seq: seq},
    success: function (callback) {
      var result  = JSON.parse(callback);
      $("#updataitem").show();
      $("#colseupdate").show();
      $("#additem").hide();
      $("#itemprno").val(result[0].seq);
      editsetptoductcode(result[0].prdcode);
      $("#itemprqty").val(result[0].prqty);
      if (result[0].lastpurdate == 'new') {
      $("#itemlastpurdate").val("new");  
      }else{
      formatdateitemlastpurdate(result[0].lastpurdate);  
      }
      formatdateitemitemusedate(result[0].usedate);
      $("#itemprpriceold").val(result[0].prprice_old);
      $(".trinfo").attr('class', 'info trinfo');
      $("#itemprprice").val(result[0].prprice);
      $("#itemiremark").val(result[0].iremark);
      $("#updataitem").attr('seq', result[0].seq);
      $("#updataitem").attr('prdcode', result[0].prdcode);
    }
  }); 
}


var formatdateitemlastpurdate = function formatdateitemlastpurdate(datadate) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.formatdateitemlastpurdate,
    type: 'POST',
    data: {datadate: datadate},
    success: function (callback) {
      var result  = JSON.parse(callback);
      $("#itemlastpurdate").val(result.datadate);
    }
  }); 
}

var formatdateitemitemusedate = function formatdateitemitemusedate(datadate) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.formatdateitemitemusedate,
    type: 'POST',
    data: {datadate: datadate},
    success: function (callback) {
      var result  = JSON.parse(callback);
      $("#itemusedate").val(result.datadate);
    }
  }); 
}

var editsetptoductcode = function editsetptoductcode(prdcode) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
      url: urlresult.editsetptoductcode,
      type: 'POST',
      data: {v_id: prdcode},
      success: function (data) {
      var dt = JSON.parse(data);
      $("#productcode").val(dt[0].stcode);
      $("#itemstname1").val(dt[0].stname1);
      $("#itemmdesc1").val(dt[0].mdesc1);
    }
  }); 
}

var golist = function golist(e) {
  var urlresult = JSON.parse(linkurl());
  var vgolist = $("#inputgolist").val();
  $('#loginicon').show();
  $.ajax({
    url: urlresult.golist,
    type: 'POST',
    data: {value: vgolist},
    success: function (result) {
    $("#tablelist").html(result);
    $("#loginicon").hide();
    }
  });
}

var Keygolist = function Keygolist(event) {
    var x = event.keyCode;
    if (x == 13) {
        golist();
    }
}

var urlresult = JSON.parse(linkurl());
$("#getvender").select2({
  placeholder: "ค้นหา Vendor",
  ajax: {
    url: urlresult.getvender,
    dataType: 'json',
    data: function(params) {
      var queryParameters = {
        text: params.term
      }
      return queryParameters;
    }
  },
  cache: true,
  minimumInputLength: 2,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) {
    return m;
  }
});

$("#getwarehouse").select2({
  placeholder: "เลือก",
  ajax: {
    url: urlresult.getwarehouse,
    dataType: 'json',
    data: function(params) {
      var queryParameters = {
        text: params.term
      }
      return queryParameters;
    }
  },
  cache: true,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) {
    return m;
  }
});
$("#getdivision").select2({
  placeholder: "เลือกโรงแรม",
  ajax: {
    url: urlresult.getdivision,
    dataType: 'json',
    data: function(params) {
      var queryParameters = {
        text: params.term
      }
      return queryParameters;
    }
  },
  cache: true,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) {
    return m;
  }
});
$("#getdepartment").select2({
  placeholder: "เลือกแผนก",
  ajax: {
    url: urlresult.getdepartment,
    dataType: 'json',
    data: function(params) {
      var queryParameters = {
        text: params.term
      }
      return queryParameters;
    }
  },
  cache: true,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) {
    return m;
  }
});

function format(x) {
  return x.text;
}

var setwarehouse = function setwarehouse(v_id) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setwarehouse,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#warecode").val(dt.warecode);
      $("#waredesc").val(dt.waredesc1);
    }
  });
}

var autosetwarehouse = function autosetwarehouse(v_id) {
  var v_id = $("#warecode").val();
  var urlresult = JSON.parse(linkurl());
    $.ajax({
    url: urlresult.setwarehouse,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#warecode").val(dt.warecode);
      $("#waredesc").val(dt.waredesc1);
    }
  });
}
autosetwarehouse();

var setvender = function setvender(v_id) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setvendor,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#vendor").val(dt.vencode);
      $("#vendorname").val(dt.venname1);
    }
  });
}

var setdivision =function setdivision(v_id) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setdivision,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#divisioncode").val(dt.divcode);
      $("#divisionname").val(dt.divname1);
    }
  });
}

var autosetdivision = function autosetdivision(v_id) {
  var v_id = $("#divisioncode").val();
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setdivision,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#divisioncode").val(dt.divcode);
      $("#divisionname").val(dt.divname1);
    }
  });
}
autosetdivision();

var setdepartment = function setdepartment(v_id) {
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setdepartment,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#depcode").val(dt.depcode);
      $("#depname").val(dt.depname1);
    }
  });
}

var autosetdepartment = function autosetdepartment(v_id) {
  var v_id = $("#depcode").val();
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.setdepartment,
    data: {
      id: v_id
    },
    success: function(data) {
      var dt = JSON.parse(data);
      $("#depcode").val(dt.depcode);
      $("#depname").val(dt.depname1);
    }
  });
}
autosetdepartment();

var setproductcode = function setproductcode(v_id) {
  var sendv = $(v_id).attr("value");
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.editsetptoductcode,
    type: 'POST',
    data: {v_id: sendv},
    success: function (data) {
      var dt = JSON.parse(data);
      $("#productcode").val(dt[0].stcode);
      $("#itemstname1").val(dt[0].stname1);
      $("#itemmdesc1").val(dt[0].mdesc1);
      $("#closeshowlistitem").click();
      $.ajax({
        url: urlresult.setproductoldpr,
        type: 'POST',
        data: {v_id: dt[0].stcode},
        success: function (result) {
          var oldpr = JSON.parse(result);
          if (oldpr.length == 0) {
          $("#itemprpriceold").attr("disabled", true);
          $("#itemlastpurdate").attr("disabled", true);
          $("#Newitem").html('Newitem');
          }else if (oldpr.length == 1) {
          formatdateitemlastpurdate(oldpr[0].prdate);
          $("#itemprpriceold").val(oldpr[0].prprice); 
          $("#itemprprice").focus();           
          }
        }
      });  
    }
  }); 
}

var checkitemid = function checkitemid() {
  var ch_id = $("#prno").attr('value');
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.checkitemid,
    type: 'POST',
    data: {checkitemid: ch_id},
    success: function (result) {
      $("#itemprno").val(result);
    }
  });
}
// autorun
checkitemid();

var showtabledataitem =function showtabledataitem() {
  var prno = $("#prno").attr('value');
  var urlresult = JSON.parse(linkurl());
  $.ajax({
    url: urlresult.showtabledataitem,
    type: 'POST',
    data: {checkitemid: prno},
    success: function (callback) {
      $("#showtabledataitem").html(callback);
    }
  }); 
}
// Auto Item Table
showtabledataitem();

$("#additem").click(function() {
  if (document.formpr.vendor.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก เลือก Vendor');    
    return false;
  } else if (document.formpr.warecode.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก เลือก Warecode');    
    return false;
  } else if (document.formpr.divisioncode.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก เลือก Division');    
    return false;
  } else if (document.formadditem.productcode.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก เลือก สินค้าที่จะสั่งซื้อ');    
    return false;
  } else if (document.formadditem.itemusedate.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก เลือก วันที่รับสินค้า');    
    return false;
  } else if (document.formadditem.itemprprice.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก Unit Price');    
    return false;
  } else if (document.formadditem.itemprqty.value == '') {
    alertify.defaults.theme.ok = "btn btn-danger";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.alert('แจ้งเตือน', 'กรุณากรอก Quantity');    
    return false;
  }else{
    CheckPrcodeNoOne();
  }
});

var CheckPrcodeNoOne = function CheckPrcodeNoOne() {
    var urlresult = JSON.parse(linkurl());
    var productcode =  $("#productcode").val();
    var prno = $("#prno").val();
    $.ajax({
      url: urlresult.CheckPrcodeNoOne,
      type: 'POST',
      data: {productcode: productcode, prno: prno},
      success: function (result) {
       var Num_rows = JSON.parse(result);
       if (Num_rows.Result == 0) {
       additem(); 
       }else{
        alertify.defaults.theme.ok = "btn btn-danger";
        alertify.defaults.theme.cancel = "btn btn-danger";
        alertify.alert('แจ้งเตือน', 'Product Code นี้มีใน Pr นี้แล้ว');    
        return false;          
       }
      }
    })   
}

var additem = function additem() {
    var urlresult = JSON.parse(linkurl());
    var itemifileupd = $("#itemifileupd").prop('files')[0];
    var itemiremark  = $("#itemiremark").val();
    var itemusedate  = $("#itemusedate").val();
    var itemprprice  = $("#itemprprice").val();
    var itemprpriceold = $("#itemprpriceold").val();
    var itemlastpurdate = $("#itemlastpurdate").val();
    var itemprqty = $("#itemprqty").val();
    var itemproductcode = $("#productcode").val();
    var itemseq = $("#itemprno").val();
    var itemprno = $("#prno").val();
    var div = $("#divisioncode").val();
    var remark = $("#remark").val();
    var warecode = $("#warecode").val();
    var dc = $("#dc").val();
    var dc_a = $("#dc_a").val();
    var vat = document.getElementsByName('r2');
    for (var i = 0, length = vat.length; i < length; i++) {
    if (vat[i].checked) {
        var newvat = vat[i].value;
      }
    }
    var vendor = $("#vendor").val();
    var vendorname = $("#vendorname").val();
    var depname = $("#depname").val();
    var depcode = $("#depcode").val();
    var gmremark = $("#gmremark").val();
    var efcremark = $("#efcremark").val();    
    var form_data = new FormData();
    form_data.append('prno', itemprno);
    form_data.append('seq', itemseq);
    form_data.append('productcode', itemproductcode);
    form_data.append('prqty', itemprqty);
    form_data.append('prpriceold', itemprpriceold);
    form_data.append('lastpurdate', itemlastpurdate);
    form_data.append('prprice', itemprprice);
    form_data.append('usedate', itemusedate);
    form_data.append('iremark', itemiremark);
    form_data.append('file', itemifileupd);
    form_data.append('div', div);
    form_data.append('remark', remark);
    form_data.append('warecode', warecode);
    form_data.append('dc', dc);
    form_data.append('dc_a', dc_a);
    form_data.append('vat', newvat);
    form_data.append('vendor', vendor);
    form_data.append('vendorname', vendorname);
    form_data.append('depname', depname);
    form_data.append('depcode', depcode);
    form_data.append('gmremark', gmremark);
    form_data.append('efcremark', efcremark);
    $.ajax({
      url: urlresult.doupload,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success:function(callback) {
      checkitemid();
      showtabledataitem();  
        // MSG Callback  
        var msg = JSON.parse(callback);
        if (msg.ImgCode =='0') {
        alertify.set('notifier','position', msg.DataSave);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
        document.getElementById("formadditem").reset();
        }
        if (msg.ImgCode =='1') {
        alertify.set('notifier','position', msg.ImgSave);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        // SET RETURN 0
        document.getElementById("formadditem").reset(); 
        }
        if (msg.ImgCode =='2') {
        alertify.set('notifier','position', msg.ImgSave);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        // SET RETURN 0
        document.getElementById("formadditem").reset(); 
        }
        if (msg.ImgCode =='3') {
        alertify.set('notifier','position', msg.DataSave);
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position'));
        }

      }
    });
};

var deleteitem = function deleteitem(e) {
  var urlresult = JSON.parse(linkurl());
  var prno = $(e).attr('prno');
  var seq  = $(e).attr('seq');
  var img  = $(e).attr('img');
  var prdcode = $(e).attr('pocode');
  $.ajax({
    url: urlresult.deleteitem,
    type: 'POST',
    data: {prno: prno,seq: seq,img: img,prdcode: prdcode},
    success: function (msg) {
    showtabledataitem();
      // MSG Callback  
      var msg = JSON.parse(msg);
      if (msg.codedata=='1') {
        alertify.set('notifier','position', msg.deletedata);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      if (msg.codeimg=='2') {
        alertify.set('notifier','position', msg.deleteimg);
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
      }
      checkitemid();
    }
  });
}

var checkNumberunitprice = function checkNumberunitprice(e) {
  var itemnumber = $("#itemprprice").val();
  if (isNaN(itemnumber) || itemnumber < 0.1 || itemnumber > 100000000000) {
        alertify.set('notifier','position', 'กรุณาใส่ตัวเลขเท่านั้น');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        $("#itemprprice").val('');
        $("#itemprprice").focus();
  }else{
    console.log('OK Pass Unit Price');
  }
}

var checkNumberprqty = function checkNumberprqty(e) {
  var itemnumber = $("#itemprqty").val();
  if (isNaN(itemnumber) || itemnumber < 0.1 || itemnumber > 100000000000) {
        alertify.set('notifier','position', 'กรุณาใส่ตัวเลขเท่านั้น');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        $("#itemprqty").val('');
        $("#itemprqty").focus();
  }else{
    console.log('OK Pass PR QTY');
  }
}

var checkNumberdc = function checkNumberdc(e) {
  var itemnumber = $("#dc").val();
  if (isNaN(itemnumber) || itemnumber < 0.1 || itemnumber > 100000000000) {
        alertify.set('notifier','position', 'กรุณาใส่ตัวเลขเท่านั้น');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        $("#dc").val('0');
        $("#dc").focus();
  }else{
    console.log('OK Pass DC');
  }
}

var checkNumberdc_a = function checkNumberdc_a(e) {
  var itemnumber = $("#dc_a").val();
  if (isNaN(itemnumber) || itemnumber < 0.1 || itemnumber > 100000000000) {
        alertify.set('notifier','position', 'กรุณาใส่ตัวเลขเท่านั้น');
        alertify.error('แจ้งเตือน : ' + alertify.get('notifier','position')); 
        $("#dc_a").val('0');
        $("#dc_a").focus();
  }else{
    console.log('OK Pass DC_A');
  }
}






