$("#savepr").click(function(e) {

});

$("#additem").click(function() {
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
      url: 'http://172.16.1.253/PO/index.php/Add_Pr/doupload',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      data: form_data,
      success:function(callback) {
        console.log(callback);
      }
    });
});

var windowsdata = function windowsdata(e) {
    var sendid = $(e).attr('sendid');
    var viewhistory;
    viewhistory = window.open("http://172.16.1.253/PO/index.php/Add_Pr/viewhistory/" + sendid, "", "width=600, height=600");
}

var openwindowimg = function openwindowimg(e) {
  var partimg = $(e).attr("imgdata");
  var imgWindow;
  imgWindow = window.open("../../../assets/photo_storage/" + partimg, "", "width=600, height=600");
}

var ajaxopenproduct = function ajaxopenproduct(e) {
  alertify.set('notifier','position', 'โปรดรอซักครู่');
  alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
  $.ajax({
    url: 'http://172.16.1.253/PO/index.php/Add_Pr/listitem',
    type: 'POST',
    data: {Senddata: 'OK'},
    success: function (callback) {
    $("#showlistitem").html(callback);  
    $("#openproduct").click();
    }
  }); 
}

var golist = function golist(e) {
  var vgolist = $("#inputgolist").val();
  $('#loginicon').show();
  $.ajax({
    url: 'http://172.16.1.253/PO/index.php/Add_Pr/golist',
    type: 'POST',
    data: {value: vgolist},
    success: function (result) {
    $("#tablelist").html(result);
    $("#loginicon").hide();
    }
  });
  
}

$("#getvender").select2({
  placeholder: "ค้นหา",
  ajax: {
    url: "getvender",
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
    url: "getwarehouse",
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
  placeholder: "เลือก",
  ajax: {
    url: "getdivision",
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
  placeholder: "เลือก",
  ajax: {
    url: "getdepartment",
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

function setwarehouse(v_id) {
  $.ajax({
    url: "setwarehouse",
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

function setvender(v_id) {
  $.ajax({
    url: "setvendor",
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

function setdivision(v_id) {
  $.ajax({
    url: "setdivision",
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

function setdepartment(v_id) {
  $.ajax({
    url: "setdepartment",
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

function setproductcode(v_id) {
  var sendv = $(v_id).attr("value");
  $.ajax({
    url: 'setproductcode',
    type: 'POST',
    data: {v_id: sendv},
    success: function (data) {
      var dt = JSON.parse(data);
      $("#productcode").val(dt[0].stcode);
      $("#itemstname1").val(dt[0].stname1);
      $("#itemmdesc1").val(dt[0].mdesc1);
      $("#closeshowlistitem").click();
    }
  });
  
}

var checkitemid = function checkitemid() {
  var ch_id = $("#prno").attr('value');
  $.ajax({
    url: 'checkitemid',
    type: 'POST',
    data: {checkitemid: ch_id},
    success: function (result) {
      $("#itemprno").val(result);
    }
  });
}
// autorun
checkitemid();